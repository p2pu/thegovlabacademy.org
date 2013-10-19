<?php
/**
 * @package Dusk To Dawn
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php if ( ! is_singular() && is_sticky() ) : ?>
				<?php _e( 'Featured', 'dusktodawn' ); ?>
			<?php else : ?>
				<?php dusktodawn_posted_on(); ?>
			<?php endif; ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dusktodawn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'dusktodawn-featured-image', array( 'class' => 'featured-image' ) ); endif; ?>

	<div class="entry-content">
		<?php
			$audio_file = dusktodawn_audio_grabber( $post->ID );
			if ( ! empty( $audio_file ) ) :
		?>
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
								width: '474'
							}
						);
				    }
				</script>
			</div>
		<?php endif; ?>

		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'dusktodawn' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'dusktodawn' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php dusktodawn_post_meta(); ?>

		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'dusktodawn' ), __( '1 Comment', 'dusktodawn' ), __( '% Comments', 'dusktodawn' ) ); ?></span><br />
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'dusktodawn' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- #entry-meta -->

	<?php dusktodawn_author_info(); ?>

</article><!-- #post-<?php the_ID(); ?> -->