<?php
/**
 * @package WordPress
 * @subpackage Next Saturday
 */

get_header(); ?>

	<div id="content" role="main">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

			<?php comments_template( '', true ); ?>

			<nav id="nav-single">
				<h3 class="assistive-text"><?php _e( 'Post navigation', 'next-saturday' ); ?></h3>
				<span class="nav-previous"><?php previous_post_link( '%link', __( 'Previous <span>Post</span>', 'next-saturday' ) ); ?></span>
				<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span>Post</span>', 'next-saturday' ) ); ?></span>
			</nav><!-- #nav-single -->

		<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->

<?php get_footer(); ?>