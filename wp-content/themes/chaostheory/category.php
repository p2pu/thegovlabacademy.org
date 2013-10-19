<?php
/**
 * @package WordPress
 * @subpackage ChaosTheory
 */
?>
<?php get_header(); ?>

	<div id="container">
		<div id="content" class="hfeed">
			<h2 class="page-title"><?php _e( 'Category Archives:', 'chaostheory' ); ?> <?php single_cat_title(); ?></h2>
			<?php if ( category_description() ) { ?><div class="archive-meta"><?php echo apply_filters( 'archive_meta', category_description() ); ?></div><?php } ?>

			<div id="nav-above" class="navigation">
				<div class="nav-previous"><?php next_posts_link( __( '&laquo; Older posts', 'chaostheory' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts &raquo;', 'chaostheory' ) ); ?></div>
			</div>

			<?php while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-meta">
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permanent link to %s', 'chaostheory' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<ul>
						<li class="entry-date"><a href="<?php the_permalink(); ?>"><?php printf( __( '%1$s &#8211; %2$s', 'chaostheory' ), the_date( '', '', '', false ), get_the_time() ); ?></a></li>
						<li class="entry-category"><?php printf( __( 'Posted in %s', 'chaostheory' ), get_the_category_list( ', ' ) ); ?></li>
						<?php the_tags( '<li class="entry-tags">' . __( 'Tagged', 'chaostheory' ) . ' ', ", ", "</li>"); ?>
						<?php edit_post_link( __( 'Edit', 'chaostheory' ), '<li class="entry-editlink">', '</li>'); ?>
						<li class="entry-commentlink"><?php comments_popup_link( __( 'Leave a Comment', 'chaostheory' ), __( 'Comments (1)', 'chaostheory' ), __( 'Comments (%)', 'chaostheory' ) ); ?></li>
					</ul>
				</div>
				<div class="entry-content">
					<?php the_content( '<span class="more-link">' . __( 'Read More &raquo;', 'chaostheory' ) . '</span>' ); ?>
				</div>
			</div><!-- .post -->

			<?php endwhile; ?>

			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link( __( '&laquo; Older posts', 'chaostheory' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts &raquo;', 'chaostheory' ) ); ?></div>
			</div>

		</div><!-- #content .hfeed -->
	</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>