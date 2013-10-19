<?php
/**
 * @package Esquire
 */

/**
 * Load Esquire scripts
 */
function esquire_scripts() {
	wp_enqueue_script( 'esquire', get_template_directory_uri() .'/js/esquire.js', 'jquery', '2011-07-29' );
	if ( ! is_singular() || ( is_singular() && 'audio' == get_post_format() ) )
		wp_enqueue_script( 'audio-player', get_template_directory_uri() . '/js/audio-player.js', array( 'jquery'), '20110801' );
}
add_action( 'wp_enqueue_scripts', 'esquire_scripts' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 560;

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 */
load_theme_textdomain( 'esquire', get_template_directory_uri() . '/languages' );

$locale = get_locale();
$locale_file = get_template_directory_uri() . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Add feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * This theme uses wp_nav_menu() in one location.
 */
register_nav_menus( array(
	'primary' => __( 'Main Menu', 'esquire' ),
) );

/**
 * Enable Post Formats
 */
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'link', 'audio', 'video' ) );

/**
 * Sniff out the number of categories in use and return the number of categories
 */
function esquire_category_counter() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	return $all_the_cool_cats;
}

/**
 * Flush out the transients used in esquire_category_counter
 */
function esquire_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'esquire_category_transient_flusher' );
add_action( 'save_post', 'esquire_category_transient_flusher' );

/**
 * Add a class to the Older Posts link
 */
function esquire_next_posts_link_attributes( $attr ) {
	$attr = 'rel="prev"';

	return $attr;
}
add_filter( 'next_posts_link_attributes', 'esquire_next_posts_link_attributes' );

/**
 * Add a class to the Newer Posts link
 */
