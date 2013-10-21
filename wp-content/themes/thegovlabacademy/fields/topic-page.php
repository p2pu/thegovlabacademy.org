<?php

// Code to create Topic Page Template
simple_fields_register_field_group('topic_page_featured_section', array(
  'name' => 'Featured Section',
  'fields' => array(
    array(
      'name' => 'Link to Youtube Video',
      'slug' => 'youtube_link',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Title',
      'slug' => 'title',
      'type' => 'text'
    ),
    array(
      'name' => 'Course Title',
      'slug' => 'course_title',
      'type' => 'text'
    ),
    array(
      'name' => 'Description',
      'slug' => 'description',
      'type' => 'textarea'
    )
  ),
  'repeatable' => FALSE,
  'deleted' => false
));

simple_fields_register_field_group('topic_learn_more_section', array(
  'name' => 'Learn More Section',
  'fields' => array(
    array(
      'name' => 'Link to Youtube Video',
      'slug' => 'you_tube_id',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Title',
      'slug' => 'title',
      'type' => 'text'
    ),
    array(
      'name' => 'Course Title',
      'slug' => 'course_title',
      'type' => 'text'
    ),
    array(
      'name' => 'Description',
      'slug' => 'learn_more_description',
      'type' => 'textarea'
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

simple_fields_register_field_group('topic_literature', array(
  'name' => 'Read',
  'fields' => array(
    array(
      'name' => 'Document Title',
      'slug' => 'topic_page_document_title',
      'description'=> 'Add title to display for document',
      'type' => 'text'
    ),
    array(
      'name' => 'Document Description',
      'slug' => 'topic_page_document_description',
      'description'=> 'Add short description to display document',
      'type' => 'text'
    ),
    array(
      'name' => 'Document Upload',
      'slug' => 'topic_page_document_upload',
      'description'=> 'Upload a file',
      'type' => 'file'
    ),
    array(
      'name' => 'Document URL',
      'slug' => 'topic_page_document_url',
      'description'=> 'If documented can not be uploaded use url to it',
      'type' => 'text'
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

simple_fields_register_field_group('topic_experts', array(
  'name' => 'Experts',
  'fields' => array(
    array(
      'name' => 'Expert Twitter Handle',
      'slug' => 'expert_twitter_handle',
      'description'=> 'Add a Twitter handle of an expert',
      'type' => 'text'
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
        'key' => 'topic_page_featured_section',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Learn More Section',
        'key' => 'topic_learn_more_section',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Topic Literature',
        'key' => 'topic_literature',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Experts',
        'key' => 'topic_experts',
        'context' => 'normal',
        'priority' => 'high'),
    ),
    'post_types' => array('page'),
    'hide_editor' => 0,
    'deleted' => false
  )
);

//simple_fields_register_post_type_default('video_section_connector', 'page');
