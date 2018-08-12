<?php
/**
 * The content template file for when no testimonials could be found
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<div class="row">
	<div class="columns large-12 medium-12">
		<div class="content">
			<article class="event article-single-event">

				<div class="entry-content">
					<div class="event-body" itemprop="articleBody">
						<h2 class="error-subtitle text-center"><?php _e('The testimonials you were looking for could not be found.', 'healthmedical-wpl'); ?></h2>
						<p class="text-center"><?php _e('Try <a href="javascript: history.go(-1);">going back</a> to the previous page or using the Search to find something else.', 'healthmedical-wpl'); ?></p>
						<p class="text-center"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Visit Home Page', 'healthmedical-wpl'); ?></a></p>
					</div><!-- /.event-body -->
				</div><!-- /.event-box -->
			</article><!-- /.event article-single-event -->

		</div><!-- /.content -->
	</div><!-- /.columns large-12 -->
</div><!-- /.row -->
