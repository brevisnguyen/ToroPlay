<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function save_post_series($post_id) {
    
	if ( $parent_id = wp_is_post_revision( $post_id ) ) 
		$post_id = $parent_id;
    
    $post_type = get_post_type($post_id);

    if ( "series" != $post_type ) return;
    
    if ( tr_grabber_type() != 2 ) return;
    
    if ( isset($_REQUEST['action']) and $_REQUEST['action'] == 'trash' or isset($_REQUEST['action']) and $_REQUEST['action'] == 'untrash' ) return;

    remove_action( 'save_post', 'save_post_series' );
    
    if ( isset($_POST['trgrabber_id']) and !empty($_POST['trgrabber_id']) ) {
        
        $upload_dir = wp_upload_dir();
        
        $grabber = trgrabber_curl( esc_url_raw( 'https://api.themoviedb.org/3/tv/'.$_POST['trgrabber_id'].'?api_key='.TR_GRABBER_API_KEY.'&language='.TR_GRABBER_LANG ) );

        $grabber = json_decode($grabber, true);
        
        $grabber_videos = trgrabber_curl( esc_url_raw( 'https://api.themoviedb.org/3/tv/'.$_POST['trgrabber_id'].'/videos?api_key='.TR_GRABBER_API_KEY.'&language='.TR_GRABBER_LANG ) );

        $grabber_videos = json_decode($grabber_videos, true);
        
        $grabber_credits = trgrabber_curl( esc_url_raw( 'https://api.themoviedb.org/3/tv/'.$_POST['trgrabber_id'].'/credits?api_key='.TR_GRABBER_API_KEY.'&language='.TR_GRABBER_LANG ) );

        $grabber_credits = json_decode($grabber_credits, true);
                
		wp_update_post( array( 'ID' => $post_id, 'post_status' => TR_GRABBER_POST_STATUS, 'post_title' => isset($grabber['name']) ? stripslashes($grabber['name']) : '', 'post_name' => isset($grabber['name']) ? stripslashes($grabber['name']) : '', 'post_content' => isset($grabber['overview']) ? stripslashes($grabber['overview']) : '' ) );
        
        if( TR_GRABBER_UPLOAD_IMAGES == 1 ) {

            // poster
            
            if( isset( $grabber['poster_path'] ) ) {
                
                if ( is_rtl() ) { $title_img = md5(sanitize_title($grabber['name'])); }else{ $title_img = sanitize_title($grabber['name']); }
                
                copy( esc_url_raw( 'http://image.tmdb.org/t/p/original/'.$grabber['poster_path'] ), $upload_dir['path'].'/'.$title_img.'-'.$post_id.'-poster.jpg');

                $attachment = array(
                    'guid' => $upload_dir['path'].'/'.$title_img.'-'.$post_id.'-poster.jpg', 
                    'post_mime_type' => 'image/jpeg',
                    'post_title' => $title_img.'-'.$post_id.'-poster.jpg',
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

                $attach_id = wp_insert_attachment( $attachment, $upload_dir['path'].'/'.$title_img.'-'.$post_id.'-poster.jpg',$post_id);

                require_once(ABSPATH . 'wp-admin/includes/image.php');

                $attach_data = wp_generate_attachment_metadata( $attach_id, $upload_dir['path'].'/'.$title_img.'-'.$post_id.'-poster.jpg' );
                wp_update_attachment_metadata( $attach_id, $attach_data );

                set_post_thumbnail($post_id, $attach_id);
            }
            
            // backdrop
            
            if( isset( $grabber['backdrop_path'] ) ) {

                if ( is_rtl() ) { $title_backdrop = md5(sanitize_title($grabber['name'])); }else{ $title_backdrop = sanitize_title($grabber['name']); }

                copy( esc_url_raw( 'http://image.tmdb.org/t/p/original/'.$grabber['backdrop_path'] ), $upload_dir['path'].'/'.$title_backdrop.'-'.$post_id.'-backdrop.jpg');

                $image = wp_get_image_editor( $upload_dir['path'].'/'.$title_backdrop.'-'.$post_id.'-backdrop.jpg' );

                if ( ! is_wp_error( $image ) ) {
                    $image->resize( TR_GRABBER_BACKDROP_WIDTH, TR_GRABBER_BACKDROP_HEIGHT, false );
                    $image->save( $upload_dir['path'].'/'.$title_backdrop.'-'.$post_id.'-backdrop.jpg' );
                }

                $attachment_backdrop = array(
                    'guid' => $upload_dir['path'].'/'.$title_backdrop.'-'.$post_id.'-backdrop.jpg', 
                    'post_mime_type' => 'image/jpeg',
                    'post_title' => $title_backdrop.'-'.$post_id.'-backdrop.jpg',
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

                $attach_id_backdrop = wp_insert_attachment( $attachment_backdrop, $upload_dir['path'].'/'.$title_backdrop.'-'.$post_id.'-backdrop.jpg',$post_id);

                $attach_data_backdrop = wp_generate_attachment_metadata( $attach_id_backdrop, $upload_dir['path'].'/'.$title_backdrop.'-'.$post_id.'-backdrop.jpg' );
                wp_update_attachment_metadata( $attach_id_backdrop, $attach_data_backdrop );

                $backdrop_id = $attach_id_backdrop;
                
            }

        }
        
        if( isset( $grabber_videos['results'][0]['site'] ) and $grabber_videos['results'][0]['site'] == 'YouTube' ) $youtube = $grabber_videos['results'][0]['key'];
                
        $array_post_meta = array(
        
            TR_GRABBER_ORIGINAL_TITLE => isset($grabber['original_name']) ? $grabber['original_name'] : '',
            
            TR_GRABBER_FIELD_TRAILER => isset( $youtube ) ? '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$youtube.'" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>' : '',
            
            TR_GRABBER_FIELD_ID => isset($grabber['id']) ? $grabber['id'] : '',

            TR_GRABBER_FIELD_IMDBID => isset($grabber['imdb_id']) ? $grabber['imdb_id'] : '',
            
            TR_GRABBER_FIELD_INPRODUCTION => isset($grabber['in_production']) ? $grabber['in_production'] : '',
            
            TR_GRABBER_FIELD_STATUS => isset($grabber['status']) ? $grabber['status'] : '',
            
            TR_GRABBER_POSTER_HOTLINK => isset($grabber['poster_path']) ? esc_url_raw( 'http://image.tmdb.org/t/p/original/'.$grabber['poster_path'] ) : '',
            
            TR_GRABBER_FIELD_BACKDROP_HOTLINK => isset($grabber['backdrop_path']) ? esc_url_raw( 'http://image.tmdb.org/t/p/original/'.$grabber['poster_path'] ) : '',
            
            TR_GRABBER_FIELD_DATE => isset($grabber['first_air_date']) ? $grabber['first_air_date'] : '',
            
            TR_GRABBER_FIELD_DATE_LAST => isset($grabber['last_air_date']) ? $grabber['last_air_date'] : '',
            
            TR_GRABBER_FIELD_RUNTIME => isset($grabber['episode_run_time']) ? $grabber['episode_run_time'] : '',
            
            TR_GRABBER_FIELD_NEPISODES => 0,
            
            TR_GRABBER_FIELD_NSEASONS => 0,
            
            TR_GRABBER_FIELD_BACKDROP => isset($backdrop_id) ? $backdrop_id : '',
            
        );
        
        if( isset($grabber['created_by']) ) {
        
            foreach ($grabber['created_by'] as $created_by) {
                $createdby_array[] = $created_by['name'];
            }

            wp_set_object_terms($post_id, $createdby_array, 'directors_tv');
            
        }
        
        if( isset( $grabber['genres'] ) ) {
            $geners_array = array();
            foreach ($grabber['genres'] as $geners) {
                $geners_array[] = $geners['name'];
            }

            wp_set_object_terms($post_id, $geners_array, 'category');
        }
        
        if( isset($grabber_credits['cast']) ) {
        
            foreach ($grabber_credits['cast'] as $cast) {
                $cast_array[] = $cast['name'];
                $cast_array_image[] = $cast['profile_path'];
            }

            if( isset($cast_array) ) {

                $term_taxonomy_ids = wp_set_object_terms($post_id, $cast_array, 'cast_tv');

                for ($casti = 0; $casti <= count($term_taxonomy_ids)-1; $casti++) {

                $term_ex = term_exists($cast_array[$casti], 'cast_tv');

                    if ( !empty($term_ex) ) {

                        if($cast_array_image[$casti]!=''){
                            update_term_meta($term_taxonomy_ids[$casti], 'image_hotlink', $cast_array_image[$casti]);
                        }

                    }

                }
            }
            
        }
        
    }
        
    if( empty($_POST['trgrabber_id']) ) {
        
        if( isset($_POST['duration']) ) { $duration = is_array($_POST['duration']) ? $_POST['duration'] : array($_POST['duration']); }
        
        $array_post_meta = array(
        
            TR_GRABBER_ORIGINAL_TITLE => isset($_POST['original_title']) ? $_POST['original_title'] : '',
            
            TR_GRABBER_FIELD_INPRODUCTION => isset($_POST['in_production']) ? intval($_POST['in_production']) : '',
            
            TR_GRABBER_FIELD_STATUS => isset($_POST['status']) ? $_POST['status'] : '',
            
            TR_GRABBER_FIELD_BACKDROP_HOTLINK => isset($_POST['backrop_hotlink']) ? $_POST['backrop_hotlink'] : '',
            
            TR_GRABBER_POSTER_HOTLINK => isset($_POST['poster_hotlink']) ? $_POST['poster_hotlink'] : '',
            
            TR_GRABBER_FIELD_RUNTIME => isset($duration) ? $duration : '',
            
            TR_GRABBER_FIELD_DATE => isset($_POST['first_air_date']) ? $_POST['first_air_date'] : '',
            
            TR_GRABBER_FIELD_DATE_LAST => isset($_POST['last_air_date']) ? $_POST['last_air_date'] : '',
            
            TR_GRABBER_FIELD_TRAILER => isset($_POST['trailer']) ? esc_textarea( $_POST['trailer'] ) : ''
            
        );
        
    }
    
    if( isset($array_post_meta) ) {
        foreach ( $array_post_meta as $key => $value ) {
            
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
    
    update_post_meta( $post_id, 'tr_post_type', 2 );
    
    add_action( 'save_post', 'save_post_series' );
}
add_action( 'save_post', 'save_post_series' );