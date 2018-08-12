<?php
/**
 * The default page template file
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

dsd
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
					<?php get_template_part( 'content', 'page' ); ?>
				</div><!-- /.content -->
			</div><!-- /.columns large-8 -->

			<?php get_sidebar('page'); ?>
		</div><!-- /.row -->

	</div><!-- /.main -->

<?php get_footer(); ?>
