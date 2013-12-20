<?php get_header($name='menuless'); ?>

<div id="content">

  <div id="inner-content" class="wrapper clearfix">

    <div id="main" class="twelvecol first clearfix" role="main">

      <nav id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
        <?php include(get_template_directory() . "/sections/video_navigation.php") ?>
        <form id="searchform" action="<?php bloginfo('url'); ?>/" method="get">
          <input class="inlineSearch" type="text" name="s" id="s" placeholder="Search for a video" />
          <input type="hidden" name="post_type" value="video" />
          <button id="searchsubmit" type="submit" value="Search"><i class="fa fa-search"></i></button>
        </form>
      </nav>

      <?php if (is_category()) { ?>
        <h1 class="archive-title h2">
          <span><?php _e('Posts Categorized:', 'bonestheme'); ?></span> <?php single_cat_title(); ?>
        </h1>

      <?php } elseif (is_tag()) { ?>
        <h1 class="archive-title h2">
          <span><?php _e('Posts Tagged:', 'bonestheme'); ?></span> <?php single_tag_title(); ?>
        </h1>

      <?php
      } elseif (is_author()) {
        global $post;
        $author_id = $post->post_author;
        ?>
        <h1 class="archive-title h2">

          <span><?php _e('Posts By:', 'bonestheme'); ?></span> <?php the_author_meta('display_name', $author_id); ?>

        </h1>
      <?php } elseif (is_day()) { ?>
        <h1 class="archive-title h2">
          <span><?php _e('Daily Archives:', 'bonestheme'); ?></span> <?php the_time('l, F j, Y'); ?>
        </h1>

      <?php } elseif (is_month()) { ?>
        <h1 class="archive-title h2">
          <span><?php _e('Monthly Archives:', 'bonestheme'); ?></span> <?php the_time('F Y'); ?>
        </h1>

      <?php } elseif (is_year()) { ?>
        <h1 class="archive-title h2">
          <span><?php _e('Yearly Archives:', 'bonestheme'); ?></span> <?php the_time('Y'); ?>
        </h1>
      <?php } ?>

      <?php if (have_posts()):
        $count = 0;?>
        <ul class="video-thumnails twelvecol first"><?php
          while (have_posts()) : the_post();
          $video_link = simple_fields_get_post_value(get_the_ID(), "Link to video", true);?>
          <li class="threecol video-thumnails-item <?php if ($count == 0 || $count % 4 == 0) {echo 'first';} ?>">
            <a class="video-overlay-link" href="<?php the_permalink() ?>">
              <img src="<?php echo parse_thumbnail_for_video($video_link) ?>" alt="<?php the_title(); ?>" class="img-thumb"/>
            </a>
            <p class="video-info align-center">
              <small><?php the_title(); ?></small>
            </p>
            </li><?php
            $count++;
          endwhile; ?>
        </ul>
        <?php if (function_exists('bones_page_navi')) { ?>
        <?php bones_page_navi(); ?>
      <?php } else { ?>
        <nav class="wp-prev-next">
          <ul class="clearfix">
            <li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', 'bonestheme')) ?></li>
            <li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', 'bonestheme')) ?></li>
          </ul>
        </nav>
      <?php } ?>

      <?php else : ?>

        <article id="post-not-found" class="hentry clearfix">
          <header class="article-header">
            <h1><?php _e('Oops, Post Not Found!', 'bonestheme'); ?></h1>
          </header>
          <section class="entry-content">
            <p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'bonestheme'); ?></p>
          </section>
          <footer class="article-footer">
            <p><?php _e('This is the error message in the archive.php template.', 'bonestheme'); ?></p>
          </footer>
        </article>

      <?php endif; ?>

    </div> <?php // end #main ?>

  </div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>
