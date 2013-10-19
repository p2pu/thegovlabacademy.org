<?php get_header(); ?>

			<div id="body">

				<div id="content">

<?php the_post(); ?>

<?php if ( is_day() ) : ?>
				<h2 class="page-title"><?php printf( __( 'Daily Archives: <strong>%s</strong>', 'steira' ), get_the_time(get_option('date_format')) ) ?></h2>

<?php elseif ( is_month() ) : ?>
				<h2 class="page-title"><?php printf( __( 'Monthly Archives: <strong>%s</strong>', 'steira' ), get_the_time('F Y') ) ?></h2>

<?php elseif ( is_year() ) : ?>
				<h2 class="page-title"><?php printf( __( 'Yearly Archives: <strong>%s</strong>', 'steira' ), get_the_time('Y') ) ?></h2>

<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
				<h2 class="page-title"><?php _e( 'Blog Archives', 'steira' ) ?></h2>

<?php endif; ?>

<?php rewind_posts(); ?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&lsaquo;</span> Older posts', 'steira' )) ?></div>
					<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&rsaquo;</span>', 'steira' )) ?></div>
				</div><!-- #nav-above -->
<?php endif; ?>

<?php $count = 0; while (have_posts()) : the_post(); $count++; ?>

					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

						<h2 class="haslink">
							<a href="<?php the_permalink(); ?>">
								<span class="posted"><?php the_time('d/m/y'); ?></span>
								<span class="title"><?php the_title(); ?></span>
							</a>
						</h2>

						<div class="contentblock">

							<?php the_excerpt('<p class="more">' . __('Continue reading this article &rsaquo;', 'steira') . '</p>'); ?>
							<p><?php the_tags(__( 'Tags: ', 'steira' ), ', ', ''); ?></p>

						</div><!-- contentblock -->

						<ul class="postdetails">
							<li class="comments"><?php comments_popup_link(__('Leave a comment', 'steira'), __('1 comment', 'steira'), '%' . __(' comments', 'steira')); ?></li>
							<li class="categories"><?php _e('Posted under', 'steira');?> <?php the_category(', ') ?><?php edit_post_link(__('Edit', 'steira'), ' | ', ''); ?></li>
						</ul><!-- postdetails -->

					</div><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; ?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&lsaquo;</span> Older posts', 'steira' )) ?></div>
					<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&rsaquo;</span>', 'steira' )) ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>

				</div><!-- content -->

<?php get_sidebar(); ?>

			</div><!-- body -->

<?php get_footer(); ?>