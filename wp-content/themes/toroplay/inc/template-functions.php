<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ToroPlay
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'toroplay_body_classes' ) ) :
function toroplay_body_classes( $classes ) {
    
    if ( get_theme_mod('tp_fullwidth', 0) == 1 ) {
         $classes[] = 'FullW';
    }
    
    if ( get_theme_mod('tp_corners', 0) == 1 ) {
         $classes[] = 'NoBrdRa';
    }
    
    if ( get_theme_mod('tp_noboxed', 0) == 1 ) {
         $classes[] = 'NoBoxed';
    }

	return $classes;
}
add_filter( 'body_class', 'toroplay_body_classes' );
endif;

/**
 * Add an alphabet function
 */

if ( ! function_exists( 'tr_alphabet' ) ) :

function tr_alphabet() {

    if( get_theme_mod('alphabet', 1) !== 1 ){
    
        $letters = get_categories( array(
            'hide_empty' => false,
            'taxonomy' => 'letters'
        ) );

        if(isset($letters)){

            echo '<ul class="AZList">';

            foreach ( $letters as $letter ) {
            if($letter->name==single_term_title("", false)){ $class=' class="Current"'; }else{ $class=''; }
                echo '<li'.$class.'><a href="'.esc_url( get_term_link( $letter->term_id, 'letters' ) ).'">'.esc_html( $letter->name ).'</a></li>';
            }

            echo'</ul>';

        }
    }
}

endif;

/**
 * Add an image function WordPress / TMDB
 */

if ( ! function_exists( 'tr_theme_img' ) ) :

