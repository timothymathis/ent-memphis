<?php
/**
 * Headerdata
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Include CSS
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'wplook_css_include' ) ) {

	function wplook_css_include() {

		/*-----------------------------------------------------------
			Load our main stylesheet
		-----------------------------------------------------------*/
		// Source: http://stackoverflow.com/a/11741586
		// IE <9 has a limit on CSS rules in a file, so we split the CSS
		// into two files using grunt-bless.
		// To still get the benefits of a single file elsewhere, we check
		// what browser is used and only load the fix on IE 6-9
		preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $browser_version);

		if( count($browser_version) < 2 ){
			preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $browser_version);
		}

		if ( count($browser_version) > 1 && $browser_version[1] >= 6 && $browser_version[1] <= 9 ){
			wp_enqueue_style( 'health-style-ie', get_template_directory_uri() . '/ie.css', array(), '2015-12-11', 'all' );
		} else {
			wp_enqueue_style( 'health-style', get_stylesheet_uri(), array(), '2015-12-11', 'all' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'wplook_css_include' );
}

/*-----------------------------------------------------------------------------------*/
/*	Include Java Scripts
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_scripts_include' ) ) {
	
	function wplook_scripts_include() {
		
		/*-----------------------------------------------------------
			Include jQuery
		-----------------------------------------------------------*/
		
		wp_enqueue_script('jquery');


		/*-----------------------------------------------------------
			Vendors
		-----------------------------------------------------------*/
		wp_enqueue_script( 'vendors', get_template_directory_uri().'/assets/javascripts/vendor.js', '', '', 'footer' );

		
		/*-----------------------------------------------------------
	    	Base custom scripts
	    -----------------------------------------------------------*/
		wp_enqueue_script( 'base', get_template_directory_uri().'/assets/javascripts/app.js', '', '', 'footer' );

		
		/*-----------------------------------------------------------
			Google Maps
		-----------------------------------------------------------*/
		wp_enqueue_script( 'gmaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp', '', '', 'footer' );


		/*-----------------------------------------------------------
			Comment Reply
		-----------------------------------------------------------*/

		if (!is_admin()){
			if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
			wp_enqueue_script( 'comment-reply' );
		}


		/*-----------------------------------------------------------
			jQuery UI Date Picker languages
		-----------------------------------------------------------*/

		if( function_exists( 'wpcf7_script_is' ) && wpcf7_script_is() ) {

			wp_enqueue_script( 'jquery-ui-datepicker-i18n', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/jquery-ui-i18n.min.js', array( 'jquery', 'jquery-ui-datepicker' ), '', 'footer' );

		}
		
	}
	add_action('wp_enqueue_scripts', 'wplook_scripts_include');
}


/*-----------------------------------------------------------------------------------*/
/*	Include admin styles and scripts
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_admin_include' ) ) {

	function wplook_admin_include() {

		// CSS styles
		wp_enqueue_style( 'wplook_admin_css', get_template_directory_uri() . '/assets/css/admin.css' );

		// JavaScript
		wp_enqueue_script( 'wplook_admin_js', get_template_directory_uri() . '/assets/javascripts/admin.js', array( 'jquery' ), '', true );

	}

	add_action( 'admin_enqueue_scripts', 'wplook_admin_include' );

}
