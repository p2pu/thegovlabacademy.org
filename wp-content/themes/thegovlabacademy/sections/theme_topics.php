
<?php
$my_wp_query = new WP_Query();
$all_wp_pages = $my_wp_query->query(array('post_type' => 'page'));

$pages = &get_page_children( get_the_ID(), $all_wp_pages );
if($pages){?>
  <h2>Featured Videos</h2><?php
  foreach ($pages as $key => $value){
    $topic = get_page_by_title($pages[0]->post_title);
    $video_id = simple_fields_get_post_value($topic->ID, "Video", true);
    $video_link = simple_fields_get_post_value($video_id, "Link to video", true);
    $video_description = simple_fields_get_post_value($video_id, "Description", true);
    ?>
    <div class="threecol <?php if ($key === 0 or ($key %4) == 0) echo ' first'?>">
      <div class="four-col">
        <h2><?php echo $topic->post_name; ?></h2>
        <iframe width="100%" height="300"
                src="<?php echo $video_link; ?>"
                frameborder="0" allowfullscreen></iframe>
      </div>
      <div class="info">
        <h3><a href=""><?php echo $topic->post_title; ?></a></h3>
        <h4></h4>
        <p><?php echo $video_description ?></p>
      </div>
    </div>
    </div><?php
  }?>

<?php }
//print_r($pages);

?>