function tr_theme_img($id, $size, $title=NULL, $taxonomy=NULL, $text=0, $exclude=NULL){

    $return = '';
    
    if( $taxonomy == 'episodes' ) { // episodes
        
        $image_hotlink = get_term_meta( $id, 'still_path_hotlink', true );
        $image = get_term_meta( $id, 'still_path', true );
        
        if( isset($image) and !empty($image) ) {
            $return = '<img src="'.wp_get_attachment_url($image).'" alt="'.sprintf( __('Image %s', 'toroplay'), get_the_title($id)).'">';
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
            $return = '<img src="'.wp_get_attachment_url($image).'" alt="'.sprintf( __('Image %s', 'toroplay'), get_the_title($id)).'">';
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
endif;

if ( ! function_exists( 'tr_backdrop' ) ) :
/**
 * Prints HTML with background.
 */
function tr_backdrop($size='w780', $post_id = NULL) {
    global $post;
    
    $post_id = $post_id == '' ? $post->ID : $post_id;
    
    $backdrop_field = get_post_meta($post_id, TR_GRABBER_FIELD_BACKDROP, true);
    $url_backdrop = wp_get_attachment_image_src($backdrop_field, 'full');
    $backdrop_field = $url_backdrop == '' ? '' : '<img class="TPostBg" src="'.$url_backdrop[0].'" alt="'.__('Background', 'toroplay').'">';
    
    if($url_backdrop!='') {
         echo $backdrop_field;
    }elseif(get_post_meta($post_id, TR_GRABBER_FIELD_BACKDROP_HOTLINK, true)!=''){
         echo '<img class="TPostBg" src="'.get_post_meta($post_id, TR_GRABBER_FIELD_BACKDROP_HOTLINK, true).'" alt="'.__('Background', 'toroplay').'">';        
    }else{
        echo '<img class="TPostBg" src="'.get_template_directory_uri().'/img/cnt/w780.png" alt="'.__('Background', 'toroplay').'">';
    }
        
}
endif;

/**
 * Function to add items to menus by default.
 */
function tr_default_menu() {
    wp_list_categories('sort_column=name&title_li=&depth=1&number=3'); 
}

/**
 * Function to check if post is movie or tv show
 */
function tr_check_type($id, $display=NULL) {
    $return = '';
    $type = get_post_meta($id, 'tr_post_type', true);

    if($type==2){ $return = 2; }else{ $return = 1; }

    if($display==NULL){ return $return; }else{ echo $return; }
}

/**
 * Function to icon tv show
 */
function tr_icon_tv($id = NULL, $display=NULL) {
    global $post;
    $return = '';

    $id = $id == '' ? $post->ID : $id;
    
    $return = tr_check_type($id) == 2 ? ' <span class="TpTv BgA">'.__('TV', 'toroplay').'</span>' : '';

    if($display==NULL) { return $return; }else{ echo $return; }
}

/**
 * Function to select type content
 */
function tr_type_checkbox() {

    if( is_category() and get_theme_mod( 'show_filter', 1 ) == 1 ) {
        
        $permalink = esc_url( get_category_link( get_query_var('cat') ) );
        $trtype = get_query_var('tr_post_type') == '' ? 'all' : intval(get_query_var('tr_post_type'));
        
        echo '
        <div class="SearchMovies">
            <form class="FilterRadio">
                <label><input '.checked( $trtype, 'all', false ).' name="trtype" type="radio" value="'.$permalink.'"><span>'.__('All', 'toroplay').'</span></label>
                <label><input '.checked( $trtype, 1, false ).' name="trtype" type="radio" value="'.add_query_arg( array('tr_post_type' => '1'), $permalink ).'"><span>'.__('Movies', 'toroplay').'</span></label>
                <label><input '.checked( $trtype, 2, false ).' name="trtype" type="radio" value="'.add_query_arg( array('tr_post_type' => '2'), $permalink ).'"><span>'.__('Series', 'toroplay').'</span></label>
            </form>
        </div>
        ';
    }
    
}

/**
 * Function description for categories
 */
function tr_description($position){
    
    if( is_category() ) {
        
        $descripcion = category_description();
        $explode = explode('<p><!--more--></p>', $descripcion);
        
        if( $position == 'top' and isset( $explode[0] ) and !empty( $explode[0] ) ) {
            echo '<div class="tr-description">'.$explode[0].'</div>';
        }
        
        if( $position == 'bottom' and isset( $explode[1] ) and !empty( $explode[1] ) ) {
            echo '<div class="tr-description">'.$explode[1].'</div>';
        }
        
    }
    
}

/**
 * Function banners
 */
function tr_banners($id, $display = TRUE, $type = 1){

    $ads = unserialize(get_option('tr_ads_toroplay'));
    $class = ''; $return = '';
    if(isset($_GET['preview_bnr']) and is_super_admin()){
        $class = ' bnr_preview_tr';
        if($type == 1){
            $ads[$id]['desktop'] = '<img class="tr_preview_bnr" src="'.get_template_directory_uri().'/img/cnt/bnr-toroplay.png" alt="'.$id.'">';
        }else{
            $ads[$id]['desktop'] = '<img class="tr_preview_bnr" src="'.get_template_directory_uri().'/img/cnt/toroplay-300.png" alt="'.$id.'">';            
        }
    }
    
    if(isset($ads[$id]) and !empty($ads[$id]['desktop']) and !wp_is_mobile() or isset($_GET['preview_bnr']) and is_super_admin() and isset($ads[$id]) and !wp_is_mobile()){
        if( $type == 1 ) {
            $return = '<div class="bnr'.$class.'" id="'.$id.'">'.stripslashes($ads[$id]['desktop']).'</div>';
        }else{
            $return = '
            <div class="Dvr Dvr-Player'.$class.'" id="'.$id.'">
            <div class="Dvr-300">'.stripslashes($ads[$id]['desktop']).'</div>
                <span class="tr-close-dvr Button STPb">'.__('Close', 'toroplay').'</span>
            </div>';
        }
    }
    
    if(isset($ads[$id]) and !empty($ads[$id]['mobile']) and wp_is_mobile()){
        if( $type == 1 ) {
            $return = '<div class="bnr'.$class.'" id="'.$id.'">'.stripslashes($ads[$id]['mobile']).'</div>';
        }else{
            $return = '
            <div class="Dvr Dvr-Player'.$class.'" id="'.$id.'">
            <div class="Dvr-300">'.stripslashes($ads[$id]['mobile']).'</div>
                <span class="tr-close-dvr Button STPb">'.__('Close', 'toroplay').'</span>
            </div>';
            
        }
    }
    
    if( $display == TRUE ){ echo $return; }else{ return $return; }
}

/**
 * Content sidebar class
 */
function tr_content_class($type=1, $addclass = NULL, $display = TRUE) {
    
    $return = '';
    
    if( $type == 1 ) {
        $class = get_theme_mod('tp_sidebar', 2) == 1 ? ' TpLCol' : '';
        $classb = get_theme_mod('tp_sidebar', 2) == 0 ? ' TpLCol NoSdbr' : '';
        $return = ' class="TpRwCont'.$class.$classb.'"';
    }
    
    if( $type == 2 ) {
        $class = get_theme_mod('tp_sidebar', 2) != 0 ? ' E20' : ' E02';
        
        $return = ' class="'.$addclass.$class.'"';
    }
    
    if( $type == 3 ) {
        $return = ' class="'.$addclass.'"';        
    }
    
    if( $display == TRUE ) { echo $return; }else{ return $return; }
}

/**
 * Change sidebar for section
 */
function tr_sidebar() {
    global $post;
    
    if( is_home() and is_active_sidebar( 'sidebar-2' ) ){
        $return = 'sidebar-2';
    }elseif( is_category() and is_active_sidebar( 'sidebar-7' ) ){
        $return = 'sidebar-7';
    }elseif( is_single() and tr_check_type($post->ID) == 1 and is_active_sidebar( 'sidebar-4' ) ){
        $return = 'sidebar-4';
    }elseif( is_single() and tr_check_type($post->ID) == 2 and is_active_sidebar( 'sidebar-3' ) ){
        $return = 'sidebar-3';
    }elseif( is_tax('episodes') and is_active_sidebar( 'sidebar-5' ) ){
        $return = 'sidebar-5';
    }elseif( is_tax('seasons') and is_active_sidebar( 'sidebar-6' ) ){
        $return = 'sidebar-6';
    }else{
        $return = 'sidebar-1';
    }
    
    return $return;
}

function tp_link_footer(){
    $array = array(

        __('Themes Movies Online', 'toroplay'),
        __('Theme Movie Online', 'toroplay'),
        __('Movies Online WordPress', 'toroplay'),
        __('Themes WordPress Movie', 'toroplay')

    );

    if(get_option('tf_link')==''){ update_option('tf_link', $array[array_rand($array, 1)]); $link=get_option('tf_link'); }else{ $link=get_option('tf_link'); }

    return '<a target="_blank" href="https://toroplay.com/">'.$link.'</a>';
}

/**
 * Support Home Control
 */
function tr_homecontrol( $type = 1 ) {
    global $config_grabber;
    
    $array = array();
    
    if( $type == 1 ) {
    
        if( isset($config_grabber['homecontrol']) ) {

            if( isset( $_POST['config']['homecontrol'] ) ) {
            
                $array = $_POST['config']['homecontrol'];
                
            }else{
            
                $array = $config_grabber['homecontrol'];
                
            }

        } else {

            $array[] = 'Slider|slider/moved|1';
            $array[] = 'Movies|index/movies|1';
            $array[] = 'Series|index/series|1';
            $array[] = 'Seasons|index/seasons|1';
            $array[] = 'Episodes|index/episodes|1';
            $array[] = 'Text|index/text|2';

        }
        
    }else{
        
        if( isset($config_grabber['homecontrol']) ) {

            $for = $config_grabber['homecontrol'];
            
            foreach ( $for as $key => $value ) {
                $explode = explode( '|', $value );
                if( $explode[2] == 1 ){
                    $array[] = $explode[1];
                }
            }
                        
            
        } else {

            $array[] = 'slider/moved';
            $array[] = 'index/movies';
            $array[] = 'index/series';
            $array[] = 'index/seasons';
            $array[] = 'index/episodes';
            $array[] = 'index/text';

        }
        
    }
    
    return $array;
    
}

/**
 * Format number rating
 */
function tr_rating_format_number($id = NULL, $display = NULL) {
 
    $return = is_numeric( get_post_meta($id, 'ratings_average', true) ) ? number_format(get_post_meta($id, 'ratings_average', true), 1) : 0;
    $return = get_post_meta($id, 'ratings_average', true) == '' ? '0.0' : $return;
    
    if( $display == TRUE ) { echo $return;  }else{ return $return; }
    
}

/**
 * Titles for seo
 */
function tr_title($id = NULL, $class = NULL, $display=TRUE, $term_id = NULL) {
    
    $class = !empty($class) ? ' class="'.$class.'"' : '';
    $text = ''; $return = '';
    
    if( $id == 'tp_homepage' and !is_page() ) {
        $text = get_theme_mod( 'tp_homepage', __('Latest Movies', 'toroplay') );
        $tag = get_theme_mod( 'tp_homepagetag', 'h1' );
    }
    
    if( $id == 'tp_homepage_series' and !is_page() ) {
        $text = get_theme_mod( 'tp_homepage_series', __('Latest Series', 'toroplay') );
        $tag = get_theme_mod( 'tp_homepage_seriestag', 'div' );
    }
    
    if( $id == 'tp_homepage_seasons' and !is_page() ) {
        $text = get_theme_mod( 'tp_homepage_seasons', __('Latest Seasons', 'toroplay') );
        $tag = get_theme_mod( 'tp_homepage_seasonstag', 'div' );
    }
    
    if( $id == 'tp_homepage_episodes' and !is_page() ) {
        $text = get_theme_mod( 'tp_homepage_episodes', __('Latest Episodes', 'toroplay') );
        $tag = get_theme_mod( 'tp_homepage_episodestag', 'div' );
    }
    
    if( $id == 'list' and is_category() ) {
        $text = get_theme_mod( 'tp_category', __('{title}', 'toroplay') );
        $text = str_replace('{title}', single_cat_title('', false), $text);
        $tag = get_theme_mod( 'tp_category_tag', 'h1' ); 
    }elseif( $id == 'list' and is_tag() ) {
        $text = get_theme_mod( 'tp_tag', __('{title}', 'toroplay') );
        $text = str_replace('{title}', single_tag_title('', false), $text);
        $tag = get_theme_mod( 'tp_tag_tag', 'h1' ); 
    }elseif( $id == 'list' and is_search() ) {
        $text = __('Search', 'toroplay');
        $tag = 'h1';
    }elseif( $id == 'list' and is_tax('cast') or $id == 'list' and is_tax('cast_tv') ) {
        $text = get_theme_mod( 'tp_cast', __('{title}', 'toroplay') );
        $text = str_replace('{title}', single_term_title('', false), $text);
        $tag = get_theme_mod( 'tp_cast_tag', 'h1' );
    }elseif( $id == 'list' and is_tax('directors') or $id == 'list' and is_tax('directors_tv') ) {
        $text = get_theme_mod( 'tp_director', __('{title}', 'toroplay') );
        $text = str_replace('{title}', single_term_title('', false), $text);
        $tag = get_theme_mod( 'tp_director_tag', 'h1' );
    }elseif( $id == 'list' and is_tax('country') ) {
        $text = get_theme_mod( 'tp_countries', __('{title}', 'toroplay') );
        $text = str_replace('{title}', single_term_title('', false), $text);  
        $tag = get_theme_mod( 'tp_countries_tag', 'h1' );
    }elseif( $id == 'list' ) {
        $text = get_theme_mod( 'tp_homepage', __('Latest Movies', 'toroplay') );
        $tag = get_theme_mod( 'tp_homepagetag', 'h1' );
    }
    
    if( $id == 'tp_page' or $id == 'tp_homepage_series' and is_page() or $id == 'tp_homepage' and is_page() or $id == 'tp_homepage_seasons' and is_page() or $id == 'tp_homepage_episodes' and is_page() ) {
        global $post;
        $text = get_theme_mod( 'tp_page', __('{title}', 'toroplay') );
        $text = str_replace('{title}', $post->post_title, $text);
        $tag = get_theme_mod( 'tp_page_tag', 'h1' ); 
    }
    
    if( $id == 'tp_single' ) {
        global $post;
        $text = get_theme_mod( 'tp_single', __('{title}', 'toroplay') );
        $text = str_replace('{title}', $post->post_title, $text);
        $tag = get_theme_mod( 'tp_singlem_tag', 'h1' );    
    }

    if( $id == 'tp_single_series' ) {
        global $post;
        $text = get_theme_mod( 'tp_single_series', __('{title}', 'toroplay') );
        $text = str_replace('{title}', $post->post_title, $text);
        $tag = get_theme_mod( 'tp_singles_tag', 'h1' );    
    }
    
    if( $id == 'tp_single_seasons' ) {
        $tr_post_id = get_term_meta($term_id, 'tr_id_post', true);
        $season_number = get_term_meta($term_id, 'season_number', true);
        $text = get_theme_mod( 'tp_single_seasons', sprintf( __('{title} %s- Season {season}%s', 'toroplay'), '<span>', '</span>') );
        $text = str_replace('{title}', get_the_title( $tr_post_id ), $text);
        $text = str_replace('{season}', $season_number, $text);
        $tag = get_theme_mod( 'tp_singlese_tag', 'h1' );    
    }
    
    if( $id == 'tp_single_episodes' ) {
        $tr_post_id = get_term_meta($term_id, 'tr_id_post', true);
        $number = toroplay_episode_info($term_id, 'span', false, $show='episode_number', false);
        $season = toroplay_episode_info($term_id, 'span', false, $show='season_number', false);
        if(get_term_meta($term_id, 'season_number', true) == 0) {
            $text = sprintf( __('%s %sSpecial%s', 'toroplay'), get_the_title( $tr_post_id ), '<span>', '</span>');
        }else{
            $text = get_theme_mod( 'tp_single_episodes', sprintf( __('{title} %s{season}x{episode}%s', 'toroplay'), '<span>', '</span>') );
        }
        $text = str_replace('{title}', get_the_title( $tr_post_id ), $text);
        $text = str_replace('{episode}', $number, $text);
        $text = str_replace('{season}', $season, $text);
        $tag = get_theme_mod( 'tp_singleep_tag', 'h1' );   
    }
    
    if( $id == 'tp_letters' ) {
        $text = get_theme_mod( 'tp_letters', __('{title}', 'toroplay') );
        $text = str_replace('{title}', single_term_title('', false), $text);  
        $tag = get_theme_mod( 'tp_letters_tag', 'h1' );
    }
    
    if( $id == 'tp_links' ) {
        global $post;
        $text = get_theme_mod( 'tp_links', __('{title}', 'toroplay') );
        $text = str_replace('{title}', $post->post_title, $text);
        $tag = get_theme_mod( 'tp_links_tag', 'div' );
    }
    
    if( $id == 'titlelist' ) {
        $text = $term_id;
        $tag = get_theme_mod( 'tp_titlelist_tag', 'h3' );
    }
    
    if( $id == 'titleslider' ) {
        $text = $term_id;
        $tag = get_theme_mod( 'tp_titleslider_tag', 'div' );        
    }
    
    if( $id == 'titlecarrousel' ) {
        $text = $term_id;
        $tag = get_theme_mod( 'tp_titlecar_tag', 'div' );        
    }
        
    $return = '<'.$tag.$class.'>'.$text.'</'.$tag.'>';
    
    if($display==TRUE){ echo $return; }else{ return $return; }
}

/**
 * WP Query Args
 */

function tr_args( $type = 1, $paged = NULL ) {
    global $wp_query;
        
    if( $type == 1 ) {
    
        $limit = is_page_template( 'pages/template-movies.php' ) ? get_theme_mod('tp_posts_per_page', 20) : get_theme_mod('tp_posts_per_movies', 10);
        
        $args = array(

            'posts_per_page' => $limit,
            'post_type' => 'movies',
            'paged' => $paged,
            /*
            'meta_query' => array(
            'relation' => 'OR',

            array(
                'key' => 'tr_post_type',
                'value' => false,
                'type' => 'BOOLEAN'
            ),
            array(
                'key' => 'tr_post_type',
                'compare' => 'NOT EXISTS'
            )
            ),*/

        );
        
    }elseif( $type == 2 ) {
        
        $limit = is_page_template( 'pages/template-series.php' ) ? get_theme_mod('tp_posts_per_page', 20) : get_theme_mod('tp_posts_per_series', 10);
        
        $args = array(
        
            'posts_per_page' => $limit,
            'post_type' => 'series',
            'paged' => $paged,
            /*
            'meta_query' => array(

                array(
                      'key' => 'tr_post_type', 
                      'compare' => '=',
                      'value' => 2
                ),

            ),*/
            
        );
        
    }elseif( $type == 3 ) {
        
        $args = array(
            'orderby' => 'term_id',
            'order'   => 'DESC',
            'taxonomy' => 'seasons',
            'number' => get_theme_mod('tp_posts_per_seasons', 10)
        );
        
    }elseif( $type == 4 ) {
        
        $args = array(
            'orderby' => 'term_id',
            'order'   => 'DESC',
            'taxonomy' => 'episodes',
            'number' => get_theme_mod('tp_posts_per_episodes', 8)
        );
        
    }elseif( $type == 5 ) {
        
        global $totalpages_tax;
        
        $taxonomy = 'episodes';
        $number   = get_theme_mod('tp_posts_per_episodes', 8);

        $page  = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $paged = isset($wp_query->query['paged']) ?  $wp_query->query['paged'] : $page;

        $offset       = ( $paged > 0 ) ?  $number * ( $paged - 1 ) : 1;
        $totalterms   = wp_count_terms( $taxonomy, array( 'hide_empty' => TRUE ) ); 
        $totalpages_tax   = ceil( $totalterms / $number );

        $args = array(
            'taxonomy'      => $taxonomy,
            'orderby'       => 'term_id', 
            'order'         => 'DESC',
            'hide_empty'    => true, 
            'exclude'       => array(), 
            'exclude_tree'  => array(), 
            'number'        => $number, 
            'fields'        => 'all', 
            'slug'          => '', 
            'parent'         => '',
            'hierarchical'  => true, 
            'child_of'      => 0, 
            'get'           => '', 
            'name__like'    => '',
            'pad_counts'    => false, 
            'offset'        => $offset, 
            'search'        => '', 
            'cache_domain'  => 'core'
        );
        
    }elseif( $type == 6 ) {
        
        global $totalpages_tax;
        
        $taxonomy = 'seasons';
        $number   = get_theme_mod('tp_posts_per_seasons', 10);

        $page  = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $paged = isset($wp_query->query['paged']) ?  $wp_query->query['paged'] : $page;

        $offset       = ( $paged > 0 ) ?  $number * ( $paged - 1 ) : 1;
        $totalterms   = wp_count_terms( $taxonomy, array( 'hide_empty' => TRUE ) ); 
        $totalpages_tax   = ceil( $totalterms / $number );

        $args = array(
            'taxonomy'      => $taxonomy,
            'orderby'       => 'term_id', 
            'order'         => 'DESC',
            'hide_empty'    => true, 
            'exclude'       => array(), 
            'exclude_tree'  => array(), 
            'number'        => $number, 
            'fields'        => 'all', 
            'slug'          => '', 
            'parent'         => '',
            'hierarchical'  => true, 
            'child_of'      => 0, 
            'get'           => '', 
            'name__like'    => '',
            'pad_counts'    => false, 
            'offset'        => $offset, 
            'search'        => '', 
            'cache_domain'  => 'core'
        );
        
    }elseif( $type == 7 ) {
        
        $limit = get_theme_mod('tp_posts_per_page', 20);
        
        $args = array(
        
            'posts_per_page' => $limit,
            'post_type' => array('movies', 'series'),
            'paged' => $paged,
            'meta_key' => 'views',
            'orderby' => 'meta_value_num'
            
        );
        
    }elseif( $type == 8 ) {
        
        $limit = get_theme_mod('tp_posts_per_page', 20);
        
        $args = array(
        
            'posts_per_page' => $limit,
            'post_type' => array('movies', 'series'),
            'paged' => $paged,
            'meta_key' => 'ratings_average',
            'orderby' => 'meta_value_num'
            
        );
        
    }
    
    return $args;
    
}

if ( ! function_exists( 'tr_pagination' ) ) :
/**
 * Pagination
 */
function tr_pagination($type=1, $qc=NULL) {
    global $wp_query, $wp_rewrite;
    
    $pages = '';
    
    $paged = isset($wp_query->query['paged']) ?  $wp_query->query['paged'] : get_query_var('paged');
    
    $max = $qc == '' ? $wp_query->max_num_pages : $qc;

    if( $type == 1) {

        if (!$current = $paged) $current = 1;  
        $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));  
        $a['total'] = $max;
        $a['current'] = $current;

        $total = 0; //1 - display the text "Page N of N", 0 - not display  
        $a['mid_size'] = 5; //how many links to show on the left and right of the current  
        $a['end_size'] = 1; //how many links to show in the beginning and end  
        $a['prev_text'] = __('&laquo; Previous', 'toroplay'); //text of the "Previous page" link  
        $a['next_text'] = __('Next &raquo;', 'toroplay'); //text of the "Next page" link  

        if ($max > 1) echo '<div class="wp-pagenavi">';
        if ($total == 1 && $max > 1) $pages = '<span class="pages">'.sprintf( __('Page %s of %s', 'toroplay'), $current, $max).'</span>'."\r\n";
        echo $pages . paginate_links($a);  
        if ($max > 1) echo '</div>';  

    }else{
        echo '<div class="tr-pagnav wp-pagenavi navcom">'.paginate_comments_links( array('prev_next' => true,'echo' => false) ).'</div>'; 
    }
    
}
endif;

/**
 * Delete Transient
 */
function tr_delete_transient( $wp_customize ) {
    delete_transient('trslidermoved_query_results');
    delete_transient('trsliderfixed_query_results');
}
add_action( 'customize_save', 'tr_delete_transient', 100 );
add_action( 'save_post', 'tr_delete_transient', 100 );

function tr_theme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
?>
    <!--<Comment>-->
    <li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
        <div id="div-comment-<?php comment_ID() ?>" class="Comment comment-body">
            <?php if ( $args['avatar_size'] != 0 ) echo '<figure>'.get_avatar( $comment, 50 ).'</figure>'; ?>
            <p><?php echo get_comment_author_link(); ?> <span>- <?php echo get_comment_date('d'); ?> <?php echo get_comment_date('F'); ?>, <?php echo get_comment_date('Y'); ?></span></p>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'toroplay' ); ?></p>
            <?php endif; ?>
            <?php comment_text(); ?>
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
        </div>
