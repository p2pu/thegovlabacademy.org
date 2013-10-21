<?php ob_start(); ?>
<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?>>
		<div id="container">
      <header  class="header" role="banner"> <!-- Header and Navigation -->
        <div class="wrapper">
          <h1>
            <a href="<?php echo home_url(); ?>" rel="nofollow">
              <img src="<?php echo get_bloginfo('template_directory');?>/library/images/govlab-academy-logo.png" alt="">
            </a>
          </h1>
          <div class="institutional-menu">
            <nav>
              <a href="#">Blog</a>
              <a href="#">About</a>
            </nav>
            <div id="subscribe" class="subscribe-form">
              <a href="#">Subscribe</a>
              <form>
                <h4>Subscribe to our newsletter</h4>
                <input type="text" placeholder="Email">
                <input id="subscribe-submit" class="button" type="submit" value="OK">
                <span>Subscribe</span>
              </form>
            </div>
          </div>
        </div>

      </header>
      <!--
			<header class="header" role="banner">

				<div id="inner-header" class="wrap clearfix">

					<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>


					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php // bloginfo('description'); ?>

          <nav class="theme-menu" role="navigation">
            <?php bones_main_nav(); ?>
            <!--<a class="crowd" href="#">Crowd</a><a class="data" href="#">Data</a><a class="behave"href="#">Behave</a><a class="history" href="#">history</a>-->
          <!--</nav>

				</div> <?php // end #inner-header ?>

			</header> <?php // end header ?>-->
