<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists('trgrabber_post_type') ) {

// Register Custom Post Type
function trgrabber_post_type() {
    
    if( TR_GRABBER_PREFIX_POSTS == 0 ) {

        $slug_movies = '';

        $slug_series = '';

    }else{

        $slug_movies = TR_GRABBER_SLUG_MOVIES;

        $slug_series = TR_GRABBER_SLUG_SERIES;

    }
    
    if( defined('TR_GRABBER_MOVIES') ) {

	$labels = array(
		'name'                  => _x( 'Movies', 'Post Type General Name', 'tr-grabber' ),
		'singular_name'         => _x( 'Movie', 'Post Type Singular Name', 'tr-grabber' ),
		'menu_name'             => __( 'Movies', 'tr-grabber' ),
		'name_admin_bar'        => __( 'Movies', 'tr-grabber' ),
		'archives'              => __( 'Item Archives', 'tr-grabber' ),
		'attributes'            => __( 'Item Attributes', 'tr-grabber' ),
		'parent_item_colon'     => __( 'Parent Item:', 'tr-grabber' ),
		'all_items'             => __( 'All Items', 'tr-grabber' ),
		'add_new_item'          => __( 'Add New Item', 'tr-grabber' ),
		'add_new'               => __( 'Add New', 'tr-grabber' ),
		'new_item'              => __( 'New Item', 'tr-grabber' ),
		'edit_item'             => __( 'Edit Item', 'tr-grabber' ),
		'update_item'           => __( 'Update Item', 'tr-grabber' ),
		'view_item'             => __( 'View Item', 'tr-grabber' ),
		'view_items'            => __( 'View Items', 'tr-grabber' ),
		'search_items'          => __( 'Search Item', 'tr-grabber' ),
		'not_found'             => __( 'Not found', 'tr-grabber' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'tr-grabber' ),
		'featured_image'        => __( 'Featured Image', 'tr-grabber' ),
		'set_featured_image'    => __( 'Set featured image', 'tr-grabber' ),
		'remove_featured_image' => __( 'Remove featured image', 'tr-grabber' ),
		'use_featured_image'    => __( 'Use as featured image', 'tr-grabber' ),
		'insert_into_item'      => __( 'Insert into item', 'tr-grabber' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'tr-grabber' ),
		'items_list'            => __( 'Items list', 'tr-grabber' ),
		'items_list_navigation' => __( 'Items list navigation', 'tr-grabber' ),
		'filter_items_list'     => __( 'Filter items list', 'tr-grabber' ),
	);
	$args = array(
		'label'                 => __( 'Movie', 'tr-grabber' ),
		'description'           => __( 'For Movies', 'tr-grabber' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
        'rewrite' => array(
            'slug' => $slug_movies,
            'with_front' => true,
        )
	);
	register_post_type( 'movies', $args );
    }
    
    if( defined('TR_GRABBER_SERIES') ) {        
        
	$labels = array(
		'name'                  => _x( 'Series', 'Post Type General Name', 'tr-grabber' ),
		'singular_name'         => _x( 'Serie', 'Post Type Singular Name', 'tr-grabber' ),
		'menu_name'             => __( 'Series', 'tr-grabber' ),
		'name_admin_bar'        => __( 'Series', 'tr-grabber' ),
		'archives'              => __( 'Item Archives', 'tr-grabber' ),
		'attributes'            => __( 'Item Attributes', 'tr-grabber' ),
		'parent_item_colon'     => __( 'Parent Item:', 'tr-grabber' ),
		'all_items'             => __( 'All Items', 'tr-grabber' ),
		'add_new_item'          => __( 'Add New Item', 'tr-grabber' ),
		'add_new'               => __( 'Add New', 'tr-grabber' ),
		'new_item'              => __( 'New Item', 'tr-grabber' ),
		'edit_item'             => __( 'Edit Item', 'tr-grabber' ),
		'update_item'           => __( 'Update Item', 'tr-grabber' ),
		'view_item'             => __( 'View Item', 'tr-grabber' ),
		'view_items'            => __( 'View Items', 'tr-grabber' ),
		'search_items'          => __( 'Search Item', 'tr-grabber' ),
		'not_found'             => __( 'Not found', 'tr-grabber' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'tr-grabber' ),
		'featured_image'        => __( 'Featured Image', 'tr-grabber' ),
		'set_featured_image'    => __( 'Set featured image', 'tr-grabber' ),
		'remove_featured_image' => __( 'Remove featured image', 'tr-grabber' ),
		'use_featured_image'    => __( 'Use as featured image', 'tr-grabber' ),
		'insert_into_item'      => __( 'Insert into item', 'tr-grabber' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'tr-grabber' ),
		'items_list'            => __( 'Items list', 'tr-grabber' ),
		'items_list_navigation' => __( 'Items list navigation', 'tr-grabber' ),
		'filter_items_list'     => __( 'Filter items list', 'tr-grabber' ),
	);
	$args = array(
		'label'                 => __( 'Serie', 'tr-grabber' ),
		'description'           => __( 'For Series', 'tr-grabber' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
        'rewrite' => array(
            'slug' => $slug_series,
            'with_front' => true,
        )
	);
	register_post_type( 'series', $args );
    }

}
add_action( 'init', 'trgrabber_post_type', 0 );

}

?>