<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function save_post_movies($post_id) {
    
	if ( $parent_id = wp_is_post_revision( $post_id ) ) 
		$post_id = $parent_id;
    
    $post_type = get_post_type($post_id);

    if ( "movies" != $post_type ) return;

    if ( tr_grabber_type() != 1 ) return;
    
    if ( isset($_REQUEST['action']) and $_REQUEST['action'] == 'trash' or isset($_REQUEST['action']) and $_REQUEST['action'] == 'untrash' ) return;

    remove_action( 'save_post', 'save_post_movies' );
        
	if ( isset($_POST['trgrabber_id']) ) {

        $grabber = trgrabber_curl( esc_url_raw( 'https://api.themoviedb.org/3/movie/'.$_POST['trgrabber_id'].'?append_to_response=images,trailers&api_key='.TR_GRABBER_API_KEY.'&language='.TR_GRABBER_LANG ) );

        $grabber = json_decode($grabber, true);
        
        $grabber_credits = trgrabber_curl( esc_url_raw( 'https://api.themoviedb.org/3/movie/'.$_POST['trgrabber_id'].'/credits?api_key='.TR_GRABBER_API_KEY.'&language='.TR_GRABBER_LANG.'&append_to_response=images,trailers' ) );

        $grabber_credits = json_decode($grabber_credits, true);
        
		wp_update_post( array( 'ID' => $post_id, 'post_status' => TR_GRABBER_POST_STATUS, 'post_title' => isset($grabber['title']) ? stripslashes($grabber['title']) : '', 'post_name' => isset($grabber['title']) ? stripslashes($grabber['title']) : '', 'post_content' => isset($grabber['overview']) ? stripslashes($grabber['overview']) : '' ) );
        
        if( isset( $grabber['trailers']['youtube'] ) ) {
            $trailer = $grabber['trailers']['youtube'];
            foreach ($trailer as $key) {
                $youtube = $key['source'];
            }
        }
        
        if( isset( $grabber['runtime'] ) ) {
            $hours = ltrim(gmdate("i", $grabber['runtime']), 0);
            $minutes = ltrim(gmdate("s", $grabber['runtime']), 0);

            $hours = empty($hours) ? 0 : $hours;
            $minutes = empty($minutes) ? 0 : $minutes;
        }
        
        if( isset( $grabber['genres'] ) ) {
            $geners_array = array();
            foreach ($grabber['genres'] as $geners) {
                $geners_array[] = $geners['name'];
            }

            wp_set_object_terms($post_id, $geners_array, 'category');
        }
        
        if( isset( $grabber['production_countries'] ) ) {
            $countries_array = array();
            foreach ($grabber['production_countries'] as $country) {
                $countries_array[] = $country['name'];
            }

            wp_set_object_terms($post_id, $countries_array, 'country');
        }

        if( isset( $grabber_credits['crew'] ) ) {
            $crew_array = array();
            foreach ($grabber_credits['crew'] as $crew) {
                if($crew['department']=='Directing'){ $crew_array[] = $crew['name']; }
            }

            wp_set_object_terms($post_id, $crew_array, 'directors');
        }

        if( isset( $grabber_credits['cast'] ) ) {
        
            $cast_array = array(); $cast_array_image = array();
            
            foreach ($grabber_credits['cast'] as $cast) {
                $cast_array[] = $cast['name'];
                $cast_array_image[] = $cast['profile_path'];
            }

            $term_taxonomy_ids = wp_set_object_terms($post_id, $cast_array, 'cast');

            for ($casti = 0; $casti <= count($term_taxonomy_ids)-1; $casti++) {

                $term_ex = term_exists($cast_array[$casti], 'cast');

                if (!empty($term_ex)) {

                    if($cast_array_image[$casti]!=''){
                        update_term_meta($term_taxonomy_ids[$casti], 'image_hotlink', $cast_array_image[$casti]);
                    }

                }

            }
        }
        
        if( TR_GRABBER_UPLOAD_IMAGES == 1 ) {
            
            $upload_dir = wp_upload_dir();
            
            if( isset( $grabber['poster_path'] ) ) {

                if ( is_rtl() ) { $title_img = md5(sanitize_title($grabber['title'])); }else{ $title_img = sanitize_title($grabber['title']); }

                copy( esc_url_raw( 'https://image.tmdb.org/t/p/original/'.$grabber['poster_path'] ), $upload_dir['path'].'/'.$title_img.'-'.$post_id.'-poster.jpg' );

                $attachment = array(
                    'guid' => $upload_dir['path'].'/'.sanitize_title($grabber['title']).'-'.$post_id.'-poster.jpg', 
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
            
            if( isset( $grabber['backdrop_path'] ) ) {
             
                if ( is_rtl() ) { $title_backdrop = md5(sanitize_title($grabber['title'])); }else{ $title_backdrop = sanitize_title($grabber['title']); }

                copy( esc_url_raw( 'https://image.tmdb.org/t/p/original/'.$grabber['backdrop_path'] ), $upload_dir['path'].'/'.$title_backdrop.'-'.$post_id.'-backdrop.jpg' );

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
        
        $array_post_meta = array(
        
            TR_GRABBER_ORIGINAL_TITLE => isset($grabber['original_title']) ? $grabber['original_title'] : '',
            
            TR_GRABBER_FIELD_TRAILER => isset($youtube) ? '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$youtube.'" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>' : '',
            
            TR_GRABBER_FIELD_ID => isset($grabber['id']) ? $grabber['id'] : '',

            TR_GRABBER_FIELD_IMDBID => isset($grabber['imdb_id']) ? $grabber['imdb_id'] : '',
            
            TR_GRABBER_FIELD_DATE => isset($grabber['release_date']) ? $grabber['release_date'] : '',
        
            TR_GRABBER_FIELD_YEAR => isset($grabber['release_date']) ? $grabber['release_date'] : '',
            
            TR_GRABBER_FIELD_RUNTIME => isset($grabber['runtime']) ? $hours.'h '.$minutes.'m' : '',
            
            TR_GRABBER_FIELD_BACKDROP => isset($backdrop_id) ? $backdrop_id : '',
            
            TR_GRABBER_FIELD_BACKDROP_HOTLINK => isset($grabber['backdrop_path']) ? esc_url_raw( 'https://image.tmdb.org/t/p/original/'.$grabber['poster_path'] ) : '',
            
            TR_GRABBER_POSTER_HOTLINK => isset($grabber['poster_path']) ? esc_url_raw( 'https://image.tmdb.org/t/p/original/'.$grabber['poster_path'] ) : '',
            
        );
                
	}
        
    if( empty($_POST['trgrabber_id']) ) {
        
        $array_post_meta = array(
        
            TR_GRABBER_ORIGINAL_TITLE => isset($_POST['original_title']) ? $_POST['original_title'] : '',
            
            TR_GRABBER_FIELD_TRAILER => isset($_POST['trailer']) ? esc_textarea( $_POST['trailer'] ) : '',
                        
            TR_GRABBER_FIELD_DATE => isset($_POST['release_date']) ? $_POST['release_date'] : '',
        
            TR_GRABBER_FIELD_YEAR => isset($_POST['release_date']) ? $_POST['release_date'] : '',
            
            TR_GRABBER_FIELD_RUNTIME => isset($_POST['duration']) ? $_POST['duration'] : '',
            
            TR_GRABBER_FIELD_BACKDROP => isset($_POST['backdrop_id']) ? intval($_POST['backdrop_id']) : '',
            
            TR_GRABBER_FIELD_BACKDROP_HOTLINK => isset($_POST['backrop_hotlink']) ? $_POST['backrop_hotlink'] : '',
            
            TR_GRABBER_POSTER_HOTLINK => isset($_POST['poster_hotlink']) ? $_POST['poster_hotlink'] : '',
            
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
            
    // links movies
    $total = get_post_meta( $post_id, 'trgrabber_tlinks', true ) == '' ? 0 : get_post_meta( $post_id, 'trgrabber_tlinks', true )+1;
    if( isset( $total ) and isset( $_POST['trgrabber_link'] ) and $total > 0 and count( array_filter( $_POST['trgrabber_link'] ) ) < $total ) {
        for ($iii = 0; $iii <= $total; $iii++) { delete_post_meta( $post_id, 'trglinks_'.$iii ); }
        delete_post_meta( $post_id, 'trgrabber_tlinks' );
    }
    
    if( isset( $_POST['trgrabber_link'] ) and !empty( array_filter( $_POST['trgrabber_link'] ) ) > 0 and tr_grabber_type() == 1 ) {
        
        $i = 0; $count = ''; $array_links = array(); $server_id = array();
        
        foreach (  array_filter( $_POST['trgrabber_link'] ) as $key => $value ) {
                        
            //if( empty( $_POST['trgrabber_server'][$i] ) ) {
                
                preg_match( '@((https?://)?([-\\w]+\\.[-\\w\\.]+)+\\w(:\\d+)?(/([-\\w/_\\.]*(\\?\\S+)?)?)*)@', $_POST['trgrabber_link'][$i], $a );
                
                if(!empty($a[0])) {
                    
                    $url = wp_parse_url( str_replace( 'https://www.', 'https://' ,str_replace('http://www.', 'http://', $a[0]) ) );
                                        
                    if( isset( $url['host'] ) ) {
                        
                        $explode = explode('.', $url['host']);

                        $term_server = term_exists(ucwords( $explode[0] ), 'server');

                        if ($term_server !== 0 && $term_server !== null) {

                            $server_id[$i] = $term_server['term_id'];

                        } else {


                            $insert_server = wp_insert_term(ucwords( $explode[0] ), 'server', array());

                            $server_id[$i] = $insert_server['term_id'];

                        }
                                                
                    }
                    
                }else {
                    
                    $server_id[$i] = '';
                
                }
                                
            //}
            
            if( isset( $_POST['trgrabber_lang'][$i] ) and !empty( $_POST['trgrabber_lang'][$i] ) ) {
                
                if( intval( $_POST['trgrabber_lang'][$i] ) ) {
                    $lang_id = intval( $_POST['trgrabber_lang'][$i] );
                }else {
                    
                    $term_lang = term_exists(ucwords( $_POST['trgrabber_lang'][$i] ), 'language');

                    if ($term_lang !== 0 && $term_lang !== null) {

                        $lang_id = $term_lang['term_id'];

                    } else {


                        $insert_lang = wp_insert_term(ucwords( $_POST['trgrabber_lang'][$i] ), 'language', array());

                        $lang_id = $insert_lang['term_id'];

                    }
                    
                }
                
            }
            
            if( isset( $_POST['trgrabber_quality'][$i] ) and !empty( $_POST['trgrabber_quality'][$i] ) ) {
                
                if( intval( $_POST['trgrabber_quality'][$i] ) ) {
                    $quality_id = intval( $_POST['trgrabber_quality'][$i] );
                }else {
                    
                    $term_quality = term_exists(ucwords( $_POST['trgrabber_quality'][$i] ), 'quality');

                    if ($term_quality !== 0 && $term_quality !== null) {

                        $quality_id = $term_quality['term_id'];

                    } else {


                        $insert_quality = wp_insert_term(ucwords( $_POST['trgrabber_quality'][$i] ), 'quality', array());

                        $quality_id = $insert_quality['term_id'];

                    }
                    
                }
                
            }
                                                
            $array_links[$i] = array(
            
                'type' => get_term_meta($server_id[$i], 'type', true) == '' ? $_POST['trgrabber_type'][$i] : get_term_meta($server_id[$i], 'type', true),
                'server' => empty($server_id[$i]) ? '' : $server_id[$i],
                'lang' => isset( $_POST['trgrabber_lang'][$i] ) ? $lang_id : '',
                'quality' => isset( $_POST['trgrabber_quality'][$i] ) ? $quality_id : '',
                'link' => isset( $_POST['trgrabber_link'][$i] ) ? base64_encode ( stripslashes( esc_textarea( $_POST['trgrabber_link'][$i] ) ) ) : '',
                'date' => !empty( $_POST['trgrabber_date'][$i] ) ? $_POST['trgrabber_date'][$i] : date('d').'/'.date('m').'/'.date('Y'),
                
            );
            
            if( isset($array_links[$i]['link']) and !empty($array_links[$i]['link']) ) { $count .= $i.','; update_post_meta( $post_id, 'trglinks_'.$i, serialize( $array_links[$i] ) ); }
            
            $i++;
            
        }
                
        if( isset( $count ) and !empty( $count ) ) update_post_meta( $post_id, 'trgrabber_tlinks', count( $array_links ) );
        
    }
        
    add_action( 'save_post', 'save_post_movies' );
}
add_action( 'save_post', 'save_post_movies' );