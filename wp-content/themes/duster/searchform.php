<?php
/**
 * @package WordPress
 * @subpackage Duster
 */
?>
	<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'duster' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'duster' ); ?>" />
	</form>
