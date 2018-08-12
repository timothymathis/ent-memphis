<?php
/**
 * The search results template file
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php get_header(); ?>
	
	<div class="intro intro-small no-bg-img">
		<div class="intro-image fullsize-image-container" data-stellar-background-ratio="0.54"> </div>

		<div class="row">
			<div class="intro-caption">
				<h5><?php _e('Search results for', 'healthmedical-wpl'); ?></h5>
			
				<h2><?php the_search_query(); ?></h2>
			</div><!-- /.intro-caption -->
		</div><!-- /.row -->
	</div><!-- /.intro intro-small -->

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

			<div class="columns large-12 medium-7">
				<div class="content">
					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( array('event', 'article-single-event') ); ?> itemscope itemtype="https://schema.org/BlogPosting">
								

								<div class="event-box">

									<div class="event-body" itemprop="articleBody">
										<?php if ( !is_single() ) { ?>
											<h4>
												<a href="<?php the_permalink(); ?>" itemprop="url"><?php the_title(); ?></a>
											</h4>
										<?php } ?>

										<?php the_excerpt(); ?>
										<p><a title="<?php _e('Read more', 'healthmedical-wpl'); ?>" href="<?php the_permalink(); ?>"><?php _e('Read more', 'healthmedical-wpl'); ?></a></p>


									</div><!-- /.event-body -->

								</div><!-- /.event-box -->
							</article><!-- /.event -->

						<?php endwhile; ?>

						<?php else : ?>
							<?php get_template_part( 'content', 'none' ); ?>

					<?php endif; ?>
				</div><!-- /.content -->

				<?php wplook_pagination() ?>
			</div><!-- /.columns large-8 -->

		</div><!-- /.row -->

		<?php get_template_part( 'inc', 'booknow' ); ?>
	</div><!-- /.main -->

<?php get_footer(); ?>
