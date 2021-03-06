			<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrapper clearfix">

					<nav role="navigation">
							<?php bones_footer_links(); ?>
					</nav>
                    <div class="govlab-info sixcol first">
                        <a href="http://thegovlab.org/" target="_blank">
                            <div class="twocol first">
                                <img src="<?php echo get_template_directory_uri(); ?>/library/images/govlab-logo.png" alt="GovLab Logo"/>
                            </div>
                        </a>
                        <div class="tencol first">
                             <address>
                                 <a href="http://thegovlab.org/" tarhet="_blank">The GovLab</a><br/>
                                 Wagner Graduate School of Public Service <br/>
                                 New York University <br/>
                                 The Puck Building
                                 295 Lafayette Street
                                 New York, NY 10012
                             </address>
                        </div>
                    </div>
                    <div class="copyright fourcol">

                            <div class="threecol first">
                                <img src="<?php echo get_template_directory_uri(); ?>/library/images/licence.png" alt="Licence CC BY CA"/>
                            </div>
                            <div class="sevencol source-org">
                                Unless otherwise noted,
                                all content licensed under
                                <a href="http://creativecommons.org/licenses/by-sa/3.0/">
                                    Creative Commons BY SA 3.0</a>.
                            </div>

                    </div>
                    <div class="social twocol">
                        <ul>
                            <li><a href="https://twitter.com/thegovlab" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                            <li><a href="http://www.facebook.com/thegovlab" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                            <li><a href="http://www.youtube.com/thegovlab" target="_blank"><i class="fa fa-youtube-square"></i></a></li>
                            <li><a href="http://thegovlab.org/feed/" target="_blank"><i class="fa fa-rss-square"></i></a></li>
                        </ul>
                    <div>

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
