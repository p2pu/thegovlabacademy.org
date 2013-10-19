<?php
/**
 * @package WordPress
 * @subpackage Next Saturday
 */
get_header(); ?>

	<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( '<p><span>Search Results for: "%s".</span></p>', 'next-saturday' ), get_search_query() ); ?></h1>
			</header>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">

				<div class="entry-container">
					<header class="entry-header">
						<h1 class="post-title"><?php _e( 'Nothing Found', 'next-saturday' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">

						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'next-saturday' ); ?></p>

						<?php get_search_form(); ?>

					</div><!-- .entry-content -->

				</div><!-- .entry-container -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		<?php next_saturday_content_nav( 'nav-below' ); ?>

	</div><!-- #content -->

<?php get_footer(); ?>