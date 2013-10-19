<?php
/**
 * The template for featured posts.
 *
 * @package Sundance
 * @since Sundance 1.0
 */

	/**
	 * Begin the featured posts section.
	 *
	 * See if we have any sticky posts and use them to create our featured posts.
	 */

	// Set $content_width for the slider
	global $content_width;
	$content_width = 644;

	// Proceed only if sticky posts exist.
	$sticky = get_option( 'sticky_posts' );
	if ( ! empty( $sticky ) ) :

		// Ready to record featured post IDs for later exclusion
		global $featured_post_id;
		$featured_post_id = array();

		// The Featured Posts query - The need to be sticky post and video post format
		$featured_args = array(
			'post__in' => $sticky,
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-video' )
				),
			),
			'posts_per_page' => 10,
			'no_found_rows' => true,
		);
		$featured = new WP_Query( $featured_args );

		// Proceed only if published posts exist
		if ( $featured->have_posts() ) :
?>

		<div class="featured-posts-super-wrapper loading">
			<div class="featured-posts-wrapper">
				<div class="featured-posts-outer">
					<div class="featured-posts">
						<ul class="slides">
						<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>
							<?php
								// Record our featured post IDs so we can exclude them from the regular loop later
								$featured_post_id[] = $post->ID;
							?>
							<li class="featured">
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="featured-content">
										<?php the_content(); ?>
									</div>
									<div class="featured-content-info">
										<header class="entry-header">
											<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sundance' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
										</header><!-- .entry-header -->
										<div class="featured-summary">
											<?php the_excerpt(); ?>
										</div><!-- .featured-summary -->
									</div>
								</article><!-- #post-<?php the_ID(); ?> -->
							</li>
						<?php endwhile; ?>
						</ul><!-- .slides -->
					</div><!-- .featured-posts -->
				</div><!-- .featured-posts-outer -->
			</div><!-- .featured-posts-wrapper -->
		</div><!-- .featured-posts-super-wrapper -->
		<?php endif; // End check for published posts. ?>
	<?php endif; // End check for sticky posts. ?>