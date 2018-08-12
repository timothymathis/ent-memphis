<?php
/*
 * Plugin Name: Departments
 * Plugin URI: https://www.wplook.com
 * Description: Add Departments to the home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_departments_widget_home");'));
class wplook_departments_widget_home extends WP_Widget {

	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_departments_widget_home',
			__( 'WPlook Departments (Front page)', 'healthmedical-wpl' ),
			array( 'description' => __( 'A widget for displaying Departments on the front page', 'healthmedical-wpl' ), )
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
			$title = __( 'Our departments', 'healthmedical-wpl' );
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
		?>

		<?php echo $before_widget; ?>

		<!-- Services -->
		<section class="section section-services section-departments">
			<?php if($icon) { ?>
				<div class="section-ribbon">
					<i class="<?php echo esc_attr($icon); ?> white"></i>
				</div><!-- /.section-ribbon -->
			<?php } ?>
			<header class="section-head">
				<h2><?php echo esc_attr($title); ?></h2>

				<h6><?php echo esc_attr($subtitle); ?></h6>
			</header><!-- /.section-head -->

			<?php
				$args = array(
					'post_type' => 'wpl_post_departments',
					'meta_key' => 'wpl_departments_home_widget',
					'meta_value' => 'on',
					'posts_per_page'=> 6,
				);

				$tabs = null;
				$tabs = new WP_Query( $args );

				$first = true;
			?>
			
			<?php if( $tabs->have_posts() ) : ?>
				<div class="tabs tabs-clickable tabs-services">
					<div class="tab-head">
						<div class="tabs-nav">
							<div class="row">
								<div class="columns large-12">
									<ul class="list-services" itemscope itemtype="http://schema.org/Product">
										<?php while ( $tabs->have_posts() ) : $tabs->the_post(); ?>
											<?php $wpl_font_icon = get_post_meta( $post->ID, 'wpl_font_icon', true); ?>
											<li <?php if( $first ) { echo 'class="current"'; $first = false; }; ?>>
												<a href="#department-<?php the_ID(); ?>" itemprop="name">
													<?php if( !empty( $wpl_font_icon ) ) : ?>
														<span class="icon">
															<i class="<?php echo $wpl_font_icon; ?>"></i>
														</span>
													<?php endif; ?>
													<span class="text">
														<?php the_title(); ?>
													</span>
												</a>
											</li>
										<?php endwhile; wp_reset_postdata(); ?>
									</ul><!-- /.list-departments -->
								</div><!-- /.columns large-12 -->
							</div><!-- /.row -->
						</div><!-- /.tabs-nav -->
					</div><!-- /.tab-head -->
				<?php endif; ?>

				<?php
					$args = array(
						'post_type' => 'wpl_post_departments',
						'meta_key' => 'wpl_departments_home_widget',
						'meta_value' => 'on',
						'posts_per_page'=> 6,
					);

					$content = null;
					$content = new WP_Query( $args );

					$first = true;
				?>
				<?php if( $content->have_posts() ) : ?>
					<div class="tabs-body">
						<?php while ( $content->have_posts() ) : $content->the_post(); ?>
							<div class="tab-body <?php if( $first ) { echo 'current'; $first = false; }; ?>" id="department-<?php the_ID(); ?>">
								<div class="row">
									<?php the_content( '<span class="button btn-light-blue btn-small">' . __( 'Find out more', 'healthmedical-wpl' ) . '</span>' ); ?>
								</div><!-- /.row -->
							</div><!-- /.tab-body -->
						<?php endwhile; wp_reset_postdata(); ?>
					</div><!-- /.tabs-body -->
				<?php endif; ?>
			</div><!-- /.tabs -->
		</section><!-- /.section-services -->

		<?php echo $after_widget; ?>
	<?php
	}
}
?>
