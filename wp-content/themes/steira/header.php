<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!--[if lt IE 7 ]>
<html class="ie6" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7 ]>
<html class="ie7" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8 ]>
<html class="ie8" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9 ]>
<html class="ie9" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<!--<![endif]-->

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">
	<p id="skiptocontent"><a href="#content">Skip to content</a></p>

	<div id="masthead">
		<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary', 'menu_id' => 'navigation', 'fallback_cb' => 'steira_page_menu' ) ); ?>

		<h1><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo('title'); ?></a></h1>
	</div><!-- masthead -->

	<div id="subhead">
		<?php get_search_form(); ?>

		<blockquote>
			<p><span class="quote">&ldquo;</span><?php bloginfo('description'); ?><span class="quote">&rdquo;</span></p>
		</blockquote>
	</div><!-- subhead -->
