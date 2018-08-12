<?php
/**
 * The default Theme Options
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Initialize the options before anything else. 
/*-----------------------------------------------------------------------------------*/

add_action( 'admin_init', 'wplook_theme_options', 1 );

/*-----------------------------------------------------------------------------------*/
/*	Build the custom settings & update OptionTree.
/*-----------------------------------------------------------------------------------*/
if (!function_exists('wplook_theme_options')) {
	
	function wplook_theme_options() {

		/*-----------------------------------------------------------------------------------*/
		/*	Define a list of icons to be reused later on
		/*-----------------------------------------------------------------------------------*/

		$medical_icons = array(
			'icon-medical-ambulance' => __( 'Ambulance', 'medical-toolskit' ),
			'icon-medical-asclepius-sign' => __( 'Asclepius sign', 'medical-toolskit' ),
			'icon-medical-bacterium-cells' => __( 'Bacterium cells', 'medical-toolskit' ),
			'icon-medical-badge' => __( 'Badge', 'medical-toolskit' ),
			'icon-medical-biohazard-sign' => __( 'Biohazard sign', 'medical-toolskit' ),
			'icon-medical-bladder' => __( 'Bladder', 'medical-toolskit' ),
			'icon-medical-blood-pressure-kit' => __( 'Blood pressure kit', 'medical-toolskit' ),
			'icon-medical-body-scales' => __( 'Body scales', 'medical-toolskit' ),
			'icon-medical-bone-joint' => __( 'Bone joint', 'medical-toolskit' ),
			'icon-medical-brain' => __( 'Brain', 'medical-toolskit' ),
			'icon-medical-broken-pill' => __( 'Broken pill', 'medical-toolskit' ),
			'icon-medical-bulb-full' => __( 'Bulb full', 'medical-toolskit' ),
			'icon-medical-bulb-reaction' => __( 'Bulb reaction', 'medical-toolskit' ),
			'icon-medical-bulb' => __( 'Bulb', 'medical-toolskit' ),
			'icon-medical-cell' => __( 'Cell', 'medical-toolskit' ),
			'icon-medical-chromosome' => __( 'Chromosome', 'medical-toolskit' ),
			'icon-medical-clinical-record' => __( 'Clinical record', 'medical-toolskit' ),
			'icon-medical-clyster' => __( 'Clyster', 'medical-toolskit' ),
			'icon-medical-cross' => __( 'Cross', 'medical-toolskit' ),
			'icon-medical-crutches' => __( 'Crutches', 'medical-toolskit' ),
			'icon-medical-disabled' => __( 'Disabled', 'medical-toolskit' ),
			'icon-medical-dna' => __( 'Dna', 'medical-toolskit' ),
			'icon-medical-doctor' => __( 'Doctor', 'medical-toolskit' ),
			'icon-medical-drop-counter' => __( 'Drop counter', 'medical-toolskit' ),
			'icon-medical-drop' => __( 'Drop', 'medical-toolskit' ),
			'icon-medical-dropper' => __( 'Dropper', 'medical-toolskit' ),
			'icon-medical-drug-blister' => __( 'Drug blister', 'medical-toolskit' ),
			'icon-medical-drug-bottle' => __( 'Drug bottle', 'medical-toolskit' ),
			'icon-medical-drugs' => __( 'Drugs', 'medical-toolskit' ),
			'icon-medical-ear' => __( 'Ear', 'medical-toolskit' ),
			'icon-medical-emergency-call' => __( 'Emergency call', 'medical-toolskit' ),
			'icon-medical-emergency-cross' => __( 'Emergency cross', 'medical-toolskit' ),
			'icon-medical-empty-test-tube' => __( 'Empty test tube', 'medical-toolskit' ),
			'icon-medical-eye-drop' => __( 'Eye drop', 'medical-toolskit' ),
			'icon-medical-eye-sign' => __( 'Eye sign', 'medical-toolskit' ),
			'icon-medical-eyeball' => __( 'Eyeball', 'medical-toolskit' ),
			'icon-medical-facial-plastic-surgery-2' => __( 'Facial plastic surgery 2', 'medical-toolskit' ),
			'icon-medical-facial-plastic-surgery' => __( 'Facial plastic surgery', 'medical-toolskit' ),
			'icon-medical-female-sign' => __( 'Female sign', 'medical-toolskit' ),
			'icon-medical-fertilization' => __( 'Fertilization', 'medical-toolskit' ),
			'icon-medical-footsteps' => __( 'Footsteps', 'medical-toolskit' ),
			'icon-medical-full-test-tube' => __( 'Full test tube', 'medical-toolskit' ),
			'icon-medical-fungus-cells' => __( 'Fungus cells', 'medical-toolskit' ),
			'icon-medical-glasses' => __( 'Glasses', 'medical-toolskit' ),
			'icon-medical-hand-with-patch' => __( 'Hand with patch', 'medical-toolskit' ),
			'icon-medical-heart-attack' => __( 'Heart attack', 'medical-toolskit' ),
			'icon-medical-heart-checklist' => __( 'Heart checklist', 'medical-toolskit' ),
			'icon-medical-heart-sign' => __( 'Heart sign', 'medical-toolskit' ),
			'icon-medical-heart' => __( 'Heart', 'medical-toolskit' ),
			'icon-medical-helicopter' => __( 'Helicopter', 'medical-toolskit' ),
			'icon-medical-help' => __( 'Help', 'medical-toolskit' ),
			'icon-medical-hospital-bed' => __( 'Hospital bed', 'medical-toolskit' ),
			'icon-medical-hospital-sign' => __( 'Hospital sign', 'medical-toolskit' ),
			'icon-medical-hospital' => __( 'Hospital', 'medical-toolskit' ),
			'icon-medical-intestines' => __( 'Intestines', 'medical-toolskit' ),
			'icon-medical-kidneys' => __( 'Kidneys', 'medical-toolskit' ),
			'icon-medical-liver' => __( 'Liver', 'medical-toolskit' ),
			'icon-medical-lungs' => __( 'Lungs', 'medical-toolskit' ),
			'icon-medical-magnifying-glass' => __( 'Magnifying glass', 'medical-toolskit' ),
			'icon-medical-male-sign' => __( 'Male sign', 'medical-toolskit' ),
			'icon-medical-medic' => __( 'Medic', 'medical-toolskit' ),
			'icon-medical-medical-alert' => __( 'Medical alert', 'medical-toolskit' ),
			'icon-medical-medical-checklist' => __( 'Medical checklist', 'medical-toolskit' ),
			'icon-medical-medicine-chest' => __( 'Medicine chest', 'medical-toolskit' ),
			'icon-medical-men-urogenital-system' => __( 'Men urogenital system', 'medical-toolskit' ),
			'icon-medical-microscope' => __( 'Microscope', 'medical-toolskit' ),
			'icon-medical-muscle' => __( 'Muscle', 'medical-toolskit' ),
			'icon-medical-nasopharynx' => __( 'Nasopharynx', 'medical-toolskit' ),
			'icon-medical-neurology' => __( 'Neurology', 'medical-toolskit' ),
			'icon-medical-nurse-cap' => __( 'Nurse cap', 'medical-toolskit' ),
			'icon-medical-nurse' => __( 'Nurse', 'medical-toolskit' ),
			'icon-medical-patch' => __( 'Patch', 'medical-toolskit' ),
			'icon-medical-pill' => __( 'Pill', 'medical-toolskit' ),
			'icon-medical-pulse' => __( 'Pulse', 'medical-toolskit' ),
			'icon-medical-radiation-sign' => __( 'Radiation sign', 'medical-toolskit' ),
			'icon-medical-ribbon' => __( 'Ribbon', 'medical-toolskit' ),
			'icon-medical-Rx-sign' => __( 'Rx sign', 'medical-toolskit' ),
			'icon-medical-sex-signs' => __( 'Sex signs', 'medical-toolskit' ),
			'icon-medical-shot' => __( 'Shot', 'medical-toolskit' ),
			'icon-medical-skin' => __( 'Skin', 'medical-toolskit' ),
			'icon-medical-skull-bones' => __( 'Skull bones', 'medical-toolskit' ),
			'icon-medical-skull' => __( 'Skull', 'medical-toolskit' ),
			'icon-medical-snakes-cup' => __( 'Snakes cup', 'medical-toolskit' ),
			'icon-medical-snellen-chart' => __( 'Snellen chart', 'medical-toolskit' ),
			'icon-medical-spermatozoids' => __( 'Spermatozoids', 'medical-toolskit' ),
			'icon-medical-stethoscope' => __( 'Stethoscope', 'medical-toolskit' ),
			'icon-medical-stomach' => __( 'Stomach', 'medical-toolskit' ),
			'icon-medical-surgery' => __( 'Surgery', 'medical-toolskit' ),
			'icon-medical-syringe' => __( 'Syringe', 'medical-toolskit' ),
			'icon-medical-tablet' => __( 'Tablet', 'medical-toolskit' ),
			'icon-medical-test-tubes' => __( 'Test tubes', 'medical-toolskit' ),
			'icon-medical-thermometer' => __( 'Thermometer', 'medical-toolskit' ),
			'icon-medical-thyroid-gland' => __( 'Thyroid gland', 'medical-toolskit' ),
			'icon-medical-tooth-paste' => __( 'Tooth paste', 'medical-toolskit' ),
			'icon-medical-tooth' => __( 'Tooth', 'medical-toolskit' ),
			'icon-medical-trolley' => __( 'Trolley', 'medical-toolskit' ),
			'icon-medical-ultrasonic-diagnostic' => __( 'Ultrasonic diagnostic', 'medical-toolskit' ),
			'icon-medical-virus' => __( 'Virus', 'medical-toolskit' ),
			'icon-medical-women-urogenital-system' => __( 'Women urogenital system', 'medical-toolskit' ),
		);

		/*-----------------------------------------------------------
			Get a copy of the saved settings array.
		-----------------------------------------------------------*/

		$saved_settings = get_option( 'option_tree_settings', array() );
	  

		/*-----------------------------------------------------------
			Custom settings array that will eventually be passed 
			to the OptionTree Settings API Class.
		-----------------------------------------------------------*/

		$wplook_custom_settings = array(
			'contextual_help' => array(

				'content'       => array( 
					array(
						'id'        => 'general_help',
						'title'     => __( 'General', 'healthmedical-wpl' ),
						'content'   => __( '<p>For help access https://wplook.com/help</p>', 'healthmedical-wpl' )
					)
				),

			),

			'sections'        => array(


				/*-----------------------------------------------------------
					General Settings
				-----------------------------------------------------------*/
				
				array(
					'title'       => __('General settings', 'healthmedical-wpl'),
					'id'          => 'general_settings'
				),


				/*-----------------------------------------------------------
					Toolbar Settings
				-----------------------------------------------------------*/

				array(
					'title'       => __('Toolbar', 'healthmedical-wpl'),
					'id'          => 'toolbar_settings'
				),


				/*-----------------------------------------------------------
					Services
				-----------------------------------------------------------*/

				array(
					'title'       => __('Services', 'healthmedical-wpl'),
					'id'          => 'services_settings'
				),


				/*-----------------------------------------------------------
					Doctors
				-----------------------------------------------------------*/

				array(
					'title'       => __('Doctors', 'healthmedical-wpl'),
					'id'          => 'doctors_settings'
				),


				/*-----------------------------------------------------------
					Departments
				-----------------------------------------------------------*/

				array(
					'title'       => __('Departments', 'healthmedical-wpl'),
					'id'          => 'departments_settings'
				),


				/*-----------------------------------------------------------
					Sidebars
				-----------------------------------------------------------*/

				array(
					'title'       => __('Sidebars', 'healthmedical-wpl'),
					'id'          => 'sidebars_settings'
				),


				/*-----------------------------------------------------------
					Custom Google Fonts
				-----------------------------------------------------------*/

				array(
					'title'       => __('Google Fonts', 'healthmedical-wpl'),
					'id'          => 'google_fonts_settings'
				),


				/*-----------------------------------------------------------
					'Book Now' advertisement
				-----------------------------------------------------------*/

				array(
					'title'       => __('"Book Now" advertisement', 'healthmedical-wpl'),
					'id'          => 'booknow_settings'
				),


				/*-----------------------------------------------------------
					Slider Settings
				-----------------------------------------------------------*/

				array(
					'title'       => __('Slider', 'healthmedical-wpl'),
					'id'          => 'slider_settings'
				),

				/*-----------------------------------------------------------
					News Settings
				-----------------------------------------------------------*/

				array(
					'title'       => __('Blog page', 'healthmedical-wpl'),
					'id'          => 'blog_settings'
				),


				/*-----------------------------------------------------------
					Custom Code Settings
				-----------------------------------------------------------*/

				array(
					'title'       => __('Custom Code', 'healthmedical-wpl'),
					'id'          => 'code_settings'
				),
				
				
			),

			'settings'        => array(

				/*-----------------------------------------------------------
					General Settings
				-----------------------------------------------------------*/
				
				array(
					'label'       => __('Logo Image','healthmedical-wpl'),
					'id'          => 'wpl_logo',
					'type'        => 'upload',
					'desc'        => __('Upload your own logo. Maximum image size: 280x60px;', 'healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),
				
				array(
					'label'       => __('Favicon','healthmedical-wpl'),
					'id'          => 'wpl_favicon',
					'type'        => 'upload',
					'desc'        => __('Upload your favicon.<br/><br/><strong>NOTICE:</strong> Use .png image type. You can generate a favicon <a target="_blank" href="http://www.favicon.cc">here</a>', 'healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __('Default header image','healthmedical-wpl'),
					'id'          => 'wpl_default_header_image',
					'type'        => 'upload',
					'desc'        => __('The header image to be displayed if a header image isn\'t set for that specific post.<br/><br/>Recommended image size: 2500px x 1660px', 'healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __('Activate Breadcrumbs','healthmedical-wpl'),
					'id'          => 'wpl_breadcrumbs_status',
					'type'        => 'on-off',
					'desc'        => __('Activate the Breadcrumbs on site','healthmedical-wpl'),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __('Copyright','healthmedical-wpl'),
					'id'          => 'wpl_copyright',
					'type'        => 'text',
					'desc'        => __('Enter your Copyright notice displayed in the footer of the website.','healthmedical-wpl'),
					'std'         => 'Copyright &copy; 2016.',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				/*-----------------------------------------------------------
					Toolbar Settings
				-----------------------------------------------------------*/

				array(
					'label'       => __('Enable/disable the toolbar','healthmedical-wpl'),
					'id'          => 'wpl_toolbar',
					'type'        => 'on-off',
					'desc'        => __('Enable or disable the toolbar','healthmedical-wpl'),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'toolbar_settings'
				),

				array(
					'label'       => __('Welcome message','healthmedical-wpl'),
					'id'          => 'wpl_welcome_message',
					'type'        => 'text',
					'desc'        => __('Enter your welcome message displayed at the top of every page.','healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'toolbar_settings'
				),
				
				array(
					'label'       => __('Social Network Navigation','healthmedical-wpl'),
					'id'          => 'wpl_toolbar_share',
					'type'        => 'list-item',
					'desc'        => __('Press the <strong>Add New</strong> button in order to add social media links.','healthmedical-wpl'),
					'settings'    => array(
						array(
							'label'       => __('URL','healthmedical-wpl'),
							'id'          => 'wpl_share_item_url',
							'type'        => 'text',
							'desc'        => __('Enter the URL of the social network site, for example: http://www.facebook.com/wplookthemes','healthmedical-wpl'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						), 
						array(
							'label'       => __('Icon','healthmedical-wpl'),
							'id'          => 'wpl_share_item_icon',
							'type'        => 'text',
							'desc'        => __('<strong>NOTICE</strong>: Choose one item from the following list: <br />fa fa-facebook, <br />fa fa-github, <br />fa fa-twitter, <br />fa fa-pinterest, <br />fa fa-linkedin, <br />fa fa-google-plus, <br />fa fa-youtube, <br />fa fa-skype, <br />fa fa-vk, <br />fa fa-vimeo-square','healthmedical-wpl'),
							'std'         => 'fa fa-',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						), 
					),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'toolbar_settings'
				),

				
				array(
					'label'       => __('Phone Number','healthmedical-wpl'),
					'id'          => 'wpl_phone_number',
					'type'        => 'text',
					'desc'        => __('Add the phone number.','healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'toolbar_settings'
				),

				array(
					'label'       => __('Button Title','healthmedical-wpl'),
					'id'          => 'wpl_book_appointment_title',
					'type'        => 'text',
					'desc'        => __('The text to display on the blue button in the header.','healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'toolbar_settings'
				),

				array(
					'label'       => __('Button URL','healthmedical-wpl'),
					'id'          => 'wpl_book_appointment_url',
					'type'        => 'text',
					'desc'        => __('The URL to which the button should link.','healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'toolbar_settings'
				),

				/*-----------------------------------------------------------
					Services
				-----------------------------------------------------------*/


				array(
					'label'       => __('Number of Services per page','healthmedical-wpl'),
					'id'          => 'wpl_services_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __('Set how many Services do you want to display per page.','healthmedical-wpl'),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'services_settings'
				),

				array(
					'label'       => __('URL Rewrite','healthmedical-wpl'),
					'id'          => 'wpl_services_url_rewrite',
					'type'        => 'text',
					'desc'        => __('<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes','healthmedical-wpl'),
					'std'         => 'service',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'services_settings'
				),


				array(
					'label'       => __('Category URL Rewrite','healthmedical-wpl'),
					'id'          => 'wpl_services_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __('<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes','healthmedical-wpl'),
					'std'         => 'services-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'services_settings'
				),

				array(
					'label'       => __('Default header image','healthmedical-wpl'),
					'id'          => 'wpl_services_header_image',
					'type'        => 'upload',
					'desc'        => __('The header image to be displayed if a header image isn\'t set for that specific post.<br/><br/>Recommended image size: 2500px x 1660px', 'healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'services_settings'
				),

				array(
					'label'       => __('"All Services" icon', 'healthmedical-wpl'),
					'id'          => 'wpl_services_default_icon',
					'type'        => 'wplook_icon_picker',
					'desc'        => sprintf( __('The icon will represent "All Services" in the front-end of the site. <br><br>You can also use icons from %1$sFont Awesome%2$s. Select an icon and use it\'s <i>class</i>, like <code>fa fa-user-md</code> in the input field.', 'medical-toolskit'), '<a href="http://fontawesome.io/icons/" target="_blank">', '</a>' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'services_settings',
					'choices'     => $medical_icons,
				),

				array(
					'label'       => __('"All services" link','healthmedical-wpl'),
					'id'          => 'wpl_services_all_link',
					'type'        => 'page-select',
					'desc'        => __('What page "All services" should link to on the Services listing template.', 'healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'services_settings'
				),


				/*-----------------------------------------------------------
					Doctors
				-----------------------------------------------------------*/

				array(
					'label'       => __('Number of doctors per page','healthmedical-wpl'),
					'id'          => 'wpl_doctors_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __('Set how many doctors do you want to display per page.','healthmedical-wpl'),
					'std'         => '12',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'doctors_settings'
				),

				array(
					'label'       => __('URL Rewrite','healthmedical-wpl'),
					'id'          => 'wpl_doctors_url_rewrite',
					'type'        => 'text',
					'desc'        => __('<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes','healthmedical-wpl'),
					'std'         => 'doctor',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'doctors_settings'
				),


				array(
					'label'       => __('Category URL Rewrite','healthmedical-wpl'),
					'id'          => 'wpl_doctors_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __('<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes','healthmedical-wpl'),
					'std'         => 'doctors',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'doctors_settings'
				),

				array(
					'label'       => __('Default header image','healthmedical-wpl'),
					'id'          => 'wpl_doctors_header_image',
					'type'        => 'upload',
					'desc'        => __('The header image to be displayed if a header image isn\'t set for that specific post.<br/><br/>Recommended image size: 2500px x 1660px', 'healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'doctors_settings'
				),

				array(
					'label'       => __('"All Doctors" icon', 'healthmedical-wpl'),
					'id'          => 'wpl_doctors_default_icon',
					'type'        => 'wplook_icon_picker',
					'desc'        => sprintf( __('The icon will represent "All Doctors" in the front-end of the site. <br><br>You can also use icons from %1$sFont Awesome%2$s. Select an icon and use it\'s <i>class</i>, like <code>fa fa-user-md</code> in the input field.', 'medical-toolskit'), '<a href="http://fontawesome.io/icons/" target="_blank">', '</a>' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'doctors_settings',
					'choices'     => $medical_icons,
				),

				array(
					'label'       => __('"All doctors" link','healthmedical-wpl'),
					'id'          => 'wpl_doctors_all_link',
					'type'        => 'page-select',
					'desc'        => __('What page "All doctors" should link to on the Doctors listing template.', 'healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'doctors_settings'
				),

				array(
					'label'       => __('Display featured image on single doctor pages','healthmedical-wpl'),
					'id'          => 'wpl_doctors_single_featured_image',
					'type'        => 'on-off',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'doctors_settings'
				),


				/*-----------------------------------------------------------
					Departments
				-----------------------------------------------------------*/

				array(
					'label'       => __('Default header image','healthmedical-wpl'),
					'id'          => 'wpl_departments_header_image',
					'type'        => 'upload',
					'desc'        => __('The header image to be displayed if a header image isn\'t set for that specific post.<br/><br/>Recommended image size: 2500px x 1660px', 'healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'departments_settings'
				),

				array(
					'label'       => __('URL Rewrite','healthmedical-wpl'),
					'id'          => 'wpl_departments_url_rewrite',
					'type'        => 'text',
					'desc'        => __('<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes','healthmedical-wpl'),
					'std'         => 'department',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'departments_settings'
				),


				/*-----------------------------------------------------------
					Sidebar Settings
				-----------------------------------------------------------*/

				array(
					'label'       => __('Add Custom Sidebars','healthmedical-wpl'),
					'id'          => 'wpl_multiple_sidebars',
					'type'        => 'list-item',
					'desc'        => __('Press the <strong>Add New</strong> button in order to add a new widget area.','healthmedical-wpl'),
					'settings'    => array(
						array(
							'label'       => __('Widget area Name','healthmedical-wpl'),
							'id'          => 'wpl_widget_area_name',
							'type'        => 'text',
							'desc'        => __('Add a name for the Widget area.','healthmedical-wpl'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						),
						array(
							'label'       => __('Widget area ID','healthmedical-wpl'),
							'id'          => 'wpl_widget_area_id',
							'type'        => 'text',
							'desc'        => __('Add a unique ID for this widget area.','healthmedical-wpl'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						), 
						array(
							'label'       => __('Widget area Description','healthmedical-wpl'),
							'id'          => 'wpl_widget_area_description',
							'type'        => 'text',
							'desc'        => __('Description for this widget area.','healthmedical-wpl'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						), 
					),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sidebars_settings'
				),

				array(
					'label'       => __('Number of footer widget areas','healthmedical-wpl'),
					'id'          => 'wpl_footer_sidebars',
					'type'        => 'numeric-slider',
					'desc'        => __('How many footer widget areas should be made available for use in Widget settings. The theme will adjust the widths of the footer widget areas based on this setting.','healthmedical-wpl'),
					'std'         => '4',
					'min_max_step'=> '1,4,1',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sidebars_settings'
				),


				/*-----------------------------------------------------------
					Google Fonts
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Google Fonts', 'healthmedical-wpl' ),
					'id'          => '',
					'type'        => 'textblock-titled',
					'desc'        => __( 'Google Fonts allow you to include custom web fonts on your pages. Preview available fonts at <a href="https://www.google.com/fonts/">https://www.google.com/fonts/</a>. It is recommended that for all the fonts you use, you include the <code>regular</code> and <code>latin</code> variants so every font uses a standard width and a Latin character set.', 'healthmedical-wpl' ),
					'section'     => 'google_fonts_settings'
				),

				array(
					'label'       => __( 'Select fonts', 'healthmedical-wpl' ),
					'id'          => 'wpl_fonts_select',
					'type'        => 'google-fonts',
					'desc'        => __( 'Select what fonts to include from Google Fonts here and choose where to use them in the section below.<br><br>For the fonts to appear in the section below, you must save changes after selecting fonts in this section.<br><br>To increase the speed of your site, include only the font variants you know you\'ll need. These fonts will be loaded regardless of whether or not they\'re used in the sections below, so make sure you delete any fonts you no longer need.', 'healthmedical-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'google_fonts_settings',
				),

				array(
					'label'       => __( 'Change body font', 'healthmedical-wpl' ),
					'id'          => 'wpl_fonts_body_bool',
					'type'        => 'on-off',
					'desc'        => __( 'Do you want to change the body font?', 'healthmedical-wpl' ),
					'std'         => 'off',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'google_fonts_settings',
				),

				array(
					'label'       => __( 'Body font', 'healthmedical-wpl' ),
					'id'          => 'wpl_fonts_body',
					'type'        => 'typography',
					'desc'        => __( 'Select the main font to use on the site. Don\'t change these settings if you don\'t want to -- if you don\'t change them, default theme values will be used.', 'healthmedical-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => 'wpl_fonts_body_bool:is(on)',
					'section'     => 'google_fonts_settings',
				),

				array(
					'label'       => __( 'Change heading font', 'healthmedical-wpl' ),
					'id'          => 'wpl_fonts_heading_bool',
					'type'        => 'on-off',
					'desc'        => __( 'Do you want to change the heading font?', 'healthmedical-wpl' ),
					'std'         => 'off',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'google_fonts_settings',
				),

				array(
					'label'       => __( 'Heading font', 'healthmedical-wpl' ),
					'id'          => 'wpl_fonts_heading',
					'type'        => 'typography',
					'desc'        => __( 'Select the main font to use for headings. Don\'t change these settings if you don\'t want to -- if you don\'t change them, default theme values will be used.', 'healthmedical-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => 'wpl_fonts_heading_bool:is(on)',
					'section'     => 'google_fonts_settings',
				),

				array(
					'label'       => __( 'Change menu font', 'healthmedical-wpl' ),
					'id'          => 'wpl_fonts_menu_bool',
					'type'        => 'on-off',
					'desc'        => __( 'Do you want to change the menu font?', 'healthmedical-wpl' ),
					'std'         => 'off',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'google_fonts_settings',
				),

				array(
					'label'       => __( 'Menu font', 'healthmedical-wpl' ),
					'id'          => 'wpl_fonts_menu',
					'type'        => 'typography',
					'desc'        => __( 'Select the main font to use for the header menu. Don\'t change these settings if you don\'t want to -- if you don\'t change them, default theme values will be used.', 'healthmedical-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => 'wpl_fonts_menu_bool:is(on)',
					'section'     => 'google_fonts_settings',
				),
				

				/*-----------------------------------------------------------
					'Book Now' advertisement
				-----------------------------------------------------------*/

				array(
					'label'       => __('Enable the "Book Now" advertisement','healthmedical-wpl'),
					'id'          => 'wpl_booknow',
					'type'        => 'on-off',
					'desc'        => __('Whether to show the "Book Now" advertisement at the bottom of the page.','healthmedical-wpl'),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'booknow_settings'
				),

				array(
					'label'       => __('"Book Now" page','healthmedical-wpl'),
					'id'          => 'wpl_booknow_page',
					'type'        => 'page_select',
					'desc'        => __('Where the "Book Now" button will link to.','healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'booknow_settings'
				),

				array(
					'label'       => __('Title','healthmedical-wpl'),
					'id'          => 'wpl_booknow_title',
					'type'        => 'text',
					'desc'        => __('Main text appearing in the "Book Now" advertisement.','healthmedical-wpl'),
					'std'         => __('Book your appointment','healthmedical-wpl'),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'booknow_settings'
				),

				array(
					'label'       => __('Subtitle','healthmedical-wpl'),
					'id'          => 'wpl_booknow_subtitle',
					'type'        => 'text',
					'desc'        => __('Supplementary text appearing in the "Book Now" advertisement.','healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'booknow_settings'
				),

				array(
					'label'       => __('Button text','healthmedical-wpl'),
					'id'          => 'wpl_booknow_button_text',
					'type'        => 'text',
					'desc'        => __('Text appearing on the button linking to a page on the "Book Now" advertisement.','healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'booknow_settings'
				),

				array(
					'label'       => __('Doctor image','healthmedical-wpl'),
					'id'          => 'wpl_booknow_image',
					'type'        => 'upload',
					'desc'        => __('The image displayed alongside the advertisement. Recommended size: 120px x 120px.','healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'booknow_settings'
				),


				/*-----------------------------------------------------------
					Slider Settings 
				-----------------------------------------------------------*/

				array(
					'label'       => __('Revolution Slider','healthmedical-wpl'),
					'id'          => 'wpl_rev_slider',
					'type'        => 'on-off',
					'desc'        => sprintf( __('Activate the Revolution Slider. Revolution Slider is not included in the theme. You can buy it from <a href="%1$s" target="_blank">CodeCanyon</a>.','healthmedical-wpl'), 'http://bit.ly/1eD7aE1'),
					'std'         => 'off',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'slider_settings'
				),

				array(
					'label'       => __('Revolution Slider Alias','healthmedical-wpl'),
					'id'          => 'wpl_slider_revolution',
					'type'        => 'text',
					'desc'        => __('Revolution Slider Alias. If you have installed the revolution slider Plugin, add the Slider Alias here. From this example [rev_slider <strong>test</strong>] you need to add only the word <strong>test</strong>.','healthmedical-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'class'       => '',
					'taxonomy'    => '',
					'condition'   => 'wpl_rev_slider:is(on)',
					'section'     => 'slider_settings'
				),

				array(
					'label'       => __('Default theme slider','healthmedical-wpl'),
					'id'          => 'wpl_custom_slider',
					'type'        => 'on-off',
					'desc'        => __('Display the default theme slider on the home page.','healthmedical-wpl'),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'slider_settings'
				),

				array(
					'label'       => __('Enable automatic slideshow','healthmedical-wpl'),
					'id'          => 'wpl_slider_auto',
					'type'        => 'on-off',
					'desc'        => __('Whether to move the slides in the WPlook home page slider automatically or let users navigate the slider using on screen arrows.','healthmedical-wpl'),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => 'wpl_custom_slider:is(on)',
					'section'     => 'slider_settings'
				),

				/*-----------------------------------------------------------
					Blog settings
				-----------------------------------------------------------*/

				array(
					'label'       => __('Display featured images','healthmedical-wpl'),
					'id'          => 'wpl_blog_featured_images',
					'type'        => 'on-off',
					'desc'        => __('Display featured images on post listing pages (such as the "Posts page" set in the Reading settings).','healthmedical-wpl'),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),


				/*-----------------------------------------------------------
					Custom Code
				-----------------------------------------------------------*/

				array(
					'label'       => __('Custom Cascading Style Sheets','healthmedical-wpl'),
					'id'          => 'wpl_css',
					'type'        => 'css',
					'desc'        => __('Add custom CSS to your theme.','healthmedical-wpl'),
					'std'         => '',
					'rows'        => '10',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'code_settings'
				),


			)
		);

		/* settings are not the same update the DB */
		if ( $saved_settings !== $wplook_custom_settings ) {
			update_option( 'option_tree_settings', $wplook_custom_settings ); 
		}
	}
}
