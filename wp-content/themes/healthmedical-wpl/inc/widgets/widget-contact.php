<?php
/*
 * Plugin Name: Contact form
 * Plugin URI: https://www.wplook.com
 * Description: Add a contact form to a sidebar
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_book_appointment_widget");'));
class wplook_book_appointment_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_book_appointment_widget',
			__( 'WPlook Book Appointment', 'healthmedical-wpl' ),
			array( 'description' => __( 'A widget for displaying a Book Appointment contact form', 'healthmedical-wpl' ), )
		);
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/

	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		}
		else {
			$title = __( 'Book an appointment', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$subtitle = esc_attr( $instance[ 'subtitle' ] );
		}
		else {
			$subtitle = __( 'It\'s easy and fast', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$form = esc_attr( $instance[ 'form' ] );
		}
		else {
			$form = '';
		}
		?>

			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('subtitle'); ?>"> <?php _e('Subtitle:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subtitle; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('form'); ?>"> <?php _e('Contact form:', 'healthmedical-wpl'); ?> </label>
				<?php

					$args = array(
						'get_posts_args' => array(
							'post_type' => 'wpcf7_contact_form',
							'posts_per_page' => -1
						),
						'field_name' => 'form',
						'selected' => $form
					);

					wplook_dropdown_posts( $args, $this );
					
				?>
			</p>

		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['subtitle'] = sanitize_text_field($new_instance['subtitle']);
		$instance['form'] = sanitize_text_field($new_instance['form']);
		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$subtitle = isset( $instance['subtitle'] ) ? esc_attr( $instance['subtitle'] ) : '';
		$form = isset( $instance['form'] ) ? esc_attr( $instance['form'] ) : '';

		?>
		
		<?php echo $before_widget; ?>

			<!-- Book appointment -->
			<?php if($subtitle) { ?><h4><?php echo esc_attr($subtitle); ?></h4><?php } ?>
			<?php if($title) { ?><h3><?php echo esc_attr($title); ?></h3><?php } ?>

			<div class="from-appointment">
				<?php error_log($form); ?>
				<?php echo do_shortcode( '[contact-form-7 id="' . $form . '" title="' . get_the_title( $form ) . '"]' ); ?>

			</div><!-- /.from-appointment -->

		<?php echo $after_widget; ?>

		<?php
	}
}
?>
