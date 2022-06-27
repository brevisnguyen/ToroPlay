<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function tr_grabber_pregetposts( $query ) {
    global $pagenow;
        
    if ( $query->is_main_query() and !is_admin() and is_tax( 'letters' ) ) {
        global $wp_query;
        
        $current = $wp_query->queried_object;
        $paged = ( get_query_var( 'trpage' ) ) ? get_query_var( 'trpage' ) : 1;
        
        $query->set( 'post_type', array('movies', 'series') );
        $query->set( 'letters', '' );
        $query->set( '_name__like', $current->slug );
        $query->set( 'orderby', 'name' );
        $query->set( 'order', 'asc' );
        $query->set( 'paged', $paged );
        
    }
    
   if ( $query->is_main_query() && !is_admin() ) {
       
       $_GET['tr_post_type'] = isset( $_GET['tr_post_type'] ) ? intval( $_GET['tr_post_type'] ) : '';
       
       if( isset($_GET['tr_post_type']) and $_GET['tr_post_type'] == 1 ){
           
           $pt = 'movies';
           
       }elseif( isset($_GET['tr_post_type']) and $_GET['tr_post_type'] == 2 ) {
           
           $pt = 'series';
           
       }else{
           
           $pt = array('movies', 'series', 'page');
           
       }

       $query->set('post_type', $pt );
       
   }
}
add_action( 'pre_get_posts', 'tr_grabber_pregetposts' );

function tr_grabber_remove_menus() { remove_menu_page( 'edit.php' ); }
add_action( 'admin_menu', 'tr_grabber_remove_menus' );

add_filter('manage_movies_posts_columns', 'tr_grabber_posts_columns');
add_filter('manage_series_posts_columns', 'tr_grabber_posts_columns');

function tr_grabber_posts_columns( $columns ) {
	unset($columns['tags'], $columns['author'], 
  	$columns['categories'], $columns['comments'], $columns['date'], $columns['title']);
	return $columns;
}

add_filter('manage_movies_posts_columns', 'tr_grabber_table_head');
add_filter('manage_series_posts_columns', 'tr_grabber_table_head');

function tr_grabber_table_head( $defaults ) {
    global $wp_query;
    $defaults['tr-grabber-img'] = __($wp_query->found_posts.' Results', 'tr-grabber');
    $defaults['tr-grabber-year'] = __('Year', 'tr-grabber');
    $defaults['tr-grabber-duration'] = __('Duration', 'tr-grabber');
    $defaults['tr-grabber-options'] = __('Options', 'tr-grabber');
    return $defaults;
}

add_action('manage_movies_posts_custom_column', 'tr_grabber_table_content' );
add_action('manage_series_posts_custom_column', 'tr_grabber_table_content' );

function tr_grabber_table_content( $column_name ) {
    global $post;
        
    if ($column_name == 'tr-grabber-img') {
        echo trgrabber_img( $post->ID, 'thumbnail', get_the_title( $post->ID ) ).'<span><a data-id="'.$post->ID.'" class="trgrabber_viewlink" href="#">'.get_the_title($post->ID).'</a></span>';
    }
    if ($column_name == 'tr-grabber-year') {
        trgrabber_info('year');
    }
    if ($column_name == 'tr-grabber-duration') {
        trgrabber_info('runtime');
    }
    if ($column_name == 'tr-grabber-options') {
        echo '<a data-id="'.$post->ID.'" class="button edtlnk trgrabber_editlink" href="#"><i class="dashicons dashicons-edit"></i>'.__('Edit', 'tr-grabber').'</a><a data-id="'.$post->ID.'" class="button dltlnk trgrabber_deletelink" href="#"><i class="dashicons dashicons-trash"></i>'.__('Delete', 'tr-grabber').'</a>';
    }
}

