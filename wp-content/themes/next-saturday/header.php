<?php
/**
 * @package WordPress
 * @subpackage Next Saturday
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) | !(IE 9)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">

	<nav id="access" role="navigation">
	  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
		<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'next-saturday' ); ?>"><?php _e( 'Skip to content', 'next-saturday' ); ?></a></div>
		<?php /* Our navigation menu. The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
		<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'fallback_cb' => '' ) ); ?>
	</nav><!-- #access -->

	<div id="primary-wrapper">
		<div id="primary">
			<header id="branding" role="banner">
				<div id="title-wrapper">
					<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
				</div><!-- #title-wrapper -->
				<div id="description-bar">
					<div id="site-description-wrapper">
						<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
					</div><!-- #site-description-wrapper -->

					<div id="site-rss-link">
						<ul class="site-rss-link">
							<li class="rss-link"><a href="<?php bloginfo( 'rss2_url' ); ?>"><span class="screen-reader-text"><?php _e( 'RSS Feed', 'next-saturday' ); ?></span></a></li>
						</ul><!-- .site-rss-link -->
					</div><!-- #site-rss-link -->
				</div><!-- #description-bar -->
				<div id="description-bar-shadow"></div>
			</header> <!-- #branding -->
			<div id="main">