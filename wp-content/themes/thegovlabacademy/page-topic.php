<?php
/*
  * Template name: Topic Page
  * Simple Fields Connector: topic_page_connector
  */
get_header(); ?>

<div id="content">
  <div id="inner-content" class="wrap clearfix">
    <div id="main" class="twelvecol first clearfix" role="main">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope
                 itemtype="http://schema.org/BlogPosting">

          <section class="entry-content clearfix" itemprop="articleBody">

            <div class="clearfix">
              <?php include (get_template_directory()."/sections/topic_featured_section.php") ?>
            </div><?php // End featured section ?>

            <div class="wrapper clearfix">
              <?php include (get_template_directory() . "/sections/topic_learn_more_section.php") ;?>
            </div><?php // End learn more section ?>

            <div class="wrapper content clearfix">
              <?php include (get_template_directory() . "/sections/topic_literature.php") ;?>
            </div><?php // End literature section ?>

            <div class="clearfix">
              <?php include (get_template_directory() . "/sections/topic_activities.php") ;?>
            </div><?php // End activities section ?>

            <div class="clearfix">
              <?php include (get_template_directory() . "/sections/topic_toolbox.php") ;?>
            </div><?php // End toolbox section ?>

            <div class="clearfix">
              <?php include (get_template_directory() . "/sections/topic_experts.php") ;?>
            </div><?php // End expert section ?>

          </section> <?php // end article section ?>

          <footer class="article-footer">
            <?php the_tags('<span class="tags">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?>

          </footer> <?php // end article footer ?>

          <?php comments_template(); ?>

        </article> <?php // end article ?>

      <?php endwhile; else : ?>

        <article id="post-not-found" class="hentry clearfix">
          <header class="article-header">
            <h1><?php _e('Oops, Post Not Found!', 'bonestheme'); ?></h1>
          </header>
          <section class="entry-content">
            <p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'bonestheme'); ?></p>
          </section>
          <footer class="article-footer">
            <p><?php _e('This is the error message in the page.php template.', 'bonestheme'); ?></p>
          </footer>
        </article>

      <?php endif; ?>

    </div> <?php // end #main ?>

  </div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>
