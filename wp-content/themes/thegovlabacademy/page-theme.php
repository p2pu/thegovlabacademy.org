<?php
/*
  * Template name: Theme Page
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

            <div class="clearfix">
              <div class="sixcol clear-left-margin">
                <?php $video_url = simple_fields_value("video_url");?>
                <iframe width="100%" height="315" src="<?php echo $video_url;?>" frameborder="0"
                        allowfullscreen></iframe>
              </div>
              <div class="sixcol">
                <h1 class="video-title">
                  <?php echo simple_fields_value('video_title');?>
                </h1>
                <h2 class="video-subtitle">
                  <?php echo simple_fields_value('video_subtitle');?>
                </h2>
                <p>
                  <?php echo simple_fields_value('video_description');?>
                </p>

              </div>
            </div>
            <div class="subheading clearfix">
              <h2>Stories on crowd sourcing</h2>
            </div>
            <div class="fourcol clear-left-margin">
              <iframe width="100%" height="315" src="//www.youtube.com/embed/Lbpx7iPm_Tg" frameborder="0"
                      allowfullscreen></iframe>
              <div class="story-video">
                <h1 class="video-title"><?php the_field('story_title'); ?></h1>

                <h2 class="video-subtitle"><?php the_field('subtitle'); ?></h2>

                <p class="description"><?php the_field('description'); ?></p>
              </div>
            </div>
            <div class="fourcol">

            </div>

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
