<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */

/*-----------------------------------------------------------------------------------*/
/*	Content Width
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/*-----------------------------------------------------------------------------------*/
/*	Include Option Tree
/*-----------------------------------------------------------------------------------*/

	/*-----------------------------------------------------------
		Optional: set 'ot_show_pages' filter to false.
		This will hide the settings & documentation pages.
	-----------------------------------------------------------*/

	add_filter( 'ot_show_pages', '__return_true' );


	/*-----------------------------------------------------------
		Optional: set 'ot_show_new_layout' filter to false.
		This will hide the "New Layout" section on the Theme Options page.
	-----------------------------------------------------------*/

	add_filter( 'ot_show_new_layout', '__return_false' );


	/*-----------------------------------------------------------
		Required: set 'ot_theme_mode' filter to true.
	-----------------------------------------------------------*/

	add_filter( 'ot_theme_mode', '__return_true' );


	/*-----------------------------------------------------------
		Required: include OptionTree.
	-----------------------------------------------------------*/

	include_once( get_template_directory() . '/option-tree/ot-loader.php' );
	include_once( get_template_directory() . '/inc/theme-options.php' );


/*-----------------------------------------------------------------------------------*/
/*	Theme setup
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_setup' ) ) {

	function wplook_setup() {

		/*-----------------------------------------------------------
			Enable support for Title Tag
		-----------------------------------------------------------*/

		add_theme_support( "title-tag" );
		
		/*-----------------------------------------------------------
			Make theme available for translation
		-----------------------------------------------------------*/

		load_theme_textdomain( 'healthmedical-wpl', get_template_directory() . '/languages' );


		/*-----------------------------------------------------------
			Theme style for the visual editor
		-----------------------------------------------------------*/
		
		add_editor_style( 'assets/css/editor-style.css' );

		/*-----------------------------------------------------------
			Add default posts and comments RSS feed links to head
		-----------------------------------------------------------*/
		
		add_theme_support( 'automatic-feed-links' );

		/*-----------------------------------------------------------
			Add support for custom post formats
		-----------------------------------------------------------*/

		add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'audio') );


		/*-----------------------------------------------------------
			Enable support for Post Thumbnails on posts and pages
		-----------------------------------------------------------*/
		
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'featured-image', 1280, 800, true );
		add_image_size( 'bignews-image', 1200, 670, true );
		add_image_size( 'doctorthumb-image', 640, 440, true );

		
		/*-----------------------------------------------------------
			Register menu
		-----------------------------------------------------------*/
		
		function healthmedical_register_menus() {
			register_nav_menus(
				array(
					'primary' => __( 'Main Menu', 'healthmedical-wpl' ),
				) 
			);
		}

		add_action( 'init', 'healthmedical_register_menus' );
		wp_create_nav_menu( 'Main Menu', array( 'slug' => 'primary' ) );
		

		/*-----------------------------------------------------------
			Add theme Support Custom Background
		-----------------------------------------------------------*/
		
		add_theme_support( 'custom-background' );


		/*-----------------------------------------------------------
			Add theme Support  Custom Header
		-----------------------------------------------------------*/
		
		add_theme_support( 'custom-header' );

	}
} // wplook_setup
add_action( 'after_setup_theme', 'wplook_setup' );


/*-----------------------------------------------------------------------------------*/
/*	Include Theme specific functionality
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_initiate_files' ) ) {

	function wplook_initiate_files() {

		// Initiate all widgets
		include_once( get_template_directory() . '/inc/widgets/widget-init.php' );

		// Include header data
		include_once( get_template_directory() . '/inc/headerdata.php' );

		// Include other functions
		include_once( get_template_directory() . '/inc/library.php' );
		
		// Initiate Custom Plugins to be installed
		include_once( get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php' );
		include_once( get_template_directory() . '/inc/plugins/medical-toolkit.php' );
		include_once( get_template_directory() . '/inc/plugins/woocommerce.php' );
		include_once( get_template_directory() . '/inc/plugins/wie.php' );
		include_once( get_template_directory() . '/inc/plugins/cf7.php' );

		// Include Comments
		require_once ( get_template_directory() . '/inc/' . 'comment.php' );

	}
	add_action( 'after_setup_theme', 'wplook_initiate_files' );
}


/*-----------------------------------------------------------------------------------*/
/*	Include the theme updater
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_load_updater' ) ) {

	function wplook_load_updater() {
		include_once ( get_template_directory() . '/inc/update.php' );
	}

	add_action( 'wp_loaded', 'wplook_load_updater' );

}

/*-----------------------------------------------------------------------------------*/
/*	Include WooCommerce Functions
/*-----------------------------------------------------------------------------------*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(is_plugin_active( 'woocommerce/woocommerce.php')) {
	include_once( get_template_directory() . '/inc/woo-settings.php' );
}

/*-----------------------------------------------------------------------------------*/
/*	Redirect After the theme is activated
/*-----------------------------------------------------------------------------------*/

