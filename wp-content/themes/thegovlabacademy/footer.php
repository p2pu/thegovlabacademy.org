			<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix">

					<nav role="navigation">
							<?php bones_footer_links(); ?>
					</nav>

					<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>

				</div> <?php // end #inner-footer ?>

			</footer> <?php // end footer ?>

		</div> <?php // end #container ?>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>
    <script src='<?php echo get_template_directory_uri(); ?>/library/js/libs/parsley.min.js' type='text/javascript'></script>
    <script src='<?php echo get_template_directory_uri(); ?>/library/js/subscribe-script.js' type='text/javascript'></script>
    <script type="text/javascript">
      Subscribe.Form.init();
    </script>
	</body>

</html> <?php // end page. what a ride! ?>
