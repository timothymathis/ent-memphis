<?php
/*
 * Plugin Name: About us
 * Plugin URI: https://www.wplook.com
 * Description: Display information about your organisation on the front page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_about_widget");'));
class wplook_about_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_about_widget',
			__( 'WPlook About us (Front page)', 'healthmedical-wpl' ),
			array( 'description' => __( 'Display information about your organisation on the front page', 'healthmedical-wpl' ), )
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
			$title = __( '', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$subtitle = esc_attr( $instance[ 'subtitle' ] );
		}
		else {
			$subtitle = __( '', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$icon = esc_attr( $instance[ 'icon' ] );
		}
		else {
			$icon = __( '', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$highlight = esc_attr( $instance[ 'highlight' ] );
		}
		else {
			$highlight = __( '', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$text = esc_attr( $instance[ 'text' ] );
		}
		else {
			$text = __( '', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$link = esc_url( $instance[ 'link' ] );
		}
		else {
			$link = __( '', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$linktext = esc_attr( $instance[ 'linktext' ] );
		}
		else {
			$linktext = __( '', 'healthmedical-wpl' );
		}

		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle:', 'healthmedical-wpl'); ?></label>
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
				<label for="<?php echo $this->get_field_id('highlight'); ?>"><?php _e('Highlighted text:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('highlight'); ?>" name="<?php echo $this->get_field_name('highlight'); ?>" type="text" value="<?php echo $highlight; ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'healthmedical-wpl'); ?></label>
				<textarea cols="25" rows="10" class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text"><?php echo $text; ?></textarea>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="url" value="<?php echo $link; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('linktext'); ?>"><?php _e('Link text:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('linktext'); ?>" name="<?php echo $this->get_field_name('linktext'); ?>" type="text" value="<?php echo $linktext; ?>" />
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
		$instance['highlight'] = sanitize_text_field($new_instance['highlight']);
		$instance['link'] = sanitize_text_field($new_instance['link']);
		$instance['linktext'] = sanitize_text_field($new_instance['linktext']);
		
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
			$instance['filter'] = isset($new_instance['filter']);
			return $instance;
		}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$subtitle = apply_filters( 'widget_text', empty( $instance['subtitle'] ) ? '' : $instance['subtitle'], $instance );
		$icon = isset( $instance['icon'] ) ? esc_attr( $instance['icon'] ) : '';
		$highlight = apply_filters( 'widget_text', empty( $instance['highlight'] ) ? '' : $instance['highlight'], $instance );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$link = apply_filters( 'widget_text', empty( $instance['link'] ) ? '' : $instance['link'], $instance );
		$linktext = apply_filters( 'widget_text', empty( $instance['linktext'] ) ? '' : $instance['linktext'], $instance );
		
		echo $before_widget;
	?>
		<div class="section-about-us-bg">
			<div class="row">
				<?php if($icon) { ?>
					<div class="section-ribbon">
						<i class="<?php echo esc_attr($icon); ?> white"></i>
					</div><!-- /.section-ribbon -->
				<?php } ?>	
				<div class="columns large-12 medium-12 grey">
					<section class="section-about-us fullsize-image-container">
						<h2><?php echo esc_attr($title); ?></h2>
						<h6><?php echo esc_attr($subtitle); ?></h6>
						<h3><?php echo esc_attr($highlight); ?></h3>
						<p><?php echo esc_attr($text); ?></p>
						<div class="section-actions">
							<a href="<?php echo esc_url($link); ?>" class="button btn-light-blue btn-small"><?php echo esc_attr($linktext); ?></a>
						</div><!-- /.section-actions -->
					</section><!-- /.section-about-us -->
				</div><!-- /.columns .large-6 -->
			</div>
		</div>	
	<?php echo $after_widget;

	}
}

	/*-----------------------------------------------------------------------------------*/
	/*	JS
	/*-----------------------------------------------------------------------------------*/

	function wplook_js_scripts($hook) {
		if ( 'widgets.php' == $hook || 'customize.php' == $hook ) {
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_enqueue_script('upload_media_widget', get_template_directory_uri().'/assets/javascripts/upload-media.js', '', '', 'footer' );
		}
	}
	add_action( 'admin_enqueue_scripts', 'wplook_js_scripts' );

?>
