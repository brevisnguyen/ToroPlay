<?php

/*
* @wordpress-plugin
* Plugin Name: OPhim Crawler
* Plugin URI: https://ophim.tv/
* Description: Thu thập phim từ OPhim - Tương thích theme ToroPlay
* Version: 2.0.1
* Requires PHP: 7.0^
* Author: Brevis Nguyen
* Author URI: https://github.com/brevis-ng
*/

// Protect plugins from direct access. If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die('Hành động chưa được xác thực!');
}

/**
 * Currently plugin version.
 * Start at version 2.0.1
 */
define( 'OPHIM_PLUGIN_VERSION', '2.0.1' );

/**
 * The unique identifier of this plugin.
 */
set_time_limit(0);
if ( defined( 'OPHIM_PLUGIN_VERSION' ) ) {
    $version = OPHIM_PLUGIN_VERSION;
} else {
    $version = '2.0.1';
}
define('OPHIM_NAME', 'ophim-crawler');
define('OPHIM_VERSION', $version);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_ophim_crawl() {
    // Code
    register_post_meta('movies', 'subtitles_url', [
        'type' => 'string',
        'description' => 'Subfile url',
        'single' => true
    ]);
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_ophim_crawl() {
    // Code
}

register_activation_hook( __FILE__, 'activate_ophim_crawl' );
register_deactivation_hook( __FILE__, 'deactivate_ophim_crawl' );

/**
 * Provide a public-facing view for the plugin
 */
function ophim_crawler_add_menu() {
    add_menu_page(
        __('OPhim Crawler Tools', 'textdomain'),
        'OPhim Crawler',
        'manage_options',
        'movies-crawler-tools',
        'ophim_crawler_page_menu',
        'dashicons-buddicons-replies',
        2
    );
}

/**
 * Include the following files that make up the plugin
 */
function ophim_crawler_page_menu() {
    require_once plugin_dir_path(__FILE__) . 'public/partials/ophim_crawler_view.php';
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 * 
 */
require_once plugin_dir_path( __FILE__ ) . 'public/ophim_public-crawler.php';
function run_ophim() {
    add_action('admin_menu', 'ophim_crawler_add_menu');

    $plugin_admin = new OPhim_Movies_Crawler( OPHIM_NAME, OPHIM_VERSION );
    add_action('in_admin_header', array($plugin_admin, 'enqueue_ophim_scripts'));
    add_action('in_admin_header', array($plugin_admin, 'enqueue_ophim_styles'));

    add_action('wp_ajax_crawl_ophim_page', array($plugin_admin, 'crawl_ophim_page'));
    add_action('wp_ajax_crawl_ophim_movies', array($plugin_admin, 'crawl_ophim_movies'));
}
run_ophim();