function esquire_previous_posts_link_attributes( $attr ) {
	$attr = 'rel="next"';

	return $attr;
}
add_filter( 'previous_posts_link_attributes', 'esquire_previous_posts_link_attributes' );

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function esquire_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'esquire_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function esquire_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '"><em>' .__( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'esquire' ) . '</em></a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and esquire_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function esquire_auto_excerpt_more( $more ) {
	return ' &hellip;' . esquire_continue_reading_link();
}
add_filter( 'excerpt_more', 'esquire_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function esquire_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= esquire_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'esquire_custom_excerpt_more' );

/**
 * Register our footer widget area
 *
 * @since Esquire 1.0
 */
function esquire_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Footer', 'esquire' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'esquire_widgets_init' );

/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Esquire 1.0
 */
function esquire_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'esquire' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'esquire' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 16;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'esquire' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'esquire' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'esquire' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'esquire' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'esquire' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
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
function esquire_the_content( $content ) {
	global $post;
	$format = get_post_format();
	if ( ! $format )
		return $content;

	switch ( $format ) {
		case 'image':
			$first_image = wpcom_themes_image_grabber( $post->ID, $content, '<div class="frame"><div class="wrapper">', '</div></div>' );
			if ( $first_image )
				$content = preg_replace( WPCOM_THEMES_IMAGE_REPLACE_REGEX, $first_image, $content, 1 );
			break;
		default:
			break;
	}

	return $content;
}
if ( ! is_admin() )
	add_filter( 'the_content', 'esquire_the_content', 11 );

/**
 * Add extra markup to VideoPress embeds.
 *
 * @param string html Video content from VideoPress plugin.
 * @return string Updated content with extra markup.
 */
function esquire_video_embed_html( $html ) {
	$html = '<div class="frame"><div class="player">' . $html . '</div></div>';
	return $html;
}

/**
 * Add extra markup to auto-embedded videos.
 *
 * @param string html Content from the auto-embed plugin.
 * @param string url Link embedded in the post, used to determine if this is a video we want to filter.
 * @return string Updated content with extra markup.
 */
function esquire_check_video_embeds( $html, $url ) {
	if ( false !== ( strstr( $url, 'youtube' ) ) || false !== ( strstr( $url, 'vimeo' ) ) )
		$html = esquire_video_embed_html( $html );
	return $html;
}

// Add post thumbnail support for audio album art
add_theme_support( 'post-thumbnails' );
add_image_size( 'audio', 207, 207, false );

// Add in-head JS block for audio post format
function esquire_add_audio_support() {
	if ( ! is_singular() || ( is_singular() && 'audio' == get_post_format() ) ) {
?>
		<script type="text/javascript">
		/* <![CDATA[ */
			AudioPlayer.setup( "<?php echo get_template_directory_uri(); ?>/swf/player.swf", {
				bg: "222222",
				leftbg: "444444",
				rightbg: "444444",
				track: "222222",
				text: "ffffff",
				lefticon: "eeeeee",
				righticon: "eeeeee",
				border: "222222",
				tracker: "3d87cb",
				loader: "666666"
			});
		/* ]]> */
		</script>
<?php }
}
add_action( 'wp_head', 'esquire_add_audio_support' );

/**
 * Return the URL for the first link found in this post.
 *
 * @param string the_content Post content, falls back to current post content if empty.
 * @return string|bool URL or false when no link is present.
 */
function wpcom_themes_url_grabber( $the_content = '' ) {
	if ( empty( $the_content ) )
		$the_content = get_the_content();
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', $the_content, $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

// Define common regex lookup patterns
if ( ! defined( 'WPCOM_THEMES_IMAGE_REGEX' ) )
	define( 'WPCOM_THEMES_IMAGE_REGEX', '/(<img.+src=[\'"]([^\'"]+)[\'"].*?>)/i' );
if ( ! defined( 'WPCOM_THEMES_IMAGE_REPLACE_REGEX' ) )
	define( 'WPCOM_THEMES_IMAGE_REPLACE_REGEX', '/\[caption.*\[\/caption\]|<img[^>]+./' );
if ( ! defined( 'WPCOM_THEMES_VIDEO_REGEX' ) ) {
	// iframe: <iframe[^>]*+></iframe>
	define( 'WPCOM_THEMES_VIDEO_REGEX', '#(<object[^>]*+>(?>[^<]*+(?><(?!/object>)[^<]*+)*)</object>|<embed[^>]*+>(?:\s*</embed>)?)#i' );
}

/**
 * Return the HTML output for first image found for a post.
 *
 * @param int post_id ID for parent post
 * @param string the_content
 * @param string before Optional before string
 * @param string after Optional after string
 * @return boolean|string HTML output or false if no match
 */
function wpcom_themes_image_grabber( $post_id, $the_content = '', $before = '', $after = '' ) {
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
		$output = preg_match( WPCOM_THEMES_IMAGE_REGEX, $the_content, $matches );
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
 * Return the HTML output for the first video found for a post.
 *
 * @param string the_content
 * @param string before Optional before string
 * @param string after Optional after string
 * @return boolean|string HTML output or false if no match
 */
function wpcom_themes_video_grabber( $the_content = '', $before = '', $after = '' ) {
	$first_video = '';
	if ( empty( $the_content ) )
		$the_content = get_the_content();

	// Try to get the markup for the first video in this post
	$output = preg_match( WPCOM_THEMES_VIDEO_REGEX, $the_content, $matches );
	if ( isset( $matches[0] ) )
		$first_video = $matches[0];

	if ( ! empty( $first_video ) ) {
		// Add wrapper markup, if specified
		if ( ! empty( $before ) )
			$first_video = $before . $first_video;
		if ( ! empty( $after ) )
			$first_video = $first_video . $after;

		return $first_video;
	}

	return false;
}

/**
 * Return the first audio file found for a post.
 *
 * @param int post_id ID for parent post
 * @return boolean|string Path to audio file
 */
function wpcom_themes_audio_grabber( $post_id ) {
	global $wpdb;

	$first_audio = $wpdb->get_var( $wpdb->prepare( "SELECT guid FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'attachment' AND INSTR(post_mime_type, 'audio') ORDER BY menu_order ASC LIMIT 0,1", (int) $post_id ) );

	if ( ! empty( $first_audio ) )
		return $first_audio;

	return false;
}