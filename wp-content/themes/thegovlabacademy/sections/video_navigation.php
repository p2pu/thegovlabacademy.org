<?php
$type = 'video_category';
$args = array(
  'post_type' => $type,
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'ignore_sticky_posts' => 1
);

$my_query = null;
$my_query = new WP_Query($args);
if ($my_query->have_posts()) {
  ?>
  <ul class="video-categories-menu"><?php
  while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <li>
      <a href="<?php the_permalink() ?>" rel="video"
         title="Link to video category <?php the_title_attribute(); ?>"><?php the_title(); ?>
      </a>
    </li>
  <?php
  endwhile;?>
  </ul><?php
}
wp_reset_query(); // Restore global post data stomped by the_post().
?>