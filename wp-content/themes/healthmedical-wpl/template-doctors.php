<?php
/**
 * Template Name: Doctors listing
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
				<h5><?php _e('Trained Staff', 'healthmedical-wpl'); ?>
				<h2><?php the_title(); ?></h2>
			</div><!-- /.intro-caption -->
		</div><!-- /.row -->
	</div><!-- /.intro intro-small -->

	<div class="main grey">
		<div class="section-doctors section-doctors-alt">
			<?php
				$categories = get_categories( array(
					'taxonomy' => 'wpl_doctors_category',
					'hide_empty' => true,
				) );

				if( count( $categories ) > 0 ) {
			?>
				<div class="tabs tabs-services">
					<div class="tab-head">
						<div class="tabs-nav">
							<div class="row">
								<div class="columns large-12 slider-tabs">
									<ul class="list-services list-services-alt list-services-slider">
										<li class="current">
											<a href="<?php echo wplook_get_all_cpt_link('doctors', 'wpl_doctors_all_link'); ?>">
												<?php $doctors_default_icon = ot_get_option( 'wpl_doctors_default_icon' ); ?>
												<span class="icon">
													<i class="<?php echo ( !empty( $doctors_default_icon ) ? esc_attr( $doctors_default_icon ) : 'icon-medical-asclepius-sign' ); ?>"></i>
												</span>
												<span class="text">
													<?php _e('All doctors', 'healthmedical-wpl'); ?>
												</span>
											</a>
										</li>

										<?php
											foreach($categories as $category) {
												$meta_fields = get_option('taxonomy_' . $category->term_id);
										?>

											<li>
												<a href="<?php echo get_term_link($category, $category->taxonomy); ?>">
													<?php if( !empty( $meta_fields['wpl_category_image'] ) ) : ?>
														<span class="icon">
															<i class="<?php echo $meta_fields['wpl_category_image']; ?>"></i>
														</span>
													<?php endif; ?>
													<span class="text">
														<?php echo $category->cat_name; ?>
													</span>
												</a>
											</li>

										<?php } ?>
									</ul><!-- /.list-departments -->
								</div><!-- /.columns large-12 -->
							</div><!-- /.row -->
						</div><!-- /.tabs-nav -->
					</div><!-- /.tab-head -->
				</div><!-- /.tabs -->
			<?php } ?>

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
				$args = array(
					'post_type' => 'wpl_post_doctors',
					'post_status' => 'publish',
					'posts_per_page' => ot_get_option('wpl_doctors_per_page'),
					'paged'=> $paged);

				$wp_query = null;
				$wp_query = new WP_Query( $args );
			?>

			<?php get_template_part( 'content-custom', 'doctor' ); ?>

			<?php get_template_part( 'inc', 'booknow' ); ?>
		</div><!-- /.section-doctors -->
	</div><!-- /.main -->

<?php get_footer(); ?>
