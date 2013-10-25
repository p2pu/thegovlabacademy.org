<?php $featured_fields = simple_fields_fieldgroup('theme_page_video_group');
if ($featured_fields) {?>
  <div class="main-slider">
    <!-- Main Slider - I guess we will use a standard plugin. -->
    <div class="container eightcol first">
      <iframe width="100%" height="300"
              src="<?php echo get_the_video_link(simple_fields_get_post_value($featured_fields['id'], "Link to video", true)) ?>"
              frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="info fourcol">
      <h2><?php print_r($featured_fields['post']->post_title); ?></h2>

      <h3></h3>

      <p><?php echo simple_fields_get_post_value($featured_fields['id'], "Description", true); ?></p>
    </div>

  </div><?php
}?>