add_filter( 'posts_where', function( $where, $q )
{
    if( $name__like = $q->get( '_name__like' ) )
    {
        global $wpdb;

        if($name__like=='0-9'){
            $where .= $wpdb->prepare(
                " AND {$wpdb->posts}.post_title REGEXP '%s' ",
                    $wpdb->esc_like('^[0-9|+|-]')
            );  
        }else{
            $where .= $wpdb->prepare(
                " AND {$wpdb->posts}.post_title LIKE %s ",
                str_replace( 
                    array( '**', '*' ), 
                    array( '*',  '%' ),
                    mb_strtolower( $wpdb->esc_like( $name__like ).'%' ) 
                )
            );
        }

    }       
    return $where;
}, 10, 2 );

add_filter( 'terms_clauses', function( $clauses, $taxonomy, $args )
{
    if ( ! empty( $args['trsearch'] ) ) {
        global $wpdb;
        
        $clauses['where'] .= $wpdb->prepare( 
            " AND t.slug LIKE %s",
            '%'.$wpdb->esc_like( $args['trsearch'] ).'%'      
        );
        
    }

    return $clauses; 
}, 10, 3 );

add_action('pre_get_posts', function($qry) {

        if (is_admin()) return;

        if (is_tax('server') or is_tax('language') or is_tax('quality')){
            $qry->set_404();
        }

    }

);

add_filter( 'pre_get_document_title', 'trg_filter_search_title', 9999 );
add_filter( 'wp_title', 'trg_filter_search_title', 9999, 3 );

function trg_filter_search_title( $title ) {
    if(get_query_var('trfilter')==''){
        return $title;
    }else{
        return __('Advance Search', 'tttttttt');
    }
}

add_filter( 'template_include', 'trgrabber_template', 99 );

function trgrabber_template( $template ) {

    if( get_query_var('trembed') != '' and get_query_var('trid') != '' ) {
	   $template = TR_GRABBER_PLUGIN_DIR.'inc/embed.php';
    }
    
    if( get_query_var('trhide') ) {
	   $template = TR_GRABBER_PLUGIN_DIR.'inc/hide.php';
    }
    
    return $template;
}

function trgrabber_template_redirect() {
    
    if( get_query_var('trdownload') != '' and get_query_var('trid') != '' ) {
        
        $type = get_term_meta( intval(get_query_var('trid')), 'tr_id_post', true );
        
        $link = $type == '' ? unserialize ( get_post_meta( intval(get_query_var('trid')), 'trglinks_'.intval(get_query_var('trdownload')), true ) ) : unserialize ( get_term_meta( intval(get_query_var('trid')), 'trglinks_'.intval(get_query_var('trdownload')), true ) );

        $link = base64_decode( $link['link'] );
        
        wp_redirect( esc_url_raw( $link, array('http', 'https') ) );
        die;
    }
    
}
add_action( 'template_redirect', 'trgrabber_template_redirect' );

function thumbnailid_custom_field_filter($metadata, $object_id, $meta_key, $single) {
    global $post;

    if($meta_key=='_thumbnail_id' && isset($meta_key)){

        $custom_fields = get_post_custom($object_id);

        $content= isset($custom_fields['_thumbnail_id']['0']) ? $custom_fields['_thumbnail_id']['0'] : 'hotlink';

        return $content;
    }
}

if( !is_admin() ){
    add_filter('get_post_metadata', 'thumbnailid_custom_field_filter', 10, 4);
}

add_filter( 'get_terms_args', 'trgrabber_get_terms_args', 10, 3 );

