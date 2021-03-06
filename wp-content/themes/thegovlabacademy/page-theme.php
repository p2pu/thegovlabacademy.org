<?php
/*
  * Template name: Theme Page
  * Simple Fields Connector: theme_page_connector
  */
get_header(); ?>

<div id="content">

  <div id="inner-content" class="wrapper clearfix">

    <div id="main" class="twelvecol first clearfix" role="main">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope
                 itemtype="http://schema.org/BlogPosting">

          <section class="entry-content clearfix" itemprop="articleBody">
            <div class="clearfix">
              <?php include (get_template_directory()."/sections/theme_featured_section.php") ?>
            </div><?php // End featured section ?>

            <div class="clearfix">
              <?php include (get_template_directory()."/sections/theme_inspirational_quote.php") ?>
            </div><?php // End inspirational quote section ?>

            <div class="wrapper clearfix">
              <?php include (get_template_directory()."/sections/theme_topics.php") ?>
            </div><?php // End inspirational quote section ?>

            <div class="wrapper clearfix">
              <?php include (get_template_directory() . "/sections/theme_experts.php") ;?>
            </div><?php // End expert section ?>

          </section> <?php // end article section ?>

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
