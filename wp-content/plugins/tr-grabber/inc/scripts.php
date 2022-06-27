<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function tr_grabber_init_print() {
    if ( is_admin() ) {
        global $pagenow;

        $_GET['post'] = empty($_GET['post']) ? '' : intval($_GET['post']);
        wp_enqueue_script('jquery-ui-droppable');
        wp_enqueue_media();
        $myvars = array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'loading' => __('Loading...', 'tr-grabber' ),
            'nonce' => wp_create_nonce( 'tr-grabber-nonce' ),
            'language' => get_bloginfo("language"),
            'api_key' => TR_GRABBER_API_KEY,
            'post_id' => intval($_GET['post']),
            'empty' => __('Enter an ID', 'tr-grabber')
        );
        wp_enqueue_script( 'tr-grabber-admin', TR_GRABBER_PLUGIN_URL."assets/js/admin.js", array('jquery', 'jquery-ui-sortable', 'wp-color-picker'), TR_GRABBER_VERSION, true);
        wp_localize_script( 'tr-grabber-admin', 'TrGrabber', $myvars );
        wp_enqueue_style("tr-grabber-admin", TR_GRABBER_PLUGIN_URL."assets/css/admin.css", false, TR_GRABBER_VERSION, "all");
        
        if( in_array( $pagenow, array( 'edit-tags.php' ) ) and isset($_GET['taxonomy']) and $_GET['taxonomy'] == 'seasons' or in_array( $pagenow, array( 'edit-tags.php' ) ) and isset($_GET['taxonomy']) and $_GET['taxonomy'] == 'episodes' or in_array( $pagenow, array( 'post.php' ) ) and tr_grabber_type( $_GET['post'] ) == 2 ) {
            
            $myvars_live = array( 
                'url' => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( 'trgrabberlive' ),
                'loading' => __('Loading', 'tr-grabber'),
                'none' => __('There were no results', 'tr-grabber'),
                'none_season' => __('You must fill in the season field', 'tr-grabber'),
                'none_episode' => __('You must fill in the episode field', 'tr-grabber'),
                'none_type' => __('You must fill in the type field', 'tr-grabber'),
                'none_lang' => __('You must fill in the field language', 'tr-grabber'),
                'none_quality' => __('You must fill in the quality field', 'tr-grabber'),
                'none_links' => __('You must fill in the links field', 'tr-grabber'),
            );
            wp_enqueue_script('trgrabberlive', TR_GRABBER_PLUGIN_URL.'assets/js/trlive.js',array('jquery'), TR_GRABBER_VERSION,true);
            wp_localize_script( 'trgrabberlive', 'trgrabberlive', $myvars_live );
            
        }
        
    }
}

add_action( 'admin_print_styles', 'tr_grabber_init_print', 11 );

?>