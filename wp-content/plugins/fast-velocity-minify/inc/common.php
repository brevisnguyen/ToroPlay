<?php

# Exit if accessed directly				
if (!defined('ABSPATH')){ exit(); }	

# functions needed for both frontend or backend

# top admin toolbar for cache purging
function fvm_admintoolbar() {
	if(current_user_can('manage_options')) {
		global $wp_admin_bar;

		# Add top menu to admin bar
		$wp_admin_bar->add_node(array(
			'id'    => 'fvm_menu',
			'title' => __("FVM", 'fvm') . '</span>',
			'href'  => wp_nonce_url(add_query_arg('fvm_do', 'clear_all'), 'fvm_clear', '_wpnonce')
		));
		
		# Add submenu
		$wp_admin_bar->add_node(array(
			'id'    => 'fvm_submenu_purge_all',
			'parent'    => 'fvm_menu', 
			'title' => __("Clear Everything", 'fvm'),
			'href'  => wp_nonce_url(add_query_arg('fvm_do', 'clear_all'), 'fvm_clear', '_wpnonce')			
		));
		
		# Add submenu
		$wp_admin_bar->add_node(array(
			'id'    => 'fvm_submenu_settings',
			'parent'    => 'fvm_menu', 
			'title' => __("FVM Settings", 'fvm'),
			'href'  => admin_url('admin.php?page=fvm')
		));
		
		/*
		# Add submenu
		$wp_admin_bar->add_node(array(
			'id'    => 'fvm_submenu_upgrade',
			'parent'    => 'fvm_menu', 
			'title' => __("Upgrade", 'fvm'),
			'href'  => admin_url('admin.php?page=fvm&tab=upgrade')
		));
		*/
		
		# Add submenu
		$wp_admin_bar->add_node(array(
			'id'    => 'fvm_submenu_help',
			'parent'    => 'fvm_menu', 
			'title' => __("Help", 'fvm'),
			'href'  => admin_url('admin.php?page=fvm&tab=help')
		));

	}
}


# get cache directory
function fvm_get_cache_location() {
	
	# custom path
	if (defined('FVM_DIR') && defined('FVM_URL')){
		
		# define paths and url
		$sep = DIRECTORY_SEPARATOR;
		$dir = trim(rtrim(FVM_DIR, '/\\')). $sep . 'cache' . $sep . 'fvm'. $sep . 'min';
		$durl = trim(rtrim(FVM_URL, '/')). '/cache/fvm/min';
		
		# create and return
		if(!is_dir($dir) && function_exists('wp_mkdir_p')) { wp_mkdir_p($dir); }
		return array('ch_dir'=>$dir,'ch_url'=>$durl);
		
	}
	
	
	# /wp-content/cache
	if (defined('WP_CONTENT_DIR') && defined('WP_CONTENT_URL')){
		
		# define paths and url
		$sep = DIRECTORY_SEPARATOR;
		$dir = trim(rtrim(WP_CONTENT_DIR, '/\\')). $sep . 'cache' . $sep . 'fvm'. $sep . 'min';
		$durl = trim(rtrim(WP_CONTENT_URL, '/')). '/cache/fvm/min';
		
		# create and return
		if(!is_dir($dir) && function_exists('wp_mkdir_p')) { wp_mkdir_p($dir); }
		return array('ch_dir'=>$dir,'ch_url'=>$durl);
		
	}	
	
	# uploads directory
	$ch_info = wp_upload_dir();
	if(isset($ch_info['basedir']) && isset($ch_info['baseurl']) && !empty($ch_info['basedir'])) {
	
		# define and create directory
		$sep = DIRECTORY_SEPARATOR;
		$dir = $ch_info['basedir'] . $sep . 'cache' . $sep . 'fvm'. $sep . 'min';
		$durl = $ch_info['baseurl'] . '/cache/fvm/min';
		
		# create and return
		if(!is_dir($dir) && function_exists('wp_mkdir_p')) { wp_mkdir_p($dir); }
		return array('ch_dir'=>$dir,'ch_url'=>$durl);
			
	}
	
	# error
	return false;

}



# purge all caches when clicking the button on the admin bar
function fvm_process_cache_purge_request(){
	
	if(isset($_GET['fvm_do']) && isset($_GET['_wpnonce'])) {
		
		# must be able to cleanup cache
		if (!current_user_can('manage_options')) { 
			wp_die( __('You do not have sufficient permissions to access this page.', 'fast-velocity-minify'), __('Error:', 'fast-velocity-minify'), array('response'=>200)); 
		}
		
		# validate nonce
		if(!wp_verify_nonce($_GET['_wpnonce'], 'fvm_clear')) {
			wp_die( __('Invalid or expired request... please go back and refresh before trying again!', 'fast-velocity-minify'), __('Error:', 'fast-velocity-minify'), array('response'=>200)); 
		}
		
		# Purge All
		if($_GET['fvm_do'] == 'clear_all') {
			
			# purge everything
			$cache = fvm_purge_static_files();
			$others = fvm_purge_others();
			
			if(is_admin()) {
				
				# merge notices
				$notices = array();
				if(is_string($cache)) { $notices[] = $cache; }
				if(is_string($others)) { $notices[] = $others; }
				
				# save transient for after the redirect
				if(count($notices) == 0) { $notices[] = __( 'All supported caches have been purged ', 'fast-velocity-minify' ) . ' ('.date("D, d M Y @ H:i:s e").')'; }
				set_transient( 'fvm_admin_notice', json_encode($notices), 10);
				
			}

		}
						
		# https://developer.wordpress.org/reference/functions/wp_safe_redirect/
		nocache_headers();
		wp_safe_redirect(remove_query_arg('_wpnonce', remove_query_arg('_fvm', wp_get_referer())));
		exit();
	}
}


# Purge everything
function fvm_purge_all() {
	fvm_purge_static_files();
	fvm_purge_others();	
	return true;	
}


# purge supported hosting and plugins
function fvm_purge_others(){

	# third party plugins
		
	# Purge all W3 Total Cache
	if (function_exists('w3tc_pgcache_flush')) {
		w3tc_pgcache_flush();
		return __( 'All caches on <strong>W3 Total Cache</strong> have been purged.', 'fast-velocity-minify' );
	}

	# Purge WP Super Cache
	if (function_exists('wp_cache_clear_cache')) {
		wp_cache_clear_cache();
		return __( 'All caches on <strong>WP Super Cache</strong> have been purged.', 'fast-velocity-minify' );
	}

	# Purge WP Rocket
	if (function_exists('rocket_clean_domain')) {
		rocket_clean_domain();
		return __( 'All caches on <strong>WP Rocket</strong> have been purged.', 'fast-velocity-minify' );
	}

	# Purge Cachify
	if (function_exists('cachify_flush_cache')) {
		cachify_flush_cache();
		return __( 'All caches on <strong>Cachify</strong> have been purged.', 'fast-velocity-minify' );
	}

	# Purge Comet Cache
	if ( class_exists("comet_cache") ) {
		comet_cache::clear();
		return __( 'All caches on <strong>Comet Cache</strong> have been purged.', 'fast-velocity-minify' );
	}

	# Purge Zen Cache
	if ( class_exists("zencache") ) {
		zencache::clear();
		return __( 'All caches on <strong>Comet Cache</strong> have been purged.', 'fast-velocity-minify' );
	}

	# Purge LiteSpeed Cache
	if ( has_action('litespeed_purge_all') ) {
		do_action('litespeed_purge_all');
		return __( 'All caches on <strong>LiteSpeed Cache</strong> have been purged.', 'fast-velocity-minify' );
	}
	
	# Purge WP Cloudflare Super Page Cache
	if( class_exists('SW_CLOUDFLARE_PAGECACHE') ) {
		do_action("swcfpc_purge_everything");
		return __( 'All caches on <strong>WP Cloudflare Super Page Cache</strong> have been purged.', 'fast-velocity-minify' );
	}
	
	# Purge Hyper Cache
	if (class_exists( 'HyperCache' )) {
		do_action( 'autoptimize_action_cachepurged' );
		return __( 'All caches on <strong>HyperCache</strong> have been purged.', 'fast-velocity-minify' );
	}

	# purge cache enabler
	if ( has_action('ce_clear_cache') ) {
		do_action('ce_clear_cache');
		return __( 'All caches on <strong>Cache Enabler</strong> have been purged.', 'fast-velocity-minify' );
	}

	# purge wpfc
	if (function_exists('wpfc_clear_all_cache')) {
		wpfc_clear_all_cache(true);
	}

	# add breeze cache purge support
	if (class_exists("Breeze_PurgeCache")) {
		Breeze_PurgeCache::breeze_cache_flush();
		return __( 'All caches on <strong>Breeze</strong> have been purged.', 'fast-velocity-minify' );
	}

	# swift
	if (class_exists("Swift_Performance_Cache")) {
		Swift_Performance_Cache::clear_all_cache();
		return __( 'All caches on <strong>Swift Performance</strong> have been purged.', 'fast-velocity-minify' );
	}
	
	# Hummingbird
	if(has_action('wphb_clear_page_cache')) {
		do_action('wphb_clear_page_cache');
		return __( 'All caches on <strong>Hummingbird</strong> have been purged.', 'fast-velocity-minify' );
	}
	
	# WP-Optimize
	if(has_action('wpo_cache_flush')) {
		do_action('wpo_cache_flush');
		return __( 'All caches on <strong>WP-Optimize</strong> have been purged.', 'fast-velocity-minify' );
	}
	
	# nginx helper
	if(has_action('rt_nginx_helper_purge_all')) {
		do_action('rt_nginx_helper_purge_all');
		$ret[] = __( 'Nginx Helper' );
	}
	
	# Cache-Master
    if ( function_exists( 'scm_clear_all_cache' ) ) {
        scm_clear_all_cache();
        return __( 'All caches on <strong>Cache-Master</strong> have been purged.', 'fast-velocity-minify' );
    }
	
	
	# Object Cache
	
	# WordPress OPCache
	if (function_exists('wp_cache_flush')) {
		if(wp_cache_flush()) {
			return 'OPCache';
		}
	}
	
	# Purge Redis Object Cache plugin
	if(class_exists('Redis') && defined('WP_REDIS_PATH')) {
		$r = new Redis();
		if ($r->connect( WP_REDIS_PATH, 0 )) {
			if( false !== $r->flushdb() ) {
				$ret[] = __('Redis Object Cache');
			}
		}
	}

	# hosting companies

	# Purge SG Optimizer (Siteground)
	if (function_exists('sg_cachepress_purge_everything')) {
		sg_cachepress_purge_everything();
		return __( 'All caches on <strong>SG Optimizer</strong> have been purged.', 'fast-velocity-minify' );
	}

	# Purge Godaddy Managed WordPress Hosting (Varnish + APC)
	if (class_exists('WPaaS\Plugin') && method_exists( 'WPass\Plugin', 'vip' )) {
		fvm_godaddy_request('BAN');
		return __( 'A cache purge request has been sent to <strong>Go Daddy Varnish</strong>', 'fast-velocity-minify' );
	}


	# Purge WP Engine
	if (class_exists("WpeCommon")) {
		if (method_exists('WpeCommon', 'purge_memcached')) { WpeCommon::purge_memcached(); }
		if (method_exists('WpeCommon', 'purge_varnish_cache')) { WpeCommon::purge_varnish_cache(); }
		if (method_exists('WpeCommon', 'purge_memcached') || method_exists('WpeCommon', 'purge_varnish_cache')) {
			return __( 'A cache purge request has been sent to <strong>WP Engine</strong>', 'fast-velocity-minify' );
		}
	}

	# Purge Kinsta
	global $kinsta_cache;
	if ( isset($kinsta_cache) && class_exists('\\Kinsta\\CDN_Enabler')) {
		if (!empty( $kinsta_cache->kinsta_cache_purge)){
			$kinsta_cache->kinsta_cache_purge->purge_complete_caches();
			return __( 'A cache purge request has been sent to <strong>Kinsta</strong>', 'fast-velocity-minify' );
		}
	}

	# Purge Pagely
	if ( class_exists( 'PagelyCachePurge' ) ) {
		$purge_pagely = new PagelyCachePurge();
		$purge_pagely->purgeAll();
		return __( 'A cache purge request has been sent to <strong>Pagely</strong>', 'fast-velocity-minify' );
	}

	# Purge Pressidum
	if (defined('WP_NINUKIS_WP_NAME') && class_exists('Ninukis_Plugin')){
		$purge_pressidum = Ninukis_Plugin::get_instance();
		$purge_pressidum->purgeAllCaches();
		return __( 'A cache purge request has been sent to <strong>Pressidium</strong>', 'fast-velocity-minify' );
	}

	# Purge Savvii
	if (defined( '\Savvii\CacheFlusherPlugin::NAME_DOMAINFLUSH_NOW')) {
		$purge_savvii = new \Savvii\CacheFlusherPlugin();
		if ( method_exists( $plugin, 'domainflush' ) ) {
			$purge_savvii->domainflush();
			return __( 'A cache purge request has been sent to <strong>Savvii</strong>', 'fast-velocity-minify' );
		}
	}

	# Purge Pantheon Advanced Page Cache plugin
	if(function_exists('pantheon_wp_clear_edge_all')) {
		pantheon_wp_clear_edge_all();
	}
	
	# cloudways varnish
	if(fvm_purge_varnish_cloudways()) {
		$ret[] = __('Cloudways (Varnish)');
	}

	# bigscoots.com
	if(has_action('bs_cache_purge_cache')) {
		do_action('bs_cache_purge_cache');
		$ret[] = __( 'BigScoots' );
	}
	
	# godaddy.com managed WordPress
	if (class_exists('WPass') && method_exists('WPass\Cache', 'do_ban')){
		WPaaS\Cache::do_ban();
		$ret[] = __( 'GoDaddy' );
	}
	
}


