<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $config_grabber;

// dynamic

$config_grabber['texthome'] = isset( $config_grabber['texthome'] ) ? $config_grabber['texthome'] : '';
$config_grabber['api_key'] = isset( $config_grabber['api_key'] ) ? $config_grabber['api_key'] : '';
$config_grabber['upload_images'] = isset( $config_grabber['upload_images'] ) ? $config_grabber['upload_images'] : 0;
$config_grabber['lang_api'] = isset( $config_grabber['lang_api'] ) ? $config_grabber['lang_api'] : 'en-EN';
$config_grabber['special_season'] = isset( $config_grabber['special_season'] ) ? $config_grabber['special_season'] : 0;
$config_grabber['time_limit'] = isset( $config_grabber['time_limit'] ) ? $config_grabber['time_limit'] : '';
$config_grabber['memory_limit'] = isset( $config_grabber['memory_limit'] ) ? $config_grabber['memory_limit'] : '';
$config_grabber['msj_update'] = isset( $config_grabber['msj_update'] ) ? $config_grabber['msj_update'] : 0;
$config_grabber['msj_update31'] = isset( $config_grabber['msj_update31'] ) ? $config_grabber['msj_update31'] : 0;
$config_grabber['prefix_posts'] = isset( $config_grabber['prefix_posts'] ) ? $config_grabber['prefix_posts'] : 0;
$config_grabber['slug_movies'] = isset( $config_grabber['slug_movies'] ) ? $config_grabber['slug_movies'] : __('movie', 'tr-grabber');
$config_grabber['slug_series'] = isset( $config_grabber['slug_series'] ) ? $config_grabber['slug_series'] : __('serie', 'tr-grabber');
$config_grabber['slug_season'] = isset( $config_grabber['slug_season'] ) ? $config_grabber['slug_season'] : '{name}-{season}';
$config_grabber['slug_episode'] = isset( $config_grabber['slug_episode'] ) ? $config_grabber['slug_episode'] : '{name}-{season}x{episode}';
$config_grabber['slug_letters'] = isset( $config_grabber['slug_letters'] ) ? $config_grabber['slug_letters'] : __('letter', 'tr-grabber');
$config_grabber['title_seasons'] = isset( $config_grabber['title_seasons'] ) ? $config_grabber['title_seasons'] : __('{name} - Season {season}', 'tr-grabber');
$config_grabber['title_episodes'] = isset( $config_grabber['title_episodes'] ) ? $config_grabber['title_episodes'] : '{name} {season}x{episode}';
$config_grabber['subtitle_seasons'] = isset( $config_grabber['subtitle_seasons'] ) ? $config_grabber['subtitle_seasons'] : __('Season {season}', 'tr-grabber');
$config_grabber['subtitle_episodes'] = isset( $config_grabber['subtitle_episodes'] ) ? $config_grabber['subtitle_episodes'] : '{name}';
$config_grabber['prefix_season'] = isset( $config_grabber['prefix_season'] ) ? $config_grabber['prefix_season'] : __('season', 'tr-grabber');
$config_grabber['prefix_episode'] = isset( $config_grabber['prefix_episode'] ) ? $config_grabber['prefix_episode'] : __('episode', 'tr-grabber');
$config_grabber['prefix_cast'] = isset( $config_grabber['prefix_cast'] ) ? $config_grabber['prefix_cast'] : __('cast', 'tr-grabber');
$config_grabber['prefix_casttv'] = isset( $config_grabber['prefix_casttv'] ) ? $config_grabber['prefix_casttv'] : __('cast_tv', 'tr-grabber');
$config_grabber['prefix_director'] = isset( $config_grabber['prefix_director'] ) ? $config_grabber['prefix_director'] : __('director', 'tr-grabber');
$config_grabber['prefix_directortv'] = isset( $config_grabber['prefix_directortv'] ) ? $config_grabber['prefix_directortv'] : __('director_tv', 'tr-grabber');
$config_grabber['post_status'] = isset( $config_grabber['post_status'] ) ? $config_grabber['post_status'] : 'publish';
$config_grabber['hideframes'] = isset( $config_grabber['hideframes'] ) ? $config_grabber['hideframes'] : 0;
$config_grabber['hidetitle'] = isset( $config_grabber['hidetitle'] ) ? $config_grabber['hidetitle'] : __('TOROTHEMES PLAYER', 'tr-grabber');
$config_grabber['hidemsg'] = isset( $config_grabber['hidemsg'] ) ? $config_grabber['hidemsg'] : __('Checking that you are not a bot', 'tr-grabber');
$config_grabber['hideimg'] = isset( $config_grabber['hideimg'] ) ? $config_grabber['hideimg'] : '';
$config_grabber['hideopenload'] = isset( $config_grabber['hideopenload'] ) ? $config_grabber['hideopenload'] : 0;
$config_grabber['hidestreamango'] = isset( $config_grabber['hidestreamango'] ) ? $config_grabber['hidestreamango'] : 0;
$config_grabber['hidevidoza'] = isset( $config_grabber['hidevidoza'] ) ? $config_grabber['hidevidoza'] : 0;
$config_grabber['hidestreamplay'] = isset( $config_grabber['hidestreamplay'] ) ? $config_grabber['hidestreamplay'] : 0;
$config_grabber['hideflashx'] = isset( $config_grabber['hideflashx'] ) ? $config_grabber['hideflashx'] : 0;
$config_grabber['hidestreamcherry'] = isset( $config_grabber['hidestreamcherry'] ) ? $config_grabber['hidestreamcherry'] : 0;
$config_grabber['hidethevideo'] = isset( $config_grabber['hidethevideo'] ) ? $config_grabber['hidethevideo'] : 0;
$config_grabber['hidecolor'] = isset( $config_grabber['hidecolor'] ) ? $config_grabber['hidecolor'] : '#9c27b0';
$config_grabber['abc'] = isset( $config_grabber['abc'] ) ? $config_grabber['abc'] : 1;

