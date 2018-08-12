<?php
/*
 * Plugin Name: Newsletter
 * Plugin URI: https://www.wplook.com
 * Description: A widget for displaying MailChimp newsletter form
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_newsletter_widget");'));
class wplook_newsletter_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_newsletter_widget',
			__( 'WPlook Newsletter', 'healthmedical-wpl' ),
			array( 'description' => __( 'A widget for displaying a MailChimp newsletter form', 'healthmedical-wpl' ), )
		);
	}

	
	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/
	
	public function form( $instance ) {
		
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$subtitle = esc_attr( $instance[ 'subtitle' ] );
			$form_url = esc_attr( $instance[ 'form_url' ] );

		}
		else {
			$title = __( '', 'healthmedical-wpl' );
			$subtitle = __( '', 'healthmedical-wpl' );
			$form_url = '';
		}

?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"> <?php _e('Title:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('subtitle')); ?>"> <?php _e('Subtitle:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('subtitle')); ?>" name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('form_url')); ?>"> <?php _e('MailChimp POST subscribe URL:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('form_url')); ?>" name="<?php echo esc_attr($this->get_field_name('form_url')); ?>" type="text" value="<?php echo esc_attr($form_url); ?>" />
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e( 'To find the POST subscribe URL, go to "Lists" > Select List Name > Signup Forms > Embedded forms > Copy Form Action', 'healthmedical-wpl' ) ?>
			</p>
			<br />
		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['subtitle'] = sanitize_text_field($new_instance['subtitle']);
		$instance['form_url'] = sanitize_text_field($new_instance['form_url']);
		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$subtitle = apply_filters( 'widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance );
		$form_url = isset( $instance['form_url'] ) ? esc_attr( $instance['form_url'] ) : '';
	?>

	<?php echo $before_widget; ?>

	<?php if ( $title ) { ?>
		<?php echo $before_title . esc_html( $title ) . $after_title; ?>
	<?php } ?>

	<div class="subscribe">
		<form class="subscribe-form" id="newsletter-form">
			<label for="mail">
				<?php if ( $subtitle ) { ?>
					<p><?php echo esc_html($subtitle); ?></p>
				<?php } ?>
			</label>
			
			<input type="email" id="mail" name="EMAIL" placeholder="<?php _e('Your email address', 'healthmedical-wpl') ?>"  class="subscribe-field" />
			
			<button type="submit" class="subscribe-btn">
				<i class="fa fa-paper-plane"></i>
			</button>
		</form>

	</div><!-- /.subscribe -->



		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('#newsletter-form').ajaxChimp({
					callback: mailchimpCallback,
					url: '<?php echo esc_js( $form_url ); ?>'
				});
				function mailchimpCallback(resp) {
					if (resp.result === 'success') {
						jQuery('.newsletter_success_message').html(resp.msg.replace("0 - ", "")).fadeIn(1000);
						jQuery('.newsletter_error_message').fadeOut(500);
						
					} else if(resp.result === 'error') {
						jQuery('.newsletter_error_message').html(resp.msg.replace("0 - ", "")).fadeIn(1000);
					}
				}
			});
		</script>

		<?php echo $after_widget; ?>

		<?php
	}
}
?>
