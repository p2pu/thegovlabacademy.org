<?php
/**
 * @package Parament
 */
?>

	<div id="comments">
	<?php if ( have_comments() ) : ?>
		<h2 id="comments-title"><?php
			printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'parament' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
		?></h2>
	<?php elseif ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'parament' ); ?></p>
	</div><!-- #comments -->
	<?php
			/*
			 * Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php if ( have_comments() ) : ?>
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'parament_comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="paged-navigation contain">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'parament' ); ?></h1>
			<div class="nav-older"><?php previous_comments_link( __( '&larr; Older Comments', 'parament' ) ); ?></div>
			<div class="nav-newer"><?php next_comments_link( __( 'Newer Comments &rarr;', 'parament' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>
	<?php endif; ?>

	<?php if ( comments_open() ) : ?>
		<?php comment_form(); ?>
	<?php elseif ( have_comments() ) : ?>
		<p class="comments-closed"><?php _e( 'Comments are closed.', 'parament' ); ?></p>
	<?php endif; ?>

</div><!-- #comments -->