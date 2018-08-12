<?php
/**
 * Post meta information include
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<div class="event-meta">
	<ul class="list-event-meta">
		<li>
			<i class="fa fa-user"></i>
			<?php the_author_posts_link(); ?>
		</li>
		
		<li class="cat-limit">
			<i class="fa fa-tag"></i>
			<?php the_category(', '); ?>
		</li>
		
		<li>
			<a href="<?php comments_link(); ?>" itemprop="url">
				<i class="fa fa-comment"></i>
				<?php comments_number( __('No comments', 'healthmedical-wpl'), __('1 comment', 'healthmedical-wpl'), __('% comments', 'healthmedical-wpl') ); ?>
			</a>
		</li>
		
		<?php if ( ! is_single() ) { ?>
		
			<li>
				<a href="#" class="link" itemprop="url">
					<i class="fa fa-plus"></i>
					<a href="<?php the_permalink(); ?>"><?php _e('Read more', 'healthmedical-wpl'); ?></a>
				</a>
			</li>
		
		<?php } ?>
		
	</ul>
</div><!-- /.event-meta -->
