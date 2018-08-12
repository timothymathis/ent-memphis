<?php
/**
 * The single post template for displaying the services CPT
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
<?php $default_header_image = ot_get_option('wpl_default_header_image'); ?>
<?php $header_image_display = get_post_meta( $post->ID, 'wpl_header_image_display', true); ?>
<?php $services_header_image = ot_get_option('wpl_services_header_image'); ?>

<div class="intro intro-small <?php if( $header_image_display == 'off' || ( !$header_image && empty($services_header_image) && empty($default_header_image) ) ) { echo 'no-bg-img'; } ?>">
  <?php if( isset($header_image) || !empty($services_header_image) || !empty($default_header_image) ) { ?>
  <div class="intro-image fullsize-image-container" data-stellar-background-ratio="0.54">
    <?php if( $header_image_display == 'off' ) { ?>
    <div class="intro-image fullsize-image-container" data-stellar-background-ratio="0.54"> </div>
    <?php } elseif( !empty($header_image) ) { ?>
    <img src="<?php echo esc_url($header_image); ?>" class="fullsize-image header-image-post-specific" alt="<?php echo the_field('header_image_alt_tag'); ?>" />
    <?php } elseif( !empty($services_header_image) ) { ?>
    <img src="<?php echo esc_url($services_header_image); ?>" class="fullsize-image header-image-post-type" alt="<?php echo the_field('header_image_alt_tag'); ?>" />
    <?php } elseif( !empty($default_header_image) ) { ?>
    <img src="<?php echo esc_url($default_header_image); ?>" class="fullsize-image header-image-default" alt="<?php echo the_field('header_image_alt_tag'); ?>" />
    <?php } ?>
  </div>
  <!-- /.intro-image -->
  <?php } ?>
  <div class="row">
    <div class="intro-caption">
      <h5>
        <?php _e('Our Practice', 'healthmedical-wpl') ?>
      </h5>
      <h2>
        <?php the_title(); ?>
      </h2>
    </div>
    <!-- /.intro-caption --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /.intro intro-small -->

<div class="main grey">
  <div class="row">
    <?php if (ot_get_option('wpl_breadcrumbs_status') != 'off') : ?>
    <div class="columns large-12">
      <p class="breadcrumbs">
        <?php //wplook_breadcrumbs(); ?>
       
        <a href="http://drlazar.thinkwithebiz.com/">Home</a> <span class="delimiter"><i class="fa fa-angle-right"></i></span> <span>Our Practice</span> <span class="delimiter"><i class="fa fa-angle-right"></i></span> <span class="current"><?php the_title(); ?></span>  
      </p>
      <!-- /.breadcrumbs --> 
    </div>
    <!-- /.columns large-12 -->
    <?php else :?>
    <div class="divider-nobreadcrumbs"></div>
    <?php endif; ?>
    <div class="columns <?php if ( $sidebar_position == 'right') { echo "large-8 medium-7";} elseif ( $sidebar_position == 'disable' ) { echo "large-12"; } else { echo "large-8 medium-7 right";} ?>">
      <div class="content">
        <article id="post-<?php the_ID(); ?>" <?php post_class( array('event', 'article-single-event') ); ?>>
          <div class="event-box service-single">
            <?php if ( has_post_thumbnail() ) { ?>
            <div class="event-image">
              <?php the_post_thumbnail('featured-image'); ?>
            </div>
            <!-- /.event-image -->
            <?php } ?>
            <div class="event-body" itemprop="articleBody">
              <?php the_content(); ?>
            </div>
            <!-- /.event-body --> 
          </div>
          <!-- /.event-box --> 
        </article>
        <!-- /.event --> 
      </div>
      <!-- /.content -->
      
      <?php wplook_pagination() ?>
    </div>
    <!-- /.columns large-8 -->
    
    <?php get_sidebar('services'); ?>
  </div>
  <!-- /.row -->
  
  <?php get_template_part( 'inc', 'booknow' ); ?>
</div>
<!-- /.main -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>
