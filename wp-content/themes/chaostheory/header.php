<?php
/**
 * @package WordPress
 * @subpackage ChaosTheory
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head();
?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

	<div id="header">
		<div id="innerheader">
			<h1 id="blog-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<div id="blog-description"><?php bloginfo( 'description' ); ?></div>

			<div id="header-image">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
					$header_image = get_header_image();
					if ( is_singular() &&
						has_post_thumbnail( $post->ID ) &&
						( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( HEADER_IMAGE_WIDTH, HEADER_IMAGE_WIDTH ) ) ) &&
						$image[1] >= HEADER_IMAGE_WIDTH ) :
						echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );

					elseif ( ! empty( $header_image ) ) :
				?>
					<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
				<?php
					endif;
				?>
				</a>
			</div>

		</div>
	</div><!--  #header -->

	<p class="access"><a href="#content" title="<?php esc_attr_e( 'Skip navigation to the content', 'chaostheory' ); ?>"><?php _e( 'Skip navigation', 'chaostheory' ); ?></a></p>
	<?php wp_nav_menu( array( 'container' => 'div', 'container_id' => 'globalnav', 'theme_location' => 'primary', 'menu_id' => 'menu', 'fallback_cb' => 'chaostheory_globalnav' ) ); ?>