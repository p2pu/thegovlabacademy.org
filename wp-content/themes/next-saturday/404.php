<?php
/**
 * @package WordPress
 * @subpackage Next Saturday
 */
get_header(); ?>

	<div id="content" role="main">
		<article id="post-0" class="post error404 not-found">

			<div class="entry-container">
				<header class="entry-header">
					<h1 class="post-title"><?php _e( 'Not found', 'next-saturday' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'next-saturday' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .entry-content -->

			</div><!-- .entry-container -->
		</article><!-- #post-0 -->

	</div><!-- #content -->

<?php get_footer(); ?>