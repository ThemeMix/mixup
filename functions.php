<?php
/**
 * MixUp.
 *
 * This file adds functions to the Genesis MixUp Child Theme.
 *
 * @package MixUp
 * @author  ThemeMix
 * @license GPL-2.0+
 * @link    https://thememix.com/
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'mixup', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'mixup' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'MixUp' );
define( 'CHILD_THEME_URL', 'https://thememix.com/mixup/' );
define( 'CHILD_THEME_VERSION', '0.7.3' );

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'mixup_enqueue_scripts_styles' );
function mixup_enqueue_scripts_styles() {

	wp_enqueue_style( 'mixup-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,900', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	//* Remove default stylesheet
	wp_deregister_style( 'mixup-theme' );

	//* Add compiled stylesheet
	wp_register_style( 'mixup-theme', get_stylesheet_directory_uri() . '/style.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'mixup-theme' );

	wp_enqueue_script( 'mixup-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	$output = array(
		'mainMenu' => __( 'Menu', 'mixup' ),
		'subMenu'  => __( 'Menu', 'mixup' ),
	);
	wp_localize_script( 'mixup-responsive-menu', 'MixUpL10n', $output );

	//* Add compiled JS
	wp_enqueue_script( 'mixup-scripts', get_stylesheet_directory_uri() . '/js/script.js', array(), CHILD_THEME_VERSION, true );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add Image Sizes
add_image_size( 'featured-image', 680, 400, TRUE );

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'After Header Menu', 'mixup' ), 'secondary' => __( 'Footer Menu', 'mixup' ) ) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'mixup_secondary_menu_args' );
function mixup_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

//* Add SVG definitions to <head>.
add_action( 'wp_head', 'mixup_include_svg_icons', 999 );
function mixup_include_svg_icons() {

	// Define SVG sprite file.
	$svg_icons = get_template_directory() . 'images/svg-icons.svg';

	// If it exsists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}
}