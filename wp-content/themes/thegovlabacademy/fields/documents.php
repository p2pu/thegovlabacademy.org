<?php

simple_fields_register_field_group('documents_fields', array(
  'name' => 'Details',
  'fields' => array(
    array(
      'name' => 'Document URL',
      'slug' => 'document_url',
      'description'=> 'Enter URL',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Description',
      'slug' => 'document_description',
      'description'=> 'Enter short description about the document',
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