<?php get_header(); ?>

			<div id="body" class="full">

				<div id="content">

<?php the_post(); ?>

<div id="nav-above" class="navigation">
	<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&lsaquo;</span> %title' ) ?></div>
	<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&rsaquo;</span>' ) ?></div>
</div><!-- #nav-above -->

					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

						<h2 class="post-title">
							<span class="wrap">
								<span class="posted"><?php the_time(get_option("date_format")); ?></span>
								<span class="title"><?php the_title(); ?></span>
							</span>
						</h2>

						<div class="contentblock">
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
							<p><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
							$attachment_size = apply_filters( 'theme_attachment_size',  860 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_size, $attachment_size ) ); 
							?></a></p>

	<?php if (has_excerpt()) : ?>
							<div id="intro">
		<?php the_excerpt(); ?>
							</div><!-- #intro -->
	<?php endif; ?>

	<?php the_content(''); ?>

	<div class="image-navigation">
		<span class="previous-image alignleft"><?php previous_image_link( false, __( '&larr; Previous' , 'steira' ) ); ?></span>
		<span class="next-image alignright"><?php next_image_link( false, __( 'Next &rarr;' , 'steira' ) ); ?></span>
	</div>

	<?php wp_link_pages('before=<p class="page-link">' . __( 'Pages:', 'steira' ) . '&after=</p>') ?>
							<p><?php the_tags(__( 'Tags: ', 'steira' ), ', ', ''); ?></p>

						</div><!-- contentblock -->

						<div class="postdetails">
							<?php
								$metadata = wp_get_attachment_metadata();
								printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span>  at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'steira' ),
									esc_attr( get_the_time() ),
									get_the_date(),
									wp_get_attachment_url(),
									$metadata['width'],
									$metadata['height'],
									get_permalink( $post->post_parent ),
									get_the_title( $post->post_parent )
								);
							?>
							<?php edit_post_link( __( 'Edit', 'steira' ), '<span class="sep">|</span> <span class="edit-link">', '</span>' ); ?>
						</div>

					</div><!-- #post-<?php the_ID(); ?> -->

				</div><!-- content -->

<?php get_sidebar(); ?>

			</div><!-- body -->

<?php get_footer(); ?>