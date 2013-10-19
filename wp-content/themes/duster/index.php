<?php
/**
 * @package WordPress
 * @subpackage Duster
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php duster_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php duster_content_nav( 'nav-below' ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>