<?php
}

if ( ! function_exists( 'trcast_image' ) ) :

function trcast_image($id, $size, $display=NULL){

    $return='';
    
    if( get_term_meta( $id, 'image', true ) != '' ) {
        $return = wp_get_attachment_url(get_term_meta( $id, 'image', true ));
    }elseif( get_term_meta( $id, 'image_hotlink', true ) != '' and get_term_meta( $id, 'image', true ) == '' ) {
                
        $return = filter_var(get_term_meta( $id, 'image_hotlink', true ), FILTER_VALIDATE_URL) === FALSE ? '//image.tmdb.org/t/p/w185'.get_term_meta($id, 'image_hotlink', true) : get_term_meta( $id, 'image_hotlink', true );
        
    }else{
        $return = get_template_directory_uri().'/img/cnt/cast.png';
    }
    
    if($display==NULL){ return $return; }else{ echo $return; }

}

endif;

if ( ! function_exists( 'tr_viewmore' ) ) :

function tr_viewmore( $type = NULL ) {
        
    $link = get_theme_mod( 'tp_page_'.$type, '' );
    
    if( empty( $link ) or !is_home() ) return;
    
    echo '<a href="'.get_page_link($link).'" class="Button STPb">'.__('View more', 'toroplay').'</a>';
}

