<?php
// Register Navigation Menus
function thegovlab_menus() {

  $locations = array(
    'institutional_menu' => __( 'Institutional Menu', 'text_domain' ),
    'theme_menu' => __( 'Theme Menu', 'text_domain' ),
  );
  register_nav_menus( $locations );
}

// Hook into the 'init' action
add_action( 'init', 'thegovlab_menus' );