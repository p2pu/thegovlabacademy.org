<?php
/**
 * @package WordPress
 * @subpackage Duster
 */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 * If you're building a theme based on Duster, use a find and replace
 * to change 'duster' to the name of your theme in all the template files
 */
load_theme_textdomain( 'duster', get_template_directory() . '/languages' );

$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;

/**
 * Set the $themecolors array.
 */
$themecolors = array(
	'bg' => 'ffffff',
	'text' => '333333',
	'link' => '1b8be0',
	'border' => 'eeeeee',
	'url' => '71baf1',
);

/**
 * This theme uses wp_nav_menu() in one location.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'duster' ),
) );

/**
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Add support for an Aside Post Format
 */
add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote' ) );

/**
 * Add support for custom backgrounds
 */
add_custom_background();

// This theme uses Feature Images for per-post/per-page Custom Header images
add_theme_support( 'post-thumbnails' );

/**
 * Add support for Custom Headers
 */
define( 'HEADER_TEXTCOLOR', '000' );

// No CSS, just an IMG call. The %s is a placeholder for the theme template directory URI.
define( 'HEADER_IMAGE', '%s/images/headers/default.jpg' );

// The height and width of your custom header. You can hook into the theme's own filters to change these values.
// Add a filter to duster_header_image_width and duster_header_image_height to change these values.
define( 'HEADER_IMAGE_WIDTH', apply_filters( 'duster_header_image_width', 1000 ) );
define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'duster_header_image_height', 300 ) );

// We'll be using post thumbnails for custom header images on posts and pages.
// We want them to be 940 pixels wide by 198 pixels tall.
// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

// Add a way for the custom header to be styled in the admin panel that controls
// custom headers. See duster_admin_header_style(), below.
add_custom_image_header( 'duster_header_style', 'duster_admin_header_style', 'duster_admin_header_image' );

// ... and thus ends the changeable header business.

if ( ! function_exists( 'duster_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Duster 1.0
 */
function duster_header_style() {
	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;

if ( ! function_exists( 'duster_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in duster_setup().
 *
 * @since Duster 1.0
 */
function duster_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 32px;
		line-height: 36px;
		text-decoration: none;
	}
	#desc {
		font-size: 14px;
		line-height: 23px;
		padding: 0 0 3em;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 1000px;
		height: auto;
		width: 100%;
	}
	</style>
<?php
}
endif;

if ( ! function_exists( 'duster_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in duster_setup().
 *
 * @since Duster 1.0
 */
function duster_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<img src="<?php esc_url ( header_image() ); ?>" alt="" />
	</div>
<?php }
endif;

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function duster_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'duster_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function duster_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'duster' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and duster_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function duster_auto_excerpt_more( $more ) {
	return ' &hellip;' . duster_continue_reading_link();
}
add_filter( 'excerpt_more', 'duster_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function duster_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= duster_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'duster_custom_excerpt_more' );


/**
 * Add Duster's custom image sizes
 */
add_image_size( 'large-feature', HEADER_IMAGE_WIDTH, 500, true ); // Used for large feature images
add_image_size( 'small-feature', 500, 500 ); // Used for featured posts if a large-feature doesn't exist

/**
 * Add custom body classes
 */
function duster_body_class($classes) {
	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'duster_body_class' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function duster_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'duster_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function duster_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'duster' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Showcase Sidebar', 'duster' ),
		'id' => 'sidebar-2',
		'description' => __( 'The sidebar for the optional Showcase Template', 'duster' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'duster' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'duster' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'duster' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'duster' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'duster' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'duster' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

}
add_action( 'init', 'duster_widgets_init' );

/**
 * Grab Duster's Custom Widgets
 */
require( dirname( __FILE__ ) . '/inc/widgets.php' );

/**
 * Display navigation to next/previous pages when applicable
 */
function duster_content_nav($nav_id) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h1 class="section-heading"><?php _e( 'Post navigation', 'duster' ); ?></h1>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'duster' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'duster' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}

/**
 * Grab the first URL from a Link post
 */
function duster_url_grabber() {
	global $post, $posts;

	$first_url = '';

	ob_start();
	ob_end_clean();

	$output = preg_match_all('/<a.+href=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

	$first_url = $matches [1] [0];

	if ( empty( $first_url ) )
		return false;

	return $first_url;
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function duster_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

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

		default:
			$class = '';
			break;
	}

	if ( '' != $class )
		echo 'class="' . $class . '"';
}

if ( ! function_exists( 'duster_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own duster_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Duster 0.4
 */
function duster_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						printf( __( '%1$s on %2$s%3$s at %4$s%5$s <span class="says">said:</span>', 'duster' ),
							sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ),
							'<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '"><time pubdate datetime="' . get_comment_time( 'c' ) . '">',
							get_comment_date(),
							get_comment_time(),
							'</time></a>'
						);
					?>

					<?php edit_comment_link( __( '[Edit]', 'duster' ), ' ' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'duster' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply &darr;', 'duster' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'duster' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'duster' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif; // ends check for duster_comment()