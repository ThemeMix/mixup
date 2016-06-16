<?php
/**
 * MixUp.
 *
 * This file adds the landing page template to the MixUp Theme.
 *
 * @package MixUp
 * @author  ThemeMix
 * @license GPL-2.0+
 * @link    https://thememix.com/
 */

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

if ( ! is_home() ) {
	//* No need to output the title for the frontpage
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
}

add_filter( 'genesis_site_title_wrap', 'mixup_h1_for_site_title' );
/**
 * Use h1 for site title
 */
function mixup_h1_for_site_title( $wrap ) {
	return 'h1';
}

genesis();