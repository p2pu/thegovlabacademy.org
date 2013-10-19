<?php
/**
 * @package WordPress
 * @subpackage Pink Touch 2
 */
?>
		<?php
			/* A sidebar in the footer? Yep. You can can customize
			 * your footer with three columns of widgets.
			 */
			get_sidebar( 'footer' );
		?>

		</div><!-- /#content -->
	</div><!-- /#wrapper -->

	<div id="footer-frill"></div>
	<div id="footer">
		<div class="wrapper">
			<p class="info-theme" role="contentinfo"><a href="http://wordpress.org/" rel="generator">Proudly powered by WordPress</a><span class="sep"> | </span><?php printf( __( 'Theme: %1$s by %2$s.', 'pinktouch' ), 'Pink Touch 2', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?></p>
		</div>
	</div>

<?php wp_footer(); ?>

</body>
</html>