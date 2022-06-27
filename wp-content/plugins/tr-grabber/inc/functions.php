<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function tr_grabber_function (){
    require_once(TR_GRABBER_PLUGIN_DIR.'inc/config/index.php');
}

function tr_grabber_meta_box() {
	add_meta_box(
		'tr_grabber_featured_meta_box',
		__('Backdrop', 'tr-grabber'),
		'tr_grabber_featured_meta_box_function',
		array('movies', 'series'),
		'side',
		'low'
	);
    
	add_meta_box(
		'additional_information_meta_box',
		__('Additional Information', 'tr-grabber'),
		'show_additional_information_meta_box',
		array('movies', 'series'),
		'normal',
		'high'
	);
            
    add_meta_box(
        'links_meta_box',
        __('Links', 'tr-grabber'),
        'show_links_meta_box',
        array('movies'),
        'normal',
        'low'
    );
        
}
add_action( 'add_meta_boxes', 'tr_grabber_meta_box' );

function tr_grabber_featured_meta_box_function( $post ) {
    
    $id = 'backdrop';
    $title = __('Backdrop', 'tr-grabber');
    $label_set = __('Set backdrop image', 'tr-grabber');
    $label_use = __('Use as backdrop', 'tr-grabber');
    $label_remove = __('Remove backdrop', 'tr-grabber');

    $photo_id = get_post_meta( $post->ID, TR_GRABBER_FIELD_BACKDROP, true );

    if( $photo_id ) {
        $link_title = wp_get_attachment_image( $photo_id, 'medium', false, array( 'style' => 'width:100%;height:auto;', ) );
        $hide_remove_button = '';
    }
    else {
        $photo_id = -1;
        $link_title = $label_set;
        $hide_remove_button = 'display: none;';
    }
    ?>

    <p class="hide-if-no-js trgrabber-image-container-<?php echo $id; ?>"><a href="#" class="trgrabber-add-media trgrabber-media-edit trgrabber-media-edit-<?php echo $id; ?>" data-title="<?php echo $title; ?>" data-button="<?php echo $label_use; ?>" data-id="<?php echo $id; ?>" data-postid="<?php echo $post->ID; ?>"><?php echo $link_title; ?></a></p>

    <p style="<?php echo $hide_remove_button; ?>"><a href="#" data-title="<?php echo $label_set; ?>" class="trgrabber-media-delete"><?php echo $label_remove; ?></a></p>
<?php   
}

function trgrabber_curl( $url ) {

    $output = '';
    
    $response = wp_remote_get( $url, array( 'sslverify' => false ) );
    if ( is_array( $response ) ) {
        $header = $response['headers'];
        $output = $response['body'];
    }

    return $output;
}

function tr_grabber_select_taxonomy( $tax, $select=0 ) {
    
    $return = '';
    
    $taxonomy = get_categories( array(
        'orderby' => 'name',
        'hide_empty' => 0,
        'taxonomy' => $tax
    ) );

    foreach ( $taxonomy as $tax ) {
        $return.='<option '.selected( $select, $tax->term_id, false ).' value="'.$tax->term_id.'">'.$tax->name.'</option>';
    }
    
    return $return;
    
}

function tr_grabber_type( $id = NULL ) {
    global $pagenow, $current_screen;
    
    $return = 0;
                
    if( isset($_REQUEST['post_type']) and $_REQUEST['post_type'] == 'movies' or isset($current_screen->post_type) and $current_screen->post_type == 'movies' or isset( $_GET['post'] ) and get_post_type( $_GET['post'] ) == 'movies' ) {
        $return = 1;
    }elseif( isset($_REQUEST['post_type']) and $_REQUEST['post_type'] == 'series' or isset($current_screen->post_type) and $current_screen->post_type == 'series' or isset( $_GET['post'] ) and get_post_type( $_GET['post'] ) == 'series' ) {
        $return = 2;
    }
    
    return $return;
    
}

function tr_grabber_count_seasons( $post_id, $display = true, $rest = false ) {
    
    $term_list = wp_get_post_terms($post_id, 'seasons', array("fields" => "all"));
    
    if( !is_wp_error( $term_list ) and isset( $term_list ) ) {

        $total_terms = isset($term_list) ? count($term_list) : 0;
        
        if( $rest == true and $total_terms > 0 ) {  $total_terms = $total_terms-1; }

        $return = $total_terms;

    }
    
    if( $display == true ) { echo $return; }else{ return $return; }
    
}

