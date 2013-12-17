<?php $featured_fields = simple_fields_fieldgroup('theme_page_video_group');

if ($featured_fields) {
  $video_link = simple_fields_get_post_value($featured_fields['id'], "Link to video", true);
  ?>
  <div class="main-slider">
    <div class="container first">
      <?php echo do_shortcode('[fve]' . $video_link . '[/fve]') ?>
    </div>
    <div class="info">
      <h2><?php print_r($featured_fields['post']->post_title); ?></h2>
      <p><?php echo simple_fields_get_post_value($featured_fields['id'], "Description", true); ?></p>
    </div>

  </div><?php
}?>

