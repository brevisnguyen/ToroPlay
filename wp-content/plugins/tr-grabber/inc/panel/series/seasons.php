<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'wp_ajax_grabberseasons', 'grabberseasons_function' );

function grabberseasons_function() {
    
    if(session_id() == '')
     session_start();
    
    if (defined('TR_GRABBER_TIMELIMIT') && TR_GRABBER_TIMELIMIT) { set_time_limit( TR_GRABBER_TIMELIMIT ); }
    if (defined('TR_GRABBER_MEMOYLIMIT') && TR_GRABBER_MEMOYLIMIT) { ini_set('memory_limit', TR_GRABBER_MEMOYLIMIT); }
    
	check_ajax_referer( 'trstring', 'security' );
    
    $post_id = intval($_GET['id']);
    
    $name = get_the_title($post_id);
        
    $name_session = $post_id;
            
    if (!isset($_SESSION['seasons'][$name_session])) {
    
        $grabber = trgrabber_curl( esc_url_raw('https://api.themoviedb.org/3/tv/'.intval($_GET['timdb']).'?api_key='.TR_GRABBER_API_KEY.'&language='.TR_GRABBER_LANG ) );
        
        $grabber = json_decode($grabber, true);

        if( TR_GRABBER_SPECIAL_SEASON == 0 ) {
            $grabber['seasons'] = trgrabberremoveElementWithValue($grabber['seasons'], "season_number", 0);
        }
        
        $_SESSION[ 'seasons' ][$name_session] = $grabber['seasons'];
        
    }
            
    $ses = isset($_SESSION['seasons'][$name_session]) ? $_SESSION['seasons'][$name_session] : '';
    $nb_elem_per_page = 1;
    $page = isset($_GET['grabberp']) ? intval($_GET['grabberp']) : 0 ;
    $pagesum = isset( $page ) ? $page+1 : '';
    $data = (array) $ses;
    $number_of_pages = intval(count($data)/$nb_elem_per_page);
            
    if( isset($ses) ) {
        
        $seasons_list = tr_grabber_list_seasons( $post_id );
        $array_seasons = array();

        foreach ($seasons_list as &$value_season) {

            $array_seasons[] = get_term_meta( $value_season->term_id, 'season_number', true );
            
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
            
            $number = $p['season_number'] == 0 ? __('Specials', 'tr-grabber') : $p['season_number'];
                        
            if( isset( $array_seasons ) and !in_array($p['season_number'], $array_seasons) ) {
            
                $cid = wp_insert_term($name.' '.$number, 'seasons' );        
                $cid = ! is_wp_error( $cid ) ? intval($cid['term_id']) : intval($cid->error_data['term_exists']);

                wp_set_object_terms($post_id, $cid, 'seasons', true);

                $grabber_season = trgrabber_curl( esc_url_raw('https://api.themoviedb.org/3/tv/'.intval($_GET['timdb']).'/season/'.intval($p['season_number']).'?api_key='.TR_GRABBER_API_KEY.'&language='.TR_GRABBER_LANG ) );

                $grabber_season = json_decode($grabber_season, true);
                
            }
            
            echo '<p class="ldngtx"><span id="content">'.$p['season_number'].' / '.$number_of_pages.'</span></p>';
            
            if( TR_GRABBER_UPLOAD_IMAGES == 1 and isset($p['poster_path']) and isset( $array_seasons ) and !in_array($p['season_number'], $array_seasons) ) {
                
                $upload_dir = wp_upload_dir();

                if ( is_rtl() ) { $title_img = md5(sanitize_title($p['name'])); }else{ $title_img = sanitize_title($p['name']); }

                copy( esc_url_raw( 'https://image.tmdb.org/t/p/original/'.$p['poster_path'] ), $upload_dir['path'].'/'.$title_img.'-'.$cid.'-season-'.$p['season_number'].'.jpg');

                $image = wp_get_image_editor( $upload_dir['path'].'/'.$title_img.'-'.$cid.'-season-'.$p['season_number'].'.jpg' );

                if ( ! is_wp_error( $image ) ) {
                    $image->resize( TR_GRABBER_SEASON_WIDTH, TR_GRABBER_SEASON_HEIGHT, false );
                    $image->save( $upload_dir['path'].'/'.$title_img.'-'.$cid.'-season-'.$p['season_number'].'.jpg' );
                }

                $attachment_season = array(
                    'guid' => $upload_dir['path'].'/'.$title_img.'-'.$cid.'-season-'.$p['season_number'].'.jpg', 
                    'post_mime_type' => 'image/jpeg',
                    'post_title' => $title_img.'-'.$cid.'-season-'.$p['season_number'].'.jpg',
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

                $attach_id_season = wp_insert_attachment( $attachment_season, $upload_dir['path'].'/'.$title_img.'-'.$cid.'-season-'.$p['season_number'].'.jpg',$post_id);

                $attach_data_season = wp_generate_attachment_metadata( $attach_id_season, $upload_dir['path'].'/'.$title_img.'-'.$cid.'-season-'.$p['season_number'].'.jpg' );
                wp_update_attachment_metadata( $attach_id_season, $attach_data_season );

                $poster_path_seasons = $attach_id_season;

            }
            
            $array_post_meta = array(
                
                'air_date' => isset($p['air_date']) ? $p['air_date'] : '',
                'name' => isset($grabber_season['name']) ? $grabber_season['name'] : '',
                'id' => isset($grabber_season['id']) ? $grabber_season['id'] : '',
                'overview' => isset($grabber_season['overview']) ? $grabber_season['overview'] : '',
                'poster_path_hotlink' => isset($p['poster_path']) ? $p['poster_path'] : '',
                'poster_path' => $poster_path_seasons,
                'number_of_episodes' => isset($p['episodes']) ? count($p['episodes']) : 0,
                'tr_id_post' => $post_id,
                
            );
            
            if( isset($array_post_meta) and isset( $array_seasons ) and !in_array($p['season_number'], $array_seasons) ) {
                                
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
            
            update_term_meta( $cid, 'season_number', $p['season_number'] );
            
            if( $p['season_number'] == 0 ){ update_term_meta( $cid, 'season_special', 1 ); }
            
            $slug_seasons = TR_GRABBER_SLUG_SEASONS;
            $name_seasons = TR_GRABBER_TITLE_SEASONS;
            $subtitle_seasons = TR_GRABBER_SUBTITLE_SEASONS;

            $vars = array( '{name}', '{season}' );
            $vars_replace = array( get_the_title( get_term_meta( $cid, 'tr_id_post', true ) ), get_term_meta( $cid, 'season_number', true ) );

            $slug_seasons = str_replace( $vars, $vars_replace, $slug_seasons );
            $name_seasons = str_replace( $vars, $vars_replace, $name_seasons );
            $subtitle_seasons = str_replace( $vars, $vars_replace, $subtitle_seasons );
            
            wp_update_term( $cid, 'seasons', array(
              'name' => $name_seasons,
              'slug' => $slug_seasons
            ));
            
            $season_number = $p['season_number'];
            
            update_term_meta( $cid, 'number_of_episodes', 0 );
            
        }
        
        $div = round($season_number / $number_of_pages*100);
        $div = empty($div) ? 0 : $div;
        
        echo '
            <div class="trgrabber_loading"><span class="grabberporc">'.$div.'%</span><span style="width:'.$div.'%;"></span></div></div>
        ';

?>
<script type="text/javascript">
<?php if( $number_of_pages > $page ) { ?>
window.onload = function() {
  window.location.href = "<?php echo htmlspecialchars_decode(wp_nonce_url(admin_url('admin-ajax.php?action=grabberseasons&timdb='.intval($_GET['timdb']).'&id='.intval($_GET['id']).'&grabberp='.$pagesum ), 'trstring', 'security')); ?>";
}
<?php
} else {
update_post_meta( $post_id, TR_GRABBER_FIELD_NSEASONS, tr_grabber_count_seasons($post_id, false) );
unset($_SESSION['seasons'][$name_session]);   
?>
if (window.top.location != document.location) {
    window.top.location.href = '<?php echo admin_url('post.php?post='.$post_id.'&action=edit'); ?>';
}
<?php } ?>
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