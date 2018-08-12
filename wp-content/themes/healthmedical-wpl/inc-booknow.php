<?php
/**
 * The 'book now' advert template part
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php if ( ot_get_option('wpl_booknow') == "on") { ?>

	<div class="row">
		<div class="columns large-12">
			<div class="ad">
				<div class="ad-image mobile-hidden">
					<?php if( ot_get_option('wpl_booknow_image') ) { ?>
						<img src="<?php echo ot_get_option('wpl_booknow_image'); ?>" alt="" />
					<?php } ?>
				</div><!-- /.ad-image -->

				<header class="ad-head">
					<?php if ( ot_get_option('wpl_booknow_title') ){ echo '<h3>' . esc_html(ot_get_option('wpl_booknow_title')) . '</h3>'; } ?>

					<?php if ( ot_get_option('wpl_booknow_subtitle') ){ echo '<p>' . esc_html(ot_get_option('wpl_booknow_subtitle')) . '</p>'; } ?>
				</header><!-- /.ad-head -->

				<?php if ( ot_get_option('wpl_booknow_page') != "") { ?>
					<div class="ad-actions">
						<a href="<?php echo get_permalink(ot_get_option('wpl_booknow_page')); ?>" class="button btn-white btn-small">
							<?php
								$wpl_booknow_button_text = ot_get_option( 'wpl_booknow_button_text' );
								if( !empty( $wpl_booknow_button_text ) ) {
									echo $wpl_booknow_button_text;
								} else {
									_e('Book Now','healthmedical-wpl');
								}
							?>
						</a>
					</div><!-- /.ad-actions -->
				<?php } ?>

				<?php if ( ot_get_option('wpl_phone_number') != "") { ?>
					<div class="ad-contacts">
						<div class="phone">
							<i class="fa fa-mobile"></i>
							<small><?php _e('Call Us', 'healthmedical-wpl'); ?></small>
							<a href="tel:<?php echo esc_attr(ot_get_option('wpl_phone_number')); ?>"><?php echo esc_attr(ot_get_option('wpl_phone_number')); ?></a>
						</div><!-- /.phone -->
					</div><!-- /.ad-contacts -->
				<?php } ?>
			</div><!-- /.ad -->
		</div>
	</div><!-- /.row -->

<?php } ?>
