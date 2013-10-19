<?php
/**
 * @package Dusk To Dawn
 */
get_header(); ?>

<section id="primary">
	<div id="content" class="clear-fix" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'dusktodawn' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'dusktodawn' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'dusktodawn' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
					elseif ( is_category() ) :
						printf( __( 'Category Archives: %s', 'dusktodawn' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					elseif ( is_tag() )	:
						printf( __( 'Tag Archives: %s', 'dusktodawn' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					elseif ( is_author() ) :
						_e( 'Author Archives', 'dusktodawn' );
					else :
						_e( 'Archives', 'dusktodawn' );
					endif;
				?>
			</h1>
			<?php
				if ( is_category() ) :
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
				endif;

				if ( is_tag() ) :
					$tag_description = tag_description();
					if ( ! empty( $tag_description ) )
						echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
				endif;
			?>
		</header>

		<?php rewind_posts(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				/* Include the Post-Format-specific template for the content.
				 * If you want to overload this in a child theme then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );
			?>

		<?php endwhile; ?>

		<?php dusktodawn_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'dusktodawn' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'dusktodawn' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	<?php endif; ?>

	</div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>