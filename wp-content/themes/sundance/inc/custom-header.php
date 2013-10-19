<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Sundance
 * @since Sundance 1.0
 */

function sundance_custom_header_setup() {
	// The default header text color
	define( 'HEADER_TEXTCOLOR', '464646' );

	// By leaving empty, we allow for random image rotation.
	define( 'HEADER_IMAGE', '' );

	// The height and width of your custom header.
	// Add a filter to sundance_header_image_width and sundance_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'sundance_header_image_width', 984 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'sundance_header_image_height', 242 ) );

	// Add a way for the custom header to be styled in the admin panel that controls custom headers
	add_custom_image_header( 'sundance_header_style', 'sundance_admin_header_style', 'sundance_admin_header_image' );
}
add_action( 'after_setup_theme', 'sundance_custom_header_setup' );

if ( ! function_exists( 'sundance_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Sundance 1.0
 */
function sundance_header_style() {

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
		#page {
			padding-top: 7px;
		}
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		.header-image-link {
			margin-top: 0;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // sundance_header_style

if ( ! function_exists( 'sundance_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in sundance_setup().
 *
 * @since Sundance 1.0
 */
function sundance_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
		max-width: 984px;
	}
	#headimg h1,
	#desc {
		font-family: Georgia, serif;
	}
	#headimg h1 {
		float: left;
		font-size: 44px;
		font-weight: normal;
		line-height: 52px;
		margin: 0 0 0 110px;
		max-width: 652px;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#desc {
		float: right;
		font-size: 12px;
		font-style: italic;
		line-height: 22px;
		margin: 26px 0 0 0;
		max-width: 186px;
	}
	#headimg img {
		clear: both;
		height: auto;
		margin: 33px 0 0 0;
		max-width: 984px;
		width: 100%;
	}
	</style>
<?php
}
endif; // sundance_admin_header_style

if ( ! function_exists( 'sundance_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in sundance_setup().
 *
 * @since sundance 1.0
 */
function sundance_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // sundance_admin_header_image