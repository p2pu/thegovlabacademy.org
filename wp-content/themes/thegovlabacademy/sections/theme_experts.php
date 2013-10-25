<?php $experts_values = simple_fields_fieldgroup('theme_page_experts_group');

if($experts_values){?>
<div class="experts">
  <h1>Meet the Experts</h1><?php
  foreach ($experts_values as $key =>$values){
    $name = simple_fields_get_post_value($experts_values[0], "Image", true);
    $image_url = wp_get_attachment_url( simple_fields_get_post_value($experts_values[0], "Image", true) );?>
    <ul class="experts-list">
      <li><img src="<?php echo $image_url; ?>" alt="Name of the Expert" title="Name of the Expert"></li>
    </ul>
    <?php
  }
}?>
</div>