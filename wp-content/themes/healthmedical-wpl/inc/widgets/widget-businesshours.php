<?php
/*
 * Plugin Name: Business Hours Widget
 * Plugin URI: https://www.wplook.com
 * Description: Business Hours Widget
 * Author: WPlook Team	
 * Version: 1.0.0
 * Author URI: https://wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("WPlookBusinessHours");'));
class WPlookBusinessHours extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'WPlookBusinessHours',
			__( 'WPlook Business Hours', 'healthmedical-wpl' ),
			array( 'description' => __( 'A widget for displaying Business Hours', 'healthmedical-wpl' ), )
		);
	}

	function form($instance) {
		// outputs the options form on admin
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		} else {
			$title = __( 'Business Hours', 'healthmedical-wpl' );
		}

		// Description
		if ( $instance ) {
			$description = esc_attr( $instance[ 'description' ] );
		}
		else {
			$description = __( '', 'healthmedical-wpl' );
		}

		// Monday - Friday
		if ( $instance ) {
			$monfriday = esc_attr( $instance[ 'monfriday' ] );
		}
		else {
			$monfriday = __( '', 'healthmedical-wpl' );
		}

		// Saturday
		if ( $instance ) {
			$saturday = esc_attr( $instance[ 'saturday' ] );
		}
		else {
			$saturday = __( '', 'healthmedical-wpl' );
		}

		// Sunday
		if ( $instance ) {
			$sunday = esc_attr( $instance[ 'sunday' ] );
		}
		else {
			$sunday = __( '', 'healthmedical-wpl' );
		}

		?>
	
		<!-- Title-->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Title:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>">
				<?php _e('Description:', 'healthmedical-wpl'); ?>
			</label>
			<textarea cols="25" rows="10" class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text"><?php echo $description; ?></textarea>
		</p>
		
		<!-- Monday - Friday -->
		<p>
			<label for="<?php echo $this->get_field_id('monfriday'); ?>"> <?php _e('Monday - Friday:', 'healthmedical-wpl'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('monfriday'); ?>" name="<?php echo $this->get_field_name('monfriday'); ?>" type="text" value="<?php echo $monfriday; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Add start and end times', 'healthmedical-wpl'); ?></p>
		</p>

		<!-- Saturday -->
		<p>
			<label for="<?php echo $this->get_field_id('saturday'); ?>"> <?php _e('Saturday:', 'healthmedical-wpl'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('saturday'); ?>" name="<?php echo $this->get_field_name('saturday'); ?>" type="text" value="<?php echo $saturday; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Add start and end times', 'healthmedical-wpl'); ?></p>
		</p>

		<!-- Sunday -->
		<p>
			<label for="<?php echo $this->get_field_id('sunday'); ?>"> <?php _e('Sunday:', 'healthmedical-wpl'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('sunday'); ?>" name="<?php echo $this->get_field_name('sunday'); ?>" type="text" value="<?php echo $sunday; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Add start and end times', 'healthmedical-wpl'); ?></p>
		</p>

	<?php } 


	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['description'] = sanitize_text_field($new_instance['description']);
		$instance['monfriday'] = sanitize_text_field($new_instance['monfriday']);
		$instance['saturday'] = sanitize_text_field($new_instance['saturday']);
		$instance['sunday'] = sanitize_text_field($new_instance['sunday']);
		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$description = apply_filters( 'widget_description', empty($instance['description']) ? '' : $instance['description'], $instance );
		$monfriday = isset( $instance['monfriday'] ) ? esc_attr( $instance['monfriday'] ) : '';
		$saturday = isset( $instance['saturday'] ) ? esc_attr( $instance['saturday'] ) : '';
		$sunday = isset( $instance['sunday'] ) ? esc_attr( $instance['sunday'] ) : '';
		?>
		
		<?php if ($title=="") $title = "Business Hours"; ?>
		<?php echo $before_widget; ?>
		<?php if ( $title )
			echo $before_title . $title . $after_title; ?>

				<div class="footer-section-body">
					<div class="footer-section-entry">
						<?php if ($description) { ?>
							<p><?php echo esc_html($description); ?></p>
						<?php } ?>

				 		<ul class="list-work-times">
							<?php 	// Monday - Friday
							if ($monfriday != '' ) { ?>
								<li>
									<p>
										<span class="time-table-day"><?php _e('Monday - Friday:', 'healthmedical-wpl'); ?></span>
										<span class="time-table-time"><?php echo esc_html($monfriday); ?></span>
									</p>
								</li>
							<?php } ?>

							<?php // Saturday
							if ($saturday != '') { ?>
								<li>
									<p>
										<span class="time-table-day"><?php _e('Saturday:', 'healthmedical-wpl'); ?></span>
										<span class="time-table-time"><?php echo esc_html($saturday); ?></span>
									</p>
								</li>
							<?php } ?>
							
							<?php // Sunday
							if ($sunday != '') { ?>
								<li>
									<p>
										<span class="time-table-day"><?php _e('Sunday:', 'healthmedical-wpl'); ?></span>
										<span class="time-table-time"><?php echo esc_html($sunday); ?></span>
									</p>
								</li>
							<?php } ?>
				
						</ul><!-- /.time-table-items -->
					</div><!-- /.footer-section-entry -->
				</div><!-- /.footer-section-body -->

		<?php echo $after_widget; ?>
	<?php
	}
}
?>
