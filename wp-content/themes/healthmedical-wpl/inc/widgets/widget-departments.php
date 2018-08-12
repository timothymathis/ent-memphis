<?php
/*
 * Plugin Name: Departments Widget
 * Plugin URI: https://www.wplook.com
 * Description: List departments in a widget area
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_departments_widget");'));
class wplook_departments_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_departments_widget',
			__( 'WPlook Departments', 'healthmedical-wpl' ),
			array( 'description' => __( 'A widget for displaying Departments', 'healthmedical-wpl' ), )
		);
	}

	
	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/
	
	public function form( $instance ) {
		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = 6;
		}

		if ( $instance ) {
			$random = esc_attr( $instance[ 'random' ] );
		}
		else {
			$random = true;
		}

		?>
			
			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Maximum number of Services:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Maximum number of services you want to display, regardless of how many have been selected', 'healthmedical-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('random'); ?>"> <?php _e('Random?:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('random'); ?>" name="<?php echo $this->get_field_name('random'); ?>" type="checkbox" <?php if( !empty( $random ) ) { echo 'checked'; } ?> />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Whether you want to display the services in random order', 'healthmedical-wpl'); ?></p>
			</p>

			<p> <?php _e('Pick what you want displayed here by editing individual departments', 'healthmedical-wpl'); ?></p>

		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
		$instance['random'] = sanitize_text_field($new_instance['random']);
		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$nr_posts = isset( $instance['nr_posts'] ) ? esc_attr( $instance['nr_posts'] ) : 6;
		$random = !empty( $instance['random'] ) ? 'rand' : 'date';

		$args = array(
			'post_type' => 'wpl_post_departments',
			'meta_key' => 'wpl_departments_sidebar_widget',
			'meta_value' => 'on',
			'posts_per_page' => $nr_posts,
			'orderby' => $random
		);

		$posts = null;
		$posts = new WP_Query( $args ); ?>

		<?php if( $posts->have_posts() ) : ?>
		
			<!-- Services -->
			<div class="widget widget-services">
				<ul class="list-services list-services-alt">
					<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
						<?php $wpl_font_icon = get_post_meta( $post->ID, 'wpl_font_icon', true); ?>

						<li>
							<a href="<?php the_permalink(); ?>">
								<?php if( !empty($wpl_font_icon) ) { ?>
									<span class="icon">
										<i class="<?php echo $wpl_font_icon; ?>"></i>
									</span>
								<?php } ?>
												
								<?php the_title(); ?>
							</a>
						</li>
					<?php endwhile; wp_reset_postdata(); ?>	
				</ul><!-- /.list-services list-services-alt -->
			</div><!-- /.widget widget-servicess -->

		<?php endif; ?>

	<?php
	}
}
?>
