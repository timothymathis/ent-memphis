<?php
/**
 * The archive listing template for displaying the services CPT
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php get_header(); ?>
		
	<?php $default_header_image = ot_get_option('wpl_default_header_image'); ?>
	<?php $header_image_display = get_post_meta( $post->ID, 'wpl_header_image_display', true); ?>
	<?php $services_header_image = ot_get_option('wpl_services_header_image'); ?>
	<div class="intro intro-small <?php if( $header_image_display == 'off' || ( !$header_image && empty($services_header_image) && empty($default_header_image) ) ) { echo 'no-bg-img'; } ?>">
		<?php if( isset($header_image) || !empty($services_header_image) || !empty($default_header_image) ) { ?>
			<div class="intro-image fullsize-image-container" data-stellar-background-ratio="0.54">
				<?php if( $header_image_display == 'off' ) { ?>
					<div class="intro-image fullsize-image-container" data-stellar-background-ratio="0.54">
					</div>
				<?php } elseif( !empty($header_image) ) { ?>
					<img src="<?php echo esc_url($header_image); ?>" class="fullsize-image header-image-post-specific" alt="" />
				<?php } elseif( !empty($services_header_image) ) { ?>
					<img src="<?php echo esc_url($services_header_image); ?>" class="fullsize-image header-image-post-type" alt="" />
				<?php } elseif( !empty($default_header_image) ) { ?>
					<img src="<?php echo esc_url($default_header_image); ?>" class="fullsize-image header-image-default" alt="" />
				<?php } ?>
			</div><!-- /.intro-image -->
		<?php } ?>

		<div class="row">
			<div class="intro-caption">
				<h5><?php _e('Check Our', 'healthmedical-wpl'); ?>
				<h2><?php single_cat_title(); ?></h2>
			</div><!-- /.intro-caption -->
		</div><!-- /.row -->
	</div><!-- /.intro intro-small -->

	<div class="main grey">
		<div class="section-services section-doctors section-doctors-alt">
			<?php
				$categories = get_categories( array(
					'taxonomy' => 'wpl_services_category',
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

										<li>
											<a href="<?php echo wplook_get_all_cpt_link('services', 'wpl_services_all_link'); ?>">
												<?php $services_default_icon = ot_get_option( 'wpl_services_default_icon' ); ?>
												<span class="icon">
													<i class="<?php echo ( !empty( $services_default_icon ) ? esc_attr( $services_default_icon ) : 'icon-medical-asclepius-sign' ); ?>"></i>
												</span>
												<span class="text">
													<?php _e('All services', 'healthmedical-wpl'); ?>
												</span>
											</a>
										</li>

										<?php
											foreach($categories as $category) {
												$meta_fields = get_option('taxonomy_' . $category->term_id);
										?>

											<li class="<?php wplook_check_if_current_taxonomy( $category->slug ); ?>">
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

			<?php if ( category_description() ) : ?>
				<div class="row">
					<div class="columns large-12 medium-12">
						<div class="content">
							<article class="event article-single-event">
								<div class="entry-content">
									<div class="event-body" itemprop="articleBody">
										<?php echo category_description(); ?> 
									</div><!-- /.event-body -->
								</div><!-- /.event-box -->
							</article><!-- /.event article-single-event -->
						</div><!-- /.content -->
					</div><!-- /.columns large-8 -->
				</div><!-- /.row -->
			<?php endif; ?>

			<?php if ( have_posts() ) : ?>
				<div class="section-doctors section-doctors-alt box-item">
					<?php
						for ( $count=0; have_posts(); $count++ ) : the_post();

						$open = !( $count%3 ) ? '<div class="row services-row">' : '';
						$close = !( $count%3 ) && $count ? '</div>' : '';
						echo $close . $open;
					?>

						<div class="columns large-4 medium-4">
							<div class="service">
								<div class="service-box">
									<?php if( has_post_thumbnail() ) { ?>
										<div class="service-image">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail('doctorthumb-image'); ?>
											</a>
										</div><!-- /.service-image -->
									<?php } ?>

									<div class="service-body">
										<h6><?php the_title(); ?></h6>

										<?php the_excerpt(); ?>

										<a href="<?php the_permalink(); ?>" class="link-more">
											<i class="fa fa-plus"></i>
											<?php _e('Find out more', 'healthmedical-wpl'); ?>
										</a>
									</div><!-- /.service-body -->
								</div><!-- /.service-box -->
							</div><!-- /.service -->
						</div><!-- /.columns large-4 -->
					<?php endfor; wp_reset_postdata(); ?>
					<?php if( !$close ) { echo '</div>'; } ?>
				</div>

				<div class="row">
					<?php wplook_pagination() ?>
				</div><!-- /.row -->
			<?php else: ?>
				<?php get_template_part('content', 'none-services'); ?>
			<?php endif; ?>

			<?php get_template_part( 'inc', 'booknow' ); ?>
		</div><!-- /.section-services -->
	</div><!-- /.main -->

<?php get_footer(); ?>
