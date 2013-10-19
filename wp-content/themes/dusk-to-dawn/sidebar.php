<?php
/**
 * @package Dusk To Dawn
 */
?>
<div id="secondary" class="widget-area" role="complementary">

	<?php if ( has_nav_menu( 'sidebar-menu' ) ) : ?>
		<nav id="access" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'sidebar-menu' ) ); ?>
		</nav>
	<?php endif; ?>

	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

		<aside class="widget widget_search">
			<?php get_search_form(); ?>
		</aside>

		<aside id="archives" class="widget">
			<h1 class="widget-title"><?php _e( 'Archives', 'dusktodawn' ); ?></h1>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside>

		<aside id="meta" class="widget">
			<h1 class="widget-title"><?php _e( 'Meta', 'dusktodawn' ); ?></h1>
			<ul>
				<?php wp_register(); ?>
				<aside><?php wp_loginout(); ?></aside>
				<?php wp_meta(); ?>
			</ul>
		</aside>

	<?php endif; // end sidebar widget area ?>
</div><!-- #secondary .widget-area -->