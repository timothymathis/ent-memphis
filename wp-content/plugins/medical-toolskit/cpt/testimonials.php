<?php
/**
 * Custom Post Type Testimonials
 *
 * @since 1.0.0
 */
class Wpl_Toolskit_Testimonial {

	/**
	 * Construct
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		/* Add Custom Post Types */
		add_action( 'init', array( $this, 'wpl_toolskit_testimonial_cpt' ), 0 );

		/* Add Taxomomy Custom Post Types */
		add_action( 'init', array( $this, 'wpl_toolskit_testimonial_taxomomy' ), 0 );

		/* Add Meta Boxes Custom Post Types*/
		add_action( 'admin_init', array( $this, 'wpl_toolskit_testimonial_meta_boxes' ) );
	}


	/**
	 * Register Custom Post Type
	 *
	 * @since 1.0.0
	 */
	public function wpl_toolskit_testimonial_cpt() {

		$labels = array(
			'name'                => _x( 'Testimonials', 'Post Type General Name', 'medical-toolskit' ),
			'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'medical-toolskit' ),
			'menu_name'           => __( 'Testimonials', 'medical-toolskit' ),
			'name_admin_bar'      => __( 'Testimonial', 'medical-toolskit' ),
			'parent_item_colon'   => __( 'Parent Item:', 'medical-toolskit' ),
			'all_items'           => __( 'All Testimonials', 'medical-toolskit' ),
			'add_new_item'        => __( 'Add New Testimonial', 'medical-toolskit' ),
			'add_new'             => __( 'Add Testimonial', 'medical-toolskit' ),
			'new_item'            => __( 'New Testimonial', 'medical-toolskit' ),
			'edit_item'           => __( 'Edit Testimonial', 'medical-toolskit' ),
			'update_item'         => __( 'Update Testimonial', 'medical-toolskit' ),
			'view_item'           => __( 'View Testimonial', 'medical-toolskit' ),
			'search_items'        => __( 'Search Testimonial', 'medical-toolskit' ),
			'not_found'           => __( 'Not found', 'medical-toolskit' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'medical-toolskit' ),
		);
		$rewrite = array(
			'slug'                => 'testimonial',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => false,
		);
		$args = array(
			'label'               => __( 'Testimonial', 'medical-toolskit' ),
			'description'         => __( 'Testimonial Description', 'medical-toolskit' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			//'menu_position'       => 5,
			'menu_icon'           => 'dashicons-format-status',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
		);
		register_post_type( WPL_TOOLSKIT_SLUG_SHORT . 'post_testimonial', $args );

	}


	/**
	 * Register Custom Taxonomy
	 * 
	 * @since 1.0.0
	 */
	public function wpl_toolskit_testimonial_taxomomy() {}


	/**
	 * Register Meta Boxes
	 * 
	 * @since 1.0.0
	 */
	public function wpl_toolskit_testimonial_meta_boxes() {
		$wpl_toolskit_testimonial_meta_box = array(
			'id'          => WPL_TOOLSKIT_SLUG . 'testimonial_meta_box',
			'title'       => __( 'Additional Testimonial Options', 'medical-toolskit' ),
			'desc'        => '',
			'pages'       => array( WPL_TOOLSKIT_SLUG_SHORT . 'post_testimonial' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __( 'Referee\'s name', 'medical-toolskit' ),
					'id'          => WPL_TOOLSKIT_SLUG . 'testimonial_referee_name',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),
				array(
					'label'       => __( 'Referee\'s avatar', 'medical-toolskit' ),
					'id'          => WPL_TOOLSKIT_SLUG . 'testimonial_referee_image',
					'type'        => 'upload',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => ''
				),
				array(
					'label'       => __( 'Company name', 'medical-toolskit' ),
					'id'          => WPL_TOOLSKIT_SLUG . 'testimonial_company_name',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => ''
				),
				array(
					'label'       => __( 'Company site URL', 'medical-toolskit' ),
					'id'          => WPL_TOOLSKIT_SLUG . 'testimonial_company_url',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),
			),
		);
			
		if (Medical_Toolskit::wpl_toolskit_ot_active()) {
			ot_register_meta_box( $wpl_toolskit_testimonial_meta_box );
		}
	}
}
?>
