<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search the Site...', 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search' ) .'" />
	</form>';
	return $form;
} // don't remove this bracket!


/****************** SHORTCODES **********************/
function _get_text_between_tags($string, $tagname) {
    $pattern = "/<$tagname>([\w\W]*?)<\/$tagname>/";
    preg_match($pattern, $string, $matches);
    return $matches[1];
}

/*****************Simple fields *********************/
// Code to create Topic Page Template
simple_fields_register_field_group('topic_page_featured_section', array(
  'name' => 'Featured Section',
  'fields' => array(
    array(
      'name' => 'Link to Youtube Video',
      'slug' => 'youtube_link',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Title',
      'slug' => 'title',
      'type' => 'text'
    ),
    array(
      'name' => 'Course Title',
      'slug' => 'course_title',
      'type' => 'text'
    ),
    array(
      'name' => 'Description',
      'slug' => 'description',
      'type' => 'textarea'
    )
  ),
  'repeatable' => FALSE,
  'deleted' => false
));

simple_fields_register_field_group('topic_learn_more_section', array(
  'name' => 'Learn More Section',
  'fields' => array(
    array(
      'name' => 'Link to Youtube Video',
      'slug' => 'you_tube_id',
      'type' => 'text',
      'options' => array(
        'subtype' => 'url'
      )
    ),
    array(
      'name' => 'Title',
      'slug' => 'title',
      'type' => 'text'
    ),
    array(
      'name' => 'Course Title',
      'slug' => 'course_title',
      'type' => 'text'
    ),
    array(
      'name' => 'Description',
      'slug' => 'learn_more_description',
      'type' => 'textarea'
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

simple_fields_register_field_group('topic_literature', array(
  'name' => 'Read',
  'fields' => array(
    array(
      'name' => 'Document Title',
      'slug' => 'topic_page_document_title',
      'description'=> 'Add title to display for document',
      'type' => 'text'
    ),
    array(
      'name' => 'Document Description',
      'slug' => 'topic_page_document_description',
      'description'=> 'Add short description to display document',
      'type' => 'text'
    ),
    array(
      'name' => 'Document Upload',
      'slug' => 'topic_page_document_upload',
      'description'=> 'Upload a file',
      'type' => 'file'
    ),
    array(
      'name' => 'Document URL',
      'slug' => 'topic_page_document_url',
      'description'=> 'If documented can not be uploaded use url to it',
      'type' => 'text'
    )
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

simple_fields_register_field_group('topic_experts', array(
  'name' => 'Experts',
  'fields' => array(
    array(
      'name' => 'Expert Twitter Handle',
      'slug' => 'expert_twitter_handle',
      'description'=> 'Add a Twitter handle of an expert',
      'type' => 'text'
    ),
  ),
  'repeatable' => TRUE,
  'deleted' => false
));

simple_fields_register_post_connector('topic_page_connector',
  array (
    'name' => 'Topic Page',
    'field_groups' => array(
      array('name' => 'Featured Section',
        'key' => 'topic_page_featured_section',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Learn More Section',
        'key' => 'topic_learn_more_section',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Topic Literature',
        'key' => 'topic_literature',
        'context' => 'normal',
        'priority' => 'high'),
      array('name' => 'Experts',
        'key' => 'topic_experts',
        'context' => 'normal',
        'priority' => 'high'),
    ),
    'post_types' => array('page'),
    'hide_editor' => 0,
    'deleted' => false
  )
);
?>