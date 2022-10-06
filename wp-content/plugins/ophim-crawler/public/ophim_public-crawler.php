<?php

/**
 * The public-facing functionality of the plugin.
 * 
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 */
class OPhim_Movies_Crawler {
    private $plugin_name;
    private $version;

    /**
	 * Initialize the class and set its properties.
	 *
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

    /**
     * Register the JavaScript for the public-facing side of the site.
     */
    public function enqueue_ophim_scripts() {
        wp_enqueue_script( $this->plugin_name . 'mainjs', plugin_dir_url( __FILE__ ) . 'js/ophim.js', array( 'jquery' ), $this->version, false );
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     */
    public function enqueue_ophim_styles() {
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ophim.css', array(), $this->version, 'all' );
    }

    /**
	 * Make CURL
	 *
	 * @param  string      $url       Url string
	 * @return string|bool $response  Response
	 */
    private function curl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
	 * wp_ajax_crawl_ophim_page action Callback function
	 *
	 * @param  string $api url
	 * @return json $page_array
	 */
    public function crawl_ophim_page()
    {
        $url = $_POST['url'];

        $sourcePage = $this->curl($url);

        $sourcePage = json_decode($sourcePage);
        $listMovies = [];

        if(count($sourcePage->items) > 0) {
            foreach ($sourcePage->items as $key => $item) {
                array_push($listMovies, "https://ophim.tv/phim/{$item->slug}|{$item->_id}|{$item->modified->time}|{$item->name}|{$item->origin_name}|{$item->year}");
            }
            echo join("\n", $listMovies);
        } else {
            echo [];
        }

        wp_die();
    }

    /**
	 * wp_ajax_crawl_ophim_movies action Callback function
	 *
	 * @param  string $api        url
	 * @param  string $param      query params
	 * @return json   $page_array List movies in page
	 */
    public function crawl_ophim_movies()
    {
        try 
        {
            $data_post = $_POST['url'];
            $url = explode('|', $data_post)[0];
            $ophim_id = explode('|', $data_post)[1];
            $ophim_update_time 	= explode('|', $data_post)[2];
            $org_title = explode('|', $data_post)[4];

            $api_url = str_replace('ophim.tv', 'ophim1.com', $url);
            $sourcePage = $this->curl($api_url);
            $sourcePage = json_decode($sourcePage, true);

            $movie_data = $this->create_data($sourcePage, $url, $ophim_id, $ophim_update_time);
        
            $args = array(
                'post_type' => array('series', 'movies'),
                'posts_per_page' => 1,
                'meta_query' => array(
                    array(
                        'key' => 'field_title',
                        'value' => $org_title,
                        'compare' => '='
                    )
                )
            );
            $wp_query = new WP_Query($args);
        
            if ( $wp_query->have_posts() ) { // Trùng tên phim
                while ($wp_query->have_posts()) {
                    $wp_query->the_post();
                    global $post;
                    $status = get_post_meta($post->ID, 'status', true);
                    
                    if($status == $movie_data['episode']) { // Tập phim không thay đổi
                        $result = array(
							'status' => true,
							'post_id' => null,
							'list_episode' => [],
							'msg' => 'Nothing needs updating!'
						);
						echo json_encode($result);
                        wp_die();
                    }

                    if ( $movie_data['tr_post_type'] == 1 ) {

                        $this->links_movies($post->ID, $movie_data);
            
                    } elseif ( $movie_data['tr_post_type'] == 2 ) {
            
                        $this->episodes($post->ID, 1, $movie_data);
                        update_post_meta( $post->ID, 'status', $movie_data['episode'] );
    
                    }
                    
                    $result = array(
						'status' => true,
						'post_id' => $post->ID,
						'data' => $movie_data,
					);
                    echo json_encode($result);
                    wp_die();
                }
            }

            // Loại bỏ phim 18+
            foreach ($movie_data["categories"] as $key => $value) {
                if ( strpos( $value, 'Phim 18+' ) !== false ) {
                    $result = array(
                        'status' => true,
                        'post_id' => null,
                        'list_episode' => [],
                        'msg' => 'Nothing needs updating!'
                    );
                    echo json_encode($result);
                    wp_die();
                }
            }

            $post_id = $this->insert_movie($movie_data);

            if ( $movie_data['tr_post_type'] == 1 ) {

                $this->links_movies($post_id, $movie_data);

            } elseif ( $movie_data['tr_post_type'] == 2 ) {

                $this->seasons($post_id, 1, $movie_data);

                $this->episodes($post_id, 1, $movie_data);

            }

            $result = array(
                'status' => true,
                'post_id' => $post_id,
                'data' => $movie_data,
            );
            echo json_encode($result);
            wp_die();
        } catch (\Throwable $th) {
            $result = array(
                'status' => true,
                'post_id' => null,
                'data' => null,
                'list_episode' => null,
                'msg' => "Crawl error"
            );
            echo json_encode($result);
            wp_die();
        }
    }

    /**
	 * Refine movie data from api response
	 *
	 * @param  array  $array_data   raw movie data
	 * @param  array  $movie_data   movie data
	 */
    private function create_data($sourcePage)
    {
        $arrCat = [];
        if($sourcePage["movie"]["type"] == "single") {
            $type = "movies";
            $tr_post_type = 1;
            array_push($arrCat, "Phim Lẻ");
        } elseif($sourcePage["movie"]["episode_current"] == "Full" && $sourcePage["movie"]["type"] == "hoathinh") {
            $type = "movies";
            $tr_post_type = 1;
        } else {
            $type	= "series";
            $tr_post_type = 2;
        }
    
        foreach ($sourcePage["movie"]["category"] as $key => $value) {
            array_push($arrCat, $value["name"]);
        }
        if($sourcePage["movie"]["chieurap"] == true) {
            array_push($arrCat, "Chiếu Rạp");
        } elseif($sourcePage["movie"]["type"] == "hoathinh") {
            array_push($arrCat, "Hoạt Hình");
        } elseif($sourcePage["movie"]["type"] == "tvshows") {
            array_push($arrCat, "TV Shows");
        } elseif($sourcePage["movie"]["type"] == "series") {
            array_push($arrCat, "Phim Bộ");
        }
    
        $arrCountry = [];
        foreach ($sourcePage["movie"]["country"] as $key => $value) {
            array_push($arrCountry, $value["name"]);
        }
    
        $arrTags = [];
        array_push($arrTags, $sourcePage["movie"]["name"]);
        if($sourcePage["movie"]["name"] != $sourcePage["movie"]["origin_name"]) array_push($arrTags, $sourcePage["movie"]["origin_name"]);
    
        $data = array(
            'title'             => $sourcePage["movie"]["name"],
            'org_title'         => $sourcePage["movie"]["origin_name"],
            'thumbnail'         => esc_url($sourcePage["movie"]["thumb_url"]),
            'poster'            => esc_url($sourcePage["movie"]["poster_url"]),
            'trailer_url'       => esc_url($sourcePage["movie"]["trailer_url"]),
            'episode'           => $sourcePage["movie"]["episode_current"],
            'total_episode'     => $sourcePage["movie"]["episode_total"],
            'tags'              => $arrTags,
            'content'           => preg_replace('/\\r?\\n/s', '', $sourcePage["movie"]["content"]),
            'actor'             => $sourcePage["movie"]["actor"],
            'director'          => $sourcePage["movie"]["director"],
            'country'           => $arrCountry,
            'categories'        => $arrCat,
            'type'              => $type,
            'lang'              => $sourcePage["movie"]["lang"],
            'showtime'          => $sourcePage["movie"]["showtime"],
            'year'              => $sourcePage["movie"]["year"],
            'status'            => $sourcePage["movie"]["episode_current"],
            'duration'          => $sourcePage["movie"]["time"],
            'quality'           => $sourcePage["movie"]["quality"],
            'tr_post_type'      => $tr_post_type,
            'episodes'          => $sourcePage['episodes']
        );
    
        return $data;
    }

    /**
	 * Insert movie to WP posts, save images
	 *
	 * @param  array  $data   movie data
	 */
    private function insert_movie(&$data)
    {
        $categories_id = [];
        foreach ($data['categories'] as $category) {
            if (!category_exists($category) && $category !== '') {
                wp_create_category($category);
            }
            $categories_id[] = get_cat_ID($category);
        }
        foreach ($data['tags'] as $tag) {
            if (!term_exists($tag) && $tag != '') {
                wp_insert_term($tag, 'post_tag');
            }
        }

        $post_data = array(
            'post_title'   		=> $data['title'],
            'post_content' 		=> $data['content'],
            'post_status'  		=> 'publish',
            'comment_status' 	=> 'open',
            'ping_status'  		=> 'open',
            'post_author'  		=> get_current_user_id(),
            'post_type'         => $data['type'],
        );
        $post_id = wp_insert_post($post_data);

        wp_set_object_terms($post_id, $data['status'], 'status', false);

        if ( isset($data['thumbnail']) ) {
            $results = $this->save_images($data['thumbnail']);
            if ( $results !== false ) {
                $attachment = array(
                    'guid' => $results['url'], 
                    'post_mime_type' => $results['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', basename($results['file'])),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                $attach_id = wp_insert_attachment($attachment, $results['file'], $post_id);
    
                set_post_thumbnail($post_id, $attach_id);
                $data['thumbnail'] = $results['url'];
            }
        }

        if ( isset($data['poster']) ) {
            $results = $this->save_images($data['poster']);
            if ( $results !== false ) {
                $attachment = array(
                    'guid' => $results['url'], 
                    'post_mime_type' => $results['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', basename($results['file'])),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                $attach_id = wp_insert_attachment($attachment, $results['file'], $post_id);
                $data['poster'] = $results['url'];
            }
        }

        $post_meta_movies = array(
            'field_title' => $data['org_title'],
            'field_date' => sanitize_text_field($data['year']),
            'field_release_year' => sanitize_text_field($data['year']),
            'status' => $data['status'],
            'field_runtime' => $data['duration'],
            'tr_post_type' => $data['tr_post_type'],
            'poster_hotlink' => $data['thumbnail'],
            'backdrop_hotlink' => $data['poster'],
            'letters' => mb_strtoupper(substr(sanitize_title($data['title']), 0, 1)),
        );
        if( isset($post_meta_movies) ) {
            foreach ( $post_meta_movies as $key => $value ) {
                $new_meta_value = ( isset( $value ) ? ( $value ) : '' );
                $meta_value = is_array(get_post_meta( $post_id, $key, true )) ? array_map('stripslashes', get_post_meta( $post_id, $key, true )) : stripslashes( get_post_meta( $post_id, $key, true ) );

                if ( $new_meta_value && '' == $meta_value ){
                    add_post_meta( $post_id, $key, $new_meta_value, true );
                }
                elseif ( $new_meta_value && $new_meta_value != $meta_value ){
                    update_post_meta( $post_id, $key, $new_meta_value );
                }
                elseif ( '' == $new_meta_value && $meta_value ){
                    delete_post_meta( $post_id, $key, $meta_value );
                }
            }
        }

        if ( $data['type'] == 'movies' ) {
            wp_set_object_terms($post_id, $data['director'], 'directors');
            wp_set_object_terms($post_id, $data['actor'], 'cast');
        } elseif ( $data['type'] == 'series' ) {
            wp_set_object_terms($post_id, $data['director'], 'directors_tv');
            wp_set_object_terms($post_id, $data['actor'], 'cast_tv');
        }
        wp_set_object_terms($post_id, $data['country'], 'country');
        wp_set_object_terms($post_id, $data['year'], 'release');
        wp_set_post_terms($post_id, $data['tags']);
        wp_set_post_categories($post_id, $categories_id);

        return $post_id;
    }

    /**
     * Links movies
     * @param array $data episodes data
     */
    private function links_movies($post_id, $data)
    {
        // Removes links
        $total = get_post_meta( $post_id, 'trgrabber_tlinks', true ) == '' ? 0 : get_post_meta( $post_id, 'trgrabber_tlinks', true )+1;
        if( isset( $total ) and $total > 0 ) {
            for ($iii = 0; $iii <= $total; $iii++) { delete_post_meta( $post_id, 'trglinks_'.$iii ); }
            delete_post_meta( $post_id, 'trgrabber_tlinks' );
        }
        // Lang, Quality
        $terms_array = array(
            0 => ['quality', $data['quality']],
            1 => ['language', $data['lang']],
            2 => ['server', 'Vietsub #1'],
            3 => ['server', 'Dự Phòng'],
        );
        $terms_data = array();
        foreach ( $terms_array as $key => $value ) {
            $term_id = term_exists(ucwords( $value[1] ), $value[0]);
            if ($term_id !== 0 && $term_id !== null) {
                $term_id = $term_id['term_id'];
            } else {
                $insert_term = wp_insert_term(ucwords( $value[1] ), $value[0], array());
                $term_id = $insert_term['term_id'];
            }
            if ( hash_equals('Dự Phòng', $value[1]) ) {
                $terms_data['sub_server'] = $term_id;
            } else {
                $terms_data[$value[0]] = $term_id;
            }
        }

        // Insert links
        if ($data["episodes"][0]["server_data"][0]["link_m3u8"] !== "") {
            foreach ( $data['episodes'] as $key => $servers ) {
                foreach ($servers["server_data"] as $episode) {
                    $links = array(
                        'type'      => '1',
                        'lang'      => $terms_data['language'],
                        'quality'   => $terms_data['quality'],
                        'date'      => date('d/m/Y'),
                        'server'    => $terms_data['server'],
                        'link'      => base64_encode(stripslashes(esc_textarea($episode['link_embed']))),
                    );

                    update_post_meta( $post_id, 'trglinks_0', serialize( $links ) );
                    update_post_meta( $post_id, 'trglinks_1', serialize( array_merge($links, array( 'server' => $terms_data['sub_server'], 'link' => base64_encode(stripslashes(esc_textarea($episode['link_m3u8']))) )) ) );
                }
            }
        }
        update_post_meta( $post_id, 'trgrabber_tlinks', 2 );
    }

    /**
	 * Add season
	 *
	 * @param  string $post_id       Post ID
	 * @param  string $season_number Season number
	 * @param  object $data          Movie data
	 */
    private function seasons($post_id, $season_number, $data)
    {
        $name = get_the_title($post_id);
        $seasons_list = tr_grabber_list_seasons( $post_id );
        $array_seasons = array();

        foreach ($seasons_list as &$value_season) {
            $array_seasons[] = get_term_meta( $value_season->term_id, 'season_number', true );
        }

        if( isset( $array_seasons ) and !in_array($season_number, $array_seasons) ) {
            $cid = wp_insert_term($name.' '.$season_number, 'seasons' );
            $cid = ! is_wp_error( $cid ) ? intval($cid['term_id']) : intval($cid->error_data['term_exists']);

            wp_set_object_terms($post_id, $cid, 'seasons', true);
        }

        $array_post_meta = array(
            'air_date' => $data['year'],
            'poster_path_hotlink' => $data['thumbnail'],
            'number_of_episodes' => 0,
            'tr_id_post' => $post_id,
            'name' => 'Season ' . $season_number,
            'season_number' => $season_number
        );
        if ( isset($array_post_meta) and isset($array_seasons) and !in_array($season_number, $array_seasons) ) {
            foreach ( $array_post_meta as $key => $value ) {
                $meta_value = is_array(get_term_meta( $cid, $key, true )) ? array_map('stripslashes', get_term_meta( $cid, $key, true )) : stripslashes( get_term_meta( $cid, $key, true ) );
                if ( $value && '' == $meta_value ){
                    add_term_meta( $cid, $key, $value, true );
                }
                elseif ( $value && $value != $meta_value ){
                    update_term_meta( $cid, $key, $value );
                }
                elseif ( '' == $value && $meta_value ){
                    delete_term_meta( $cid, $key, $meta_value );
                }
            }
        }

        wp_update_term( $cid, 'seasons', array(
            'name' => $name . ' - Season ' . $season_number,
            'slug' => sanitize_title($name . ' ' .  $season_number)
        ));

        update_term_meta( $cid, 'number_of_episodes', 0 );
        update_post_meta( $post_id, 'number_of_seasons', $season_number );
    }

    /**
	 * Save movie thumbail to WP
	 *
	 * @param  string   $image_url   thumbail url
	 */
    public function save_images($image_url)
    {
        require_once( ABSPATH . "/wp-admin/includes/file.php");

        $temp_file = download_url( $image_url, 10 );
        if ( ! is_wp_error( $temp_file ) ) {

            $mime_extensions = array(
                'jpg'          => 'image/jpg',
                'jpeg'         => 'image/jpeg',
                'gif'          => 'image/gif',
                'png'          => 'image/png',
                'webp'         => 'image/webp',
            );

            // Array based on $_FILE as seen in PHP file uploads.
            $file = array(
                'name'     => basename($image_url), // ex: wp-header-logo.png
                'type'     => $mime_extensions[pathinfo( $image_url, PATHINFO_EXTENSION )],
                'tmp_name' => $temp_file,
                'error'    => 0,
                'size'     => filesize( $temp_file ),
            );
        
            $overrides = array(
                'test_form' => false,
                'test_size' => true,
                'test_upload' => true,
            );
        
            // Move the temporary file into the uploads directory.
            $results = wp_handle_sideload( $file, $overrides );
        
            if ( ! empty( $results['error'] ) ) {
                return false;
            } else {
                return $results;
            }
        }
    }

    /**
	 * Add episodes to season
	 *
	 * @param  string $post_id       Post ID
	 * @param  string $season_number Season number
	 * @param  object $data          Movie data
	 */
    private function episodes($post_id, $season_number, $data)
    {
        $name = get_the_title($post_id);
        $episodes = tr_grabber_list_episodes( $post_id, $season_number );
        $array_episodes = array();
                
        foreach ($episodes as &$value_episode) {
            $array_episodes[] = get_term_meta( $value_episode->term_id, 'episode_number', true );
        }

        if ($data["episodes"][0]["server_data"][0]["link_m3u8"] !== "") {
            foreach ( $data['episodes'] as $key => $servers ) {
                foreach ($servers["server_data"] as $episode) {
                    if( isset( $array_episodes ) and !in_array($episode['name'], $array_episodes) ) {
                        $n = $name.' '.$season_number.'x'.$episode['name'];

                        $cid = wp_insert_term($n, 'episodes' );        
                        $cid = ! is_wp_error( $cid ) ? intval($cid['term_id']) : intval($cid->error_data['term_exists']);

                        wp_set_object_terms($post_id, $cid, 'episodes', true);
                    }

                    $array_post_meta = array(
                        'air_date' => date('Y-m-d'),
                        'episode_number' => $episode['name'],
                        'name' => 'Tập '. $episode['name'],
                        'season_number' => $season_number,
                        'still_path_hotlink' => $data['thumbnail'],
                        'tr_id_post' => $post_id,
                        'overview' => $data['content'],
                    );
                    if( isset($array_post_meta) and isset( $array_episodes ) and !in_array($episode['name'], $array_episodes) ) {
                        foreach ( $array_post_meta as $key => $value ) {
                            $new_meta_value = ( isset( $value ) ? ( $value ) : '' );
                            $meta_value = is_array(get_term_meta( $cid, $key, true )) ? array_map('stripslashes', get_term_meta( $cid, $key, true )) : stripslashes( get_term_meta( $cid, $key, true ) );
        
                            if ( $new_meta_value && '' == $meta_value ){
                                add_term_meta( $cid, $key, $new_meta_value, true );
                            }
                            elseif ( $new_meta_value && $new_meta_value != $meta_value ){
                                update_term_meta( $cid, $key, $new_meta_value );
                            }
                            elseif ( '' == $new_meta_value && $meta_value ){
                                delete_term_meta( $cid, $key, $meta_value );
                            }
                        }
                    }

                    $slug_episodes = TR_GRABBER_SLUG_EPISODES;
                    $name_episodes = TR_GRABBER_TITLE_EPISODES;
                    $subtitle_episodes = TR_GRABBER_SUBTITLE_EPISODES;

                    $vars = array( '{name}', '{season}', '{episode}' );
                    $vars_replace = array( $name, $array_post_meta['season_number'], $array_post_meta['episode_number'] );

                    $slug_episodes = str_replace( $vars, $vars_replace, $slug_episodes );
                    $name_episodes = str_replace( $vars, $vars_replace, $name_episodes );
                    $subtitle_episodes = str_replace( $vars, $vars_replace, $subtitle_episodes );

                    wp_update_term( $cid, 'episodes', array(
                        'name' => $name_episodes,
                        'slug' => $slug_episodes
                    ));

                    // Links
                    $terms_array = array(
                        0 => ['quality', $data['quality']],
                        1 => ['language', $data['lang']],
                        2 => ['server', 'Vietsub #1'],
                        3 => ['server', 'Dự Phòng'],
                    );
                    $terms_data = array();
                    foreach ( $terms_array as $key => $value ) {
                        $term_id = term_exists(ucwords( $value[1] ), $value[0]);
                        if ($term_id !== 0 && $term_id !== null) {
                            $term_id = $term_id['term_id'];
                        } else {
                            $insert_term = wp_insert_term(ucwords( $value[1] ), $value[0], array());
                            $term_id = $insert_term['term_id'];
                        }
                        if ( hash_equals('Dự Phòng', $value[1]) ) {
                            $terms_data['sub_server'] = $term_id;
                        } else {
                            $terms_data[$value[0]] = $term_id;
                        }
                    }

                    $links = array(
                        'type'      => '1',
                        'lang'      => $terms_data['language'],
                        'quality'   => $terms_data['quality'],
                        'date'      => date('d/m/Y'),
                        'server'    => $terms_data['server'],
                        'link'      => base64_encode(stripslashes(esc_textarea($episode['link_embed']))),
                    );

                    update_term_meta( $cid, 'trglinks_0', serialize( $links ) );
                    update_term_meta( $cid, 'trglinks_1', serialize( array_merge($links, array( 'server' => $terms_data['sub_server'], 'link' => base64_encode(stripslashes(esc_textarea($episode['link_m3u8']))) )) ) );
                    update_term_meta( $cid, 'trgrabber_tlinks', 2 );
                }
            }
        }

        $term_id_season = tr_grabber_list_seasons($post_id, $season_number);
        update_term_meta( $term_id_season[0]->term_id, 'number_of_episodes', tr_grabber_count_episodes( $post_id, $season_number, false ) );
        update_post_meta( $post_id, 'number_of_episodes', tr_grabber_count_episodes($post_id, $season_number, false) );
    }
}
