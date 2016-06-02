<?php
/**
 * DEPC_template_theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package DEPC_template_theme
 */

if ( ! function_exists( 'depc_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function depc_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on DEPC_template_theme, use a find and replace
	 * to change 'depc' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'depc', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'depc' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'depc_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // depc_setup
add_action( 'after_setup_theme', 'depc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function depc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'depc_content_width', 640 );
}
add_action( 'after_setup_theme', 'depc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function depc_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Presentation', 'depc' ),
		'id'            => 'present-1',
		'description'   => 'Inline before the content',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
		
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'depc' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'depc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function depc_scripts() {
	// Normalize.css
	wp_enqueue_style( 'Normalize', get_template_directory_uri() . '/assets/libs/normalize.min.css');
	
	// Foundation
	wp_enqueue_style( 'Foundation-styles', get_template_directory_uri() . '/assets/libs/foundation/foundation.min.css');
	wp_enqueue_script( 'Foundation-scripts', get_template_directory_uri() . '/assets/libs/foundation/foundation.min.js', array(), '01', true );
	
	// style.css
	wp_enqueue_style( 'depc-style', get_stylesheet_uri() );
	
	// Collected custom scripts
	wp_enqueue_script( 'depc-all-script', get_template_directory_uri() . '/assets/js/allScript.js', array(), '01', true );

	//wp_enqueue_script( 'depc-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'depc_scripts' );

/* Allow WP to update w/o ftp credential request (FOR DEV ONLY COMMENT OUT ON LIVE!) */
if (current_user_can('administrator')) {
	define('FS_METHOD', 'direct');
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/// CUSTOM FUNCTION MODULES

/* Event Post Type */
require get_template_directory() . '/func_modules/event_post_type.php';

/* User Admin Menu Control */
require get_template_directory() . '/func_modules/admin_menu_control.php';

/* ACF: Tagline */
require get_template_directory() . '/func_modules/ACF_tagline.php';

/* ACF: Partners Display */
require get_template_directory() . '/func_modules/ACF_partners_display.php';

/* ACF: Event Date */
require get_template_directory() . '/func_modules/ACF_event_date.php';




