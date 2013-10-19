<?php
/**
 * @package Parament
 */

if ( ! isset( $content_width ) )
	$content_width = 627;

if ( ! function_exists( 'parament_setup' ) ) {
	/**
	 * Setup for Parament Theme.
	 */
	function parament_setup() {
		add_theme_support( 'automatic-feed-links' );

		add_custom_background();

		define( 'HEADER_TEXTCOLOR', 'cccfd7' );
		define( 'HEADER_IMAGE', '' ); /* Defaults to no header image. */
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'parament_header_image_width', 950 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'parament_header_image_height', 200 ) );
		add_custom_image_header( 'parament_header_style', 'parament_admin_header_style', 'parament_admin_header_image' );

		register_nav_menu( 'primary-menu', __( 'Primary', 'parament' ) );

		load_theme_textdomain( 'parament', get_template_directory() . '/languages' );
		add_action( 'widgets_init', 'parament_register_sidebars' );
	}
}
add_action( 'after_setup_theme', 'parament_setup' );

if ( ! function_exists( 'parament_header_style' ) ) {
	/**
	 * Public styles the header image and text.
	 */
	function parament_header_style() {
		if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
			return;
		?>
		<style type="text/css">
		<?php
			// Has the text been hidden?
			if ( 'blank' == get_header_textcolor() ) :
		?>
			h1#site-title,
			h2#site-description {
				position: absolute !important;
				clip: rect( 1px 1px 1px 1px ); /* IE6, IE7 */
				clip: rect( 1px, 1px, 1px, 1px );
			}
		<?php
			endif;
		?>
		<?php if ( '' != get_header_image() ) : ?>

			#branding {
				overflow: hidden;
				position: relative;
				width: <?php echo HEADER_IMAGE_WIDTH ?>px;
				height: <?php echo HEADER_IMAGE_HEIGHT ?>px;
			}
			h1#site-title,
			h2#site-description {
				position: relative;
				margin-left: 50px;
				z-index: 2;
			}
			h1#site-title {
				margin-top: 60px;
			}
			h2#site-description {
				display: block;
			}
			#header-image {
				display: block;
				position: absolute;
				top: 0;
				left: 0;
				width: <?php echo HEADER_IMAGE_WIDTH ?>px;
				height: <?php echo HEADER_IMAGE_HEIGHT ?>px;
				z-index: 1;
			}
		<?php endif; ?>
		<?php if ( 'blank' != get_header_textcolor() ) : ?>
			h1#site-title a,
			h2#site-description,
			h2#site-description a {
				color: #<?php echo get_header_textcolor(); ?> !important;
			}
		<?php endif; ?>
		</style>
		<?php
	}
}

if ( ! function_exists( 'parament_admin_header_style' ) ) {
	/**
	 * Styles the header image displayed on the Appearance > Header admin panel.
	 *
	 * Referenced via add_custom_image_header() in parament_setup().
	 */
	function parament_admin_header_style() {
		$background_image = get_template_directory_uri() . '/images/diagonal-stripes-010.png';
		if ( '' != get_background_image() )
			$background_image = get_background_image();
	?>
		<style type="text/css">
		#headimg {
			border: 1px solid #eee;
			overflow: hidden;
			position: relative;
			width: <?php echo HEADER_IMAGE_WIDTH ?>px;
			height: <?php echo HEADER_IMAGE_HEIGHT ?>px;
			background-color: <?php echo parament_sanitize_color( get_background_color(), '20232d' ); ?>;
			background-image: url( <?php echo esc_url( $background_image ); ?> );
		}
		#name,
		#desc {
			font-family: Trebuchet, arial, sans-serif !important;
			position: relative;
			text-shadow: #000 1px 1px 2px;
			z-index: 2 !important;
		}
		#name {
			font-weight: normal;
			font-size: 40px;
			line-height: 47px;
			margin: 55px 0 0 50px;
		}
		#desc {
			font-size: 16px;
			line-height: 1.5;
			margin: 0 0 20px 50px;
		}
		#parament-header-image {
			position: absolute;
			top: 0;
			left: 0;
			z-index: 1;
		}
		</style>
	<?php
	}
}

if ( ! function_exists( 'parament_admin_header_image' ) ) {
	/**
	 * Custom header image markup displayed on the Appearance > Header admin panel.
	 *
	 * Referenced via add_custom_image_header() in parament_setup().
	 */
	function parament_admin_header_image() { ?>
		<div id="headimg">
			<?php
			echo '<h1 id="name">' . get_option( 'blogname' ) . '</h1>';

			$tagline = get_bloginfo( 'description' );
			if ( ! empty( $tagline ) )
				echo '<h2 id="desc">' . $tagline . '</h2>';

			$header_image = get_header_image();
			if ( ! empty( $header_image ) )
				echo '<img id="parament-header-image" src="' . esc_url( $header_image ) . '" alt="" />';
			?>
		</header>
	<?php
	}
}

/**
 * Register Sidebars.
 */
function parament_register_sidebars() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'parament' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

if ( ! function_exists( 'parament_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own parament_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function parament_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><span class="pingback-title"><?php _e( 'Pingback:', 'parament' ); ?></span> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'parament' ), ' <span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="contain">
			<footer class="comment-meta contain vcard">

				<?php echo get_avatar( $comment, 40 ); ?>

				<div class="comment-author">
				<?php
						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s said:', 'parament' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'parament' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'parament' ), ' <span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'parament' ); ?></em>
				<?php endif; ?>

			</footer><!-- .vcard -->

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply contain">
				<?php comment_reply_link( array_merge( $args, array(
					'reply_text' => __( 'Reply', 'parament' ),
					'depth'      => $depth,
					'max_depth'  => $args['max_depth']
				) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif;

/**
 * Custom class attributes for the "Branding" header.
 *
 * If present, Parament will add a drop shadow to the
 * user-defined custom header image. This shadow should
 * not be present when no header image is used.
 */
function parament_header_classes() {
	$image = get_header_image();
	if ( ! empty( $image ) )
		echo ' class="has-image"';
}

function parament_sanitize_color( $color, $default = '20232d' ) {
	if ( ! ctype_xdigit( $color ) )
		return '#' . $default;
	if ( ! in_array( strlen( $color ), array( 3, 6 ) ) )
		return '#' . $default;
	return '#' . $color;
}

/**
 * WP.com: Set value of $themecolors.
 */
$themecolors = array(
	'bg'     => '111111',
	'text'   => '989eae',
	'link'   => '989eae',
	'border' => '444855',
	'url'    => '989eae',
);