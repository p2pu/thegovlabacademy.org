<?php

// Code to create theme Page Template

// Subtitle on theme page
// Subtitle on theme page
/*simple_fields_register_field_group('home_page_quote', array(
  'name' => 'Inspirational quote',
  'fields' => array(
    array(
      'name' => 'Quote',
      'slug' => 'home_page_quote',
      'description'=> 'Add Introduction Quote',
      'type' => 'textarea',
    ),
    array(
      'name' => 'Call to action',
      'slug' => 'home_page_quote_author',
      'description'=> 'Add Call to Action Text',
      'type' => 'text'
    ),
    array(
      'name' => 'Call to action link',
      'slug' => 'home_page_quote_author_link',
      'description'=> 'Add Call to Action Link',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
  ),
  'repeatable' => FALSE,
  'deleted' => false
));*/

// Videos section
/*simple_fields_register_field_group('home_page_videos', array(
  'name' => 'Videos section',
  'fields' => array(
    array(
      'name' => 'Name of the theme',
      'slug' => 'home_page_theme_name',
      'description'=> 'Enter a theme name which is presented',
      'type' => 'text'
    ),
    array(
      'name' => 'Title',
      'slug' => 'home_page_video_title',
      'description'=> 'Enter title for featured theme',
      'type' => 'text'
    ),
    array(
      'name' => 'Description',
      'slug' => 'home_page_video_description',
      'description'=> 'Enter description for featured theme',
      'type' => 'textarea',
    ),
    array(
      'name' => 'Video',
      'slug' => 'home_page_featured_videos',
      'type' => 'post',
      'options' => array(
        'enabled_post_types' => 'video',
        'enable_extended_return_values' => true
      )
    ),
    array(
      'name' => 'Page',
      'slug' => 'home_page_featured_pages',
      'type' => 'post',
      'options' => array(
        'enabled_post_types' => 'page',
        //'enable_extended_return_values' => true
      )
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));*/

/*simple_fields_register_field_group('home_page_featured_content', array(
  'name' => 'Featured content',
  'fields' => array(
    array(
      'name' => 'Title',
      'slug' => 'home_page_featured_content_title',
      'description' => 'Enter title of the content',
      'type' => 'text',
    ),
    array(
      'name' => 'Description',
      'slug' => 'home_page_featured_content_description',
      'description'=> 'Enter description for featured content',
      'type' => 'textarea',
    ),
    array(
      'name' => 'Image',
      'description' => 'Upload topic image',
      'slug' => 'home_page_topic_image',
      'type' => 'file',
      'options' => array(
        'enable_extended_return_values' => true
      )
    ),
  ),
  'repeatable' => TRUE,
  'deleted' => false
));*/


simple_fields_register_post_connector('home_page_connector',
  array (
    'name' => 'Home Page',
    'field_groups' => array(
      array('name' => 'Home Page Quote',
        'key' => 'home_page_quote',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Home Page Video Section',
        'key' => 'home_page_videos',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Home Page Featured Content',
        'key' => 'home_page_featured_content',
        'context' => 'normal',
        'priority' => 'high'),
    ),
    'post_types' => array('page'),
    'hide_editor' => 0,
    'deleted' => false
  )
);
