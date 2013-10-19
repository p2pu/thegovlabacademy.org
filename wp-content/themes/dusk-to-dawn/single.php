<?php
/**
 * @package Dusk To Dawn
 */
get_header(); ?>

<div id="primary">
	<div id="content" class="clear-fix" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>

		<?php dusktodawn_content_nav( 'nav-below' ); ?>

		<?php comments_template( '', true ); ?>

	<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>