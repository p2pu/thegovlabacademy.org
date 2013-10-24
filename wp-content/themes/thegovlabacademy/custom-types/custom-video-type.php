<?php
// Register Custom Post Type
function video_post_type() {

  $labels = array(
    'name'                => _x( 'Videos', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Video', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Videos', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Video:', 'text_domain' ),
    'all_items'           => __( 'All Videos', 'text_domain' ),
    'view_item'           => __( 'View Video', 'text_domain' ),
    'add_new_item'        => __( 'Add New Video', 'text_domain' ),
    'add_new'             => __( 'New Video', 'text_domain' ),
    'edit_item'           => __( 'Edit Video', 'text_domain' ),
    'update_item'         => __( 'Update Video', 'text_domain' ),
    'search_items'        => __( 'Search videos', 'text_domain' ),
    'not_found'           => __( 'No videos found', 'text_domain' ),
    'not_found_in_trash'  => __( 'No videos found in Trash', 'text_domain' ),
  );
  $rewrite = array(
    'slug'                => 'video',
    'with_front'          => true,
    'pages'               => true,
    'feeds'               => true,
  );
  $args = array(
    'label'               => __( 'video', 'text_domain' ),
    'description'         => __( 'Video information pages', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'page-attributes', ),
    'taxonomies'          => array( 'post_tag' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 21,
    'menu_icon'           => '',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'query_var'           => 'video',
    'rewrite'             => $rewrite,
    'capability_type'     => 'page',
  );
  register_post_type( 'video', $args );

}

// Hook into the 'init' action
add_action( 'init', 'video_post_type', 0 );