<?php
/**
 * The gallery post format
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('event', 'article-single-event') ); ?> itemscope itemtype="https://schema.org/BlogPosting">
	<header class="event-date">
		<p><time class="post-date" datetime="<?php echo get_the_date( 'c' ) ?>" itemprop="datePublished"><a href="<?php the_permalink(); ?>"><?php wplook_get_date(); ?></a></time></p><!-- /.post-date -->
	</header>

	<div class="event-box">
		<?php if ( is_single() && has_post_thumbnail() ) { ?>
			<div class="event-image">
				<?php the_post_thumbnail('featured-image'); ?>
			</div><!-- /.event-image -->
		<?php } ?>

		<?php if ( is_single() ) {
			get_template_part('inc', 'post-meta');
		} ?>

		<?php
		if( ! is_single() ) { ?>

				<?php $post_img_gallery = get_post_gallery( $page_id, false );
				if (array_key_exists('ids', $post_img_gallery)) { ?>
					<div class="event-body event-full-width-height" itemprop="articleBody">
						<div class="event-slider loading">
							<div class="slider-clip">

								<?php $post_img_gallery_ids = explode( ",", $post_img_gallery['ids'] );
								$image_list = '<ul class="slides">';
								foreach( $post_img_gallery_ids as $id ) {
									$img_thumb   = wp_get_attachment_image_src ( $id, 'gallery-thumb');
									$image_list .= '<li class="slide"><div class="slide-image"><img src="' . esc_url($img_thumb["0"]) . '" width="984" height="615"/></div></li>';
								}
								$image_list .= '</ul>';
								echo $image_list; ?>

							</div><!-- /.slider-clip -->
						</div><!-- /.post-slider -->
					</div><!-- /.event-body -->
				<?php } ?>

				<div class="event-body" itemprop="articleBody">
					<h4>
						<a href="<?php the_permalink(); ?>" itemprop="url"><?php the_title(); ?></a>
					</h4>

					<?php the_excerpt(); ?>
				</div><!-- /.event-body -->
			
		<?php } else { ?>

			<div class="event-body" itemprop="articleBody">
				<?php the_content(); ?>
			</div><!-- /.event-body -->

		<?php } ?>
		
		<?php if ( ! is_single() ) {
			get_template_part('inc', 'post-meta');
		} ?>
	</div><!-- /.event-box -->
</article><!-- /.event -->



