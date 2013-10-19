<?php
/**
 * @package WordPress
 * @subpackage Next Saturday
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

	<?php next_saturday_entry_date(); ?>

	<div class="entry-container">

		<!-- Grab the first link and put an elevated box behind it -->
			<div class="highlight-box">
				<header class="entry-header">
					<?php
						// Let's get all the post content
						$link_content = $post->post_content;

						// And let's find the first url in the post content
						$link_url = next_saturday_themes_url_grabber();

						// Let's make the title a link if there's a link in this link post
						if ( ! empty( $link_url ) ) :
					?>
					<h1 class="post-title"><a href="<?php echo $link_url; ?>"><?php the_title(); ?></a> <?php _e( '&rarr;', 'next-saturday'); ?></h1>
					<?php else : ?>
					<h1 class="post-title"><?php the_title(); ?></h1>
					<?php endif; ?>

				<?php
				// Sometimes links need descriptions and sometimes they don't ...

				// Let's compare the length of the first url with the length of the post content.
				// If they're one and the same we don't really need to show the post content BECAUSE ...
				// that's just a url and we're already using that url as a href for the title link above BUT ...
				// if they're NOT the same I think we should show that content.
				if ( strlen( $link_url ) != strlen( $link_content ) ) :

					// Let's make any bare URL a clickable link, too.
					add_filter( 'the_content', 'make_clickable' );
					?>
				</header><!-- .entry-header -->
			</div><!-- .highlight-box -->

		<div class="entry-content">
			<?php the_content( __( 'Read more <span class="meta-nav">&rarr;</span>', 'next-saturday' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages:', 'next-saturday' ), 'after' => '</p></div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<div class="entry-meta-wrap">
			<div class="entry-meta">
				<span class="comments-num"><?php comments_popup_link( __( 'Leave a comment', 'next-saturday' ), __( '1 Comment', 'next-saturday' ), __( '% Comments', 'next-saturday' ) ); ?></span>
				<?php edit_post_link( __( 'Edit this Entry', 'next-saturday' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
		</div>

	</div><!-- .entry-container -->
</article><!-- #post-## -->