# purge varnish on cloudways
function fvm_purge_varnish_cloudways() {
	
	# cloudways detection
	if (!isset($_SERVER['cw_allowed_ip'])){ return false; }
	
	# must have
	if (!isset($_SERVER['HTTP_X_VARNISH']) || !isset($_SERVER['HTTP_X_APPLICATION'])){ return false; }
	if (is_null($_SERVER['HTTP_X_VARNISH']) || is_null($_SERVER['HTTP_X_APPLICATION'])){ return false; }
	if ('varnishpass' === trim($_SERVER['HTTP_X_APPLICATION'])){ return false; } 
	if ('bypass' === trim($_SERVER['HTTP_X_APPLICATION'])){ return false; } 
	
	# host and uri path
	$host = fvm_get_domain();
		
	# request arguments
	$request_args = array('method' => 'PURGE', 'redirection' => 0, 'timeout' => 10, 'blocking' => false, 'headers' => array('Host' => $host, 'X-Purge-Method' => 'regex') );
	
	# default host and port
	$varnish_ip = '127.0.0.1';
	$varnish_port = '8080';
		
	# overwrite by constant 
	if(defined('FVM_VARNISH_IP') && !empty(FVM_VARNISH_IP)) { $varnish_ip = trim(FVM_VARNISH_IP); }
	if(defined('FVM_VARNISH_PORT') && !empty(FVM_VARNISH_PORT)) { $varnish_port = trim(FVM_VARNISH_PORT); }
	
	# purge async
	$response = wp_remote_request('http://'.$varnish_ip.':'.$varnish_port.'/.*', $request_args);
	return true;
}


# Purge Godaddy Managed WordPress Hosting (Varnish)
function fvm_godaddy_request( $method) {
	$url = home_url();
	$host = fvm_get_domain();
	$url  = set_url_scheme( str_replace( $host, WPaas\Plugin::vip(), $url ), 'http' );
	update_option( 'gd_system_last_cache_flush', time(), 'no'); # purge apc
	wp_remote_request( esc_url_raw( $url ), array('method' => $method, 'blocking' => false, 'headers' => array('Host' => $host)) );
}



# check if we can minify the page
function fvm_can_minify_js() {

	# check if we hit any exclusions from the compatibility page
	if(!fvm_can_process_common()) { return false; }
	if(fvm_is_amp_page() === true) { return false; }
	
	# url exclusions
	if(!fvm_can_process_query_string('js')) { return false; }
	
	# check if user role is allowed
    if(!fvm_user_role_processing_allowed('js')) { return false; } 
	
	# settings
	global $fvm_settings;
	
	# disabled?
	if(!isset($fvm_settings['js']['enable']) || (isset($fvm_settings['js']['enable']) && $fvm_settings['js']['enable'] != true)) {
		return false;
	}
	
	# default
	return true;
	
}

# check if we can minify the page
function fvm_can_process_html() {
	
	# check if we hit any exclusions from the compatibility page
	if(!fvm_can_process_common()) { return false; }
	if(fvm_is_amp_page() === true) { return false; }
	
	# url exclusions
	if(!fvm_can_process_query_string('html')) { return false; }
	
	# settings
	global $fvm_settings;
	
	# disabled?
	if(!isset($fvm_settings['html']['enable']) || (isset($fvm_settings['html']['enable']) && $fvm_settings['html']['enable'] != true)) {
		return false;
	}
	
	# check if user role is allowed
    if(!fvm_user_role_processing_allowed('html')) { return false; } 
			
	# default
	return true;
}

# check if we can minify the page
function fvm_can_process_cdn() {
	
	# check if we hit any exclusions from the compatibility page
	if(!fvm_can_process_common()) { return false; }
	if(fvm_is_amp_page() === true) { return false; }
	
	# url exclusions
	if(!fvm_can_process_query_string('cdn')) { return false; }
	
	# settings
	global $fvm_settings;
	
	# disabled?
	if(!isset($fvm_settings['cdn']['enable']) || (isset($fvm_settings['cdn']['enable']) && $fvm_settings['cdn']['enable'] != true)) {
		return false;
	}
	
	# no domain
	if(!isset($fvm_settings['cdn']['domain']) || (isset($fvm_settings['cdn']['domain']) && empty($fvm_settings['cdn']['domain']))) {
		return false;
	}
	
	# check if user role is allowed
    if(!fvm_user_role_processing_allowed('cdn')) { return false; } 
			
	# default
	return true;
}


# check if we can minify the page
function fvm_can_minify_css() {

	# check if we hit any exclusions from the compatibility page
	if(!fvm_can_process_common()) { return false; }
	if(fvm_is_amp_page() === true) { return false; }
	
	# url exclusions
	if(!fvm_can_process_query_string('css')) { return false; }
	
	# check if user role is allowed
    if(!fvm_user_role_processing_allowed('css')) { return false; } 
	
	# settings
	global $fvm_settings;
	
	# disabled?
	if(!isset($fvm_settings['css']['enable']) || (isset($fvm_settings['css']['enable']) && $fvm_settings['css']['enable'] != true)) { return false; }
	
	# default
	return true;
}


# save minified code, if not yet available
function fvm_generate_min_url($url, $tkey, $type, $code) {
		
	# cache date
	$tvers = get_option('fvm_last_cache_update', '0');
		
	# parse uripath and check if it matches against our rewrite format
	$filename = $tvers.'-'.$tkey .'.'. $type;
	
	# check cache directory
	$ch_info = fvm_get_cache_location();
	if(isset($ch_info['ch_url'])  && !empty($ch_info['ch_url']) && isset($ch_info['ch_dir']) && !empty($ch_info['ch_dir'])) {
		if(is_dir($ch_info['ch_dir']) && is_writable($ch_info['ch_dir'])) {
			
			# filename
			$file = $ch_info['ch_dir'] . DIRECTORY_SEPARATOR . $filename;
			$public = $ch_info['ch_url'] . '/' .$filename;
			
			# enforce https on https requests
			if(parse_url($public, PHP_URL_SCHEME) != fvm_get_scheme()) {
				$public = str_replace('http://', 'https://', $public);
			}
			
			# php
			if(!file_exists($file) || (file_exists($file) && filemtime($file) < $tvers)) { file_put_contents($file, $code); }
			if(file_exists($file)) { return $public; }
			
		}
	}
	
	# default, fail and log
	return false;
}




# check if PHP has some functions disabled
function fvm_function_available($func) {
	if (ini_get('safe_mode')) return false;
	$disabled = ini_get('disable_functions');
	if ($disabled) {
		$disabled = explode(',', $disabled);
		$disabled = array_map('trim', $disabled);
		return !in_array($func, $disabled);
	}
	return true;
}


# open a multiline string, order, filter duplicates and return as array
function fvm_string_toarray($value){
	$arr = explode(PHP_EOL, $value);
	return fvm_array_order($arr);}

# filter duplicates, order and return array
function fvm_array_order($arr){
	if(!is_array($arr)) { return array(); }
	$a = array_map('trim', $arr);
	$b = array_filter($a);
	$c = array_unique($b);
	sort($c);
	return $c;
}


# return size in human format
function fvm_format_filesize($bytes, $decimals = 2) {
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB' );
    for ($i = 0; ($bytes / 1024) > 0.9; $i++, $bytes /= 1024) {}
	if($i == 0) { $i = 1; $bytes = $bytes / 1024; } # KB+ only
    return sprintf( "%1.{$decimals}f %s", round( $bytes, $decimals ), $units[$i] );
}

