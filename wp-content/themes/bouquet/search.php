<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Bouquet
 */

get_header(); ?>

		<div id="content-wrapper">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="archive-header">
					<h1 class="archive-title"><?php printf( __( 'Search Results for: %s', 'bouquet' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php bouquet_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php bouquet_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'bouquet' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bouquet' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #content-wrapper -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>