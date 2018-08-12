<?php
/*
Plugin Name: Health & Medical Toolkit
Plugin URI: https://wplook.com/
Description: Health & Medical Toolkit for Health & Medical WordPress Theme.
Version: 1.0.5
Text Domain: medical-toolskit
Author: WPlook Studio
Author URI: https://wplook.com/
*/

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Main Class - Maintenance
 *
 * @since 1.0.0
 */
class Medical_Toolskit {

	/**
	* Constructor
	*
	* Add actions for methods that define constants, load translation and load includes.
	*
	* @since 1.0.0
	* @access public
	*/
	public function __construct() {

		// Define constants
		add_action( 'plugins_loaded', array( &$this, 'wpl_toolskit_define_constants' ), 1 );

		// Load language file
		add_action( 'plugins_loaded', array( &$this, 'wpl_toolskit_load_textdomain' ), 2 );

		add_action( 'after_setup_theme', array( &$this, 'wpl_toolskit_includes'), 3 );

		add_action( 'after_setup_theme', array( &$this, 'wpl_toolskit_instances'), 4 );
		
		// Add Setings Link
		add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), array( &$this, 'wpl_toolskit_links' ), 1 );

	}


	/**
	* Defines constants used by the plugin.
	*
	* @since 1.0.0
	* @access public
	*/
	public function wpl_toolskit_define_constants() {

		define( 'WPL_TOOLSKIT_NAME', "Medical ToolsKit" );

		define( 'WPL_TOOLSKIT_VERSION', "1.0.0" );

		define( 'WPL_TOOLSKIT_SLUG', "wpl_toolskit_" );

		define( 'WPL_TOOLSKIT_SLUG_SHORT', "wpl_" );
		
		/* Set constant URI */
		define( 'WPL_TOOLSKIT_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		/* Set constant path to the plugin directory. */
		define( 'WPL_TOOLSKIT_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		// Call custom post types
		define( 'WPL_TOOLSKIT_DOCTOR', true) ;
		define( 'WPL_TOOLSKIT_DEPARTMENTS', true );
		define( 'WPL_TOOLSKIT_TESTIMONIAL', true );
		define( 'WPL_TOOLSKIT_SLIDER', true );
		define( 'WPL_TOOLSKIT_SERVICES', true );
	}


	/**
	* Include all files
	* 
 	* @since 1.0.0
	* @access public
	*/
	public function wpl_toolskit_includes() {

		require_once( WPL_TOOLSKIT_DIR . 'cpt/doctors.php' );
		require_once( WPL_TOOLSKIT_DIR . 'cpt/testimonials.php' );
		require_once( WPL_TOOLSKIT_DIR . 'cpt/departments.php' );
		require_once( WPL_TOOLSKIT_DIR . 'cpt/slider.php' );
		require_once( WPL_TOOLSKIT_DIR . 'cpt/services.php' ); 
		require_once( WPL_TOOLSKIT_DIR . 'cpt/meta-boxes.php' );
		require_once( WPL_TOOLSKIT_DIR . 'shortcode/shortcodes.php' );

	}
	

	public function wpl_toolskit_instances () {

		if ( defined( 'WPL_TOOLSKIT_DOCTOR' ) && WPL_TOOLSKIT_DOCTOR ) {
			new Wpl_Toolskit_Doctor();
		}

		if ( defined( 'WPL_TOOLSKIT_DEPARTMENTS' ) && WPL_TOOLSKIT_DEPARTMENTS ) {
			new Wpl_Toolskit_Departments();
		}

		if ( defined( 'WPL_TOOLSKIT_TESTIMONIAL' ) && WPL_TOOLSKIT_TESTIMONIAL ) {
			new Wpl_Toolskit_Testimonial();
		}

		if ( defined( 'WPL_TOOLSKIT_SLIDER' ) && WPL_TOOLSKIT_SLIDER ) {
			new Wpl_Toolskit_Slider();
		}

		if ( defined( 'WPL_TOOLSKIT_SERVICES' ) && WPL_TOOLSKIT_SERVICES ) {
			new Wpl_Toolskit_Services();
		}

		if ( defined( 'WPL_TOOLSKIT_SHORTCODE' ) && WPL_TOOLSKIT_SHORTCODE && defined( 'WPL_TOOLSKIT_SHORTCODE_FW' )) {
			require_once( WPL_TOOLSKIT_DIR . 'shortcode/shortcode.php' );
			new Swp_Toolskit_Shortcode( WPL_TOOLSKIT_SHORTCODE_FW );
		}

	}


	/**
	* Load language file
	*
	* This will load the MO file for the current locale.
	* The translation file must be named swp-maintenance-$locale.mo.
	*
	* @since 1.0.0
	* @access public
	*/
	public function wpl_toolskit_load_textdomain() {
		load_plugin_textdomain( 'medical-toolskit', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );	
	}


	/**
	 * Create notice if plugin is active
	 * 
	 * @since 1.0.0
	 * @access  public
	 */
	public function swp_toolskit_admin_notice() {
		
		if ( !Medical_Toolskit::wpl_toolskit_ot_active() )  {
			$html =  '<div class="update-nag">';
			$html .= sprintf(__('You need to Install and Activate the Option Tree Plugin', 'medical-toolskit'), admin_url('options-general.php?page='));
			$html .=  '</div>';
			echo $html;
		}
	}


	/**
	* Add settings links to plugin page
	* 
	* @since 1.0.0
	* @access  public
	*/
	public function wpl_toolskit_links( $links ) {
		$links[] = '<a href="https://wplook.com/help/?utm_source=Plugins&utm_medium=Support_wp-admin&utm_campaign='.str_replace(" ", "", WPL_TOOLSKIT_NAME).'" target="_blank">'.__("Support", 'medical-toolskit').'</a>';
		return $links;
	}


	/**
	 * Verify if Option Tree plugin is active
	 * @return: boolean
	 *
	 * @since 1.0.0
	 * @access  public
	 */
	static function wpl_toolskit_ot_active() {
		//if ( is_plugin_active( 'option-tree/ot-loader.php' ) ) {
			return true;
		//}
	}

}

// Instantiate the main class
 new Medical_Toolskit();
?>
