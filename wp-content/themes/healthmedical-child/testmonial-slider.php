<div class="slider-testimonials">
						<div class="slider-clip">
							<ul class="slides">
								<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

								<?php  
									$pid = $post->ID;
									$wpl_toolskit_testimonial_referee_name = get_post_meta( $pid, 'wpl_toolskit_testimonial_referee_name', true);
									$wpl_toolskit_testimonial_referee_image = get_post_meta( $pid, 'wpl_toolskit_testimonial_referee_image', true);
									$wpl_toolskit_testimonial_company_name = get_post_meta( $pid, 'wpl_toolskit_testimonial_company_name', true);
									$wpl_toolskit_testimonial_company_url = get_post_meta( $pid, 'wpl_toolskit_testimonial_company_url', true);
								?>

									<li class="slide">
										<div class="slide-caption">
											<blockquote>
												<?php the_content(); ?>
											</blockquote>

											<div class="user">
												<div class="user-image">
													<img src="<?php echo esc_url($wpl_toolskit_testimonial_referee_image); ?>" width="82" height="82" alt="" />
												</div><!-- /.user-image -->

												<div class="user-meta">
													<h6><?php echo esc_attr($wpl_toolskit_testimonial_referee_name); ?>, <a href="<?php echo esc_url($wpl_toolskit_testimonial_company_name); ?>"><span><?php echo esc_attr($wpl_toolskit_testimonial_company_name); ?></span></a></h6>
												</div><!-- /.user-meta -->
											</div><!-- /.user -->
										</div><!-- /.slide-caption -->
									</li><!-- /.slide -->
								<?php endwhile; wp_reset_postdata(); ?>
							</ul><!-- /.slides -->
						</div><!-- /.slider-clip -->
					</div>