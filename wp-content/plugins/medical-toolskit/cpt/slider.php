<?php
/**
 * Custom Post Type Slider
 *
 * @since 1.0.0
 */
class Wpl_Toolskit_Slider {

	/**
	 * Construct
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		/* Add Custom Post Types */
		add_action( 'init', array( $this, 'wpl_toolskit_slider_cpt' ), 0 );

		/* Add Taxomomy Custom Post Types */
		// add_action( 'init', array( $this, 'wpl_toolskit_slider_taxomomy' ), 0 );

		/* Add Meta Boxes Custom Post Types*/
		add_action( 'admin_init', array( $this, 'wpl_toolskit_slider_meta_boxes' ) );
	}


	/**
	 * Register Custom Post Type
	 *
	 * @since 1.0.0
	 */
	public function wpl_toolskit_slider_cpt() {

		$labels = array(
			'name'					=> __( 'Home Page Slider', 'medical-toolskit' ),
			'singular_name'			=> __( 'Slide', 'medical-toolskit' ),
			'menu_name'             => __( 'Slides', 'medical-toolskit' ),
			'name_admin_bar'        => __( 'Slide', 'medical-toolskit' ),
			'add_new'				=> __( 'Add New Slide', 'medical-toolskit' ),
			'add_new_item'			=> __( 'Add New Slide', 'medical-toolskit' ),
			'edit'					=> __( 'Edit', 'medical-toolskit' ),
			'edit_item'				=> __( 'Edit Slide', 'medical-toolskit' ),
			'new_item'				=> __( 'New Slide', 'medical-toolskit' ),
			'view'					=> __( 'View', 'medical-toolskit' ),
			'view_item'				=> __( 'View Slide', 'medical-toolskit' ),
			'search_items'			=> __( 'Search Slide', 'medical-toolskit' ),
			'not_found'				=> __( 'No Slide found', 'medical-toolskit' ),
			'not_found_in_trash' 	=> __( 'No Slide found in Trash', 'medical-toolskit' ),
			'parent'				=> __( 'Parent Slide', 'medical-toolskit' ),
			'parent_item_colon'		=> __( 'Parent Item:', 'medical-toolskit' ),
			// 'all_items'				=> __( 'All Testimonials', 'medical-toolskit' ),
			// 'update_item'			=> __( 'Update Testimonial', 'medical-toolskit' ),
		);
		$rewrite = array(
			'slug'					=> 'slide',
			// 'with_front'			=> true,
			// 'pages'					=> true,
			// 'feeds'					=> false,
		);
		$args = array(
			'label'					=> __( 'Slider', 'medical-toolskit' ),
			'description'			=> __( 'Easily lets you create beautiful slides', 'medical-toolskit' ),
			'labels'                => $labels,
			'public'				=> false,
			'show_ui'				=> true, 
			'_builtin'				=> false,
			'capability_type'		=> 'page',
			'menu_icon'				=> 'dashicons-slides',
			'hierarchical'			=> false,
			'rewrite'				=> $rewrite,
			'supports'				=> array('title'),
		);
		register_post_type( WPL_TOOLSKIT_SLUG_SHORT . 'post_slider', $args );

	}


	/**
	 * Register Custom Taxonomy
	 * 
	 * @since 1.0.0
	 */
	public function wpl_toolskit_slider_taxomomy() {}


	/**
	 * Register Meta Boxes
	 * 
	 * @since 1.0.0
	 */
	public function wpl_toolskit_slider_meta_boxes() {

		$wpl_toolskit_slider_meta_box = array(
			'id'          => 'slider_meta_box',
			'title'       => __('Slider Options', 'medical-toolskit'),
			'desc'        => '',
			'pages'       => array( 'wpl_post_slider' ),
			'context'     => 'normal',
			'priority'    => 'default',
			'fields'      => array(  
				
				array(
					'label'       => __('Slide image', 'medical-toolskit'),
					'id'          => 'wpl_slide_image',
					'type'        => 'upload',
					'desc'        => __('The image will be displayed in the header of the page (required dimensions: 2560 x 1200)',  'medical-toolskit'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => ''
				),

				array(
					'label'       => __('Unhighlighted title', 'medical-toolskit'),
					'id'          => 'wpl_slider_title_unhighlighted',
					'type'        => 'text',
					'desc'        => __('Unhighlighted part of the slide title', 'medical-toolskit'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'	  => '',
					'operator'    => 'and'
				),

				array(
					'label'       => __('Highlighted title', 'medical-toolskit'),
					'id'          => 'wpl_slider_title_highlighted',
					'type'        => 'text',
					'desc'        => __('Highligted part of the slide title', 'medical-toolskit'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'	  => '',
					'operator'    => 'and'
				),

				array(
					'label'       => __('Subtitle', 'medical-toolskit'),
					'id'          => 'wpl_slider_subtitle',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'	  => '',
					'operator'    => 'and'
				),

				array(
					'label'       => __('Content', 'medical-toolskit'),
					'id'          => 'wpl_slider_content',
					'type'        => 'text',
					'desc'        => __('The main content displayed on the slide', 'medical-toolskit'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'	  => '',
					'operator'    => 'and'
				),

				array(
					'label'       => __('Action button text', 'medical-toolskit'),
					'id'          => 'wpl_slider_button_text',
					'type'        => 'text',
					'desc'        => __('Add text to the button', 'medical-toolskit'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'	  => '',
					'operator'    => 'and'
				),

				array(
					'label'       => __('Action button URL', 'medical-toolskit'),
					'id'          => 'wpl_slider_button_url',
					'type'        => 'text',
					'desc'        => __('Add button URL', 'medical-toolskit'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'	  => '',
					'operator'    => 'and'
				),
			)
		);

		if (Medical_Toolskit::wpl_toolskit_ot_active()) {
			ot_register_meta_box( $wpl_toolskit_slider_meta_box );
		}

	}
}

?>
