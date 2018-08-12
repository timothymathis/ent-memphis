<?php
/**
 * Page sidebar template
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php  
	$pid = $post->ID;
	$sidebar_position = get_post_meta( $pid, 'wpl_sidebar_position', true);
?>

<?php if ( $sidebar_position != 'disable') { ?>
	<div class="columns large-4 medium-5">
		<div class="sidebar">
			<div class="widgets">

				<?php if ( is_single() || is_page() ) {

					$pid = $post->ID;
					$wpl_sidebar_select = get_post_meta( $pid, 'wpl_sidebar_select', true);

					if ( $wpl_sidebar_select == '' ) {
						$wpl_sidebar_select = 'page-1';
					} ?>
					
					<?php if ( ! dynamic_sidebar( $wpl_sidebar_select ) ) : ?>
					<?php endif; // end sidebar widget area ?>
				<?php } else { ?>
					<?php if ( ! dynamic_sidebar( 'page-1' ) ) : ?>
					<?php endif; // end sidebar widget area ?>
				<?php } ?>

			</div><!-- /.widgets -->
		</div><!-- /.sidebar -->
	</div><!-- /.columns large-4 -->
<?php } ?>
