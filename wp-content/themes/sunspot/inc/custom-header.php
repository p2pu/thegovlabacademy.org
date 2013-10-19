<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>

 *
 * @package Sunspot
 * @since Sunspot 1.0
 */

function sunspot_custom_header_setup() {
	// The default header text color
	define( 'HEADER_TEXTCOLOR', 'FCB03E' );

	// By leaving empty, we allow for random image rotation.
	define( 'HEADER_IMAGE', '' );

	// The height and width of your custom header.
	// Add a filter to sunspot_header_image_width and sunspot_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'sunspot_header_image_width', 257 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'sunspot_header_image_height', 157 ) );

	// Turn on random header image rotation by default.
	add_theme_support( 'custom-header', array( 'random-default' => true ) );

	// Add a way for the custom header to be styled in the admin panel that controls custom headers
	add_custom_image_header( 'sunspot_header_style', 'sunspot_admin_header_style', 'sunspot_admin_header_image' );
}
add_action( 'after_setup_theme', 'sunspot_custom_header_setup' );

if ( ! function_exists( 'sunspot_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Sunspot 1.0
 */
function sunspot_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
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
	<?php if ( '' != get_header_image() ) : ?>
		.site-header img {
			margin: 0.5em auto 0.8em;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // sunspot_header_style



if ( ! function_exists( 'sunspot_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in sunspot_setup().
 *
 * @since Sunspot 1.0
 */
function sunspot_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	.appearance_page_custom-header #headimg {
		background: #000;
		padding: 10px;
		width: 256px;
	}
	#headimg h1 {
		font-family: 'Helvetica Neue', Helvetica, Arial,sans-serif;
		font-size: 49px;
		font-weight: normal;
		line-height: 1;
		margin-bottom: 3px;
		margin-top: -0.1em;
		text-transform: uppercase;
		word-wrap: break-word;
	}
	#headimg h1 a {
		color: #fcb03e;
		text-decoration: none;
	}
	#desc {
		font-size: 11px;
		letter-spacing: 1px;
	}
	#headimg img {
	}
	</style>
<?php
}
endif; // sunspot_admin_header_style

if ( ! function_exists( 'sunspot_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in sunspot_setup().
 *
 * @since Sunspot 1.0
 */
function sunspot_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
	</div>
<?php }
endif; // sunspot_admin_header_image