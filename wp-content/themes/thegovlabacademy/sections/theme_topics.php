<?php
$topic_values = simple_fields_fieldgroup('theme_page_topic_group');

foreach($topic_values as $key=> $value){

  ?>
<div class="threecol <?php if($key === 0 or $key%4){echo ' first';} ?>">
  <div class="topic-img">
    <a href="<?php echo get_permalink($value['theme_topics']) ?>">
    <img src="<?php echo $value['theme_page_topic_image']['url'] ?>"
                              alt="<?php echo $value['theme_page_topic_image']['url'] ?>"/>
    </a>
  </div>
  <div class="info">
    <p><?php echo $value['theme_page_short_topic_description'] ?></p>
  </div>
</div><?php
}
?>