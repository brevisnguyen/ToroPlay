<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once(TR_GRABBER_PLUGIN_DIR.'inc/class.permalinks.php');

function tr_grabber_add_rewrite_rules() {
    
    add_rewrite_rule(TR_GRABBER_FIELD_LETTERS.'/([^/]+)/page/([0-9]+)?$',
    'index.php?letters=$matches[1]&trpage=$matches[2]',
    'top');

}
add_filter('init', 'tr_grabber_add_rewrite_rules', 9999);


if( TR_GRABBER_PREFIX_POSTS == 0 ) {

function trgrabbertype_remove_slug( $post_link, $post, $leavename ) {

    if ( 'movies' != $post->post_type || 'publish' != $post->post_status and 'series' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }

    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

    return $post_link;
}
add_filter( 'post_type_link', 'trgrabbertype_remove_slug', 10, 3 );
add_filter( 'post_link', 'trgrabbertype_remove_slug', 10, 3 );

function trgrabber_parse_request( $query ) {

    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }

    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'movies', 'series', 'page' ) );
    }
}
add_action( 'pre_get_posts', 'trgrabber_parse_request' );
}

function tr_grabber_query_vars( $vars ) {
    array_push($vars, 'tr_post_type');
    array_push($vars, 'trpage');
    array_push($vars, 'trtype');
    array_push($vars, 'trfilter');
    array_push($vars, 'trembed');
    array_push($vars, 'trhide');
    array_push($vars, 'trid');
    array_push($vars, 'trdownload');
    array_push($vars, 'trhex');
    array_push($vars, 'tid');
    return $vars;
}
add_filter( 'query_vars','tr_grabber_query_vars' );