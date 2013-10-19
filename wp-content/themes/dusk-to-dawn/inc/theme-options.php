<?php
/**
 * Dusk To Dawn Theme Options
 *
 * @package WordPress
 * @subpackage Dusk To Dawn
 */

/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 */
function dusktodawn_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'dusktodawn-theme-options', get_template_directory_uri() . '/inc/theme-options.css', false, '2011-10-08' );
	wp_enqueue_script( 'dusktodawn-theme-options', get_template_directory_uri() . '/inc/theme-options.js', array( 'farbtastic' ), '2011-10-08' );
	wp_enqueue_style( 'farbtastic' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'dusktodawn_admin_enqueue_scripts' );

/**
 * Register the form setting for our dusktodawn_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, dusktodawn_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * We also use this function to add our theme option if it doesn't already exist.
 */
function dusktodawn_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === dusktodawn_get_theme_options() )
		add_option( 'dusktodawn_theme_options', dusktodawn_get_default_theme_options() );

	register_setting(
		'dusktodawn_options', // Options group, see settings_fields() call in theme_options_render_page()
		'dusktodawn_theme_options', // Database option, see dusktodawn_get_theme_options()
		'dusktodawn_theme_options_validate' // The sanitization callback, see dusktodawn_theme_options_validate()
	);
}
add_action( 'admin_init', 'dusktodawn_theme_options_init' );

/**
 * Change the capability required to save the 'dusktodawn_options' options group.
 *
 * @see dusktodawn_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see dusktodawn_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * By default, the options groups for all registered settings require the manage_options capability.
 * This filter is required to change our theme options page to edit_theme_options instead.
 * By default, only administrators have either of these capabilities, but the desire here is
 * to allow for finer-grained control for roles and users.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function dusktodawn_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_dusktodawn_options', 'dusktodawn_option_page_capability' );

/**
 * Add our theme options page to the admin menu, including some help documentation.
 * This function is attached to the admin_menu action hook.
 */
function dusktodawn_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'dusktodawn' ), // Name of page
		__( 'Theme Options', 'dusktodawn' ), // Label in menu
		'edit_theme_options', // Capability required
		'theme_options', // Menu slug, used to uniquely identify the page
		'theme_options_render_page' // Function that renders the options page
	);

	if ( ! $theme_page )
		return;

	$help = '<p>' . __( 'Some themes provide customization options that are grouped together on a Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, Dusk To Dawn, provides the following Theme Options:', 'dusktodawn' ) . '</p>' .
			'<ol>' .
				'<li>' . __( '<strong>Accent Color</strong>: You can choose the color used for text links and the top line on your site. You can enter the HTML color or hex code, or you can choose visually by clicking the "Select a Color" button to pick from a color wheel.', 'dusktodawn' ) . '</li>' .
				'<li>' . __( '<strong>Layout</strong>: You can choose if you want your site&#8217;s layout to have a sidebar on the left, or the right.', 'dusktodawn' ) . '</li>' .
			'</ol>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 'dusktodawn' ) . '</p>' .
			'<p><strong>' . __( 'For more information:', 'dusktodawn' ) . '</strong></p>' .
			'<p>' . __( '<a href="http://codex.wordpress.org/Appearance_Theme_Options_Screen" target="_blank">Documentation on Theme Options</a>', 'dusktodawn' ) . '</p>' .
			'<p>' . __( '<a href="http://wordpress.com/support/" target="_blank">Support Forums</a>', 'dusktodawn' ) . '</p>';

	add_contextual_help( $theme_page, $help );
}
add_action( 'admin_menu', 'dusktodawn_theme_options_add_page' );

