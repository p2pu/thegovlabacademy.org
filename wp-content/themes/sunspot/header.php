<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Sunspot
 * @since Sunspot 1.0
 */
?><!DOCTYPE html>
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'sunspot' ), max( $paged, $page ) );

	?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="sunstrip"></div>
<div id="page" class="hfeed site">
	<div id="wrapper" class="wrap">
		<?php do_action( 'before' ); ?>
		<header id="masthead" class="site-header" role="banner">
			<div class="site-header-inner">

				<?php $header_image = get_header_image();
					if ( ! empty( $header_image ) ) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
						</a>
					<?php } // if ( ! empty( $header_image ) ) ?>

				<hgroup>
					<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>

				<nav role="navigation" class="site-navigation main-navigation">
					<h1 class="assistive-text"><?php _e( 'Menu', 'sunspot' ); ?></h1>
					<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'sunspot' ); ?>"><?php _e( 'Skip to content', 'sunspot' ); ?></a></div>

					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav>

				<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
					<div id="tertiary" class="widget-area" role="complementary">
						<?php dynamic_sidebar( 'sidebar-2' ); ?>
					</div><!-- #tertiary .widget-area -->
				<?php endif; // end sidebar widget area ?>

			</div><!-- .site-header-inner -->
		</header><!-- #masthead .site-header -->

		<div id="main">