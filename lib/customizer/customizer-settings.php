<?php

/**
 * MixUp.
 *
 * This file adds the Customizer Default Settings to the MixUp Theme.
 *
 * @package MixUp
 * @author  ThemeMix
 * @license GPL-2.0+
 * @link    https://thememix.com/
 */

add_action( 'customize_register', 'mixup_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function mixup_customizer_register() {
	global $wp_customize;
	$wp_customize->add_setting(
		'mixup_link_color',
		array(
			'default'           => mixup_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'mixup_link_color',
			array(
				'description' => __( 'Change the default color for linked titles, menu links, post info links and more.', 'mixup' ),
			    'label'       => __( 'Link Color', 'mixup' ),
			    'section'     => 'colors',
			    'settings'    => 'mixup_link_color',
			)
		)
	);
	$wp_customize->add_setting(
		'mixup_accent_color',
		array(
			'default'           => mixup_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'mixup_accent_color',
			array(
				'description' => __( 'Change the default color for button hovers.', 'mixup' ),
			    'label'       => __( 'Accent Color', 'mixup' ),
			    'section'     => 'colors',
			    'settings'    => 'mixup_accent_color',
			)
		)
	);
}

//* Including Customizer Frontpage Sections
include 'sections/customizer-frontpage-sections.php';

//* Including Customizer Footer Sections
include 'sections/customizer-footer-sections.php';