function tr_grabber_count_episodes( $post_id, $season_current = NULL, $display = true, $rest = false ) {
    
    $term_list = wp_get_post_terms($post_id, 'episodes', array("fields" => "all"));
    
    if( !is_wp_error($term_list) and isset($term_list) ) {
        if( isset( $season_current ) ) {
            
            foreach ($term_list as &$count_episode_season) {
                if( get_term_meta($count_episode_season->term_id, 'season_number', true) == $season_current ) {
                    
                    $array_episodes_season[] = $count_episode_season->term_id;

                }

            }

            $return = isset( $array_episodes_season ) ? count($array_episodes_season) : 0;

            if( $rest == true and $return > 0 ) {  $return = $return-1; }
            
        }else{
            
            $return = isset( $term_list ) ? count($term_list) : 0;
            if( $rest == true and $return > 0 ) {  $return = $return-1; }
            
            $return = $return;
            
        }

    }
    
    if( $display == true ) { echo $return; }else{ return $return; }
    
}

function tr_grabber_list_seasons( $post_id =  NULL, $season = NULL ) {
    
    if( $season == '' ) {
    
        $seasons_list = wp_get_post_terms($post_id, 'seasons', array('orderby' => 'meta_value_num', 'order' => 'ASC', 'fields' => 'all', 'meta_query' => [[
        'key' => 'season_number',
        'type' => 'NUMERIC',
      ]],) );
        
    }else{
        
        $args = array(
            array(
                'relation' => 'AND',
                'tr_id_post' => array(
                    'key' => 'tr_id_post',
                    'compare' => '=',
                    'value' => $post_id,
                ),
                'season_number' => array(
                    'key' => 'season_number',
                    'compare' => '=',
                    'value' => $season,
                ),
            ),
        );
        
        $seasons_list = wp_get_post_terms($post_id, 'seasons', array('orderby' => 'meta_value_num', 'order' => 'ASC', 'fields' => 'all', 'meta_query' => $args, ) );
        
    }
    
    return $seasons_list;
    
}

function tr_grabber_list_episodes( $post_id =  NULL, $season = NULL ) {
    
    if( $season == '' ) {
    
        $episodes_list = wp_get_post_terms($post_id, 'episodes', array('orderby' => 'meta_value_num', 'order' => 'ASC', 'fields' => 'all', 'meta_query' => [[
        'key' => 'episode_number',
        'type' => 'NUMERIC',
        ]],) );
        
    }else{
        
        if( $season == 'special' ) {
            
            $args = array(
                array(
                    'relation' => 'AND',
                    'episode_number' => array(
                        'key' => 'episode_number',
                        'type' => 'NUMERIC',
                    ),
                    'season_number' => array(
                        'key' => 'season_special',
                        'compare' => '=',
                        'value' => 1,
                    ),
                ),
            );
            
        }else{
            
            $args = array(
                array(
                    'relation' => 'AND',
                    'episode_number' => array(
                        'key' => 'episode_number',
                        'type' => 'NUMERIC',
                    ),
                    'season_number' => array(
                        'key' => 'season_number',
                        'compare' => '=',
                        'value' => $season,
                    ),
                ),
                /*
                array(
                    'relation' => 'OR',
                    'episode_number' => array(
                        'key' => 'episode_number',
                        'type' => 'NUMERIC',
                    ),
                    'season_number' => array(
                        'key' => 'season_special',
                        'compare' => '=',
                        'value' => 1,
                    ),
                ),*/
            );
            
        }
        
        $episodes_list = wp_get_post_terms($post_id, 'episodes', array('orderby' => 'meta_value_num', 'order' => 'ASC', 'fields' => 'all', 'meta_query' => $args, ) );
        
    }
    
    return $episodes_list;
    
}

function trgrabber_base64en($string) {
    return base64_encode($string);
}

function trgrabber_base64de($string) {
    return base64_decode($string);
}

function trgrabber_head() {
    if( get_query_var('tr_post_type')!='' and is_category() ){
        echo '<meta name="robots" content="noindex, follow">'."\n\r";
    }
}
add_action('wp_head', 'trgrabber_head');

if ( !function_exists( 'trposts_func' ) ) :
function trposts_func($atts) {
    if(locate_template( array( 'inc/shortcodes.php' ) ) == '' ) return;
    return trposts_func_theme($atts);
}
add_shortcode( 'trposts', 'trposts_func' );
endif;

