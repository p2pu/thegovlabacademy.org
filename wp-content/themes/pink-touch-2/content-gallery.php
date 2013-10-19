<?php
/**
 * @package WordPress
 * @subpackage Pink Touch 2
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="date">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'pinktouch' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
			<?php if ( ! is_singular() && is_sticky() ) : ?>
				<p><b><?php _e( 'Featured', 'pinktouch' ); ?></b></p>
			<?php else : ?>
				<p><span class="day"><?php the_time( 'd' ); ?></span><?php the_time( 'M / Y' ); ?></p>
			<?php endif; ?>
		</a>
	</div>

	<div class="content">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'pinktouch' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<div class="entry-content">
			<?php if ( post_password_required() || is_singular() ) : ?>
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pinktouch' ) ); ?>

			<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'large' );
				?>

				<div class="gallery-thumb">
					<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
				</div><!-- .gallery-thumb -->

				<p class="gallery-info"><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'pinktouch' ),
						'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'pinktouch' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
						number_format_i18n( $total_images )
					); ?></em></p>
				<?php endif; ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'pinktouch' ), 'after' => '</div>' ) ); ?>
			<?php if ( get_the_author_meta( 'description' ) && is_singular() ) pinktouch_author_info(); ?>
		</div><!-- .entry-content -->
	</div><!-- .content -->

	<?php pinktouch_post_data(); ?>
</div><!-- /.post -->