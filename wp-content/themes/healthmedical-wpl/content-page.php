<?php
/**
 * The main page template file
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( array('event', 'article-single-event') ); ?> itemscope itemtype="https://schema.org/BlogPosting">

			<div class="event-box">
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="event-image">
						<?php the_post_thumbnail('featured-image'); ?>
					</div><!-- /.event-image -->
				<?php } ?>

				<div class="event-body" itemprop="articleBody">
					<?php the_content(); ?>
				</div><!-- /.event-body -->
			</div><!-- /.event-box -->
		</article><!-- /.event -->
	<?php endwhile; endif; ?>
	<?php comments_template(); ?>
