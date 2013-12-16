<?php
/*
  * Template name: Home page
  * Simple Fields Connector: home_page_connector
  */
get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrapper clearfix">

		<div id="main" class="twelvecol first clearfix" role="main">

			<?php if (function_exists("easingsliderlite")) {
				easingsliderlite();
			} ?>
			<?php
			$quote = simple_fields_fieldgroup('home_page_quote');
			$videos = simple_fields_fieldgroup('home_page_videos');
			$featured_content = simple_fields_fieldgroup('home_page_featured_content');

			if (function_exists('dynamic_content_gallery')) {
				dynamic_content_gallery();
			}

			?>
		</div>
		<section class="clearfix">
			<p class="big-quote">
				<?php echo $quote['home_page_quote']; ?><br>
			</p>

			<a class="call-to-action" href="<?php echo $quote['home_page_quote_author_link']; ?>">
				<?php echo $quote['home_page_quote_author']; ?>
			</a>
		</section>

		<section class="theme-columns clearfix"> <!-- Themes Highlights -->

			<div class="wrapper">
				<?php foreach ($videos as $key => $value) {
					; ?>
				<div class="four-col <?php echo strtolower($value['home_page_theme_name']); ?>">
					<h2><?php echo $value['home_page_theme_name']; ?></h2>

					<?php echo do_shortcode('[fve]' . simple_fields_get_post_value($value['home_page_featured_videos']['id'], "Link to video", true) . '[/fve]') ?>
					<div class="info">
						<h3>
							<a href="<?php echo get_permalink($value['home_page_featured_pages']); ?>">
								<?php echo $value['home_page_video_title']; ?>
							</a>
						</h3>

						<p><?php echo $value['home_page_video_description']; ?></p>
					</div>
					</div><?php
				}?>
				<div class="four-col behave soon">
					<h2>Behave</h2>
					<img src="<?php echo bloginfo('template_directory'); ?>/library/images/behave-theme.png" alt="">

					<div class="info">
						<h3>Behavior and Insight</h3>

						<p>
							Learn about research methodology and tech-enabled strategies such as gamification,
							user-driven design, prizes, and challenges for encouraging large-scale participation.
						</p>
						<h4>Coming Soon</h4>
					</div>
				</div>
				<div class="four-col history soon">
					<h2>History</h2>
					<img src="<?php echo bloginfo('template_directory'); ?>/library/images/history-theme.png" alt="">

					<div class="info">
						<h3>History &amp; Context of Open Governance</h3>

						<p>
							Explore the nature of our current crisis of governance, today's international open
							government movement,
							and the legal and policy context for innovation in this open governance.
						</p>
						<h4>Coming Soon</h4>
					</div>
				</div>
			</div>
		</section>
		<section class="featured-content"> <!-- Featured Videos -->
			<div class="wrapper tencol">
				<aside> <!-- Sidebar -->
					<h3 class="sidebar-title">Twitter Feed</h3>
					<a class="twitter-timeline" height="625" href="https://twitter.com/TheGovLab/lists/open-governance"
					   data-widget-id="411113767246643200">Tweets from @TheGovLab/open-governance</a>
					<script>!function (d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
							if (!d.getElementById(id)) {
								js = d.createElement(s);
								js.id = id;
								js.src = p + "://platform.twitter.com/widgets.js";
								fjs.parentNode.insertBefore(js, fjs);
							}
						}(document, "script", "twitter-wjs");</script>
				</aside>

				<div class="wrapper main-content">
					<!-- These are Featured Post Excerpts, right? -->
					<h2>Featured Content</h2>
					<?php foreach ($featured_content as $key => $value) { ?>
						<article class="clearfix content-entry video">
						<img class="image" src="<?php echo $value['home_page_topic_image']['url']; ?>" alt="">

						<div class="info">
							<h3 class="post-title"><?php echo $value['home_page_featured_content_title'] ?></h3>

							<p><?php echo $value['home_page_featured_content_description'] ?></p>
						</div>
						</article><?php
					} ?>
				</div>
				<div class="wrapper">
					<div class="fourcol first">
						<h2>Partners</h2>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article"
							         itemscope itemtype="http://schema.org/BlogPosting">
								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section> <?php // end article section ?>
							</article> <?php // end article ?>
						<?php endwhile; ?>

						<?php endif; ?>
					</div>
					<div class="eightcol">
						<h2>We are inspired by</h2>
						<object width="100%" height="400" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
						        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"
						        class="">
							<param name="src" value="https://picasaweb.google.com/s/c/bin/slideshow.swf">
							<param name="flashvars"
							       value="host=picasaweb.google.com&amp;hl=en_US&amp;feat=flashalbum&amp;RGB=0xFFFFFF&amp;feed=https%3A%2F%2Fpicasaweb.google.com%2Fdata%2Ffeed%2Fapi%2Fuser%2Fnyuwagner%2Falbumid%2F5856759830981440881%3Falt%3Drss%26kind%3Dphoto%26authkey%3DGv1sRgCITD24nm1bPQHQ%26hl%3Den_US">
							<embed width="100%" height="400" type="application/x-shockwave-flash"
							       src="https://picasaweb.google.com/s/c/bin/slideshow.swf"
							       flashvars="host=picasaweb.google.com&amp;hl=en_US&amp;feat=flashalbum&amp;RGB=0xFFFFFF&amp;feed=https%3A%2F%2Fpicasaweb.google.com%2Fdata%2Ffeed%2Fapi%2Fuser%2Fnyuwagner%2Falbumid%2F5856759830981440881%3Falt%3Drss%26kind%3Dphoto%26authkey%3DGv1sRgCITD24nm1bPQHQ%26hl%3Den_US"
							       class="">
						</object>
					</div>
				</div>
			</div>
		</section>
		<section>
			<div class="wrapper">

			</div>
		</section>
	</div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>
