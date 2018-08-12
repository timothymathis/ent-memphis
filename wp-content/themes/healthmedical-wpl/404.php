<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php get_header(); ?>
	
	<div class="intro intro-small no-bg-img">
		<div class="row">
			<div class="intro-caption">
				<h5><?php _e('Page not Found', 'healthmedical-wpl'); ?></h5>
			
				<h2><?php _e('404 Error Page', 'healthmedical-wpl'); ?></h2>
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
			<?php else : ?>
				<div class="divider-nobreadcrumbs"></div>
			<?php endif; ?>	

			<div class="columns large-12 medium-12">
				<div class="content">
					<article class="event article-single-event">

						<div class="entry-content">
							<div class="event-body" itemprop="articleBody">
								<h1 class="error-title text-center"><?php _e('404', 'healthmedical-wpl'); ?></h1>
								<h2 class="error-subtitle text-center"><?php _e('The page you were looking for could not be found.', 'healthmedical-wpl'); ?></h2>
								<p class="text-center"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Visit Home Page', 'healthmedical-wpl'); ?></a></p>
							</div><!-- /.event-body -->
						</div><!-- /.event-box -->
					</article><!-- /.event article-single-event -->

				</div><!-- /.content -->
			</div><!-- /.columns large-12 -->
		</div><!-- /.row -->
	</div><!-- /.main -->

<?php get_footer(); ?>
