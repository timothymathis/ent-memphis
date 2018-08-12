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
                <?php
					if ( is_home() ) {
					// This is the blog posts index
					get_template_part('testmonial-slider');
			
					} else {
					// This is not the blog posts index
					get_template_part('reviews');
					}
				 ?>
					<!-- /.slider-testimonials -->
				</div><!-- /.row -->
			</section><!-- /.section-testimonials -->
		<?php else: ?>
			<?php get_template_part('content', 'none-testimonials'); ?>
		<?php endif; ?>

	</div><!-- /.main -->

<?php get_footer(); ?>
