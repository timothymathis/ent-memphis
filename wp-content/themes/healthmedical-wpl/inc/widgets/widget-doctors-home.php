<?php
/*
 * Plugin Name: Doctors
 * Plugin URI: https://www.wplook.com
 * Description: Add Doctors to the home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_doctors_widget");'));
class wplook_doctors_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_doctors_widget',
			__( 'WPlook Doctors (Front page)', 'healthmedical-wpl' ),
			array( 'description' => __( 'A widget for displaying Doctors on the front page', 'healthmedical-wpl' ), )
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
			$title = __( 'Qualified doctors', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$subtitle = esc_attr( $instance[ 'subtitle' ] );
		}
		else {
			$subtitle = __( 'We are reliable and trusted', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$icon = esc_attr( $instance[ 'icon' ] );
		}
		else {
			$icon = __( '', 'healthmedical-wpl' );
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
			$linktext = __( 'Click to view all doctors', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$categories = esc_attr( $instance[ 'categories' ] );
		}
		else {
			$categories = __( 'All', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = __( '3', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$display_type = esc_attr( $instance[ 'display_type' ] );
		}
		else {
			$display_type = 'latest';
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
				<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="url" value="<?php echo $link; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('linktext'); ?>"><?php _e('Link text:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('linktext'); ?>" name="<?php echo $this->get_field_name('linktext'); ?>" type="text" value="<?php echo $linktext; ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('categories'); ?>">
					<?php _e('Category:', 'healthmedical-wpl'); ?>
					<br />
				</label>
				
				<?php wp_dropdown_categories(
					array( 
						'name'	=> $this->get_field_name("categories"),
						'show_option_all'    => __('All', 'healthmedical-wpl'),
						'show_count'	=> 1,
						'selected' => $categories,
						'taxonomy'  => 'wpl_doctors_category' 
					) 
				); ?>
				
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of posts:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The number of posts you want to display.', 'healthmedical-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('display_type'); ?>"> <?php _e('Order by:', 'healthmedical-wpl'); ?> <br /> </label>
				<select id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
					<option value="random" <?php selected( 'random', $display_type ); ?>><?php _e('Random', 'healthmedical-wpl'); ?></option>
					<option value="latest" <?php selected( 'latest', $display_type ); ?>><?php _e('Latest', 'healthmedical-wpl'); ?></option>
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
		$instance['link'] = sanitize_text_field($new_instance['link']);
		$instance['linktext'] = sanitize_text_field($new_instance['linktext']);
		$instance['categories'] = sanitize_text_field($new_instance['categories']);
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

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$subtitle = isset( $instance['subtitle'] ) ? esc_attr( $instance['subtitle'] ) : '';
		$icon = isset( $instance['icon'] ) ? esc_attr( $instance['icon'] ) : '';
		$link = apply_filters( 'widget_text', empty( $instance['link'] ) ? '' : $instance['link'], $instance );
		$linktext = apply_filters( 'widget_text', empty( $instance['linktext'] ) ? '' : $instance['linktext'], $instance );
		$categories = isset( $instance['categories'] ) ? esc_attr( $instance['categories'] ) : '';
		$nr_posts = isset( $instance['nr_posts'] ) ? esc_attr( $instance['nr_posts'] ) : '';
		$display_type = isset( $instance['display_type'] ) ? esc_attr( $instance['display_type'] ) : '';
		?>
		
		<?php
			if ( $categories < '1' ) {
				if ( $display_type == 'random') {
					$args = array(
						'post_type' => 'wpl_post_doctors',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts,
						'orderby' => 'rand'
					);
				} else {
					$args = array(
						'post_type' => 'wpl_post_doctors',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts
					);
				}
			} else {
				if ( $display_type == 'random') {
					$args = array(
						'post_type' => 'wpl_post_doctors',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts,
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'wpl_doctors_category',
								'field' => 'id',
								'terms' => $categories
							)
						)
					);
				} else {
					$args = array(
						'post_type' => 'wpl_post_doctors',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts,
						'tax_query' => array(
							array(
								'taxonomy' => 'wpl_doctors_category',
								'field' => 'id',
								'terms' => $categories
							)
						)
					);
				}
			}

			$services = null;
			$services = new WP_Query( $args );
		?>
		
			<?php if( $services->have_posts() ) : ?>

				<?php echo $before_widget; ?>

				<!-- Doctors -->
				<section class="section section-doctors">
					<?php if($icon) { ?>
						<div class="section-ribbon">
							<i class="<?php echo esc_attr($icon); ?>"></i>
						</div><!-- /.section-ribbon -->
					<?php } ?>
					<header class="section-head">
						<?php if($title) { ?><h2><?php echo esc_attr($title); ?></h2><?php } ?>

						<?php if($subtitle) { ?><h6><?php echo esc_attr($subtitle); ?></h6><?php } ?>
					</header><!-- /.section-head -->

					<div class="row">

						<?php while( $services->have_posts() ) : $services->the_post(); ?>
							<?php  
								$pid = $post->ID;
								$wpl_toolskit_doctor_image = get_post_meta( $pid, 'wpl_toolskit_doctor_image', true);
								$wpl_toolskit_doctor_job_title = get_post_meta( $pid, 'wpl_toolskit_doctor_job_title', true);
								$wpl_toolskit_doctor_social_network = get_post_meta( $pid, 'wpl_toolskit_doctor_social_network', true);
							?>

							<div class="columns large-4 medium-4">
								<div class="doctor">
									<h5 class="doctor-name"><?php the_title(); ?></h5><!-- /.doctor-name -->

									<div class="doctor-box">
										<?php if ( has_post_thumbnail() ) { ?>
											<div class="doctor-image">
												<a href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail('doctorthumb-image'); ?>
												</a>	
											</div><!-- /.event-image -->
										<?php } ?>

										<div class="doctor-body">
											<?php if( $wpl_toolskit_doctor_job_title != '' ) { ?>
												<h6><?php echo esc_html($wpl_toolskit_doctor_job_title); ?></h6>
											<?php } ?>

											<?php if( $wpl_toolskit_doctor_social_network != '' ) { ?>
												<div class="socials">
													<ul>
														<?php foreach ($wpl_toolskit_doctor_social_network as $social) { ?>
															<li>
																<a href="<?php echo esc_url($social['wpl_toolskit_doctor_social_network_url']); ?>">
																	<i class="fa <?php echo esc_attr($social['wpl_toolskit_doctor_social_network_icon']); ?>"></i>
																</a>
															</li>
														<?php } ?>
													</ul>
												</div><!-- /.socials -->
											<?php } ?>

											<p><?php echo wplook_short_excerpt('45');?></p>

											<a href="<?php the_permalink(); ?>" class="link-more">
												<i class="fa fa-plus"></i>
												<?php _e('Find out more', 'healthmedical-wpl'); ?>
											</a>
										</div><!-- /.doctor-body -->
									</div><!-- /.doctor-box -->
								</div><!-- /.doctor -->
							</div><!-- /.columns large-4 -->
						<?php endwhile; wp_reset_postdata(); ?>

					</div><!-- /.row -->

					<?php if( !empty($link) || !empty($linktext) ) { ?>
						<div class="section-actions">
							<a href="<?php echo esc_url($link); ?>" class="button btn-grey btn-small"><?php echo esc_attr($linktext); ?></a>
						</div><!-- /.section-actions -->
					<?php } ?>
				</section><!-- /.section-doctors -->

				<?php echo $after_widget; ?>

			<?php endif; ?>
		<?php
	}
}
?>
