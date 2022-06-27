<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function tr_grabber_add_custom_taxonomies() {
    global $pagenow, $config_grabber;

    $slug_letters = TR_GRABBER_FIELD_LETTERS;
    $slug_season = TR_GRABBER_PREFIX_SEASON;
    $slug_episode = TR_GRABBER_PREFIX_EPISODE;
    $slug_directors = TR_GRABBER_PREFIX_DIRECTOR;
    $slug_cast = TR_GRABBER_PREFIX_CAST;
    $slug_directorstv = TR_GRABBER_PREFIX_DIRECTORTV;
    $slug_casttv = TR_GRABBER_PREFIX_CASTTV;
    
    register_taxonomy('server', '', array(
            'hierarchical' => true,
            'public' => true,
            'rewrite' => true,
            'query_var' => true,
            'labels' => array(
            'name' => __('Servers', 'tr-grabber'),
            'singular_name' => __('Server', 'tr-grabber'),
            'search_items' =>  __('Search', 'tr-grabber'),
            'all_items' => __('All', 'tr-grabber'),
            'parent_item' => __('Parent', 'tr-grabber'),
            'parent_item_colon' => __('Parent', 'tr-grabber'),
            'edit_item' => __('Edit', 'tr-grabber'),
            'update_item' => __('Update', 'tr-grabber'),
            'add_new_item' => __('Add', 'tr-grabber'),
            'new_item_name' => __('New', 'tr-grabber'),
            'menu_name' => __('Servers', 'tr-grabber'),
        ),
        'rewrite' => array(
            'slug' => __('server', 'tr-grabber'),
            'with_front' => true,
            'hierarchical' => true
        ),
    ));

    register_taxonomy('language', '', array(
            'hierarchical' => true,
            'public' => true,
            'rewrite' => true,
            'query_var' => true,
            'labels' => array(
            'name' => __('Languages', 'tr-grabber'),
            'singular_name' => __('Language', 'tr-grabber'),
            'search_items' =>  __('Search', 'tr-grabber'),
            'all_items' => __('All', 'tr-grabber'),
            'parent_item' => __('Parent', 'tr-grabber'),
            'parent_item_colon' => __('Parent', 'tr-grabber'),
            'edit_item' => __('Edit', 'tr-grabber'),
            'update_item' => __('Update', 'tr-grabber'),
            'add_new_item' => __('Add', 'tr-grabber'),
            'new_item_name' => __('New', 'tr-grabber'),
            'menu_name' => __('Languages', 'tr-grabber'),
        ),
        'rewrite' => array(
            'slug' => __('lang', 'tr-grabber'),
            'with_front' => true,
            'hierarchical' => true
        ),
    ));

    register_taxonomy('quality', '', array(
            'hierarchical' => true,
            'public' => true,
            'rewrite' => true,
            'query_var' => true,
            'labels' => array(
            'name' => __('Quality', 'tr-grabber'),
            'singular_name' => __('Quality', 'tr-grabber'),
            'search_items' =>  __('Search', 'tr-grabber'),
            'all_items' => __('All', 'tr-grabber'),
            'parent_item' => __('Parent', 'tr-grabber'),
            'parent_item_colon' => __('Parent', 'tr-grabber'),
            'edit_item' => __('Edit', 'tr-grabber'),
            'update_item' => __('Update', 'tr-grabber'),
            'add_new_item' => __('Add', 'tr-grabber'),
            'new_item_name' => __('New', 'tr-grabber'),
            'menu_name' => __('Quality', 'tr-grabber'),
        ),
        'rewrite' => array(
            'slug' => __('quality', 'tr-grabber'),
            'with_front' => true,
            'hierarchical' => true
        ),
    ));
    
    register_taxonomy('letters', '', array(
            'hierarchical' => true,
            'public' => true,
            'rewrite' => true,
            'query_var' => true,
            'labels' => array(
            'name' => __('Letters', 'tr-grabber'),
            'singular_name' => __('Letter', 'tr-grabber'),
            'search_items' =>  __('Search', 'tr-grabber'),
            'all_items' => __('All', 'tr-grabber'),
            'parent_item' => __('Parent', 'tr-grabber'),
            'parent_item_colon' => __('Parent', 'tr-grabber'),
            'edit_item' => __('Edit', 'tr-grabber'),
            'update_item' => __('Update', 'tr-grabber'),
            'add_new_item' => __('Add', 'tr-grabber'),
            'new_item_name' => __('New', 'tr-grabber'),
            'menu_name' => __('Letters', 'tr-grabber'),
        ),
        'rewrite' => array(
            'slug' => $slug_letters,
            'with_front' => true,
            'hierarchical' => true
        ),
    ));

    register_taxonomy('seasons', '', 
        array(
            'hierarchical' => false,
            'labels' => array(
            'name' => __('Seasons', 'tr-grabber'),
            'singular_name' => __('Season', 'tr-grabber'),
            'search_items' =>  __('Search', 'tr-grabber'),
            'all_items' => __('All', 'tr-grabber'),
            'parent_item' => __('Parent', 'tr-grabber'),
            'parent_item_colon' => __('Parent', 'tr-grabber'),
            'edit_item' => __('Edit', 'tr-grabber'),
            'update_item' => __('Update', 'tr-grabber'),
            'add_new_item' => __('Add', 'tr-grabber'),
            'new_item_name' => __('New', 'tr-grabber'),
            'menu_name' => __('Seasons', 'tr-grabber'),
        ),
        'rewrite' => array(
            'slug' => $slug_season,
            'with_front' => true,
            'hierarchical' => true
        ),
    ));

    register_taxonomy('episodes', '', array(
            'hierarchical' => false,
            'labels' => array(
            'name' => __('Episodes', 'tr-grabber'),
            'singular_name' => __('Episode', 'tr-grabber'),
            'search_items' =>  __('Search', 'tr-grabber'),
            'all_items' => __('All', 'tr-grabber'),
            'parent_item' => __('Parent', 'tr-grabber'),
            'parent_item_colon' => __('Parent', 'tr-grabber'),
            'edit_item' => __('Edit', 'tr-grabber'),
            'update_item' => __('Update', 'tr-grabber'),
            'add_new_item' => __('Add', 'tr-grabber'),
            'new_item_name' => __('New', 'tr-grabber'),
            'menu_name' => __('Episodes', 'tr-grabber'),
        ),
        'rewrite' => array(
            'slug' => $slug_episode,
            'with_front' => true,
            'hierarchical' => true
        ),
    ));

    if( tr_grabber_type() == 1 or !is_admin() or wp_doing_ajax() or in_array( $pagenow, array( 'options-permalink.php' ) ) or isset( $_GET['page'] ) and $_GET['page'] == 'wpseo_titles' ) {
        
        register_taxonomy('country', 'movies', array(
                'hierarchical' => false,
                'public' => true,
                'rewrite' => true,
                'query_var' => true,
                'labels' => array(
                'name' => __('Countries', 'tr-grabber'),
                'singular_name' => __('Country', 'tr-grabber'),
                'search_items' =>  __('Search', 'tr-grabber'),
                'all_items' => __('All', 'tr-grabber'),
                'parent_item' => __('Parent', 'tr-grabber'),
                'parent_item_colon' => __('Parent', 'tr-grabber'),
                'edit_item' => __('Edit', 'tr-grabber'),
                'update_item' => __('Update', 'tr-grabber'),
                'add_new_item' => __('Add', 'tr-grabber'),
                'new_item_name' => __('New', 'tr-grabber'),
                'menu_name' => __('Countries', 'tr-grabber'),
            ),
            'rewrite' => array(
                'slug' => __('country', 'tr-grabber'),
                'with_front' => true,
                'hierarchical' => true
            ),
        ));

        register_taxonomy('directors', 'movies', array(
                'hierarchical' => false,
                'labels' => array(
                'name' => __('Directors', 'tr-grabber'),
                'singular_name' => __('Director', 'tr-grabber'),
                'search_items' =>  __('Search', 'tr-grabber'),
                'all_items' => __('All', 'tr-grabber'),
                'parent_item' => __('Parent', 'tr-grabber'),
                'parent_item_colon' => __('Parent', 'tr-grabber'),
                'edit_item' => __('Edit', 'tr-grabber'),
                'update_item' => __('Update', 'tr-grabber'),
                'add_new_item' => __('Add', 'tr-grabber'),
                'new_item_name' => __('New', 'tr-grabber'),
                'menu_name' => __('Directors', 'tr-grabber'),
            ),
            'rewrite' => array(
                'slug' => $slug_directors,
                'with_front' => true,
                'hierarchical' => true
            ),
        ));

        register_taxonomy('cast', 'movies', array(
                'hierarchical' => false,
                'labels' => array(
                'name' => __('Cast', 'tr-grabber'),
                'singular_name' => __('Cast', 'tr-grabber'),
                'search_items' =>  __('Search', 'tr-grabber'),
                'all_items' => __('All', 'tr-grabber'),
                'parent_item' => __('Parent', 'tr-grabber'),
                'parent_item_colon' => __('Parent', 'tr-grabber'),
                'edit_item' => __('Edit', 'tr-grabber'),
                'update_item' => __('Update', 'tr-grabber'),
                'add_new_item' => __('Add', 'tr-grabber'),
                'new_item_name' => __('New', 'tr-grabber'),
                'menu_name' => __('Cast', 'tr-grabber'),
            ),
            'rewrite' => array(
                'slug' => $slug_cast,
                'with_front' => true,
                'hierarchical' => true
            ),
        ));
        
    }
    
    if( tr_grabber_type() == 2 or wp_doing_ajax() or isset( $_GET['taxonomy'] ) or !is_admin() or in_array( $pagenow, array( 'options-permalink.php' ) ) or in_array( $pagenow, array( 'edit-tags.php' ) ) or isset( $_GET['page'] ) and $_GET['page'] == 'wpseo_titles' ) {
        
        register_taxonomy('directors_tv', 'series', array(
                'hierarchical' => false,
                'labels' => array(
                'name' => __('Directors', 'tr-grabber'),
                'singular_name' => __('Director', 'tr-grabber'),
                'search_items' =>  __('Search', 'tr-grabber'),
                'all_items' => __('All', 'tr-grabber'),
                'parent_item' => __('Parent', 'tr-grabber'),
                'parent_item_colon' => __('Parent', 'tr-grabber'),
                'edit_item' => __('Edit', 'tr-grabber'),
                'update_item' => __('Update', 'tr-grabber'),
                'add_new_item' => __('Add', 'tr-grabber'),
                'new_item_name' => __('New', 'tr-grabber'),
                'menu_name' => __('Directors', 'tr-grabber'),
            ),
            'rewrite' => array(
                'slug' => $slug_directorstv,
                'with_front' => true,
                'hierarchical' => true
            ),
        ));

        register_taxonomy('cast_tv', 'series', array(
                'hierarchical' => false,
                'labels' => array(
                'name' => __('Cast', 'tr-grabber'),
                'singular_name' => __('Cast', 'tr-grabber'),
                'search_items' =>  __('Search', 'tr-grabber'),
                'all_items' => __('All', 'tr-grabber'),
                'parent_item' => __('Parent', 'tr-grabber'),
                'parent_item_colon' => __('Parent', 'tr-grabber'),
                'edit_item' => __('Edit', 'tr-grabber'),
                'update_item' => __('Update', 'tr-grabber'),
                'add_new_item' => __('Add', 'tr-grabber'),
                'new_item_name' => __('New', 'tr-grabber'),
                'menu_name' => __('Cast', 'tr-grabber'),
            ),
            'rewrite' => array(
                'slug' => $slug_casttv,
                'with_front' => true,
                'hierarchical' => true
            ),
        ));
        
    }

    if( is_admin() and $config_grabber['abc'] == 1 ){

        // add abc

        $taxonomy_exist = term_exists('A', 'letters');

        if($taxonomy_exist==''){
            wp_insert_term(
              '#',
              'letters',
              array(
                'slug' => __('0-9', 'tr-grabber'),
              )
            );
            for($i=65; $i<=90; $i++) {

                $letter = strtoupper(chr($i));

                $term_letter = term_exists($letter, 'letters');
                if ($term_letter == null) {
                    wp_insert_term($letter, 'letters');
                }

            }
            $config_grabber['abc'] = 2;
            update_option( "tr_grabber", serialize($config_grabber) );
        }

    }

}

add_action( 'init', 'tr_grabber_add_custom_taxonomies' );