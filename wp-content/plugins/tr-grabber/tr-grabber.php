<?php
/*
    Plugin Name: Tr Grabber
    Plugin URI: https://torothemes.com
    Description: Turn your WordPress into a CMS for movies and series, TMDb API included.
    Author: ToroThemes
    Version: 1.2
    Author URI: https://torothemes.com/
    License: Private
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'init', 'trgrabber_load_textdomain' );

function trgrabber_load_textdomain() {
    load_plugin_textdomain( 'tr-grabber', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' ); 
}

function tr_grabber_install() {
    
    $lang_availables = array("ar-AR","bs-BS","bg-BG","hr-HR","cs-CZ","da-DK","nl-NL","en-EN","en-US","fi-FI","fr-FR","de-DE","el-GR","he-IL","hu-HU","is-IS","id-ID","it-IT","ko-KR","lb-LB","lt-LT","zh-CN","fa-IR","pl-PL","pt-PT","pt-BR","ro-RO","ru-RU","sk-SK","es-ES","es-MX","sv-SE","th-TH","tr-TR","tw-TW","uk-UA","vi-VN");

    $lang_api = in_array(get_bloginfo("language"), $lang_availables) ? get_bloginfo("language") : 'en-EN';
    
    $tr_movies_options = get_option( 'tr_movies_options' );
    
    if( $tr_movies_options == FALSE ) {
    
        $options_array=array(
            'serial' => '',
            'api_key' => '',
            'upload_images' => 0,
            'lang_api' => $lang_api,
            'special_season' => 0,
            'time_limit' => '',
            'memory_limit' => '',
            'msj_update' => 0,
            'msj_update31' => 0,
            'prefix_posts' => 0,
            'slug_movies' => __('movie', 'tr-grabber'),
            'slug_series' => __('serie', 'tr-grabber'),
            'slug_season' => '{name}-{season}',
            'slug_episode' => '{name}-{season}x{episode}',
            'slug_letters' => __('letter', 'tr-grabber'),
            'title_seasons' => __('{name} - Season {season}', 'tr-grabber'),
            'title_episodes' => '{name} {season}x{episode}',
            'subtitle_seasons' => __('Season {season}', 'tr-grabber'),
            'subtitle_episodes' => '{name}',
            'prefix_episode' => __('episode', 'tr-grabber'),
            'prefix_season' => __('season', 'tr-grabber'),
            'prefix_cast' => __('cast', 'tr-grabber'),
            'prefix_casttv' => __('cast_tv', 'tr-grabber'),
            'prefix_director' => __('director', 'tr-grabber'),
            'prefix_directortv' => __('director_tv', 'tr-grabber'),
            'hideframes' => 0,
            'hidetitle' => __('TOROTHEMES PLAYER', 'tr-grabber'),
            'hidemsg' => __('Checking that you are not a bot', 'tr-grabber'),
            'hideimg' => 'https://image.tmdb.org/t/p/w780/mhdeE1yShHTaDbJVdWyTlzFvNkr.jpg',
            'hideopenload' => 1,
            'hidestreamango' => 1,
            'hidevidoza' => 1,
            'hidestreamplay' => 1,
            'hideflashx' => 1,
            'hidestreamcherry' => 1,
            'hidethevideo' => 1,
            'hidecolor' => '#9c27b0',
            'abc' => 1,
        );
        
    }else{
        
        $options_array=array(
            'serial' => get_option('tplicense'),
            'api_key' => $tr_movies_options['api'],
            'upload_images' => $tr_movies_options['upload_images'],
            'lang_api' => get_bloginfo("language"),
            'special_season' => 0,
            'time_limit' => '',
            'memory_limit' => '',
            'msj_update' => 1,
            'msj_update31' => 1,
            'prefix_posts' => $tr_movies_options['prefix_posts'],
            'slug_movies' => $tr_movies_options['prefix_movies_permalink'],
            'slug_series' => $tr_movies_options['prefix_series_permalink'],
            'slug_season' => '{name}-{season}',
            'slug_episode' => '{name}-{season}x{episode}',
            'slug_letters' => $tr_movies_options['field_slug_letters'],
            'title_seasons' => __('{name} - Season {season}', 'tr-grabber'),
            'title_episodes' => '{name} {season}x{episode}',
            'subtitle_seasons' => __('Season {season}', 'tr-grabber'),
            'subtitle_episodes' => '{name}',
            'prefix_episode' => $tr_movies_options['field_slug_episode'],
            'prefix_season' => $tr_movies_options['field_slug_season'],
            'prefix_cast' => $tr_movies_options['slug_cast'],
            'prefix_casttv' => $tr_movies_options['slug_cast_tv'],
            'prefix_director' => $tr_movies_options['slug_directors'],
            'prefix_directortv' => $tr_movies_options['slug_directors_tv'],
            'hideframes' => 0,
            'hidetitle' => __('TOROTHEMES PLAYER', 'tr-grabber'),
            'hidemsg' => __('Checking that you are not a bot', 'tr-grabber'),
            'hideimg' => 'https://image.tmdb.org/t/p/w780/mhdeE1yShHTaDbJVdWyTlzFvNkr.jpg',
            'hideopenload' => 1,
            'hidestreamango' => 1,
            'hidevidoza' => 1,
            'hidestreamplay' => 1,
            'hideflashx' => 1,
            'hidestreamcherry' => 1,
            'hidethevideo' => 1,
            'hidecolor' => '#9c27b0',
            'abc' => 2,
        );
        
    }

    if( get_option( 'tr_grabber' ) == FALSE ){ update_option( "tr_grabber", serialize($options_array) ); }
    
}

register_activation_hook(__FILE__, 'tr_grabber_install');

if ( get_option('tr_grabber') ) {
    $config = unserialize ( get_option('tr_grabber') );
    $homeconfig = $config['homecontrol'];

    if ( !in_array('Animes|index/animes|1', $homeconfig) || !in_array('TV Shows|index/tvshows|1', $homeconfig) ) {
        $array[] = 'Slider|slider/moved|1';
        $array[] = 'Movies|index/movies|1';
        $array[] = 'Series|index/series|1';
        $array[] = 'Seasons|index/seasons|1';
        $array[] = 'Episodes|index/episodes|1';
        $array[] = 'Text|index/text|2';
        $array[] = 'Animes|index/animes|1';
        $array[] = 'TV Shows|index/tvshows|1';
        $config['homecontrol'] = $array;
    }

    update_option( 'tr_grabber', serialize( $config ) );
}

$config_grabber = get_option('tr_grabber') == '' ? '' : unserialize ( get_option('tr_grabber') );

define( 'TR_GRABBER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'TR_GRABBER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

if( isset($config_grabber['serial']) and !empty($config_grabber['serial']) ) { // update plugin
    require_once(TR_GRABBER_PLUGIN_DIR.'update.php');
    $trgrabber_update = PucFactory::buildUpdateChecker(
        'https://toroplay.com/api/?trupdate=1&trname=2&trserial='.$config_grabber['serial'],
        __FILE__
    );
}

require_once(TR_GRABBER_PLUGIN_DIR.'inc/constants.php'); // constants
require_once(TR_GRABBER_PLUGIN_DIR.'inc/post-type.php'); // post type
require_once(TR_GRABBER_PLUGIN_DIR.'inc/scripts.php'); // styles and scripts
require_once(TR_GRABBER_PLUGIN_DIR.'inc/menu.php'); // menus
require_once(TR_GRABBER_PLUGIN_DIR.'inc/functions.php'); // functions
require_once(TR_GRABBER_PLUGIN_DIR.'inc/permalinks.php'); // permalinks
require_once(TR_GRABBER_PLUGIN_DIR.'inc/notices.php'); // notices
require_once(TR_GRABBER_PLUGIN_DIR.'inc/save-post-movies.php'); // save post filter movies
require_once(TR_GRABBER_PLUGIN_DIR.'inc/save-post-series.php'); // save post filter movies
require_once(TR_GRABBER_PLUGIN_DIR.'inc/filters.php'); // filters
require_once(TR_GRABBER_PLUGIN_DIR.'inc/taxonomies.php'); // taxonomies
require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/init.php'); // panel
require_once(TR_GRABBER_PLUGIN_DIR.'inc/update-db.php'); // update db links
require_once(TR_GRABBER_PLUGIN_DIR.'inc/tinymce-category.php'); // add Editor Visual Categories
require_once(TR_GRABBER_PLUGIN_DIR.'inc/ajax.php'); // ajax