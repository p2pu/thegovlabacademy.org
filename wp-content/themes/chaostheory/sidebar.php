<?php
/**
 * @package WordPress
 * @subpackage ChaosTheory
 */
?>
<div id="sidebar" class="clearfix">
	<div id="innerbar">
		<div id="primary" class="sidebar">
			<ul>
		<?php if ( ! dynamic_sidebar( 1 ) ) : // begin primary sidebar widgets ?>
		<?php if ( ! is_home() || is_paged() ) { // displays everywhere except on home pages ?>
				<li class="home-link">
					<h3><a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php _e( '&laquo; Home', 'chaostheory' ); ?></a></h3>
				</li>
		<?php } ?>
				<?php wp_list_pages( 'title_li=<h3>' . __( 'Pages', 'chaostheory' ) . '</h3>' ); ?>

				<li class="category-links">
					<h3><?php _e( 'Categories', 'chaostheory' ); ?></h3>
					<ul>
						<?php wp_list_categories( 'sort_column=name&hierarchical=1' ); ?>
					</ul>
				</li>
				<li class="archive-links">
					<h3><?php _e( 'Archives', 'chaostheory' ); ?></h3>
					<ul>
						<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
				</li>
		<?php endif; // end primary sidebar widgets  ?>
			</ul>
		</div><!-- #primary .sidebar -->

		<div id="secondary" class="sidebar">
			<ul>
		<?php if ( ! dynamic_sidebar( 2 ) ) : // begin secondary sidebar widgets ?>
				<li class="blog-search">
					<h3><label for="s"><?php _e( 'Search', 'chaostheory' ); ?></label></h3>
					<form id="searchform" method="get" action="<?php echo home_url(); ?>">
						<div>
							<input id="s" name="s" type="text" value="<?php the_search_query(); ?>" size="10" />
							<input id="searchsubmit" name="searchsubmit" type="submit" value="<?php esc_attr_e( 'Find &raquo;', 'chaostheory' ); ?>" />
						</div>
					</form>
				</li>

				<?php widget_chaostheory_links(); ?>

				<li class="feed-links">
					<h3><?php _e( 'RSS Feeds', 'chaostheory' ); ?></h3>
					<ul>
						<li><a href="<?php bloginfo( 'rss2_url' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> RSS 2.0 Feed" rel="alternate" type="application/rss+xml"><?php _e( 'All posts', 'chaostheory' ); ?></a></li>
						<li><a href="<?php bloginfo( 'comments_rss2_url' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> Comments RSS 2.0 Feed" rel="alternate" type="application/rss+xml"><?php _e( 'All comments', 'chaostheory' ); ?></a></li>
					</ul>
				</li>
				<li class="meta-links">
					<h3><?php _e( 'Meta', 'chaostheory' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</li>
		<?php endif; // end secondary sidebar widgets ?>
			</ul>
		</div><!-- #secondary .sidebar -->
	</div>
</div>