# purge static cache files directory
function fvm_purge_static_files() {
			
	# globals 
	global $fvm_settings;
	
	# truncate cache table
	global $wpdb;
	if(is_null($wpdb)) { return false; }
	try {
		
		# table names
		$sqla_table_name = $wpdb->prefix . 'fvm_cache';
		$sqlb_table_name = $wpdb->prefix . 'fvm_logs';
		
		# test if at least one table exists and empty them
		if ($wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $sqla_table_name)) === $sqla_table_name) {
			$wpdb->query("TRUNCATE TABLE {$sqla_table_name}");
			$wpdb->query("TRUNCATE TABLE {$sqlb_table_name}");
		}
		
	} catch (Exception $e) {
		error_log('Error: '.$e->getMessage(), 0);
	}
	
	# increment
	$tver = time();
	update_option('fvm_last_cache_update', $tver);
	
	# check cache directory
	$ch_info = fvm_get_cache_location();
	if(isset($ch_info['ch_url'])  && !empty($ch_info['ch_url']) && isset($ch_info['ch_dir']) && !empty($ch_info['ch_dir'])) {
		if(is_dir($ch_info['ch_dir']) && is_writable($ch_info['ch_dir'])) {
			
			
			# instant purge
			if(isset($fvm_settings['cache']['min_instant_purge']) && $fvm_settings['cache']['min_instant_purge'] == true) {
				fvm_rrmdir($ch_info['ch_dir']);	
			} else {
				fvm_rrmdir($ch_info['ch_dir'], $tver);	# 7 days
			}
			
		}		
	}
	
}


# remove all cache files
function fvm_rrmdir($path, $tver=null) {
	clearstatcache();
	if(is_dir($path)) {
		try {
			
			$i = new DirectoryIterator($path);
			foreach($i as $f){
				
				# 7 days older than timestamp
				if(isset($tver) && !is_null($tver)) {
					
					if($f->isFile() && $f->getMTime() <= intval($tver) - 86400 * 7) { @unlink($f->getRealPath()); }
					if($f->isDir() && !$f->isDot()){
						fvm_rrmdir($f->getRealPath(), $tver);
						@rmdir($f->getRealPath());
					}
					
				} else {
					# immediate
					if($f->isFile()){ @unlink($f->getRealPath()); }
					if($f->isDir() && !$f->isDot()){
						fvm_rrmdir($f->getRealPath());
						@rmdir($f->getRealPath());
					}
				}
				
			}
			
		} catch (Exception $e) {
			return get_class($e) . ": " . $e->getMessage();
		}
		
		# self
		if(is_dir($path)) { @rmdir($path); }
	}
}


# Fix the permission bits on generated files
function fvm_fix_permission_bits($file){

	# must be on the allowed path
	if(empty($file) || !defined('WP_CONTENT_DIR') || stripos($file, DIRECTORY_SEPARATOR . 'fvm') === false) {
		return __( 'Requested path is not allowed!', 'fast-velocity-minify' );
	}
	
	if(function_exists('stat') && fvm_function_available('stat')) {
		if ($stat = @stat(dirname($file))) {
			$perms = $stat['mode'] & 0007777;
			@chmod($file, $perms);
			clearstatcache();
			return true;
		}
	}
	
	# get permissions from parent directory
	$perms = 0777; 
	if(function_exists('stat') && fvm_function_available('stat')) {
		if ($stat = @stat(dirname($file))) { $perms = $stat['mode'] & 0007777; }
	}
	
	if (file_exists($file)){
		if ($perms != ($perms & ~umask())){
			$folder_parts = explode( DIRECTORY_SEPARATOR, substr( $file, strlen(dirname($file)) + 1 ) );
				for ( $i = 1, $c = count( $folder_parts ); $i <= $c; $i++ ) {
				@chmod(dirname($file) . DIRECTORY_SEPARATOR . implode( DIRECTORY_SEPARATOR, array_slice( $folder_parts, 0, $i ) ), $perms );
			}
		}
		return true;
	}

	return false;
}


# get options into an array
function fvm_get_settings() {

	$fvm_settings = json_decode(get_option('fvm_settings'), true);

	# mandatory default exclusions
	$fvm_settings_default = fvm_get_default_settings($fvm_settings);
	
	# check if there are any pending field update routines
	$fvm_settings_default = fvm_get_updated_field_routines($fvm_settings_default);
	
	# update database if needed
	if($fvm_settings != $fvm_settings_default) {
		update_option('fvm_settings', json_encode($fvm_settings_default), false);
	}
	
	# return
	return $fvm_settings;	
}

# return value from section and key name
function fvm_get_settings_value($fvm_settings, $section, $key) {
	if($fvm_settings != false && is_array($fvm_settings) && count($fvm_settings) > 1) {
		if(isset($fvm_settings[$section][$key])) {
			return $fvm_settings[$section][$key]; 
		}
	}
	return '';
}


# default exclusions by seting name
function fvm_get_default_settings($fvm_settings) {
	if(!is_array($fvm_settings) || empty($fvm_settings)){
		
		# initialize
		$fvm_settings = array();
		
		# global
		$fvm_settings['global']['preserve_settings'] = 1;		
		
		# html
		$fvm_settings['html']['enable'] = 1;
		$fvm_settings['html']['nocomments'] = 1;
		$fvm_settings['html']['cleanup_header'] = 1;
		$fvm_settings['html']['disable_emojis'] = 1;
		
		# css
		$fvm_settings['css']['enable'] = 1;
		$fvm_settings['css']['noprint'] = 1;

	}
	
	# return	
	return $fvm_settings;
}



# update routines for new fields and replacements
function fvm_get_updated_field_routines($fvm_settings) {
	
	# current version
	global $fvm_var_plugin_version;	
	
	# must have
	if(!is_array($fvm_settings)) { return $fvm_settings; }
	
	# Version 3.0 routines start
	
	# settings migration
	if (get_option("fastvelocity_upgraded") === false) {
		if (get_option("fastvelocity_plugin_version") !== false) {		
		
			# cache path
			if (get_option("fastvelocity_min_change_cache_path") !== false && !isset($fvm_settings['cache']['path'])) { 
				$fvm_settings['cache']['path'] = get_option("fastvelocity_min_change_cache_path");
			}
			
			# cache base_url
			if (get_option("fastvelocity_min_change_cache_base_url") !== false && !isset($fvm_settings['cache']['url'])) { 
				$fvm_settings['cache']['url'] = get_option("fastvelocity_min_change_cache_base_url");
				
			}
			
			# disable html minification
			if (get_option("fastvelocity_min_skip_html_minification") !== false && !isset($fvm_settings['html']['min_disable'])) { 
				$fvm_settings['html']['min_disable'] = 1;
			}
			
			# do not remove html comments
			if (get_option("fastvelocity_min_strip_htmlcomments") !== false && !isset($fvm_settings['html']['nocomments'])) { 
				$fvm_settings['html']['nocomments'] = 1;
			}			
			
			# cdn url
			$oldcdn = get_option("fastvelocity_min_fvm_cdn_url");
			if ($oldcdn !== false && !empty($oldcdn)) {
				if (!isset($fvm_settings['cdn']['domain']) || (isset($fvm_settings['cdn']['domain']) && empty($fvm_settings['cdn']['domain']))) {
					$fvm_settings['cdn']['enable'] = 1;
					$fvm_settings['cdn']['cssok'] = 1;
					$fvm_settings['cdn']['jsok'] = 1;
					$fvm_settings['cdn']['domain'] = $oldcdn;				
				}
			}
			
			# force https
			if (get_option("fastvelocity_min_default_protocol") == 'https' && !isset($fvm_settings['global']['force-ssl'])) { 
				$fvm_settings['global']['force-ssl'] = 1;
			}
			
			# preserve settings on uninstall
			if (get_option("fastvelocity_preserve_settings_on_uninstall") !== false && !isset($fvm_settings['global']['preserve_settings'])) { 
				$fvm_settings['global']['preserve_settings'] = 1;
			}
			
			# inline all css
			if (get_option("fastvelocity_min_force_inline_css") !== false && !isset($fvm_settings['css']['inline-all'])) { 
				$fvm_settings['css']['inline-all'] = 1;
			}
			
			# remove google fonts
			if (get_option("fastvelocity_min_remove_googlefonts") !== false && !isset($fvm_settings['css']['remove'])) { 
				
				# add fonts.gstatic.com
				$arr = array('fonts.gstatic.com');
				$fvm_settings['css']['remove'] = implode(PHP_EOL, fvm_array_order($arr));
				
			}

			# Skip deferring the jQuery library, add them to the header render blocking
			if (get_option("fastvelocity_min_exclude_defer_jquery") !== false && !isset($fvm_settings['js']['merge_header'])) { 

				# add jquery + jquery migrate
				$arr = array('/jquery-migrate-', '/jquery-migrate.js', '/jquery-migrate.min.js', '/jquery.js', '/jquery.min.js');
				$fvm_settings['js']['merge_header'] = implode(PHP_EOL, fvm_array_order($arr));
				
			}
			
			# new users, add recommended default scripts settings
			if ( (!isset($fvm_settings['js']['merge_header']) || isset($fvm_settings['js']['merge_header']) && empty($fvm_settings['js']['merge_header'])) && (!isset($fvm_settings['js']['merge_defer']) || (isset($fvm_settings['js']['merge_defer']) && empty($fvm_settings['js']['merge_defer']))) ) {
				
				# header
				$arr = array('/jquery-migrate-', '/jquery-migrate.js', '/jquery-migrate.min.js', '/jquery.js', '/jquery.min.js');
				$fvm_settings['js']['merge_header'] = implode(PHP_EOL, fvm_array_order($arr));
				
				# defer
				$arr = array('/ajax.aspnetcdn.com/ajax/', '/ajax.googleapis.com/ajax/libs/', '/cdnjs.cloudflare.com/ajax/libs/', '/stackpath.bootstrapcdn.com/bootstrap/', '/wp-admin/', '/wp-content/', '/wp-includes/');
				$fvm_settings['js']['merge_defer'] = implode(PHP_EOL, fvm_array_order($arr));
				
				# js footer dependencies
				$arr = array('wp.i18n');
				$fvm_settings['js']['defer_dependencies'] = implode(PHP_EOL, fvm_array_order($arr));
				
				# recommended delayed scripts
				$arr = array('function(f,b,e,v,n,t,s)', 'function(w,d,s,l,i)', 'function(h,o,t,j,a,r)', 'connect.facebook.net', 'www.googletagmanager.com', 'gtag(', 'fbq(', 'assets.pinterest.com/js/pinit_main.js', 'pintrk(');
				$fvm_settings['js']['thirdparty'] = implode(PHP_EOL, fvm_array_order($arr));
				
			}

			# mark as done
			update_option('fastvelocity_upgraded', true);
		
		}
	}		
	# Version 3.0 routines end
	
	# return settings array
	return $fvm_settings;
}

