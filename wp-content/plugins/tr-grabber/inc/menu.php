<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action('admin_menu', 'tr_grabber_options');

function tr_grabber_options(){
    global $submenu;
    
    add_menu_page( 'TR Grabber', 'TR Grabber', 'manage_options', 'tr-grabber', 'tr_grabber_function', '', 2 );
    
}

function tr_grabber_menu() {
    global $pagenow;

    if ( in_array( $pagenow, array( 'edit.php' ) ) or in_array( $pagenow, array( 'post-new.php' ) ) or in_array( $pagenow, array( 'post.php' ) ) or isset($_GET['taxonomy']) or in_array( $pagenow, array( 'edit.php' ) ) and isset( $_REQUEST['post_type'] ) ) {
        
        $_GET['taxonomy'] = isset($_GET['taxonomy']) ? $_GET['taxonomy'] : '';
        $_GET['taxonomy'] = $_GET['taxonomy'] == 'cast_tv' ? 'cast' : $_GET['taxonomy'];
        $_GET['taxonomy'] = $_GET['taxonomy'] == 'directors_tv' ? 'directors' : $_GET['taxonomy'];
        
        $current1a = in_array( $pagenow, array( 'edit.php' ) ) ? ' class="current"' : '';
        $current1b = in_array( $pagenow, array( 'post-new.php' ) ) ? ' class="current"' : '';
        $current1c = $_GET['taxonomy']=='directors' ? ' class="current"' : '';
        $current1d = $_GET['taxonomy']=='cast' ? ' class="current"' : '';
        $current1e = $_GET['taxonomy']=='country' ? ' class="current"' : '';
        $current1f = '';
        if( $_GET['taxonomy']=='server' or $_GET['taxonomy']=='language' or $_GET['taxonomy']=='quality' ) $current1f = ' class="current"';
        $current1g = $_GET['taxonomy'] == 'server' ? ' class="current"' : '';
        $current1h = $_GET['taxonomy'] == 'language' ? ' class="current"' : '';
        $current1i = $_GET['taxonomy'] == 'quality' ? ' class="current"' : '';
        $current1j = $_GET['taxonomy'] == 'category' ? ' class="current"' : '';
        $current1k = $_GET['taxonomy'] == 'seasons' ? ' class="current"' : '';
        $current1l = $_GET['taxonomy'] == 'episodes' ? ' class="current"' : '';
                
        if( tr_grabber_type() == 1 ) {
            echo'
            <ul class="MnTpAdn filter-links" id="tr-grabber-menu">
                <li><a'.$current1a.' href="'.admin_url( 'edit.php?post_type=movies' ).'">'.__('All', 'tr-grabber').'</a></li>
                <li><a'.$current1b.' href="'.admin_url( 'post-new.php?post_type=movies' ).'">'.__('Add Movie', 'tr-grabber').'</a></li>
                <li><a'.$current1c.' href="'.admin_url( 'edit-tags.php?taxonomy=directors&post_type=movies' ).'">'.__('Directors', 'tr-grabber').'</a></li>
                <li><a'.$current1d.' href="'.admin_url( 'edit-tags.php?taxonomy=cast&post_type=movies' ).'">'.__('Cast', 'tr-grabber').'</a></li>
                <li><a'.$current1e.' href="'.admin_url( 'edit-tags.php?taxonomy=country&post_type=movies' ).'">'.__('Countries', 'tr-grabber').'</a></li>
                <li>
                    <a'.$current1f.' href="#">'.__('Links', 'tr-grabber').' <i class="dashicons dashicons-arrow-down-alt2"></i></a>
                    <ul>
                        <li><a'.$current1g.' href="'.admin_url( 'edit-tags.php?taxonomy=server&post_type=movies' ).'">'.__('Servers', 'tr-grabber').'</a></li>
                        <li><a'.$current1h.' href="'.admin_url( 'edit-tags.php?taxonomy=language&post_type=movies' ).'">'.__('Languages', 'tr-grabber').'</a></li>
                        <li><a'.$current1i.' href="'.admin_url( 'edit-tags.php?taxonomy=quality&post_type=movies' ).'">'.__('Qualitys', 'tr-grabber').'</a></li>
                    </ul>
                </li>
                <li><a'.$current1j.' href="'.admin_url( 'edit-tags.php?taxonomy=category&post_type=movies' ).'">'.__('Categories', 'tr-grabber').'</a></li>
            </ul>
            ';
        }
        
        if( tr_grabber_type() == 2 ) {
            
            echo'
            <ul class="MnTpAdn filter-links" id="tr-grabber-menu">
                <li><a'.$current1a.' href="'.admin_url( 'edit.php?post_type=series' ).'">'.__('All', 'tr-grabber').'</a></li>
                <li><a'.$current1b.' href="'.admin_url( 'post-new.php?post_type=series' ).'">'.__('Add Serie', 'tr-grabber').'</a></li>
                <li><a'.$current1c.' href="'.admin_url( 'edit-tags.php?taxonomy=directors_tv&post_type=series' ).'">'.__('Directors', 'tr-grabber').'</a></li>
                <li><a'.$current1d.' href="'.admin_url( 'edit-tags.php?taxonomy=cast_tv&post_type=series' ).'">'.__('Cast', 'tr-grabber').'</a></li>
                <li>
                    <a'.$current1f.' href="#">'.__('Links', 'tr-grabber').' <i class="dashicons dashicons-arrow-down-alt2"></i></a>
                    <ul>
                        <li><a'.$current1g.' href="'.admin_url( 'edit-tags.php?taxonomy=server&post_type=series' ).'">'.__('Servers', 'tr-grabber').'</a></li>
                        <li><a'.$current1h.' href="'.admin_url( 'edit-tags.php?taxonomy=language&post_type=series' ).'">'.__('Languages', 'tr-grabber').'</a></li>
                        <li><a'.$current1i.' href="'.admin_url( 'edit-tags.php?taxonomy=quality&post_type=series' ).'">'.__('Qualitys', 'tr-grabber').'</a></li>
                    </ul>
                </li>
                <li><a'.$current1j.' href="'.admin_url( 'edit-tags.php?taxonomy=category&post_type=series' ).'">'.__('Categories', 'tr-grabber').'</a></li>
                <li'.$current1k.'><a href="'.admin_url( 'edit-tags.php?taxonomy=seasons&post_type=series' ).'">'.__('Seasons', 'tr-grabber').'</a></li>
                <li'.$current1l.'><a href="'.admin_url( 'edit-tags.php?taxonomy=episodes&post_type=series' ).'">'.__('Episodes', 'tr-grabber').'</a></li>
            </ul>
            ';
            
        }

    }

}

add_action('admin_footer-edit.php', 'tr_grabber_menu');
add_action('admin_footer-post.php', 'tr_grabber_menu');
add_action('admin_footer-post-new.php', 'tr_grabber_menu');
add_action('admin_footer-edit-tags.php', 'tr_grabber_menu');
add_action('admin_footer-term.php', 'tr_grabber_menu');

?>