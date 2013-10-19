<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage Pink Touch 2
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'sidebar-1' )
		&& ! is_active_sidebar( 'sidebar-2' )
		&& ! is_active_sidebar( 'sidebar-3' )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>
<div id="widgets" <?php pinktouch_footer_sidebar_class(); ?>>
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="first" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #first .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="second" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- #second .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
	<div id="third" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div><!-- #third .widget-area -->
	<?php endif; ?>
</div><!-- #widgets -->