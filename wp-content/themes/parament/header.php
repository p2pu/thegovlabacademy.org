<?php
/**
 * @package Parament
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
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
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page-wrap" class="contain">

	<header id="branding" role="banner"<?php parament_header_classes(); ?>>
		<h1 id="site-title"><a href="<?php echo esc_url( home_url() ); ?>"><?php echo get_option( 'blogname' ); ?></a></h1>
		<?php
		$header_image = get_header_image();

		$tagline = get_bloginfo( 'description' );
		if ( ! empty( $tagline ) ) {
			if ( ! empty( $header_image ) )
				$tagline = '<h2 id="site-description"><a href="' . esc_url( home_url() ) . '">' . $tagline . '</a></h2>';
			else
				$tagline = '<h2 id="site-description">' . $tagline . '</h2>';

			echo $tagline;
		}
		?>

		<?php if ( ! empty( $header_image ) ) : ?>
			<a id="header-image" href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #branding -->

	<nav id="menu" role="navigation">
		<?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'primary-menu', 'theme_location' => 'primary-menu' ) ); ?>
	</nav>