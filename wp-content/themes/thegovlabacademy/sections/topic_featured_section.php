<?php $featured_fields = simple_fields_fieldgroup('topic_page_featured_section');
if (count(array_filter($featured_fields))) { ?>
  <div class="twelvecol first">
    <div class="sixcol first"><?php
      if ($featured_fields['topic_featured_youtube_link']) {
        ?>
      <iframe width="100%" height="315"
              src="<?php echo $featured_fields['topic_featured_youtube_link']; ?>"
              frameborder="0" allowfullscreen></iframe><?php
      } elseif ($featured_fields['topic_featured_image_link']) {
        ?>
        <div class="featured-img">
        <img src="<?php echo $featured_fields['topic_featured_image_link'] ?>"
             alt="<?php echo $featured_fields['topic_featured_title'] ?> Image"/>
        </div><?php
      } elseif ($featured_fields['topic_featured_image_upload']) {
        ?>
        <div class="featured-img">
        <img src="<?php echo wp_get_attachment_url($featured_fields['topic_featured_image_upload']) ?>"
             alt="<?php echo $featured_fields['topic_featured_title'] ?> Image"/>
        </div><?php
      } elseif ($featured_fields['topic_featured_call_to_action_button']) {
        ?>
        <div class="featured-call-to-action">
        <div class="button-extra-large">
          <a class="btn" href="<?php echo $featured_fields['topic_featured_call_to_action_url'] ?>">
            <?php echo $featured_fields['topic_featured_call_to_action_button'] ?>
          </a>
        </div>
        </div><?php
      } else {
        ?>
        <div class="featured-call-to-action">
          <img src="http://placehold.it/500x400&text=Select+Video+Image+or+Call+to+Action">
        </div><?php
      } ?>

    </div>
    <div class="sixcol">
      <h1 class="featured-title"><?php echo simple_fields_value('title'); ?></h1>

      <h2 class="featured-subtitle"><?php echo simple_fields_value('course_title'); ?></h2>

      <p class="feautured-description"><?php echo simple_fields_value('description'); ?></p>
    </div>
  </div><?php
} ?>