<?php
/**
 * @package Parament
 */

$class = '';
if ( '' != get_edit_post_link() )
	$class = 'has-byline';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>

	<div class="title">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<?php edit_post_link( __( 'Edit This', 'parament' ), '<div class="entry-byline">', '</div>' ); ?>
	</div><!-- end title -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>

</article>