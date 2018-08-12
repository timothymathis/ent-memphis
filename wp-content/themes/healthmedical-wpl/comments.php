<?php
/**
 * The comments template
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

	<?php if (post_password_required()) { ?>

		<section class="event section-event-comments">

			<div class="section-body event-body">
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'healthmedical-wpl' ); ?></p>
			</div><!-- /.section-body -->

		</section><!-- /.event -->

	<?php } elseif (have_comments()) { ?>

		<section class="event section-event-comments" itemscope itemtype="https://schema.org/UserComments">

			<div class="section-head event-date">
				<p><?php printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'healthmedical-wpl' ),	number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );	?></p>
			</div><!-- /.event-date -->
		
			
			<div class="section-body event-body">
				<ol class="comments">
					<?php wp_list_comments( array( 'callback' => 'wplook_comment' ) ); ?>
				</ol>

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through? ?>
				
					<nav id="nav-below">
						<div class="nav-previous fleft"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'healthmedical-wpl' ) ); ?></div>
						<div class="nav-next fright"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'healthmedical-wpl' ) ); ?></div>
						<div class="clear"></div>
					</nav> <!-- .navigation -->
				<?php } ?>

			</div><!-- /.section-body -->

		</section><!-- /.event -->

	<?php } elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) { ?>

		<section class="event section-event-comments">

			<div class="section-body event-body">
				<p><?php _e( 'Comments are closed here.', 'healthmedical-wpl' ); ?></p>
			</div><!-- /.section-body -->

		</section><!-- /.event -->

	<?php } ?>

	<?php if(comments_open()) { ?>

		<section class="event section-event-comments">

			<div class="section-body event-body">
				<?php wplook_comment_form(); ?>
			</div><!-- /.section-body -->

		</section><!-- /.event -->

	<?php } ?>
