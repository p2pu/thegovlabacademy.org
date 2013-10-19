<?php
/**
 * @package WordPress
 * @subpackage Pink Touch 2
 */
?>
<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<div class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'pinktouch' ); ?></div>
	</div><!-- #comments -->
	<?php return;
		endif;
	?>

	<?php if ( have_comments() ) : ?>
		<h3>
			<?php
				printf( _n( 'One response to &#8220;%2$s&#8221;', '%1$s responses to &#8220;%2$s&#8221;', get_comments_number(), 'pinktouch' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<div class="pagination clearfix">
			<span class="older"><?php previous_comments_link( __( '&larr; Older comments', 'pinktouch' ) ); ?></span>
			<span class="newer"><?php next_comments_link( __( 'Newer comments &rarr;', 'pinktouch' ) ); ?></span>
		</div>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'pinktouch_comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<div class="pagination below clearfix">
			<span class="older"><?php previous_comments_link( __( '&larr; Older comments', 'pinktouch' ) ); ?></span>
			<span class="newer"><?php next_comments_link( __( 'Newer comments &rarr;', 'pinktouch' ) ); ?></span>
		</div>
		<?php endif; // check for comment navigation ?>
	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'pinktouch' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</div><!-- #comments -->