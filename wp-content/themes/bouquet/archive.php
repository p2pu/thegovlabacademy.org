<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * @package WordPress
 * @subpackage Bouquet
 */

get_header(); ?>

		<div id="content-wrapper">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="archive-header">
					<h1 class="archive-title">
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Archive | %s', 'bouquet' ), get_the_date() ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Archive | %s', 'bouquet' ), get_the_date( 'F Y' ) ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Archive | %s', 'bouquet' ), get_the_date( 'Y' ) ); ?>
						<?php elseif ( is_author() ) : ?>
							<?php printf( __( 'Archive by Author | %s', 'bouquet' ), get_the_author() ); ?>
						<?php elseif ( is_tag() ) : ?>
							<?php printf( __( 'Tag Archive | %s', 'bouquet' ), single_tag_title( '', false ) ); ?>
						<?php else :
							_e( 'Archives', 'bouquet' ); ?>
						<?php endif; ?>
					</h1>
				</header>

				<?php rewind_posts(); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php bouquet_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'bouquet' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bouquet' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #content-wrapper -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>