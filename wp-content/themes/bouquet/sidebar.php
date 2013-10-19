<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage Bouquet
 */
?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary-wrapper">

		<div id="search-area">
			<?php get_search_form(); ?>
		</div>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary .widget-area -->
	</div><!-- #secondary-wrapper -->
	<?php endif; // end sidebar widget area ?>
