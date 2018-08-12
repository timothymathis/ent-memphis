<?php
/**
 * @package    Activate the Health & Medical ToolsKit
 * @subpackage Install the Health & Medical Toolkit ToolsKit
 * @version    2.4.1
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'wpl_toolkit_plugin' );

function wpl_toolkit_plugin() {

	$plugins = array(

		array(
			'name'               => 'Health & Medical Toolkit Plugin', // The plugin name.
			'slug'               => 'medical-toolskit', // The plugin slug (typically the folder name).
			'source'                => get_template_directory() . '/inc/plugins/src/medical-toolskit.zip', // The plugin source
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
		),

	);

   
	$config = array(
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                       // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'healthmedical-wpl' ),
			'menu_title'                      => __( 'Install Plugins', 'healthmedical-wpl' ),
			'installing'                      => __( 'Installing Plugin: %s', 'healthmedical-wpl' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'healthmedical-wpl' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' , 'healthmedical-wpl'), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' , 'healthmedical-wpl'), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' , 'healthmedical-wpl'), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' , 'healthmedical-wpl'), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' , 'healthmedical-wpl'), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' , 'healthmedical-wpl'), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' , 'healthmedical-wpl'), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' , 'healthmedical-wpl'), // %1$s = plugin name(s).
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' , 'healthmedical-wpl'),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' , 'healthmedical-wpl'),
			'return'                          => __( 'Return to Required Plugins Installer', 'healthmedical-wpl' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'healthmedical-wpl' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %s', 'healthmedical-wpl' ), // %s = dashboard link.
			'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );

}
