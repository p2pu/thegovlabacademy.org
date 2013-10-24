<?php

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
      'description'=> 'If you wish to show video on featured jumbotron',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    )
  ),
  'repeatable' => FALSE,
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