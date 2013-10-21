<?php
$learn_more_videos = simple_fields_fieldgroup('topic_learn_more_section');
$number_of_videos = count($learn_more_videos);

switch ($number_of_videos){
  case 1:
    $col_class = 'twelvecol';
    break;
  case 2:
    $col_class = 'sixcol';
    break;
  case 3:
    $col_class = 'fourcol';
    break;
  default:
    $col_class = 'threecol';
}


foreach ($learn_more_videos as $key => $values) {?>
  <div class="<?php echo $col_class; if ($key === 0 or ($key %4) == 0) echo ' clear-left-margin'?>">
    <iframe width="100%" height="315" src="<?php echo $values['topic_learn_more_video_link']; ?>" frameborder="0" allowfullscreen></iframe>
    <h5><?php echo $values['topic_learn_more_video_title']; ?></h5>
    <p><?php echo $values['topic_learn_more_video_description']; ?></p>
  </div>
<?php } ?>
</div>