/*if ( ! function_exists( 'wplook_redirect_after_theme_activation' ) ) {

	function wplook_redirect_after_theme_activation (){
		$redirectTo = admin_url().'themes.php?page=ot-theme-options';
		wp_redirect($redirectTo);
	}

	add_action("after_switch_theme", "wplook_redirect_after_theme_activation");

}*/


/*-----------------------------------------------------------------------------------*/
/*	Flush Rewrite after the theme is activated
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_rewrite_flush' ) ) {

	function wplook_rewrite_flush() {
		flush_rewrite_rules();
	}

	add_action( 'after_switch_theme', 'wplook_rewrite_flush' );

}


/*-----------------------------------------------------------------------------------*/
/*	Custom Background
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'custom-background', 
	apply_filters( 'wplook_custom_background_args', 
		array(
			'default-color'          => 'f0f4f7',
			'default-image'          => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		)
	)
);


/*-----------------------------------------------------------
	Custom Header
-----------------------------------------------------------*/

$wplook_custom_header = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => '1920',
	'height'                 => '700',
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => 'ffffff',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'		=> 'wplook_header_style',
	'admin-head-callback'	=> 'wplook_admin_header_style',
	'admin-preview-callback'=> 'wplook_admin_header_image',
);
add_theme_support( 'custom-header', $wplook_custom_header );


/*-----------------------------------------------------------*/
/*	Styles the header image and text displayed on the blog
/*-----------------------------------------------------------*/



if ( ! function_exists( 'wplook_header_style' ) ) {

	function wplook_header_style() {

		// If no custom options for text are set, let's bail
		// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
		if ( HEADER_TEXTCOLOR == get_header_textcolor() )
			return;
		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
			<?php // Has the text been hidden?
				if ( 'blank' == get_header_textcolor() ) { ?>
					#site-title{ position: absolute !important; clip: rect(1px 1px 1px 1px); /* IE6, IE7 */ clip: rect(1px, 1px, 1px, 1px); }
				<?php // If the user has set a custom color for the text use that
				} else { ?>
					#site-title a, #site-description { color: #<?php echo get_header_textcolor(); ?> !important; }
			<?php } ?>
		</style>
		<?php
	}
} // wplook_header_style

/*-----------------------------------------------------------*/
/*	Styles the header image displayed on the Appearance > Header admin panel.
/*	Referenced via add_custom_image_header() in wplook_setup().
/*-----------------------------------------------------------*/


if ( ! function_exists( 'wplook_admin_header_style' ) ) {
	
	function wplook_admin_header_style() { ?>
		<style type="text/css">
			
			#site-title a { font-size: 32px; line-height: 36px; text-decoration: none; }
			#site-description { font-size: 14px; line-height: 23px; padding: 0 0 3em; }

			<?php // If the user has set a custom color for the text use that
			if ( get_header_textcolor() != HEADER_TEXTCOLOR ) { ?>
				#site-title a, #site-description { color: #<?php echo get_header_textcolor(); ?>; }
			<?php } ?>
			#headimg img { max-width: 1000px; height: auto; width: 100%; }
		</style>
		<?php
	}

} // wplook_admin_header_style



/*-----------------------------------------------------------*/
/*	Custom header image markup displayed on the Appearance > Header admin panel.
/*	Referenced via add_custom_image_header() in wplook_setup().
/*-----------------------------------------------------------*/


if ( ! function_exists( 'wplook_admin_header_image' ) ) {
	
	function wplook_admin_header_image() { ?>
		<div id="headimg">
			<?php
			if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
				$style = ' style="display:none;"';
			else
				$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
			?>
			<h1><a id="name"<?php echo esc_html($style); ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<div id="desc"<?php echo esc_html($style); ?>><?php bloginfo( 'description' ); ?></div>
			<?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) : ?>
				<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
			<?php endif; ?>
		</div>
	<?php 
	}

} // wplook_admin_header_image

/*-----------------------------------------------------------*/
/*	Enable Contact Form 7 datepicker
/*-----------------------------------------------------------*/

add_filter( 'wpcf7_support_html5_fallback', '__return_true' );





?>
