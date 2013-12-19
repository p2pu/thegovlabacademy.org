<?php

simple_fields_register_field_group('video_categories', array(
  'name' => 'Details',
  'fields' => array(
    array(
      'name' => 'Description about category',
      'slug' => 'video_category_description',
      'description'=> 'Enter the description about video category',
      'type' => 'textarea',
      'options' => array(
        'use_html_editor' => 1,
        'enable_extended_return_values' => true
      )
    )
  ),
  'repeatable' => FALSE,
  'deleted' => false
));

simple_fields_register_post_connector('video_category_connector',
  array (
    'name' => 'Video Categories',
    'field_groups' => array(
      array('name' => 'Video Category',
        'key' => 'video_categories',
        'context' => 'normal',
        'priority' => 'high'),
    ),
    'post_types' => array('video_category'),
    'hide_editor' => 1,
    'deleted' => false
  )
);

simple_fields_register_post_type_default('video_category_connector', 'video_category');