// Returns an array of layout options registered for Dusk To Down.
function dusktodawn_theme_layouts() {
	$theme_layout_options = array(
		'sidebar-content' => array(
			'value' => 'sidebar-content',
			'label' => __( 'Content on right', 'dusktodawn' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/sidebar-content.png',
		),
		'content-sidebar' => array(
			'value' => 'content-sidebar',
			'label' => __( 'Content on left', 'dusktodawn' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/content-sidebar.png',
		)
	);

	return apply_filters( 'dusktodawn_theme_layouts', $theme_layout_options );
}

// Returns the default options for dusktodawn.
function dusktodawn_get_default_theme_options() {
	$default_theme_options = array(
		'link_color'   => '#497ca7',
		'theme_layout' => 'sidebar-content'
	);
	if ( is_rtl() )
 		$default_theme_options['theme_layout'] = 'content-sidebar';
	return apply_filters( 'dusktodawn_default_theme_options', $default_theme_options );
}

// Returns the options array for dusktodawn.
function dusktodawn_get_theme_options() {
	return get_option( 'dusktodawn_theme_options', dusktodawn_get_default_theme_options() );
}

// Returns the options array for dusktodawn.
function theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'dusktodawn' ), get_current_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'dusktodawn_options' );
				$options = dusktodawn_get_theme_options();
				$default_options = dusktodawn_get_default_theme_options();
			?>
			<table class="form-table">
				<tr valign="top"><th scope="row"><?php _e( 'Accent Color', 'dusktodawn' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Accent Color', 'dusktodawn' ); ?></span></legend>
							<input type="text" name="dusktodawn_theme_options[link_color]" id="link-color" value="<?php echo esc_attr( $options['link_color'] ); ?>" />
							<a href="#" class="pickcolor hide-if-no-js" id="link-color-example"></a>
							<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color', 'dusktodawn' ); ?>" />
							<div id="colorPickerDiv" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
							<br />
							<span><?php printf( __( 'Default color: %s', 'dusktodawn' ), '<span id="default-color">#497ca7</span>' ); ?></span>
						</fieldset>
					</td>
				</tr>
				<tr valign="top" class="image-radio-option theme-layout"><th scope="row"><?php _e( 'Layout', 'dusktodawn' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Layout', 'dusktodawn' ); ?></span></legend>
						<?php
							foreach ( dusktodawn_theme_layouts() as $layout ) {
								?>
								<div class="layout">
								<label class="description">
									<input type="radio" name="dusktodawn_theme_options[theme_layout]" value="<?php echo esc_attr( $layout['value'] ); ?>" <?php checked( $options['theme_layout'], $layout['value'] ); ?> />

									<span>
										<img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="136" height="122" alt="" />
										<?php echo $layout['label']; ?>
									</span>
								</label>
								</div>
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>
			</table>
			<p class="submit">
				<?php submit_button( __( 'Save Options', 'dusktodawn' ), 'primary', 'submit', false ); ?>
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 * @see dusktodawn_theme_options_init()
 */
function dusktodawn_theme_options_validate( $input ) {
	$output = $defaults = dusktodawn_get_default_theme_options();

	// Link color must be 3 or 6 hexadecimal characters
	if ( isset( $input['link_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['link_color'] ) )
		$output['link_color'] = '#' . strtolower( ltrim( $input['link_color'], '#' ) );

	// Theme layout must be in our array of theme layout options
	if ( isset( $input['theme_layout'] ) && array_key_exists( $input['theme_layout'], dusktodawn_theme_layouts() ) )
		$output['theme_layout'] = $input['theme_layout'];

	return apply_filters( 'dusktodawn_theme_options_validate', $output, $input, $defaults );
}

/**
 * Add a style block to the theme for the current link color.
 * This function is attached to the wp_head action hook.
 */
function dusktodawn_print_link_color_style() {
	$options = dusktodawn_get_theme_options();
	$link_color = $options['link_color'];

	$default_options = dusktodawn_get_default_theme_options();

	// Don't do anything if the current link color is the default.
	if ( $default_options['link_color'] == $link_color )
		return;
?>
	<style>
		a,
		.entry-title a:hover,
		.widget_flickr #flickr_badge_uber_wrapper a:hover,
		.widget_flickr #flickr_badge_uber_wrapper a:link,
		.widget_flickr #flickr_badge_uber_wrapper a:active,
		.widget_flickr #flickr_badge_uber_wrapper a:visited {
			color: <?php echo $link_color; ?>;
		}
		.entry-header,
		.right-sidebar .entry-header {
			border-color: <?php echo $link_color; ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'dusktodawn_print_link_color_style' );

// Adds dusktodawn_layout_classes to the array of body classes.
function dusktodawn_layout_classes( $existing_classes ) {
	$options = dusktodawn_get_theme_options();
	$current_layout = $options['theme_layout'];
	if ( 'sidebar-content' == $current_layout )
		$classes[] = 'left-sidebar';
	elseif ( 'content-sidebar' == $current_layout )
		$classes[] = 'right-sidebar';
	else
		$classes[] = $current_layout;
	// override if layout page templates are used
	if ( is_page_template( 'full-width-page.php' ) ) $current_layout = 'no-sidebar';
	$classes[] = $current_layout;
	$classes = apply_filters( 'dusktodawn_layout_classes', $classes, $current_layout );
	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'dusktodawn_layout_classes' );