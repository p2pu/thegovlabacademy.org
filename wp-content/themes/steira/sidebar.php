<div id="sidebar">
<?php
	$comment_count = get_comment_count($post->ID);

	// Check to see if this is a post or page and comments or trackbacks are open and there are comments
	if ( (is_singular()) && ((('open' == $post->comment_status) || ('open' == $post->ping_status)) || ($comment_count['approved'] > 0)) ) :
		// if it is -- comments!
		comments_template('', true);
		
	else :
		// if not -- widget area!
		echo '<ul>';
		
		if ( !dynamic_sidebar('sidebar') ) : /* begin widget area */
?>
		<li id="steira_about_text-4" class="widget widget_steira_about_text">
			<h2><?php _e('About This Site', 'steira'); ?></h2>
			
			<div class="aboutshort">
				<p><?php _e('You can use the Steira "About" Text Widget to add some text about your site here.', 'steira'); ?></p>
			</div>
		</li>

		<li id="steira_recent_posts-7" class="widget widget_steira_recent_posts">
			<h2><?php _e('Recent Posts', 'steira'); ?></h2>
			
		<?php
			$r = new WP_Query(array('showposts' => '10', 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
			if ($r->have_posts()) :
		?>
			<ul id="steira-recent-posts" class="indexlist">
				
			<?php  while ($r->have_posts()) : $r->the_post(); ?>
				<li>
					<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><span class="date"><?php the_time(get_option("date_format")); ?></span> <span class="title"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></span></a>
				</li>
			<?php endwhile; ?>
			</ul>

		<?php
			wp_reset_query();  // Restore global post data stomped by the_post().
			endif;
		?>
		</li>

		<li id="steira_categories-5" class="widget widget_steira_categories">
			<h2><?php _e('Post Categories', 'steira');?></h2>
			
			<ul id="categoriesgrid">
				<?php wp_list_categories('order=DESC&orderby=count&title_li=&depth=-1'); ?>
			</ul>
		</li>

		<li id="steira-recent-comments-5" class="widget widget_steira_recent_comments">
			<h2><?php _e('Recent Comments', 'steira');?></h2>
				<ul id="steira-recent-comments" class="indexlist">
				<?php
					global $wpdb, $comments, $comment;
					
					$number = 5;
					
					$comments = $wpdb->get_results("SELECT $wpdb->comments.* FROM $wpdb->comments JOIN $wpdb->posts ON $wpdb->posts.ID = $wpdb->comments.comment_post_ID WHERE comment_approved = '1' AND post_status = 'publish' ORDER BY comment_date_gmt DESC LIMIT 15");
					
					$comments = array_slice( (array) $comments, 0, $number );
					
					if ( $comments ) : foreach ( (array) $comments as $comment) :
						echo  '<li class="recentcomments"><a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '"><span class="name">' . get_comment_author() . '</span><span class="didwhat">' . __('commented on', 'steira')  . '</span><span class="title">' . get_the_title($comment->comment_post_ID) . '</span></a></li>';
						
					endforeach; endif;
				?>
				</ul>
		</li>

		<li class="widget">
			<h2><?php _e('Meta','steira');?></h2>
			
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
				<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
				<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
				<?php wp_meta(); ?>
			</ul>
		</li>

	<?php endif; /* end widget area */  ?>

	</ul>

<?php endif; /* end comments check*/ ?>

</div><!-- sidebar -->
