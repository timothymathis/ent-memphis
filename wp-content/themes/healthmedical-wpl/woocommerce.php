<?php
/**
 * The default template for WooCommerce
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php get_header(); ?>

<?php
	$pid = $post->ID;
	$sidebar_position = get_post_meta( $pid, 'wpl_sidebar_position', true);

	global $woocommerce;
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
				<h2><?php _e('Shop', 'healthmedical-wpl'); ?></h2>
			</div><!-- /.intro-caption -->
		</div><!-- /.row -->
	</div><!-- /.intro intro-small -->

	<div class="main grey">
		<div class="row">

			<div class="columns large-12 shop-status">
				<?php if (ot_get_option('wpl_breadcrumbs_status') != 'off') : ?>
					<p class="breadcrumbs">
						<?php wplook_breadcrumbs(); ?>
					</p><!-- /.breadcrumbs -->
				<?php else :?>
					<div class="divider-nobreadcrumbs"></div>
				<?php endif; ?>	

				<p class="cart-status">
					<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'healthmedical-wpl'); ?>"><i class="fa fa-shopping-cart"></i> <?php echo $woocommerce->cart->get_cart_total(); ?></a>
				</p><!-- /.cart-status -->
			</div><!-- /.columns large-12 -->

			<div class="columns large-8 medium-12">
				<div class="content">
					<div class="event">
						<div class="event-box">
							<div class="event-body">
								<?php woocommerce_content(); ?>
							</div><!-- /.event-body -->
						</div><!-- /.event-box -->
					</div><!-- /.event -->
				</div><!-- /.content -->
			</div><!-- /.columns large-8 -->

			<?php get_sidebar('shop'); ?>
		</div><!-- /.row -->

	</div><!-- /.main -->

<?php get_footer(); ?>
