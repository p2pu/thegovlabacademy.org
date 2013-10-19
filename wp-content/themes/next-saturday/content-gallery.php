<?php
/**
 * @package WordPress
 * @subpackage Next Saturday
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

	<?php next_saturday_entry_date(); ?>

	<div class="entry-container">

		<header class="entry-header">
			<h1 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'next-saturday' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php if ( is_single() ) : ?>
				<?php the_content( __( 'Read more <span class="meta-nav">&rarr;</span>', 'next-saturday' ) ); ?>
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

				<p><span class="gallery-summary"><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'next-saturday' ),
						'href="' . esc_url( get_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'next-saturday' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
						number_format_i18n( $total_images )
					); ?></span></p>
				<?php endif; ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'next-saturday' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

		<div class="entry-meta-wrap">
			<div class="entry-meta">
				<span class="comments-num"><?php comments_popup_link( __( 'Leave a comment', 'next-saturday' ), __( '1 Comment', 'next-saturday' ), __( '% Comments', 'next-saturday' ) ); ?></span>
				<?php edit_post_link( __( 'Edit this Entry', 'next-saturday' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
		</div>

	</div><!-- .entry-container -->
</article><!-- #post-## -->