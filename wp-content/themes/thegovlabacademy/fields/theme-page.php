<?php

// Code to create theme Page Template

// Subtitle on theme page
simple_fields_register_field_group('theme_page_subtitle_group', array(
  'name' => 'Details',
  'fields' => array(
    array(
      'name' => 'Short description',
      'slug' => 'theme_page_subtitle',
      'type' => 'text',
    ),
    array(
      'name' => 'Quote',
      'slug' => 'theme_page_quote',
      'description'=> 'Add Inspirational Quote',
      'type' => 'textarea',
    ),
    array(
      'name' => 'Quote Author',
      'slug' => 'theme_page_quote_author',
      'description'=> 'Add Inspirational Quote Author (if any)',
      'type' => 'text'
    )
  ),
  'repeatable' => FALSE,
  'deleted' => false
));

simple_fields_register_field_group('theme_page_video_group', array(
  'name' => 'Video section',
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
  'repeatable' => FALSE,
  'deleted' => false
));

// Experts section
simple_fields_register_field_group('theme_page_experts_group', array(
  'name' => 'Experts section',
  'fields' => array(
    array(
      'name' => 'Expert',
      'slug' => 'experts',
      'type' => 'post',
      'options' => array(
        'enabled_post_types' => 'expert'
      )
    ),
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

simple_fields_register_post_connector('theme_page_connector',
  array (
    'name' => 'Theme Page',
    'field_groups' => array(
      array('name' => 'Page Subtitle',
        'key' => 'theme_page_subtitle_group',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Video Section',
        'key' => 'theme_page_video_group',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Theme Experts',
        'key' => 'theme_page_experts_group',
        'context' => 'normal',
        'priority' => 'high'),
    ),
    'post_types' => array('page'),
    'hide_editor' => 1,
    'deleted' => false
  )
);
