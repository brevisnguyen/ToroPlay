<?php
/**
 * ToroPlay Customizer functionality
 */

require get_template_directory() . '/inc/customizer/colors.php';

function tr_customize_register($wp_customize) {

    $wp_customize->remove_control( 'blogname' );
    $wp_customize->remove_control( 'blogdescription' );
    $wp_customize->remove_control( 'display_header_text' );
    $wp_customize->remove_control( 'custom_logo' );
    $wp_customize->remove_section('header_image');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_section('colors');
    
    $wp_customize->add_setting('tp_logo', array(
        'default'           => get_template_directory_uri().'/img/toroplay-logo.svg',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
        'validate_callback' => 'tr_validate_image',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'tp_logo', array(
        'label'    => __('Logo', 'toroplay'),
        'section'  => 'title_tagline',
        'settings' => 'tp_logo',
    )));
    
    $wp_customize->add_setting('tp_sidebar', array(
        'capability'     => 'edit_theme_options',
        'default' => '2',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_page_sidebar', array(
        'label'      => __('Sidebar', 'toroplay'),
        'section'    => 'title_tagline',
        'type'    => 'select',
        'settings'   => 'tp_sidebar',
        'choices'    => array(
            '0' => __('Disable', 'toroplay'),
            '1' => __('Left', 'toroplay'),
            '2' => __('Right', 'toroplay')
        ),
        'priority' => 99,
    ));
    
   $wp_customize->add_setting('tp_fullwidth', array(
        'capability'     => 'edit_theme_options',
        'default' => 0,
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_fullwidth', array(
        'label'      => __('Full Width', 'toroplay'),
        'section'    => 'title_tagline',
        'type'    => 'select',
        'settings'   => 'tp_fullwidth',
        'choices'    => array(
            '0' => __('Disable', 'toroplay'),
            '1' => __('Enable', 'toroplay'),
        ),
        'priority' => 99,
    ));
    
    $wp_customize->add_setting('tp_noboxed', array(
        'capability'     => 'edit_theme_options',
        'default' => 0,
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_noboxed', array(
        'label'      => __('No Boxed Layout', 'toroplay'),
        'section'    => 'title_tagline',
        'type'    => 'select',
        'settings'   => 'tp_noboxed',
        'choices'    => array(
            '0' => __('Disable', 'toroplay'),
            '1' => __('Enable', 'toroplay'),
        ),
        'priority' => 99,
    ));
    
    $wp_customize->add_setting('tp_corners', array(
        'capability'     => 'edit_theme_options',
        'default' => 0,
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_corners', array(
        'label'      => __('Less round corners', 'toroplay'),
        'section'    => 'title_tagline',
        'type'    => 'select',
        'settings'   => 'tp_corners',
        'choices'    => array(
            '0' => __('Disable', 'toroplay'),
            '1' => __('Enable', 'toroplay'),
        ),
        'priority' => 99,
    ));
    
    $wp_customize->add_section('tr_general', array(
        'title'    => __('General', 'toroplay'),
        'description' => '',
        'priority' => 1,
    ));
    
    $wp_customize->add_setting('tp_posts_per_page', array(
        'default'        => 20,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_posts_per_page', array(
        'label'      => __('Posts per page', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_posts_per_page',
    ));
    
    $wp_customize->add_setting('tp_posts_per_category', array(
        'default'        => 20,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_posts_per_category', array(
        'label'      => __('Posts per category', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_posts_per_category',
    ));
    
    $wp_customize->add_setting('tp_posts_per_tag', array(
        'default'        => 20,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_posts_per_tag', array(
        'label'      => __('Posts per tag', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_posts_per_tag',
    ));
    
    $wp_customize->add_setting('tp_posts_per_abc', array(
        'default'        => '20',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_posts_per_abc', array(
        'label'      => __('Posts per ABC', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_posts_per_abc',
    ));
    
    $wp_customize->add_setting('tp_posts_per_search', array(
        'default'        => 20,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_posts_per_search', array(
        'label'      => __('Posts per search', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_posts_per_search',
    ));
    
    $wp_customize->add_setting('tp_posts_per_related', array(
        'default'        => 6,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_posts_per_related', array(
        'label'      => __('Posts per related', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_posts_per_related',
    ));

    $wp_customize->add_setting('tp_posts_per_movies', array(
        'default'        => 10,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_posts_per_movies', array(
        'label'      => __('Number of movies on index', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_posts_per_movies',
    ));
    
    $wp_customize->add_setting('tp_posts_per_series', array(
        'default'        => 10,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_posts_per_series', array(
        'label'      => __('Number of series on index', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_posts_per_series',
    ));
    
    $wp_customize->add_setting('tp_posts_per_episodes', array(
        'default'        => 8,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_posts_per_episodes', array(
        'label'      => __('Number of episodes on index', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_posts_per_episodes',
    ));
    
    $wp_customize->add_setting('tp_posts_per_seasons', array(
        'default'        => 10,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_posts_per_seasons', array(
        'label'      => __('Number of seasons on index', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_posts_per_seasons',
    ));
    
    $wp_customize->add_setting('tp_debug', array(
        'capability'     => 'edit_theme_options',
        'default' => '1',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_debug', array(
        'label'      => __('CSS and JS Minified', 'toroplay'),
        'section'    => 'tr_general',
        'type'    => 'select',
        'settings'   => 'tp_speed',
        'choices'    => array(
            '1' => __('Enabled', 'toroplay'),
            '2' => __('Disable', 'toroplay'),
        ),
    ));

    $wp_customize->add_setting('show_filter', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('show_filter', array(
        'label'      => __('Show Filter Categories', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'show_filter',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Enable', 'toroplay'),
            '2' => __('Disable', 'toroplay'),
        ),
    ));
    
    $wp_customize->add_setting('show_related', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('show_related', array(
        'label'      => __('Show Related', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'show_related',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Enable', 'toroplay'),
            '2' => __('Disable', 'toroplay'),
        ),
    ));
    
    $wp_customize->add_setting('show_suggestsearch', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('show_suggestsearch', array(
        'label'      => __('Show Search Suggest', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'show_suggestsearch',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Enable', 'toroplay'),
            '2' => __('Disable', 'toroplay'),
        ),
    ));
    
    $wp_customize->add_setting('quality', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('quality', array(
        'label'      => __('Show Quality', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'quality',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('The last added.', 'toroplay'),
            '2' => __('The first added.', 'toroplay'),
        ),
    ));
           
    $wp_customize->add_setting('tp_page_movies', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_page_movies', array(
        'label'      => __('Page Movies', 'toroplay'),
        'section'    => 'tr_general',
        'type'    => 'dropdown-pages',
        'settings'   => 'tp_page_movies',
    ));
    
    $wp_customize->add_setting('tp_page_series', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_page_series', array(
        'label'      => __('Page Series', 'toroplay'),
        'section'    => 'tr_general',
        'type'    => 'dropdown-pages',
        'settings'   => 'tp_page_series',
    ));
    
    $wp_customize->add_setting('tp_page_seasons', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_page_seasons', array(
        'label'      => __('Page Seasons', 'toroplay'),
        'section'    => 'tr_general',
        'type'    => 'dropdown-pages',
        'settings'   => 'tp_page_seasons',
    ));

    $wp_customize->add_setting('tp_page_episodes', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_page_episodes', array(
        'label'      => __('Page Episodes', 'toroplay'),
        'section'    => 'tr_general',
        'type'    => 'dropdown-pages',
        'settings'   => 'tp_page_episodes',
    ));
    
    $wp_customize->add_setting('tp_facebook', array(
        'default'        => 'http://facebook.com/',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_facebook', array(
        'label'      => __('URL Facebook', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_facebook',
    ));
    
    $wp_customize->add_setting('tp_twitter', array(
        'default'        => 'http://twitter.com/',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_twitter', array(
        'label'      => __('URL Twitter', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_twitter',
    ));
    
    $wp_customize->add_setting('tp_googleplus', array(
        'default'        => 'http://google.com/',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_googleplus', array(
        'label'      => __('URL Google+', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_googleplus',
    ));
    
    $wp_customize->add_setting('tp_youtube', array(
        'default'        => 'http://youtube.com/',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_youtube', array(
        'label'      => __('URL Youtube', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_youtube',
    ));
    
    $wp_customize->add_setting('tp_footer', array(
        'default' => __('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquet vestibulum ipsum vel laoreet. Donec varius sit amet justo vitae pulvinar. Morbi varius enim a lorem elementum, quis pretium quam semper. Duis consectetur quam lorem, nec faucibus tellus elementum quis. Praesent feugiat ut nibh vel euismod. Vivamus nulla odio, porta id felis sed, malesuada tempus turpis. Etiam non mauris ac mi efficitur gravida. Morbi tempor metus sed massa porta tempus. Ut sem felis, ornare nec lorem eget, tempor rhoncus est. Aliquam eget dui sed leo aliquet ultricies. Suspendisse nec tincidunt velit. Proin sagittis aliquet gravida. Etiam quam tortor, lobortis nec volutpat eget, ultricies non turpis. Sed fringilla, lectus id bibendum tristique, massa odio accumsan dolor, eget laoreet nibh risus ut massa.</p>', 'toroplay'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_footer', array(
        'label'      => __('Footer Text', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_footer',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_setting('tp_hd', array(
        'default' => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_print',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_hd', array(
        'label'      => __('Code Header', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_hd',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_setting('tp_ft', array(
        'default' => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_print',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_ft', array(
        'label'      => __('Code Footer', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_ft',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_setting('tp_msjplayer', array(
        'default' => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_print',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_msjplayer', array(
        'label'      => __('Message below player', 'toroplay'),
        'section'    => 'tr_general',
        'settings'   => 'tp_msjplayer',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_section('tr_seo', array(
        'title'    => __('SEO', 'toroplay'),
        'description' => '',
        'priority' => 2,
    ));
        
    $wp_customize->add_setting('tp_homepage', array(
        'default' => __('Latest Movies', 'toroplay'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_homepage', array(
        'label'      => __('H1 - HomePage', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_homepage',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_setting('tp_homepagetag', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_homepagetag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_homepagetag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_homepage_series', array(
        'default' => __('Latest Series', 'toroplay'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_homepage_series', array(
        'label'      => __('Latest Series - HomePage', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_homepage_series',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_setting('tp_homepage_seriestag', array(
        'default'        => 'div',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_homepage_seriestag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_homepage_seriestag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_homepage_seasons', array(
        'default' => __('Latest Seasons', 'toroplay'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_homepage_seasons', array(
        'label'      => __('Latest Seasons - HomePage', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_homepage_seasons',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_setting('tp_homepage_seasonstag', array(
        'default'        => 'div',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_homepage_seasonstag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_homepage_seasonstag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_homepage_episodes', array(
        'default' => __('Latest Episodes', 'toroplay'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_homepage_episodes', array(
        'label'      => __('Latest Episodes - HomePage', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_homepage_episodes',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_setting('tp_homepage_episodestag', array(
        'default'        => 'div',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_homepage_episodestag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_homepage_episodestag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));

    $wp_customize->add_setting('tp_homepage_animes', array(
        'default' => __('Latest Animes', 'toroplay'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_homepage_animes', array(
        'label'      => __('Latest Animes - HomePage', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_homepage_animes',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_setting('tp_homepage_animestag', array(
        'default'        => 'div',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_homepage_animestag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_homepage_animestag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));

    $wp_customize->add_setting('tp_homepage_tvshows', array(
        'default' => __('Latest TV Shows', 'toroplay'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_homepage_tvshows', array(
        'label'      => __('Latest TV Shows - HomePage', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_homepage_tvshows',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_setting('tp_homepage_tvshowstag', array(
        'default'        => 'div',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_homepage_tvshowstag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_homepage_tvshowstag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('tp_category', array(
        'default' => __('{title}', 'toroplay'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
    
    $wp_customize->add_control('tp_category', array(
        'label'      => __('H1 - Category', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_category',
        'type' => 'textarea',
        'description' => __('{title} to display the name of the category.', 'toroplay')
    ));
    
    $wp_customize->add_setting('tp_category_tag', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_category_tag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_category_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_tag', array(
        'default' => __('{title}', 'toroplay'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
    
    $wp_customize->add_control('tp_tag', array(
        'label'      => __('H1 - Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_tag',
        'type' => 'textarea',
        'description' => __('{title} to display the name of the tag.', 'toroplay')
    ));
    
    $wp_customize->add_setting('tp_tag_tag', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_tag_tag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_tag_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('tp_single', array(
        'default' => __('{title}', 'toroplay'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_single', array(
        'label'      => __('H1 - Single Movies', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_single',
        'type' => 'textarea',
        'description' => __('{title} to display the title of the post.', 'toroplay')
    ));
    
    $wp_customize->add_setting('tp_singlem_tag', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_singlem_tag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_singlem_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_single_series', array(
        'default' => __('{title}', 'toroplay'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_single_series', array(
        'label'      => __('H1 - Single Series', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_single_series',
        'type' => 'textarea',
        'description' => __('{title} to display the title of the post.', 'toroplay')
    ));
    
    $wp_customize->add_setting('tp_singles_tag', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_singles_tag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_singles_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_single_seasons', array(
        'default' => sprintf( __('{title} %s- Season {season}%s', 'toroplay'), '<span>', '</span>'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_single_seasons', array(
        'label'      => __('H1 - Single Seasons', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_single_seasons',
        'type' => 'textarea',
        'description' => __('{title} to display the name of the term. - {season} to display the number of the season.', 'toroplay')
    ));
    
    $wp_customize->add_setting('tp_singlese_tag', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_singlese_tag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_singlese_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_single_episodes', array(
        'default' => sprintf( __('{title} %s{season}x{episode}%s', 'toroplay'), '<span>', '</span>'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_single_episodes', array(
        'label'      => __('H1 - Single Episodes', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_single_episodes',
        'type' => 'textarea',
        'description' => __('{title} to display the name of the term. - {season} to display the number of the season and {episode} to display the number of the episode.', 'toroplay')
    ));
    
    $wp_customize->add_setting('tp_singleep_tag', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_singleep_tag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_singleep_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_page', array(
        'default' => __('{title}', 'toroplay'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
    
    $wp_customize->add_control('tp_page', array(
        'label'      => __('H1 - Page', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_page',
        'type' => 'textarea',
        'description' => __('{title} to display the title of the page.', 'toroplay')
    ));
    
    $wp_customize->add_setting('tp_page_tag', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_page_tag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_page_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_letters', array(
        'default' => __('{title}', 'toroplay'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
    
    $wp_customize->add_control('tp_letters', array(
        'label'      => __('H1 - Letters', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_letters',
        'type' => 'textarea',
        'description' => __('{title} to display the name of the term.', 'toroplay')
    ));
    
    $wp_customize->add_setting('tp_letters_tag', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_letters_tag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_letters_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_cast', array(
        'default' => __('{title}', 'toroplay'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
    
    $wp_customize->add_control('tp_cast', array(
        'label'      => __('H1 - Cast', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_page',
        'type' => 'textarea',
        'description' => __('{title} to display the name of the term.', 'toroplay')
    ));
    
    $wp_customize->add_setting('tp_cast_tag', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_cast_tag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_cast_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_director', array(
        'default' => __('{title}', 'toroplay'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
    
    $wp_customize->add_control('tp_director', array(
        'label'      => __('H1 - Director', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_director',
        'type' => 'textarea',
        'description' => __('{title} to display the name of the term.', 'toroplay')
    ));
    
    $wp_customize->add_setting('tp_director_tag', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_director_tag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_director_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('tp_countries', array(
        'default' => __('{title}', 'toroplay'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
    
    $wp_customize->add_control('tp_countries', array(
        'label'      => __('H1 - Country', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_countries',
        'type' => 'textarea',
        'description' => __('{title} to display the name of the term.', 'toroplay')
    ));
    
    $wp_customize->add_setting('tp_countries_tag', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_countries_tag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_countries_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_related', array(
        'default' => __('Related', 'toroplay'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
    
    $wp_customize->add_control('tp_related', array(
        'label'      => __('Related', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_related',
        'type' => 'textarea',
    ));
        
    $wp_customize->add_setting('tp_links', array(
        'default' => __('Links', 'toroplay'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage'
    ));
    
    $wp_customize->add_control('tp_links', array(
        'label'      => __('Links', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_links',
        'type' => 'textarea',
        'description' => __('{title} to display the title of the post.', 'toroplay')
    ));
    
    $wp_customize->add_setting('tp_links_tag', array(
        'default'        => 'div',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_links_tag', array(
        'label'      => __('Tag', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_links_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_titlerelated_tag', array(
        'default'        => 'div',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_titlerelated_tag', array(
        'label'      => __('Tag Titles Related', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_titlerelated_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
            
    $wp_customize->add_setting('tp_titlelist_tag', array(
        'default'        => 'h3',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_titlelist_tag', array(
        'label'      => __('Tag Titles List', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_titlelist_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('tp_titleslider_tag', array(
        'default'        => 'div',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_titleslider_tag', array(
        'label'      => __('Tag Titles Slider', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_titleslider_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('tp_titlecar_tag', array(
        'default'        => 'div',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('tp_titlecar_tag', array(
        'label'      => __('Tag Titles Carousel', 'toroplay'),
        'section'    => 'tr_seo',
        'settings'   => 'tp_titlecar_tag',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_section('tr_carrousel', array(
        'title'    => __('Carrousel', 'toroplay'),
        'description' => '',
        'priority' => 2,
    ));
    
    $wp_customize->add_setting('tp_sliderfixed', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
    
    $wp_customize->add_control('tp_sliderfixed', array(
        'label'      => __('Show', 'toroplay'),
        'section'    => 'tr_carrousel',
        'settings'   => 'tp_sliderfixed',
        'type'       => 'radio',
        'choices'    => array(
            '0' => __('Disable', 'toroplay'),
            '1' => __('Enabled', 'toroplay'),
        ),
    ));
    
    $wp_customize->add_setting('posts_per_carrousel', array(
        'default'        => '12',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('posts_per_carrousel', array(
        'label'      => __('Number of posts', 'toroplay'),
        'section'    => 'tr_carrousel',
        'settings'   => 'posts_per_carrousel',
        'type'       => 'text'
    ));
    
    $wp_customize->add_setting('carrousel_orderby', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('carrousel_orderby', array(
        'label'      => __('Order by', 'toroplay'),
        'section'    => 'tr_carrousel',
        'settings'   => 'carrousel_orderby',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Random', 'toroplay'),
            '2' => __('Last', 'toroplay'),
            '3' => __('Best rated', 'toroplay'),
            '4' => __('Most views', 'toroplay'),
            '5' => __('Post sticky', 'toroplay'),
        ),
    ));
    
    $wp_customize->add_setting('carrousel_autoplay', array(
        'default'        => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('carrousel_autoplay', array(
        'label'      => __('Autoplay', 'toroplay'),
        'section'    => 'tr_carrousel',
        'settings'   => 'carrousel_autoplay',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_quality_carrousel', array(
        'default'        => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_quality_carrousel', array(
        'label'      => __('Show quality', 'toroplay'),
        'section'    => 'tr_carrousel',
        'settings'   => 'show_quality_carrousel',
        'type'       => 'checkbox',
    ));
        
    $wp_customize->add_section('tr_slider', array(
        'title'    => __('Slider', 'toroplay'),
        'description' => '',
        'priority' => 2,
    ));
    
    $wp_customize->add_setting('tp_slidermoved', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('tp_slidermoved', array(
        'label'      => __('Show', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'tp_slidermoved',
        'type'       => 'radio',
        'choices'    => array(
            '1' => __('Enabled', 'toroplay'),
            '2' => __('Disable', 'toroplay'),
        ),
    ));
    
    $wp_customize->add_setting('posts_per_slider', array(
        'default'        => '4',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('posts_per_slider', array(
        'label'      => __('Number of posts', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'posts_per_slider',
        'type'       => 'text'
    ));
    
    $wp_customize->add_setting('slider_orderby', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('slider_orderby', array(
        'label'      => __('Order by', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'slider_orderby',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Random', 'toroplay'),
            '2' => __('Last', 'toroplay'),
            '3' => __('Best rated (Required WP-PostRatings)', 'toroplay'),
            '4' => __('Most views (Required WP-PostViews)', 'toroplay'),
            '5' => __('Post sticky', 'toroplay'),
        ),
    ));
    
    $wp_customize->add_setting('slider_autoplay', array(
        'default'        => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('slider_autoplay', array(
        'label'      => __('Autoplay', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'slider_autoplay',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_geners_slider', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_geners_slider', array(
        'label'      => __('Show geners', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'show_geners_slider',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_directors_slider', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_directors_slider', array(
        'label'      => __('Show director', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'show_directors_slider',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_cast_slider', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_cast_slider', array(
        'label'      => __('Show cast', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'show_cast_slider',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_rating_slider', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_rating_slider', array(
        'label'      => __('Show rating', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'show_rating_slider',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_quality_slider', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_quality_slider', array(
        'label'      => __('Show quality', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'show_quality_slider',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_year_slider', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_year_slider', array(
        'label'      => __('Show year', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'show_year_slider',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_views_slider', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_views_slider', array(
        'label'      => __('Show views', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'show_views_slider',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_duration_slider', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_duration_slider', array(
        'label'      => __('Show duration', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'show_duration_slider',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_tag_slider', array(
        'default'        => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_tag_slider', array(
        'label'      => __('Show tag', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'theme_options[show_tag_slider]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_description_slider', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_description_slider', array(
        'label'      => __('Show description', 'toroplay'),
        'section'    => 'tr_slider',
        'settings'   => 'show_description_slider',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_section('tr_hover', array(
        'title'    => __('Info Hover', 'toroplay'),
        'description' => '',
        'priority' => 2,
    ));
    
    $wp_customize->add_setting('show_hover', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_hover', array(
        'label'      => __('Show', 'toroplay'),
        'section'    => 'tr_hover',
        'settings'   => 'show_hover',
        'type'       => 'radio',
        'choices'    => array(
            '1' => __('Enable', 'toroplay'),
            '2' => __('Disable', 'toroplay'),
        ),
    ));
    
    $wp_customize->add_setting('show_hover_title', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_hover_title', array(
        'label'      => __('Show title', 'toroplay'),
        'section'    => 'tr_hover',
        'settings'   => 'show_hover_title',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_hover_year', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_hover_year', array(
        'label'      => __('Show year', 'toroplay'),
        'section'    => 'tr_hover',
        'settings'   => 'show_hover_year',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_hover_rating', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_hover_rating', array(
        'label'      => __('Show rating', 'toroplay'),
        'section'    => 'tr_hover',
        'settings'   => 'show_hover_rating',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_hover_quality', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_hover_quality', array(
        'label'      => __('Show quality', 'toroplay'),
        'section'    => 'tr_hover',
        'settings'   => 'show_hover_quality',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_hover_duration', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_hover_duration', array(
        'label'      => __('Show duration', 'toroplay'),
        'section'    => 'tr_hover',
        'settings'   => 'show_hover_duration',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_hover_views', array(
        'default'        => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_hover_views', array(
        'label'      => __('Show views', 'toroplay'),
        'section'    => 'tr_hover',
        'settings'   => 'show_hover_views',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_hover_description', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_hover_description', array(
        'label'      => __('Show description', 'toroplay'),
        'section'    => 'tr_hover',
        'settings'   => 'show_hover_description',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_hover_categories', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_hover_categories', array(
        'label'      => __('Show categories', 'toroplay'),
        'section'    => 'tr_hover',
        'settings'   => 'show_hover_categories',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_hover_director', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_hover_director', array(
        'label'      => __('Show director', 'toroplay'),
        'section'    => 'tr_hover',
        'settings'   => 'show_hover_director',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_hover_cast', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_hover_cast', array(
        'label'      => __('Show cast', 'toroplay'),
        'section'    => 'tr_hover',
        'settings'   => 'show_hover_cast',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('show_hover_status', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('show_hover_status', array(
        'label'      => __('Show Status (Series)', 'toroplay'),
        'section'    => 'tr_hover',
        'settings'   => 'show_hover_status',
        'type'       => 'checkbox',
    ));
    
}
 
add_action('customize_register', 'tr_customize_register');

function tr_sanitize_text_html( $input ) {
    $allowed = array(
        'a' => array(
            'href' => array(),
            'title' => array(),
            'target' => array(),
            'class' => array()
        ),
        'em' => array(),
        'strong' => array(),
        'b' => array(),
        'h1' => array(),
        'h2' => array(),
        'h3' => array(),
        'h4' => array(),
        'h5' => array(),
        'h6' => array(),
        'p' => array(),
        'span' => array(),
    );

    return wp_kses( $input, $allowed );
}

function tr_sanitize_print ( $input ) {
    
    return stripslashes( wp_specialchars_decode( $input ) );
    
}

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 */
function tr_customize_preview_js() {
	wp_enqueue_script( 'tr-customize-preview', get_template_directory_uri() . '/inc/customizer/assets/js/customize-preview.js', array( 'customize-preview' ), TR_THEMEVERSION, true );
}
add_action( 'customize_preview_init', 'tr_customize_preview_js' );

function toroplay_header_style() {}