<?php $featured_fields = simple_fields_fieldgroup('topic_page_video_group');
//if (count(array_filter($featured_fields))) {?>
  <div class="twelvecol first">
  <div class="sixcol first">

    <iframe width="100%" height="315"
            src="<?php echo get_post( $featured_fields['videos']) ; ?>"
            frameborder="0" allowfullscreen></iframe>
  </div>
  <div class="sixcol">
    <h1 class="featured-title"><?php echo simple_fields_value('topic_featured_title'); ?></h1>

    <h2 class="featured-subtitle"><?php echo simple_fields_value('topic_featured_subtitle'); ?></h2>

    <p class="feautured-description"><?php echo simple_fields_value('topic_featured_description'); ?></p>
  </div>
  </div><?php
//} ?>