<?php
/**
 * @package WordPress
 * @subpackage Pink Touch 2
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( 'post' == $post->post_type ) : ?>
	<div class="date">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'pinktouch' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
			<?php if ( ! is_singular() && is_sticky() ) : ?>
				<p><?php _e( 'Featured', 'pinktouch' ); ?></p>
			<?php else : ?>
				<p><span class="day"><?php the_time( 'd' ); ?></span><?php the_time( 'M / Y' ); ?></p>
			<?php endif; ?>
		</a>
	</div>
	<?php endif; ?>

	<div class="content">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'pinktouch' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pinktouch' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'pinktouch' ), 'after' => '</div>' ) ); ?>
			<?php if ( get_the_author_meta( 'description' ) && is_singular() ) pinktouch_author_info(); ?>
		</div><!-- .entry-content -->
	</div><!-- .content -->

	<?php pinktouch_post_data(); ?>
</div><!-- /.post -->