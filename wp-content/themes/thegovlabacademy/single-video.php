<?php
/*
This is the custom post type post template.
If you edit the post type name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom post type is called
register_post_type( 'bookmarks',
then your single template should be
single-bookmarks.php

*/
?>

<?php get_header($name = 'menuless'); ?>

<div id="content">

  <div id="inner-content" class="wrapper clearfix">

    <div id="main" class="twelvecol first clearfix" role="main">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <nav id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
          <?php include(get_template_directory() . "/sections/video_navigation.php") ?>
        </nav>
        <div class="video-page main-slider">
          <div class="eightcol first">
            <?php echo do_shortcode('[fve]' . simple_fields_get_post_value(get_the_ID(), "Link to video", true) . '[/fve]') ?>
          </div>
          <div class="fourcol info">
            <h2><?php the_title(); ?></h2>
            <p>
              <?php echo simple_fields_get_post_value(get_the_ID(), "Description", true) ?>
            </p>
          </div>
        </div>



      <?php endwhile; ?>

      <?php else : ?>

        <article id="post-not-found" class="hentry clearfix">
          <header class="article-header">
            <h1><?php _e('Oops, Post Not Found!', 'bonestheme'); ?></h1>
          </header>
          <section class="entry-content">
            <p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'bonestheme'); ?></p>
          </section>
          <footer class="article-footer">
            <p><?php _e('This is the error message in the single-custom_type.php template.', 'bonestheme'); ?></p>
          </footer>
        </article>

      <?php endif; ?>

    </div> <?php // end #main ?>

  </div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>
