<?php
/**
 * @package WordPress
 * @subpackage Next Saturday
 */
$audio_file = next_saturday_themes_audio_grabber( $post->ID );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

	<?php next_saturday_entry_date(); ?>

	<div class="entry-container">
		<div class="entry-content">
			<div class="highlight-box">
				<?php if ( ! empty( $audio_file ) ) : ?>
				<div class="player">
					<audio controls autobuffer id="audio-player-<?php echo $post->ID; ?>" src="<?php echo $audio_file; ?>">
						<source src="<?php echo $audio_file; ?>" type="audio/mp3" />
					</audio>
					<script type="text/javascript">
						var audioTag = document.createElement('audio');
						if ( ! ( !! ( audioTag.canPlayType ) && ( "no" != audioTag.canPlayType("audio/mpeg" ) ) && ( '' != audioTag.canPlayType( 'audio/mpeg' ) ) ) ) {
						AudioPlayer.embed(
								"audio-player-<?php echo $post->ID; ?>", {
									soundFile: "<?php echo $audio_file; ?>",
									animation: 'no',
									width: '400'
								}
							);
						}
					</script>
				</div>
				<?php endif; ?>
			</div><!-- .highlight-box -->
			<?php the_content( __( 'Read more <span class="meta-nav">&rarr;</span>', 'next-saturday' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages:', 'next-saturday' ), 'after' => '</p></div>' ) ); ?>
		</div><!-- .entry-content -->

		<div class="entry-meta-wrap">
			<div class="entry-meta">
				<span class="comments-num"><?php comments_popup_link( __( 'Leave a comment', 'next-saturday' ), __( '1 Comment', 'next-saturday' ), __( '% Comments', 'next-saturday' ) ); ?></span>
				<?php edit_post_link( __( 'Edit this Entry', 'next-saturday' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
		</div>

	</div><!-- .entry-container -->
</article><!-- #post-## -->