<?php
/**
 * @package WordPress
 * @subpackage Pink Touch 2
 */

$audio_file = pinktouch_audio_grabber( $post->ID );
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="date">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'pinktouch' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
			<?php if ( ! is_singular() && is_sticky() ) : ?>
				<p><?php _e( 'Featured', 'pinktouch' ); ?></p>
			<?php else : ?>
				<p><span class="day"><?php the_time( 'd' ); ?></span><?php the_time( 'M / Y' ); ?></p>
			<?php endif; ?>
		</a>
	</div>

	<div class="content">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'pinktouch' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<div class="entry-content">
			<?php if ( ! empty( $audio_file ) ) : ?>
				<div class="player">
					<audio controls autobuffer id="audio-player-<?php echo $post->ID; ?>" src="<?php echo $audio_file; ?>">
						<source src="<?php echo $audio_file; ?>" type="audio/mp3" />
					</audio>
					<script type="text/javascript">
					    var audioTag = document.createElement( 'audio' );
					    if ( ! ( !! ( audioTag.canPlayType ) && ( "no" != audioTag.canPlayType( "audio/mpeg" ) ) && ( '' != audioTag.canPlayType( 'audio/mpeg' ) ) ) ) {
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
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pinktouch' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'pinktouch' ), 'after' => '</div>' ) ); ?>
			<?php if ( get_the_author_meta( 'description' ) && is_singular() ) pinktouch_author_info(); ?>
		</div><!-- .entry-content -->
	</div><!-- .content -->

	<?php pinktouch_post_data(); ?>
</div><!-- /.post -->