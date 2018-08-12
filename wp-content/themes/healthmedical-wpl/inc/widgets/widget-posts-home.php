<?php
/*
 * Plugin Name: Posts Widget
 * Plugin URI: https://www.wplook.com
 * Description: Add Posts to home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_posts_homepage_widget");'));
class wplook_posts_homepage_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_posts_homepage_widget',
			__( 'WPlook Posts (Front page)', 'healthmedical-wpl' ),
			array( 'description' => __( 'A widget for displaying latest posts on home page', 'healthmedical-wpl' ), )
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
			$title = __( 'Posts', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$subtitle = esc_attr( $instance[ 'subtitle' ] );
		}
		else {
			$subtitle = __( 'Posts', 'healthmedical-wpl' );
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
			$linktext = __( 'Find out more', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$categories = esc_attr( $instance[ 'categories' ] );
		}
		else {
			$categories = __( 'All', 'healthmedical-wpl' );
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
						'taxonomy'  => 'category' 
					) 
				); ?>
				
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

		// Posts query
		if ( $categories < '1' ) {
			$posts_args = array(
				'post_type' => 'post',
				'posts_per_page' => 4,
			);
		} else {
			$posts_args = array(
				'post_type' => 'post',
				'posts_per_page' => 4,
				'cat' => $categories
			);
		}

		$posts = null;
		$posts = new WP_Query( $posts_args );

		$post_count = $posts->post_count;
		?>

		<?php echo $before_widget; ?>

		<!-- News -->
		<section class="section section-updates <?php echo ( $post_count <= 4 ? 'less-than-5' : 'more-than-5' ); ?>">
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

				<?php if( $posts->have_posts() && $post_count >= 5 ) : ?>
					<div class="column large-6 medium-6">
						<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
							<div class="event">
								<div class="event-date">
									<p><time class="post-date" datetime="<?php echo get_the_date( 'c' ) ?>" itemprop="datePublished"><?php wplook_get_date(); ?></time></p><!-- /.post-date -->
								</div><!-- /.event-date -->

								<div class="event-box">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="event-image">
											<?php the_post_thumbnail('bignews-image'); ?>
										</div><!-- /.event-image -->
									<?php } ?>

									<div class="event-entry">
										<h4>
											<a href="<?php the_permalink(); ?>" itemprop="url"><?php the_title(); ?></a>
										</h4>

										<p><?php echo wplook_short_excerpt('45');?></p>

										<a href="<?php the_permalink(); ?>" class="link-more">
											<i class="fa fa-plus"></i>
											<?php _e('Find out more', 'healthmedical-wpl'); ?>
										</a>
									</div><!-- /.event-entry -->
								</div><!-- /.event-box -->
							</div><!-- /.event -->

							<?php
								// Break out of the loop after the first post
								break;
							?>
						<?php endwhile; wp_reset_postdata(); ?>
					</div><!-- /.column large-6 -->
				<?php endif; ?>

				<?php if( $posts->have_posts() ) : ?>
					<div class="column <?php echo $post_count >= 5 ? 'large-6' : 'large-12'; ?>">
						<ul class="list-events">
							<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
								<?php //var_dump( $posts->current_post ); ?>
								<li>
									<a href="<?php the_permalink(); ?>">
										<?php if ( has_post_thumbnail() ) { ?>
											<span class="image">
												<?php the_post_thumbnail('doctorthumb-image'); ?>
											</span><!-- /.event-image -->
										<?php } ?>

										<span class="title"><?php the_title(); ?></span>
									</a>
								</li>
							<?php endwhile; wp_reset_postdata(); ?>
						</ul><!-- /.list-events -->
					</div><!-- /.column large-6 -->
				<?php endif; ?>
			</div><!-- /.row -->

			<div class="section-actions">
				<a href="<?php echo esc_url($link); ?>" class="button btn-light-blue btn-small"><?php echo esc_attr($linktext); ?></a>
			</div><!-- /.section-actions -->
		</section><!-- /.section-updates -->

		<?php echo $after_widget; ?>

		<?php
	}
}
?>
