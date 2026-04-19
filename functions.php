<?php
/**
 * Bloom Theme Functions
 *
 * @package Bloom
 */

defined( 'ABSPATH' ) || exit;

define( 'BLOOM_VERSION', '1.0.0' );
define( 'BLOOM_DIR', get_template_directory() );
define( 'BLOOM_URI', get_template_directory_uri() );

// ── Core Setup ──────────────────────────────────────────────────────────────

function bloom_setup() {
	load_theme_textdomain( 'bloom', BLOOM_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'custom-logo', [
		'height'      => 80,
		'width'       => 220,
		'flex-height' => true,
		'flex-width'  => true,
	] );
	add_theme_support( 'custom-background', [
		'default-color' => 'faf9f7',
	] );
	add_theme_support( 'post-formats', [ 'aside', 'gallery', 'image', 'quote', 'video' ] );

	// Editor color palette
	add_theme_support( 'editor-color-palette', [
		[ 'name' => __( 'Cream',      'bloom' ), 'slug' => 'cream',      'color' => '#FAF9F7' ],
		[ 'name' => __( 'Blush',      'bloom' ), 'slug' => 'blush',      'color' => '#F2C4CE' ],
		[ 'name' => __( 'Rose',       'bloom' ), 'slug' => 'rose',       'color' => '#E8A0B4' ],
		[ 'name' => __( 'Sage',       'bloom' ), 'slug' => 'sage',       'color' => '#B5C9B7' ],
		[ 'name' => __( 'Sky',        'bloom' ), 'slug' => 'sky',        'color' => '#C5D9E8' ],
		[ 'name' => __( 'Warm Tan',   'bloom' ), 'slug' => 'tan',        'color' => '#C9A882' ],
		[ 'name' => __( 'Charcoal',   'bloom' ), 'slug' => 'charcoal',   'color' => '#3D3535' ],
		[ 'name' => __( 'Mid Gray',   'bloom' ), 'slug' => 'mid-gray',   'color' => '#7A7070' ],
		[ 'name' => __( 'Light Gray', 'bloom' ), 'slug' => 'light-gray', 'color' => '#F0EDEA' ],
		[ 'name' => __( 'White',      'bloom' ), 'slug' => 'white',      'color' => '#FFFFFF' ],
	] );

	add_theme_support( 'editor-font-sizes', [
		[ 'name' => __( 'Small',    'bloom' ), 'slug' => 'small',    'size' => 14 ],
		[ 'name' => __( 'Normal',   'bloom' ), 'slug' => 'normal',   'size' => 16 ],
		[ 'name' => __( 'Medium',   'bloom' ), 'slug' => 'medium',   'size' => 20 ],
		[ 'name' => __( 'Large',    'bloom' ), 'slug' => 'large',    'size' => 28 ],
		[ 'name' => __( 'X-Large',  'bloom' ), 'slug' => 'x-large',  'size' => 36 ],
		[ 'name' => __( 'Huge',     'bloom' ), 'slug' => 'huge',     'size' => 48 ],
	] );

	// Image sizes
	add_image_size( 'bloom-hero',     1400, 700,  true );
	add_image_size( 'bloom-featured', 800,  600,  true );
	add_image_size( 'bloom-card',     600,  450,  true );
	add_image_size( 'bloom-square',   400,  400,  true );
	add_image_size( 'bloom-wide',     1200, 500,  true );
	add_image_size( 'bloom-portrait', 500,  700,  true );

	// Menus
	register_nav_menus( [
		'primary'   => __( 'Primary Navigation', 'bloom' ),
		'secondary' => __( 'Secondary Navigation', 'bloom' ),
		'footer'    => __( 'Footer Navigation', 'bloom' ),
		'social'    => __( 'Social Links Menu', 'bloom' ),
	] );
}
add_action( 'after_setup_theme', 'bloom_setup' );

// ── Content Width ────────────────────────────────────────────────────────────

function bloom_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bloom_content_width', 1100 );
}
add_action( 'after_setup_theme', 'bloom_content_width', 0 );

// ── Enqueue Scripts & Styles ─────────────────────────────────────────────────

function bloom_scripts() {
	// Google Fonts
	wp_enqueue_style(
		'bloom-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&display=swap',
		[],
		null
	);

	wp_enqueue_style( 'bloom-style', BLOOM_URI . '/assets/css/main.css', [ 'bloom-fonts' ], BLOOM_VERSION );

	if ( is_woocommerce_active() ) {
		wp_enqueue_style( 'bloom-woocommerce', BLOOM_URI . '/assets/css/woocommerce.css', [ 'bloom-style' ], BLOOM_VERSION );
	}

	wp_enqueue_script( 'bloom-main', BLOOM_URI . '/assets/js/main.js', [ 'jquery' ], BLOOM_VERSION, true );

	wp_localize_script( 'bloom-main', 'bloomData', [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'bloom_nonce' ),
		'i18n'    => [
			'searchPlaceholder' => __( 'Search posts…', 'bloom' ),
			'menuOpen'          => __( 'Open menu', 'bloom' ),
			'menuClose'         => __( 'Close menu', 'bloom' ),
		],
	] );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bloom_scripts' );

function bloom_editor_styles() {
	add_editor_style( 'assets/css/editor-style.css' );
}
add_action( 'after_setup_theme', 'bloom_editor_styles' );

// ── Widgets ───────────────────────────────────────────────────────────────────

