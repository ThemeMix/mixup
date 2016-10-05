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

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'MixUp' );
define( 'CHILD_THEME_URL', 'https://thememix.com/mixup/' );
define( 'CHILD_THEME_VERSION', '0.7.5' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Include Template Changing functionality
include 'lib/template-changes.php';

//* Include Customizer functionality
include 'lib/customizer/customizer.php';

//* Set Localization (do not remove)
load_child_theme_textdomain( 'mixup', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'mixup' ) );

add_action( 'wp_enqueue_scripts', 'mixup_enqueue_scripts_styles' );
/**
 * Enqueue Scripts and Styles
 * @return [type] [description]
 */
function mixup_enqueue_scripts_styles() {

	wp_enqueue_style( 'mixup-googlefonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Source+Sans+Pro:300,300i,400,400i,700,700i&subset=latin-ext', array(), CHILD_THEME_VERSION );

	// Load Font Awesome, always the latest version
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script( 'mixup-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	$output = array(
		'mainMenu' => __( 'Menu', 'mixup' ),
		'subMenu'  => __( 'Menu', 'mixup' ),
	);
	wp_localize_script( 'mixup-responsive-menu', 'MixUpL10n', $output );

	//* Add compiled JS
	//wp_enqueue_script( 'mixup-scripts', get_stylesheet_directory_uri() . '/js/script.js', array(), CHILD_THEME_VERSION, true );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array(
	'caption',
	'comment-form',
	'comment-list',
	'gallery',
	'search-form'
	)
);

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array(
	'404-page',
	'drop-down-menu',
	'headings',
	'rems',
	'search-form',
	'skip-links'
	)
);

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
	)
);

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add Image Sizes
add_image_size( 'featured-image', 680, 400, TRUE );

//* Adding Excerpts to pages
add_post_type_support( 'page', 'excerpt' );

//* Adding Editor Styles
add_editor_style();

add_action( 'wp_head', 'mixup_include_svg_icons', 999 );
/**
 * Add SVG definitions to <head>.
 * @return $svg_icons variable containing the svg icon set
 */
function mixup_include_svg_icons() {

	// Define SVG sprite file.
	$svg_icons = get_template_directory() . 'images/svg-icons.svg';

	// If it exsists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}
}

//* Register widget areas.
genesis_register_sidebar( array(
	'id'			=> 'frontpage-1',
	'name'			=> __( 'Frontpage 1', 'mixup' ),
	'description'	=> __( 'Frontpage 1 Section on the frontpage.', 'mixup' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'frontpage-2',
	'name'			=> __( 'Frontpage 2', 'mixup' ),
	'description'	=> __( 'Frontpage 2 Section on the frontpage.', 'mixup' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'frontpage-3',
	'name'			=> __( 'Frontpage 3', 'mixup' ),
	'description'	=> __( 'Frontpage 3 Section on the frontpage.', 'mixup' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'frontpage-3',
	'name'			=> __( 'Frontpage 3', 'mixup' ),
	'description'	=> __( 'Frontpage 3 Section on the frontpage.', 'mixup' ),
) );