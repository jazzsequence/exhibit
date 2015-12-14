<?php
/**
 * exhibit functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package exhibit
 */

if ( ! function_exists( 'exhibit_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function exhibit_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'exhibit', get_template_directory() . '/languages' );

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
			'primary' => esc_html__( 'Primary', 'exhibit' ),
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
		add_theme_support( 'custom-background', apply_filters( 'exhibit_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	}
endif; // Exhibit_setup.
add_action( 'after_setup_theme', 'exhibit_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function exhibit_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'exhibit_content_width', 698 );
}
add_action( 'after_setup_theme', 'exhibit_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function exhibit_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'exhibit' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'exhibit_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function exhibit_scripts() {
	wp_enqueue_style( 'exhibit-style', get_stylesheet_uri() );

	$version = filemtime( get_template_directory() . '/js/main.js' );

	wp_enqueue_script( 'wcus-main', esc_url( get_template_directory_uri() . '/js/main.js' ), array( 'jquery', 'underscore', 'director' ), $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'exhibit_scripts' );

/**
 * Prevent WP_Query from returning a 404.
 */
function exhibit_override_routing() {
	global $wp_query;

	$wp_query->is_404 = false;

	status_header( 200 );
}
add_action( 'template_redirect', 'exhibit_override_routing' );
