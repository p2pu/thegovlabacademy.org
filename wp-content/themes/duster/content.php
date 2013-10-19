<?php
/**
 * @package WordPress
 * @subpackage Duster
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'duster' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<?php if ( 'post' == $post->post_type ) : ?>
			<div class="entry-meta">
				<?php
					printf( __( '<span class="sep">Posted on </span><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></a> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>', 'duster' ),
						get_permalink(),
						get_the_date( 'c' ),
						get_the_date(),
						get_author_posts_url( get_the_author_meta( 'ID' ) ),
						esc_attr( sprintf( __( 'View all posts by %s', 'duster' ), get_the_author() ) ),
						get_the_author()
					);
				?>
			</div><!-- .entry-meta -->
			<?php endif; ?>

			<?php if ( comments_open() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( __( '<span class="leave-reply">Reply</span>', 'duster' ), __( '1', 'duster' ), __( '%', 'duster' ) ); ?>
			</div>
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'duster' ) ); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'duster' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( '<span>Pages:</span>', 'duster' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<?php if ( 'post' == $post->post_type ) : // Hide category and tag text for pages on Search ?>
			<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in', 'duster' ); ?></span> <?php the_category( ', ' ); ?></span>
			<?php the_tags( '<span class="sep"> | </span> <span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __( 'Tagged', 'duster' ) . '</span> ', ', ', '</span>' ); ?>
			<?php endif; ?>

			<?php if ( comments_open() ) : ?>
			<span class="sep"> | </span>
			<span class="comments-link"><?php comments_popup_link( __( '<span class="leave-reply">Leave a reply</span>', 'duster' ), __( '<b>1</b> Reply', 'duster' ), __( '<b>%</b> Replies', 'duster' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'duster' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