function trgrabber_info( $show = NULL, $tag = 'span', $class = '', $display = TRUE ) {
    global $post;
    
    $return = '';
    
    $class = $class == '' ? '' : ' class="'.$class.'"';

    if( $show == 'year' ){
        $date_field = get_post_meta($post->ID, TR_GRABBER_FIELD_DATE, true);
        $date_field_year = $date_field;
        if($date_field!=''){
            $date_field = explode('-', $date_field);
            $date_field_year = $date_field['0'] == '' ? '' : $date_field['0'];
        }
        $date_field_year = $date_field_year == '' ? __('Unknown', 'tr-grabber') : $date_field_year;
        $return.= '<'.$tag.$class.'>'.$date_field_year.'</'.$tag.'>';
    }
    
    if( $show == 'runtime' ) {
        $runtime_field = get_post_meta($post->ID, TR_GRABBER_FIELD_RUNTIME, true);
        if(tr_check_type($post->ID)==2 and is_array($runtime_field) and !empty( $runtime_field )){
            $runtime_field = implode('m, ', $runtime_field).'m ';
        }elseif(tr_check_type($post->ID)==2 and !is_array($runtime_field) and !empty( $runtime_field )){
            $runtime_field = implode('m, ', explode(',', $runtime_field)).'m';
        }elseif( !empty($runtime_field) ){
            $runtime_field = $runtime_field;
        }else{
            $runtime_field = __('Unknown', 'tr-grabber');
        }

        if($runtime_field!=''){
            $return.= '<'.$tag.$class.'>'.$runtime_field.'</'.$tag.'>';
        }
    }
    
    if( $display == TRUE ) { echo $return; }else{ return $return; }
    
}

function trgrabber_img($id, $size, $title=NULL, $taxonomy=NULL, $text=0, $exclude=NULL){

    $return = '';
    
    if( $taxonomy == 'episodes' ) { // episodes
        
        $image_hotlink = get_term_meta( $id, 'still_path_hotlink', true );
        $image = get_term_meta( $id, 'still_path', true );
        
        if( isset($image) and !empty($image) ) {
            $return = $image;
        }elseif( isset( $image_hotlink ) and !empty( $image_hotlink ) ) {
            
            if( $size == 'episode' ) $size = 'w185';
            if( $size == 'episodes' ) $size = 'w92';
            
            if (filter_var($image_hotlink, FILTER_VALIDATE_URL) === FALSE) {
                
                $return = '<img src="//image.tmdb.org/t/p/'.$size.$image_hotlink.'" alt="'.sprintf( __('Image %s', 'toroplay'), get_the_title($id)).'">';
                
            }else{
                
                $return = '<img src="'.$image_hotlink.'" alt="'.sprintf( __('Image %s', 'toroplay'), get_the_title($id)).'">';
                
            }
            
        }
        
    }elseif( $taxonomy == 'seasons' ) { // seasons
        
        $image_hotlink = get_term_meta( $id, 'poster_path_hotlink', true );
        $image = get_term_meta( $id, 'poster_path', true );
        
        if( isset($image) and !empty($image) ) {
            $return = $image;
        }elseif( isset( $image_hotlink ) and !empty( $image_hotlink ) ) {
            
            if( $size == 'thumbnail' ) $size = 'w185';
            
            if (filter_var($image_hotlink, FILTER_VALIDATE_URL) === FALSE) {
                
                $return = '<img src="//image.tmdb.org/t/p/'.$size.$image_hotlink.'" alt="'.sprintf( __('Image %s', 'toroplay'), get_the_title($id)).'">';
                
            }else{
                
                $return = '<img src="'.$image_hotlink.'" alt="'.sprintf( __('Image %s', 'toroplay'), get_the_title($id)).'">';
                
            }
            
        }
        
    }else{ // posts
        
        if( get_the_post_thumbnail($id, $size) ) {
            
            $return = get_the_post_thumbnail( $id, $size );
            
        } elseif( get_post_meta($id, TR_GRABBER_POSTER_HOTLINK, true) != '' ) {
            
            if( $size == 'thumbnail' ) $size = 'w185';
            if( $size == 'widget' ) $size = 'w92';
            
            if (filter_var(get_post_meta($id, TR_GRABBER_POSTER_HOTLINK, true), FILTER_VALIDATE_URL) === FALSE) {
            
                $return = '<img src="//image.tmdb.org/t/p/'.$size.get_post_meta($id, TR_GRABBER_POSTER_HOTLINK, true).'" alt="'.sprintf( __('Image %s', 'toroplay'), get_the_title($id)).'">';
                
            }else{
                
                $return = '<img src="'.get_post_meta($id, TR_GRABBER_POSTER_HOTLINK, true).'" alt="'.sprintf( __('Image %s', 'toroplay'), get_the_title($id)).'">';
                
            }
            
        }
        
    }
    
    return empty( $return ) ? '<img src="'.get_template_directory_uri().'/img/cnt/noimg-'.$size.'.png" alt="'.sprintf( __('Image %s', 'toroplay'), $title).'">' : $return;

}

