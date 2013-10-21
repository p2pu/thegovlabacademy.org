<?php

// Code to create Topic Page Template

// Featured section
simple_fields_register_field_group('topic_page_featured_section', array(
  'name' => 'Featured Section',
  'fields' => array(
    array(
      'name' => 'Link to Youtube Video',
      'slug' => 'topic_featured_youtube_link',
      'description'=> 'If you wish to show video on featured jumbotron',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Link to Image',
      'slug' => 'topic_featured_image_link',
      'description'=> 'Put here link to featured image if it is hosted somewhere else',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Image Upload',
      'slug' => 'topic_featured_image_upload',
      'description'=> 'Upload an Image if is not hosted somewhere else',
      'type' => 'file'
    ),
    array(
      'name' => 'Call to Action Button',
      'slug' => 'topic_featured_call_to_action_button',
      'description'=> 'If you didn\'t put in either featured video or featured image you can call to action
                        This will show up as a big button.' ,
      'type' => 'text'
    ),
    array(
      'name' => 'Call to Action Link',
      'slug' => 'topic_featured_call_to_action_url',
      'description'=> 'The url to go when call to action is enabled' ,
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Title',
      'slug' => 'topic_featured_title',
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


// Learn more section
simple_fields_register_field_group('topic_learn_more_section', array(
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
      'type' => 'textarea'
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

// Read more section
simple_fields_register_field_group('topic_literature', array(
  'name' => 'Read',
  'fields' => array(
    array(
      'name' => 'Document URL',
      'slug' => 'topic_page_source_url',
      'description'=> 'Add url to the source',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Source Title',
      'slug' => 'topic_page_source_title',
      'description'=> 'Add title for the source',
      'type' => 'text'
    ),
    array(
      'name' => 'Source Description',
      'slug' => 'topic_page_source_description',
      'description'=> 'Add short description about the source',
      'type' => 'textarea'
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
