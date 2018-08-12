<?php
/**
 * Individual content box for the services CPT
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php if ( $wp_query->have_posts() ) : ?>
	<div class="section-services section-services-alt box-item" itemscope itemtype="http://schema.org/Product">
		<?php
			for ( $count=0; $wp_query->have_posts(); $count++ ) : $wp_query->the_post();

			$open = !( $count%3 ) ? '<div class="row services-row">' : '';
			$close = !( $count%3 ) && $count ? '</div>' : '';
			echo $close . $open;
		?>
			<div class="columns large-4 medium-4">
				<div class="service">
					<div class="service-box">
						<?php if( has_post_thumbnail() ) { ?>
							<div class="service-image">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('doctorthumb-image'); ?>
								</a>
							</div><!-- /.service-image -->
						<?php } ?>

						<div class="service-body">
							<h6><?php the_title(); ?></h6>

							<?php the_excerpt(); ?>

							<a href="<?php the_permalink(); ?>" class="link-more">
								<i class="fa fa-plus"></i>
								<?php _e('Find out more', 'healthmedical-wpl'); ?>
							</a>
						</div><!-- /.service-body -->
					</div><!-- /.service-box -->
				</div><!-- /.service -->
			</div><!-- /.columns large-4 -->
		<?php endfor; wp_reset_postdata(); ?>
		<?php if( !$close ) { echo '</div>'; } ?>

		<div class="row">
			<?php wplook_pagination(); ?>
		</div><!-- /.row -->
	</div><!-- /.section-doctors -->
<?php else: ?>
	<?php get_template_part('content', 'none-services'); ?>
<?php endif; ?>