# save log to database
# usage: $arr = array('type'=>'js', 'msg'=>'', 'meta'=>json_encode(array('loc'=>'function')));
function fvm_save_log($arr) {
	
	# must have
	if(is_null($arr) || !is_array($arr) || !isset($arr['msg'])) { return false; }
	
	# uid, prevent duplicate or unique by date
	if(!isset($arr['date'])) { 
		$arr['date'] = time();
		$arr['uid'] = fvm_generate_hash_with_prefix($arr['msg'], 'log');
	} else {
		$arr['uid'] = fvm_generate_hash_with_prefix($arr['date'] . ' / ' . $arr['msg'], 'log');
	}
	
	# initialize arrays (fields, types, values)
	$fld = array();
	$tpe = array();
	$vls = array();

	# define possible fields
	$all = array('date', 'uid', 'type', 'msg', 'meta');
	
	# process only recognized columns
	foreach($arr as $k=>$v) {
		if(in_array($k, $all)) {
			$tpe[] = '%s';
			$fld[] = $k;
			$vls[] = $v;
		}
	}
	
	try {
		
		# connect
		global $wpdb;
		if(is_null($wpdb)) { return false; }
		
		# check if exists before inserting
		$result = $wpdb->get_row($wpdb->prepare("SELECT id FROM ".$wpdb->prefix."fvm_logs WHERE uid = %s LIMIT 1", $arr['uid']));
		if(!isset($result->id)) {
			
			# prepare and insert to database
			$wpdb->query($wpdb->prepare("INSERT IGNORE INTO ".$wpdb->prefix."fvm_logs (".implode(', ', $fld).") VALUES (".implode(', ', $tpe).")", $vls));
			return true;
			
		}
				
	} catch (Exception $e) {
		error_log('Error: '.$e->getMessage(), 0);
	}

	# fallback
	return false;
	
}


# generate a 64 char string with prefix
function fvm_generate_hash_with_prefix($uid, $prefix) {
	return substr($prefix .hash('sha256', $uid), 0, 64);
}


# replace css imports with origin css code
function fvm_replace_css_imports($css, $rq=null) {
	
	# globals
	global $fvm_urls, $fvm_settings;
	
	# reset
	$cssimports = array();
	$cssimports_prepend = array();
	$css = trim($css);

	# handle import url rules
	preg_match_all ("/@import[ ]*['\"]{0,}(url\()*['\"]*([^\(\{'\"\)]*)['\"\)]*[;]{0,}/ui", $css, $cssimports);
	if(isset($cssimports[0]) && isset($cssimports[2])) {
		foreach($cssimports[0] as $k=>$cssimport) {
				
			# if @import url rule, or guess full url
			if(stripos($cssimport, 'import url') !== false && isset($cssimports[2][$k])) {
				$url = trim($cssimports[2][$k]);
			} else {
				if(!is_null($rq) && !empty($rq)) {
					$url = dirname($rq) . '/' . trim($cssimports[2][$k]);	
				}
			}
			
			# must have
			if(!empty($url)) {
				
				# make sure we have a complete url
				$href = fvm_normalize_url($url);

				# download, minify, cache (no ver query string)
				$tkey = fvm_generate_hash_with_prefix($href, 'css');
				$subcss = fvm_get_transient($tkey);
				if ($subcss === false) {
				
					# get minification settings for files
					if(isset($fvm_settings['css']['css_enable_min_files'])) {
						$enable_css_minification = $fvm_settings['css']['css_enable_min_files'];
					}					
					
					# force minification on google fonts
					if(stripos($href, 'fonts.googleapis.com') !== false) {
						$enable_css_minification = true;
					}
					
					# download file, get contents, merge
					$ddl = array();
					$ddl = fvm_maybe_download($href);
					
					# error
					if(isset($ddl['error'])) {
						return trim($css);
					}
				
					# if success
					if(isset($ddl['content'])) {
							
						# contents
						$subcss = $ddl['content'];
						
						# minify
						$subcss = fvm_maybe_minify_css_file($subcss, $href, $enable_css_minification);
		
						# trim code
						$subcss = trim($subcss);
								
						# save
						fvm_set_transient(array('uid'=>$tkey, 'date'=>$tvers, 'type'=>'css', 'content'=>$subcss));
					}
				}

				# remove import rule and prepend imported code
				if ($subcss !== false && !empty($subcss)) {
					$css = str_replace($cssimport, '', $css);
					$cssimports_prepend[] = '/* Import rule from: '.$href . ' */' . PHP_EOL . $subcss;
				}
				
			}
		}
	}
	
	# prepend import rules
	# https://www.w3.org/TR/CSS2/cascade.html#at-import
	if(count($cssimports_prepend) > 0) {
		$css = implode(PHP_EOL, $cssimports_prepend) . $css;
	}
	
	# return
	return trim($css);
	
}


# remove fonts and icons from final css
function fvm_extract_fonts($css_code, $url=null) {
	
	global $fvm_settings, $fvm_urls;
	$mff = array();
	$css_preload = array();
	$css_code_ff = '';
	
	# extract font faces
	preg_match_all('/\@\s*font-face\s*\{([^}]+)\}/iUu', $css_code, $mff);
	if(isset($mff[0]) && is_array($mff[0])) {
		foreach($mff[0] as $ff) {
								
			# strip and collect
			$css_code = str_replace($ff, '', $css_code);
			$css_code_ff.= $ff . PHP_EOL;
		
		}
	}
	
	# add font-display swap for all font faces
	# https://developers.google.com/web/updates/2016/02/font-display
	$css_code_ff = preg_replace_callback('/(?:@font-face)\s*{(?<value>[^}]+)}/i',
		function ($matches) {
			if(stripos($matches['value'], 'font-display') !== false) {
				return $matches[0];
			} else {
				return str_replace($matches['value'], 'font-display:swap;'.$matches['value'], $matches[0] );
			}
		},
		$css_code_ff
	);
	
	# add font-display swap for all font faces
	# https://developers.google.com/web/updates/2016/02/font-display
	$css_code = preg_replace_callback('/(?:@font-face)\s*{(?<value>[^}]+)}/i',
		function ($matches) {
			if(stripos($matches['value'], 'font-display') !== false) {
				return $matches[0];
			} else {
				return str_replace($matches['value'], 'font-display:swap;'.$matches['value'], $matches[0] );
			}
		},
		$css_code
	);
	
	# remove query strings from fonts
	$css_code_ff = preg_replace('/(.eot|.woff2|.woff|.ttf)+[?+](.+?)(\)|\'|\")/ui', "$1"."$3", $css_code_ff);
	$css_code = preg_replace('/(.eot|.woff2|.woff|.ttf)+[?+](.+?)(\)|\'|\")/ui', "$1"."$3", $css_code);
	
	# fix url paths css_code_ff
	if(!empty($url)) {
		$matches = array(); preg_match_all("/url\(\s*['\"]?(?!data:)(?!http)(?![\/'\"])(.+?)['\"]?\s*\)/ui", $css_code_ff, $matches);
		foreach($matches[1] as $a) { $b = trim($a); if($b != $a) { $css_code_ff = str_replace($a, $b, $css_code_ff); } }
		$css_code_ff = preg_replace("/url\(\s*['\"]?(?!data:)(?!http)(?![\/'\"#])(.+?)['\"]?\s*\)/ui", "url(".dirname($url)."/$1)", $css_code_ff);	
	}
	
	# fix url paths css_code
	if(!empty($url)) {
		$matches = array(); preg_match_all("/url\(\s*['\"]?(?!data:)(?!http)(?![\/'\"])(.+?)['\"]?\s*\)/ui", $css_code, $matches);
		foreach($matches[1] as $a) { $b = trim($a); if($b != $a) { $css_code = str_replace($a, $b, $css_code); } }
		$css_code = preg_replace("/url\(\s*['\"]?(?!data:)(?!http)(?![\/'\"#])(.+?)['\"]?\s*\)/ui", "url(".dirname($url)."/$1)", $css_code);	
	}
	
	# relative paths
	$css_code_ff = str_replace('https://'.$fvm_urls['wp_domain'], '', $css_code_ff);
	$css_code_ff = str_replace('http://'.$fvm_urls['wp_domain'], '', $css_code_ff);
	$css_code_ff = str_replace('//'.$fvm_urls['wp_domain'], '', $css_code_ff);
	
	# fixes
	$css_code_ff = str_replace('/./', '/', $css_code_ff);

	# return
	$result = array('code'=>$css_code, 'fonts'=>$css_code_ff);
	return $result;
}


