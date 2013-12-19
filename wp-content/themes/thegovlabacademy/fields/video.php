<?php

// WP_Query arguments
$args = array (
  'post_type'              => 'video_category',
  'post_status'            => 'publish',
  'posts_per_page'         =>  -1,
  'ignore_sticky_posts'    =>  1
);

// The Query
$query = new WP_Query( $args );
$dropdown_values = array();
// The Loop
if ( $query->have_posts() ) {
  $num = 1;
  while ( $query->have_posts() ) {
    $query->the_post();
    $title = the_title($before='', $after='', $echo=false);
    $arr = array('num' => $num, 'value' => $title);
    $num++;
    array_push($dropdown_values, $arr);

  }
}

// Restore original Post Data
wp_reset_postdata();


simple_fields_register_field_group('video_fields', array(
  'name' => 'Details',
  'fields' => array(
    array(
      'name' => 'Description',
      'slug' => 'video_description',
      'type' => 'textarea'
    ),
    array(
      'name' => 'Link to video',
      'slug' => 'video_link',
      'description'=> 'Enter youtube or vimeo URL (e.g. http://youtu.be/9MttCgc_0fg or http://vimeo.com/77484567)',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Category',
      'slug' => 'video_category_slug',
      'description'=> 'Enter Category',
      'type' => 'dropdown',
      'options' => array(
        'enable_multiple' => true,
        'values' => $dropdown_values,
        //'enable_extended_return_values' => true
      )
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

simple_fields_register_post_connector('video_connector',
  array (
    'name' => 'Videos',
    'field_groups' => array(
      array('name' => 'Video',
        'key' => 'video_fields',
        'context' => 'normal',
        'priority' => 'high'),
    ),
    'post_types' => array('video'),
    'hide_editor' => 1,
    'deleted' => false
  )
);

simple_fields_register_post_type_default('video_connector', 'video');