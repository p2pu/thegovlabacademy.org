<?php
/**
 * @package WordPress
 * @subpackage Pink Touch 2
 */

get_header(); ?>

<?php the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="date">
		<p><span class="day"><?php the_time( 'd' ); ?></span><?php the_time( 'M / Y' ); ?></p>
	</div>

	<div class="content">
		<h1 class="entry-title">
		<?php
			printf( __( '<a href="%1$s" title="Return to %2$s" rel="bookmark">%2$s</a>' ),
				get_permalink( $post->post_parent ),
				get_the_title( $post->post_parent )
			 );
		?>
		</h1>

		<div class="entry-content">
			<div class="entry-attachment">
				<div class="attachment">
				<?php
					/**
					 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
					 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
					 */
					$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
					foreach ( $attachments as $k => $attachment ) {
						if ( $attachment->ID == $post->ID )
							break;
					}
					$k++;
					// If there is more than 1 attachment in a gallery
					if ( count( $attachments ) > 1 ) {
						if ( isset( $attachments[ $k ] ) )
							// get the URL of the next image attachment
							$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
						else
							// or get the URL of the first image attachment
							$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
					} else {
						// or, if there's only 1 image, get the URL of the image
						$next_attachment_url = wp_get_attachment_url();
					}
				?>
					<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
					$attachment_size = apply_filters( 'theme_attachment_size', 510 );
					echo wp_get_attachment_image( $post->ID, array( $attachment_size, 510 ) ); // filterable image width with, essentially, no limit for image height.
					?></a>
				</div><!-- .attachment -->

				<?php if ( ! empty( $post->post_excerpt ) ) : ?>
				<div class="entry-caption">
					<?php the_excerpt(); ?>
				</div>
				<?php endif; ?>
			</div><!-- .entry-attachment -->

			<?php the_content(); ?>

			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'pinktouch' ), 'after' => '</div>' ) ); ?>

			<div class="pagination clearfix">
				<span class="older"><?php previous_image_link( false, __( '&larr; Previous' , 'pinktouch' ) ); ?></span>
				<span class="newer"><?php next_image_link( false, __( 'Next &rarr;' , 'pinktouch' ) ); ?></span>
			</div><!-- .pagination -->

		</div>

	</div>

	<div class="info">
		<?php
			$metadata = wp_get_attachment_metadata();
			printf( __( '<p class="attachment-meta"><span class="meta-prep meta-prep-entry-date">Published</span> at <a href="%1$s" title="Link to full-size image">%2$s &times; %3$s</a> in <a href="%4$s" title="Return to %5$s" rel="gallery">%5$s</a></p>', 'pinktouch' ),
				wp_get_attachment_url(),
				$metadata['width'],
				$metadata['height'],
				get_permalink( $post->post_parent ),
				get_the_title( $post->post_parent )
			);
		?>

		<?php the_tags( __( '<p class="tag-list">Tags: ', 'pinktouch' ), ', ', '</p>' ); ?>

		<p>
			<span class="permalink"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'pinktouch' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e( 'Permalink', 'pinktouch' ); ?></a></span>

			<span class="notes"><?php comments_popup_link( __( 'Leave a comment', 'pinktouch' ), __( '1 Comment', 'pinktouch' ), __( '% Comments', 'pinktouch' ) ); ?></span>
		</p>
		<?php edit_post_link( __( 'Edit', 'pinktouch' ), '<p>', '</p>' ); ?>
	</div>
</div><!-- /.post -->

<?php comments_template( '', true ); ?>

<?php get_footer(); ?>