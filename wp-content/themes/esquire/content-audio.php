<?php
/**
 * The template for displaying Image Posts
 *
 * @package Esquire
 * @since Esquire 1.0
 */

$audio_file = wpcom_themes_audio_grabber( $post->ID );
?>

<div <?php post_class(); ?>>
	<?php if ( ! is_page() ) : ?>
	<div class="datebox">
		<p class="day"><?php the_time( 'd' ); ?></p>
		<p class="month"><?php the_time( 'M' ); ?></p>
	</div>
	<?php endif; ?>

	<div class="postbody audio">
		<div class="content">
			<?php if ( has_post_thumbnail() ) :
			$album_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'audio' ); ?>
			<div class="artwork">
				<div class="overlay"></div>
				<img src="<?php echo $album_image[0]; ?>" width="207" height="207" alt="<?php esc_attr_e( 'Album Art', 'esquire' ); ?>" />
			</div>
			<?php endif; ?>

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

			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'esquire' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'esquire' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .content -->

		<?php comments_template( '', true ); ?>

		<div class="meta bar">
			<p class="permalink">
				<?php if ( ! is_page() ) : ?>
				<a href="<?php the_permalink(); ?>"><span rel="<?php the_time( get_option( 'date_format' ) ); ?>"><?php printf( __( '%1$s ago', 'esquire' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span></a>
				<?php endif; ?>
				<a href="<?php echo wp_get_shortlink(); ?> " class="shorturl"><span><?php _e( 'Short URL', 'esquire' ); ?></span></a>
				<?php comments_popup_link( '<span>' . __( 'Comments', 'esquire' ) . '</span>', '<span>' . __( '1 Comment', 'esquire' ) . '</span>', '<span>' . __( '% Comments', 'esquire' ) . '</span>', 'comment-count', '' ); ?>
				<?php edit_post_link( __( 'Edit', 'esquire' ) ); ?>
			</p>

			<div class="tagbar">
				<?php if ( 1 != esquire_category_counter() ) : ?>
				<p class="tags cats"><?php the_category( '<span>/</span>' ); ?></p>
				<?php endif; ?>
				<?php the_tags( '<p class="tags">', '<span>/</span>', '</p>' ); ?>
			</div><!-- .tagbar -->
		</div><!-- .meta .bar -->
	</div><!-- .postbody .text -->
</div><!-- .post -->