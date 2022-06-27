<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Toroplay
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body id="Tf-Wp" <?php body_class(); ?>>

<!--<Tp-Wp>-->
<div class="Tp-Wp" id="Tp-Wp">

    <!--<Header>-->
    <header class="Header MnBrCn BgA">
        <div class="MnBr EcBgA">
            <div class="Container">
                <figure class="Logo"><?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?></figure>
                <span class="Button MenuBtn AAShwHdd-lnk CXHd" data-shwhdd="Tp-Wp"><i></i><i></i><i></i></span>
                <!--<Rght>-->
                <span class="MenuBtnClose AAShwHdd-lnk CXHd" data-shwhdd="Tp-Wp"></span>
                <div class="Rght BgA">
                    <!--<Search>-->
                    <div class="Search"><?php get_template_part( 'formsearch' ); ?></div>
                    <!--</Search>-->
                    <!--<Menu>-->
                    <nav class="Menu">
                        <ul>
                            <?php wp_nav_menu(array('container' => false, 'theme_location' => 'primary_menu', 'items_wrap' => '%3$s', 'fallback_cb' => 'tr_default_menu', 'menu_id' => 'primary-menu')); ?>
                        </ul>
                    </nav>
                    <!--</Menu>-->
                </div>
                <!--</Rght>-->
            </div>
        </div>
    </header>
    <!--</Header>-->

    <!--<Body>-->
    <div class="Body Container">
        <div class="Content">
        <div class="Container">
        
        <?php tr_banners('ads_hd_bt'); ?>