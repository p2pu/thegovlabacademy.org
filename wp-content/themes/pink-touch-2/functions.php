<?php
/**
 * @package WordPress
 * @subpackage Pink Touch 2
 */

 // Load scripts.
function pinktouch_scripts() {
	if ( ! is_singular() || ( is_singular() && 'audio' == get_post_format() ) )
		wp_enqueue_script( 'audio-player', get_template_directory_uri() . '/js/audio-player.js', array( 'jquery' ), '20110801' );
}
add_action( 'wp_enqueue_scripts', 'pinktouch_scripts' );

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 510;

// Tell WordPress to run pinktouch_setup() when the 'after_setup_theme' hook is run.
add_action( 'after_setup_theme', 'pinktouch_setup' );

function pinktouch_setup() {

	load_theme_textdomain( 'pinktouch', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'pinktouch' ) );

	// Add default posts and comments RSS feed links to head.

	add_theme_support( 'automatic-feed-links' );

	// Enable Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'link', 'chat', 'audio', 'video' ) );

	// Add support for custom backgrounds.
	add_custom_background();

	// The default header text color
	define( 'HEADER_TEXTCOLOR', '000000' );
	define( 'HEADER_IMAGE', '' );
	define( 'HEADER_IMAGE_WIDTH', 690 );
	define( 'HEADER_IMAGE_HEIGHT', 185 );

	/**
	 * Add a way for the custom header to be styled in the admin panel that controls custom headers.
	 * See pinktouch_admin_header_style(), below.
	 */
	add_custom_image_header( 'pinktouch_header_style', 'pinktouch_admin_header_style' );
}

// Header style for front-end.
function pinktouch_header_style() {
	if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
		return;
	?>
	<style type="text/css">
	<?php if ( '' != get_header_image() ) : ?>
		#header {
			background: url(<?php echo get_header_image(); ?>) no-repeat;
		}
	<?php endif; ?>
	<?php if ( 'blank' == get_header_textcolor() ) : ?>
		#header h1,
		#description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php else : ?>
		#header h1 a,
		#description p {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}

// Styles the header image displayed on the Appearance > Header admin panel.
function pinktouch_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		background-color: <?php echo ( '' != get_background_color() ? ' #' .get_background_color() : 'transparent' ); ?>;
		<?php
			if ( '' == get_header_image() && '' == get_background_color() )
			echo 'background: url(' . get_template_directory_uri() . '/images/bg.jpg) repeat fixed !important;';
		?>
		border: none;
		height: 185px;
		text-align: center;
	}
	#headimg h1 {
		font-family: "MuseoSlab500", "Helvetica Neue", Helvetica, sans-serif;
		font-size: 40px;
		font-weight: normal;
		padding: 44px 0 0 0;
		line-height: 44px;
		margin: 0;
	}
	#headimg h1 a {
		font-family: sans-serif;
		text-decoration: none;
	}
	#desc {
		font-family: Cambria,Georgia,Times,serif;
		font-size: 18px;
		font-style: italic;
		line-height: 24px;
		margin: 4px 0 0 0;
	}
	</style>
<?php
}

// Background style for front-end.
function pinktouch_custom_background() {
	if ( '' != get_background_color() && '' == get_background_image() ) : ?>
	<style type="text/css">
		body {
			background: #<?php echo get_background_color(); ?>;
		}
	</style>
	<?php endif;
}
add_action( 'wp_head', 'pinktouch_custom_background' );

// Sniff out the number of categories in use and return the number of categories.
function pinktouch_category_counter() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	return $all_the_cool_cats;
}

// Register widgetized area and update sidebar with default widgets.
function pinktouch_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Footer Area One', 'pinktouch' ),
		'id' => 'sidebar-1',
		'description' => __( 'An optional widget in the footer', 'pinktouch' ),
		'before_widget' => '<div id="%1$s" class="clearfix widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'pinktouch' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional widget in the footer', 'pinktouch' ),
		'before_widget' => '<div id="%1$s" class="clearfix widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'pinktouch' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget in the footer', 'pinktouch' ),
		'before_widget' => '<div id="%1$s" class="clearfix widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'pinktouch_widgets_init' );

