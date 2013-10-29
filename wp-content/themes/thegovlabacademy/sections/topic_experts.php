<?php $experts_values = simple_fields_fieldgroup('topic_page_experts_group');
if ($experts_values){ ?>
  <h2>People to Follow</h2>
  <ul class="experts-list"><?php
  foreach ($experts_values as $key => $values) {
    $name = simple_fields_get_post_value($values, "Image", true);
    $image_url = wp_get_attachment_url(simple_fields_get_post_value($values, "Image", true));?>
      <li><img src="<?php echo $image_url; ?>" alt="Name of the Expert" title="Name of the Expert"></li>
    <?php
  }?>
  </ul><?php
}?>
