<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Bouquet
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'bouquet' ), 'after' => '</div>' ) ); ?>
		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'bouquet' ), __( '1 Comment', 'bouquet' ), __( '% Comments', 'bouquet' ) ); ?></span>
		<?php endif; ?>
		<?php edit_post_link( __( '(Edit)', 'bouquet' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
