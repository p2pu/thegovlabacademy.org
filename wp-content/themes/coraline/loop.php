<?php
/**
 * @package WordPress
 * @subpackage Coraline
 * @since Coraline 1.0
 */
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'coraline' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'coraline' ) ); ?></div>
	</div><!-- #nav-above -->
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'coraline' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'coraline' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	// Start the Loop.
	$options = coraline_get_theme_options(); while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts in the Gallery category. */ ?>

	<?php if ( ( isset( $options['gallery_category'] ) && '0' != $options['gallery_category'] && in_category( $options['gallery_category'] ) ) || 'gallery' == get_post_format( $post->ID ) ) : ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'coraline' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php coraline_posted_on(); coraline_posted_by(); ?>
			</div><!-- .entry-meta -->

			<div class="entry-content">
			<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'coraline' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'coraline' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								$total_images
							); ?></em></p>
				<?php endif; ?>
					<?php the_excerpt(); ?>
			<?php endif; ?>
			</div><!-- .entry-content -->

			<div class="entry-info">
				<span class="comments-link"><?php comments_popup_link( __( '&rarr; Leave a comment', 'coraline' ), __( '&rarr; 1 Comment', 'coraline' ), __( '&rarr; % Comments', 'coraline' ) ); ?></span>

			<?php
				if ( isset( $options['gallery_category'] ) ) :
					$cat_slug = sanitize_title( $options['gallery_category'] );
					if ( in_category( $cat_slug ) ) :
			?>
				<p><a href="<?php echo get_term_link( $cat_slug, 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'coraline' ); ?>"><?php _e( 'More Galleries', 'coraline' ); ?></a></p>
			<?php endif; endif; ?>

				<p><?php edit_post_link( __( 'Edit', 'coraline' ), '', '' ); ?></p>
			</div><!-- .entry-info -->
		</div><!-- #post-## -->

<?php /* How to display posts in the asides category */ ?>

	<?php elseif ( isset( $options['aside_category'] ) && '0' != $options['aside_category'] && in_category( $options['aside_category'] ) || 'aside' == get_post_format( $post->ID ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<div class="entry-summary aside">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content aside">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'coraline' ) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<div class="entry-info">
				<p class="comments-link"><?php comments_popup_link( __( '&rarr; Leave a comment', 'coraline' ), __( '&rarr; 1 Comment', 'coraline' ), __( '&rarr; % Comments', 'coraline' ) ); ?></p>
				<p><?php coraline_posted_on(); coraline_posted_by(); ?></p>
				<?php edit_post_link( __( 'Edit', 'coraline' ), '', '' ); ?>
			</div><!-- .entry-info -->
		</div><!-- #post-## -->

<?php /* How to display all other posts. */ ?>

	<?php else : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'coraline' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php coraline_posted_on(); coraline_posted_by(); ?><span class="comments-link"><span class="meta-sep">|</span> <?php comments_popup_link( __( 'Leave a comment', 'coraline' ), __( '1 Comment', 'coraline' ), __( '% Comments', 'coraline' ) ); ?></span>
			</div><!-- .entry-meta -->

	<?php if ( is_search() ) : // Display excerpts for search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'coraline' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'coraline' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
	<?php endif; ?>

			<div class="entry-info">
					<p class="comments-link"><?php comments_popup_link( __( '&rarr; Leave a comment', 'coraline' ), __( '&rarr; 1 Comment', 'coraline' ), __( '&rarr; % Comments', 'coraline' ) ); ?></p>
				<?php if ( count( get_the_category() ) ) : ?>
					<p class="cat-links">
						<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'coraline' ), 'entry-info-prep entry-info-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					</p>
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<p class="tag-links">
						<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'coraline' ), 'entry-info-prep entry-info-prep-tag-links', $tags_list ); ?>
					</p>
				<?php endif; ?>
				<?php edit_post_link( __( 'Edit', 'coraline' ), '<p class="edit-link">', '</p>' ); ?>
			</div><!-- .entry-info -->
		</div><!-- #post-## -->

		<?php comments_template( '', true ); ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'coraline' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'coraline' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>