<?php
/**
 * @package WordPress
 * @subpackage Beach
 */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 * If you're building a theme based on beach, use a find and replace
 * to change 'beach' to the name of your theme in all the template files
 */
load_theme_textdomain( 'beach', get_template_directory() . '/languages' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 530;

/**
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.compat.php' );

/**
 * Set $themecolors array.
 */
$themecolors = array(
	'bg' => 'F1F6F9',
	'text' => '333333',
	'link' => 'EE6633',
	'border' => '296684',
	'url' => '4499BB',
);

/**
 * This theme uses wp_nav_menu() in one location.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'beach' ),
	'secondary' => __( 'Secondary Menu', 'beach' ),
) );

/**
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Add Post Format support
 */
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'quote', 'status' ) );

add_theme_support( 'print-style' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function beach_page_menu_args($args) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'beach_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function beach_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar', 'beach' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

}
add_action( 'init', 'beach_widgets_init' );

/**
 * Display navigation to next/previous pages when applicable
 */
function beach_content_nav($nav_id) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h1 class="section-heading"><?php _e( 'Post navigation', 'beach' ); ?></h1>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'beach' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'beach' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}

/**
 * Returns a "Continue Reading" link for excerpts
 */
function beach_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'beach' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and beach_continue_reading_link().
 */
function beach_auto_excerpt_more( $more ) {
	return ' &hellip;' . beach_continue_reading_link();
}
add_filter( 'excerpt_more', 'beach_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
function beach_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= beach_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'beach_custom_excerpt_more' );

function beach_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 90 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'beach' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'beach' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'beach' ), get_comment_date(),  get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'beach' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content">
				<?php comment_text(); ?>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</div>

		</article><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'beach' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'beach'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a Toolbox.
 */