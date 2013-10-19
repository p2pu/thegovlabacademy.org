<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Esquire
 */

get_header(); ?>

	<?php
		/* Queue the first post, that way we know
		 * what date we're dealing with (if that is the case).
		 *
		 * We reset this later so we can run the loop
		 * properly with a call to rewind_posts().
		 */
		if ( have_posts() )
			the_post();
	?>

	<?php if ( is_archive() ) : ?>
	<div id="header">
		<h2>
		<?php if ( is_day() ) : ?>
			<?php printf( __( 'Posted on %s &hellip;', 'esquire' ), '<span>' . get_the_date() . '</span>' ); ?>
		<?php elseif ( is_month() ) : ?>
			<?php printf( __( 'Posted in %s &hellip;', 'esquire' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
		<?php elseif ( is_year() ) : ?>
			<?php printf( __( 'Posted in %s &hellip;', 'esquire' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
		<?php elseif( is_author() ) : ?>
			<?php printf( __( 'Posted by %s &hellip;', 'esquire' ), '<span>' . get_the_author() . '</span>' ); ?>
		<?php elseif ( is_category() ) : ?>
			<?php printf( __( 'Filed under %s &hellip;', 'esquire' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
		<?php elseif ( is_tag() ) : ?>
			<?php printf( __( 'Tagged with %s &hellip;', 'esquire' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
		<?php endif; ?>
		</h2>
	</div>
	<?php endif; ?>
	<?php if ( is_search() ) : ?>
	<div id="header">
		<h2>
			<?php printf( __( 'Matches for: &ldquo;%s&rdquo; &hellip;', 'esquire' ), '<span>' . get_search_query() . '</span>' ); ?>
		</h2>
	</div>
	<?php endif; ?>

	<?php
		/* Since we called the_post() above, we need to
		 * rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */
		rewind_posts();
	?>

	<div id="posts">
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

		<?php else : ?>

		<div class="hentry error404">
			<div class="postbody text">
				<h1><?php _e( 'Nothing Found', 'esquire' ); ?></h1>
				<div class="content">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'esquire' ); ?></p>
				</div><!-- .content -->
			</div><!-- .postbody -->
		</div>

		<?php endif; ?>
	</div><!-- #posts -->

<?php get_footer(); ?>