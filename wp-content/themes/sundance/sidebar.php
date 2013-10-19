<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Sundance
 * @since Sundance 1.0
 */
?>
<?php
	$options = sundance_get_theme_options();
	if ( 'off' == $options['show_rss_link']
		&& ''  == $options['twitter_url']
		&& ''  == $options['facebook_url']
		&& ''  == $options['google_url']
		&& ''  == $options['flickr_url']
		&& ! is_active_sidebar( 'sidebar-1' )
	)
		return;
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>

			<?php
				if ( 'off' != $options['show_rss_link']
					|| ''  != $options['twitter_url']
					|| ''  != $options['facebook_url']
					|| ''  != $options['google_url']
					|| ''  != $options['flickr_url']
				) :
			?>
				<div class="syndicate">
					<ul>
						<?php if ( 'off' != $options['show_rss_link'] ) : ?>
							<li><a class="rss-link" href="<?php echo get_feed_link( 'rss2' ); ?>" title="<?php esc_attr_e( 'RSS', 'sundance' ); ?>"><span><?php _e( 'RSS Feed', 'sundance' ); ?></span></a></li>
						<?php endif; ?>

						<?php if ( ''!= $options['twitter_url'] ) : ?>
							<li><a class="twitter-link" href="<?php echo esc_url( $options['twitter_url'] ); ?>" title="<?php esc_attr_e( 'Twitter', 'sundance' ); ?>"><span><?php _e( 'Twitter', 'sundance' ); ?></span></a></li>
						<?php endif; ?>

						<?php if ( ''!= $options['facebook_url'] ) : ?>
							<li><a class="facebook-link" href="<?php echo esc_url( $options['facebook_url'] ); ?>" title="<?php esc_attr_e( 'Facebook', 'sundance' ); ?>"><span><?php _e( 'Facebook', 'sundance' ); ?></span></a></li>
						<?php endif; ?>

						<?php if ( ''!= $options['google_url'] ) : ?>
							<li><a class="google-link" href="<?php echo esc_url( $options['google_url'] ); ?>" title="<?php esc_attr_e( 'Google+', 'sundance' ); ?>"><span><?php _e( 'Google Plus', 'sundance' ); ?></span></a></li>
						<?php endif; ?>

						<?php if ( ''!= $options['flickr_url'] ) : ?>
							<li><a class="flickr-link" href="<?php echo esc_url( $options['flickr_url'] ); ?>" title="<?php esc_attr_e( 'Flickr', 'sundance' ); ?>"><span><?php _e( 'Flickr', 'sundance' ); ?></span></a></li>
						<?php endif; ?>

					</ul>
				</div><!-- .syndicate -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

				<?php dynamic_sidebar( 'sidebar-1' ); ?>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->