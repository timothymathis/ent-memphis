<?php
/**
 * Search form template
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<input type="search" class="search-field" name="s" id="s" placeholder="<?php _e('Search for...', 'healthmedical-wpl'); ?>" /><!-- 
		 --><button type="submit" class="search-btn"><span><i class="fa fa-search"></i></span></button>
	</div>
</form>
