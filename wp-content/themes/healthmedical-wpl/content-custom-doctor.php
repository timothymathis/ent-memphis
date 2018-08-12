<?php
/**
 * Individual content box for the doctors CPT
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php if ( $wp_query->have_posts() ) : ?>
	<div class="section-doctors section-doctors-alt box-item">

		<?php
			for ( $count=0; have_posts(); $count++ ) : $wp_query->the_post();

			$open = !( $count%3 ) ? '<div class="row doctors-row">' : '';
			$close = !( $count%3 ) && $count ? '</div>' : '';
			echo $close . $open;
		 
			$pid = $post->ID;
			$wpl_toolskit_doctor_image = get_post_meta( $pid, 'wpl_toolskit_doctor_image', true);
			$wpl_toolskit_doctor_job_title = get_post_meta( $pid, 'wpl_toolskit_doctor_job_title', true);
			$wpl_toolskit_doctor_social_network = get_post_meta( $pid, 'wpl_toolskit_doctor_social_network', true);
		?>

		<div class="columns large-4 medium-4">
			<div class="doctor">
				<h5 class="doctor-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5><!-- /.doctor-name -->

				<div class="doctor-box">

					<?php if ( has_post_thumbnail() ) { ?>
						<div class="doctor-image">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('doctorthumb-image'); ?>
							</a>	
						</div><!-- /.event-image -->
					<?php } ?>

					<div class="doctor-body">
						<?php if( $wpl_toolskit_doctor_job_title != '' ) { ?>
							<h6><?php echo esc_html($wpl_toolskit_doctor_job_title); ?></h6>
						<?php } ?>

						<?php if( $wpl_toolskit_doctor_social_network != '' ) { ?>
							<div class="socials">
								<ul>
									<?php foreach ($wpl_toolskit_doctor_social_network as $social) { ?>
										<li>
											<a href="<?php echo esc_url($social['wpl_toolskit_doctor_social_network_url']); ?>">
												<i class="fa <?php echo esc_attr($social['wpl_toolskit_doctor_social_network_icon']); ?>"></i>
											</a>
										</li>
									<?php } ?>
								</ul>
							</div><!-- /.socials -->
						<?php } ?>

						<p><?php echo wplook_short_excerpt('30');?></p>

						<a href="<?php the_permalink(); ?>" class="link-more">
							<i class="fa fa-plus"></i>
							<?php _e('Find out more', 'healthmedical-wpl'); ?>
						</a>
					</div><!-- /.doctor-body -->
				</div><!-- /.doctor-box -->
			</div><!-- /.doctor -->
		</div><!-- /.columns large-4 -->
		<?php endfor; wp_reset_postdata(); ?>
		<?php if( !$close ) { echo '</div>'; } ?>

		<div class="row">
			<?php wplook_pagination(); ?>
		</div><!-- /.row -->
	</div><!-- /.section-doctors -->
<?php else: ?>
	<?php get_template_part('content', 'none-doctors'); ?>
<?php endif; ?>
