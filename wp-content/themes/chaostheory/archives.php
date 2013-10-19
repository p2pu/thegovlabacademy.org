<?php
/**
 * Template Name: Archives Page
 *
 * @package WordPress
 * @subpackage ChaosTheory
 */
?>
<?php get_header(); ?>

	<div id="container">
		<div id="content" class="hfeed">

			<?php while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title"><?php the_title(); ?></h2>
					<div class="entry-content">
						<?php the_content(); ?>

						<div id="archives-by-category" class="content-column">
						<h3><?php _e( 'Archives by Category', 'chaostheory' ); ?></h3>
							<ul>
								<?php wp_list_categories( 'sort_column=name&optioncount=1&feed=RSS' ); ?>
							</ul>
						</div>
						<div id="archives-by-month" class="content-column">
						<h3><?php _e( 'Archives by Month', 'chaostheory' ); ?></h3>
							<ul>
								<?php wp_get_archives( 'type=monthly&show_post_count=1' ); ?>
							</ul>
						</div>
						<?php edit_post_link( __( 'Edit this entry.', 'chaostheory' ), '<p class="edit-link">', '</p>' ); ?>

					</div>
				</div><!-- .post -->

				<?php if ( comments_open() ) comments_template(); ?>

			<?php endwhile; // end of the loop. ?>
		</div><!-- #content .hfeed -->
	</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>