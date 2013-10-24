<?php

// Code to create theme Page Template

// Subtitle on theme page
simple_fields_register_field_group('theme_page_subtitle_group', array(
  'name' => 'Subtitle',
  'fields' => array(
    array(
      'name' => 'Longer title',
      'slug' => 'theme_page_subtitle',
      'type' => 'text',
    )
  ),
  'repeatable' => FALSE,
  'deleted' => false
));

simple_fields_register_field_group('theme_page_video_group', array(
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

// Subtitle on theme page
simple_fields_register_field_group('theme_page_inspirational_quote', array(
  'name' => 'Inspirational Quote',
  'fields' => array(
    array(
      'name' => 'Inspirational Quote',
      'slug' => 'theme_page_quote',
      'description'=> 'Add Inspirational Quote',
      'type' => 'textarea',
      'type_textarea_options' => array('use_html_editor' => 1)
    ),
    array(
      'name' => 'Inspirational Quote Author',
      'slug' => 'theme_page_quote_author',
      'description'=> 'Add Inspirational Quote Author (if any)',
      'type' => 'text'
    )
  ),
  'repeatable' => FALSE,
  'deleted' => false
));

// Experts section
simple_fields_register_field_group('theme_page_experts_group', array(
  'name' => 'Experts',
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
      array('name' => 'Inspirational Quote',
        'key' => 'theme_page_inspirational_quote',
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