function bloom_widgets_init() {
	$sidebar_defaults = [
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	];

	register_sidebar( array_merge( $sidebar_defaults, [
		'name' => __( 'Blog Sidebar', 'bloom' ),
		'id'   => 'sidebar-1',
		'description' => __( 'Add widgets here to appear in the blog sidebar.', 'bloom' ),
	] ) );

	register_sidebar( array_merge( $sidebar_defaults, [
		'name' => __( 'Footer Column 1', 'bloom' ),
		'id'   => 'footer-1',
	] ) );
	register_sidebar( array_merge( $sidebar_defaults, [
		'name' => __( 'Footer Column 2', 'bloom' ),
		'id'   => 'footer-2',
	] ) );
	register_sidebar( array_merge( $sidebar_defaults, [
		'name' => __( 'Footer Column 3', 'bloom' ),
		'id'   => 'footer-3',
	] ) );
	register_sidebar( array_merge( $sidebar_defaults, [
		'name' => __( 'Footer Column 4', 'bloom' ),
		'id'   => 'footer-4',
	] ) );

	register_sidebar( array_merge( $sidebar_defaults, [
		'name' => __( 'Shop Sidebar', 'bloom' ),
		'id'   => 'shop-sidebar',
	] ) );
}
add_action( 'widgets_init', 'bloom_widgets_init' );

// ── Required Files ────────────────────────────────────────────────────────────

require BLOOM_DIR . '/inc/template-functions.php';
require BLOOM_DIR . '/inc/template-tags.php';
require BLOOM_DIR . '/inc/customizer.php';
require BLOOM_DIR . '/inc/block-patterns.php';
require BLOOM_DIR . '/inc/widgets.php';

if ( bloom_is_woocommerce_active() ) {
	require BLOOM_DIR . '/inc/woocommerce.php';
}

if ( is_admin() ) {
	require BLOOM_DIR . '/inc/demo-import.php';
}

// ── Helper Functions ──────────────────────────────────────────────────────────

function bloom_is_woocommerce_active() {
	return class_exists( 'WooCommerce' );
}

function bloom_get_option( $key, $default = '' ) {
	return get_theme_mod( $key, $default );
}

function bloom_reading_time( $post_id = null ) {
	$content    = get_post_field( 'post_content', $post_id ?? get_the_ID() );
	$word_count = str_word_count( strip_tags( $content ) );
	$minutes    = (int) ceil( $word_count / 200 );
	return $minutes < 1 ? 1 : $minutes;
}

// ── Custom Post Types ─────────────────────────────────────────────────────────

function bloom_register_post_types() {
	register_post_type( 'bloom_portfolio', [
		'labels'        => [
			'name'          => __( 'Portfolio',     'bloom' ),
			'singular_name' => __( 'Portfolio Item', 'bloom' ),
			'add_new_item'  => __( 'Add New Portfolio Item', 'bloom' ),
		],
		'public'        => true,
		'has_archive'   => true,
		'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
		'rewrite'       => [ 'slug' => 'portfolio' ],
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-format-gallery',
	] );
}
add_action( 'init', 'bloom_register_post_types' );

// ── Custom Taxonomies ─────────────────────────────────────────────────────────

function bloom_register_taxonomies() {
	register_taxonomy( 'portfolio_category', 'bloom_portfolio', [
		'labels'        => [
			'name'          => __( 'Portfolio Categories', 'bloom' ),
			'singular_name' => __( 'Portfolio Category', 'bloom' ),
		],
		'public'        => true,
		'hierarchical'  => true,
		'show_in_rest'  => true,
		'rewrite'       => [ 'slug' => 'portfolio-category' ],
	] );
}
add_action( 'init', 'bloom_register_taxonomies' );

// ── Body Classes ──────────────────────────────────────────────────────────────

function bloom_body_classes( $classes ) {
	$header_style = bloom_get_option( 'bloom_header_style', 'default' );
	$classes[]    = 'bloom-header-' . sanitize_html_class( $header_style );

	if ( bloom_get_option( 'bloom_sticky_header', true ) ) {
		$classes[] = 'has-sticky-header';
	}

	if ( is_singular( 'post' ) ) {
		$layout = get_post_meta( get_the_ID(), '_bloom_post_layout', true ) ?: bloom_get_option( 'bloom_post_layout', 'sidebar' );
		$classes[] = 'post-layout-' . sanitize_html_class( $layout );
	}

	return $classes;
}
add_filter( 'body_class', 'bloom_body_classes' );

// ── Excerpt ───────────────────────────────────────────────────────────────────

function bloom_excerpt_length( $length ) {
	return is_admin() ? $length : 25;
}
add_filter( 'excerpt_length', 'bloom_excerpt_length' );

function bloom_excerpt_more( $more ) {
	return is_admin() ? $more : '&hellip;';
}
add_filter( 'excerpt_more', 'bloom_excerpt_more' );

// ── Deferred Image Loading ────────────────────────────────────────────────────

function bloom_lazy_load_images( $attr, $attachment, $size ) {
	if ( is_admin() ) {
		return $attr;
	}
	$attr['loading'] = 'lazy';
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'bloom_lazy_load_images', 10, 3 );

// ── Block Patterns Category ───────────────────────────────────────────────────

function bloom_register_block_pattern_categories() {
	register_block_pattern_category( 'bloom', [ 'label' => __( 'Bloom', 'bloom' ) ] );
}
add_action( 'init', 'bloom_register_block_pattern_categories' );
