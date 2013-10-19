<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.WordPress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Next Saturday
 */
get_header(); ?>

	<div id="content" role="main">
		<?php
		/* Run the loop to output the posts.
		 * If you want to overload this in a child theme then include a file
		 * called loop-index.php and that will be used instead.
		 */
		while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php next_saturday_content_nav( 'nav-below' ); ?>

	</div><!-- #content -->

<?php get_footer(); ?>