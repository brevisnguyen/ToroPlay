<?php
/**
 * ToroPlay functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ToroPlay
 * By ToroThemes.com
 */

define ( 'TR_THEMEVERSION', '3.1');
define( 'TR_GRABBER_MOVIES', 1 ); // Activate module movies
define( 'TR_GRABBER_SERIES', 1 ); // Activate module series
define( 'TR_MINIFY', true );

if(is_admin()){
    $tpserial=get_option('tplicense');
    if( isset($tpserial) ) {
        require get_template_directory().'/inc/update.php';
        $tp_update = new TPUpdateChecker(
            'toroplay',
            'https://toroplay.com/api/?trupdate=1&trname=1&trserial='.$tpserial
        );
    }
}

if ( ! function_exists( 'toroplay_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function toroplay_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Toroplay, use a find and replace
		 * to change 'toroplay' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'toroplay', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 185,278 );
        add_image_size( 'widget', 92, 138, true );

        //add_image_size( 'img-mov-md', 180, 260, true );
        //add_image_size( 'img-mov-sm', 55, 85, true );
        //add_image_size( 'img-mov-xsm', 55, 85, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary_menu' => esc_html__( 'Primary', 'toroplay' ),
            'secondary_menu'  => esc_html__( 'Secondary Menu', 'toroplay' ),
            'footer_menu'  => esc_html__( 'Footer Menu', 'toroplay' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'toroplay_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 60,
			'width'       => 205,
			'flex-width'  => true,
			'flex-height' => true,
		) );
        
        
        /**
         * Set up the WordPress core custom header feature.
         *
         * @uses toroplay_header_style()
         */
        add_theme_support( 'custom-header', apply_filters( 'toroplay_custom_header_args', array(
            'default-image'          => '',
            'default-text-color'     => '000000',
            'width'                  => 1300,
            'height'                 => 80,
            'flex-height'            => true,
            'wp-head-callback'       => 'toroplay_header_style',
        ) ) );
        
        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style( array( 'css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'toroplay_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function toroplay_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'toroplay_content_width', 880 );
}
add_action( 'after_setup_theme', 'toroplay_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function toroplay_widgets_init() {
    
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'toroplay' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here.', 'toroplay' ),
		'before_widget' => '<div id="%1$s" class="Wdgt %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="Title widget-title">',
		'after_title'   => '</div>',
	) );
    
	register_sidebar( array(
		'name'          => esc_html__( 'Home Sidebar', 'toroplay' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'toroplay' ),
		'before_widget' => '<div id="%1$s" class="Wdgt %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="Title widget-title">',
		'after_title'   => '</div>',
	) );
    
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Categories', 'toroplay' ),
		'id'            => 'sidebar-7',
		'description'   => esc_html__( 'Add widgets here.', 'toroplay' ),
		'before_widget' => '<div id="%1$s" class="Wdgt %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="Title widget-title">',
		'after_title'   => '</div>',
	) );
    
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Single Movies', 'toroplay' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here.', 'toroplay' ),
		'before_widget' => '<div id="%1$s" class="Wdgt %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="Title widget-title">',
		'after_title'   => '</div>',
	) );
    
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Single Series', 'toroplay' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'toroplay' ),
		'before_widget' => '<div id="%1$s" class="Wdgt %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="Title widget-title">',
		'after_title'   => '</div>',
	) );
    
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Seasons', 'toroplay' ),
		'id'            => 'sidebar-6',
		'description'   => esc_html__( 'Add widgets here.', 'toroplay' ),
		'before_widget' => '<div id="%1$s" class="Wdgt %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="Title widget-title">',
		'after_title'   => '</div>',
	) );
    
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Episodes', 'toroplay' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Add widgets here.', 'toroplay' ),
		'before_widget' => '<div id="%1$s" class="Wdgt %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="Title widget-title">',
		'after_title'   => '</div>',
	) );
    
}
add_action( 'widgets_init', 'toroplay_widgets_init' );

