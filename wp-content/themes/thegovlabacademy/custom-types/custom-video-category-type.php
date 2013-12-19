<?php
// Register Custom Post Type
function video_category_post_type() {

  $labels = array(
    'name'                => _x( 'Video Category', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Video Category', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Video  Categories', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Video Category:', 'text_domain' ),
    'all_items'           => __( 'All Video Category', 'text_domain' ),
    'view_item'           => __( 'View Video Category', 'text_domain' ),
    'add_new_item'        => __( 'Add New Video Category', 'text_domain' ),
    'add_new'             => __( 'New Video Category', 'text_domain' ),
    'edit_item'           => __( 'Edit Video Category', 'text_domain' ),
    'update_item'         => __( 'Update Video Category', 'text_domain' ),
    'search_items'        => __( 'Search Video Category', 'text_domain' ),
    'not_found'           => __( 'No video categories found', 'text_domain' ),
    'not_found_in_trash'  => __( 'No video categories found in Trash', 'text_domain' ),
  );
  $rewrite = array(
    'slug'                => 'video_category',
    'with_front'          => true,
    'pages'               => true,
    'feeds'               => true,
  );
  $args = array(
    'label'               => __( 'video category', 'text_domain' ),
    'description'         => __( 'Video category information pages', 'text_domain' ),
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
    'query_var'           => 'video_category',
    'rewrite'             => $rewrite,
    'capability_type'     => 'page',
  );
  register_post_type( 'video_category', $args );

}

// Hook into the 'init' action
add_action( 'init', 'video_category_post_type', 0 );