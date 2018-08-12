<?php
/**
 * The single post template for displaying the departments CPT
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php get_header(); ?>

<?php
	$pid = $post->ID;
	$wpl_departments_category_doctors = get_post_meta( $post->ID, 'wpl_departments_category_doctors', true);
	$wpl_departments_category_services = get_post_meta( $post->ID, 'wpl_departments_category_services', true);
?>

	<?php $default_header_image = ot_get_option('wpl_default_header_image'); ?>
	<?php $header_image_display = get_post_meta( $post->ID, 'wpl_header_image_display', true); ?>
	<?php $doctors_header_image = ot_get_option('wpl_departments_header_image'); ?>
	<?php $header_image = get_post_meta( $post->ID, 'wpl_header_image', true); ?>
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
				<h5><?php _e( 'Department', 'healthmedical-wpl' ); ?></h5>
				<h2><?php the_title(); ?></h2>
			</div><!-- /.intro-caption -->
		</div><!-- /.row -->
	</div><!-- /.intro intro-small -->

	<div class="main grey">
		<?php if (ot_get_option('wpl_breadcrumbs_status') != 'off') : ?>
			<div class="row">
				<div class="columns large-12">
					<p class="breadcrumbs">
						<?php wplook_breadcrumbs(); ?>
					</p><!-- /.breadcrumbs -->
				</div><!-- /.columns large-12 -->
			</div><!-- /.row -->
		<?php else :?>
			<div class="divider-nobreadcrumbs"></div>
		<?php endif; ?>	

		<?php if( have_posts() ) : ?>
				<?php while( have_posts() ) : the_post(); ?>
					<?php if( get_the_content() !== "" ) : ?>
						<div class="row">
							<div class="columns large-12 medium-12">
								<div class="content">
									<article class="event article-single-event">
										<div class="entry-content">
											<div class="event-body" itemprop="articleBody">
												<?php the_content(); ?>
											</div><!-- /.event-body -->
										</div><!-- /.event-box -->
									</article><!-- /.event article-single-event -->
								</div><!-- /.content -->
							</div><!-- /.columns large-8 -->
						</div><!-- /.row -->
		<?php endif; endwhile; endif; ?>

		<?php
			if( !empty( $wpl_departments_category_doctors ) ) {
				$args = array(
					'post_type' => 'wpl_post_doctors',
					'tax_query' => array(
						array(
							'taxonomy' => 'wpl_doctors_category',
							'field' => 'term_id',
							'terms' => $wpl_departments_category_doctors,
						),
					),
				);

				$wp_query = null;
				$wp_query = new WP_Query( $args );

				echo '<div class="row departments-title"><h1>'; _e( 'Our doctors', 'healthmedical-wpl' ); echo '</h1></div>';
				get_template_part( 'content-custom', 'doctor' );
			}

			if( !empty( $wpl_departments_category_services ) ) {
				$args = array(
					'post_type' => 'wpl_post_services',
					'tax_query' => array(
						array(
							'taxonomy' => 'wpl_services_category',
							'field' => 'term_id',
							'terms' => $wpl_departments_category_services,
						),
					),
				);

				$wp_query = null;
				$wp_query = new WP_Query( $args );

				echo '<div class="row departments-title"><h1>'; _e( 'Our services', 'healthmedical-wpl' ); echo '</h1></div>';
				get_template_part( 'content-custom', 'service' );
			}
			
			get_template_part( 'inc', 'booknow' );
		?>
	</div><!-- /.main -->

<?php get_footer(); ?>
