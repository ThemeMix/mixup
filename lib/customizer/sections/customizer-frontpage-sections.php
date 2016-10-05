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

add_action( 'customize_register', 'mixup_customizer_frontpage_settings' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function mixup_customizer_frontpage_settings() {

	global $wp_customize;

	// Add Section
	$wp_customize->add_section(
		'mixup_frontpage_options',
		array (
			'title'         => __( 'Frontpage Setup', 'mixup' ),
			'priority'      => 110,
			'description'	=> __( 'Choose between 4 different top section versions. Not sure which one to pick? Check out <a target="_BLANK" href="https://my.thememix.com/docs/mixup/frontpage-setup/">our documention</a> for more information.<hr>' ),
		)
	);

	// Frontpage Top Section Version Control
	$wp_customize->add_setting(
		'mixup_frontpage_setup',
		array(
			'default'   => 'version_1',
			'transport' => 'refresh',
			'sanitize_callback' => 'mixup_sanitize'
		)
	);

	$wp_customize->add_control(
		'mixup_frontpage_setup',
		array(
			'section'   => 'mixup_frontpage_options',
			'label'     => __( 'Select Frontpage Version', 'mixup' ),
			'setting'   => 'mixup_frontpage_setup',
			'type'      => 'radio',
			'choices'   => $layout = array(
							'version_1' => __( 'Version 1', 'mixup' ),
							'version_2' => __( 'Version 2', 'mixup' ),
							'version_3' => __( 'Version 3', 'mixup' ),
							'version_4' => __( 'Version 4', 'mixup' ),
						)
		)
	);
}