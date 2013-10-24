<?php

simple_fields_register_field_group('documents_fields', array(
  'name' => 'Details',
  'fields' => array(
    array(
      'name' => 'Link to document',
      'slug' => 'document_url',
      'description'=> 'Enter URL (e.g. http://goo.gl/QR42y)',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Description',
      'slug' => 'document_description',
      'type' => 'textarea'
    )

  ),
  'repeatable' => FALSE,
  'deleted' => false
));

simple_fields_register_post_connector('document_connector',
  array (
    'name' => 'Documents',
    'field_groups' => array(
      array('name' => 'Documents',
        'key' => 'documents_fields',
        'context' => 'normal',
        'priority' => 'high'),
    ),
    'post_types' => array('document'),
    'hide_editor' => 1,
    'deleted' => false
  )
);

simple_fields_register_post_type_default('document_connector', 'document');