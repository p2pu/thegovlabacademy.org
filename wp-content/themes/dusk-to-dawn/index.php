<?php
/**
 * @package Dusk To Dawn
 */
get_header(); ?>

<div id="primary">
	<div id="content" class="clear-fix" role="main">

	<?php if ( have_posts() ) : ?>

		<?php if ( is_search() ) : ?>
			<div class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'dusktodawn' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</div>
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php dusktodawn_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'dusktodawn' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'dusktodawn' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	<?php endif; ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>