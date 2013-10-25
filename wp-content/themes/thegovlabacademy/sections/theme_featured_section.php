<?php $featured_fields = simple_fields_fieldgroup('theme_page_video_group');
$video_link = simple_fields_get_post_value($featured_fields['id'], "Link to video", true);
if ($featured_fields) {?>
  <div class="main-slider">
    <!-- Main Slider - I guess we will use a standard plugin. -->
    <div class="container eightcol first">
      <?php echo do_shortcode('[fve]' . $video_link . '[/fve]') ?>
    </div>
    <div class="info fourcol">
      <h2><?php print_r($featured_fields['post']->post_title); ?></h2>

      <h3></h3>

      <p><?php echo simple_fields_get_post_value($featured_fields['id'], "Description", true); ?></p>
    </div>

  </div><?php
}?>

