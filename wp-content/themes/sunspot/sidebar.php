<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Sunspot
 * @since Sunspot 1.0
 */
?>
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary .widget-area -->
		<?php endif; ?>