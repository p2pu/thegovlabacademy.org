<?php
/**
 * Sundance functions and definitions
 *
 * @package Sundance
 * @since Sundance 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Sundance 1.0
 */
// Set the content width based on the theme's design and stylesheet.
function sundance_set_content_width() {
	$options = sundance_get_theme_options();
	global $content_width;
	if ( is_page_template( 'full-width-page.php' )
		|| is_attachment()
		|| ( 'off' == $options['show_rss_link']
			&& ''  == $options['twitter_url']
			&& ''  == $options['facebook_url']
			&& ''  == $options['google_url']
			&& ''  == $options['flickr_url']
			&& ! is_active_sidebar( 'sidebar-1' ) )
		)
		$content_width = 874;
	else
		$content_width = 652;
}
add_action( 'template_redirect', 'sundance_set_content_width' );

if ( ! function_exists( 'sundance_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Sundance 1.0
 */
function sundance_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Sundance, use a find and replace
	 * to change 'sundance' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sundance', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sundance' ),
	) );

	/**
	 * This theme allows users to set a custom background.
	 */
	add_custom_background();

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'video' ) );

}
endif; // sundance_setup
add_action( 'after_setup_theme', 'sundance_setup' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Sundance 1.0
 */
function sundance_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'sundance' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'sundance_widgets_init' );

/**
 * Enqueue scripts
 */
function sundance_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_style( 'sundance-droid-serif', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' );

	wp_enqueue_script( 'jquery' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', 'jquery', '20120202' );
	}
	wp_enqueue_script( 'sundance-small-menu', get_template_directory_uri() . '/js/small-menu.js', 'jquery', '20120305', true );

	wp_enqueue_script( 'sundance-fit-vids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', '20120213', true );

	wp_enqueue_script( 'sundance-flex-slider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', 'jquery', '20120213', true );

	wp_enqueue_script( 'sundance-theme', get_template_directory_uri() . '/js/theme.js', 'jquery', '20120213', true );

}
add_action( 'wp_enqueue_scripts', 'sundance_scripts' );

// Background style for front-end.
function sundance_custom_background() {
	if ( '' != get_background_color() && '' == get_background_image() ) : ?>
	<style type="text/css">
		body {
			background: none;
		}
	</style>
	<?php endif;

	if ( '' != get_background_image() ) : ?>
	<style type="text/css">
		#page {
			background: url(<?php echo get_template_directory_uri(); ?>/images/bg.jpg) repeat 0 0;
		}
	</style>
	<?php endif;
}
add_action( 'wp_head', 'sundance_custom_background' );