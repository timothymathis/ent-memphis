<?php
/**
 * The single post template for displaying the doctors CPT
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
	$sidebar_position = get_post_meta( $pid, 'wpl_sidebar_position', true);
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php  
			$pid = $post->ID;
			$wpl_toolskit_doctor_image = get_post_meta( $pid, 'wpl_toolskit_doctor_image', true);
			$wpl_toolskit_doctor_job_title = get_post_meta( $pid, 'wpl_toolskit_doctor_job_title', true);
			$wpl_toolskit_doctor_opening_times = get_post_meta( $pid, 'wpl_toolskit_doctor_opening_times', true);
		?>
		
	<?php $default_header_image = ot_get_option('wpl_default_header_image'); ?>
	<?php $header_image_display = get_post_meta( $post->ID, 'wpl_header_image_display', true); ?>
	<?php $doctors_header_image = ot_get_option('wpl_doctors_header_image'); ?>
	<div class="intro intro-small <?php if( $header_image_display == 'off' || ( !$header_image && empty($doctors_header_image) && empty($default_header_image) ) ) { echo 'no-bg-img'; } ?>">
		<?php if( isset($header_image) || !empty($doctors_header_image) || !empty($default_header_image) ) { ?>
			<div class="intro-image fullsize-image-container" data-stellar-background-ratio="0.54">
				<?php if( $header_image_display == 'off' ) { ?>
					<div class="intro-image fullsize-image-container" data-stellar-background-ratio="0.54">
					</div>
				<?php } elseif( !empty($header_image) ) { ?>
					<img src="<?php echo esc_url($header_image); ?>" class="fullsize-image header-image-post-specific" alt="" />
				<?php } elseif( !empty($doctors_header_image) ) { ?>
					<img src="<?php echo esc_url($doctors_header_image); ?>" class="fullsize-image header-image-post-type" alt="" />
				<?php } elseif( !empty($default_header_image) ) { ?>
					<img src="<?php echo esc_url($default_header_image); ?>" class="fullsize-image header-image-default" alt="" />
				<?php } ?>
			</div><!-- /.intro-image -->
		<?php } ?>

		<div class="row">
			<div class="intro-caption">
				<?php if( $wpl_toolskit_doctor_job_title ) { ?>
					<h5><?php echo esc_html($wpl_toolskit_doctor_job_title); ?></h5>
				<?php } ?>
			
				<h2><?php the_title(); ?></h2>
			</div><!-- /.intro-caption -->
		</div><!-- /.row -->
	</div><!-- /.intro intro-small -->

	<div class="main grey">
		<div class="row">
			<?php if (ot_get_option('wpl_breadcrumbs_status') != 'off') : ?>
				<div class="columns large-12">
					<p class="breadcrumbs">
						<?php wplook_breadcrumbs(); ?>
					</p><!-- /.breadcrumbs -->
				</div><!-- /.columns large-12 -->
			<?php else :?>
				<div class="divider-nobreadcrumbs"></div>
			<?php endif; ?>

			<div class="columns <?php if ( $sidebar_position == 'right') { echo "large-8 medium-7";} elseif ( $sidebar_position == 'disable' ) { echo "large-12"; } else { echo "large-8 medium-7 right";} ?>">
				<div class="content">
					<article id="post-<?php the_ID(); ?>" <?php post_class( array('event', 'article-single-event') ); ?> itemscope itemtype="https://schema.org/BlogPosting">

						<div class="event-boxs">

							<?php $wpl_doctors_single_featured_image = ot_get_option( 'wpl_doctors_single_featured_image', 'on' ); ?>
							<?php if ( has_post_thumbnail() && $wpl_doctors_single_featured_image == 'on' ) { ?>
								<div class="event-image">
									<?php the_post_thumbnail('featured-image'); ?>
								</div><!-- /.event-image -->
							<?php } ?>

							<div class="event-body" itemprop="articleBody">

								<div class="doctor-profile">
									<div class="row">
										<?php if( $wpl_toolskit_doctor_image ) { ?>
											<div class="small-12 large-4 columns">
												<img src="<?php echo esc_url($wpl_toolskit_doctor_image); ?>" alt="" />
											</div>
										<?php } ?>
										
										<div class="small-12 <?php if ( $wpl_toolskit_doctor_image) { echo "large-8"; } else { echo "large-12"; } ?> columns">
											<?php if( $wpl_toolskit_doctor_opening_times ) { ?>
												<div class="doctor-program">
													<h4>Availability</h4>

													<ul class="small-block-grid-1 medium-block-grid-1 large-block-grid-2">
														<?php foreach ($wpl_toolskit_doctor_opening_times as $times) { ?>
															<li><?php echo esc_html($times['title']); ?> <span><?php echo esc_html($times['wpl_toolskit_doctor_opening_times_time']); ?></span></li>
														<?php } ?>
													</ul>
												</div>
											</div>
										<?php } ?>
									</div>
								</div><!-- /.doctor-profile -->

								<?php the_content(); ?>
							</div><!-- /.event-body -->
						</div><!-- /.event-boxs -->
					</article><!-- /.event -->
				</div><!-- /.content -->

				<?php wplook_pagination() ?>
			</div><!-- /.columns large-8 -->

			<?php get_sidebar('doctors'); ?>
		</div><!-- /.row -->

		<?php get_template_part( 'inc', 'booknow' ); ?>
	</div><!-- /.main -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>
