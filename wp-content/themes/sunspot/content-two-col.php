<?php
/**
 * Content template for the two-column display of posts on the front page.
 * @package Sunspot
 * @since Sunspot 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( '' != get_the_post_thumbnail() ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permanent Link to %s', 'sunspot' ), the_title_attribute( 'echo=0' ) ) ); ?>">
				<?php if( is_active_sidebar( 'sidebar-1' ) ) :
					the_post_thumbnail( 'sunspot-thumbnail', array( 'class' => 'post-thumbnail', 'alt' => get_the_title(), 'title' => get_the_title() ) );
				else:
					the_post_thumbnail( 'sunspot-thumbnail-wide', array( 'class' => 'post-thumbnail', 'alt' => get_the_title(), 'title' => get_the_title() ) );
				endif;
				?>
			</a>
		</div><!-- .entry-thumbnail -->
	<?php endif; ?>

	<header class="entry-header">

		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sunspot' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php sunspot_posted_on(); ?>
			<?php if ( is_sticky() ) : ?>
				<span class="sticky-label"><?php _e( 'Featured', 'sunspot' ); ?></span>
			<?php endif; ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
		<p class="comments-link"><?php comments_popup_link( '<span class="no-reply">' . __( '0', 'sunspot' ) . '</span>', __( '1', 'sunspot' ), __( '%', 'sunspot' ) ); ?></p>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sunspot' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'sunspot' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'sunspot' ) );
				if ( $categories_list && sunspot_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s.', 'sunspot' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'sunspot' ) );
				if ( $tags_list ) :
			?>
			<span class="tag-links">
				<?php printf( __( 'Tagged %1$s.', 'sunspot' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php edit_post_link( __( 'Edit', 'sunspot' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
