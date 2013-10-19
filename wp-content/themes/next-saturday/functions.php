<?php
/**
 * @package WordPress
 * @subpackage Next Saturday
 */

 // Load scripts
function next_saturday_scripts() {
	if ( ! is_singular() || ( is_singular() && 'audio' == get_post_format() ) ) :
		wp_enqueue_script( 'audio-player', get_template_directory_uri() . '/js/audio-player.js', array( 'jquery' ), '20110801' );
	endif;
	if ( is_singular() && get_option( 'thread_comments' ) ) :
		 wp_enqueue_script( 'comment-reply' );
	endif;
}
add_action( 'wp_enqueue_scripts', 'next_saturday_scripts' );

/**
 * Set the maximum content width of the normal content column.
 * This prevents large images from overrunning the sides of the column.
 */
if ( ! isset( $content_width ) )
	$content_width = 510;

// Action hook to do all the major theme setup stuff
add_action( 'after_setup_theme', 'next_saturday_setup' );

/**
 * Tell WordPress to run next_saturday_setup() when the 'after_setup_theme' hook is run.
 */
function next_saturday_setup() {

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme supports post formats.
	add_theme_support( 'post-formats', array( 'aside', 'chat', 'audio', 'image', 'quote', 'gallery', 'video', 'link' ) );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'next-saturday', TEMPLATEPATH . '/languages' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'next-saturday' ),
	) );

	// This theme allows users to set a custom background.
	add_custom_background();

	// This theme allows users to upload a custom header.
	define( 'HEADER_TEXTCOLOR', 'f3d769' );
	define( 'HEADER_IMAGE', '' );
	define( 'HEADER_IMAGE_WIDTH', 615 ); // use width and height appropriate for your theme
	define( 'HEADER_IMAGE_HEIGHT', 85 );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See mystique_admin_header_style(), below.
	add_custom_image_header( 'next_saturday_header_style', 'next_saturday_admin_header_style' );

}

/**
* Add custom header support
*/
/**
 * Styles the header image and text displayed on the blog
 *
 */
function next_saturday_header_style() {
	// If no custom options for text are set, let's bail
	if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Do we have a custom header image?
		if ( '' != get_header_image() ) :
	?>
		#site-title {
			margin: 0;
		}
		#title-wrapper {
			background: url(<?php header_image(); ?>) no-repeat;
			min-height: 85px;
			margin: auto 0;
			padding: 25px 0 0 10px;
			width: 615px;
		}
		<?php if ( is_rtl() ) : ?>
		#title-wrapper {
			padding-left: 0;
	    	text-align: center;
		}
		<?php endif;

		endif;

		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-title {
 	 		position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a {
			background: none !important;
			border: 0 !important;
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in next_saturday_setup().
 *
 */
function next_saturday_admin_header_style() { ?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		background-color: #6ab690;
		border: none;
		height: auto !important;
		text-align: left;

	}
	#headimg h1 {
		font-family: Verdana, sans-serif;
		line-height: 69px;
		min-height: 85px;
		padding: 25px 0 25px 10px;
		width: 615px;
	}
	#headimg h1 a {
		color: #f3d769;
		display: block;
		font-size: 64px;
		font-weight: bold;
		text-decoration: none;
		text-shadow: 0 1px 0 #4d8c6d;
	}
	#desc {
		display: none;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( HEADER_TEXTCOLOR != get_header_textcolor() ) :
	?>
		#site-title a {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	</style>
<?php
}

/**
 * Register widgetized area and update sidebar with default widgets
 */
function next_saturday_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Default sidebar', 'next-saturday' ),
		'id' => 'sidebar-1',
		'description' => __( 'The primary widget area.', 'next-saturday' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>'
	) );
}
add_action( 'init', 'next_saturday_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 */
function next_saturday_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'next_saturday_remove_recent_comments_style' );

/**
 * Prints HTML with meta information for the fancy display of the current post's month and day
 */
function next_saturday_entry_date() {
	printf( __( '<div class="entry-date-wrapper"><div class="entry-date"><p class="entry-day"><a href="%1$s" class="entry-date-link" title="%2$s" rel="bookmark">%3$s</a></p><p class="entry-month"><a href="%1$s" class="entry-date-link" title="%2$s" rel="bookmark">%4$s. &rsquo;%5$s</a></p></div><div class="entry-date-bottom"></div><div class="entry-date-shadow"></div></div>', 'next-saturday' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_time( 'd' ) ),
		esc_attr( get_the_time( 'M' ) ),
		esc_attr( get_the_time( 'y' ) )
	);
}

