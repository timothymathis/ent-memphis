<?php
/**
 * Front page slider template part
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>
<?php $header_image = get_header_image(); ?>
<?php if ( ( ot_get_option('wpl_rev_slider') == "on") && ot_get_option('wpl_slider_revolution') != '') { // If Revolution Slider is enabled
		putRevSlider( ot_get_option( 'wpl_slider_revolution') );
} elseif (! empty( $header_image ) ) { // If a stastic header image is set in settings ?>
	<img class="header-image" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
<?php } elseif ( ot_get_option('wpl_custom_slider') == 'on' ) { // Use the default WPLook slider ?>

	<?php
		$wpl_slider_auto = ot_get_option( 'wpl_slider_auto' );
		$wpl_slider_auto = !empty( $wpl_slider_auto ) ? $wpl_slider_auto : 'on';

		$args = array(
			'post_type' => 'wpl_post_slider',
			'post_status' => 'publish',
			'posts_per_page' => 10,
		);

		$wp_query = null;
		$wp_query = new WP_Query( $args );

		if ( $wp_query->have_posts() ) :
	?>

	<div class="intro">
		<div class="intro-slider" data-auto="<?php echo $wpl_slider_auto; ?>">
			<div class="slider-clip">
				<ul class="slides">
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						<?php
							$slide_image = get_post_meta(get_the_ID(), 'wpl_slide_image', true);
							$slider_quote = get_post_meta(get_the_ID(), 'wpl_quote_form', true);
							$slider_title_unhighlighted = get_post_meta(get_the_ID(), 'wpl_slider_title_unhighlighted', true);
							$slider_title_highlighted = get_post_meta(get_the_ID(), 'wpl_slider_title_highlighted', true);
							$slider_subtitle = get_post_meta(get_the_ID(), 'wpl_slider_subtitle', true);
							$slider_content = get_post_meta(get_the_ID(), 'wpl_slider_content', true);
							$slider_button_text = get_post_meta(get_the_ID(), 'wpl_slider_button_text', true);
							$slider_button_url = get_post_meta(get_the_ID(), 'wpl_slider_button_url', true);
							$slider_shortcode = get_post_meta(get_the_ID(), 'wpl_slider_shortcode', true);
						?>

						<li class="slide fullsize-image-container">
							<?php if( $slide_image ) { ?>
								<div class="slide-image">
									<img src="<?php echo esc_url( $slide_image ); ?>" width="2560" height="1200" class="fullsize-image" alt="" />
								</div><!-- /.slide-image -->
							<?php } ?>
							
							<?php if( $slider_title_unhighlighted || $slider_title_highlighted || $slider_subtitle || $slider_content || $slider_button_url || $slider_button_text ) { ?>
								<div class="slide-caption">
									<?php if( $slider_subtitle ) { ?>
										<h5><?php echo esc_attr( $slider_subtitle ); ?></h5>
									<?php } ?>
								
									<div class="slide-caption-inner">
										<?php if( $slider_title_unhighlighted || $slider_title_highlighted ) { ?>
											<h1>
												<span><?php if( $slider_title_unhighlighted ) { echo esc_attr( $slider_title_unhighlighted ); } ?></span>
												<?php if( $slider_title_highlighted ) { echo esc_attr( $slider_title_highlighted ); } ?>
											</h1>
										<?php } ?>
								
										<?php if( $slider_content ) { ?><p class="mobile-hidden"><?php echo esc_attr( $slider_content ); ?></p><?php } ?>
								
										<?php if( $slider_button_url && $slider_button_text ) { ?>
											<a href="<?php echo esc_url( $slider_button_url ); ?>">
												<i class="fa fa-plus"></i>
												<?php echo esc_attr( $slider_button_text ); ?>
											</a>
										<?php } ?>
									</div><!-- /.slide-caption-inner -->
								</div><!-- /.slide-caption -->
							<?php } ?>
						</li><!-- /.slide -->
					<?php endwhile; wp_reset_postdata(); ?>
				</ul><!-- /.slides -->
			</div><!-- /.slider-clip -->
		</div><!-- /.intro-slider -->
	</div><!-- /.intro -->
	<?php endif; ?>
<?php } ?>
