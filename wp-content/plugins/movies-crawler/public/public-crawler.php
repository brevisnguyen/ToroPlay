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
        wp_enqueue_script( $this->plugin_name . 'bootstrapjs', plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js', array(), $this->version, false );
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     */
    public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nguontv.css', array(), $this->version, 'all' );
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
	 * wp_ajax_nguon_crawler_api action Callback function
	 *
	 * @param  string $api url
	 * @return json $page_array
	 */
    public function nguon_crawler_api()
    {
        $url = $_POST['api'];
        $url = strpos($url, '?') === false ? $url .= '?' : $url .= '&';
        $full_url = $url . http_build_query(['ac' => 'list', 'limit' => 30, 'pg' => 1]);
        $latest_url = $url . http_build_query(['ac' => 'list', 'limit' => 30, 'pg' => 1, 'h' => 24]);

        $full_response = $this->curl($full_url);
        $latest_response = $this->curl($latest_url);

        $data = json_decode($full_response);
        $latest_data = json_decode($latest_response);
        if ( !$data ) {
            echo json_encode(['code' => 999, 'message' => 'Mẫu JSON không đúng, không hỗ trợ thu thập']);
            die();
        }
        $page_array = array(
            'code'              => 1,
            'last_page'         => $data->pagecount,
            'per_page'          => $data->limit,
            'total'             => $data->total,
            'full_list_page'    => range(1, $data->pagecount),
            'latest_list_page'  => range(1, $latest_data->pagecount),
        );
        echo json_encode($page_array);
        // $page_array = $this->get_play_url('nguon$$$ngm3u8', '$$$', 'Tử Thi Bí Ẩn$https:\/\/play2.choiinguon.com\/share\/9aa70957fde5ac24d3f5c61776a06053$$$Tử Thi Bí Ẩn$https:\/\/play2.choiinguon.com\/20220623\/9094_ba15e28f\/index.m3u8');
        // echo json_encode($page_array);

        wp_die();
    }

    /**
	 * wp_ajax_nguon_get_movies_page action Callback function
	 *
	 * @param  string $api        url
	 * @param  string $param      query params
	 * @return json   $page_array List movies in page
	 */
    public function nguon_get_movies_page()
    {
        try 
        {
            $url = $_POST['api'];
            $params = $_POST['param'];
            $url = strpos($url, '?') === false ? $url .= '?' : $url .= '&';
            $response = $this->curl($url . $params);
    
            $data = json_decode($response);
            if ( !$data ) {
                echo json_encode(['code' => 999, 'message' => 'Mẫu JSON không đúng, không hỗ trợ thu thập']);
                die();
            }
            $page_array = array(
                'code'          => 1,
                'movies'        => $data->list,
            );
            echo json_encode($page_array);
    
            wp_die();
        } catch (\Throwable $th) {
            //throw $th;
            echo json_encode(['code' => 999, 'message' => $th]);
            wp_die();
        }
    }

    /**
	 * wp_ajax_nguon_crawl_by_id action Callback function
	 *
	 * @param  string $api        url
	 * @param  string $param      movie id
	 */
    public function nguon_crawl_by_id()
    {
        $url = $_POST['api'];
        $params = $_POST['param'];
        $url = strpos($url, '?') === false ? $url .= '?' : $url .= '&';
        $response = $this->curl($url . $params);

        $response = $this->filter_tags($response);
        $data = json_decode($response, true);
        if ( !$data ) {
            echo json_encode(['code' => 999, 'message' => 'Mẫu JSON không đúng, không hỗ trợ thu thập']);
            die();
        }
        $movie_data = $this->refined_data($data['list']);

        $args = array(
			'post_type' => array('series', 'movies'),
			'posts_per_page' => 1,
			'meta_query' => array(
				array(
					'key' => 'field_title',
					'value' => $movie_data['org_title'],
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
                        'code' => 999,
                        'message' => $movie_data['org_title'] . ' : Không cần cập nhật',
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
                    'code' => 1,
                    'message' => $movie_data['org_title'] . ' : Cập nhật thành công.',
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
			'code' => 1,
			'message' => $movie_data['org_title'] . ' : Thu thập thành công.',
		);
        echo json_encode($result);
        wp_die();
    }

    /**
	 * Refine movie data from api response
	 *
	 * @param  array  $array_data   raw movie data
	 * @param  array  $movie_data   movie data
	 */
    private function refined_data($array_data)
    {
        foreach ($array_data as $key => $data) {
            $categories = [];
            if ($data['type_id'] == 1) {
                $type = "movies";
                $duration = empty($data['vod_weekday']) ? '0h 0m' : $data['vod_weekday'];
                $tr_post_type = 1;
            } else {
                $type	= "series";
                $tr_post_type = 2;
                if ($data['type_id_1'] == 2) {
                    array_push($categories, 'Phim Bộ');
                }
                if ($data['type_id'] == 3 && $data['type_id_1'] == 0) {
                    $data['type_name'] = 'TV Shows';
                }
            }
            $categories = array_merge(
                $categories,
                $this->format_text($data['type_name']),
                $this->format_text($data['vod_class']),
            );
            $tags = [];
            array_push($tags, sanitize_text_field($data['vod_name']));
            $tags = array_merge($tags, $this->format_text($data['vod_class']));
    
            $movie_data = [
                'title' => $data['vod_name'],
                'org_title' => trim($data['vod_en']),
                'pic_url' => esc_url($data['vod_pic']),
                'actor' => $this->format_text($data['vod_actor']),
                'director' => $this->format_text($data['vod_director']),
                'episode' => $data['vod_remarks'],
                'episodes' => $this->get_play_url($data['vod_play_from'], $data['vod_play_note'], $data['vod_play_url']),
                'country' => $data['vod_area'],
                'language' => ucwords($data['vod_lang']),
                'year' => empty($data['vod_year']) ? date('Y-m-d') : $data['vod_year'].date('-m-d'),
                'content' => preg_replace('/\\r?\\n/s', '', empty($data['vod_content']) ? 'Đang cập nhật' : $data['vod_content']),
                'tags' => $tags,
                'quality' => $data['vod_version'],
                'type' => $type,
                'categories' => $categories,
                'duration' => $duration,
                'status' => $data['vod_remarks'],
                'tr_post_type' => $tr_post_type,
                'letters' => mb_strtoupper(substr(sanitize_title($data['vod_name']), 0, 1)),
            ];
        }
        return $movie_data;
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

        if ( isset($data['pic_url']) ) {
            $results = $this->save_images($data['pic_url']);
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
                $data['pic_url'] = $results['url'];
            }
        }

        $post_meta_movies = array(
            'field_title' => $data['org_title'],
            'field_date' => sanitize_text_field($data['year']),
            'field_release_year' => sanitize_text_field($data['year']),
            'status' => $data['status'],
            'field_runtime' => $data['duration'],
            'tr_post_type' => $data['tr_post_type'],
            'poster_hotlink' => $data['pic_url'],
            'backdrop_hotlink' => 'https://www.themoviedb.org/t/p/original/zQ3W1RXwr7UAXgwTdcDqO7fJj1j.jpg',
            'letters' => $data['letters'],
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
        // Server, Lang, Quality
        $terms_array = array(
            0 => ['quality', 'Full HD'],
            1 => ['language', 'Vietsub'],
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
        foreach ( $data['episodes'] as $key => $episode ) {
            $links = array(
                'type'      => '1',
                'lang'      => $terms_data['language'],
                'quality'   => $terms_data['quality'],
                'date'      => date('d/m/Y'),
                'server'    => $terms_data['server'],
                'link'      => $episode['link_embed'],
            );

            update_post_meta( $post_id, 'trglinks_0', serialize( $links ) );
            update_post_meta( $post_id, 'trglinks_1', serialize( array_merge($links, array( 'server' => $terms_data['sub_server'], 'link' => $episode['link_m3u8'] )) ) );
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
        $post_id = intval($post_id);
        if ( $post_id == 0 ) {
            die();
        }
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
            'poster_path_hotlink' => $data['pic_url'],
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

        foreach ( $data['episodes'] as $key => $episode ) {
            if( isset( $array_episodes ) and !in_array($episode['episode_number'], $array_episodes) ) {
                $n = $name.' '.$season_number.'x'.$episode['episode_number'];

                $cid = wp_insert_term($n, 'episodes' );        
                $cid = ! is_wp_error( $cid ) ? intval($cid['term_id']) : intval($cid->error_data['term_exists']);

                wp_set_object_terms($post_id, $cid, 'episodes', true);
            }

            $array_post_meta = array(
                'air_date' => date('Y-m-d'),
                'episode_number' => $episode['episode_number'],
                'name' => $episode['name'],
                'season_number' => $season_number,
                'still_path_hotlink' => $data['pic_url'],
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
                0 => ['quality', 'Full HD'],
                1 => ['language', 'Vietsub'],
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
                'link'      => $episode['link_embed'],
            );

            update_term_meta( $cid, 'trglinks_0', serialize( $links ) );
            update_term_meta( $cid, 'trglinks_1', serialize( array_merge($links, array( 'server' => $terms_data['sub_server'], 'link' => $episode['link_m3u8'] )) ) );
            update_term_meta( $cid, 'trgrabber_tlinks', 2 );
            }

        $term_id_season = tr_grabber_list_seasons($post_id, $season_number);
        update_term_meta( $term_id_season[0]->term_id, 'number_of_episodes', tr_grabber_count_episodes( $post_id, $season_number, false ) );
        update_post_meta( $post_id, 'number_of_episodes', tr_grabber_count_episodes($post_id, $season_number, false) );
    }

    /**
	 * Save movie thumbail to WP
	 *
	 * @param  string   $image_url   thumbail url
	 */
    public function save_images($image_url)
    {
        require_once( ABSPATH . "wp-admin/includes/file.php");

        $temp_file = download_url( $image_url, 300 );
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
            );
        
            // Move the temporary file into the uploads directory.
            $results = wp_handle_sideload( $file, $overrides );
            unlink($temp_file);
        
            if ( ! empty( $results['error'] ) ) {
                return false;
            } else {
                return $results;
            }
        }
    }

    /**
	 * Uppercase the first character of each word in a string
	 *
	 * @param  string   $string     format string
	 * @param  array    $arr        string array
	 */
    private function format_text($string)
    {
        $string = str_replace(array('/','，','|','、',',,,'),',',$string);
        $arr = explode(',', sanitize_text_field($string));
        foreach ($arr as &$item) {
            $item = ucwords(trim($item));
        }
        return $arr;
    }

    /**
	 * Filter html tags in api response
	 *
	 * @param  string   $rs     response
	 * @param  array    $rs     response
	 */
    private function filter_tags($rs)
    {
        $rex = array('{:','<script','<iframe','<frameset','<object','onerror');
        if(is_array($rs)){
            foreach($rs as $k2=>$v2){
                if(!is_numeric($v2)){
                    $rs[$k2] = str_ireplace($rex,'*',$rs[$k2]);
                }
            }
        }
        else{
            if(!is_numeric($rs)){
                $rs = str_ireplace($rex,'*',$rs);
            }
        }
        return $rs;
    }

    /**
	 * Get eposide url
	 *
	 * @param  string    $servers_str
	 * @param  string    $note
	 * @param  string    $urls_str
	 */
    private function get_play_url($servers_str, $note, $urls_str)
    {
        $servers = explode($note, $servers_str);
        $urls = explode($note, $urls_str);
        $server_add = array();
        $ep_data = [];
        $ep_data_m3u8 = [];
        foreach ( $servers as $key => $server_name ) {
            $episodes = explode('#', $urls[$key]);
            foreach ($episodes as $key => $value) {
                if ($value == "") {
                    continue;
                }
                list($title, $url) = explode("$", $value);
                $ep_data[$key]['episode_number'] = $key + 1;
                if ( empty($url) || strpos($title, 'http') !== false ) {
                    $url = $title;
                    $title = 'Tập ' . ($key + 1);
                }
                $url = trim(preg_replace('/\\\t/', '', $url));
                $ep_data[$key]['name'] = trim($title);
                if ( strpos($url, 'm3u8') !== false ) {
                    $ep_data_m3u8[$key]['link_m3u8'] = base64_encode(stripslashes(esc_textarea($url)));
                } else {
                    $ep_data[$key]['link_embed'] = base64_encode(stripslashes(esc_textarea($url)));
                }
            }
        }
        foreach ($ep_data as $key => $url) {
            $server_add[$key] = [
                'name' => $url['name'],
                'episode_number' => $url['episode_number'],
                'link_embed' => $url['link_embed'],
                'link_m3u8' => $ep_data_m3u8[$key]['link_m3u8']
            ];
        }
        return $server_add;
    }
}
