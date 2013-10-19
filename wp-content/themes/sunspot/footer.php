<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Sunspot
 * @since Sunspot 1.0
 */
?>

			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="site-info">
					<?php do_action( 'sunspot_credits' ); ?>
					<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'sunspot' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'sunspot' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( __( 'Theme: %1$s by %2$s.', 'sunspot' ), 'Sunspot', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
				</div><!-- .site-info -->
			</footer><!-- .site-footer .site-footer -->
		</div><!-- #main -->

	</div><!-- #wrapper .wrap -->
</div><!-- #page .hfeed .site -->
<div class="sunstrip-small"></div>
<?php wp_footer(); ?>

</body>
</html>