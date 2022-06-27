<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'wp_ajax_grabberepisodes', 'grabberepisodes_function' );

function grabberepisodes_function() {
    
    if(session_id() == '')
     session_start();
    
    if (defined('TR_GRABBER_TIMELIMIT') && TR_GRABBER_TIMELIMIT) { set_time_limit( TR_GRABBER_TIMELIMIT ); }
    if (defined('TR_GRABBER_MEMOYLIMIT') && TR_GRABBER_MEMOYLIMIT) { ini_set('memory_limit', TR_GRABBER_MEMOYLIMIT); }
    
	check_ajax_referer( 'trstring', 'security' );
    
    $post_id = intval($_GET['id']) ? intval($_GET['id']) : 0;

    $name = get_the_title($post_id);
    
    $season_current = isset($_GET['season']) ? intval($_GET['season']) : 0;
    
    $name_session = $post_id.'-'.$season_current;
    
    if (!isset($_SESSION['episodes'][$name_session])) {
    
        $grabber = trgrabber_curl( esc_url_raw( 'https://api.themoviedb.org/3/tv/'.intval($_GET['timdb']).'/season/'.$season_current.'?api_key='.TR_GRABBER_API_KEY.'&language='.TR_GRABBER_LANG ) );

        $grabber = json_decode($grabber, true);

        $_SESSION[ 'episodes' ][$name_session] = $grabber['episodes'];
        
    }
    
    $eps = isset($_SESSION['episodes'][$name_session]) ? $_SESSION['episodes'][$name_session] : '';

        $nb_elem_per_page = 1;
        $page = isset($_GET['grabberp']) ? intval($_GET['grabberp']) : 0 ;
        $pagesum = isset( $page ) ? $page+1 : '';
        $data = (array) $eps;
        $number_of_pages = intval(count($data)/$nb_elem_per_page);
    
    if( isset($eps) ) {
        
        $episodes = tr_grabber_list_episodes( $post_id, $season_current );
        $array_episodes = array();
                
        foreach ($episodes as &$value_episode) {

            $array_episodes[] = get_term_meta( $value_episode->term_id, 'episode_number', true );
            
        }
        
        echo'<div class="ldngeps"><div class="loader loader--style1" title="0">
            <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
            <path opacity="0.2" fill="#0072d6" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
            s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
            c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
            <path fill="#0072d6" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
            C22.32,8.481,24.301,9.057,26.013,10.047z">
            <animateTransform attributeType="xml"
            attributeName="transform"
            type="rotate"
            from="0 20 20"
            to="360 20 20"
            dur="0.5s"
            repeatCount="indefinite"/>
            </path>
            </svg>
        </div>';
        
        foreach ( array_slice($data, $page*$nb_elem_per_page, $nb_elem_per_page) as $p ) {

            if( isset( $array_episodes ) and !in_array($p['episode_number'], $array_episodes) ) {
            
                $n = $p['season_number'] == 0 ? $name.' '.__('Specials', 'tr-grabber').' '.$p['episode_number'] : $name.' '.$p['season_number'].'x'.$p['episode_number'];

                $cid = wp_insert_term($n, 'episodes' );        
                $cid = ! is_wp_error( $cid ) ? intval($cid['term_id']) : intval($cid->error_data['term_exists']);

                wp_set_object_terms($post_id, $cid, 'episodes', true);
            }
            
            echo '<p class="ldngtx"><span id="content">'.$p['episode_number'].' / '.$number_of_pages.'</span></p>';
            
            if( isset($p['guest_stars']) ) {
                $array_guest_stars = $p['guest_stars'];

                foreach ($array_guest_stars as &$value_guest_stars) {
                    $ar_gueststars_comms[]= $value_guest_stars['name'];
                }
            }
                        
            if( TR_GRABBER_UPLOAD_IMAGES == 1 and isset($p['still_path']) and isset( $array_episodes ) and !in_array($p['episode_number'], $array_episodes) ) {
                
                $upload_dir = wp_upload_dir();                
                
                if ( is_rtl() ) { $title_img = md5(sanitize_title($name)); }else{ $title_img = sanitize_title($name); }
                
                copy( esc_url_raw( 'https://image.tmdb.org/t/p/original/'.$p['still_path'] ), $upload_dir['path'].'/'.$title_img.'-'.$cid.'-episode-'.$p['episode_number'].'-season-'.$p['season_number'].'.jpg');

                $image = wp_get_image_editor( $upload_dir['path'].'/'.$title_img.'-'.$cid.'-episode-'.$p['episode_number'].'-season-'.$p['season_number'].'.jpg' );

                if ( ! is_wp_error( $image ) ) {
                    $image->resize( TR_GRABBER_EPISODE_WIDTH, TR_GRABBER_EPISODE_HEIGHT, false );
                    $image->save( $upload_dir['path'].'/'.$title_img.'-'.$cid.'-episode-'.$p['episode_number'].'-season-'.$p['season_number'].'.jpg' );
                }

                $attachment_episode = array(
                    'guid' => $upload_dir['path'].'/'.$title_img.'-'.$cid.'-episode-'.$p['episode_number'].'-season-'.$p['season_number'].'.jpg', 
                    'post_mime_type' => 'image/jpeg',
                    'post_title' => $title_img.'-'.$cid.'-episode-'.$p['episode_number'].'-season-'.$p['season_number'].'.jpg',
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

                $attach_id_episode = wp_insert_attachment( $attachment_episode, $upload_dir['path'].'/'.$title_img.'-'.$cid.'-episode-'.$p['episode_number'].'-season-'.$p['season_number'].'.jpg',$post_id);

                $attach_data_episode = wp_generate_attachment_metadata( $attach_id_episode, $upload_dir['path'].'/'.$title_img.'-'.$cid.'-episode-'.$p['episode_number'].'-season-'.$p['season_number'].'.jpg' );
                wp_update_attachment_metadata( $attach_id_episode, $attach_data_episode );

                $poster_path_episode = $attach_id_episode;

            }
            
            $array_post_meta = array(
                
                'air_date' => isset($p['air_date']) ? $p['air_date'] : '',
                'episode_number' => isset($p['episode_number']) ? $p['episode_number'] : '',
                'name' => isset($p['name']) ? $p['name'] : '',
                'overview' => isset($p['overview']) ? $p['overview'] : '',
                'id' => isset($p['id']) ? $p['id'] : '',
                'season_number' => isset($p['season_number']) ? $p['season_number'] : '',
                'still_path_hotlink' => isset($p['still_path']) ? $p['still_path'] : '',
                'still_path' => isset($poster_path_episode) ? $poster_path_episode : '',
                'guest_stars' => isset($ar_gueststars_comms) ? implode(', ', $ar_gueststars_comms) : '',
                'tr_id_post' => $post_id,
                //'number_of_episodes' => tr_grabber_count_episodes( $post_id, $season_current, false ),
                'season_special' => $p['season_number'] == 0 ? 1 : ''
            );
                        
            if( isset($array_post_meta) and isset( $array_episodes ) and !in_array($p['episode_number'], $array_episodes) ) {
                                
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
            $vars_replace = array( get_the_title( get_term_meta( $cid, 'tr_id_post', true ) ), $array_post_meta['season_number'], $array_post_meta['episode_number'] );

            $slug_episodes = str_replace( $vars, $vars_replace, $slug_episodes );
            $name_episodes = str_replace( $vars, $vars_replace, $name_episodes );
            $subtitle_episodes = str_replace( $vars, $vars_replace, $subtitle_episodes );

            wp_update_term( $cid, 'episodes', array(
              'name' => $name_episodes,
              'slug' => $slug_episodes
            ));
            
            $episode_number = $p['episode_number'];
                        
        }
        
        $term_id_season = tr_grabber_list_seasons($post_id, $season_current);

        update_term_meta( $term_id_season[0]->term_id, 'number_of_episodes', tr_grabber_count_episodes( $post_id, $season_current, false ) );
        
        $div = round($episode_number / $number_of_pages*100);
        $div = empty($div) ? 0 : $div;
        
        echo '
            <div class="trgrabber_loading"><span class="grabberporc">'.$div.'%</span><span style="width:'.$div.'%;"></span></div></div>
        ';
        
?>
<script type="text/javascript">
<?php if( $number_of_pages > $page ) { ?>
window.onload = function() {
  window.location.href = "<?php echo htmlspecialchars_decode(wp_nonce_url(admin_url('admin-ajax.php?action=grabberepisodes&timdb='.intval($_GET['timdb']).'&id='.intval($_GET['id']).'&grabberp='.$pagesum.'&season='.$season_current ), 'trstring', 'security')); ?>";
}
<?php
} else {
update_post_meta( $post_id, TR_GRABBER_FIELD_NEPISODES, tr_grabber_count_episodes($post_id, NULL, false) );
unset($_SESSION['episodes'][$name_session]);    
?>
if (window.top.location != document.location) {
    window.top.location.href = '<?php echo admin_url('post.php?post='.$post_id.'&action=edit'); ?>';
}
<?php }  ?>
</script>
<style>
    body{margin: 0;}
    .ldngeps{text-align: center;font-family: sans-serif;padding-top: 15px;}
    .trgrabber_loading,.trgrabber_loading span{border-radius: 15px;}
    .trgrabber_loading{position: relative;padding: 5px;background-color: #0072d6;}
    .trgrabber_loading span{display: block;min-height: 20px;line-height: 20px;font-size: 12px;font-weight: 700;box-shadow: inset 0 -10px 15px rgba(0,0,0,.2);box-shadow: inset 0 -10px 15px rgba(0,0,0,.2);background-color: rgba(0,0,0,.5);}
    .trgrabber_loading span.grabberporc{position: absolute;left: 0;right: 0;top: 5px;margin: auto;color: #fff;background: none;box-shadow: none;}
    .ldngtx #content{font-weight: 700;}
</style>
<?php
    }
    
	wp_die();
}