# rewrite assets to cdn
function fvm_process_cdn($html) {
	
	# settings
	global $fvm_settings, $fvm_urls;
	
	# html must be an object
	if (!is_object($html)) {
		$nobj = 1;
		$html = fvm_str_get_html($html, true, true, 'UTF-8', false, PHP_EOL, ' ');
	}
	
	# default integration
	$integration_defaults = array('a[data-interchange*=/wp-content/], div[data-background-image], section[data-background-image], form[data-product_variations], image[height], img[src*=/wp-content/], img[data-src*=/wp-content/], img[data-srcset*=/wp-content/], link[rel=icon], link[rel=apple-touch-icon], meta[name=msapplication-TileImage], picture source[srcset*=/wp-content/], rs-slide[data-thumb], video source[type*=video]');
	
	# html integration
	if(isset($fvm_urls['wp_domain']) && isset($fvm_settings['cdn']['domain']) && isset($fvm_settings['cdn']['integration'])) {
		if(!empty($fvm_settings['cdn']['domain']) && !empty($fvm_urls['wp_domain'])) {
			$arr = fvm_string_toarray($fvm_settings['cdn']['integration']);
			$arr =  array_unique(array_merge($arr, $integration_defaults)); # add defaults
			if(is_array($arr) && count($arr) > 0) {
				foreach($html->find(implode(', ', $arr) ) as $elem) {
					
					# preserve some attributes but replace others
					if (is_object($elem) && isset($elem->attr)) {

						# get all attributes
						foreach ($elem->attr as $key=>$val) {
							
							# skip href attribute for links
							if($key == 'href' && stripos($elem->outertext, '<a ') !== false) { continue; }
							
							# skip certain attributes							
							if(in_array($key, array('id', 'class', 'action'))) { continue; }
							
							# scheme + site url
							$fcdn = str_replace($fvm_urls['wp_domain'], $fvm_settings['cdn']['domain'], $fvm_urls['wp_site_url']);
							
							# known replacements
							$elem->{$key} = str_ireplace('url(/wp-content/', 'url('.$fcdn.'/wp-content/', $elem->{$key});
							$elem->{$key} = str_ireplace('url("/wp-content/', 'url("'.$fcdn.'/wp-content/', $elem->{$key});
							$elem->{$key} = str_ireplace('url(\'/wp-content/', 'url(\''.$fcdn.'/wp-content/', $elem->{$key});
							
							# normalize certain field
							if(in_array($key, array('src', 'data-bg', 'data-lazy-src', 'audio', 'poster'))) { 
								$elem->{$key} = fvm_normalize_url($elem->{$key});
							}
							
							# replace other attributes
							$elem->{$key} = str_replace('//'.$fvm_urls['wp_domain'], '//'.$fvm_settings['cdn']['domain'], $elem->{$key});
							$elem->{$key} = str_replace('\/\/'.$fvm_urls['wp_domain'], '\/\/'.$fvm_settings['cdn']['domain'], $elem->{$key});
							
						}
						
					}

				}
			}
		}
	}
	
	
	# add CDN support to Styles, CSS and JS files

	# css
	if(isset($fvm_settings['cdn']['cssok']) && $fvm_settings['cdn']['cssok'] == true) {
		
		# scheme + site url
		$fcdn = str_replace($fvm_urls['wp_domain'], $fvm_settings['cdn']['domain'], $fvm_urls['wp_site_url']);
		
		# replace inside styles
		foreach($html->find('style') as $elem) {
			
			# fetch
			$css = $elem->outertext;
			
			# known replacements
			$css = str_ireplace('url(/wp-content/', 'url('.$fcdn.'/wp-content/', $css);
			$css = str_ireplace('url("/wp-content/', 'url("'.$fcdn.'/wp-content/', $css);
			$css = str_ireplace('url(\'/wp-content/', 'url(\''.$fcdn.'/wp-content/', $css);
			$css = str_replace('//'.$fvm_urls['wp_domain'], '//'.$fvm_settings['cdn']['domain'], $css);
			
			# save
			$elem->outertext = $css;
		
		}
		
		# replace link stylesheets
		if(isset($fvm_settings['cdn']['enable_css']) && $fvm_settings['cdn']['enable_css'] == true) {
			foreach($html->find('link[rel=stylesheet], link[rel=preload]') as $elem) {
				if(isset($elem->href)) {
					$elem->href = str_replace($fvm_urls['wp_site_url'], $fcdn, $elem->href);
				}			
			}
		}
	}
		
	# js
	if(isset($fvm_settings['cdn']['jsok']) && $fvm_settings['cdn']['jsok'] == true) {
		
		# replace script files
		foreach($html->find('script') as $elem) {
					
			# js files
			if(isset($fvm_settings['cdn']['enable_js']) && $fvm_settings['cdn']['enable_js'] == true) {
				if(isset($elem->src) && stripos($elem->src, $fvm_urls['wp_domain']) !== false) {
					$elem->src = str_replace('//'.$fvm_urls['wp_domain'], '//'.$fvm_settings['cdn']['domain'], $elem->src);
				}
			}
		}
			
	}
	
	# convert html object to string, only when needed
	if(isset($nobj) && $nobj == 1) {
		$html = trim($html->save());
	}
	
	# return
	return $html;
}


# rewrite url with cdn
function fvm_rewrite_cdn_url($url) {
	global $fvm_settings, $fvm_urls;
	if(isset($fvm_settings['cdn']['enable']) && $fvm_settings['cdn']['enable'] == true && isset($fvm_settings['cdn']['domain']) && !empty($fvm_settings['cdn']['domain'])) {
		$url = str_replace('//'.$fvm_urls['wp_domain'], '//'.$fvm_settings['cdn']['domain'], $url);
	}
	return $url;
}

# get css font-face rules, original + simplified
function fvm_simplify_fontface($css_code) {

	$mff = array();
	$before = array();
	$after = array();
	
	# extract font faces
	preg_match_all('/\@\s*font-face\s*\{([^}]+)\}/iUu', $css_code, $mff);
	if(isset($mff[0]) && isset($mff[1]) && is_array($mff[1])) {
		foreach($mff[1] as $kf=>$ff) {

			# simplify font urls
			$cssrules = preg_split("/;(?![^(]*\))/iu", $ff);
			foreach ($cssrules as $k=>$csr) {
				if(preg_match('/src\s*\:\s*url/Uui', $csr)) {

					# woff				
					$fonts = array();
					preg_match('/url\s*\(\s*[\'\"]*([^\'\"]*)[\'\"]*\)\s*format\s*\([\'\"]*woff[\'\"]*\s*\)/Uui', $csr, $fonts);
					if(isset($fonts[0])) { $cssrules[$k] = 'src:'.$fonts[0]; break; }

					# woff2
					$fonts = array();
					preg_match('/url\s*\(\s*[\'\"]*([^\'\"]*)[\'\"]*\)\s*format\s*\([\'\"]*woff2[\'\"]*\s*\)/Uui', $csr, $fonts);
					if(isset($fonts[0])) { $cssrules[$k] = 'src:'.$fonts[0]; break; }
				
					# svg
					$fonts = array();
					preg_match('/url\s*\(\s*[\'\"]*([^\'\"]*)[\'\"]*\)\s*format\s*\([\'\"]*svg[\'\"]*\s*\)/Uui', $csr, $fonts);
					if(isset($fonts[0])) { $cssrules[$k] = 'src:'.$fonts[0]; break; }
					
					# truetype
					$fonts = array();
					preg_match('/url\s*\(\s*[\'\"]*([^\'\"]*)[\'\"]*\)\s*format\s*\([\'\"]*truetype[\'\"]*\s*\)/Uui', $csr, $fonts);
					if(isset($fonts[0])) { $cssrules[$k] = 'src:'.$fonts[0]; break; }
					
					# delete other src:url rules
					if(stripos($csr, 'format') === false) {
						unset($cssrules[$k]);
					}
					
				}		
			}
			
			# merge and create font face rule
			$after[] = '@font-face{'.implode(';', $cssrules).'}';
											
			# strip and collect
			$before[] = $mff[0][$kf];
		
		}
	}

	# return
	if(count($before) > 0) {
		return array('before'=>$before, 'after'=>$after);
	} else {
		return false;
	}
}



# get css code from css file
function fvm_get_css_from_file($tag) {
	
	# globals
	global $fvm_settings;
	
	# variables
	$tvers = get_option('fvm_last_cache_update', '0');
	
	# make sure we have a complete url
	$href = fvm_normalize_url($tag->href);
	
	# download, minify, cache (no ver query string)
	$tkey = fvm_generate_hash_with_prefix($href, 'css');
	$css = fvm_get_transient($tkey);
	
	# download
	if ($css === false) {
		
		$ddl = array();
		$ddl = fvm_maybe_download($href);
		
		# error
		if(isset($ddl['error'])) {
			return array('error'=>$ddl['error'], 'tkey'=>$tkey, 'url'=> $href);
		}
		
		# success
		if(isset($ddl['content'])) {
			
			# minify flag
			$min = true; 
			if(isset($fvm_settings['css']['min_disable']) && $fvm_settings['css']['min_disable'] == true) { 
				$min = false; 
			}
							
			# minify
			$css = fvm_maybe_minify_css_file($ddl['content'], $href, $min);
			
			# quick integrity check
			if($css !== false) {

				# handle import rules
				$css = fvm_replace_css_imports($css, $href);
				$meta = json_encode(array('href'=>$href));
														
				# save transient
				$verify = fvm_set_transient(array('uid'=>$tkey, 'date'=>$tvers, 'type'=>'css', 'content'=>$css, 'meta'=>$meta));
								
				# success, from download
				return array('code'=>$css, 'tkey'=>$tkey, 'url'=> $href);
			}
		}
	
	} else {
		# success, from transient
		return array('code'=>$css, 'tkey'=>$tkey, 'url'=> $href);
	}
			
}


# get js code from css file
function fvm_get_js_from_file($tag) {
	
	# globals
	global $fvm_settings;
	
	# variables
	$tvers = get_option('fvm_last_cache_update', '0');
	
	# make sure we have a complete url
	$href = fvm_normalize_url($tag->src);
	
	# download, minify, cache (no ver query string)
	$tkey = fvm_generate_hash_with_prefix($href, 'js');
	$js = fvm_get_transient($tkey);
	
	# download
	if ($js === false) {
		
		$ddl = array();
		$ddl = fvm_maybe_download($href);
		
		# error
		if(isset($ddl['error'])) {
			return array('error'=>$ddl['error'], 'tkey'=>$tkey, 'url'=> $href);
		}
		
		# success
		if(isset($ddl['content'])) {
			
			# minify flag
			$min = true; 
			if(isset($fvm_settings['js']['min_disable']) && $fvm_settings['js']['min_disable'] == true) { 
				$min = false; 
			}
			
			# minify
			$js = fvm_maybe_minify_js($ddl['content'], $href, $min);
			
			# wrap with try catch
			$js = fvm_try_catch_wrap($js, $href);
			
			# quick integrity check
			if($js !== false) {

				# meta
				$meta = json_encode(array('href'=>$href));
										
				# save transient
				$verify = fvm_set_transient(array('uid'=>$tkey, 'date'=>$tvers, 'type'=>'js', 'content'=>$js, 'meta'=>$meta));
								
				# success, from download
				return array('code'=>$js, 'tkey'=>$tkey, 'url'=> $href);
			}
		}
	
	} else {
		# success, from transient
		return array('code'=>$js, 'tkey'=>$tkey, 'url'=> $href);
	}
	
	# fallback
	return false;
		
}




# get transients
function fvm_get_transient($key, $check=null, $with_meta=null) {
	
	# must have
	global $wpdb;
	if(is_null($wpdb)) { return false; }
	$db_prefix = $wpdb->prefix;
		
	try {
				
		# check or fetch
		if(!is_null($check)) {
			$sql = $wpdb->prepare("SELECT id FROM {$db_prefix}fvm_cache WHERE uid = %s LIMIT 1", $key);
		} else if (!is_null($with_meta)) {
			$sql = $wpdb->prepare("SELECT date, content, meta FROM {$db_prefix}fvm_cache WHERE uid = %s LIMIT 1", $key);
		} else {
			$sql = $wpdb->prepare("SELECT content FROM {$db_prefix}fvm_cache WHERE uid = %s LIMIT 1", $key);
		}

		# get result from database
		$result = $wpdb->get_row($sql);
		
		# return true if just checking
		if(!is_null($check) && isset($result->id)) {
			return true;
		}
		
		# return content only
		if(is_null($check) && is_null($with_meta) && isset($result->content)) {
			return $result->content;
		}
		
		# return content and meta
		if(is_null($check) && !is_null($with_meta) && isset($result->date) && isset($result->content) && isset($result->meta)) {
			return array('date'=>$result->date, 'content'=>$result->content, 'meta'=>json_decode($result->meta, true), 'cache-method'=>$cache_method);
		}
			
	} catch (Exception $e) {
		error_log('Error: '.$e->getMessage(), 0);
		return false;
	}
	
	# fallback
	return false;
}

