<?php
/**
 * The template file for image attachment pages
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php get_header(); ?>

	<div class="main grey">
		<?php if (ot_get_option('wpl_breadcrumbs_status') != 'off') : ?>
			<div class="row">
				<div class="columns large-12">
					<p class="breadcrumbs">
						<?php wplook_breadcrumbs(); ?>
					</p><!-- /.breadcrumbs -->
				</div><!-- /.columns large-12 -->
			</div><!-- /.row -->
		<?php else :?>
			<div class="divider-nobreadcrumbs"></div>
		<?php endif; ?>	

		<div class="row">

			<div class="columns large-8 medium-7">
				<div class="content">

					<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( array('event', 'article-single-event') ); ?> itemscope itemtype="https://schema.org/BlogPosting">

							<header class="event-date">
								<p><time class="post-date" datetime="<?php echo get_the_date( 'c' ) ?>" itemprop="datePublished"><?php wplook_get_date(); ?></time></p><!-- /.post-date -->
							</header>

							<div class="event-box">
								<div class="event-image">
									<?php

									$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
									foreach ( $attachments as $k => $attachment ) :
										if ( $attachment->ID == $post->ID )
											break;
									endforeach;

									// If there is more than 1 attachment in a gallery
									if ( count( $attachments ) > 1 ) :
										$k++;
										if ( isset( $attachments[ $k ] ) ) :
											// get the URL of the next image attachment
											$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
										else :
											// or get the URL of the first image attachment
											$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
										endif;
									else :
										// or, if there's only 1 image, get the URL of the image
										$next_attachment_url = wp_get_attachment_url();
									endif;
									?>
									<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php

									$attachment_size = apply_filters( 'morning_attachment_size', 'full' );
									echo wp_get_attachment_image( $post->ID, $attachment_size );
									?></a>

								</div><!-- /.post-image -->

								<div class="event-meta">
									<ul class="list-event-meta">
										<li>
											<i class="fa fa-user"></i>
											<?php the_author_posts_link(); ?>
										</li>
										
										<li>
											<i class="fa fa-expand"></i>
											<?php echo wp_get_attachment_metadata()['width'] . 'px x ' . wp_get_attachment_metadata()['height'] . 'px'; ?>
										</li>
										
										<li>
											<a href="<?php comments_link(); ?>" itemprop="url">
												<i class="fa fa-comment"></i>
												<?php comments_number( __('No comments', 'healthmedical-wpl'), __('1 comment', 'healthmedical-wpl'), __('% comments', 'healthmedical-wpl') ); ?>
											</a>
										</li>
										
										<li>
											<a href="#" class="link" itemprop="url">
												<i class="fa fa-plus"></i>
												<a href="<?php the_permalink(); ?>"><?php _e('Permalink', 'healthmedical-wpl'); ?></a>
											</a>
										</li>
									</ul>
								</div><!-- /.event-meta -->

								<div class="event-body" itemprop="articleBody">
									<h4>
										<a href="<?php the_permalink(); ?>" itemprop="url"><?php the_title(); ?></a>
									</h4>

									<?php the_content(); ?>

									<?php
										$metadata = wp_get_attachment_metadata();

										printf( __( 'Return to <a href="%1$s" title="Return to %2$s" rel="gallery">%3$s</a>', 'healthmedical-wpl' ),
											esc_url( get_permalink( $post->post_parent ) ),
											esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
											get_the_title( $post->post_parent )
										);
									?>

									<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'healthmedical-wpl' ), 'after' => '</div>' ) ); ?>
								
								</div><!-- /.event-body -->
							</div><!-- /.event-box -->
						</article><!-- /.event -->

						<?php if( previous_image_link() || next_image_link() ) { ?>
							<nav class="event section-event-nav">
								<?php if( previous_image_link() ) { ?>
									<div class="event-nav-previous">
										<?php previous_image_link( false, __( '<i class="fa fa-angle-left"></i> Previous image', 'healthmedical-wpl' ) ); ?>
									</div><!-- /.event-nav-prev -->
								<?php } ?>
								
								<?php if( next_image_link() ) { ?>
									<div class="event-nav-next">
										<?php next_image_link( false, __( 'Next Image <i class="fa fa-angle-right"></i>', 'healthmedical-wpl' ) ); ?>
									</div><!-- /.event-nav-next -->
								<?php } ?>
							</nav><!-- /.image-nav -->
						<?php } ?>

						<?php comments_template(); ?>

					<?php endwhile; // end of the loop. ?>
				</div><!-- /.content -->

				<?php wplook_pagination() ?>

			</div><!-- /.columns large-12 -->
			
		<?php get_sidebar(); ?>
		</div><!-- /.row -->

		<?php get_template_part( 'inc', 'booknow' ); ?>
	</div><!-- /.main -->

<?php get_footer(); ?>
