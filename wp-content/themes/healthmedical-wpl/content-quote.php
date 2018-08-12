<?php
/**
 * The quote post format
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php $wpl_blog_featured_images = ot_get_option( 'wpl_blog_featured_images', 'on' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('event', 'article-single-event', 'format-blockquote') ); ?> itemscope itemtype="https://schema.org/BlogPosting">
	<header class="event-date">
		<p><time class="post-date" datetime="<?php echo get_the_date( 'c' ) ?>" itemprop="datePublished"><a href="<?php the_permalink(); ?>"><?php wplook_get_date(); ?></a></time></p><!-- /.post-date -->
	</header>

	<div class="event-box">
		<?php if ( has_post_thumbnail() && ( is_single() || $wpl_blog_featured_images == 'on' ) ) { ?>
			<div class="event-image">
				<?php the_post_thumbnail('featured-image'); ?>
			</div><!-- /.event-image -->
		<?php } ?>

		<div class="event-body" itemprop="articleBody">
			
			<blockquote class="large">
				<i class="fa fa-quote-left"></i>
				<span><?php the_content(); ?></span>
			</blockquote><!-- /.large -->

		</div><!-- /.event-body -->

		<?php  get_template_part('inc', 'post-meta'); ?>
	</div><!-- /.event-box -->
</article><!-- /.event -->
