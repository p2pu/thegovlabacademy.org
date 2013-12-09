<?php
/*
Plugin Name: Super Simple Google Analytics
Plugin URI: http://shinraholdings.com/plugins/super-simple-google-analytics
Description: Bare bones option for people looking to simply insert the basic Google Analytics tracking code into the head section of every page without any fuss.
Version: 1.7.1
Author: bitacre
Author URI: http://shinraholdings.com
License: GPLv3
	Copyright 2012 Shinra Web Holdings (http://shinraholdings.com)
*/

if( !class_exists( 'superSimpleGoogleAnalytics' ) ) : // namespace collision check
class superSimpleGoogleAnalytics {
	// declare globals
	var $options_name = 'super_simple_google_analytics_item';
	var $options_group = 'super_simple_google_analytics_option_option';
	var $options_page = 'super_simple_google_analytics';
	var $plugin_homepage = 'http://shinraholdings.com/plugins/super-simple-google-analytics/';
	var $plugin_name = 'Super Simple Google Analytics';
	var $plugin_textdomain = 'SuperSimpleGoogleAnalytics';

	// constructor
	function superSimpleGoogleAnalytics() {
		$options = $this->optionsGetOptions();
		add_filter( 'plugin_row_meta', array( &$this, 'optionsSetPluginMeta' ), 10, 2 ); // add plugin page meta links
		add_action( 'admin_init', array( &$this, 'optionsInit' ) ); // whitelist options page
		add_action( 'admin_menu', array( &$this, 'optionsAddPage' ) ); // add link to plugin's settings page in 'settings' menu on admin menu initilization
		if( $options['location'] == 'head' )
			add_action( 'wp_head', array( &$this, 'getTrackingCode' ), 99999 ); 
		else
			add_action( 'wp_footer', array( &$this, 'getTrackingCode' ), 99999 ); 
		register_activation_hook( __FILE__, array( &$this, 'optionsCompat' ) );
	}

