<?php
/**
 * @package WordPress
 * @subpackage Pink Touch 2
 */
?>
<form method="get" id="searchfield" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input name="s" type="text" onfocus="if ( this.value=='<?php esc_attr_e( 'Search', 'pinktouch' ); ?>' ) this.value='';" onblur="if ( this.value=='' ) this.value='<?php esc_attr_e( 'Search', 'pinktouch' ); ?>';" value="<?php esc_attr_e( 'Search', 'pinktouch' ); ?>" />
</form>