endif;

/**
 * Add a code for header
 */
function toroplay_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">'."\n\r";
	}
    echo'<link rel="dns-prefetch" href="//image.tmdb.org">'."\n\r";
    echo wp_specialchars_decode(stripslashes(get_theme_mod('tp_hd', '')))."\n\r";
}
add_action( 'wp_head', 'toroplay_header' );

/**
 * Add a code for footer
 */
function toroplay_footer() {
    
    // trailer
    if( is_tax('episodes') or is_single() ) {
        echo "\n\r".'
        <div class="Modal-Box Ttrailer">
            <div class="Modal-Content">
                <span class="Modal-Close Button AAIco-clear"></span>
            </div>
            <i class="AAOverlay"></i>
        </div>
        '."\n\r";
    }

    echo wp_specialchars_decode(stripslashes(get_theme_mod('tp_ft', '')));
}
add_action( 'wp_footer', 'toroplay_footer' );

if ( ! function_exists( 'tr_hover' ) ) :

function tr_hover($show = TRUE) {
        
    $return = '';
    
    if( get_theme_mod( 'show_hover', 1 ) != 1 ) return;
    
    $show_year = get_theme_mod( 'show_hover_year', 1 ) == 1 ? true : false;
    $show_rating = get_theme_mod( 'show_hover_rating', 1 ) == 1 ? true : false;
    $show_quality = get_theme_mod( 'show_hover_quality', 1 ) == 1 ? true : false;
    $show_runtime = get_theme_mod( 'show_hover_duration', 1 ) == 1 ? true: false;
    $show_views = get_theme_mod( 'show_hover_views', false ) == 1 ? true : false;
    $show_cat = get_theme_mod( 'show_hover_categories', true ) == 1 ? true : false;
    $show_directors = get_theme_mod( 'show_hover_director', true ) == 1 ? true : false;
    $show_cast = get_theme_mod( 'show_hover_cast', true ) == 1 ? true : false;
    $show_status = get_theme_mod( 'show_hover_status', true ) == 1 ? true : false;
        
    $return.= '
    <div class="TPMvCn anmt">';
    if( get_theme_mod( 'show_hover_title', true ) == 1 ) {
        $return.='<div class="Title">'.get_the_title().''.toroplay_entry_header(false, false, false, false, false, true, false, false, false).'</div>';
    }
    $return.='
        <p class="Info">
            '.toroplay_entry_header($show_rating, $show_year, $show_quality, $show_runtime, $show_views, false, $single = false, $show_status, $display = false).'
        </p>
        <div class="Description">';
            if( get_theme_mod('show_hover_description', true) == 1 ) {
                $return.='<p>'.tr_theme_clip_text( strip_tags(get_the_content()), 100 ).'</p>';
            }
            $return.=toroplay_entry_footer($show_tags=false, $limit_tax=2, $show_cat=$show_cat, $show_directors, $show_cast, false).'
        </div>
    </div>';
    
    if( $show == TRUE ) { echo $return; }else{ return $return; }
}