# set cache
function fvm_set_transient($arr) {
	
	# must have
	if(!is_array($arr) || (is_array($arr) && (count($arr) == 0 || empty($arr)))) { return false; }
	if(!isset($arr['uid']) || !isset($arr['date']) || !isset($arr['type']) || !isset($arr['content'])) { return false; }
	
	# normalize unknown keys
	if(strlen($arr['uid']) != 64) { $arr['uid'] = fvm_generate_hash_with_prefix($arr['uid'], $arr['type']); }
	
	# check if it already exists, return early if it does
	$status = fvm_get_transient($arr['uid'], true);
	if($status) { return $arr['uid']; }	

	# must have
	global $wpdb;
	if(is_null($wpdb)) { return false; }
	$db_prefix = $wpdb->prefix;	
	
	# initialize arrays (fields, types, values)
	$fld = array();
	$tpe = array();
	$vls = array();
	
	# define possible data types
	$str = array('uid', 'type', 'content', 'meta');
	$int = array('date');
	$all = array_merge($str, $int);
	
	# process only recognized columns
	foreach($arr as $k=>$v) {
		if(in_array($k, $all)) {
			if(in_array($k, $str)) { $tpe[] = '%s'; } else { $tpe[] = '%d'; }
			$fld[] = $k;
			$vls[] = $v;
		}
	}
	
	try {
		# prepare and insert to database
		$result = $wpdb->query($wpdb->prepare("INSERT IGNORE INTO {$db_prefix}fvm_cache (".implode(', ', $fld).") VALUES (".implode(', ', $tpe).")", $vls));
		
		# success
		if($result) { 
			return $arr['uid']; 
		}
	} catch (Exception $e) {
		error_log('Error: '.$e->getMessage(), 0);
	}
		
	# fallback
	return false;
	
}

# delete transient
function fvm_del_transient($key) {
	
	# normalize unknown keys
	if(strlen($key) != 64) { $key = fvm_generate_hash_with_prefix($key, ''); }
	
	# must have
	global $wpdb;
	if(is_null($wpdb)) { return false; }
	$db_prefix = $wpdb->prefix;	
			
	try {
		# delete
		$wpdb->query($wpdb->prepare("DELETE FROM {$db_prefix}fvm_cache WHERE uid = %s", $key));
		return true;
	} catch (Exception $e) {
		error_log('Error: '.$e->getMessage(), 0);
	}
	
	# fallback
	return false;	
}


# functions, get full url
function fvm_normalize_url($href, $purl=null) {
	
	# preserve empty source handles
	$href = trim($href); 
	if(empty($href)) { return false; }      

	# some fixes
	$href = str_replace(array('&#038;', '&amp;'), '&', $href);
	
	# external url
	if(!is_null($purl) && !empty($purl)) {
		$parse = parse_url($purl);
	} else {
		# local url
		global $fvm_urls;
		$parse = parse_url($fvm_urls['wp_site_url']);
	}
	
	# domain info
	$scheme = $parse['scheme'];
	$host = $parse['host'];
	$path = $parse['path'];
	
	# relative to full urls
	if (substr($href, 0, 2) === "//") {
		$href = $scheme.':'.$href; # scheme missing
	} else if (substr($href, 0, 1) === "/") { 
		$href = $scheme.'://'.$host . $href; # scheme and domain missing
	} else if (substr($href, 0, 3) === '../' && !is_null($purl) && !empty($purl)) {
		$href = $scheme.':'.$host . dirname($path) . '/' . $href;
	} else if ($scheme == 'https' && substr($href, 0, 4) == 'http' && substr($href, 0, 5) !== $scheme) {
		$href = str_replace('http://', 'https://', $href); # force https
	} else {
		# url should be fine
	}

	# prevent double forward slashes in the middle
	$href = str_replace('###', '://', str_replace('//', '/', str_replace('://', '###', $href)));

	return $href;	
}


# minify ld+json scripts
function fvm_minify_microdata($data) {
	$data = trim(preg_replace('/(\v)+(\h)+[\/]{2}(.*)+(\v)+/u', '', $data));
	$data = trim(preg_replace('/\s+/u', ' ', $data));
	$data = str_replace(array('" ', ' "'), '"', $data);
	$data = str_replace(array('[ ', ' ['), '[', $data);
	$data = str_replace(array('] ', ' ]'), ']', $data);
	$data = str_replace(array('} ', ' }'), '}', $data);
	$data = str_replace(array('{ ', ' {'), '{', $data);
	return $data;
}


# check for php or html, skip if found
function fvm_not_php_html($code) {
	
	# return early if not html
	$code = trim($code);
	$a = '<!doctype'; # start
	$b = '<html';     # start
	$c = '<?xml';     # start
	$d = '<?php';     # anywhere
		
	if ( strcasecmp(substr($code, 0, strlen($a)), $a) != 0 && strcasecmp(substr($code, 0, strlen($b)), $b) != 0 && strcasecmp(substr($code, 0, strlen($c)), $c) != 0 && stripos($code, $d) === false ) {
		return true;
	}
	
	return false;
}


# find if a string looks like HTML content
function fvm_is_html($html) {
		
	# return early if it's html
	$html = trim($html);
	$a = '<!doctype';
	$b = '<html';
	if ( strcasecmp(substr($html, 0, strlen($a)), $a) == 0 || strcasecmp(substr($html, 0, strlen($b)), $b) == 0 ) {
		return true;
	}
	
	# must have html
	$hfound = array(); preg_match_all('/<\s?(html)+(.*)>(.*)<\s?\/\s?html\s?>/Uuis', $html, $hfound);
	if(!isset($hfound[0][0])) { return false; }
	
	# must have head
	$hfound = array(); preg_match_all('/<\s?(head)+(.*)>(.*)<\s?\/\s?head\s?>/Uuis', $html, $hfound);
	if(!isset($hfound[0][0])) { return false; }
	
	# must have body
	$hfound = array(); preg_match_all('/<\s?(body)+(.*)>(.*)<\s?\/\s?body\s?>/Uuis', $html, $hfound);
	if(!isset($hfound[0][0])) { return false; }
	
	# must have at least one of these
	$count = 0;
	
	# css link
	$hfound = array(); preg_match_all('/<\s?(link)+(.*)(rel|href)+(.*)>/Uuis', $html, $hfound);
	if(!isset($hfound[0][0])) { $count++; }
	
	# style
	$hfound = array(); preg_match_all('/<\s?(style)+(.*)(src)+(.*)>(.*)<\s?\/\s?style\s?>/Uuis', $html, $hfound);
	if(!isset($hfound[0][0])) { $count++; }
	
	# script
	$hfound = array(); preg_match_all('/<\s?(script)+(.*)(src)+(.*)>(.*)<\s?\/\s?script\s?>/Uuis', $html, $hfound);
	if(!isset($hfound[0][0])) { $count++; }
	
	# return if not
	if($count == 0) { return false; }
	
	# else, it's likely html
	return true;
	
}

# ensure that string is utf8	
function fvm_ensure_utf8($str) {
	$enc = mb_detect_encoding($str, mb_list_encodings(), true);
	if ($enc === false){
		return false; // could not detect encoding
	} else if ($enc !== "UTF-8") {
		return mb_convert_encoding($str, "UTF-8", $enc); // converted to utf8
	} else {
		return $str; // already utf8
	}
	
	# fail
	return false;
}


# check if we can process the page, minimum filters
function fvm_can_process_common() {
	global $fvm_settings, $fvm_urls;
	
	# only GET requests allowed
	if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
		return false;
	}
	
	# always skip on these tasks
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){ return false; }
	if( defined('WP_INSTALLING') && WP_INSTALLING ){ return false; }
	if( defined('WP_REPAIRING') && WP_REPAIRING ){ return false; }
	if( defined('WP_IMPORTING') && WP_IMPORTING ){ return false; }
	if( defined('DOING_AJAX') && DOING_AJAX ){ return false; }
	if( defined('WP_CLI') && WP_CLI ){ return false; }
	if( defined('XMLRPC_REQUEST') && XMLRPC_REQUEST ){ return false; }
	if( defined('WP_ADMIN') && WP_ADMIN ){ return false; }
	if( defined('SHORTINIT') && SHORTINIT ){ return false; }
	if( defined('IFRAME_REQUEST') && IFRAME_REQUEST ){ return false; }

	# detect api requests (only defined after parse_request hook)
	if( defined('REST_REQUEST') && REST_REQUEST ){ return false; } 
	
	# don't minify specific WordPress areas
	if(function_exists('is_404') && is_404()){ return false; }
	if(function_exists('is_feed') && is_feed()){ return false; }
	if(function_exists('is_comment_feed') && is_comment_feed()){ return false; }
	if(function_exists('is_attachment') && is_attachment()){ return false; }
	if(function_exists('is_trackback') && is_trackback()){ return false; }
	if(function_exists('is_robots') && is_robots()){ return false; }
	if(function_exists('is_preview') && is_preview()){ return false; }
	if(function_exists('is_customize_preview') && is_customize_preview()){ return false; }	
	if(function_exists('is_embed') && is_embed()){ return false; }
	if(function_exists('is_admin') && is_admin()){ return false; }
	if(function_exists('is_blog_admin') && is_blog_admin()){ return false; }
	if(function_exists('is_network_admin') && is_network_admin()){ return false; }
	
	# don't minify specific WooCommerce areas
	if(function_exists('is_checkout') && is_checkout()){ return false; }
	if(function_exists('is_account_page') && is_account_page()){ return false; }
	if(function_exists('is_ajax') && is_ajax()){ return false; }
	if(function_exists('is_wc_endpoint_url') && is_wc_endpoint_url()){ return false; }
		
	# get requested hostname
	$host = fvm_get_domain();
	
	# only for hosts matching the site_url
	if(isset($fvm_urls['wp_domain']) && !empty($fvm_urls['wp_domain'])) {
		if($host != $fvm_urls['wp_domain']) {
			return false;
		}
	}
	
	# if there is an url, skip common static files
	if(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI'])) {
		
		# parse url (path, query)
		$ruri = fvm_get_uripath();
			
		# no cache by extension as well, such as robots.txt and other situations
		$noext = array('.txt', '.xml', '.xsl', '.map', '.css', '.js', '.png', '.jpeg', '.jpg', '.gif', '.webp', '.ico', '.php', '.htaccess', '.json', '.pdf', '.mp4', '.webm');
		foreach ($noext as $ext) {
			if(substr($ruri, -strlen($ext)) == $ext) {
				return false;
			}
		}		
		
	}
			
	# default
	return true;
}


