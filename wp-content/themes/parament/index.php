<?php
/**
 * @package Parament
 */
?>

<?php get_header(); ?>

<div id="container" class="contain">
	<div id="main" role="main">

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part( 'content', '404' ); ?>
		<?php endif; ?>

		<nav id="posts-nav" class="paged-navigation contain">
			<h1 class="assistive-text"><?php _e( 'Posts navigation', 'parament' ); ?></h1>
			<div class="nav-older"><?php next_posts_link( __( '&larr; Older Entries', 'parament' ) ); ?></div>
			<div class="nav-newer"><?php previous_posts_link( __( 'Newer Entries &rarr;', 'parament' ) ); ?></div>
		</nav>

	</div><!-- end main -->

	<?php get_sidebar(); ?>

</div><!-- end container -->

<?php get_footer(); ?>