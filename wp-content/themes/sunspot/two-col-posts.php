<?php
/**
 * The two-column post template file
 *
 * @package WordPress
 * @subpackage Sunspot
 */

get_header(); ?>

		<div id="primary" class="site-content two-col-posts">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<div class="post-row clearfix">
				<?php $count = 0; // Set up a variable to count the number of posts so that we can break them up into rows
					$column_type = 'odd'; // Set up a variable to add a CSS class to the post columns ?>

				<?php while ( have_posts() ) : the_post(); $count++;

					if ( $count % 2 == 0 ) :
						$column_type = 'even-col';
					else:
						$column_type = 'odd-col';
					endif;
				?>
					<div class="post-column <?php echo $column_type; ?>">
						<?php
							// Include the Post-Format-specific template for the content.
							get_template_part( 'content-two-col', get_post_format() );
						?>
					</div><!-- .post-column -->

					<?php if( $count % 2 == 0 ) : // After every other post, end the row and start a new one. ?>
						</div><!-- .post-row -->
						<div class="post-row clearfix">
					<?php endif; ?>

				<?php endwhile; // end of the loop ?>
				</div><!-- .post-row -->

				<?php sunspot_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'sunspot' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'sunspot' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>