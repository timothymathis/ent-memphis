<?php
/**
 * The default custom post type for Departments
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0
 */

class Wpl_Toolskit_Departments {

	/**
	 * Construct
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		/* Add Custom Post Types */
		add_action( 'init', array( $this, 'wpl_toolskit_departments_cpt' ), 0 );

		/* Add Meta Boxes Custom Post Types*/
		add_action( 'admin_init', array( $this, 'wpl_toolskit_departments_meta_boxes' ) );

		/* Require common functions */
		require_once( WPL_TOOLSKIT_DIR . 'inc/library.php' );
	}


	/**
	 * Register Custom Post Type
	 *
	 * @since 1.0.0
	 */
	public function wpl_toolskit_departments_cpt() {
	
		if ( ! function_exists( 'rewrite_slug' ) ) {
			function rewrite_slug($option, $default) {
				$slug = ot_get_option( $option );

				if( $slug ) {
					return $slug;
				} else {
					return $default;
				}
			}
		}
		
		$labels = array(
			'name'                => _x( 'Departments', 'Post Type General Name', 'medical-toolskit' ),
			'singular_name'       => _x( 'Department', 'Post Type Singular Name', 'medical-toolskit' ),
			'menu_name'           => __( 'Departments', 'medical-toolskit' ),
			'name_admin_bar'      => __( 'Departments', 'medical-toolskit' ),
			'parent_item_colon'   => __( 'Parent Department:', 'medical-toolskit' ),
			'all_items'           => __( 'All Departments', 'medical-toolskit' ),
			'add_new_item'        => __( 'Add New Department', 'medical-toolskit' ),
			'add_new'             => __( 'Add New', 'medical-toolskit' ),
			'new_item'            => __( 'New Department', 'medical-toolskit' ),
			'edit_item'           => __( 'Edit Department', 'medical-toolskit' ),
			'update_item'         => __( 'Update Department', 'medical-toolskit' ),
			'view_item'           => __( 'View Department', 'medical-toolskit' ),
			'search_items'        => __( 'Search Departments', 'medical-toolskit' ),
			'not_found'           => __( 'Not found', 'medical-toolskit' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'medical-toolskit' ),
		);
		$rewrite = array(
			'slug'                => rewrite_slug('wpl_departments_url_rewrite', 'departmentsss'),
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => false,
		);
		$args = array(
			'label'               => __( 'wpl_post_departments', 'medical-toolskit' ),
			'description'         => __( 'Departments to which doctors can belong', 'medical-toolskit' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			//'menu_position'       => 5,
			'menu_icon'           => 'dashicons-category',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
		);
		register_post_type( WPL_TOOLSKIT_SLUG_SHORT . 'post_departments', $args );

	}


	/**
	 * Register Meta Boxes
	 * 
	 * @since 1.0.0
	 */
	public function wpl_toolskit_departments_meta_boxes() {
		$wpl_toolskit_departments_meta_box = array(
		'id'          => 'departments_meta_box',
		'title'       => __('Department Settings', 'medical-toolskit'),
		'desc'        => '',
		'pages'       => array( 'wpl_post_departments' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __('Logo', 'medical-toolskit'),
				'id'          => 'wpl_font_icon',
				'type'        => 'wplook_icon_picker',
				'desc'        => sprintf( __('The icon will represent the category in the front-end of the site. <br><br>You can also use icons from %1$sFont Awesome%2$s. Select an icon and use it\'s <i>class</i>, like <code>fa fa-user-md</code> in the input field.', 'medical-toolskit'), '<a href="http://fontawesome.io/icons/" target="_blank">', '</a>' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => '',
				'choices'     => Wpl_Toolskit_Common::return_medical_icons(),
			),
			array(
				'label'       => __('Doctors category', 'medical-toolskit'),
				'id'          => 'wpl_departments_category_doctors',
				'type'        => 'taxonomy-select',
				'desc'        => __('Which category of doctors you want to display in this department.', 'medical-toolskit'),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => 'wpl_doctors_category',
				'class'       => '',
				'section'     => ''
			),
			array(
				'label'       => __('Services category', 'medical-toolskit'),
				'id'          => 'wpl_departments_category_services',
				'type'        => 'taxonomy-select',
				'desc'        => __('Which category of services you want to display in this department.', 'medical-toolskit'),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => 'wpl_services_category',
				'class'       => '',
				'section'     => ''
			),
			array(
				'label'       => __('Display in home page widget', 'medical-toolskit'),
				'id'          => 'wpl_departments_home_widget',
				'type'        => 'on-off',
				'desc'        => __('Whether to feature this department in the Departments home page widget.', 'medical-toolskit'),
				'std'         => 'off',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),
			array(
				'label'       => __('Display in sidebar widget', 'medical-toolskit'),
				'id'          => 'wpl_departments_sidebar_widget',
				'type'        => 'on-off',
				'desc'        => __('Whether to feature this department in the Departments sidebar widget.', 'medical-toolskit'),
				'std'         => 'off',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),
		)
	);

		if (Medical_Toolskit::wpl_toolskit_ot_active()) {
			ot_register_meta_box( $wpl_toolskit_departments_meta_box );
		}
	}
}
?>
