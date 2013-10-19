<?php
/**
 * @package WordPress
 * @subpackage Duster
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<nav id="nav-single">
						<h1 class="section-heading"><?php _e( 'Post navigation', 'toolbox' ); ?></h1>
						<span class="nav-previous"><?php previous_post_link( '%link', __( '&larr; Previous', 'duster' ) ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', __( 'Next &rarr;', 'duster' ) ); ?></span>
					</nav><!-- #nav-single -->

					<?php get_template_part( 'content', 'single' ); ?>

					<?php duster_content_nav( 'nav-below' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>