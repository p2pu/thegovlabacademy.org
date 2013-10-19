<?php
/**
 * @package WordPress
 * @subpackage ChaosTheory
 */
?>
<div class="comments">

<?php
	if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
		die ( 'Please do not load this page directly. Thanks!' );
	if ( post_password_required() ) :
?>
	<div class="nopassword"><?php _e( 'This post is password protected. Enter the password to proceed.', 'chaostheory' ); ?></div>
	</div>
<?php
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>

<?php /* NUMBERS OF PINGS AND COMMENTS */
$ping_count = $comment_count = 0;
foreach ( $comments as $comment )
	get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
?>

<?php if ( $comment_count ) : ?>

	<h3 class="comment-header" id="numcomments"><?php printf( __($comment_count > 1 ? '%d Comments' : 'One Comment', 'chaostheory' ), $comment_count); ?></h3>
	<ol id="comments" class="commentlist">
		<?php wp_list_comments(array( 'callback'=>'chaostheory_comment', 'avatar_size'=>16, 'type'=>'comment' ) ); ?>
	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link(); ?></div>
		<div class="alignright"><?php next_comments_link(); ?></div>
	</div>
	<br />

<?php endif; /* if ( $comment_count ) */ ?>

<?php if ( $ping_count ) : ?>

	<h3 class="comment-header" id="numpingbacks"><?php printf( __($ping_count > 1 ? '%d Trackbacks/Pingbacks' : 'One Trackback/Pingback', 'chaostheory' ), $ping_count); ?></h3>
	<ol id="pingbacks" class="commentlist">
		<?php wp_list_comments(array( 'callback'=>'chaostheory_ping', 'type'=>'pings' ) ); ?>
	</ol>

<?php endif /* if ( $ping_count ) */ ?>

<?php endif /* if ( $comments ) */ ?>

<!-- formcontainer around #commentform -->

<?php if ( comments_open() ) : ?>

	<?php comment_form(); ?>

<?php endif /* if ( 'open' == $post->comment_status ) */ ?>

</div>