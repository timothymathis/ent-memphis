<?php
/**
 * Template Name: Department items listing
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php get_header(); ?>
		
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
							</div><!-- /.columns large-12 -->
						</div><!-- /.row -->
		<?php endif; endwhile; endif; ?>

		<?php $args = array(
			'post_type' => 'wpl_post_departments',
			'posts_per_page' => -1,
		);

		$posts = null;
		$posts = new WP_Query( $args ); ?>

		<?php if( $posts->have_posts() ) : ?>
		
			<div class="row">
				<div class="columns large-12 medium-12">
					<div class="widget widget-services page">
						<ul class="list-services list-services-alt">
							<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
								<?php $wpl_font_icon = get_post_meta( $post->ID, 'wpl_font_icon', true); ?>

								<li>
									<a href="<?php the_permalink(); ?>">
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
						</ul><!-- /.list-services list-services-alt -->
					</div><!-- /.widget widget-services -->
				</div><!-- /.columns large-12 -->
			</div><!-- /.row -->

		<?php endif; ?>

		<?php get_template_part( 'inc', 'booknow' ); ?>
	</div><!-- /.main -->

<?php get_footer(); ?>
