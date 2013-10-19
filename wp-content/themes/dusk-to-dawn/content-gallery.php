<?php
/**
 * @package Dusk To Dawn
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php if ( ! is_singular() && is_sticky() ) : ?>
				<?php _e( 'Featured', 'dusktodawn' ); ?>
			<?php else : ?>
				<?php dusktodawn_posted_on(); ?>
			<?php endif; ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dusktodawn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for search pages ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php if ( post_password_required() || is_singular() ) : ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'dusktodawn' ) ); ?>
		<?php else : ?>
			<?php
				$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
				if ( $images ) :
					$total_images = count( $images );
					$image = array_shift( $images );
					$image_img_tag = wp_get_attachment_image( $image->ID, 'dusktodawn-featured-image' );
			?>

			<figure class="gallery-thumb">
				<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
			</figure><!-- .gallery-thumb -->

			<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'dusktodawn' ),
					'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'dusktodawn' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
					number_format_i18n( $total_images )
				); ?></em></p>
			<?php endif; ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'dusktodawn' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php dusktodawn_post_meta(); ?>

		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'dusktodawn' ), __( '1 Comment', 'dusktodawn' ), __( '% Comments', 'dusktodawn' ) ); ?></span><br />
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'dusktodawn' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- #entry-meta -->

	<?php dusktodawn_author_info(); ?>

</article><!-- #post-<?php the_ID(); ?> -->