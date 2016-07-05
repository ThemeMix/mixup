<?php
/**
 * MixUp.
 *
 * This file adds the default theme settings to the Mixup Theme.
 *
 * @package Mixup
 * @author  ThemeMix
 * @license GPL-2.0+
 * @link    https://thememix.com/
 */

//* Remove the header right widget area
//unregister_sidebar( 'header-right' );
//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );
//* Unregister sidebar/sidebar/content layout setting
genesis_unregister_layout( 'sidebar-sidebar-content' );
//* Unregister sidebar/content/sidebar layout setting
genesis_unregister_layout( 'sidebar-content-sidebar' );
//* Unregister content/sidebar/sidebar layout setting
genesis_unregister_layout( 'content-sidebar-sidebar' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array(
	'primary' 	=> __( 'After Header Menu', 'mixup' ),
	'secondary' => __( 'Footer Menu', 'mixup' )
	)
);

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );


add_filter( 'wp_nav_menu_args', 'mixup_secondary_menu_args' );
/**
 * Reduce the secondary navigation menu to one level depth
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
function mixup_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

add_action( 'init', 'mixup_register_additional_menu' );
/**
 * Register Social Navigation Menu
 * @return void
 */
function mixup_register_additional_menu() {

	register_nav_menu( 'social-nav', __( 'Social Menu', 'mixup' ) );

}

add_action( 'genesis_before_header', 'mixup_output_social_nav' );
/**
 * Outputting Social Nav
 */
function mixup_output_social_nav() {

	echo '<div class="social-nav">';

	wp_nav_menu( array(
		'theme_location'  => 'social-nav',
		'fallback_cb'	  => false,
		'container_class' => 'genesis-nav-menu wrap' )

	);

	echo '</div>';

}

/**
 * Count the number of widgets in a widget area.
 *
 * Helps to calculate the number of columns each widget requires based on
 * number of widgets.
 *
 * @since 1.0.0
 *
 * @param string $id Widget area ID.
 *
 * @return integer Number of widgets in given widget area.
 */
function mixup_count_widgets( $id ) {
	global $sidebars_widgets;

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}
}

/**
 * MixUp Widget Area Class
 * @param  string $id Widget area ID
 * @return variable $class
 * @since 1.0.0
 *
 */
function mixup_widget_area_class( $id ) {
	$count = mixup_count_widgets( $id );

	$class = '';

	if( $count == 1 ) {
		$class .= ' widget-full';
	} elseif( $count % 3 == 0 ) {
		$class .= ' widget-thirds';
	} elseif( $count % 4 == 0 ) {
		$class .= ' widget-fourths';
	} elseif( $count % 2 == 1 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;

}

add_filter( 'genesis_footer_creds_text', 'mixup_footer_creds_text' );
/**
 * Custom credits text.
 *
 * @since 1.0.0
 */
function mixup_footer_creds_text( $default ) {
	echo '<div class="footer-left">';

	$footer_left = get_theme_mod( 'footer_left_text', $default );

	if ( $footer_left == $default ) {
		echo do_shortcode( '[footer_copyright before="Copyright "] ' );
	} else {
		echo do_shortcode( get_theme_mod( 'footer_left_text' ) );
	}
	echo '</div>';

	echo '<div class="footer-right">';

	$footer_right = get_theme_mod( 'footer_right_text', $default );

	if ( $footer_right == $default ) {
		echo do_shortcode( '[footer_childtheme_link before=""] by <a href="https://thememix.com/">ThemeMix</a>' );
	} else {
		echo do_shortcode( get_theme_mod( 'footer_right_text' ) );
	}

	echo '</div>';
}
