<?php
$topic_values = simple_fields_fieldgroup('theme_page_topic_group');
if($topic_values){?>
  <h2>Theme Topics</h2><?php
  foreach($topic_values as $key=> $value){?>
  <div class="theme-topic-list four-col <?php if($key === 0 or $key%4 === 0){echo 'first';} ?>">
    <a class="theme-topic" href="<?php echo $value['theme_topics']['permalink'] ?>">
    <div class="topic-img">
      <img src="<?php echo $value['theme_page_topic_image']['url'] ?>"
                                alt="<?php echo $value['theme_page_topic_image'] ?>"/>
    </div>
    <div class="info">
          <h3><?php echo $value['theme_page_topic_title'] ?></h3>
      <p><?php echo $value['theme_page_short_topic_description'] ?></p>
    </div>
    </a>
  </div><?php
  }
}
?>