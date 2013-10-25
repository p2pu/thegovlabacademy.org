<?php
$topic_values = simple_fields_fieldgroup('theme_page_topic_group');
//print_r($topic_values);

foreach($topic_values as $key=> $value){
  //print_r($key);
  //print_r($value);?>
<div class="threecol <?php if($key === 0){echo ' first';} ?>">
  <div class="topic-img">
    <img src="<?php echo $value['theme_page_topic_image']['url'] ?>"
                              alt="<?php echo $value['theme_page_topic_image']['url'] ?>"/>
  </div>
  <div class="info">
    <p><?php echo $value['theme_page_short_topic_description'] ?></p>
  </div>
</div><?php
}
?>