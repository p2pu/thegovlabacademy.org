<?php
/**
 * @package Dusk To Dawn
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'dusktodawn-featured-image', array( 'class' => 'featured-image' ) ); endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'dusktodawn' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'dusktodawn' ), '<br /><span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->