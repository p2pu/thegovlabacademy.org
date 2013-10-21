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

          <header class="article-header">

            <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

          </header> <?php // end article header ?>

          <section class="entry-content clearfix" itemprop="articleBody">

            <div class="twelvecol clear-left-margin">
              <div class="sixcol clear-left-margin">
                <iframe width="100%" height="315"
                        src="<?php echo simple_fields_value('youtube_link'); ?>"
                        frameborder="0" allowfullscreen></iframe>
              </div>
              <div class="sixcol">
                <h1><?php echo simple_fields_value('title');?></h1>
                <h2><?php echo simple_fields_value('course_title');?></h2>
                <p><?php echo simple_fields_value('description');?></p>
              </div>
            </div>

            <div class="clearfix">
              <h1>Learn more</h1>
              <?php include (get_template_directory() . "/sections/topic_learn_more_section.php") ;?>
            <div>
              <h1>Read</h1>
              <?php include (get_template_directory() . "/sections/topic_read.php") ;?>
            </div>
            <?php include (get_template_directory() . "/sections/topic_experts.php") ;?>

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
