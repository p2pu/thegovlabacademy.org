<?php
/**
 * @package Parament
 */
?>

	<ul id="sidebar" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

		<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array(
			'widget_id'     => null,
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>'
		) ); ?>

		<?php the_widget( 'WP_Widget_Recent_Comments', array( 'number' => 5 ), array(
			'widget_id'     => null,
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>'
		) ); ?>

		<?php the_widget( 'WP_Widget_Meta', array(), array(
			'widget_id'     => null,
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>'
		) ); ?>

		<?php endif; ?>
	</ul><!-- end sidebar -->