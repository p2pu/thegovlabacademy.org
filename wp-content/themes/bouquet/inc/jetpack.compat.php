<?php
/**
 * Compatibility settings and functions for Jetpack from Automattic
 * See jetpack.me
 *
 * @package Bouquet
 */

/**
 * Add support for Infinite Scroll.
 */
function bouquet_infinite_scroll_init() {
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'content',
		'footer'         => 'primary',
	) );
}
add_action( 'after_setup_theme', 'bouquet_infinite_scroll_init' );