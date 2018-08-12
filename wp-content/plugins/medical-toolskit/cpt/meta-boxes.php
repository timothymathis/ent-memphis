<?php
/**
 * The default Meta Box Settings
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Initialize the meta boxes. 
/*-----------------------------------------------------------------------------------*/

add_action( 'admin_init', 'wpl_meta_boxes' );

function wpl_meta_boxes() {
	
	/*-----------------------------------------------------------
		Custom meta box for pages and the contact template
	-----------------------------------------------------------*/
	
	$page_meta_box = array(
		'id'          => 'page_meta_box',
		'title'       => __('Post/Page Options', 'medical-toolskit'),
		'desc'        => '',
		'pages'       => array( 'page', 'post', WPL_TOOLSKIT_SLUG_SHORT . 'post_doctors', WPL_TOOLSKIT_SLUG_SHORT . 'post_services' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'label'       => __('Display header image', 'medical-toolskit'),
				'id'          => 'wpl_header_image_display',
				'type'        => 'on-off',
				'desc'        => __('If disabled, the header image area will fall back to a purple background', 'medical-toolskit'),
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => '',
			),

			array(
				'label'       => __('Header image', 'medical-toolskit'),
				'id'          => 'wpl_header_image',
				'type'        => 'upload',
				'desc'        => __('The image will be displayed in the header of the page, recommended dimensions: (1920 x 1080)', 'medical-toolskit'),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => '',
				'condition'   => 'wpl_header_image_display:is(on)'
			),

			array(
				'label'       => __('Sidebar Position', 'medical-toolskit'),
				'id'          => 'wpl_sidebar_position',
				'type'        => 'select',
				'desc'        => __('Select the sidebar position. Chose No Sidebar for Full width page.',  'medical-toolskit'),
				'choices'     => array(
					array(
						'label'       => 'Left',
						'value'       => 'left'
					),
					array(
						'label'       => 'Right',
						'value'       => 'right'
					),
					array(
						'label'       => 'No Sidebar',
						'value'       => 'disable'
					),
				),        
				'std'         => 'none',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => __('Select Sidebar', 'medical-toolskit'),
				'id'          => 'wpl_sidebar_select',
				'type'        => 'sidebar-select',
				'desc'        => __('Select a Sidebar', 'medical-toolskit'),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),
		)
	);
	
	$post_id = (isset($_GET['post'])) ? $_GET['post'] : ((isset($_POST['post_ID'])) ? $_POST['post_ID'] : false);

	if ($post_id) {
		$post_template = get_post_meta($post_id, '_wp_page_template', true);
		$post_type = get_post_type( $post_id );
		
		if ($post_template == 'default' || $post_template == 'template-contact.php' || $post_type == 'wpl_post_doctors' || $post_type == 'wpl_post_services') {
			ot_register_meta_box( $page_meta_box );
		}
	}


	/*-----------------------------------------------------------
  		Home Page Template
  	-----------------------------------------------------------*/
	
	$page_meta_box = array(
		'id'          => 'page_meta_box',
		'title'       => __('Page Options', 'medical-toolskit'),
		'desc'        => '',
		'pages'       => array( 'page' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
					'label'       => __('Home Page Template',  'medical-toolskit'),
					'id'          => 'homepage-template-message',
					'type'        => 'textblock-titled',
					'desc'        => __('This is the Home Page template. Please go to Appearance → Widgets and add Widgets to home page widget area to create your ideal home page.<br><br>If you just started using this theme, you do not need to use this page template but simply set any page as your Front Page in Settings → Reading and add widgets as described above.',  'medical-toolskit'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'welcome_settings'
				),
		)
	);

	$post_id = (isset($_GET['post'])) ? $_GET['post'] : ((isset($_POST['post_ID'])) ? $_POST['post_ID'] : false);

	if ($post_id) : 
		$post_template = get_post_meta($post_id, '_wp_page_template', true);
	
	if ($post_template == 'template-homepage.php') 
		ot_register_meta_box($page_meta_box);
	endif;


	/*-----------------------------------------------------------
		Custom meta box for doctors, services, testimonial
		listing pages and the departments CPT
	-----------------------------------------------------------*/
	
	$page_template_meta_box = array(
		'id'          => 'page_template_meta_box',
		'title'       => __('Page Options', 'medical-toolskit'),
		'desc'        => '',
		'pages'       => array( 'page', WPL_TOOLSKIT_SLUG_SHORT . 'post_departments' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'label'       => __('Display header image', 'medical-toolskit'),
				'id'          => 'wpl_header_image_display',
				'type'        => 'on-off',
				'desc'        => __('If disabled, the header image area will fall back to a purple background', 'medical-toolskit'),
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => '',
			),
			array(
				'label'       => __('Header image', 'medical-toolskit'),
				'id'          => 'wpl_header_image',
				'type'        => 'upload',
				'desc'        => __('The image will be displayed in the header of the page. Recommended dimensions: 2500px x 1667px', 'medical-toolskit'),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => '',
				'condition'   => 'wpl_header_image_display:is(on)',
			),
		)
	);

	$post_id = (isset($_GET['post'])) ? $_GET['post'] : ((isset($_POST['post_ID'])) ? $_POST['post_ID'] : false);

	if ($post_id) {
		$post_template = get_post_meta($post_id, '_wp_page_template', true);

		if ($post_template == 'template-doctors.php' || $post_template == 'template-services.php' || $post_template == 'template-testimonials.php' || $post_template == 'template-departments.php' || $post_type == 'wpl_post_departments' ) {
			ot_register_meta_box( $page_template_meta_box );
		}
	}


	/*-----------------------------------------------------------
  		Custom meta box for contact page
  	-----------------------------------------------------------*/

	$contact_page_meta_box = array(
		'id'          => 'contact_page_meta_box',
		'title'       => __('Contact Page Options',  'medical-toolskit'),
		'desc'        => '',
		'pages'       => array( 'page' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'label'       => __( 'Display map', 'medical-toolskit' ),
				'id'          => 'wpl_contact_map',
				'type'        => 'on-off',
				'desc'        => __( 'Display a map on the contact page', 'medical-toolskit' ),
				'std'         => 'off',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
			),
			array(
				'label'       => __('Address to be shown on map', 'medical-toolskit'),
				'id'          => 'wpl_contact_map_address',
				'type'        => 'text',
				'desc'        => __('Enter the address which is to be shown on the map.',  'medical-toolskit'),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'condition'   => 'wpl_contact_map:is(on)',
			),
		)
	);
	if ($post_id) : 
		$post_template = get_post_meta($post_id, '_wp_page_template', true);
	
	if ($post_template == 'template-contact.php') 
		ot_register_meta_box($contact_page_meta_box);
	endif;
}
