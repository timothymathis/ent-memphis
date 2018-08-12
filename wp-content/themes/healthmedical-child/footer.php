<?php

/**

 * The footer template

 *

 * @package WordPress

 * @subpackage Health & Medical

 * @since Health & Medical 1.0.0

 */

?>

	<div class="footer">

		<div class="row">

				<!-- First Widget area -->

				<?php if ( is_active_sidebar( 'f1-widgets' ) ) : ?>

					<?php dynamic_sidebar( 'f1-widgets' ); ?>

				<?php endif; ?>

			

				<!-- Second Widget area -->

				<?php if ( is_active_sidebar( 'f2-widgets' ) ) : ?>

					<?php dynamic_sidebar( 'f2-widgets' ); ?>

				<?php endif; ?>

		

				<!-- Third Widget area -->

				<?php if ( is_active_sidebar( 'f3-widgets' ) ) : ?>

					<?php dynamic_sidebar( 'f3-widgets' ); ?>

				<?php endif; ?>



				<!-- Fourth Widget area -->

				<?php if ( is_active_sidebar( 'f4-widgets' ) ) : ?>

					<?php dynamic_sidebar( 'f4-widgets' ); ?>

				<?php endif; ?>

		</div><!-- /.row -->



		<div class="row">

			<p class="copyright">

				<?php if ( ot_get_option('wpl_copyright') != "") { ?>

					<?php echo esc_html(ot_get_option('wpl_copyright')); ?>

				<?php } ?>

				

				<?php _e('Created by', 'eBiz Solutions'); ?> <a href="thinkebiz.net" title="eBiz Solutions" target="_blank">eBiz Solutions

</a>



			</p><!-- /.copyright -->

		</div><!-- /.row -->

	</div><!-- /.footer -->	

</div><!-- /.wrapper -->

    

<?php wp_footer(); ?>
<script type="text/javascript">
	jQuery('.en').hide();
	jQuery('.en, .es').on('click',
	  function() 
   {
	   jQuery('.en, .es').toggle()
   }
   );
</script>


</body>

</html>

