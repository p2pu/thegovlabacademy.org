<?php ob_start(); ?>
<!doctype html>

<!--[if lt IE 7]>
<html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]>
<html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]>
<html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

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
  <meta name="msapplication-TileImage"
        content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php // wordpress head functions ?>
  <?php wp_head(); ?>
  <?php // end of wordpress head ?>

  <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/library/css/styles.css' type='text/css'
        media='all'/>
  <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/library/css/colors.css' type='text/css'
        media='all'/>

  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">

  <?php // drop Google Analytics Here ?>
  <?php // end analytics ?>

</head>

<body <?php body_class(); ?>>
<header class="header" role="banner"> <!-- Header and Navigation -->
  <div class="content">
    <div class="wrapper ">
      <h1 class="govlab-academy-logo">
        <a href="<?php echo home_url(); ?>" rel="nofollow">
          <!--<img src="<?php echo get_bloginfo('template_directory'); ?>/library/images/govlab-academy-logo.png" alt="">-->
        </a>
      </h1>

      <div class="institutional-menu">
        <div id="subscribe" class="subscribe-form">
          <a class="subscribe-button" href="#">Subscribe</a>
          <?php
          if( function_exists( 'insert_cform' ) ) {
            insert_cform();
          } else { ?>
            <form>
            <h4>Subscribe to our newsletter</h4>
            <input type="text" placeholder="Email">
            <input id="subscribe-submit" class="button" type="submit" value="OK">
            <span>Subscribe</span>
          </form><?php
          } ?>
        </div>
        <?php wp_nav_menu(array('theme_location' => 'institutional_menu')); ?>
      </div>
    </div>
  </div>
</header>
<section class="content-top"> <!-- Main Slider -->
  <div class="wrapper">
    <?php wp_nav_menu(array('theme_location' => 'theme_menu', 'container_class' => 'theme-menu')); ?>
  </div>
</section>
