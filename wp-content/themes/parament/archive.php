<?php
/**
 * @package Parament
 */
?>

<?php get_header(); ?>

<div id="container" class="contain">

	<div id="main" role="main">
		<header id="introduction" class="contain">
			<hgroup>
			<?php
				$title = __( 'Archives', 'parament' );
				$description = '';
				if ( is_tag() ) {
					$title = single_tag_title( '', false );
					$description = tag_description();
					if ( empty( $description ) )
						$description = sprintf( __( 'All posts tagged %1$s', 'parament' ), $title );
				} elseif ( is_category() ) {
					$title = single_cat_title( '', false );
					$description = category_description();
				} elseif ( is_day() ) {
					$description = sprintf( __( 'All posts for the day %1$s', 'parament' ), esc_html( get_the_date( __( 'F jS, Y', 'parament' ) ) ) );
				} elseif ( is_month() ) {
					$description = sprintf( __( 'All posts for the month %1$s', 'parament' ), esc_html( get_the_date( __( 'F, Y', 'parament' ) ) ) );
				} elseif ( is_year() ) {
					$description = sprintf( __( 'All posts for the year %1$s', 'parament' ), esc_html( get_the_date( __( 'Y', 'parament' ) ) ) );
				} elseif ( is_author() ) {
					the_post();
					$description = sprintf( __( 'All posts by %1$s', 'parament' ), esc_html( get_the_author() ) );
					rewind_posts();
				}

				if ( ! empty( $title ) ) {
					echo '<h1 id="page-title">' . $title . '</h1>';
				}

				if ( ! empty( $description ) ) {
					echo '<h2 id="page-tagline">' . $description . '</h2>';
				}
			?>
			</hgroup>
		</header>

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part( 'content', '404' ); ?>
		<?php endif; ?>

		<nav id="posts-nav" class="paged-navigation contain">
			<h1 class="assistive-text"><?php _e( 'Posts navigation', 'parament' ); ?></h1>
			<div class="nav-older"><?php next_posts_link( __( '&larr; Older Entries', 'parament' ) ); ?></div>
			<div class="nav-newer"><?php previous_posts_link( __( 'Newer Entries &rarr;', 'parament' ) ); ?></div>
		</nav>

	</div><!-- end main -->

	<?php get_sidebar(); ?>

</div><!-- end container -->

<?php get_footer(); ?>