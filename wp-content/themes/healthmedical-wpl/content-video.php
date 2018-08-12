<?php
/**
 * The video post format
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

		<div class="event-full-width" itemprop="articleBody">
			
			<?php the_content(); ?>

		</div><!-- /.event-body -->

		<div class="event-body" itemprop="articleBody">
			
			<?php if ( !is_single() ) { ?>
				<h4>
					<a href="<?php the_permalink(); ?>" itemprop="url"><?php the_title(); ?></a>
				</h4>
			<?php } ?>
			
			<?php the_excerpt(); ?>
		</div>

		<?php  get_template_part('inc', 'post-meta'); ?>
	</div><!-- /.event-box -->
</article><!-- /.event -->
