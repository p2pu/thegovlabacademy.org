<?php
/**
 * Sunspot Theme Options
 *
 * @package Sunspot
 * @since Sunspot 1.0
 */

/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 */
function sunspot_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'sunspot-theme-options', get_template_directory_uri() . '/inc/theme-options/theme-options.css', false, '2012-03-05' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'sunspot_admin_enqueue_scripts' );

/**
 * Register the form setting for our sunspot_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, sunspot_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * We also use this function to add our theme option if it doesn't already exist.
 *
 * @since Sunspot 1.0
 */
function sunspot_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === sunspot_get_theme_options() )
		add_option( 'sunspot_theme_options', sunspot_get_default_theme_options() );

	register_setting(
		'sunspot_options',       // Options group, see settings_fields() call in sunspot_theme_options_render_page()
		'sunspot_theme_options', // Database option, see sunspot_get_theme_options()
		'sunspot_theme_options_validate' // The sanitization callback, see sunspot_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see sunspot_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'home_layout', // Unique identifier for the field for this section
		__( 'How would you like to display posts on the front page?', 'sunspot' ), // Setting field label
		'sunspot_settings_home_layout', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see sunspot_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
}
add_action( 'admin_init', 'sunspot_theme_options_init' );

/**
 * Change the capability required to save the 'sunspot_options' options group.
 *
 * @see sunspot_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see sunspot_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function sunspot_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_sunspot_options', 'sunspot_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Sunspot 1.0
 */
function sunspot_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'sunspot' ),   // Name of page
		__( 'Theme Options', 'sunspot' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'sunspot_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'sunspot_theme_options_add_page' );

/**
 * Returns an array of radio options registered for Sunspot.
 *
 * @since Sunspot 1.0
 */
function sunspot_radio_buttons() {
	$home_radio_buttons = array(
		'single' => array(
			'value' => 'single',
			'label' => __( 'Single Column, with full post content', 'sunspot' )
		),
		'double' => array(
			'value' => 'double',
			'label' => __( 'Two Columns, with excerpts and featured images', 'sunspot' )
		)
	);

	return apply_filters( 'sunspot_radio_buttons', $home_radio_buttons );
}

/**
 * Returns the default options for Sunspot.
 *
 * @since Sunspot 1.0
 */
function sunspot_get_default_theme_options() {
	$default_theme_options = array(
		'sunspot_radio_buttons' => 'single',
	);

	return apply_filters( 'sunspot_default_theme_options', $default_theme_options );
}

/**
 * Returns the options array for Sunspot.
 *
 * @since Sunspot 1.0
 */
function sunspot_get_theme_options() {
	return get_option( 'sunspot_theme_options', sunspot_get_default_theme_options() );
}


/**
 * Renders the radio options setting field.
 *
 * @since Sunspot 1.0
 */
function sunspot_settings_home_layout() {
	$options = sunspot_get_theme_options();

	foreach ( sunspot_radio_buttons() as $button ) {
	?>
	<div class="layout">
		<label class="description sunspot-label">
			<input type="radio" name="sunspot_theme_options[sunspot_radio_buttons]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['sunspot_radio_buttons'], $button['value'] ); ?> />
			<span class="sunspot-layouts">
				<img src="<?php echo get_template_directory_uri(); ?>/inc/theme-options/images/<?php echo $button['value']; ?>.png"/>
				<?php echo $button['label']; ?>
			</span>
		</label>
	</div>
	<?php
	}
}

/**
 * Returns the options array for Sunspot.
 *
 * @since Sunspot 1.0
 */
function sunspot_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'sunspot' ), get_current_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'sunspot_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see sunspot_theme_options_init()
 *
 * @since Sunspot 1.0
 */
function sunspot_theme_options_validate( $input ) {
	$output = $defaults = sunspot_get_default_theme_options();

	// The sample radio button value must be in our array of radio button values
	if ( isset( $input['sunspot_radio_buttons'] ) && array_key_exists( $input['sunspot_radio_buttons'], sunspot_radio_buttons() ) )
		$output['sunspot_radio_buttons'] = $input['sunspot_radio_buttons'];

	return apply_filters( 'sunspot_theme_options_validate', $output, $input, $defaults );
}