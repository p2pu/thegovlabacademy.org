<?php $learn_more_videos = simple_fields_fieldgroup('topic_page_learn_more_section');
if($learn_more_videos){?>
  <h2 class="section-heading">Learn more</h2><?php
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


  foreach ($learn_more_videos as $key => $value) {

    $video = get_post($value['id']);
    print_r($video->title);
    $video_link = simple_fields_get_post_value($video->ID, "Link to video", true);
    $video_description = simple_fields_get_post_value($value['id'], "Description", true);
    //print_r($video);?>
    <div class="<?php echo $col_class; if ($key === 0 or ($key %4) == 0) echo ' first'?>">
      <h2><?php echo $video->title; ?></h2>
      <?php echo do_shortcode('[fve]' . $video_link . '[/fve]') ?>
      <div class="info">
        <h3><?php echo $value['title']; ?></h3>
        <h4></h4>
        <p><?php echo $video_description ?></p>
      </div>
    </div>
  <?php } ?>
<?php } ?>
