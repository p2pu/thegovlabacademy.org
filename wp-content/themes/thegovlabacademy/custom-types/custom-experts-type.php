<?php
// Register Custom Post Type
function expert_post_type() {

  $labels = array(
    'name'                => _x( 'Experts', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Expert', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Experts', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Expert:', 'text_domain' ),
    'all_items'           => __( 'All Experts', 'text_domain' ),
    'view_item'           => __( 'View Expert', 'text_domain' ),
    'add_new_item'        => __( 'Add New Expert', 'text_domain' ),
    'add_new'             => __( 'New Expert', 'text_domain' ),
    'edit_item'           => __( 'Edit Expert', 'text_domain' ),
    'update_item'         => __( 'Update Expert', 'text_domain' ),
    'search_items'        => __( 'Search experts', 'text_domain' ),
    'not_found'           => __( 'No experts found', 'text_domain' ),
    'not_found_in_trash'  => __( 'No experts found in Trash', 'text_domain' ),
  );
  $rewrite = array(
    'slug'                => 'expert',
    'with_front'          => true,
    'pages'               => true,
    'feeds'               => true,
  );
  $args = array(
    'label'               => __( 'expert', 'text_domain' ),
    'description'         => __( 'Expert on the topic', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'page-attributes', 'title'),
    'taxonomies'          => array( 'post_tag' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 20,
    'menu_icon'           => get_bloginfo('template_directory') . '/library/images/cpt-icons/user.png',
    'can_export'          => true,
    'has_archive'         => false,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'query_var'           => 'expert',
    'rewrite'             => $rewrite,
    'capability_type'     => 'page',
  );
  register_post_type( 'expert', $args );

}

// Hook into the 'init' action
add_action( 'init', 'expert_post_type', 0 );