# check if we can process the page, minimum filters
function fvm_can_process_query_string() {

	# host and uri path
	$host = fvm_get_domain();
	$request_uri = fvm_get_uripath(true);
	$scheme = fvm_get_scheme();
	$url = $scheme.'://'.$host.$request_uri;
	$parse = parse_url($url);
	
	# parse query string to array, check if should be ignored
	if(isset($parse["query"]) && !empty($parse["query"])) {
		
		# check
		$qsarr = array(); parse_str($parse["query"], $qsarr);
		
		# remove allowed query strings from the list of detected queries
		if(isset($fvm_settings['settings']['qs']) && !empty($fvm_settings['settings']['qs'])) {
			$arr = fvm_string_toarray($fvm_settings['settings']['qs']);
			if(is_array($arr) && count($arr) > 0) {
				foreach ($arr as $a) { 
					if(isset($qsarr[$e])) { unset($qsarr[$e]); }			
				}
			}
		}
		
		# if there are other queries left, bypass processing
		if(count($qsarr) > 0) { 
			return false;
		}
	}
	
	# allow by default
	return true;
}

# check if the user is logged in, and if the user role allows optimization
function fvm_user_role_processing_allowed($group) {	
	if(function_exists('is_user_logged_in') && function_exists('wp_get_current_user')) {
		if(is_user_logged_in()) {
			
			# get user roles
			global $fvm_settings;
			$user = wp_get_current_user();
			$roles = (array) $user->roles;
			foreach($roles as $role) {
				if(isset($fvm_settings['minify'][$role]) && $fvm_settings['minify'][$role] == true) { 
					return true; 
				}
			}
			
			# disable for other logged in users by default
			return false;
		}
	}
	
	# allow by default
	return true;
}


# check if page is amp
function fvm_is_amp_page() {

	# don't minify amp pages by the amp plugin
	if(function_exists('is_amp_endpoint') && is_amp_endpoint()){ return true; }
	if(function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint()){ return true; }
	
	# query string or /amp/
	if(isset($_GET['amp'])) { return true; }
	if(substr(fvm_get_uripath(), -5) == '/amp/') { return true; }
		
	# not amp
	return false;
}


# validate and minify css
function fvm_maybe_minify_css_file($css, $url, $min) {
	
	# process css only if it's not php or html
	if(fvm_not_php_html($css)) {
		
		global $fvm_settings, $fvm_urls;

		# do not minify files in the ignore list
		if(isset($fvm_settings['css']['css_ignore_min']) && !empty($fvm_settings['css']['css_ignore_min'])) {
			$arr = fvm_string_toarray($fvm_settings['css']['css_ignore_min']);
			if(is_array($arr) && count($arr) > 0) {
				foreach ($arr as $e) { 
					if(stripos($url, $e) !== false) {
						$min = false;
						break; 
					} 
				}
			}
		}
		
		# filtering
		$css = fvm_ensure_utf8($css); 
		$css = str_ireplace('@charset "UTF-8";', '', $css);
		
		# remove query strings from fonts
		$css = preg_replace('/(.eot|.woff2|.woff|.ttf)+[?+](.+?)(\)|\'|\")/ui', "$1"."$3", $css);

		# remove sourceMappingURL
		$css = preg_replace('/(\/\/\s*[#]\s*sourceMappingURL\s*[=]\s*)([a-zA-Z0-9-_\.\/]+)(\.map)/ui', '', $css);
		$css = preg_replace('/(\/[*]\s*[#]\s*sourceMappingURL\s*[=]\s*)([a-zA-Z0-9-_\.\/]+)(\.map)\s*[*]\s*[\/]/ui', '', $css);
		
		# fix url paths
		if(!empty($url)) {
			$matches = array(); preg_match_all("/url\(\s*['\"]?(?!data:)(?!http)(?![\/'\"])(.+?)['\"]?\s*\)/ui", $css, $matches);
			foreach($matches[1] as $a) { $b = trim($a); if($b != $a) { $css = str_replace($a, $b, $css); } }
			$css = preg_replace("/url\(\s*['\"]?(?!data:)(?!http)(?![\/'\"#])(.+?)['\"]?\s*\)/ui", "url(".dirname($url)."/$1)", $css);	
		}
		
		# minify string with relative urls
		if($min === true) {
			$css = fvm_minify_css_string($css, $url);
		}
		
		# add font-display block for all font faces
		# https://developers.google.com/web/updates/2016/02/font-display
		$css = preg_replace_callback('/(?:@font-face)\s*{(?<value>[^}]+)}/i',
			function ($matches) {
				if ( preg_match('/font-display:\s*(?<swap_value>\w*);?/i', $matches['value'], $attribute)) {
					return 'swap' === strtolower($attribute['swap_value']) ? $matches[0] : str_replace($attribute['swap_value'], 'swap', $matches[0]);
				} else {
					$swap = "font-display:swap;{$matches['value']}";
				}
				return str_replace( $matches['value'], $swap, $matches[0] );
			},
			$css
		);
		
		# make relative urls when possible
				
		# get root url, preserve subdirectories
		if(isset($fvm_urls['wp_site_url']) && !empty($fvm_urls['wp_site_url'])) {
			
			# parse url and extract domain without uri path
			$use_url = $fvm_urls['wp_site_url'];
			$parse = parse_url($use_url);
			if(isset($parse['path']) && !empty($parse['path']) && $parse['path'] != '/') {
				$use_url = str_replace(str_replace($use_url, $parse['path'], $use_url), '', $use_url);
			}
			
			# adjust paths
			$bgimgs = array();
			preg_match_all ('/url\s*\(\s*[\'\"]*([^;\'\"]*)[\'\"]*\)/Uui', $css, $bgimgs);
			if(isset($bgimgs[1]) && is_array($bgimgs[1])) {
				foreach($bgimgs[1] as $img) {
					if(stripos($img, 'http') !== false || stripos($img, '//') !== false) {
						
						# normalize
						$newimg = fvm_normalize_url($img);
						if($newimg != $img) { $css = str_replace($img, $newimg, $css); $img = $newimg; }
						
						# process
						if(substr($img, 0, strlen($use_url)) == $use_url) {
							$pos = strpos($img, $use_url);
							if ($pos !== false) {
								
								# relative path image
								$relimg = '/' . ltrim(substr_replace($img, '', $pos, strlen($use_url)), '/');
								
								# replace url
								$css = str_replace($img, $relimg, $css);
								
							}
						}
						
					}
				}
			}
			
			# remove empty url()
			$css = preg_replace('/url\s*\(\s*[\'"]?\s*[\'"]?\)/Uui', 'none', $css);
			
			# relative paths
			$css = str_replace('https://'.$fvm_urls['wp_domain'], '', $css);
			$css = str_replace('http://'.$fvm_urls['wp_domain'], '', $css);
			$css = str_replace('//'.$fvm_urls['wp_domain'], '', $css);
			
			# fixes
			$css = str_replace('/./', '/', $css);
			
		}
		
		# simplify font face
		$arr = fvm_simplify_fontface($css);
		if($arr !== false && is_array($arr)) {
			$css = str_replace($arr['before'], $arr['after'], $css);
		}
		
		# return css
		return trim($css);
	
	}

	return false;
}


# validate and minify js
function fvm_maybe_minify_js($js, $url, $enable_js_minification) {

	# ensure it's utf8
	$js = fvm_ensure_utf8($js);
	
	# return early if empty
	if(empty($js) || $js == false) { return false; }
		
	# process js only if it's not php or html
	if(fvm_not_php_html($js)) {
		
		# globals
		global $fvm_settings;

		# filtering
		$js = fvm_ensure_utf8($js); 
				
		# remove sourceMappingURL
		$js = preg_replace('/(\/\/\s*[#]\s*sourceMappingURL\s*[=]\s*)([a-zA-Z0-9-_\.\/]+)(\.map)/ui', '', $js);
		$js = preg_replace('/(\/[*]\s*[#]\s*sourceMappingURL\s*[=]\s*)([a-zA-Z0-9-_\.\/]+)(\.map)\s*[*]\s*[\/]/ui', '', $js);
			
		# minify?
		if($enable_js_minification == true) {

			# PHP Minify from https://github.com/matthiasmullie/minify
			$minifier = new FVM\MatthiasMullie\Minify\JS($js);
			$min = $minifier->minify();
			
			# return if not empty
			if($min !== false && strlen(trim($min)) > 0) { 
				return $min;
			}
		}
	
		# return js
		return trim($js);
	
	}

	return false;	
}


# minify css string with PHP Minify
function fvm_minify_css_string($css) {
	
	# return early if empty
	if(empty($css) || $css == false) { return $css; }
	
	# minify	
	$minifier = new FVM\MatthiasMullie\Minify\CSS($css);
	$minifier->setMaxImportSize(10); # embed assets up to 10 Kb (default 5Kb) - processes gif, png, jpg, jpeg, svg & woff
	$min = $minifier->minify();
		
	# return
	if($min != false) { 
		return $min; 
	}
	
	# fallback
	return $css;
}


# escape html tags for document.write
function fvm_escape_url_js($str) {
	$str = trim(preg_replace('/[\t\n\r\s]+/iu', ' ', $str));
	return str_replace(array('\\\\\"', '\\\\"', '\\\"', '\\"'), '\"', json_encode($str));
}


# try catch wrapper for merged javascript
function fvm_try_catch_wrap($js, $href=null) {
	$loc = ''; if(isset($href)) { $loc = '[ File: '. $href . ' ] '; }
	return 'try{'. PHP_EOL . $js . PHP_EOL . '}catch(e){console.error("An error has occurred. '.$loc.'[ "+e.stack+" ]");}';
}


# Disable the emoji's on the frontend
function fvm_disable_emojis() {
	global $fvm_settings;
		if(isset($fvm_settings['html']['disable_emojis']) && $fvm_settings['html']['disable_emojis'] == true) {
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );	
			remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
			remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
			remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		}
}


