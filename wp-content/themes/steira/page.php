<?php get_header(); ?>

			<div id="body">
				<div id="content">
					<?php the_post(); ?>

					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
						<h2 class="haslink">
							<a href="<?php the_permalink(); ?>">
								<span class="title"><?php the_title(); ?></span>
							</a>
						</h2>

						<div class="contentblock">
							<?php the_content(); ?>

							<?php wp_link_pages( 'before=<p class="page-link">' . __( 'Pages:', 'steira' ) . '&after=</p>' ); ?>

							<p><?php the_tags( __( 'Tags: ', 'steira' ), ', ', '' ); ?></p>

							<?php edit_post_link( __( 'Edit', 'steira'), '<p class="edit-post">', '</p>' ); ?>
						</div><!-- contentblock -->
					</div><!-- #post-<?php the_ID(); ?> -->
				</div><!-- content -->

<?php get_sidebar(); ?>

			</div><!-- body -->

<?php get_footer(); ?>