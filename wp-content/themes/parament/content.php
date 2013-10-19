<?php
/**
 * @package Parament
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'contain has-byline' ); ?>>

	<div class="title">
		<?php if ( is_singular() ) : ?>
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		<?php else: ?>
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<?php endif; ?>
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

		<div class="entry-meta">

			<?php
				/* translators: used between list items, there is a space after the comma. */
				$categories_list = get_the_category_list( __( ', ', 'parament' ) );
				if ( $categories_list ) :
			?>
			<?php printf( __( 'Posted in: %1$s.', 'parament' ), $categories_list ); ?>
			<?php endif; // End if $categories_list ?>

			<?php
				/* translators: used between list items, there is a space after the comma. */
				$tags_list = get_the_tag_list( '', __( ', ', 'parament' ) );
				if ( $tags_list ) :
			?>
			<?php printf( __( 'Tagged: %1$s.', 'parament' ), $tags_list ); ?>
			<?php endif; // End if $tags_list ?>

			<?php if ( comments_open() && ! post_password_required() ) : ?>
				<span class="comments"><?php
					comments_popup_link(
						__( 'Leave a Comment', 'parament' ),
						__( '1 comment',   'parament' ),
						__( '% comments',  'parament' )
					);
				?></span>
			<?php endif; ?>
		</div><!-- entry-meta -->

	</div><!-- end title -->

	<div class="entry-content">
		<?php the_content( __( 'Continue Reading', 'parament' ) ); ?>
		<?php
			wp_link_pages( array(
				'after'       => '</div>',
				'before'      => '<div class="entry-navigation">',
				'link_after'  => '</span>',
				'link_before' => '<span>',
			) );
		?>
	</div>

	<?php if ( is_single() ) : ?>
		<nav id="post-nav" class="contain">
			<h1 class="assistive-text"><?php _e( 'Posts navigation', 'parament' ); ?></h1>
			<?php previous_post_link( '<div class="nav-older">&larr; %link</div>' ); ?>
			<?php next_post_link( '<div class="nav-newer">%link &rarr;</div>' ); ?>
		</nav>
	<?php endif; ?>

</article>