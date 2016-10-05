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

add_action( 'customize_register', 'mixup_customizer_footer_settings' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function mixup_customizer_footer_settings() {

	global $wp_customize;

	// Footer Section
	$wp_customize->add_section(
		'mixup_footer',
		array(
			'title'    => __( 'Footer Section', 'mixup' ),
			'priority' => 160,
		)
	);

	// Left Footer Section
	$wp_customize->add_setting(
		'footer_left_text',
		array(
			'default' => '[footer_copyright before="Copyright "] ',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'footer_left_text',
		array(
			'label'    => __( 'Footer Left Text', 'mixup' ),
			'section'  => 'mixup_footer',
			'settings' => 'footer_left_text',
			'type'     => 'textarea',
		)
	);

	// Right Footer Section
	$wp_customize->add_setting(
		'footer_right_text',
		array(
			'default' => '[footer_childtheme_link before=""] by <a href="https://thememix.com/">ThemeMix</a>',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'footer_right_text',
		array(
			'label'    => __( 'Footer Right Text', 'mixup' ),
			'section'  => 'mixup_footer',
			'settings' => 'footer_right_text',
			'description' => __( 'Feel free to use HTML and shortcodes here.', 'mixup' ),
			'type'     => 'textarea',
		)
	);
}