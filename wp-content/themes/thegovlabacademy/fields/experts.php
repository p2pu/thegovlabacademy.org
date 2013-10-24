<?php

simple_fields_register_field_group('expert_fields', array(
  'name' => 'Experts',
  'fields' => array(
    array(
      'name' => 'Name',
      'slug' => 'expert_name',
      'description'=> 'Enter first, last name',
      'type' => 'text'
    ),
    array(
      'name' => 'About',
      'slug' => 'expert_about',
      'description'=> 'Write expert about description',
      'type' => 'textarea',

    ),
    array(
      'name' => 'Twitter handle',
      'slug' => 'expert_twitter_handle',
      'description'=> 'Enter twitter handle',
      'type' => 'text'
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