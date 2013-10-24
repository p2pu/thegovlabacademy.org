<?php

// Code to create theme Page Template

// Subtitle on theme page
simple_fields_register_field_group('theme_page_subtitle_group', array(
  'name' => 'Page Subtitle',
  'fields' => array(
    array(
      'name' => 'Page subtitle',
      'slug' => 'theme_page_subtitle',
      'type' => 'text',
    )
  ),
  'repeatable' => FALSE,
  'deleted' => false
));

// Featured section
simple_fields_register_field_group('theme_page_featured_section', array(
  'name' => 'Featured Section',
  'fields' => array(
    array(
      'name' => 'Link to Youtube Video',
      'slug' => 'theme_page_featured_youtube_link',
      'description'=> 'If you wish to show video on featured jumbotron',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Link to Image',
      'slug' => 'theme_page_featured_image_link',
      'description'=> 'Put here link to featured image if it is hosted somewhere else',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Image Upload',
      'slug' => 'theme_page_featured_image_upload',
      'description'=> 'Upload an Image if is not hosted somewhere else',
      'type' => 'file'
    ),
    array(
      'name' => 'Call to Action Button',
      'slug' => 'theme_page_featured_call_to_action_button',
      'description'=> 'If you didn\'t put in either featured video or featured image you can call to action
                        This will show up as a big button.' ,
      'type' => 'text'
    ),
    array(
      'name' => 'Call to Action Link',
      'slug' => 'theme_page_featured_call_to_action_url',
      'description'=> 'The url to go when call to action is enabled' ,
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Title of media',
      'slug' => 'theme_page_featured_title',
      'type' => 'text'
    ),
    array(
      'name' => 'Description',
      'slug' => 'theme_page_featured_description',
      'type' => 'textarea',
      'type_textarea_options' => array('use_html_editor' => 1)
    )
  ),
  'repeatable' => FALSE,
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

// Topics section
simple_fields_register_field_group('theme_page_topics', array(
  'name' => 'Topics of the Theme',
  'fields' => array(
    array(
      'name' => 'Topic name',
      'slug' => 'theme_page_topic_name',
      'description'=> 'Write in Topic name',
      'type' => 'text'
    ),
    array(
      'name' => 'Topic Description',
      'slug' => 'theme_page_topic_description',
      'description'=> 'Add short description about the Topic',
      'type' => 'textarea',
      'type_textarea_options' => array('use_html_editor' => 1)
    ),
    array(
      'name' => 'Topic page',
      'slug' => 'theme_page_topic_page',
      'description'=> 'Add Topic Page',
      'type' => 'post',
      'options' => array(
        'enabled_post_types' => 'page'
      )
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

// Experts section
simple_fields_register_field_group('theme_page_experts_group', array(
  'name' => 'Theme experts',
  'fields' => array(
    array(
      'name' => 'Expert',
      'slug' => 'experts',
      'description'=> 'Enter an Expert',
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
      array('name' => 'Featured Section',
        'key' => 'theme_page_featured_section',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Inspirational Quote',
        'key' => 'theme_page_inspirational_quote',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Topics of this Theme ',
        'key' => 'theme_page_topics',
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
