<?php
/**
 * @package WordPress
 * @subpackage Next Saturday
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

	<?php next_saturday_entry_date(); ?>

	<div class="entry-container">
		<div class="entry-content">
			<?php the_content( __( 'Read more <span class="meta-nav">&rarr;</span>', 'next-saturday' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages:', 'next-saturday' ), 'after' => '</p></div>' ) ); ?>
		</div><!-- .entry-content -->

		<div class="entry-meta-wrap">
			<div class="entry-meta">
				<span class="comments-num"><?php comments_popup_link( __( 'Leave a comment', 'next-saturday' ), __( '1 Comment', 'next-saturday' ), __( '% Comments', 'next-saturday' ) ); ?></span>
				<?php edit_post_link( __( 'Edit this Entry', 'next-saturday' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
		</div>

	</div><!-- .entry-container -->
</article><!-- #post-## -->