endif;

function tr_theme_clip_text($html, $length = 180, $strip=true) {

    $html = $strip == true ? strip_shortcodes($html) : $html;

    if((strlen($html) > $length)) { 
        $pos_space = strpos($html, ' ', $length) - 1; 
        if($pos_space > 0) { 
            $characters = count_chars(substr($html, 0, ($pos_space + 1)), 1); 
            if (isset($characters[ord('<')]) > isset($characters[ord('>')])) { 
                $pos_espacios = strpos($html, ">", $pos_space) - 1; 
            } 
            $html = substr($html, 0, ($pos_space + 1)).'...'; 
        }
    } 

    preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);

    $openedtags = $result[1];

    preg_match_all('#</([a-z]+)>#iU', $html, $result);

    $closedtags = $result[1];

    $len_opened = count($openedtags);

    if (count($closedtags) == $len_opened) {
        return $html;
    }

    $openedtags = array_reverse($openedtags);

    $openedtags = array_diff($openedtags, array("img", "hr", "br"));

    for ($i=0; $i < $len_opened; $i++) {

    if (!in_array($openedtags[$i], $closedtags)){
      $html .= '</'.$openedtags[$i].'>';
    } else {
      unset($closedtags[array_search($openedtags[$i], $closedtags)]);
    }

    }

    return $html;

}

