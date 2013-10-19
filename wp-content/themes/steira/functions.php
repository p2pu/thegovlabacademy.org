<?php

/**
 * Get our feed links
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Enable custom backgrounds
 */
add_custom_background();

/**
 * Our primary menu area
 */
register_nav_menus( array(
	'primary' => __( 'Primary Navigation', 'steira' ),
) );

/**
 * fallback for primary navigation
 */
function steira_page_menu() { ?>
<ul id="navigation">
	<li class="<?php if ( is_front_page() ) { echo 'current_page_item'; } else { echo 'page_item'; } ?>">
		<a href="<?php echo home_url( '/' ); ?>"><?php _e( 'Homepage', 'steira' );?></a>
	</li>
	<?php wp_list_pages( 'title_li=&depth=1' ); ?>
</ul>
<?php }

/**
 * Widget: Steira About Text
 */
class Steira_About_Text extends WP_Widget {

	function Steira_About_Text() {
		$widget_ops = array('classname' => 'widget_steira_about_text', 'description' => __( 'Text or HTML about your site, in the Steira style', 'steira' ) );
		$control_ops = array( 'width' => 400, 'height' => 350 );
		$this->WP_Widget( 'steira_about_text', __( 'Steira "About" Text' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$text = apply_filters( 'widget_steira_about_text', $instance['text'], $instance );
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
			<div class="aboutshort"><?php echo $instance['filter'] ? wpautop($text) : $text; ?></div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = format_to_edit($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $text ); ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs.'); ?></label></p>
<?php
	}
}
register_widget('Steira_About_Text');


/**
 * Widget: Steira Categories
 */
class Steira_Categories extends WP_Widget {
	function Steira_Categories() {
		$widget_ops = array('classname' => 'widget_steira_categories', 'description' => __('A grid of categories in the Steira Style', 'steira'));
		$this->WP_Widget('steira_categories', 'Steira Categories', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? __('Post Categories', 'steira') : apply_filters('widget_title', $instance['title']);

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '<ul id="categoriesgrid">';
		wp_list_categories('order=DESC&orderby=count&title_li=&depth=-1');
		echo '</ul>';
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['entry_title'] = strip_tags($new_instance['entry_title']);
		$instance['comments_title'] = strip_tags($new_instance['comments_title']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
	}
}
register_widget('Steira_Categories');

/**
 * Widget: Steira Recent Comments
 */
class Steira_Recent_Comments extends WP_Widget {

	function Steira_Recent_Comments() {
		$widget_ops = array('classname' => 'widget_steira_recent_comments', 'description' => __( 'The most recent comments in the Steira style' ) );
		$this->WP_Widget('steira-recent-comments', __('Steira Recent Comments'), $widget_ops);
		$this->alt_option_name = 'widget_steira_recent_comments';

		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array(&$this, 'steira_recent_comments_style') );

		add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
	}

	function steira_recent_comments_style() { ?>
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<?php
	}

	function flush_widget_cache() {
		wp_cache_delete( 'steira_recent_comments', 'widget' );
	}

	function widget( $args, $instance ) {
		global $wpdb, $comments, $comment;

		extract($args, EXTR_SKIP);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Comments', 'steira') : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 5;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

		if ( !$comments = wp_cache_get( 'steira_recent_comments', 'widget' ) ) {
			$comments = $wpdb->get_results("SELECT $wpdb->comments.* FROM $wpdb->comments JOIN $wpdb->posts ON $wpdb->posts.ID = $wpdb->comments.comment_post_ID WHERE comment_approved = '1' AND post_status = 'publish' ORDER BY comment_date_gmt DESC LIMIT 15");
			wp_cache_add( 'steira_recent_comments', $comments, 'widget' );
		}

		$comments = array_slice( (array) $comments, 0, $number );
?>
		<?php echo $before_widget; ?>
			<?php if ( $title ) echo $before_title . $title . $after_title; ?>
			<ul id="steira-recent-comments" class="indexlist"><?php
			if ( $comments ) : foreach ( (array) $comments as $comment ) :
			echo  '<li class="recentcomments"><a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '"><span class="name">' . get_comment_author() . '</span><span class="didwhat">' . __('commented on', 'steira')  . '</span><span class="title">' . get_the_title($comment->comment_post_ID) . '</span></a></li>';
			endforeach; endif;?></ul>
		<?php echo $after_widget; ?>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_steira_recent_comments']) )
			delete_option('widget_steira_recent_comments');

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show:'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e('(at most 15)'); ?></small></p>
<?php
	}
}
register_widget('Steira_Recent_Comments');


/**
 * Widget: Steira Recent Posts
 */
class Steira_Recent_Posts extends WP_Widget {
	function Steira_Recent_Posts() {
		$widget_ops = array('classname' => 'widget_steira_recent_posts', 'description' => __('The most recent posts on your blog in the Steira style', 'steira') );
		$this->WP_Widget('steira_recent_posts', __('Steira Recent Posts', 'steira'), $widget_ops);
		$this->alt_option_name = 'widget_steira_recent_posts';

		add_action( 'save_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get( 'widget_steira_recent_posts', 'widget' );

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

		$r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul id="steira-recent-posts" class="indexlist">
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><span class="date"><?php the_time(get_option("date_format")); ?></span> <span class="title"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></span></a></li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
			wp_reset_query();  // Restore global post data stomped by the_post().
		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_add('widget_steira_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_steira_recent_posts']) )
			delete_option('widget_steira_recent_posts');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_steira_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e('(at most 15)'); ?></small></p>
<?php
	}
}
register_widget('Steira_Recent_Posts');


/**
 * Set the content width based on the Theme CSS
 */
$content_width = 470;


/**
 * Custom comments in the Steira style
 */
function steira_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
	// the comments walker will add the closing </li>
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<h4>
				<a class="permlink" title="<?php printf(__('%1$s - %2$s'), get_comment_date('d/m/y'), get_comment_time('g:iA')) ?>" href="#li-comment-<?php comment_ID() ?>"><span class="permlink-text">Permalink </span><span class="hash">#</span></a>
				<span class="name">
					<a href="#">
						<?php echo get_avatar($comment, $size='50'); ?>
						<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
					</a>
				</span>
				<span class="said"><?php _e('said','steira'); ?></span>
				<?php edit_comment_link(__('Edit', 'steira'), ' | ', ''); ?>
			</h4>

			<?php if ($comment->comment_approved == '0') : ?>
			<p><em><?php _e('Your comment is awaiting moderation.') ?></em></p>
			<?php endif; ?>

			<?php comment_text() ?>
		
			<p class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</p>
		</div>
	<?php
}

/**
 * Add the default Steira gravatar
 */
function newgravatar ($avatar_defaults) {
		$myavatar = get_bloginfo('template_directory') . '/img/gravatar.gif';
		$avatar_defaults[$myavatar] = "Steira";
		return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'newgravatar' );

/**
 * Register our widget area
 */
function theme_widgets_init() {
	register_sidebar( array (
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
}
add_action( 'init', 'theme_widgets_init' );

/**
 * filter the search form to match the Steira style
 */
function steira_search_form() {
	$form = '<form method="get" id="searchform" action="' . home_url( '/' ) . '" >';
	$form .= '<p>';
	$form .= '<label for="s">'.__('Search', 'steira').'</label>';
	$form .= '<input name="s" class="text" id="s" type="text" value="Search&hellip;" onfocus="if(this.value == \'Search&hellip;\'){this.value = \'\'}" onblur="if(this.value == \'\'){this.value = \'Search&hellip;\'}" />';
	$form .= '<input id="searchsubmit" class="submit" type="submit" value="'.__('Go', 'steira').'" />';
	$form .= '</p>';
	$form .= '</form>';

	return $form;
}
add_filter('get_search_form', 'steira_search_form');

/**
 * 	Make this theme available for translation
 *	Translations can be filed in the /languages/ directory
 */
load_theme_textdomain( 'steira', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);
