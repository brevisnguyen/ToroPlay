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
			'post_type' => 'series',
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

                $this->links_series($post->ID, $movie_data);
                update_post_meta( $post->ID, 'status', $movie_data['episode'] );
                
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
            $this->links_series($post_id, $movie_data);
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
            if($data['type_id'] == 1) {
                $type = "movies";
                $duration = empty($data['vod_weekday']) ? '0h 0m' : $data['vod_weekday'];
                $tr_post_type = 1;
            } else {
                $type	= "series";
                $tr_post_type = 2;
            }
            $categories = array_merge($this->format_text($data['type_name']), $this->format_text($data['vod_class']));
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

        $post_meta_movies = array(
            'field_title' => $data['org_title'],
            'field_date' => sanitize_text_field($data['year']),
            'field_release_year' => sanitize_text_field($data['year']),
            'status' => $data['status'],
            'field_runtime' => $data['duration'],
            'tr_post_type' => $data['tr_post_type'],
            'poster_hotlink' => $data['pic_url'],
            'backdrop_hotlink' => 'https://www.themoviedb.org/t/p/original/5wNCVuZrR64t9DgpGk82z7vfLJt.jpg',
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
        // Fake Lang, Quality
        $quality_list = ['1080p', '720p', 'Full HD', 'HD'];
        $quality = $quality_list[random_int(0, 3)];
        $term_quality = term_exists(ucwords( $quality ), 'quality');
        if ($term_quality !== 0 && $term_quality !== null) {
            $quality_id = $term_quality['term_id'];
        } else {
            $insert_quality = wp_insert_term(ucwords( $quality ), 'quality', array());
            $quality_id = $insert_quality['term_id'];
        }

        $term_lang = term_exists(ucwords( 'Vietsub' ), 'language');
        if ($term_lang !== 0 && $term_lang !== null) {
            $lang_id = $term_lang['term_id'];
        } else {
            $insert_lang = wp_insert_term(ucwords( 'Vietsub' ), 'language', array());
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
        foreach ( $data['episodes'] as $key => $episode ) {

            $array_links[0] = array(
                'type'      => '1',
                'server'    => $server_id,
                'lang'      => $lang_id,
                'quality'   => $quality_id,
                'link'      => $episode['link_embed'],
                'date'      => date('d/m/Y'),
            );
            $array_links[1] = array(
                'type'      => '1',
                'server'    => $sub_server_id,
                'lang'      => $lang_id,
                'quality'   => $quality_id,
                'link'      => $episode['link_m3u8'],
                'date'      => date('d/m/Y'),
            );
            for ($i=0; $i < 2; $i++) { 
                update_post_meta( $post_id, 'trglinks_'.$i, serialize( $array_links[$i] ) );
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
        // Fake Lang, Quality, Server
        $quality_list = ['1080p', '720p', 'Full HD', 'HD'];
        $quality = $quality_list[random_int(0, 3)];
        $term_quality = term_exists(ucwords( $quality ), 'quality');
        if ($term_quality !== 0 && $term_quality !== null) {
            $quality_id = $term_quality['term_id'];
        } else {
            $insert_quality = wp_insert_term(ucwords( $quality ), 'quality', array());
            $quality_id = $insert_quality['term_id'];
        }

        $term_lang = term_exists(ucwords( 'Vietsub' ), 'language');
        if ($term_lang !== 0 && $term_lang !== null) {
            $lang_id = $term_lang['term_id'];
        } else {
            $insert_lang = wp_insert_term(ucwords( 'Vietsub' ), 'language', array());
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
            'poster_path_hotlink' => $data['pic_url'],
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

        foreach ( $data['episodes'] as $key => $episode ) {
            if( isset( $array_episodes ) and !in_array($episode['episode_number'], $array_episodes) ) {

                $n = $name.' '.$season_number.'x'.$episode['episode_number'];
                $term_episode = wp_insert_term($n, 'episodes' );
                $term_episode = ! is_wp_error( $term_episode ) ? intval($term_episode['term_id']) : intval($term_episode->error_data['term_exists']);
                wp_set_object_terms($post_id, $term_episode, 'episodes', true);

                $name_episodes = $name.' '.$season_number.'x'.$episode['episode_number']; // {name} {season}x{episode}
                $slug_episodes = sanitize_title($name . '-' . $season_number . 'x' . $episode['episode_number']); // {name}-{season}x{episode}
                wp_update_term( $term_episode, 'episodes', array(
                    'name' => $name_episodes,
                    'slug' => $slug_episodes
                ));

                $array_post_meta = array(
                    'air_date'              => date('Y-m-d'),
                    'episode_number'        => $episode['episode_number'],
                    'name'                  => $episode['name'],
                    'season_number'         => $season_number,
                    'still_path_hotlink'    => $data['pic_url'],
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
                    'link'      => $episode['link_embed'],
                    'date'      => date('d/m/Y'),
                );
                $array_links[1] = array(
                    'type'      => '1',
                    'server'    => $sub_server_id,
                    'lang'      => $lang_id,
                    'quality'   => $quality_id,
                    'link'      => $episode['link_m3u8'],
                    'date'      => date('d/m/Y'),
                );
                for ($i=0; $i < 2; $i++) { 
                    update_term_meta( $term_episode, 'trglinks_'.$i, serialize( $array_links[$i] ) );
                }
                update_term_meta( $term_episode, 'trgrabber_tlinks', 2 );
            }
        }
        update_term_meta( $term_seasons, 'number_of_episodes', count($data['episodes']) );
        update_post_meta( $post_id, 'number_of_episodes', count($data['episodes']) );
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
