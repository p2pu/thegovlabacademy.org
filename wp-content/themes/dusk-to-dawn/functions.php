<?php
/**
 * @package Dusk To Dawn
 */

// Load scripts.
function dusktodawn_scripts() {
	if ( ! is_singular() || ( is_singular() && 'audio' == get_post_format() ) )
		wp_enqueue_script( 'audio-player', get_template_directory_uri() . '/js/audio-player.js', array( 'jquery' ), '20110801' );
}
add_action( 'wp_enqueue_scripts', 'dusktodawn_scripts' );

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 474;

if ( ! function_exists( 'dusktodawn_setup' ) ):

function dusktodawn_setup() {

	load_theme_textdomain( 'dusktodawn', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable Post Thumbnail and add two custom sizes
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'dusktodawn-featured-image', 588, 9999, false );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'sidebar-menu' => __( 'Sidebar Menu', 'dusktodawn' ),
	) );

	// Add support for the Aside and Gallery Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'link', 'chat', 'audio' ) );

	// Load theme options
	require_once( dirname( __FILE__ ) . '/inc/theme-options.php' );
}
endif; // dusktodawn_setup

// Tell WordPress to run dusktodawn_setup() when the 'after_setup_theme' hook is run.
add_action( 'after_setup_theme', 'dusktodawn_setup' );

// Custom Header.
define( 'HEADER_TEXTCOLOR', '497ca7' );

// By leaving empty, we default to random image rotation.
define( 'HEADER_IMAGE', '' );

define( 'HEADER_IMAGE_WIDTH', 870 );
define( 'HEADER_IMAGE_HEIGHT', 220 );

add_custom_image_header( 'dusktodawn_header_style', 'dusktodawn_admin_header_style' );

// Styles the header image.
function dusktodawn_header_style() {

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
		#branding hgroup,
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		#page {
			padding: 132px 0 0 0;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a {
			color: #<?php echo get_header_textcolor(); ?>
		}
	<?php endif; ?>
	</style>
	<?php
}

// Styles the header image displayed on the Appearance > Header admin panel.
function dusktodawn_admin_header_style() {
?>
	<style type="text/css">
		#headimg {
			width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
			height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
		}
        #heading,
        #headimg h1,
        #headimg #desc {
        	display: none;
        }
		</style>
<?php
}

// Add custom background support.
add_custom_background();

function dusktodawn_custom_background() {
	if ( '' != get_background_image() ) { ?>
		<style type="text/css">
			#super-super-wrapper,
			#super-wrapper,
			#page,
			.right-sidebar #page {
				background: none;
				filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
			}
		</style>
	<?php } elseif ( '' != get_background_color() ) { ?>
		<style type="text/css">
			#super-super-wrapper {
				background: none;
				filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
			}
		</style>
	<?php }
}
add_action( 'wp_head', 'dusktodawn_custom_background' );

// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
function dusktodawn_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'dusktodawn_page_menu_args' );

// Register widgetized area and update sidebar with default widgets
function dusktodawn_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar 1', 'dusktodawn' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'dusktodawn_widgets_init' );

// Display navigation to next/previous pages when applicable
function dusktodawn_content_nav( $nav_id ) {
	global $wp_query;

	?>
	<nav id="<?php echo $nav_id; ?>" class="clear-fix">
		<h1 class="assistive-text section-heading"><?php _e( 'Post navigation', 'dusktodawn' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>
		<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'dusktodawn' ) ); ?></span>
		<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'dusktodawn' ) ); ?></span>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<span class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'dusktodawn' ) ); ?></span>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<span class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'dusktodawn' ) ); ?></span>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}

//Prints HTML with meta information for the current post-date/time and author.
function dusktodawn_posted_on() {
	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'dusktodawn' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'dusktodawn' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}

// Adds custom classes to the array of body classes.
function dusktodawn_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'dusktodawn_body_classes' );

// Returns true if a blog has more than 1 category
function dusktodawn_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so dusktodawn_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so dusktodawn_categorized_blog should return false
		return false;
	}
}

// Flush out the transients used in dusktodawn_categorized_blog
function dusktodawn_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'dusktodawn_category_transient_flusher' );
add_action( 'save_post', 'dusktodawn_category_transient_flusher' );

