<?php
/**
 * Custom Post Type Services
 *
 * @since 1.0.0
 */
class Wpl_Toolskit_Services {

	/**
	 * Construct
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		/* Add Custom Post Types */
		add_action( 'init', array( $this, 'wpl_toolskit_services_cpt' ), 0 );

		/* Add Taxomomy Custom Post Types */
		add_action( 'init', array( $this, 'wpl_toolskit_services_taxomomy' ), 0 );

		/* Require common functions */
		require_once( WPL_TOOLSKIT_DIR . 'inc/library.php' );

		/* Add Meta Boxes Custom Post Types*/
		// add_action( 'admin_init', array( $this, 'wpl_toolskit_services_meta_boxes' ) );

		/* Add icon meta field to the new doctor taxonomy page */
		add_action( 'wpl_services_category_add_form_fields', array( $this, 'wpl_toolskit_services_taxomomy_add_new_meta_field' ), 10, 2 );
		add_action( 'create_wpl_services_category', array( $this, 'wpl_toolskit_services_taxomomy_save_meta_field' ), 10, 2 );

		/* Add icon meta field to the edit doctor taxonomy page */
		add_action( 'wpl_services_category_edit_form_fields', array( $this, 'wpl_toolskit_services_taxomomy_edit_meta_field' ), 10, 2 );
		add_action( 'edited_wpl_services_category', array( $this, 'wpl_toolskit_services_taxomomy_save_meta_field' ), 10, 2 );

