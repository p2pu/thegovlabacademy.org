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

		<?php
			// Let's get all the post content
			$link_content = $post->post_content;

			// And let's find the first url in the post content
			$link_url = dusktodawn_url_grabber();

			// Let's make the title a link if there's a link in this link post
			if ( ! empty( $link_url ) ) :
		?>
			<h1 class="entry-title link"><a href="<?php esc_attr_e( $link_url ); ?>" title="<?php printf( esc_attr__( 'Link to %s', 'dusktodawn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php else : ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dusktodawn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'dusktodawn-featured-image', array( 'class' => 'featured-image' ) ); endif; ?>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'dusktodawn' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'dusktodawn' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php dusktodawn_post_meta(); ?>

		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'dusktodawn' ), __( '1 Comment', 'dusktodawn' ), __( '% Comments', 'dusktodawn' ) ); ?></span><br />
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'dusktodawn' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- #entry-meta -->

	<?php dusktodawn_author_info(); ?>

</article><!-- #post-<?php the_ID(); ?> -->