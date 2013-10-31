<?php $experts_values = simple_fields_fieldgroup('topic_page_experts_group');
if ($experts_values){ ?>
  <h2>People to Follow</h2>
  <ul class="experts-list"><?php
  foreach ($experts_values as $key => $value) {
    $id = $value['post']->ID;
    $name = $value['title'];
    $image_url = wp_get_attachment_url(simple_fields_get_post_value($id, "Image", true));
    $bio = simple_fields_get_post_value($id, "About", true);
    $twitter = trim(simple_fields_get_post_value($id, "Twitter handle", true), ' ');

    ?>
      <li>
        <a href='#' class="expert-img">
          <img src="<?php echo $image_url; ?>" alt="Image of <?php echo $name ?>" title="<?php echo $name ?>">
        </a>
        <div class="modal expert-list-bio <?php if($key > 8) echo 'left'; ?>">
          <div class="arrow <?php if($key > 8 ){ echo 'right'; }else { echo 'left'; }?>"></div>
          <button type="button" class="close">×</button>
          <h2><?php echo $name; ?></h2>
          <p><?php echo $bio; ?></p>
          <p>
            <a href="https://twitter.com/<?php echo $twitter ;?>" class="twitter-follow-button" target="_blank"><i class="fa fa-twitter"></i></a>
          </p>
        </div>
      </li>
    <?php
  }?>
  </ul><?php
}?>
