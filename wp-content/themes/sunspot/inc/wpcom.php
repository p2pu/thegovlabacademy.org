<?php
/**
 * WordPress.com-specific functions and definitions
 *
 * @package Sunspot
 * @since Sunspot 1.0
 */

global $themecolors;

/**
 * Set a default theme color array for WP.com.
 *
 * @global array $themecolors
 * @since Sunspot 1.0
 */
$themecolors = array(
	'bg' => '292625',
	'border' => '393636',
	'text' => 'B29D85',
	'link' => 'FCB03E',
	'url' => 'FCB03E',
);

// Dequeue font styles
function sunspot_dequeue_fonts() {
	/**
	 * We don't want to enqueue the font scripts if the blog
	 * has WP.com Custom Design.
	 *
	*/
	if ( class_exists( 'TypekitData' ) ) {
		if ( TypekitData::get( 'upgraded' ) ) {
			$customfonts = TypekitData::get( 'families' );
			if ( ! $customfonts )
				return;
			$bodytext = $customfonts['body-text'];

			if ( $bodytext['id'] ) {
				wp_dequeue_style( 'ubuntu' );
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'sunspot_dequeue_fonts' );