<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'steira'); ?></p>
	<?php
		return;
	}
?>

<?php /* You can start editing here */ ?>

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><span class="more">
		<a href="#respond">
	<?php if (comments_open()) { ?>
		<label for="author"><?php _e('Write a new comment', 'steira'); ?></label>
	<?php } ?>
		</a>
		</span>
		<span class="title"><?php comments_number(__('Leave a comment', 'steira'), __('1 comment', 'steira'), __('% comments', 'steira') );?></span>
	</h3>

<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : /* are there comments to navigate through? */ ?>
	<div class="navigation">
		<div class="nav-previous"><?php previous_comments_link( __('&lsaquo; Older Comments', 'steira') ) ?></div>
		<div class="nav-next"><?php next_comments_link( __('Newer Comments &rsaquo;', 'steira') ) ?></div>
	</div>
<?php endif; // check for comment navigation ?>

	<ol class="commentlist">
		<?php wp_list_comments('callback=steira_comments'); ?>
	</ol>

<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : /* are there comments to navigate through? */ ?>
	<div class="navigation">
		<div class="nav-previous"><?php previous_comments_link( __('&lsaquo; Older Comments', 'steira') ) ?></div>
		<div class="nav-next"><?php next_comments_link( __('Newer Comments &rsaquo;', 'steira') ) ?></div>
	</div>

<?php endif; /* check for comment navigation */ ?>

<?php else : /* this is displayed if there are no comments so far */ ?>

<?php if ( comments_open() ) : /* If comments are open, but there are no comments */ ?>

	 <?php else : /* comments are closed */ ?>
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>

<?php comment_form(); ?>
