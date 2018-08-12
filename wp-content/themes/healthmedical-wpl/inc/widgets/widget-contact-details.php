<?php
/*
 * Plugin Name: Contact
 * Plugin URI: https://www.wplook.com
 * Description: A widget for displaying contact information
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_contact_widget");'));
class wplook_contact_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_contact_widget',
			__( 'WPlook Contact Us', 'healthmedical-wpl' ),
			array( 'description' => __( 'A widget for displaying contact information', 'healthmedical-wpl' ), )
		);
	}

	
	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/
	
	public function form( $instance ) {
		
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$address = esc_textarea( $instance[ 'address' ] );
			$mobile_phone = esc_attr( $instance[ 'mobile_phone' ] );
			$telephone = esc_attr( $instance[ 'telephone' ] );
			$email = esc_attr( $instance[ 'email' ] );
		}
		else {
			$title = '';
			$address = '';
			$mobile_phone = '';
			$telephone = '';
			$email = '';
		}

?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"> <?php _e('Title:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"> <?php _e('Address:', 'healthmedical-wpl'); ?> </label>
				<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" value="<?php echo esc_attr( $address ); ?>"><?php echo esc_attr( $address ); ?></textarea>
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('mobile_phone')); ?>"> <?php _e('Mobile phone number:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('mobile_phone')); ?>" name="<?php echo esc_attr($this->get_field_name('mobile_phone')); ?>" type="tel" value="<?php echo esc_attr($mobile_phone); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('telephone')); ?>"> <?php _e('Telephone number:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('telephone')); ?>" name="<?php echo esc_attr($this->get_field_name('telephone')); ?>" type="tel" value="<?php echo esc_attr($telephone); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('email')); ?>"> <?php _e('Email address:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="email" value="<?php echo esc_attr($email); ?>" />
			</p>

		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['mobile_phone'] = sanitize_text_field($new_instance['mobile_phone']);
		$instance['telephone'] = sanitize_text_field($new_instance['telephone']);
		$instance['email'] = sanitize_email($new_instance['email']);
		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$address = isset( $instance['address'] ) ? wpautop( $instance['address'] ) : '';
		$mobile_phone = isset( $instance['mobile_phone'] ) ? esc_attr( $instance['mobile_phone'] ) : '';
		$telephone = isset( $instance['telephone'] ) ? esc_attr( $instance['telephone'] ) : '';
		$email = isset( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
	?>

	<?php echo $before_widget; ?>

	<?php if ( $title ) { ?>
		<?php echo $before_title . esc_html( $title ) . $after_title; ?>
	<?php } ?>

	<div class="contacts">
		<?php if ( $address ) { ?>
			<?php echo $address; ?>
		<?php } ?>

		<?php if ( $mobile_phone || $telephone || $email ) { ?>
		<ul>
			<?php if ( $mobile_phone ) { ?>
				<li>
					<p>
						<span><?php _e('Phone:', 'healthmedical-wpl'); ?> </span>
						<span><a href="tel:<?php echo esc_html($mobile_phone); ?>"><?php echo esc_html($mobile_phone); ?></a></span>
					</p>
				</li>
			<?php } ?>

			<?php if ( $telephone ) { ?>
				<li>
					<p>
						<span><?php _e('Telephone:', 'healthmedical-wpl'); ?> </span>
						<span><a href="tel:<?php echo esc_html($telephone); ?>"><?php echo esc_html($telephone); ?></a></span>
					</p>
				</li>
			<?php } ?>

			<?php if ( $email ) { ?>
				<li>
					<p>
						<span><?php _e('Email address:', 'healthmedical-wpl'); ?> </span>
						<span><a href="mailto:<?php echo esc_html($email); ?>"><?php echo esc_html($email); ?></a></span>
					</p>
				</li>
			<?php } ?>
		</ul>
		<?php } ?>
	</div>

	<?php echo $after_widget; ?>

	<?php
	}
}
?>