function trgrabber_get_terms_args( $args, $taxonomies ) {
    global $pagenow;
    
    if (in_array( $pagenow, array( 'edit-tags.php' ) ) and is_admin() and isset($args['taxonomy'][0]) and $args['taxonomy'][0] == 'episodes' and isset($_GET['tr_id_post']) ) {
        
        if( isset($_GET['tr_season']) ) {
            $field_key = $_GET['tr_season'] == 0 ? 'season_special' : 'season_number';
            $field_value = $_GET['tr_season'] == 0 ? 1 : intval($_GET['tr_season']);
            
            $args['meta_query'] = array(
                'relation' => 'and',
                 array(
                    'key'       => 'tr_id_post',
                    'value'     => intval($_GET['tr_id_post']),
                    'compare'   => '='
                 ),
                 array(
                    'key'       => $field_key,
                    'value'     => $field_value,
                    'compare'   => '='
                 ),
            );
            
        }else{
            
            $args['meta_query'] = array(
                 array(
                    'key'       => 'tr_id_post',
                    'value'     => intval($_GET['tr_id_post']),
                    'compare'   => '='
                 )
            );
            
        }

    }
    
    if ( in_array( 'seasons', $taxonomies ) && is_admin() && isset( $_GET['tr_id_post'] ) ) {
        
        if( isset($_GET['tr_season']) ) {
            
            $field_key = $_GET['tr_season'] == 0 ? 'season_special' : 'season_number';
            $field_value = $_GET['tr_season'] == 0 ? 1 : intval($_GET['tr_season']);
        
            $args['meta_query'] = array(
                'relation' => 'and',
                 array(
                    'key'       => 'tr_id_post',
                    'value'     => intval($_GET['tr_id_post']),
                    'compare'   => '='
                 ),
                 array(
                    'key'       => $field_key,
                    'value'     => $field_value,
                    'compare'   => '='
                 ),
            );
            
        }else{
            
            $args['meta_query'] = array(
                 array(
                    'key'       => 'tr_id_post',
                    'value'     => intval($_GET['tr_id_post']),
                    'compare'   => '='
                 )
            );
            
        }
        

    }
    
  return $args;
}

function tr_episodes_columns( $columns )
{
    unset($columns['slug']);
    unset($columns['posts']);
    unset($columns['description']);
    
	$columns['tr_season'] = __('Season', 'tr-grabber');
	$columns['tr_episode'] = __('Episode', 'tr-grabber');
	$columns['tr_post'] = __('Post', 'tr-grabber');

	return $columns;
}
add_filter('manage_edit-episodes_columns' , 'tr_episodes_columns');

function tr_episodes_columns_content( $content, $column_name, $term_id )
{
    if ( 'tr_season' == $column_name ) {
        $season_number = get_term_meta($term_id, 'season_number', true) == '' ? 0 : get_term_meta($term_id, 'season_number', true);
        $content = $season_number;
    }
    if ( 'tr_episode' == $column_name ) {
        $content = get_term_meta($term_id, 'episode_number', true);
    }
    if ( 'tr_post' == $column_name ) {
        $content = '<a target="_blank" href="post.php?post='.get_term_meta($term_id, 'tr_id_post', true).'&action=edit">'.get_the_title( get_term_meta($term_id, 'tr_id_post', true) ).'</a>';
    }
	return $content;
}
add_filter( 'manage_episodes_custom_column', 'tr_episodes_columns_content', 10, 3 );

function tr_seasons_columns( $columns )
{
    unset($columns['slug']);
    unset($columns['posts']);
    unset($columns['description']);
    
	$columns['tr_season'] = __('Season', 'tr-grabber');
	$columns['tr_post'] = __('Post', 'tr-grabber');

	return $columns;
}
add_filter('manage_edit-seasons_columns' , 'tr_seasons_columns');

function tr_seasons_columns_content( $content, $column_name, $term_id )
{
    if ( 'tr_season' == $column_name ) {
        $content = get_term_meta($term_id, 'season_number', true);
    }

    if ( 'tr_post' == $column_name ) {
        $content = '<a target="_blank" href="post.php?post='.get_term_meta($term_id, 'tr_id_post', true).'&action=edit">'.get_the_title( get_term_meta($term_id, 'tr_id_post', true) ).'</a>';
    }
	return $content;
}
add_filter( 'manage_seasons_custom_column', 'tr_seasons_columns_content', 10, 3 );