/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 */
function next_saturday_entry_meta() {
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( '<span class="by-author"> <span class="sep"> Posted by </span> <span class="author vcard"><a class="url fn n" href="%3$s" title="%4$s" rel="author">%5$s</a></span></span>. <span class="posted-in">Categories: %1$s. Tags: %2$s. </span>', 'next-saturday' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( '<span class="by-author"> <span class="sep"> Posted by </span> <span class="author vcard"><a class="url fn n" href="%3$s" title="%4$s" rel="author">%5$s</a></span></span>. <span class="posted-in">Categories: %1$s.</span>', 'next-saturday' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'next-saturday' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}

/**
 * Display navigation to next/previous pages when applicable
 */
function next_saturday_content_nav( $nav_id ) {
	global $wp_query;

	if (  $wp_query->max_num_pages > 1 ) : ?>
	<nav id="<?php echo $nav_id; ?>">
		<h3 class="assistive-text"><?php _e( 'Post navigation', 'next-saturday' ); ?></h3>
		<span class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older <span>posts</span>', 'next-saturday' ) ); ?></span>
		<span class="nav-next"><?php previous_posts_link( __( 'Newer <span>posts</span> <span class="meta-nav">&rarr;</span>', 'next-saturday' ) ); ?></span>
	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php endif;
}

/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function next_saturday_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="pingback">
		<p><?php _e( 'Pingback:', 'next-saturday' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'next-saturday' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 50;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'next-saturday' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'next-saturday' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( '[Edit]', 'next-saturday' ), ' ' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'next-saturday' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply &darr;', 'next-saturday' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}

/**
 * Filter the_content for post formats, and add extra presentational markup as needed.
 *
 * @param string the_content
 * @return string Updated content with extra markup.
 */
function next_saturday_the_content( $content ) {
	global $post;
	$format = get_post_format();
	if ( ! $format )
		return $content;

	switch ( $format ) {
		case 'image':
			$first_image = wpcom_themes_image_grabber( $post->ID, $content, '<div class="image-wrapper">', '</div>' );
			if ( $first_image )
				$content = preg_replace( WPCOM_THEMES_IMAGE_REPLACE_REGEX, $first_image, $content, 1 );
			break;
		default:
			break;
	}

	return $content;
}
if ( ! is_admin() )
	add_filter( 'the_content', 'next_saturday_the_content', 11 );

// Add in-head JS block for audio post format
function next_saturday_add_audio_support() {
	if ( ! is_singular() || ( is_singular() && 'audio' == get_post_format() ) ) {
?>
		<script type="text/javascript">
			AudioPlayer.setup( "<?php echo get_template_directory_uri(); ?>/swf/player.swf", {
				transparentpagebg: "yes",
				bg: "448b69",
				leftbg: "357d5c",
				rightbg: "357d5c",
				rightbghover: "4d9472",
				track: "448b69",
				text: "ffffff",
				lefticon: "f3d769",
				righticon: "f3d769",
				righticonhover: "fdeaa2",
				lefticonhover: "fdeaa2",
				border: "448b69",
				tracker: "000000",
				loader: "666666"
			});
		</script>
<?php }
}
add_action( 'wp_head', 'next_saturday_add_audio_support' );

// Define common regex lookup patterns
if ( ! defined( 'NEXT_SATURDAY_THEMES_IMAGE_REGEX' ) )
	define( 'NEXT_SATURDAY_THEMES_IMAGE_REGEX', '/(<img.+src=[\'"]([^\'"]+)[\'"].*?>)/i' );
if ( ! defined( 'NEXT_SATURDAY_THEMES_IMAGE_REPLACE_REGEX' ) )
	define( 'NEXT_SATURDAY_THEMES_IMAGE_REPLACE_REGEX', '/\[caption.*\[\/caption\]|<img[^>]+./' );

/**
 * Return the HTML output for first image found for a post.
 *
 * @param int post_id ID for parent post
 * @param string the_content
 * @param string before Optional before string
 * @param string after Optional after string
 * @return boolean|string HTML output or false if no match
 */
function next_saturday_themes_image_grabber( $post_id, $the_content = '', $before = '', $after = '' ) {
	global $wpdb;
	$image_src = '';
	if ( empty( $the_content ) )
		$the_content = get_the_content();

	$first_image = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'attachment' AND INSTR(post_mime_type, 'image') ORDER BY menu_order ASC LIMIT 0,1", (int) $post_id ) );

	if ( ! empty( $first_image ) ) {
		// We have an attachment, so just use its data.
		$image_src = wp_get_attachment_image( $first_image, 'image' );
	} else {
		// Try to get the image for the linked image (not attached)
		$output = preg_match( NEXT_SATURDAY_THEMES_IMAGE_REGEX, $the_content, $matches );
		if ( isset( $matches[0] ) )
			$image_src = $matches[0];
	}

	if ( ! empty( $image_src ) ) {
		// Add wrapper markup, if specified
		if ( ! empty( $before ) )
			$image_src = $before . $image_src;
		if ( ! empty( $after ) )
			$image_src = $image_src . $after;

		return $image_src;
	}

	return false;
}

/**
 * Return the first audio file found for a post.
 *
 * @param int post_id ID for parent post
 * @return boolean|string Path to audio file
 */
function next_saturday_themes_audio_grabber( $post_id ) {
	global $wpdb;

	$first_audio = $wpdb->get_var( $wpdb->prepare( "SELECT guid FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'attachment' AND INSTR(post_mime_type, 'audio') ORDER BY menu_order ASC LIMIT 0,1", (int) $post_id ) );

	if ( ! empty( $first_audio ) )
		return $first_audio;

	return false;
}
/**
 * Return the URL for the first link found in this post.
 *
 * @param string the_content Post content, falls back to current post content if empty.
 * @return string|bool URL or false when no link is present.
 */
function next_saturday_themes_url_grabber( $the_content = '' ) {
	if ( empty( $the_content ) )
		$the_content = get_the_content();
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', $the_content, $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}
