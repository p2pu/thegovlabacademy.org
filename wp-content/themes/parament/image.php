<?php
/**
 * @package Parament
 */
?>

<?php get_header(); ?>

<div id="container" class="contain">
	<div id="main" role="main" class="image-template">

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'has-byline' ); ?>>

		<div class="title">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<div class="entry-byline">
				<span><?php
				printf( __( 'Posted by %1$s on %2$s', 'parament' ),
					sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						esc_attr( sprintf( __( 'View all posts by %1$s', 'parament' ), get_the_author() ) ),
						esc_html( get_the_author() )
					),
					'<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_date() ) . '</a>'
				);
				?></span>
				<?php edit_post_link(); ?>
			</div>
		</div><!-- end title -->

		<div class="entry-content">
			<div id="attachment-image">
				<?php echo wp_get_attachment_image( $post->ID, array( 917, 917 ) ); ?>
			</div>
			<?php if ( '' != get_post_field( 'post_excerpt', get_the_ID() ) ) : ?>
				<p><?php the_excerpt(); ?></p>
			<?php endif; ?>
			<?php the_content(); ?>
			<?php $parent_id = absint( get_post_field( 'post_parent', get_the_ID() ) ); ?>
			<p><?php printf( __( 'This is an image for %1$s.', 'parament' ), '<a href="' . esc_url( get_permalink( $parent_id ) ) . '">' . get_the_title( $parent_id ) . '</a>' ); ?>
		</div>

		<nav id="post-nav" class="contain">
			<h1 class="assistive-text"><?php _e( 'Images navigation', 'parament' ); ?></h1>
			<div class="nav-older"><?php previous_image_link( false, __( '&larr; Previous', 'parament' ) ); ?></div>
			<div class="nav-newer"><?php next_image_link( false, __( 'Next &rarr;', 'parament' ) ); ?></div>
		</nav>

	</article>

	<?php comments_template(); ?>

	<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part( 'content', '404' ); ?>

<?php endif; ?>

	</div><!-- end main -->

</div><!-- end container -->

<?php get_footer(); ?>