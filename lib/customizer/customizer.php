<?php

/**
 * MixUp.
 *
 * This file includes the Customizer to the MixUp Theme.
 *
 * @package MixUp
 * @author  ThemeMix
 * @license GPL-2.0+
 * @link    https://thememix.com/
 */

/**
 * Sanitizing input to settings
 * @param  [type] $input   [description]
 * @param  [type] $setting [description]
 * @return [type]          [description]
 */
function mixup_sanitize( $input, $setting ) {

	global $wp_customize;

	$control = $wp_customize->get_control( $setting->id );

	if ( array_key_exists( $input, $control->choices ) ) {
		return $input;
	} else {
		return $setting->default;
	}
}

//* Including Customizer Defaults
include 'customizer-defaults.php';

//* Including Customizer Settings
include 'customizer-settings.php';

//* Including Customizer Output
include 'customizer-output.php';
