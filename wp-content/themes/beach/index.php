<?php
/**
 * @package WordPress
 * @subpackage Beach
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php beach_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

			<?php beach_content_nav( 'nav-below' ); ?>

			</div><!-- #content -->

			<?php get_sidebar(); ?>
		</div><!-- #primary -->

<?php get_footer(); ?>