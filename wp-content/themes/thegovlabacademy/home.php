<?php
/*
  * Template name: Home page
  * Simple Fields Connector: home_page_connector
  */
get_header(); ?>

<div id="content">

  <div id="inner-content" class="wrap clearfix">

    <div id="main" class="twelvecol first clearfix" role="main">

      <img src="http://placehold.it/960x350" alt=""/>

    </div>
    <p class="big-quote">
      <?php $simple_fields = simple_fields_fieldgroup('home_page_quote'); ?>
      <?php echo $simple_fields['home_page_quote']; ?><br>
      <small>- <?php echo $simple_fields['home_page_quote_author']; ?></small>
    </p>

    <section class="theme-columns clearfix"> <!-- Themes Highlights -->
      <?php $videos = simple_fields_fieldgroup('home_page_videos');?>
      <div class="wrap">
        <?php foreach ($videos as $key => $value) {?>
          <div class="four-col <?php echo strtolower($value['home_page_theme_name']); ?>">
            <h2><?php echo $value['home_page_theme_name']; ?></h2>
            <?php echo do_shortcode('[fve]' . simple_fields_get_post_value($value['home_page_featured_videos']['id'], "Link to video", true) . '[/fve]') ?>
            <div class="info">
              <h3><?php echo $value['home_page_video_title']; ?></h3>
              <p><?php echo $value['home_page_video_description']; ?></p>
            </div>
          </div><?php
        }?>
        <div class="four-col behave soon">
          <h2>Behave</h2>
          <img src="images/behave-theme.png" alt="">
          <div class="info">
            <h3>Behavior and Insight</h3>
            <h4>Coming Soon</h4>
            <p></p>
          </div>
        </div>
        <div class="four-col history soon">
          <h2>History</h2>
          <img src="images/history-theme.png" alt="">
          <div class="info">
            <h3>History &amp; Context of Open Governance</h3>
            <h4>Coming Soon</h4>
            <p></p>
          </div>
        </div>
      </div>
    </section>
    <section class="featured-content"> <!-- Featured Videos -->
      <div class="wrap tencol">
        <aside> <!-- Sidebar -->
          <a class="twitter-timeline"  href="https://twitter.com/TheGovLab/network-of-collaborators"  data-widget-id="394876037537861633">Tweets from @TheGovLab/network-of-collaborators</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </aside>

        <div class="main-content">
          <!-- These are Featured Post Excerpts, right? -->
          <h2>Featured Content</h2>
          <?php $featured_content = simple_fields_fieldgroup('home_page_featured_content');
          foreach ($featured_content as $key => $value) {
            print_r($value)?>
            <article class="clearfix content-entry video">
              <img class="image" src="<?php echo $value['home_page_topic_image']['url']; ?>" alt="">
              <div class="info">
                <h3 class="post-title"><?php echo $value['home_page_featured_content_title'] ?></h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, non, assumenda reiciendis libero corporis repellendus laudantium architecto minima vero minus error rem blanditiis deserunt soluta quod expedita reprehenderit? Dolorem, quae?</p>
              </div>
            </article><?php
          }?>
        </div>
      </div>
    </section>
  </div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>
