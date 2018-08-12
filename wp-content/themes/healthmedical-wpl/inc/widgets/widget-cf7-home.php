<?php
/*
 * Plugin Name: CF7 (Home page)
 * Plugin URI: https://www.wplook.com
 * Description: Add a Contact Form 7 to the home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_cf7_home_widget");'));
class wplook_cf7_home_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_cf7_home_widget',
			__( 'WPlook Contact Form 7 (Front page)', 'healthmedical-wpl' ),
			array( 'description' => __( 'A widget for displaying a Contact Form 7 on the front page', 'healthmedical-wpl' ), )
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
			$icon = esc_attr( $instance[ 'icon' ] );
		}
		else {
			$icon = __( '', 'healthmedical-wpl' );
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

			<div class="icon-picker-parent">

				<p>
					<label for="<?php echo $this->get_field_id('icon'); ?>"> <?php _e('Icon:', 'healthmedical-wpl'); ?> </label>
					<input class="widefat icon-picker-input" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo $icon; ?>" />
				</p>

				<?php echo wplook_return_icon_picker( wplook_return_medical_icon_array(), $icon, 'widget_editor' ); ?>

			</div>

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
		$instance['icon'] = sanitize_text_field($new_instance['icon']);
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
		$icon = isset( $instance['icon'] ) ? esc_attr( $instance['icon'] ) : '';
		$form = isset( $instance['form'] ) ? esc_attr( $instance['form'] ) : '';
		?>
		
		<?php echo $before_widget; ?>

			<!-- Book appointment -->
			<section class="section section-book-appointment" id="section-book-appointment">
				<?php if($icon) { ?>
					<div class="section-ribbon">
						<i class="<?php echo esc_attr($icon); ?>"></i>
					</div><!-- /.section-ribbon -->
				<?php } ?>
				<div class="section-body">
					<div class="form-appointment">
						<header class="form-head row">
							
							<div class="columns large-12 medium-12">
								<?php if($title) { ?><h2><?php echo esc_attr($title); ?></h2><?php } ?>
								<?php if($subtitle) { ?><h6><?php echo esc_attr($subtitle); ?></h6><?php } ?>
							</div><!-- /.columns large-12 -->
							
						</header><!-- /.form-head -->

						<div class="form-body">
							<div class="row">

							<?php echo do_shortcode( '[contact-form-7 id="' . $form . '" title="' . get_the_title( $form ) . '"]' ); ?>

							</div><!-- /.row -->
						</div><!-- /.form-body -->

					</div><!-- /.form-appoitment -->
				</div><!-- /.section-body -->
			</section><!-- /.section-book-appointment -->

		<?php echo $after_widget; ?>

		<?php
	}
}
?>
