<?php
/**
 * @package Parament
 */
?>

<?php get_header(); ?>

<div id="container" class="contain">
	<div id="main" role="main">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
				<?php comments_template(); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part( 'content', '404' ); ?>
		<?php endif; ?>
	</div><!-- end main -->

	<?php get_sidebar(); ?>

</div><!-- end container -->

<?php get_footer(); ?>