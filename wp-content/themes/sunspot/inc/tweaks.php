<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Sunspot
 * @since Sunspot 1.0 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Sunspot 1.0 */
function sunspot_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'sunspot_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Sunspot 1.0 */
function sunspot_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	// Adds a class of sidebar-content to blogs that have no widgets in the right sidebar
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'sidebar-content';
	}

	return $classes;
}
add_filter( 'body_class', 'sunspot_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Sunspot 1.0 */
function sunspot_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'sunspot_enhanced_image_navigation', 10, 2 );

/**
 * Sets the post excerpt length to 55 words.
 *
 */
function sunspot_excerpt_length( $length ) {
	return 55;
}
add_filter( 'excerpt_length', 'sunspot_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 */
function sunspot_continue_reading_link() {
	return ' <a href="'. get_permalink() . '" class="more-link">' . __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'sunspot' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and sunspot_continue_reading_link().
 *
 */
function sunspot_auto_excerpt_more( $more ) {
	return ' &hellip;' . sunspot_continue_reading_link();
}
add_filter( 'excerpt_more', 'sunspot_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 */
function sunspot_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= sunspot_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'sunspot_custom_excerpt_more' );
