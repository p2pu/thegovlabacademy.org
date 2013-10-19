<?php
/**
 * @package WordPress
 * @subpackage Next Saturday
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

	<?php next_saturday_entry_date(); ?>

	<div class="entry-container">
	<?php if ( 'video' != get_post_format() ) { ?>
		<header class="entry-header">
			<h1 class="post-title">
				<?php if ( ! is_single() ) : ?>
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'next-saturday' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				<?php else : ?>
					<?php the_title(); ?>
				<?php endif; ?>
			</h1>
		</header><!-- .entry-header -->
	<?php } ?>
		<div class="entry-content">
			<?php
				if ( is_search() ) :
					the_excerpt();
				else :
					the_content( __( 'Read more', 'next-saturday' ) );
				endif;
			?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages:', 'next-saturday' ), 'after' => '</p></div>' ) ); ?>
		</div><!-- .entry-content -->

		<div class="entry-meta-wrap">
			<div class="entry-meta">
				<?php next_saturday_entry_meta(); ?>
				<span class="comments-num"><?php comments_popup_link( __( 'Leave a comment', 'next-saturday' ), __( '1 Comment', 'next-saturday' ), __( '% Comments', 'next-saturday' ) ); ?></span>
				<?php edit_post_link( __( 'Edit this Entry', 'next-saturday' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
		</div>
		<?php if ( get_the_author_meta( 'description' ) && is_single() && 'video' != get_post_format() ) : // If a user has filled out their description, show a bio on their entries ?>
			<div class="highlight-box clearfix">
				<div id="author-info-box">
					<div id="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), 55 ); ?>
					</div><!-- #author-avatar -->
					<div id="author-description">
						<h2 id="author-info-title"><?php printf( esc_attr__( 'About %s', 'next-saturday' ), get_the_author() ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
					</div><!-- #author-description -->
					<div id="author-link">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<?php printf( __( 'View all posts by %s', 'next-saturday' ), get_the_author() ); ?>
						</a>
					</div><!-- #author-link -->
				</div><!-- # author-info-box -->
			</div><!-- .elevated-box -->
		<?php endif; ?>

	</div><!-- .entry-container -->
</article><!-- #post-## -->