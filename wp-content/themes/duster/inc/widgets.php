<?php
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class Duster_Ephemera_Widget extends WP_Widget {
	
	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function Duster_Ephemera_Widget() {
		$widget_ops = array( 'classname' => 'widget_duster_ephemera', 'description' => __( 'Use this widget to list your recent Aside, Status, Quote, and Link posts', 'duster' ) );
		$this->WP_Widget( 'widget_duster_ephemera', __( 'Duster Ephemera', 'duster' ), $widget_ops );
		$this->alt_option_name = 'widget_duster_ephemera';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache' ) );
		
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array An array of standard parameters for widgets in this theme 
	 * @param array An array of settings for this widget instance 
	 * @return void Echoes it's output
	 **/
	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_duster_ephemera', 'widget' );

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = null;

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();		
		extract( $args, EXTR_SKIP );
		
		$title = apply_filters( 'widget_title', empty($instance['title']) ? __( 'Ephemera', 'duster' ) : $instance['title'], $instance, $this->id_base);
		
		if ( ! isset( $instance['number'] ) )
			$instance['number'] = '10';
			
		if ( ! $number = absint( $instance['number'] ) )
 			$number = 10;

		$ephemera_args = array(
			'order' => 'DESC',
			'posts_per_page' => $number,
			'nopaging' => 0,
			'post_status' => 'publish',
			'post__not_in' => get_option( 'sticky_posts' ),
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'terms' => array( 'post-format-aside', 'post-format-link', 'post-format-status', 'post-format-quote' ),
					'field' => 'slug',
					'operator' => 'IN',
				),
			),
		);
		$ephemera = new WP_Query();
		$ephemera->query( $ephemera_args );

		if ( $ephemera->have_posts() ) :
		
		echo $before_widget;
		echo $before_title;
		echo $title; // Can set this with a widget option, or omit altogether
		echo $after_title;

		global $post;
		
		?>
		<ol>
		<?php while ( $ephemera->have_posts() ) : $ephemera->the_post(); ?>
			
			<?php if ( 'link' != get_post_format( $post->ID ) ) : ?>
				
			<li class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'duster' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				<span class="comments-link">
					<?php comments_popup_link( __( '0 <span class="reply">comments &rarr;</span>', 'duster' ), __( '1 <span class="reply">comment &rarr;</span>', 'duster' ), __( '% <span class="reply">comments &rarr;</span>', 'duster' ) ); ?>
				</span>
			</li>
			
			<?php else : ?>

			<li class="entry-title">
				<?php
					$link_url = get_permalink();
					
					if ( false != duster_url_grabber() )
						$link_url = duster_url_grabber();
				?>
				<a href="<?php echo $link_url; ?>" title="<?php printf( esc_attr__( 'Link to %s', 'duster' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?>&nbsp;<span>&rarr;</span></a>
				<span class="comments-link">
					<?php comments_popup_link( __( '0 <span class="reply">comments &rarr;</span>', 'duster' ), __( '1 <span class="reply">comment &rarr;</span>', 'duster' ), __( '% <span class="reply">comments &rarr;</span>', 'duster' ) ); ?>
				</span>
			</li>
			
			<?php endif; ?>
			
		<?php endwhile; ?>
		</ol>
		<?php

		echo $after_widget;
		
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		// end check for ephemeral posts
		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'widget_duster_ephemera', $cache, 'widget' );
	}

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_duster_ephemera']) )
			delete_option( 'widget_duster_ephemera' );

		return $instance;
	}
	
	function flush_widget_cache() {
		wp_cache_delete( 'widget_duster_ephemera', 'widget' );
	}	

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 **/
	function form( $instance ) {
				$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
				$number = isset($instance['number']) ? absint($instance['number']) : 10;
		?>
				<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'duster' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

				<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'duster' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}
}

add_action( 'widgets_init', create_function( '', "register_widget( 'Duster_Ephemera_Widget' );" ) );