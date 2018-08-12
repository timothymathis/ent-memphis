<?php
/*
 * Plugin Name: Testimonials
 * Plugin URI: https://www.wplook.com
 * Description: Display the latest testimonials
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_testimonials_widget");'));
class wplook_testimonials_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_testimonials_widget',
			__( 'WPlook Testimonials (Front page)', 'healthmedical-wpl' ),
			array( 'description' => __( 'A widget for displaying Testimonials.', 'healthmedical-wpl' ), )
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
			$title = __( 'What our patients have to say', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$subtitle = esc_attr( $instance[ 'subtitle' ] );
		}
		else {
			$subtitle = __( 'We are reliable & trusted', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$icon = esc_attr( $instance[ 'icon' ] );
		}
		else {
			$icon = __( '', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = __( '4', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$display_type = esc_attr( $instance[ 'display_type' ] );
		}
		else {
			$display_type = __( 'random', 'healthmedical-wpl' );
		}


		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('subtitle'); ?>"> <?php _e('subtitle:', 'healthmedical-wpl'); ?> </label>
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
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of testimonials:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The number of testimonials you want to display.', 'healthmedical-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('display_type'); ?>"><?php _e('Order:', 'healthmedical-wpl'); ?> <br /> </label>
				<select id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
					<option value="rand" <?php selected( 'rand', $display_type ); ?>><?php _e('Random', 'healthmedical-wpl'); ?></option>
					<option value="date" <?php selected( 'date', $display_type ); ?>><?php _e('Latest', 'healthmedical-wpl'); ?></option>
				</select>
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
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
		$instance['display_type'] = sanitize_text_field($new_instance['display_type']);
		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$subtitle = apply_filters( 'widget_title', $instance['subtitle'] );
		$icon = isset( $instance['icon'] ) ? esc_attr( $instance['icon'] ) : '';
		$nr_posts = apply_filters( 'widget_nr_posts', $instance['nr_posts'] );
		$display_type = apply_filters( 'widget', $instance['display_type'] );
		?>

		<?php $args = array( 'post_type' => 'wpl_post_testimonial','post_status' => 'publish', 'posts_per_page' => $nr_posts, 'orderby' => $display_type); ?>
		<?php $wp_query = null; ?>
		<?php $wp_query = new WP_Query( $args ); ?>

		<?php if ( $wp_query->have_posts() ) : ?>

			<?php echo $before_widget; ?>

			<section class="section section-testimonials">
				<?php if($icon) { ?>
					<div class="section-ribbon">
						<i class="<?php echo esc_attr($icon); ?> white"></i>
					</div><!-- /.section-ribbon -->
				<?php } ?>
				<header class="section-head">
					<?php if($title) { ?><h2><?php echo esc_attr($title); ?></h2><?php } ?>
					<?php if($subtitle) { ?><h6><?php echo esc_attr($subtitle); ?></h6><?php } ?>
				</header><!-- /.section-head -->

				<div class="row">
					<div class="slider-testimonials">
						<div class="slider-clip">
							<ul class="slides">
								<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

								<?php  
									$pid = $post->ID;
									$wpl_toolskit_testimonial_referee_name = get_post_meta( $pid, 'wpl_toolskit_testimonial_referee_name', true);
									$wpl_toolskit_testimonial_referee_image = get_post_meta( $pid, 'wpl_toolskit_testimonial_referee_image', true);
									$wpl_toolskit_testimonial_company_name = get_post_meta( $pid, 'wpl_toolskit_testimonial_company_name', true);
									$wpl_toolskit_testimonial_company_url = get_post_meta( $pid, 'wpl_toolskit_testimonial_company_url', true);
								?>

									<li class="slide">
										<div class="slide-caption">
											<blockquote>
												<?php the_content(); ?>
											</blockquote>

											<?php if( !empty( $wpl_toolskit_testimonial_referee_image ) || !empty( $wpl_toolskit_testimonial_referee_name ) || !empty( $wpl_toolskit_testimonial_referee_company_name ) ) : ?>
												<div class="user">
													<?php if( !empty( $wpl_toolskit_testimonial_referee_image ) ) : ?>
														<div class="user-image">
															<img src="<?php echo esc_url($wpl_toolskit_testimonial_referee_image); ?>" width="82" height="82" alt="" />
														</div><!-- /.user-image -->
													<?php endif; ?>

													<?php if( !empty( $wpl_toolskit_testimonial_referee_name ) || !empty( $wpl_toolskit_testimonial_referee_image ) || !empty( $wpl_toolskit_testimonial_company_name ) ) : ?>
														<div class="user-meta">
															<h6>
																<?php
																	echo esc_attr($wpl_toolskit_testimonial_referee_name);

																	echo ( $wpl_toolskit_testimonial_referee_name && $wpl_toolskit_testimonial_company_name ? ', ' : '' );
																?>

																<?php if( !empty( $wpl_toolskit_testimonial_company_url ) ) : ?>
																	<a href="<?php echo esc_url($wpl_toolskit_testimonial_company_url); ?>">
																		<span><?php echo esc_attr($wpl_toolskit_testimonial_company_name); ?></span>
																	</a>
																<?php else: ?>
																	<span><?php echo esc_attr($wpl_toolskit_testimonial_company_name); ?></span>
																<?php endif; ?>
															</h6>
														</div><!-- /.user-meta -->
													<?php endif; ?>
												</div><!-- /.user -->
											<?php endif; ?>
										</div><!-- /.slide-caption -->
									</li><!-- /.slide -->
								<?php endwhile; wp_reset_postdata(); ?>
							</ul><!-- /.slides -->
						</div><!-- /.slider-clip -->
					</div><!-- /.slider-testimonials -->
				</div><!-- /.row -->
			</section><!-- /.section-testimonials -->
	
			<?php echo $after_widget; ?>

		<?php endif; ?>

<?php }
}
?>
