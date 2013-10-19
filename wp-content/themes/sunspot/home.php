<?php
/**
 * The template for displaying the home page.
 *
 * @package WordPress
 * @subpackage Sunspot
 */
?>

<?php // Load either the single- or two-column post layout, depending on user's setting in the theme options

$options = sunspot_get_theme_options();
$post_columns = $options['sunspot_radio_buttons'];

if ( $post_columns == 'double' ) :
	get_template_part( 'two-col-posts' );
else:
	get_template_part ( 'index' );
endif;