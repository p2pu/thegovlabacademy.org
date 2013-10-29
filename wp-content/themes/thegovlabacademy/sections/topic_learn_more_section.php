<?php $learn_more_videos = simple_fields_fieldgroup('topic_page_learn_more_section');
if($learn_more_videos){?>
  <h2 class="section-heading">Learn more</h2><?php

  foreach ($learn_more_videos as $key => $value) {
    $video = $value['post'];
    $video_link = simple_fields_get_post_value($video->ID, "Link to video", true);
    $video_description = simple_fields_get_post_value($value['id'], "Description", true); ?>
    <div class="topic-video-info four-col">
      <?php echo do_shortcode('[fve]' . $video_link . '[/fve]') ?>
      <div class="info">
        <h3><?php echo $value['title']; ?></h3>
        <h4></h4>
        <p><?php echo $video_description ?></p>
      </div>
    </div>
  <?php } ?>
<?php } ?>