if( is_admin() ){ $mytheme = wp_get_theme(); }

if( is_admin() and strtolower($mytheme->get('Name')) == 'toroflix' ) {

    $tr_sizes = array(

        'backdrop_width' => '780',
        'backdrop_height' => '440',
        'season_width' => '185',
        'season_height' => '278',
        'episode_width' => '185',
        'episode_height' => '104',

    );

}else{
    
    $tr_sizes = array(

        'backdrop_width' => '780',
        'backdrop_height' => '440',
        'season_width' => '185',
        'season_height' => '278',
        'episode_width' => '185',
        'episode_height' => '104',

    );
    
}

define( 'TR_GRABBER_VERSION', '1.1' );
define( 'TR_GRABBER_LANG', $config_grabber['lang_api'] );
define( 'TR_GRABBER_API_KEY', $config_grabber['api_key'] );
define( 'TR_GRABBER_POST_STATUS', $config_grabber['post_status'] );
define( 'TR_GRABBER_UPLOAD_IMAGES', $config_grabber['upload_images'] );
define( 'TR_GRABBER_BACKDROP_WIDTH', $tr_sizes['backdrop_width'] );
define( 'TR_GRABBER_BACKDROP_HEIGHT', $tr_sizes['backdrop_height'] );
define( 'TR_GRABBER_SEASON_WIDTH', $tr_sizes['season_width'] );
define( 'TR_GRABBER_SEASON_HEIGHT', $tr_sizes['season_height'] );
define( 'TR_GRABBER_EPISODE_WIDTH', $tr_sizes['episode_width'] );
define( 'TR_GRABBER_EPISODE_HEIGHT', $tr_sizes['episode_height'] );
define( 'TR_GRABBER_TIMELIMIT', $config_grabber['time_limit'] );
define( 'TR_GRABBER_MEMOYLIMIT', $config_grabber['memory_limit'] );
define( 'TR_GRABBER_PREFIX_POSTS', $config_grabber['prefix_posts'] );
define( 'TR_GRABBER_SLUG_MOVIES', $config_grabber['slug_movies'] );
define( 'TR_GRABBER_SLUG_SERIES', $config_grabber['slug_series'] );
define( 'TR_GRABBER_FIELD_LETTERS', $config_grabber['slug_letters'] );
define( 'TR_GRABBER_SLUG_SEASONS', $config_grabber['slug_season'] );
define( 'TR_GRABBER_SLUG_EPISODES', $config_grabber['slug_episode'] );
define( 'TR_GRABBER_TITLE_SEASONS', $config_grabber['title_seasons'] );
define( 'TR_GRABBER_TITLE_EPISODES', $config_grabber['title_episodes'] );
define( 'TR_GRABBER_SUBTITLE_SEASONS', $config_grabber['subtitle_seasons'] );
define( 'TR_GRABBER_SUBTITLE_EPISODES', $config_grabber['subtitle_episodes'] );
define( 'TR_GRABBER_PREFIX_SEASON', $config_grabber['prefix_season'] );
define( 'TR_GRABBER_PREFIX_EPISODE', $config_grabber['prefix_episode'] );
define( 'TR_GRABBER_PREFIX_CAST', $config_grabber['prefix_cast'] );
define( 'TR_GRABBER_PREFIX_CASTTV', $config_grabber['prefix_casttv'] );
define( 'TR_GRABBER_PREFIX_DIRECTOR', $config_grabber['prefix_director'] );
define( 'TR_GRABBER_PREFIX_DIRECTORTV', $config_grabber['prefix_directortv'] );
define( 'TR_GRABBER_SPECIAL_SEASON', $config_grabber['special_season'] );
define( 'TR_GRABBER_MSJ_UPDATE', $config_grabber['msj_update'] );
define( 'TR_GRABBER_MSJ_UPDATE31', $config_grabber['msj_update31'] );

// static

define( 'TR_GRABBER_ORIGINAL_TITLE', 'field_title' );
define( 'TR_GRABBER_FIELD_TRAILER', 'field_trailer' );
define( 'TR_GRABBER_FIELD_ID', 'field_id' );
define( 'TR_GRABBER_FIELD_IMDBID', 'field_imdbid' );
define( 'TR_GRABBER_FIELD_DATE', 'field_date' );
define( 'TR_GRABBER_FIELD_YEAR', 'field_release_year' );
define( 'TR_GRABBER_FIELD_RUNTIME', 'field_runtime' );
define( 'TR_GRABBER_FIELD_BACKDROP', 'field_backdrop' );
define( 'TR_GRABBER_FIELD_BACKDROP_HOTLINK', 'backdrop_hotlink' );
define( 'TR_GRABBER_POSTER_HOTLINK', 'poster_hotlink' );
define( 'TR_GRABBER_POSTER', 'poster' );
define( 'TR_GRABBER_FIELD_INPRODUCTION', 'field_inproduction' );
define( 'TR_GRABBER_FIELD_STATUS', 'status' );
define( 'TR_GRABBER_FIELD_NEPISODES', 'number_of_episodes' );
define( 'TR_GRABBER_FIELD_NSEASONS', 'number_of_seasons' );
define( 'TR_GRABBER_FIELD_DATE_LAST', 'field_date_last' );

?>