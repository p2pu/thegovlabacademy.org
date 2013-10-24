<?php
// Register Custom Post Type
function document_post_type() {

  $labels = array(
    'name'                => _x( 'Documents', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Document', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Documents', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Document:', 'text_domain' ),
    'all_items'           => __( 'All Document', 'text_domain' ),
    'view_item'           => __( 'View Document', 'text_domain' ),
    'add_new_item'        => __( 'Add New Document', 'text_domain' ),
    'add_new'             => __( 'New Document', 'text_domain' ),
    'edit_item'           => __( 'Edit Document', 'text_domain' ),
    'update_item'         => __( 'Update Document', 'text_domain' ),
    'search_items'        => __( 'Search document', 'text_domain' ),
    'not_found'           => __( 'No document found', 'text_domain' ),
    'not_found_in_trash'  => __( 'No document found in Trash', 'text_domain' ),
  );
  $rewrite = array(
    'slug'                => 'document',
    'with_front'          => true,
    'pages'               => true,
    'feeds'               => true,
  );
  $args = array(
    'label'               => __( 'document', 'text_domain' ),
    'description'         => __( 'Document information pages', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'page-attributes', ),
    'taxonomies'          => array( 'post_tag' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 22,
    'menu_icon'           => '',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'query_var'           => 'document',
    'rewrite'             => $rewrite,
    'capability_type'     => 'page',
  );
  register_post_type( 'document', $args );

}

// Hook into the 'init' action
add_action( 'init', 'document_post_type', 0 );