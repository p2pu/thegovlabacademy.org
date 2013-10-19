<?php
/**
 *
 * @package WordPress
 * @subpackage Next Saturday
 */
?>

<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'next-saturday' ); ?></p>
</div><!-- #comments -->
	<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 id="comments-title"><?php printf( _n( 'One Response', '%1$s Responses', get_comments_number(), 'next-saturday' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
			<?php if ( comments_open() ) : ?>
				<a href="#respond" title="<?php esc_attr_e( 'Leave a comment', 'next-saturday' ); ?>"><?php _e( '&raquo;', 'next-saturday' ); ?></a>
			<?php endif; ?>
		</h3>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'next-saturday' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'next-saturday' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'next-saturday' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'next_saturday_comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'next-saturday' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'next-saturday' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'next-saturday' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'next-saturday' ); ?></p>

	<?php endif; // end have_comments() ?>

	<?php comment_form(); ?>

</div><!-- #comments -->