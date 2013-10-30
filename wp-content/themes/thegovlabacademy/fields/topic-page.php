<?php

// Code to create Topic Page Template

simple_fields_register_field_group('topic_page_video_group', array(
  'name' => 'Primary video section',
  'fields' => array(
    array(
      'name' => 'Video',
      'slug' => 'videos',
      'type' => 'post',
      'options' => array(
        'enabled_post_types' => 'video',
        'enable_extended_return_values' => true
      )
    ),
  ),
  'repeatable' => FALSE,
  'deleted' => false
));

// Learn more section
simple_fields_register_field_group('topic_page_learn_more_section', array(
  'name' => 'Secondary videos section',
  'fields' => array(
    array(
      'name' => 'Video',
      'slug' => 'learn_more_videos',
      'type' => 'post',
      'options' => array(
        'enabled_post_types' => 'video',
        'enable_extended_return_values' => true
      )
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

// Learn more section
simple_fields_register_field_group('topic_page_read_section', array(
  'name' => 'Read section',
  'fields' => array(
    array(
      'name' => 'Documents',
      'slug' => 'documents',
      'type' => 'post',
      'options' => array(
        'enabled_post_types' => 'document',
        'enable_extended_return_values' => true
      )
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

// Tools section
simple_fields_register_field_group('topic_page_tools', array(
  'name' => 'Toolbox section',
  'fields' => array(
    array(
      'name' => 'Tool link',
      'slug' => 'topic_page_tool_url',
      'description'=> 'Enter URL of the tool (e.g. http://schoolofdata.org)',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Title',
      'slug' => 'topic_page_tool_title',
      'type' => 'text'
    ),
    array(
      'name' => 'Description',
      'slug' => 'topic_page_tool_description',
      'type' => 'textarea',
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

// Activities section
simple_fields_register_field_group('topic_page_activities', array(
  'name' => 'Activities section',
  'fields' => array(
    array(
      'name' => 'Activity link',
      'slug' => 'topic_page_activity_url',
      'description'=> 'Enter URL of the activity (e.g. http://schoolofdata.org)',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Title',
      'slug' => 'topic_page_activity_title',
      'type' => 'text'
    ),
    array(
      'name' => 'Description',
      'slug' => 'topic_page_activity_description',
      'description'=> 'Enter short description about the activity',
      'type' => 'textarea'
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

simple_fields_register_field_group('topic_page_experts_group', array(
  'name' => 'Experts section',
  'fields' => array(
    array(
      'name' => 'Expert',
      'slug' => 'experts',
      'description'=> 'Enter an Expert',
      'type' => 'post',
      'options' => array(
        'enabled_post_types' => 'expert',
        'enable_extended_return_values' => true
      )
    ),
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

simple_fields_register_post_connector('topic_page_connector',
  array (
    'name' => 'Topic Page',
    'field_groups' => array(
      array('name' => 'Featured Section',
        'key' => 'topic_page_video_group',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Learn More Section',
        'key' => 'topic_page_learn_more_section',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Topic Literature',
        'key' => 'topic_page_read_section',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Topic Activities',
        'key' => 'topic_page_activities',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Topic Toolbox',
        'key' => 'topic_page_tools',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Experts',
        'key' => 'topic_page_experts_group',
        'context' => 'normal',
        'priority' => 'high'),
    ),
    'post_types' => array('page'),
    'hide_editor' => 1,
    'deleted' => false
  )
);

//simple_fields_register_post_type_default('video_section_connector', 'page');
