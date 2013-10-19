<?php
/**
 * The default template for displaying content
 *
 * @package Esquire
 * @since Esquire 1.0
 */
?>

<div <?php post_class(); ?>>
	<?php if ( ! is_page() ) : ?>
	<div class="datebox">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'esquire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
			<p class="day"><?php the_time( 'd' ); ?></p>
			<p class="month"><?php the_time( 'M' ); ?></p>
		</a>
	</div>
	<?php endif; ?>

	<div class="postbody text">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'esquire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'esquire' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'esquire' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div>
		
		<?php comments_template( '', true ); ?>		

		<div class="meta bar">
			<p class="permalink">
				<?php if ( ! is_page() ) : ?>
				<a href="<?php the_permalink(); ?>"><span rel="<?php the_date(); ?>"><?php printf( __( '%1$s ago', 'esquire' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span></a>
				<?php endif; ?>
				<a href="<?php echo wp_get_shortlink(); ?> " class="shorturl"><span><?php _e( 'Short URL', 'esquire' ); ?></span></a>
				<?php comments_popup_link( '<span>' . __( 'Comments', 'esquire' ) . '</span>', '<span>' . __( '1 Comment', 'esquire' ) . '</span>', '<span>' . __( '% Comments', 'esquire' ) . '</span>', 'comment-count', '' ); ?>
				<?php edit_post_link( __( 'Edit', 'esquire' ) ); ?>
			</p>

			<div class="tagbar">
				<?php if ( 1 != esquire_category_counter() ) : ?>
				<p class="tags cats"><?php the_category( '<span>/</span>' ); ?></p>
				<?php endif; ?>
				<?php the_tags( '<p class="tags">', '<span>/</span>', '</p>' ); ?>
			</div><!-- .tagbar -->
		</div><!-- .meta .bar -->
	</div><!-- .postbody .text -->
</div><!-- .post -->