		/* Change the amount of posts on the archive page */
		add_action( 'pre_get_posts', array( $this, 'wpl_toolskit_services_archive_posts' ) );
	}


	/**
	 * Register Custom Post Type
	 *
	 * @since 1.0.0
	 */
	public function wpl_toolskit_services_cpt() {

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
			'name'                => _x( 'Services', 'Post Type General Name', 'medical-toolskit' ),
			'singular_name'       => _x( 'Service', 'Post Type Singular Name', 'medical-toolskit' ),
			'menu_name'           => __( 'Services', 'medical-toolskit' ),
			'name_admin_bar'      => __( 'Service', 'medical-toolskit' ),
			'parent_item_colon'   => __( 'Parent Service:', 'medical-toolskit' ),
			'all_items'           => __( 'All Services', 'medical-toolskit' ),
			'add_new_item'        => __( 'Add New Service', 'medical-toolskit' ),
			'add_new'             => __( 'Add New', 'medical-toolskit' ),
			'new_item'            => __( 'New Service', 'medical-toolskit' ),
			'edit_item'           => __( 'Edit Service', 'medical-toolskit' ),
			'update_item'         => __( 'Update Service', 'medical-toolskit' ),
			'view_item'           => __( 'View Service', 'medical-toolskit' ),
			'search_items'        => __( 'Search Service', 'medical-toolskit' ),
			'not_found'           => __( 'Not found', 'medical-toolskit' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'medical-toolskit' ),
		);
		$rewrite = array(
			'slug'                => rewrite_slug('wpl_services_url_rewrite', 'service'),
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => false,
		);
		$args = array(
			'label'               => __( 'Services', 'medical-toolskit' ),
			'description'         => __( 'Allows you to create services', 'medical-toolskit' ),
			'labels'              => $labels,
			'supports'            => array('title', 'editor', 'excerpt', 'thumbnail'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			//'menu_position'       => 5,
			'menu_icon'           => 'dashicons-media-text',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
		);
		register_post_type( WPL_TOOLSKIT_SLUG_SHORT . 'post_services', $args );

	}


	/**
	 * Register Custom Taxonomy
	 * 
	 * @since 1.0.0
	 */
	public function wpl_toolskit_services_taxomomy() {

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
			'name'                       => _x( 'Service Categories', 'Taxonomy General Name', 'medical-toolskit' ),
			'singular_name'              => _x( 'Service Category', 'Taxonomy Singular Name', 'medical-toolskit' ),
			'menu_name'                  => __( 'Service Categories', 'medical-toolskit' ),
			'all_items'                  => __( 'All Service Categories', 'medical-toolskit' ),
			'parent_item'                => __( 'Parent Service Category', 'medical-toolskit' ),
			'parent_item_colon'          => __( 'Parent Service Category:', 'medical-toolskit' ),
			'new_item_name'              => __( 'New Service Category Name', 'medical-toolskit' ),
			'add_new_item'               => __( 'Add New Service Category', 'medical-toolskit' ),
			'edit_item'                  => __( 'Edit Service Category', 'medical-toolskit' ),
			'update_item'                => __( 'Update Service Category', 'medical-toolskit' ),
			'view_item'                  => __( 'View Service Category', 'medical-toolskit' ),
			'separate_items_with_commas' => __( 'Separate service categories with commas', 'medical-toolskit' ),
			'add_or_remove_items'        => __( 'Add or Remove Service Categories', 'medical-toolskit' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'medical-toolskit' ),
			'popular_items'              => __( 'Popular Service Categories', 'medical-toolskit' ),
			'search_items'               => __( 'Search Service Categories', 'medical-toolskit' ),
			'not_found'                  => __( 'Not Found', 'medical-toolskit' ),
		);
		$rewrite = array(
			'slug'               		 => rewrite_slug('wpl_services_category_url_rewrite', 'service'),
			'with_front'          		 => true,
			'pages'               		 => true,
			'feeds'               		 => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'rewrite'           		 => $rewrite,
		);
		register_taxonomy( 'wpl_services_category', array( WPL_TOOLSKIT_SLUG_SHORT . 'post_services' ), $args );

	}


	/**
	 * Register Meta Boxes
	 * 
	 * @since 1.0.0
	 */
	// public function wpl_toolskit_services_meta_boxes() {
	// 	$wpl_toolskit_services_meta_box = array(
	// 		'id'          => WPL_TOOLSKIT_SLUG . 'services_meta_box',
	// 		'title'       => __( 'Additional Services Options', 'medical-toolskit' ),
	// 		'desc'        => '',
	// 		'pages'       => array( WPL_TOOLSKIT_SLUG_SHORT . 'post_services' ),
	// 		'context'     => 'normal',
	// 		'priority'    => 'high',
	// 		'fields'      => array(
				
	// 		),
	// 	);
			
	// 	if (Medical_Toolskit::wpl_toolskit_ot_active()) {
	// 		ot_register_meta_box( $wpl_toolskit_services_meta_box );
	// 	}
	// }


	/**
	 * Add icon select to the taxonomy admin page
	 * 
	 * @since 1.0.0
	 */
	public function wpl_toolskit_services_taxomomy_add_new_meta_field() {
	?>
		<div class="form-field icon-picker-parent">
			<label for="term_meta[wpl_category_image]"><?php _e( 'Category image', 'wplook' ); ?></label>
			<input type="text" name="term_meta[wpl_category_image]" id="term_meta[wpl_category_image]" class="icon-picker-input">
			<p class="description"><?php printf( __('The icon will represent the category in the front-end of the site. <br><br>You can also use icons from %1$sFont Awesome%2$s. Select an icon and use it\'s <i>class</i>, like <code>fa fa-user-md</code> in the input field.', 'medical-toolskit'), '<a href="http://fontawesome.io/icons/" target="_blank">', '</a>' ); ?></p>

			<?php Wpl_Toolskit_Common::output_icon_picker( Wpl_Toolskit_Common::return_medical_icons(), '', 'add_new_category' ); ?>
		</div>
	<?php
	}

	public function wpl_toolskit_services_taxomomy_edit_meta_field( $term ) {
		// put the term ID into a variable
		$t_id = $term->term_id;
		
		// retrieve the existing value(s) for this meta field. This returns an array
		$term_meta = get_option( "taxonomy_$t_id" );
	?>
		<tr class="form-field icon-picker-parent">
			<th scope="row" valign="top"><label for="term_meta[wpl_category_image]"><?php _e( 'Category image', 'wplook' ); ?></label></th>
			<td>
				<input type="text" name="term_meta[wpl_category_image]" id="term_meta[wpl_category_image]" value="<?php echo esc_attr( $term_meta['wpl_category_image'] ) ? esc_attr( $term_meta['wpl_category_image'] ) : ''; ?>" class="icon-picker-input">
				<p class="description"><?php printf( __('The icon will represent the category in the front-end of the site. <br><br>You can also use icons from %1$sFont Awesome%2$s. Select an icon and use it\'s <i>class</i>, like <code>fa fa-user-md</code> in the input field.', 'medical-toolskit'), '<a href="http://fontawesome.io/icons/" target="_blank">', '</a>' ); ?></p>

				<?php Wpl_Toolskit_Common::output_icon_picker( Wpl_Toolskit_Common::return_medical_icons(), $term_meta['wpl_category_image'], 'edit_category' ); ?>
			</td>
		</tr>
	<?php
	}

	public function wpl_toolskit_services_taxomomy_save_meta_field( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "taxonomy_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			// Save the option array.
			update_option( "taxonomy_$t_id", $term_meta );
		}
	}


	/**
	 * Modify the number of posts displayed on the archive page
	 * 
	 * @since 1.0.0
	 */
	public function wpl_toolskit_services_archive_posts( $query ) {

		if( $query->is_main_query() && !is_admin() && is_tax( 'wpl_services_category' ) ) {
			$query->set( 'posts_per_page', ot_get_option('wpl_services_per_page') );
		}

	}
}
?>