if ( ! function_exists( 'toroplay_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function toroplay_scripts() {
    
    wp_enqueue_style( 'toroplay-fontawesome', get_template_directory_uri() . '/css/font-awesome.css', array(), TR_THEMEVERSION, 'none' );
    
    wp_enqueue_style( 'toroplay-material', get_template_directory_uri() . '/css/material.css', array(), TR_THEMEVERSION );

    wp_enqueue_style( 'toroplay-style', get_stylesheet_uri(), array(), TR_THEMEVERSION );

    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Montserrat:300,400,700', array(), TR_THEMEVERSION);

    wp_enqueue_script( 'toroplay-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), TR_THEMEVERSION, true );
        
    $myvars_live = array( 
        'url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'tr-live' ),
        'loading' => __('Loading', 'toroplay'),
        'none' => __('There were no results', 'toroplay')
    );
    wp_enqueue_script('trlive', get_template_directory_uri().'/js/trlive.js',array('jquery'), TR_THEMEVERSION,true);
    wp_localize_script( 'trlive', 'trlive', $myvars_live );
    
    wp_enqueue_script( 'toroplay-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), TR_THEMEVERSION, true );

    // rating
    
    if( function_exists('the_ratings') ) {
        $postratings_max = intval(get_option('postratings_max'));
        $postratings_custom = intval(get_option('postratings_customrating'));
        $postratings_ajax_style = get_option('postratings_ajax_style');
        $postratings_javascript = '';
        if($postratings_custom) {
            for($i = 1; $i <= $postratings_max; $i++) {
                $postratings_javascript .= 'var ratings_'.$i.'_mouseover_image=new Image();ratings_'.$i.'_mouseover_image.src=ratingsL10n.plugin_url+"/images/"+ratingsL10n.image+"/rating_'.$i.'_over."+ratingsL10n.image_ext;';
            }
        } else {
            $postratings_javascript = 'var ratings_mouseover_image=new Image();ratings_mouseover_image.src=ratingsL10n.plugin_url+"/images/"+ratingsL10n.image+"/rating_over."+ratingsL10n.image_ext;';
        }
        wp_enqueue_script('trpostratings', get_template_directory_uri().'/js/postratings.js', array('jquery'), TR_THEMEVERSION, true);
        wp_localize_script('trpostratings', 'ratingsL10n', array(
            'plugin_url' => plugins_url('wp-postratings'),
            'ajax_url' => admin_url('admin-ajax.php'),
            'text_wait' => __('Please rate only 1 post at a time.', 'toroplay'),
            'image' => get_option('postratings_image'),
            'image_ext' => RATINGS_IMG_EXT,
            'max' => $postratings_max,
            'show_loading' => intval($postratings_ajax_style['loading']),
            'show_fading' => intval($postratings_ajax_style['fading']),
            'custom' => $postratings_custom,
            'l10n_print_after' => $postratings_javascript
        ));
    }

    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
            
    wp_dequeue_style('wp-postratings');
    wp_dequeue_style('wp-postratings-rtl');
    wp_dequeue_style('contact-form-7');
}
endif;
add_action( 'wp_enqueue_scripts', 'toroplay_scripts' );

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Filters
 */
require get_template_directory() . '/inc/filters.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Widgets custom
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Advanced Search
 */
require get_template_directory() . '/inc/advanced-search.php';

/**
 * Rating
 */
require get_template_directory() . '/inc/rating.php';

/**
 * Related
 */
require get_template_directory() . '/inc/related.php';

/**
 * Links
 */
require get_template_directory() . '/inc/links.php';

/**
 * Shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Dynamic thumbnails
 */
require get_template_directory() . '/inc/dynamic-thumbnails.php';

/**
 * Admin
 */
require get_template_directory() . '/inc/admin.php';

/**
 * Functions TGM Plugin Activation
 */
require get_template_directory() . '/inc/tgm.php';