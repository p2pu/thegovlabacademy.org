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
        <?php $post = get_post();
        $title = $post->post_title;
        ?>
        <nav id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="video">
          <?php include(get_template_directory() . "/sections/video_navigation.php"); ?>
        </nav>

        <?php
        $args = array(
          'post_type' => 'video',
          'post_status' => 'publish'
        );

        $query = new WP_Query( $args );
        if ($query->have_posts()){
          $count = 0;
          echo '<ul class="video-thumnails twelvecol first">';
          while ( $query->have_posts() ) {
            $query->the_post();
            $video = get_post();
            $categories = simple_fields_value("video_category_slug");
            if(in_array($title, $categories['selected_values'])){ ?>
              <li class="threecol <?php if($count==0 || $count % 4 ==0){echo 'first';} ?>">
              <a class="video-overlay-link" href="<?php the_permalink() ?>"></a>
              <?php
              $count++;
              echo do_shortcode('[fve]' . simple_fields_get_post_value(get_the_ID(), "Link to video", true) . '[/fve]') ?>
                <p class="video-info align-center"><small><?php echo $video->post_title; ?></small></p>
              </li><?php
            }
          }
          echo '</ul>';
        }
        ?>
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