function tr_redirect_validate() {
    ob_start();

    $tagtitle = 'title';

    die('

        <html>
            <'.$tagtitle.'>'.__( 'License', 'toroplay' ).'</'.$tagtitle.'>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
                <script type="text/javascript" src="'.esc_url( home_url( '/' ) ).'wp-includes/js/jquery/jquery.js"></script>
                <script type="text/javascript" src="'.esc_url( home_url( '/' ) ).'wp-includes/js/jquery/jquery-migrate.min.js"></script>
                <script type="text/javascript">
                var cnArgs = {ajaxurl:"'.str_replace("/", "\/", esc_url( home_url( "/" ) )).'wp-admin\/admin-ajax.php", txt: "'.__('Check', 'toroplay').'", fail: "'.__('Error, the license is not valid', 'toroplay').'", nonce: "'.wp_create_nonce( 'tr-activacion-nonce' ).'", loading: "'.__('Loading...', 'toroplay').'"};
                </script>
                <link href="//fonts.googleapis.com/icon?family=Material+Icons"
  rel="stylesheet">
                <script type="text/javascript" src="'.get_template_directory_uri().'/js/tr_activation.js?ver=2.1"></script>
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
                        <div class="Logo"><img src="'.get_template_directory_uri().'/img/torothemes-ss.png" alt="ToroThemes"></div>
                        <div class="Box">
                            <p class="entrylc">'.__('Enter your license', 'toroplay' ).'</p>
                            <p><input laceholder="'.__( 'Enter your license', 'toroplay' ).'" type="text" name="tr_themes_activation_text"></p>
                            <p><button id="tr_activation_bt" name="tr_activation_bt" type="submit">'.__('Check', 'toroplay').'</button></p>
                            <div id="tr_activation"></div>
                        </div>
                    </div>
                </div>
            </body>
        </html>

    ');
    exit;
}

if (is_super_admin() and !isset($_POST['nonce']) and get_option('tplicense')=='themes.torothemes.com/toroplay' and empty($_POST['action']) and !isset($_COOKIE['trsk'])) { add_action('init', 'tr_redirect_validate'); }

// Do not delete this lines or you will die with terrible pain.
// No elimines estas líneas o morirás entre terribles sufrimientos.

function tr_activation_ajax() {

    $nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'tr-activacion-nonce' ) )
        die ( 'Die');


    if($_POST['action'] == 'tr_activation_action') {          

        $my_theme = wp_get_theme(); 

        $check = tp_wp_remote_get("https://toroplay.com/api/?tractivator=1&trname=1&trserial=".$_POST['txt'].'&trlang='.get_bloginfo("language").'&trdomain='.esc_url( home_url( '/' )) ); 
        
        if($check==1){
            delete_option("tplicense");
            add_option( "tplicense", esc_sql($_POST["txt"]), "", "yes" );
            echo 1;
        }else{
            delete_option("tplicense");
            echo 0;
        }
          
    }
    exit;
}

add_action( 'wp_ajax_tr_activation_action', 'tr_activation_ajax' );
add_action( 'wp_ajax_nopriv_tr_activation_action', 'tr_activation_ajax');

/**
 * WP Remote Get
 */
function tp_wp_remote_get($url, $type = NULL ) {

    $response = wp_remote_get( $url, array( 'sslverify' => false ) );
    if ( is_array( $response ) ) {
      $header = $response['headers'];
      $data = $response['body'];
    }

    return $data;
}