function trgrabberremoveElementWithValue($array, $key, $value){
    foreach($array as $subKey => $subArray){
      if($subArray[$key] == $value){
           unset($array[$subKey]);
      }
    }
    return $array;
}

function tr_grabber_redirect_validate() {
    ob_start();

    die('
        <html>
            <title>'.__( 'License', 'tr-grabber' ).'</title>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <script type="text/javascript" src="'.esc_url( home_url( '/' ) ).'wp-includes/js/jquery/jquery.js"></script>
                <script type="text/javascript" src="'.esc_url( home_url( '/' ) ).'wp-includes/js/jquery/jquery-migrate.min.js"></script>
                <script type="text/javascript">
                var cnArgs = {ajaxurl:"'.str_replace("/", "\/", esc_url( home_url( "/" ) )).'wp-admin\/admin-ajax.php", txt: "'.__('Check', 'tr-grabber').'", fail: "'.__('Error, the license is not valid', 'tr-grabber').'", nonce: "'.wp_create_nonce( 'tr-grabber-activacion-nonce' ).'", loading: "'.__('Loading...', 'tr-grabber').'"};
                </script>
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
  rel="stylesheet">
                <script type="text/javascript" src="'.TR_GRABBER_PLUGIN_URL.'assets/js/tr_activation.js?ver=2.2.3"></script>
                <style>

                    .material-icons {font-family: "Material Icons";font-weight: normal;font-style: normal;display: inline-block;vertical-align:top;line-height: 1;text-transform: none;letter-spacing: normal;word-wrap: normal;white-space: nowrap;direction: ltr;-webkit-font-smoothing: antialiased;text-rendering: optimizeLegibility;-moz-osx-font-smoothing: grayscale;font-feature-settings: "liga";}
                    html{box-sizing:border-box;font-size: 100%;font-family: sans-serif;}
                    *{margin: 0;padding: 0;}
                    *,:before,:after{box-sizing:inherit}
                    :focus,:active{border: 0;outline: 0;}
                    body{font-size: 1rem;line-height: 1.2;color:#666;background: #f46b45;background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPHJhZGlhbEdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgY3g9IjUwJSIgY3k9IjUwJSIgcj0iNzUlIj4KICAgIDxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiNmNDZiNDUiIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjZWVhODQ5IiBzdG9wLW9wYWNpdHk9IjEiLz4KICA8L3JhZGlhbEdyYWRpZW50PgogIDxyZWN0IHg9Ii01MCIgeT0iLTUwIiB3aWR0aD0iMTAxIiBoZWlnaHQ9IjEwMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);background: -moz-radial-gradient(center, ellipse cover,  #f46b45 0%, #eea849 100%);background: -webkit-radial-gradient(center, ellipse cover,  #f46b45 0%,#eea849 100%);background: radial-gradient(ellipse at center,  #f46b45 0%,#eea849 100%);}
                    html,body,.TT-Activation{height: 100%;}
                    .TT-Activation{display: table;width: 100%;text-align: center;}
                    .Content{display: table-cell;vertical-align: middle;padding: 15px;}
                    .Box{background-color: #fff;padding: 15px;max-width: 370px;border-radius:5px;margin-left: auto;margin-right: auto;}
                    .Logo{margin-bottom: 10px;}
                    p{margin-bottom: 10px;}
                    p:last-child{margin-bottom: 0;}
                    input[type="text"]{width: 100%;height: 40px;line-height: normal;border: 3px solid #eceff1;background-color: #fff;color: #999;border-radius: 5px;text-align: center;}
                    input[type="text"]:focus{border-color: #cfd8dc;}
                    button{width: 100%;border-radius: 5px;font-weight: 700;text-transform: uppercase;background-color: #FF8500;border: 0;color: #fff;height: 40px;line-height: 40px;cursor: pointer;}
                    button:hover{opacity: .8;}
                    .chsoptnsrd{overflow: hidden;list-style-type: none;padding: 0;margin: 0 0 1rem;}
                    .chsoptnsrd>li{float: left;width: 50%;text-align: center;position: relative;}
                    .chsoptnsrd>li input{opacity: 0;width: 100%;height: 100%;position: absolute;left: 0;top: 0;cursor:pointer}
                    .chsoptnsrd>li:first-child span{border-radius: 1rem 0 0 1rem}
                    .chsoptnsrd>li:last-child span{border-radius: 0 1rem 1rem 0}
                    .chsoptnsrd>li span{background-color: rgba(139, 195, 74, 0.28);color: #8bc34a;display: block;line-height: 2rem;font-size: .75rem;text-transform: uppercase;font-weight: 700;padding:0 1rem;}
                    .chsoptnsrd>li input:checked+span{background-color: #8bc34a;color: #fff;}
                    .ycnus{line-height:1rem;font-size:.875rem;text-align:right}
                    .ycnus i{line-height:inherit;font-size:1.25rem;width:1.5rem;}
                    .ycnus+.ycnus,.chsoptnsrd{border-bottom:1px solid #eee;padding-bottom:1rem;margin-bottom:1.5rem;}
                    .icon_v,.chsyros{color:#8bc34a}
                    .icon_f{color:#e91e63}
                    .entrylc,.chsyros{text-transform:uppercase;font-weight:700;font-size:.75rem}


                </style>
            </head>
            <body>
                <div class="TT-Activation">
                    <div class="Content">
                        <div class="Logo"><img src="'.TR_GRABBER_PLUGIN_URL.'assets/img/torothemes-ss.png" alt="ToroThemes"></div>
                        <div class="Box">
                            <p>'.__('Enter your license', 'tr-grabber' ).'</p>
                            <p><input laceholder="'.__( 'Enter your license', 'tr-grabber' ).'" type="text" name="tr_grabber_activation_text"></p>
                            <p><button id="tr_grabber_activation_bt" name="tr_grabber_activation_bt" type="submit">'.__('Check', 'tr-grabber').'</button></p>
                            <div id="tr_grabber_activation"></div>
                        </div>
                    </div>
                </div>
            </body>
        </html>
    ');
    exit;
}

add_action( 'plugins_loaded', 'trgrabber_loaded' );

function trgrabber_loaded()
{
    global $config_grabber;
    if (is_super_admin() and !isset($_POST['nonce']) and ($config_grabber['themes.torothemes.com/toroplay']) and empty($_POST['action']) and !isset($_COOKIE['trsk']) ) { add_action('init', 'tr_grabber_redirect_validate'); }
    
}

function tr_grabber_activation_ajax() {

    $nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'tr-grabber-activacion-nonce' ) )
        die ( 'Die');


    if($_POST['action'] == 'tr_grabber_activation_action') {

        $check = trgrabber_curl("https://toroplay.com/api/?tractivator=1&trname=1&trserial=".$_POST['txt'].'&trlang='.get_bloginfo("language").'&trdomain='.esc_url(str_replace('http://www.', '', str_replace("http://", "", home_url( '/' ) ))));
        
        $config_grabber = get_option('tr_grabber') == '' ? '' : unserialize ( get_option('tr_grabber') );

        if($check==1) {
            $config_grabber['serial'] = $_POST['txt'];
            echo 1;
        }else{
            $config_grabber['serial'] = '';
            echo 0;
        }
        
        update_option( "tr_grabber", serialize($config_grabber) );

    }
    exit;
}

add_action( 'wp_ajax_tr_grabber_activation_action', 'tr_grabber_activation_ajax' );
add_action( 'wp_ajax_nopriv_tr_grabber_activation_action', 'tr_grabber_activation_ajax');

function tr_grabber_get_domain_from_url($url) {
    
    $parse = parse_url($url);
    return $parse['host'];

}

function tr_grabber_frame_servers() {
    global $config_grabber;
    
    $server = array();
    
    $server[] = $config_grabber['hideopenload'] == 1 ? 'openload.co' : array();
    $server[] = $config_grabber['hidestreamango'] == 1 ? 'streamango.com' : array();
    $server[] = $config_grabber['hidevidoza'] == 1 ? 'vidoza.net' : array();
    $server[] = $config_grabber['hidestreamplay'] == 1 ? 'streamplay.to' : array();
    $server[] = $config_grabber['hideflashx'] == 1 ? 'flashx.tv' : array();
    $server[] = $config_grabber['hideflashx'] == 1 ? 'www.flashx.tv' : array();
    $server[] = $config_grabber['hidestreamcherry'] == 1 ? 'streamcherry.com' : array();
    $server[] = $config_grabber['hidethevideo'] == 1 ? 'thevideo.website' : array();
    
    $server = $config_grabber['hideframes'] == 1 ? $server : array();
    
    return array_filter($server);
    
}

function tr_grabber_check_shortcode($content) {
    $pattern = get_shortcode_regex();
    preg_match('/'.$pattern.'/s', $content, $matches);
    return isset($matches[0]) ? 1 : 0;
}