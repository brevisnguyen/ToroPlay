<?php

/**
 * The public-facing functionality of the plugin.
 * 
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 */
class Nguon_Movies_Crawler {
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
    public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_name . 'mainjs', plugin_dir_url( __FILE__ ) . 'js/main.js', array( 'jquery' ), $this->version, false );
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     */
    public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );
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
            $title = explode('|', $data_post)[3];
            $org_title = explode('|', $data_post)[4];
            $year = explode('|', $data_post)[5];

            $api_url = str_replace('ophim.tv', 'ophim1.com', $url);
            $sourcePage = $this->curl($api_url);
            $sourcePage = json_decode($sourcePage, true);

            $movie_data = $this->create_data($sourcePage, $url, $ophim_id, $ophim_update_time);
        
            $args = array(
                'post_type' => 'series',
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
							'status'   			=> true,
							'post_id' 			=> null,
							'list_episode' 	=> [],
							'msg' 					=> 'Nothing needs updating!'
						);
						echo json_encode($result);
                        wp_die();
                    }
    
                    $this->links_series($post->ID, $movie_data);
                    update_post_meta( $post->ID, 'status', $movie_data['episode'] );
                    
                    $result = array(
						'status'				=> true,
						'post_id' 			=> $post->ID,
						'data'					=> $movie_data,
					);
                    echo json_encode($result);
                    wp_die();
                }
            }

            // Loại bỏ phim 18+
            foreach ($movie_data["categories"] as $key => $value) {
                if ( strpos( $value, 'Phim 18+' ) !== false ) {
                    $result = array(
                        'status'   			=> true,
                        'post_id' 			=> null,
                        'list_episode' 	=> [],
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

                $this->links_series($post_id, $movie_data);

            }

            $result = array(
                'status'				=> true,
                'post_id' 			=> $post_id,
                'data'					=> $movie_data,
            );
            echo json_encode($result);
            wp_die();
        } catch (\Throwable $th) {
            $result = array(
                'status'				=> true,
                'post_id' 			=> null,
                'data'					=> null,
                'list_episode' 	=> null,
                'msg' 					=> "Crawl error"
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
    private function create_data($sourcePage, $url, $ophim_id, $ophim_update_time)
    {
        if($sourcePage["movie"]["type"] == "single") {
            $type = "movies";
            $tr_post_type = 1;
        } else {
            $type	= "series";
            $tr_post_type = 2;
        }
    
        $arrCat = [];
        foreach ($sourcePage["movie"]["category"] as $key => $value) {
            array_push($arrCat, $value["name"]);
        }
        if($sourcePage["movie"]["chieurap"] == true) {
            array_push($arrCat, "Chiếu Rạp");
        }
        if($sourcePage["movie"]["type"] == "hoathinh") {
            array_push($arrCat, "Hoạt Hình");
        }
        if($sourcePage["movie"]["type"] == "tvshows") {
            array_push($arrCat, "TV Shows");
        }
    
        $arrCountry 	= [];
        foreach ($sourcePage["movie"]["country"] as $key => $value) {
            array_push($arrCountry, $value["name"]);
        }
    
        $arrTags 			= [];
        array_push($arrTags, $sourcePage["movie"]["name"]);
        if($sourcePage["movie"]["name"] != $sourcePage["movie"]["origin_name"]) array_push($arrTags, $sourcePage["movie"]["origin_name"]);
    
        $data = array(
            'fetch_url' 							=> $url,
            'fetch_ophim_id' 					=> $ophim_id,
            'fetch_ophim_update_time' => $ophim_update_time,
            'title'     							=> $sourcePage["movie"]["name"],
            'org_title' 							=> $sourcePage["movie"]["origin_name"],
            'thumbnail' 							=> esc_url($sourcePage["movie"]["thumb_url"]),
            'poster'   		 						=> esc_url($sourcePage["movie"]["poster_url"]),
            'trailer_url'   		 			=> esc_url($sourcePage["movie"]["trailer_url"]),
            'episode'									=> $sourcePage["movie"]["episode_current"],
            'total_episode'						=> $sourcePage["movie"]["episode_total"],
            'tags'      							=> $arrTags,
            'content'   							=> preg_replace('/\\r?\\n/s', '', $sourcePage["movie"]["content"]),
            'actor'										=> $sourcePage["movie"]["actor"],
            'director'								=> $sourcePage["movie"]["director"],
            'country'									=> $arrCountry,
            'categories'											=> $arrCat,
            'type'										=> $type,
            'lang'										=> $sourcePage["movie"]["lang"],
            'showtime'								=> $sourcePage["movie"]["showtime"],
            'year'										=> $sourcePage["movie"]["year"],
            'status'									=> $sourcePage["movie"]["episode_current"],
            'duration'								=> $sourcePage["movie"]["time"],
            'quality'									=> $sourcePage["movie"]["quality"],
            'tr_post_type' => $tr_post_type,
            'episodes' => $sourcePage['episodes']
        );
    
        return $data;
    }

    /**
	 * Insert movie to WP posts, save images
	 *
	 * @param  array  $data   movie data
	 */
    private function insert_movie($data)
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
        $term_quality = term_exists(ucwords( $data['quality'] ), 'quality');
        if ($term_quality !== 0 && $term_quality !== null) {
            $quality_id = $term_quality['term_id'];
        } else {
            $insert_quality = wp_insert_term(ucwords( $data['quality'] ), 'quality', array());
            $quality_id = $insert_quality['term_id'];
        }

        $term_lang = term_exists(ucwords( $data['lang'] ), 'language');
        if ($term_lang !== 0 && $term_lang !== null) {
            $lang_id = $term_lang['term_id'];
        } else {
            $insert_lang = wp_insert_term(ucwords( $data['lang'] ), 'language', array());
            $lang_id = $insert_lang['term_id'];
        }

        $term_server = term_exists('Vietsub #1', 'server');
        $term_sub_server = term_exists('Dự Phòng', 'server');
        if ($term_server !== 0 && $term_server !== null) {
            $server_id = $term_server['term_id'];
        } else {
            $insert_server = wp_insert_term('Vietsub #1', 'server', array());
            $server_id = $insert_server['term_id'];
        }
        if ($term_sub_server !== 0 && $term_sub_server !== null) {
            $sub_server_id = $term_sub_server['term_id'];
        } else {
            $insert_sub_server = wp_insert_term('Dự Phòng', 'server', array());
            $sub_server_id = $insert_sub_server['term_id'];
        }

        // Insert links
        if ($data["episodes"][0]["server_data"][0]["link_m3u8"] !== "") {
            foreach ( $data['episodes'] as $key => $servers ) {
                foreach ($servers["server_data"] as $episode) {
                    $array_links[0] = array(
                        'type'      => '1',
                        'server'    => $server_id,
                        'lang'      => $lang_id,
                        'quality'   => $quality_id,
                        'link'      => base64_encode(stripslashes(esc_textarea($episode['link_embed']))),
                        'date'      => date('d/m/Y'),
                    );
                    $array_links[1] = array(
                        'type'      => '1',
                        'server'    => $sub_server_id,
                        'lang'      => $lang_id,
                        'quality'   => $quality_id,
                        'link'      => base64_encode(stripslashes(esc_textarea($episode['link_m3u8']))),
                        'date'      => date('d/m/Y'),
                    );
                    for ($i=0; $i < 2; $i++) { 
                        update_post_meta( $post_id, 'trglinks_'.$i, serialize( $array_links[$i] ) );
                    }
                }
            }
        }
        update_post_meta( $post_id, 'trgrabber_tlinks', 2 );
    }

    /**
     * Links series
     * @param array $data episodes data
     */
    private function links_series($post_id, $data)
    {
        $post_id = intval($post_id);
        if ( $post_id == 0 ) {
            die();
        }

        $name = get_the_title($post_id);
        $season_number = 1;
        // Lang, Quality, Server
        $term_quality = term_exists(ucwords( $data['quality'] ), 'quality');
        if ($term_quality !== 0 && $term_quality !== null) {
            $quality_id = $term_quality['term_id'];
        } else {
            $insert_quality = wp_insert_term(ucwords( $data['quality'] ), 'quality', array());
            $quality_id = $insert_quality['term_id'];
        }

        $term_lang = term_exists(ucwords( $data['lang'] ), 'language');
        if ($term_lang !== 0 && $term_lang !== null) {
            $lang_id = $term_lang['term_id'];
        } else {
            $insert_lang = wp_insert_term(ucwords( $data['lang'] ), 'language', array());
            $lang_id = $insert_lang['term_id'];
        }

        $term_server = term_exists('Vietsub #1', 'server');
        $term_sub_server = term_exists('Dự Phòng', 'server');
        if ($term_server !== 0 && $term_server !== null) {
            $server_id = $term_server['term_id'];
        } else {
            $insert_server = wp_insert_term('Vietsub #1', 'server', array());
            $server_id = $insert_server['term_id'];
        }
        if ($term_sub_server !== 0 && $term_sub_server !== null) {
            $sub_server_id = $term_sub_server['term_id'];
        } else {
            $insert_sub_server = wp_insert_term('Dự Phòng', 'server', array());
            $sub_server_id = $insert_sub_server['term_id'];
        }

        // Add seasons
        $slug_seasons = sanitize_title($name . ' ' .  $season_number);
        $name_seasons = $name . ' - Season ' . $season_number;

        $term_seasons = wp_insert_term($name.' '.$season_number, 'seasons' );
        $term_seasons = ! is_wp_error( $term_seasons ) ? intval($term_seasons['term_id']) : intval($term_seasons->error_data['term_exists']);
        wp_set_object_terms($post_id, $term_seasons, 'seasons', true);

        wp_update_term( $term_seasons, 'seasons', array(
            'name' => $name_seasons,
            'slug' => $slug_seasons
        ));

        $array_post_meta = array(
            'air_date' => $data['year'],
            'poster_path_hotlink' => $data['thumbnail'],
            'number_of_episodes' => 0,
            'tr_id_post' => $post_id,
            'name' => 'Season ' . $season_number,
            'season_number' => $season_number
        );
        foreach ( $array_post_meta as $key => $value ) {
            $meta_value = is_array(get_term_meta( $term_seasons, $key, true )) ? array_map('stripslashes', get_term_meta( $term_seasons, $key, true )) : stripslashes( get_term_meta( $term_seasons, $key, true ) );
            if ( $value && '' == $meta_value ){
                add_term_meta( $term_seasons, $key, $value, true );
            }
            elseif ( $value && $value != $meta_value ){
                update_term_meta( $term_seasons, $key, $value );
            }
            elseif ( '' == $value && $meta_value ){
                delete_term_meta( $term_seasons, $key, $meta_value );
            }
        }
        update_post_meta( $post_id, 'number_of_seasons', $season_number );

        // Add episodes
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
                        $term_episode = wp_insert_term($n, 'episodes' );
                        $term_episode = ! is_wp_error( $term_episode ) ? intval($term_episode['term_id']) : intval($term_episode->error_data['term_exists']);
                        wp_set_object_terms($post_id, $term_episode, 'episodes', true);

                        $name_episodes = $name.' '.$season_number.'x'.$episode['name']; // {name} {season}x{episode}
                        $slug_episodes = sanitize_title($name . '-' . $season_number . 'x' . $episode['name']); // {name}-{season}x{episode}
                        wp_update_term( $term_episode, 'episodes', array(
                            'name' => $name_episodes,
                            'slug' => $slug_episodes
                        ));

                        $array_post_meta = array(
                            'air_date'              => date('Y-m-d'),
                            'episode_number'        => $episode['name'],
                            'name'                  => 'Tập '. $episode['name'],
                            'season_number'         => $season_number,
                            'still_path_hotlink'    => $data['thumbnail'],
                            'tr_id_post'            => $post_id,
                        );
                        foreach ( $array_post_meta as $key => $value ) {
                            $meta_value = is_array(get_term_meta( $term_episode, $key, true )) ? array_map('stripslashes', get_term_meta( $term_episode, $key, true )) : stripslashes( get_term_meta( $term_episode, $key, true ) );
                            if ( $value && '' == $meta_value ){
                                add_term_meta( $term_episode, $key, $value, true );
                            }
                            elseif ( $value && $value != $meta_value ){
                                update_term_meta( $term_episode, $key, $value );
                            }
                            elseif ( '' == $value && $meta_value ){
                                delete_term_meta( $term_episode, $key, $meta_value );
                            }
                        }

                        $array_links[0] = array(
                            'type'      => '1',
                            'server'    => $server_id,
                            'lang'      => $lang_id,
                            'quality'   => $quality_id,
                            'link'      => base64_encode(stripslashes(esc_textarea($episode['link_embed']))),
                            'date'      => date('d/m/Y'),
                        );
                        $array_links[1] = array(
                            'type'      => '1',
                            'server'    => $sub_server_id,
                            'lang'      => $lang_id,
                            'quality'   => $quality_id,
                            'link'      => base64_encode(stripslashes(esc_textarea($episode['link_m3u8']))),
                            'date'      => date('d/m/Y'),
                        );
                        for ($i=0; $i < 2; $i++) { 
                            update_term_meta( $term_episode, 'trglinks_'.$i, serialize( $array_links[$i] ) );
                        }
                        update_term_meta( $term_episode, 'trgrabber_tlinks', 2 );
                    }
                }
            }
        }
        update_term_meta( $term_seasons, 'number_of_episodes', count($data["episodes"][0]['server_data']) );
        update_post_meta( $post_id, 'number_of_episodes', count($data["episodes"][0]['server_data']) );
    }
}
