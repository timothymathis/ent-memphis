<?php
/**
 * Template Name: Contact page / Book Appointment
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
	$wpl_contact_map = get_post_meta( $pid, 'wpl_contact_map', true);
	$wpl_contact_map_address = get_post_meta( $pid, 'wpl_contact_map_address', true);

?>
		
	<?php $default_header_image = ot_get_option('wpl_default_header_image'); ?>
	<?php $header_image_display = get_post_meta( $post->ID, 'wpl_header_image_display', true); ?>
	<?php $header_image = get_post_meta( $post->ID, 'wpl_header_image', true); ?>
	<div class="intro intro-small <?php if( $header_image_display == 'off' || !$header_image && empty($default_header_image) ) { echo 'no-bg-img'; } ?>">
		<?php if( $header_image_display == 'off' ) { ?>
			<div class="intro-image fullsize-image-container" data-stellar-background-ratio="0.54">
			</div>
		<?php } elseif( isset($header_image) || !empty($default_header_image) ) { ?>
			<div class="intro-image fullsize-image-container">
			<!-- <div class="intro-image fullsize-image-container" data-stellar-background-ratio="0.54"> -->
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

		<div class="row">
			<div class="columns <?php if ( $sidebar_position == 'right') { echo "large-8 medium-7";} elseif ( $sidebar_position == 'disable' ) { echo "large-12"; } else { echo "large-8 medium-7 right";} ?>">
				<div class="content">
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="event-image">
							<?php the_post_thumbnail('featured-image'); ?>
						</div><!-- /.event-image -->
					<?php } ?>

					<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( array('event', 'article-single-event') ); ?> itemscope itemtype="https://schema.org/BlogPosting">
							<div class="entry-content">
								<div class="event-body" itemprop="articleBody">
									<?php the_content(); ?>

									<?php if ( $wpl_contact_map == 'on') { ?>
										<div id="map" class="contact-map" data-address="<?php echo esc_attr( $wpl_contact_map_address ); ?>"></div><!-- /#map.map -->
									<?php } // end of wpl_contact_map == 'on' ?>

								</div><!-- /.event-body -->
							</div><!-- /.event-box -->
						<?php endwhile; endif; ?>
					</article><!-- /.event article-single-event -->

				</div><!-- /.content -->
			</div><!-- /.columns large-8 -->

			<?php get_sidebar('page'); ?>
		</div><!-- /.row -->
	</div><!-- /.main -->

<?php get_footer(); ?>
