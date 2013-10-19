<?php

// Widgets: Replaces the default search widget with one
// that matches what is in the sidebar by default
function widget_chaostheory_search($args) {
	extract($args);
	if ( empty($title) )
		$title = __( 'Search', 'chaostheory' );
?>
		<?php echo $before_widget ?>

			<?php echo $before_title ?><label for="s"><?php echo $title ?></label><?php echo $after_title ?>
			<form id="searchform" method="get" action="<?php echo home_url(); ?>">
				<div>
					<input id="s" name="s" type="text" value="<?php the_search_query(); ?>" size="10" />
					<input id="searchsubmit" type="submit" value="<?php esc_attr_e( 'Find &raquo;', 'chaostheory' ); ?>" />
				</div>
			</form>
		<?php echo $after_widget; ?>

<?php
}

// Widgets: Replaces the default meta widget with one
// that matches what is in the sidebar by default
function widget_chaostheory_meta($args) {
	extract($args);
	if ( empty($title) )
		$title = __( 'Meta', 'chaostheory' );
?>
		<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		<?php echo $after_widget; ?>
<?php
}

// Widgets: Adds the home link as a widget, which
// appears when NOT on the home page OR on a page of the home page
function widget_sandbox_homelink($args) {
	extract($args);
	$options = get_option( 'widget_sandbox_homelink' );
	$title = empty($options['title']) ? __( '&laquo; Home', 'chaostheory' ) : $options['title'];
?>
<?php if ( !is_home() || is_paged() ) { ?>
		<?php echo $before_widget; ?>
			<?php echo $before_title ?><a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php echo $title ?></a><?php echo $after_title ?>
		<?php echo $after_widget; ?>
<?php } ?>
<?php
}

// Widgets: Adds the option to set the text for the home link widget
function widget_sandbox_homelink_control() {
	$options = $newoptions = get_option( 'widget_sandbox_homelink' );
	if ( $_POST["homelink-submit"] ) {
		$newoptions['title'] = strip_tags(stripslashes($_POST["homelink-title"]));
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option( 'widget_sandbox_homelink', $options);
	}
	$title = esc_attr( $options['title'] );
?>
		<p style="text-align:left;"><?php _e( 'Adds a link to the home page on every page <em>except</em> the home.', 'chaostheory' ); ?></p>
		<p>
			<label for="homelink-title">
				<?php _e( 'Link Text:', 'chaostheory' ); ?>
				<input class="widefat" id="homelink-title" name="homelink-title" type="text" value="<?php echo $title; ?>" />
			</label>
		</p>
		<input type="hidden" id="homelink-submit" name="homelink-submit" value="1" />
<?php
}

// Widgets: Adds a widget with the RSS links
// as they appear in the default sidebar, which are good
function widget_sandbox_rsslinks($args) {
	extract($args);
	$options = get_option( 'widget_sandbox_rsslinks' );
	$title = empty($options['title']) ? __( 'RSS Links', 'chaostheory' ) : $options['title'];
?>
		<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
			<ul>
				<li><a href="<?php bloginfo( 'rss2_url' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> RSS 2.0 Feed" rel="alternate" type="application/rss+xml"><?php _e( 'All posts', 'chaostheory' ); ?></a></li>
				<li><a href="<?php bloginfo( 'comments_rss2_url' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> Comments RSS 2.0 Feed" rel="alternate" type="application/rss+xml"><?php _e( 'All comments', 'chaostheory' ); ?></a></li>
			</ul>
		<?php echo $after_widget; ?>
<?php
}

// Widgets: Adds the option to set the text for the RSS link widget
function widget_sandbox_rsslinks_control() {
	$options = $newoptions = get_option( 'widget_sandbox_rsslinks' );
	if ( $_POST["rsslinks-submit"] ) {
		$newoptions['title'] = strip_tags(stripslashes($_POST["rsslinks-title"]));
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option( 'widget_sandbox_rsslinks', $options);
	}
	$title = esc_attr( $options['title'] );
?>
			<p>
				<label for="rsslinks-title">
					<?php _e( 'Title:', 'chaostheory' ); ?>
					<input class="widefat" id="rsslinks-title" name="rsslinks-title" type="text" value="<?php echo $title; ?>" />
				</label>
			</p>
			<input type="hidden" id="rsslinks-submit" name="rsslinks-submit" value="1" />
<?php
}

// Widgets: adds Links list
function widget_chaostheory_links() {
	wp_list_bookmarks(array('title_before'=>'<h3>', 'title_after'=>'</h3>', 'show_images'=>true));
}