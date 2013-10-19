<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Bouquet
 */
?>

	</div><!-- #main -->
</div><!-- #page -->

<footer id="colophon" role="contentinfo">
	<div id="site-generator-wrapper">
		<div id="site-generator">
			<?php do_action( 'bouquet_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'bouquet' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'bouquet' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'bouquet' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'bouquet' ), 'Bouquet', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
		</div><!-- #site-generator -->
	</div><!-- #site-generator-wrapper -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>