	// load i18n textdomain
	function loadTextDomain() {
		load_plugin_textdomain( $this->plugin_textdomain, false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) . 'lang/' );
	}
	
	
	// compatability with upgrade from version <1.4
	function optionsCompat() {
		$old_options = get_option( 'ssga_item' );
		if ( !$old_options ) return false;
		
		$defaults = optionsGetDefaults();
		foreach( $defaults as $key => $value )
			if( !isset( $old_options[$key] ) )
				$old_options[$key] = $value;
		
		add_option( $this->options_name, $old_options, '', false );
		delete_option( 'ssga_item' );
		return true;
	}
	
	// get default plugin options
	function optionsGetDefaults() { 
		$defaults = array( 
			'account' => '', 
			'profile' => '', 
			'insert_code' => 0,
			'location' => 'head',
			'track_admin' => 0,
			'track_adsense' => 0
		);
		return $defaults;
	}
	
	function optionsGetOptions() {
		$options = get_option( $this->options_name, $this->optionsGetDefaults() );
		return $options;
	}
	
	// set plugin links
	function optionsSetPluginMeta( $links, $file ) { 
		$plugin = plugin_basename( __FILE__ );
		if ( $file == $plugin ) { // if called for THIS plugin then:
			$newlinks = array( '<a href="options-general.php?page=' . $this->options_page . '">' . __( 'Settings', $this->plugin_textdomain ) . '</a>' ); // array of links to add
			return array_merge( $links, $newlinks ); // merge new links into existing $links
		}
	return $links; // return the $links (merged or otherwise)
	}
	
	// plugin startup
	function optionsInit() { 
		register_setting( $this->options_group, $this->options_name, array( &$this, 'optionsValidate' ) );
	}
	
	// create and link options page
	function optionsAddPage() { 
		add_options_page( $this->plugin_name . ' ' . __( 'Settings', $this->plugin_textdomain ), __( 'Google Analytics', $this->plugin_textdomain ), 'manage_options', $this->options_page, array( &$this, 'optionsDrawPage' ) );
	}
	
	// sanitize and validate options input
	function optionsValidate( $input ) { 
		$input['insert_code'] = ( $input['insert_code'] ? 1 : 0 ); 	// (checkbox) if TRUE then 1, else NULL
		$input['track_admin'] = ( $input['track_admin'] ? 1 : 0 ); 	// (checkbox) if TRUE then 1, else NULL
		$input['track_adsense'] = ( $input['track_adsense'] ? 1 : 0 ); 	// (checkbox) if TRUE then 1, else NULL
		$input['account'] =  wp_filter_nohtml_kses( $input['account'] ); // (textbox) safe text, no html
		$input['profile'] =  wp_filter_nohtml_kses( $input['profile'] ); // (textbox) safe text, no html
		$input['location'] = ( $input['location'] == 'head' ? 'head' : 'body' ); // (radio) either head or body
		return $input;
	}
	
	// draw a checkbox option
	function optionsDrawCheckbox( $slug, $label, $style_checked='', $style_unchecked='' ) { 
		$options = $this->optionsGetOptions();
		if( !$options[$slug] ) 
			if( !empty( $style_unchecked ) ) $style = ' style="' . $style_unchecked . '"';
			else $style = '';
		else
			if( !empty( $style_checked ) ) $style = ' style="' . $style_checked . '"';
			else $style = ''; 
	?>
		 <!-- <?php _e( $label, $this->plugin_textdomain ); ?> -->
			<tr valign="top">
				<th scope="row">
					<label<?php echo $style; ?> for="<?php echo $this->options_name; ?>[<?php echo $slug; ?>]">
						<?php _e( $label, $this->plugin_textdomain ); ?>
					</label>
				</th>
				<td>
					<input name="<?php echo $this->options_name; ?>[<?php echo $slug; ?>]" type="checkbox" value="1" <?php checked( $options[$slug], 1 ); ?>/>
				</td>
			</tr>
			
	<?php }
	
	// draw the options page
	function optionsDrawPage() { ?>
		<div class="wrap">
		<div class="icon32" id="icon-options-general"><br /></div>
			<h2><?php echo $this->plugin_name . __( ' Settings', $this->plugin_textdomain ); ?></h2>
			<form name="form1" id="form1" method="post" action="options.php">
				<?php settings_fields( $this->options_group ); // nonce settings page ?>
				<?php $options = $this->optionsGetOptions();  //populate $options array from database ?>
				
				<!-- Description -->
				<p style="font-size:0.95em"><?php 
					printf( __( 'You may post a comment on this plugin\'s <a href="%1$s">homepage</a> if you have any questions, bug reports, or feature suggestions.', $this->plugin_textdomain ), $this->plugin_homepage ); ?></p>
				
				<table class="form-table">
	
					<?php $this->optionsDrawCheckbox( 'insert_code', 'Insert tracking code?', '', 'color:#f00;' ); ?>					 
	
					 <!-- <?php _e( 'UA-numbers (text boxes)', $this->plugin_textdomain ); ?> -->
					<tr valign="top"><th scope="row"><label for="<?php echo $this->options_name; ?>[account]"><?php _e( 'Google Analytics Numbers', $this->plugin_textdomain ); ?>: </label></th>
						<td>
							UA-<input type="text" name="<?php echo $this->options_name; ?>[account]" value="<?php echo $options['account']; ?>" style="width:90px;" maxlength="8" />
							&ndash;<input type="text" name="<?php echo $this->options_name; ?>[profile]" value="<?php echo $options['profile']; ?>" style="width:30px;" maxlength="3" />
						</td>
					</tr>
					
					<!-- Head/Body insert (radio buttons) -->
					<tr valign="top"><th scope="row" valign="middle"><label for="<?php echo $this->options_name; ?>[location]"><?php _e( 'Insert Location', $this->plugin_textdomain ); ?>:</label></th>
						<td>
							<input name="<?php echo $this->options_name; ?>[location]" type="radio" value="head" <?php checked( $options['location'], 'head', TRUE ); ?> />
							<?php printf( 'before %1$shead%2$s tag', '&lt;/', '&gt;' ); ?><br />
							<input name="<?php echo $this->options_name; ?>[location]" type="radio" value="body" <?php checked( $options['location'], 'body', TRUE ); ?> />
							<?php printf( 'before %1$sbody%2$s tag', '&lt;/', '&gt;' ); ?>
						</td>
					</tr>
	
					<?php echo $this->optionsDrawCheckbox( 'track_admin', 'Track administrator hits?' ); ?>
					<?php echo $this->optionsDrawCheckbox( 'track_adsense', 'Track integrated AdSense data?' ); ?>
					
				</table>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', $this->plugin_textdomain ) ?>" />
				</p>
			</form>
		</div>
		
		<?php
	}
	
	// 	the Google Analytics html tracking code to be inserted in header/footer
	function getTrackingCode() { 
		$options = $this->optionsGetOptions();
	
	// header
	$header = sprintf( 
		__( '<!-- 
			Plugin: Super Simple Google Analytics 
	Plugin URL: %1$s', $this->plugin_textdomain ), 
		$this->plugin_name );
	
	// footer
	$footer = '
	-->';
	
	// code removed for all pages
	$disabled = $header . __( 'You\'ve chosen to prevent the tracking code from being inserted on 
	any page. 
	
	You can enable the insertion of the tracking code by going to 
	Settings > Google Analytics on the Dashboard.', $this->plugin_textdomain ) . $footer;
	
	// code removed for admin
	$admin = $header . __( 'You\'ve chosen to prevent the tracking code from being inserted on 
	pages viewed by logged-in administrators. 
	
	You can re-enable the insertion of the tracking code on all pages
	for all users by going to Settings > Google Analytics on the Dashboard.', $this->plugin_textdomain ) . $footer;
	
	// adsense tracking code
	$adsense = sprintf( 
		'<script type="text/javascript">
		window.google_analytics_uacct = "UA-%1$s-%2$s";
	</script>',
		$options['account'],
		$options['profile'] 
	);
	
	// core tracking code
	$core = sprintf( '<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push([\'_setAccount\', \'UA-%1$s-%2$s\']);
	  _gaq.push([\'_trackPageview\']);
	
	  (function() {
		var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
		ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
		var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>', 
		$options['account'],
		$options['profile'] 
	); 
	
	// build code
	if( !$options['insert_code'] ) 
		echo $disabled; 
	elseif( current_user_can( 'manage_options' ) && !$options['track_admin'] ) 
		echo $admin; 
	elseif( $options['track_adsense'] ) 
		echo $header . "\n\n" . $footer . "\n\n" . $adsense . "\n\n" . $core; 
	else 
		echo $header . "\n\n" . $footer . "\n\n" . $core ; 
	}
} // end class
endif; // end collision check

$superSimpleGoogleAnalytics_instance = new superSimpleGoogleAnalytics;
?>