<?php
/**
 *
 * @package WordPress
 * @subpackage Next Saturday
 */
?>

	<div id="secondary-wrapper" class="widget-area" role="complementary">
		<div id="secondary" class="highlight-box">

			<?php // The primary sidebar used in all layouts
			if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'next-saturday' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'next-saturday' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>

		</div><!-- #secondary .highlight-box -->
	</div><!-- #secondary-wrapper .widget-area -->