function dusktodawn_post_meta() {
	if ( is_singular() ) :
		/* translators: used between list items, there is a space after the comma */
		$category_list = get_the_category_list( __( ', ', 'dusktodawn' ) );

		/* translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list( '', ', ' );

		if ( ! dusktodawn_categorized_blog() ) {
			// This blog only has 1 category so we just need to worry about tags in the meta text
			if ( '' != $tag_list ) {
				$meta_text = __( 'This entry was tagged %2$s.<br />Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.<br />', 'dusktodawn' );
			} else {
				$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.<br />', 'dusktodawn' );
			}

		} else {
			// But this blog has loads of categories so we should probably display them here
			if ( '' != $tag_list ) {
				$meta_text = __( 'This entry was posted in %1$s and tagged %2$s.<br />Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.<br />', 'dusktodawn' );
			} else {
				$meta_text = __( 'This entry was posted in %1$s.<br />Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.<br />', 'dusktodawn' );
			}

		} // end check for categories on this blog

		printf(
			$meta_text,
			$category_list,
			$tag_list,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
	else :
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'dusktodawn' ) );
		if ( $categories_list && dusktodawn_categorized_blog() ) : ?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'dusktodawn' ), $categories_list ); ?><br />
			</span>
		<?php endif; // End if categories ?>

		<?php /* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'dusktodawn' ) );
		if ( $tags_list ) : ?>

			<span class="tag-links">
				<?php printf( __( 'Tagged %1$s', 'dusktodawn' ), $tags_list ); ?><br />
			</span>
		<?php endif; // End if $tags_list
	endif;
}

// Author info box
function dusktodawn_author_info() {
	if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
		<div id="author-info">
			<div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'dusktodawn_author_bio_avatar_size', 50 ) ); ?>
			</div><!-- #author-avatar -->
			<div id="author-description">
				<h2><?php esc_html( printf( __( 'About %s', 'dusktodawn' ), get_the_author() ) ); ?></h2>
				<?php the_author_meta( 'description' ); ?>
				<div id="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'dusktodawn' ), get_the_author() ); ?>
					</a>
				</div><!-- #author-link	-->
			</div><!-- #author-description -->
		</div><!-- #entry-author-info -->
	<?php endif;
}

// Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
function dusktodawn_enhanced_image_navigation( $url ) {
	global $post;
	if ( wp_attachment_is_image( $post->ID ) )
		$url = $url . '#main';
	return $url;
}
add_filter( 'attachment_link', 'dusktodawn_enhanced_image_navigation' );

// Enqueue font styles.
function dusktodawn_fonts() {
	wp_enqueue_style( 'ubuntu', 'http://fonts.googleapis.com/css?family=Ubuntu:300,400,700' );
}
add_action( 'wp_enqueue_scripts', 'dusktodawn_fonts' );

/**
 * Return the URL for the first link found in this post.
 *
 * @param string the_content Post content, falls back to current post content if empty.
 * @return string|bool URL or false when no link is present.
 */
function dusktodawn_url_grabber( $the_content = '' ) {
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
function dusktodawn_audio_grabber( $post_id ) {
	global $wpdb;

	$first_audio = $wpdb->get_var( $wpdb->prepare( "SELECT guid FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'attachment' AND INSTR(post_mime_type, 'audio') ORDER BY menu_order ASC LIMIT 0,1", (int) $post_id ) );

	if ( ! empty( $first_audio ) )
		return $first_audio;

	return false;
}

// Add in-head JS block for audio post format.
function dusktodawn_add_audio_support() {
	if ( ! is_singular() || ( is_singular() && 'audio' == get_post_format() ) ) {
?>
		<script type="text/javascript">
			AudioPlayer.setup( "<?php echo get_template_directory_uri(); ?>/swf/player.swf", {
				bg: "0b0e18",
				leftbg: "0b0e18",
				rightbg: "0b0e18",
				track: "0b0e18",
				text: "ffffff",
				lefticon: "ffffff",
				righticon: "ffffff",
				border: "0b0e18",
				tracker: "666666",
				loader: "ffffff"
			});
		</script>
<?php }
}
add_action( 'wp_head', 'dusktodawn_add_audio_support' );
// This theme was built with PHP, Semantic HTML, CSS, love, and a Toolbox.