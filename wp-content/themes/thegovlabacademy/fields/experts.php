<?php

simple_fields_register_field_group('expert_fields', array(
  'name' => 'Details',
  'fields' => array(
    array(
      'name' => 'About',
      'slug' => 'expert_about',
      'description'=> 'Describe your expert',
      'type' => 'textarea',

    ),
    array(
      'name' => 'Twitter handle',
      'slug' => 'expert_twitter_handle',
      'description'=> 'Enter twitter handle',
      'type' => 'text'
    ),
    array(
      'name' => 'Image',
      'slug' => 'expert_image',
      'description'=> 'Enter image',
      'type' => 'file'
    )

  ),
  'repeatable' => FALSE,
  'deleted' => false
));

simple_fields_register_post_connector('experts_connector',
  array (
    'name' => 'Experts Group',
    'field_groups' => array(
      array('name' => 'Expert',
        'key' => 'expert_fields',
        'context' => 'normal',
        'priority' => 'high'),
    ),
    'post_types' => array('expert'),
    'hide_editor' => 1,
    'deleted' => false
  )
);

simple_fields_register_post_type_default('experts_connector', 'expert');