// Show post data for use in loop.
function pinktouch_post_data() { ?>
	<div class="info">
		<?php if ( 1 != pinktouch_category_counter() && is_multi_author() ) : ?>
			<p class="category-list">
				<?php
					printf( __ ( 'Posted by <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span> in %4$s', 'pinktouch' ),
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						esc_attr( sprintf( __( 'View all posts by %s', 'pinktouch' ), get_the_author() ) ),
						esc_html( get_the_author() ),
						get_the_category_list( __( ', ', 'pinktouch' ) )
					);
				?>
			</p>
		<?php elseif ( is_multi_author() ) : ?>
			<p class="category-list">
				<?php
					printf( __ ( 'Posted by <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 'pinktouch' ),
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						esc_attr( sprintf( __( 'View all posts by %s', 'pinktouch' ), get_the_author() ) ),
						esc_html( get_the_author() )
					);
				?>
			</p>
		<?php elseif ( 1 != pinktouch_category_counter() ) : ?>
			<p class="category-list">
				<?php
					printf( __ ( 'Posted in %s', 'pinktouch' ),
						get_the_category_list( __( ', ', 'pinktouch' ) )
					);
				?>
			</p>
		<?php endif; ?>

		<?php the_tags( __( '<p class="tag-list">Tags: ', 'pinktouch' ), ', ', '</p>' ); ?>

		<p>
			<span class="permalink"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'pinktouch' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e( 'Permalink', 'pinktouch' ); ?></a></span>

			<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
				<span class="notes"><?php comments_popup_link( __( 'Leave a comment', 'pinktouch' ), __( '1 Comment', 'pinktouch' ), __( '% Comments', 'pinktouch' ) ); ?></span>
			<?php endif; ?>
		</p>

		<?php edit_post_link( __( 'Edit', 'pinktouch' ), '<p>', '</p>' ); ?>
	</div>
<?php
}

// Display navigation to next/previous pages when applicable.
function pinktouch_content_nav() {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="pagination" >
			<p class="clearfix">
				<?php next_posts_link( __( '<span class="older"><span class="meta-nav">&larr;</span> Older posts</span>', 'pinktouch' ) ); ?>
				<?php previous_posts_link( __( '<span class="newer">Newer posts <span class="meta-nav">&rarr;</span></span>', 'pinktouch' ) ); ?>
			</p>
		</div>
	<?php endif;
}

// Count the number of footer sidebars to enable dynamic classes for the footer.
function pinktouch_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-1' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-2' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="clearfix ' . $class . '"';
}

// Returns a "Continue Reading" link for excerpts.
function pinktouch_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pinktouch' ) . '</a>';
}

// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and pinktouch_continue_reading_link().
function pinktouch_auto_excerpt_more( $more ) {
	return ' &hellip;' . pinktouch_continue_reading_link();
}
add_filter( 'excerpt_more', 'pinktouch_auto_excerpt_more' );

// Adds a pretty "Continue Reading" link to custom post excerpts.
function pinktouch_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= pinktouch_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'pinktouch_custom_excerpt_more' );

// Show author info.
function pinktouch_author_info() { ?>
	<div id="author-info" class="clearfix">
		<div id="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'pinktouch_author_bio_avatar_size', 68 ) ); ?>
		</div><!-- #author-avatar -->
		<div id="author-description">
			<h3><?php esc_html( printf( __( 'About %s', 'pinktouch' ), get_the_author() ) ); ?></h3>
			<?php the_author_meta( 'description' ); ?>
			<div id="author-link">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
					<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'pinktouch' ), get_the_author() ); ?>
				</a>
			</div><!-- #author-link	-->
		</div><!-- #author-description -->
	</div><!-- #entry-author-info -->
<?php
}

// Add in-head JS block for audio post format.
function pinktouch_add_audio_support() {
	if ( ! is_singular() || ( is_singular() && 'audio' == get_post_format() ) ) {
?>
		<script type="text/javascript">
			AudioPlayer.setup( "<?php echo get_template_directory_uri(); ?>/swf/player.swf", {
				bg: "111111",
				leftbg: "111111",
				rightbg: "111111",
				track: "222222",
				text: "ffffff",
				lefticon: "eeeeee",
				righticon: "eeeeee",
				border: "222222",
				tracker: "eb374b",
				loader: "666666"
			});
		</script>
<?php }
}
add_action( 'wp_head', 'pinktouch_add_audio_support' );

/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function pinktouch_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="pingback" id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'pinktouch' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'pinktouch' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-author vcard">
				<?php
					$avatar_size = 48;
					echo get_avatar( $comment, $avatar_size );
					printf( __( '<cite class="fn">%s</cite>', 'pinktouch' ),
						get_comment_author_link()
					);
				?>
			</div><!-- .comment-author .vcard -->
			<div class="comment-meta commentmetadata">
				<?php
					printf( __( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>', 'pinktouch' ),
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'pinktouch' ), get_comment_date(), get_comment_time() )
					);
				?>
				<?php edit_comment_link( __( '(Edit)', 'pinktouch' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .comment-meta .commentmetadata -->

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'pinktouch' ); ?></em>
				<br />
			<?php endif; ?>

			<?php comment_text(); ?>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'pinktouch' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #div-comment-## -->

	<?php
			break;
	endswitch;
}

// Enqueue font styles.
function pinktouch_fonts() {
	wp_enqueue_style( 'arvo', 'http://fonts.googleapis.com/css?family=Arvo:400,700' );
}
add_action( 'wp_enqueue_scripts', 'pinktouch_fonts' );

/**
 * Return the URL for the first link found in this post.
 *
 * @param string the_content Post content, falls back to current post content if empty.
 * @return string|bool URL or false when no link is present.
 */
function pinktouch_url_grabber( $the_content = '' ) {
	if ( empty( $the_content ) )
		$the_content = get_the_content();
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', $the_content, $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

/**
 * Return the first audio file found for a post.
 *
 * @param int post_id ID for parent post
 * @return boolean|string Path to audio file
 */
function pinktouch_audio_grabber( $post_id ) {
	global $wpdb;

	$first_audio = $wpdb->get_var( $wpdb->prepare( "SELECT guid FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'attachment' AND INSTR(post_mime_type, 'audio') ORDER BY menu_order ASC LIMIT 0,1", (int) $post_id ) );

	if ( ! empty( $first_audio ) )
		return $first_audio;

	return false;
}