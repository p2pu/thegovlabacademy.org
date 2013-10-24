<?php

// Code to create Topic Page Template

simple_fields_register_field_group('topic_page_video_group', array(
  'name' => 'Video',
  'fields' => array(
    array(
      'name' => 'Video',
      'slug' => 'videos',
      'type' => 'post',
      'options' => array(
        'enabled_post_types' => 'video'
      )
    ),
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

// Learn more section
simple_fields_register_field_group('topic_page_learn_more_section', array(
  'name' => 'Learn More Section',
  'fields' => array(
    array(
      'name' => 'Link to Youtube Video',
      'slug' => 'topic_learn_more_video_link',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Title',
      'slug' => 'topic_learn_more_video_title',
      'type' => 'text'
    ),
    array(
      'name' => 'Description',
      'slug' => 'topic_learn_more_video_description',
      'type' => 'textarea',
      'type_textarea_options' => array('use_html_editor' => 1)
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

// Read more section
simple_fields_register_field_group('topic_page_read_more', array(
  'name' => 'Documents',
  'fields' => array(
    array(
      'name' => 'Document',
      'slug' => 'documents',
      'type' => 'post',
      'options' => array(
        'enabled_post_types' => 'document'
      )
    ),
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

// Tools section
simple_fields_register_field_group('topic_page_tools', array(
  'name' => 'Toolbox',
  'fields' => array(
    array(
      'name' => 'Tool url',
      'slug' => 'topic_page_tool_url',
      'description'=> 'Add url to the tool',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Tool Title',
      'slug' => 'topic_page_tool_title',
      'description'=> 'Add title for the tool',
      'type' => 'text'
    ),
    array(
      'name' => 'Tool Description',
      'slug' => 'topic_page_tool_description',
      'description'=> 'Add short description about the tool',
      'type' => 'textarea',
      'type_textarea_options' => array('use_html_editor' => 1)
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

// Activities section
simple_fields_register_field_group('topic_page_activities', array(
  'name' => 'Activities',
  'fields' => array(
    array(
      'name' => 'Activity url',
      'slug' => 'topic_page_activity_url',
      'description'=> 'Add url to the activity',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Activity Title',
      'slug' => 'topic_page_activity_title',
      'description'=> 'Add title for the activity',
      'type' => 'text'
    ),
    array(
      'name' => 'Activity Description',
      'slug' => 'topic_page_activity_description',
      'description'=> 'Add short description about the activity',
      'type' => 'textarea',
      'type_textarea_options' => array('use_html_editor' => 1)
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

simple_fields_register_field_group('topic_page_experts_group', array(
  'name' => 'Experts',
  'fields' => array(
    array(
      'name' => 'Expert',
      'slug' => 'experts',
      'description'=> 'Enter an Expert',
      'type' => 'text',
      'options' => array(
        'enabled_post_types' => 'expert'
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
        'key' => 'topic_page_literature',
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