# rewrite assets to cdn
function fvm_rewrite_assets_cdn($html) {
	
	# settings
	global $fvm_settings, $fvm_urls;
	
	if(isset($fvm_urls['wp_domain']) && !empty($fvm_urls['wp_domain']) && 
	isset($fvm_settings['cdn']['enable']) && $fvm_settings['cdn']['enable'] == true &&  
	isset($fvm_settings['cdn']['domain']) && !empty($fvm_settings['cdn']['domain']) &&
	isset($fvm_settings['cdn']['integration']) && !empty($fvm_settings['cdn']['integration'])) {
		$arr = fvm_string_toarray($fvm_settings['cdn']['integration']);
		if(is_array($arr) && count($arr) > 0) {
			foreach($html->find(implode(', ', $arr) ) as $elem) {
				
				# preserve some attributes but replace others
				if (is_object($elem) && isset($elem->attr)) {

					# get all attributes
					foreach ($elem->attr as $key=>$val) {
						
						# skip href attribute for links
						if($key == 'href' && stripos($elem->outertext, '<a ') !== false) { continue; }
							
						# skip certain attributes							
						if(in_array($key, array('id', 'class', 'action'))) { continue; }

						# replace other attributes
						$elem->{$key} = str_replace('//'.$fvm_urls['wp_domain'], '//'.$fvm_settings['cdn']['domain'], $elem->{$key});
						$elem->{$key} = str_replace('\/\/'.$fvm_urls['wp_domain'], '\/\/'.$fvm_settings['cdn']['domain'], $elem->{$key});

					}
						
				}

			}
		}
	}
	
	return $html;
}


# try to open the file from the disk, before downloading
function fvm_maybe_download($url) {
	
	# must have
	if(is_null($url) || empty($url)) { return false; }
	
	# get domain
	global $fvm_urls;
	
	# check if we can open the file locally first
	if (stripos($url, $fvm_urls['wp_domain']) !== false && defined('ABSPATH') && !empty('ABSPATH')) {
		
		# file path + windows compatibility
		$f =  strtok(str_replace('/', DIRECTORY_SEPARATOR, str_replace(rtrim($fvm_urls['wp_site_url'], '/'), rtrim(ABSPATH, '/'), $url)), '?');
					
		# did it work?
		if (file_exists($f) && is_file($f)) {
			return array('content'=>file_get_contents($f), 'src'=>'Disk');
		}
	}

	# fallback to downloading
	
	# this useragent is needed for google fonts (woff files only + hinted fonts)
	$uagent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586';

	# fetch via wordpress functions
	$response = wp_remote_get($url, array('user-agent'=>$uagent, 'timeout' => 7, 'httpversion' => '1.1', 'sslverify'=>false)); 
	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		return array('error'=>"Something went wrong: $error_message");
	} else {
		return array('content'=>wp_remote_retrieve_body($response), 'src'=>'Web');
	}
}


# add our function in the header
function fvm_add_header_function($html) {

# based on wp rocket delay js feature
$fvmf.= <<<'EOF'
<script data-cfasync="false">if(navigator.userAgent.match(/MSIE|Internet Explorer/i)||navigator.userAgent.match(/Trident\/7\..*?rv:11/i)){var href=document.location.href;if(!href.match(/[?&]iebrowser/)){if(href.indexOf("?")==-1){if(href.indexOf("#")==-1){document.location.href=href+"?iebrowser=1"}else{document.location.href=href.replace("#","?iebrowser=1#")}}else{if(href.indexOf("#")==-1){document.location.href=href+"&iebrowser=1"}else{document.location.href=href.replace("#","&iebrowser=1#")}}}}</script>
<script data-cfasync="false">class FVMLoader{constructor(e){this.triggerEvents=e,this.eventOptions={passive:!0},this.userEventListener=this.triggerListener.bind(this),this.delayedScripts={normal:[],async:[],defer:[]},this.allJQueries=[]}_addUserInteractionListener(e){this.triggerEvents.forEach(t=>window.addEventListener(t,e.userEventListener,e.eventOptions))}_removeUserInteractionListener(e){this.triggerEvents.forEach(t=>window.removeEventListener(t,e.userEventListener,e.eventOptions))}triggerListener(){this._removeUserInteractionListener(this),"loading"===document.readyState?document.addEventListener("DOMContentLoaded",this._loadEverythingNow.bind(this)):this._loadEverythingNow()}async _loadEverythingNow(){this._runAllDelayedCSS(),this._delayEventListeners(),this._delayJQueryReady(this),this._handleDocumentWrite(),this._registerAllDelayedScripts(),await this._loadScriptsFromList(this.delayedScripts.normal),await this._loadScriptsFromList(this.delayedScripts.defer),await this._loadScriptsFromList(this.delayedScripts.async),await this._triggerDOMContentLoaded(),await this._triggerWindowLoad(),window.dispatchEvent(new Event("wpr-allScriptsLoaded"))}_registerAllDelayedScripts(){document.querySelectorAll("script[type=fvmdelay]").forEach(e=>{e.hasAttribute("src")?e.hasAttribute("async")&&!1!==e.async?this.delayedScripts.async.push(e):e.hasAttribute("defer")&&!1!==e.defer||"module"===e.getAttribute("data-type")?this.delayedScripts.defer.push(e):this.delayedScripts.normal.push(e):this.delayedScripts.normal.push(e)})}_runAllDelayedCSS(){document.querySelectorAll("link[rel=fvmdelay]").forEach(e=>{e.setAttribute("rel","stylesheet")})}async _transformScript(e){return await this._requestAnimFrame(),new Promise(t=>{const n=document.createElement("script");let r;[...e.attributes].forEach(e=>{let t=e.nodeName;"type"!==t&&("data-type"===t&&(t="type",r=e.nodeValue),n.setAttribute(t,e.nodeValue))}),e.hasAttribute("src")?(n.addEventListener("load",t),n.addEventListener("error",t)):(n.text=e.text,t()),e.parentNode.replaceChild(n,e)})}async _loadScriptsFromList(e){const t=e.shift();return t?(await this._transformScript(t),this._loadScriptsFromList(e)):Promise.resolve()}_delayEventListeners(){let e={};function t(t,n){!function(t){function n(n){return e[t].eventsToRewrite.indexOf(n)>=0?"wpr-"+n:n}e[t]||(e[t]={originalFunctions:{add:t.addEventListener,remove:t.removeEventListener},eventsToRewrite:[]},t.addEventListener=function(){arguments[0]=n(arguments[0]),e[t].originalFunctions.add.apply(t,arguments)},t.removeEventListener=function(){arguments[0]=n(arguments[0]),e[t].originalFunctions.remove.apply(t,arguments)})}(t),e[t].eventsToRewrite.push(n)}function n(e,t){let n=e[t];Object.defineProperty(e,t,{get:()=>n||function(){},set(r){e["wpr"+t]=n=r}})}t(document,"DOMContentLoaded"),t(window,"DOMContentLoaded"),t(window,"load"),t(window,"pageshow"),t(document,"readystatechange"),n(document,"onreadystatechange"),n(window,"onload"),n(window,"onpageshow")}_delayJQueryReady(e){let t=window.jQuery;Object.defineProperty(window,"jQuery",{get:()=>t,set(n){if(n&&n.fn&&!e.allJQueries.includes(n)){n.fn.ready=n.fn.init.prototype.ready=function(t){e.domReadyFired?t.bind(document)(n):document.addEventListener("DOMContentLoaded2",()=>t.bind(document)(n))};const t=n.fn.on;n.fn.on=n.fn.init.prototype.on=function(){if(this[0]===window){function e(e){return e.split(" ").map(e=>"load"===e||0===e.indexOf("load.")?"wpr-jquery-load":e).join(" ")}"string"==typeof arguments[0]||arguments[0]instanceof String?arguments[0]=e(arguments[0]):"object"==typeof arguments[0]&&Object.keys(arguments[0]).forEach(t=>{delete Object.assign(arguments[0],{[e(t)]:arguments[0][t]})[t]})}return t.apply(this,arguments),this},e.allJQueries.push(n)}t=n}})}async _triggerDOMContentLoaded(){this.domReadyFired=!0,await this._requestAnimFrame(),document.dispatchEvent(new Event("DOMContentLoaded2")),await this._requestAnimFrame(),window.dispatchEvent(new Event("DOMContentLoaded2")),await this._requestAnimFrame(),document.dispatchEvent(new Event("wpr-readystatechange")),await this._requestAnimFrame(),document.wpronreadystatechange&&document.wpronreadystatechange()}async _triggerWindowLoad(){await this._requestAnimFrame(),window.dispatchEvent(new Event("wpr-load")),await this._requestAnimFrame(),window.wpronload&&window.wpronload(),await this._requestAnimFrame(),this.allJQueries.forEach(e=>e(window).trigger("wpr-jquery-load")),window.dispatchEvent(new Event("wpr-pageshow")),await this._requestAnimFrame(),window.wpronpageshow&&window.wpronpageshow()}_handleDocumentWrite(){const e=new Map;document.write=document.writeln=function(t){const n=document.currentScript,r=document.createRange(),i=n.parentElement;let a=e.get(n);void 0===a&&(a=n.nextSibling,e.set(n,a));const s=document.createDocumentFragment();r.setStart(s,0),s.appendChild(r.createContextualFragment(t)),i.insertBefore(s,a)}}async _requestAnimFrame(){return new Promise(e=>requestAnimationFrame(e))}static run(){const e=new FVMLoader(["keydown","mousemove","touchmove","touchstart","touchend","wheel"]);e._addUserInteractionListener(e)}}FVMLoader.run();</script>
EOF;

	# remove duplicates
	if(stripos($html, $fvmf) !== false) { 
		$html = str_ireplace($fvmf, '', $html); 
	}
	
	# add function 
	$html = str_replace('<!-- h_header_function -->', $fvmf, $html);
	return $html;
}

# add lazy load library
function fvm_add_footer_function($html) { 

# for further development
#$scripts = '';

# add code
#return str_replace('<!-- h_footer_fvm_scripts -->', '<!-- h_footer_fvm_scripts -->' . $scripts, $html);

}


# get the domain name
function fvm_get_scheme() {
	if(isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) === 'on') { return 'https'; }
	if(isset($_SERVER['HTTPS']) && '1' == $_SERVER['HTTPS']) { return 'https'; }
	if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) { return 'https'; }
	if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') { return 'https'; }
	return 'http';
}

# get the domain name
function fvm_get_domain() {
	if (function_exists('site_url')) {
		$parse = parse_url(site_url());
		return $parse['host'];
	} elseif(isset($_SERVER['SERVER_NAME']) && !empty($_SERVER['SERVER_NAME'])) {
		return $_SERVER['SERVER_NAME'];
	} elseif (isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])) {
		return $_SERVER['HTTP_HOST'];
	} else {
		return false;
	}
}

# get the settings file path, current domain name, and uri path without query strings
function fvm_get_uripath($full=null) {
	if (isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI'])) { 
		
		# full or no query string
		if(!is_null($full)) {
			$current_uri = trim($_SERVER['REQUEST_URI']);			
		} else {
			$current_uri = strtok($_SERVER['REQUEST_URI'], '?');
		}
		
		# filter
		$current_uri = str_replace('//', '/', str_replace('..', '', preg_replace( '/[ <>\'\"\r\n\t\(\)]/', '', $current_uri)));
		return $current_uri;
	} else {
		return false; 
	}
}