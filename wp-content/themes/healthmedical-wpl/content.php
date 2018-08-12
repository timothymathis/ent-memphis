<?php
/**
 * The main content template file
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php $wpl_blog_featured_images = ot_get_option( 'wpl_blog_featured_images', 'on' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('event', 'article-single-event') ); ?> itemscope itemtype="https://schema.org/BlogPosting">
	<header class="event-date">
		<p><time class="post-date" datetime="<?php echo get_the_date( 'c' ) ?>" itemprop="datePublished"><a href="<?php the_permalink(); ?>"><?php wplook_get_date(); ?></a></time></p><!-- /.post-date -->
	</header>

	<div class="event-box">
		<?php if ( has_post_thumbnail() && ( is_single() || $wpl_blog_featured_images == 'on' ) ) { ?>
			<div class="event-image">
				<?php the_post_thumbnail('featured-image'); ?>
			</div><!-- /.event-image -->
		<?php } ?>

		<?php if ( is_single() ) {
			get_template_part('inc', 'post-meta');
		} ?>

		<div class="event-body" itemprop="articleBody">
			<?php if ( !is_single() ) { ?>
				<h4>
					<a href="<?php the_permalink(); ?>" itemprop="url"><?php the_title(); ?></a>
				</h4>
			<?php } ?>

			<?php if( is_single()) { 
				the_content( sprintf(
						__( 'Continue reading %s', 'healthmedical-wpl' ), the_title( '<span class="screen-reader-text">', '</span>', false )
					) );

					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'healthmedical-wpl' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'healthmedical-wpl' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
			} else { 
				the_content( sprintf(
					__( 'Continue reading %s', 'healthmedical-wpl' ), the_title( '<span class="screen-reader-text">', '</span>', false )
				) );

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'healthmedical-wpl' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'healthmedical-wpl' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) ); } ?>

				<!-- Tags -->
				<?php if ( is_single() && get_the_tag_list( '', ', ' ) ) { ?>
					<div class="tags"><i class="fa fa-tags"></i> <?php echo get_the_tag_list('',', ',''); ?></div>
				<?php } ?>


		</div><!-- /.event-body -->

		<?php if ( ! is_single() ) {
			get_template_part('inc', 'post-meta');
		} ?>
	</div><!-- /.event-box -->
</article><!-- /.event -->
