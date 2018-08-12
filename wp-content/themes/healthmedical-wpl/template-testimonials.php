<?php
/**
 * Template Name: Testimonials listing
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php get_header(); ?>

<?php  
	$pid = $post->ID;
	$header_image = get_post_meta( $pid, 'wpl_header_image', true);
?>
		
	<?php $default_header_image = ot_get_option('wpl_default_header_image'); ?>
	<?php $header_image_display = get_post_meta( $post->ID, 'wpl_header_image_display', true); ?>
	<?php $header_image = get_post_meta( $post->ID, 'wpl_header_image', true); ?>
	<div class="intro intro-small <?php if( $header_image_display == 'off' || !$header_image && empty($default_header_image) ) { echo 'no-bg-img'; } ?>">
		<?php if( $header_image_display == 'off' ) { ?>
			<div class="intro-image fullsize-image-container" data-stellar-background-ratio="0.54">
			</div>
		<?php } elseif( isset($header_image) || !empty($default_header_image) ) { ?>
			<div class="intro-image fullsize-image-container" data-stellar-background-ratio="0.54">
				<?php if( !empty($header_image) ) { ?>
					<img src="<?php echo esc_url($header_image); ?>" class="fullsize-image header-image-post-specific" alt="" />
				<?php } elseif( !empty($default_header_image) ) { ?>
					<img src="<?php echo esc_url($default_header_image); ?>" class="fullsize-image header-image-default" alt="" />
				<?php } ?>
			</div><!-- /.intro-image -->
		<?php } ?>

		<div class="row">
			<div class="intro-caption">
				<h2><?php the_title(); ?></h2>
			</div><!-- /.intro-caption -->
		</div><!-- /.row -->
	</div><!-- /.intro intro-small -->

	<div class="main grey">
		<?php
			$args = array(
				'post_type' => 'wpl_post_testimonial',
				'post_status' => 'publish',
				'posts_per_page' => ot_get_option('wpl_testimonials_per_page'));

			$wp_query = null;
			$wp_query = new WP_Query( $args );
		?>

		<?php if ( $wp_query->have_posts() ) : ?>
			<section class="section section-testimonials">
				<header class="section-head">
					<i class="fa fa-quote-left"></i>

					<h2><?php _e('What our patients have to say', 'healthmedical-wpl'); ?></h2>

					<h6><?php _e('We are reliable &amp; Trusted', 'healthmedical-wpl'); ?></h6>
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

											<div class="user">
												<div class="user-image">
													<img src="<?php echo esc_url($wpl_toolskit_testimonial_referee_image); ?>" width="82" height="82" alt="" />
												</div><!-- /.user-image -->

												<div class="user-meta">
													<h6><?php echo esc_attr($wpl_toolskit_testimonial_referee_name); ?>, <a href="<?php echo esc_url($wpl_toolskit_testimonial_company_name); ?>"><span><?php echo esc_attr($wpl_toolskit_testimonial_company_name); ?></span></a></h6>
												</div><!-- /.user-meta -->
											</div><!-- /.user -->
										</div><!-- /.slide-caption -->
									</li><!-- /.slide -->
								<?php endwhile; wp_reset_postdata(); ?>
							</ul><!-- /.slides -->
						</div><!-- /.slider-clip -->
					</div><!-- /.slider-testimonials -->
				</div><!-- /.row -->
			</section><!-- /.section-testimonials -->
		<?php else: ?>
			<?php get_template_part('content', 'none-testimonials'); ?>
		<?php endif; ?>

	</div><!-- /.main -->

<?php get_footer(); ?>
