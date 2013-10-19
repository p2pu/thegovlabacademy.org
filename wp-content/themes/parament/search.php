<?php
/**
 * @package Parament
 */
?>

<?php get_header(); ?>

<div id="container" class="contain">

	<div id="main" role="main">

		<header id="introduction" class="contain">
			<h1 id="page-title"><?php _e( 'Search Results', 'parament' ); ?></h1>
			<?php if ( have_posts() ) : ?>
				<h2 id="page-tagline"><?php printf( __( 'Search Results for: %s', 'parament' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			<?php else: ?>
				<h2 id="page-tagline"><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'parament' ); ?></h2>
			<?php endif; ?>
			<?php get_search_form(); ?>
		</header>

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'excerpt' ); ?>
			<?php endwhile; ?>
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