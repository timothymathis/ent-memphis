<?php
/**
 * WooCommerce Custom Functions
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly




/*-----------------------------------------------------------------------------------*/
/*	Initiate WooCommerce
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'woocommerce' );


/*-----------------------------------------------------------------------------------*/
/*	WooCommerce Shop Title
/*-----------------------------------------------------------------------------------*/

add_filter( 'woocommerce_page_title', 'woo_shop_page_title');

function woo_shop_page_title( $page_title ) {

    if( 'Shop' == $page_title) {
        return "";
    } else {
    	return $page_title;
    }
}



/*-----------------------------------------------------------------------------------*/
/*	Change number or products per row to 3
/*-----------------------------------------------------------------------------------*/

if (!function_exists('loop_columns')) {
	
	function loop_columns() {
		return 3; // 3 products per row
	}
	
}
add_filter('loop_shop_columns', 'loop_columns');


/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 6;
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {

	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}

?>