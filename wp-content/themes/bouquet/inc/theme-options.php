<?php

add_action( 'admin_init', 'bouquet_theme_options_init' );
add_action( 'admin_menu', 'bouquet_theme_options_add_page' );

/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 */
function bouquet_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'bouquet-theme-options', get_template_directory_uri() . '/inc/theme-options.css', false, '2011-09-30' );
	if ( is_rtl() ) {
		wp_enqueue_style( 'bouquet-theme-options-rtl', get_template_directory_uri() . '/inc/theme-options-rtl.css', false, '2011-09-30' );
	}
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'bouquet_admin_enqueue_scripts' );

// Init plugin options to white list our options
function bouquet_theme_options_init() {
	register_setting( 'bouquet_options', 'bouquet_theme_options', 'bouquet_theme_options_validate' );
}

// Load up the menu page
function bouquet_theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'bouquet' ), __( 'Theme Options', 'bouquet' ), 'edit_theme_options', 'theme_options', 'bouquet_theme_options_do_page' );
}

// Return array for our color schemes
function bouquet_color_schemes() {
	$color_schemes = array(
		'pink-dogwood' => array(
			'value' =>	'pink-dogwood',
			'label' => __( 'Pink Dogwood (Default)', 'bouquet' )
		),
		'forget-me-not' => array(
			'value' =>	'forget-me-not',
			'label' => __( 'Forget-Me-Not', 'bouquet' )
		),
		'tiger-lily' => array(
			'value' =>	'tiger-lily',
			'label' => __( 'Tiger Lily', 'bouquet' )
		),
	);

	return $color_schemes;
}

// Create the options page
function bouquet_theme_options_do_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<?php screen_icon(); echo "<h2>" . $theme_name . __( ' Theme Options', 'bouquet' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'bouquet' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'bouquet_options' ); ?>
			<?php $options = bouquet_get_options(); ?>

			<table class="form-table">

				<?php // Bouquet Color Scheme ?>
				<tr valign="top" id="bouquet-colors"><th scope="row"><?php _e( 'Color Scheme', 'bouquet' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Color Scheme', 'bouquet' ); ?></span></legend>
						<?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( bouquet_color_schemes() as $option ) {
								$radio_setting = $options['color_scheme'];

								if ( '' != $radio_setting ) {
									if ( $options['color_scheme'] == $option['value'] ) {
										$checked = "checked=\"checked\"";
									} else {
										$checked = '';
									}
								}
								?>
								<div class="layout">
								<label class="description">
									<input type="radio" name="bouquet_theme_options[color_scheme]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
									<span>
										<img src="<?php echo get_template_directory_uri(); ?>/colors/<?php echo $option['value']; ?>/<?php echo $option['value']; ?>.png"/>
										<?php echo $option['label']; ?>
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
				<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Options', 'bouquet' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function bouquet_theme_options_validate( $input ) {
	if ( ! array_key_exists( $input['color_scheme'], bouquet_color_schemes() ) )
		$input['color_scheme'] = 'pink-dogwood';

	return $input;
}
// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/