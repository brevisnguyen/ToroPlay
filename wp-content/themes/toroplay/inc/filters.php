<?php

if ( ! function_exists( 'tr_dynamic_sidebar_before' ) ) :

function tr_dynamic_sidebar_before( ) {
    
    if( is_single() and get_theme_mod('show_related', 1) == 1 or is_tax('seasons') and get_theme_mod('show_related', 1) == 1 or is_tax('episodes') and get_theme_mod('show_related', 1) == 1 ) {
        global $post;
        
        if( empty($post->ID) ) {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $tr_id = get_term_meta( $term->term_id, 'tr_id_post', true );
        }else{
            $tr_id = $post->ID;
        }
        
        $type = tr_check_type($tr_id) == 1 ? 0 : 1;
        
        $cat = get_the_category($tr_id);
                        
        foreach ($cat as &$value) $list[]= $value->term_id;
        
        $list = isset($list) ? implode(',', $list) : '';
        
        the_widget( 'WP_Widget_Trposts', array( 'title' => get_theme_mod( 'tp_related', __('Related', 'toroplay') ), 'filter' => $list, 'design' => 1, 'type' => $type, 'order' => 4, 'number' => get_theme_mod( 'tp_posts_per_related', 6 ), 'related' => 1, 'tag' => get_theme_mod('tp_titlerelated_tag', 'div') ) );
        
    }

}

add_filter( 'dynamic_sidebar_before', 'tr_dynamic_sidebar_before' );

endif;
    
add_filter( 'is_active_sidebar', 'tr_is_active_sidebar' );

function tr_is_active_sidebar($index) {
    global $post;
    if( is_page() and get_post_meta( $post->ID, 'no_sidebar', true ) == 1 or get_theme_mod('tp_sidebar', 2) == 0 ) { return ''; }else{ return $index; }
}

add_action( 'init', 'tr_plugin_required' );

function tr_plugin_required() {
    if( !defined('TR_GRABBER_VERSION') and !is_admin() and $GLOBALS['pagenow'] != 'wp-login.php' ) {
      wp_die( __( 'This theme requires TR Grabber plugin activation to work.' , 'toroplay' ) );
    }
}

add_filter( 'wp_default_scripts', 'tr_dequeue_jquery_migrate' );

function tr_dequeue_jquery_migrate( &$scripts){
	if( !is_admin() ){
		$scripts->remove( 'jquery');
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
	}
}

add_action( 'script_loader_tag', 'tr_remove_scripts', 10, 3 );

function tr_remove_scripts($tag, $handle, $src) {
    
    if( $handle == 'wp-postratings' or $handle == 'wp-embed' ) { return ''; }else{ return $tag; }
}

add_filter('style_loader_tag', 'tr_style_loader_tag');

function tr_style_loader_tag($tag){

    $tag = preg_replace("/id='toroplay-fontawesome-css'/", "id='toroplay-fontawesome' onload=\"if(media!='all')media='all'\"", $tag);

    $tag = preg_replace("/id='toroplay-material-css'/", "id='toroplay-material' onload=\"if(media!='all')media='all'\"", $tag);

    return $tag;
}

function tr_pre_get_posts( $query ) {
            
    if ( !is_admin() && $query->is_main_query() ) {
        $query->set( 'posts_per_page', get_theme_mod('tp_posts_per_page', 20) );
    }
    
    if ( !is_admin() && $query->is_main_query() && $query->is_category() ) {
        $query->set( 'posts_per_page', get_theme_mod('tp_posts_per_category', 20) );
    }
    
    if ( !is_admin() && $query->is_main_query() && $query->is_tag() ) {
        $query->set( 'posts_per_page', get_theme_mod('tp_posts_per_tag', 20) );
    }
    
    if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
        $query->set( 'posts_per_page', get_theme_mod('tp_posts_per_search', 20) );
    }
    
    if ( $query->is_main_query() and !is_admin() and is_tax( 'letters' ) ) {
        $query->set( 'posts_per_page', get_theme_mod('tp_posts_per_abc', 20) );
    }
    
    if ( !is_admin() && $query->is_main_query() ) {
        $query->set( 'ignore_sticky_posts', 1 );
    }
        
}
add_action( 'pre_get_posts', 'tr_pre_get_posts' );

function tr_custom_logo() {
    $url = '';
    if( is_customize_preview() ) $url = ' data-url="'.get_theme_mod('tp_logo', get_template_directory_uri().'/img/toroplay-logo.svg"').'"';
    $logo = get_theme_mod('tp_logo') == '' ? get_template_directory_uri().'/img/toroplay-logo.svg' : get_theme_mod('tp_logo');
    return '<a href="'.esc_url( home_url( '/' ) ).'"><img'.$url.' src="'.$logo.'" alt="'.get_bloginfo( 'name' ).'" class="custom-logo"></a>';
}
add_filter('get_custom_logo', 'tr_custom_logo');

add_filter('max_srcset_image_width', create_function('', 'return 1;'));

function tr_disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

}
add_action( 'init', 'tr_disable_wp_emojicons' );

function tr_delete_css_recentcomments() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'tr_delete_css_recentcomments');