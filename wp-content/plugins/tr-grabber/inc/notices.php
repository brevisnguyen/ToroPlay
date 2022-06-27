<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action('admin_notices', 'tr_grabber_admin_notices');

function tr_grabber_admin_notices() {

    global $_wp_additional_image_sizes;

    $width = get_option( 'thumbnail_size_w' );
    $height = get_option( 'thumbnail_size_h' );

    if(!empty($_wp_additional_image_sizes['post-thumbnail'])){
        $width_theme = $_wp_additional_image_sizes['post-thumbnail']['width'];
        $height_theme = $_wp_additional_image_sizes['post-thumbnail']['height'];
    }else{
        $width_theme = 0; $height_theme = 0;
    }

    if( $width!=$width_theme or $height!=$height_theme ) {

        echo '<div class="error tr_error_thumb"><p>'.sprintf( __('Please, %sbefore proceeding%s, set the thumbnail size correctly, %sclick here%s. (%sx%s)', 'tr-grabber'), '<strong>', '</strong>', '<a href="options-media.php">', '</a>', $width_theme, $height_theme).'</p></div>';
    }
    
    if( defined('TR_BACKDROP_WIDTH') and defined('TR_BACKDROP_HEIGHT') ) {
    
        $width_backdrop = TR_BACKDROP_WIDTH;
        $height_backdrop = TR_BACKDROP_HEIGHT;

        if ( TR_GRABBER_BACKDROP_WIDTH!=$width_backdrop or TR_GRABBER_BACKDROP_HEIGHT!=$height_backdrop ) {
            echo '<div class="error tr_error_thumb"><p>'.sprintf( __('Please, %sbefore proceeding%s, set the backdrop size correctly, %sclick here%s. (%sx%s)', 'tr-grabber'), '<strong>', '</strong>', '<a href="admin.php?page=tr-grabber">', '</a>', $width_backdrop, $height_backdrop).'</p></div>';
        }
    
    }
    
    if( defined('TR_EPISODE_WIDTH') and defined('TR_EPISODE_HEIGHT') ) {
    
        $width_episode = TR_EPISODE_WIDTH;
        $height_episode = TR_EPISODE_HEIGHT;

        if ( TR_GRABBER_EPISODE_WIDTH!=$width_episode or TR_GRABBER_EPISODE_HEIGHT!=$height_episode ) {
            echo '<div class="error tr_error_thumb"><p>'.sprintf( __('Please, %sbefore proceeding%s, set the image episode size correctly, %sclick here%s. (%sx%s)', 'tr-grabber'), '<strong>', '</strong>', '<a href="admin.php?page=tr-grabber">', '</a>', $width_episode, $height_episode).'</p></div>';
        }
    
    }
    
    if( defined('TR_SEASON_WIDTH') and defined('TR_SEASON_HEIGHT') ) {
    
        $width_season = TR_SEASON_WIDTH;
        $height_season = TR_SEASON_HEIGHT;

        if ( TR_GRABBER_SEASON_WIDTH!=$width_season or TR_GRABBER_SEASON_HEIGHT!=$height_season ) {
            echo '<div class="error tr_error_thumb"><p>'.sprintf( __('Please, %sbefore proceeding%s, set the image season size correctly, %sclick here%s. (%sx%s)', 'tr-grabber'), '<strong>', '</strong>', '<a href="admin.php?page=tr-grabber">', '</a>', $width_season, $height_season).'</p></div>';
        }
    
    }
    
}