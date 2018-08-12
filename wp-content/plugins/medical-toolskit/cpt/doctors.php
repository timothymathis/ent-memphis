<?php
/**
 * Custom Post Type Doctors
 *
 * @since 1.0.0
 */
class Wpl_Toolskit_Doctor {

	/**
	 * Construct
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		/* Add Custom Post Types */
		add_action( 'init', array( $this, 'wpl_toolskit_doctor_cpt' ), 0 );

		/* Add Taxomomy Custom Post Types */
		add_action( 'init', array( $this, 'wpl_toolskit_doctor_taxomomy' ), 0 );

		/* Add Meta Boxes Custom Post Types*/
		add_action( 'admin_init', array( $this, 'wpl_toolskit_doctor_meta_boxes' ) );

		/* Add icon meta field to the new doctor taxonomy page */
		add_action( 'wpl_doctors_category_add_form_fields', array( $this, 'wpl_toolskit_doctor_taxomomy_add_new_meta_field' ), 10, 2 );
		add_action( 'create_wpl_doctors_category', array( $this, 'wpl_toolskit_doctor_taxomomy_save_meta_field' ), 10, 2 );

		/* Add icon meta field to the edit doctor taxonomy page */
		add_action( 'wpl_doctors_category_edit_form_fields', array( $this, 'wpl_toolskit_doctor_taxomomy_edit_meta_field' ), 10, 2 );
		add_action( 'edited_wpl_doctors_category', array( $this, 'wpl_toolskit_doctor_taxomomy_save_meta_field' ), 10, 2 );

		/* Change the amount of posts on the archive page */
		add_action( 'pre_get_posts', array( $this, 'wpl_toolskit_doctor_archive_posts' ) );
	}


	/**
	 * Register Custom Post Type
	 *
	 * @since 1.0.0
	 */
	public function wpl_toolskit_doctor_cpt() {

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
			'name'                => _x( 'Doctor', 'Post Type General Name', 'medical-toolskit' ),
			'singular_name'       => _x( 'Doctor', 'Post Type Singular Name', 'medical-toolskit' ),
			'menu_name'           => __( 'Doctors', 'medical-toolskit' ),
			'name_admin_bar'      => __( 'Doctor', 'medical-toolskit' ),
			'parent_item_colon'   => __( 'Parent Item:', 'medical-toolskit' ),
			'all_items'           => __( 'All Doctors', 'medical-toolskit' ),
			'add_new_item'        => __( 'Add New Doctor', 'medical-toolskit' ),
			'add_new'             => __( 'Add Doctor', 'medical-toolskit' ),
			'new_item'            => __( 'New Doctor', 'medical-toolskit' ),
			'edit_item'           => __( 'Edit Doctor', 'medical-toolskit' ),
			'update_item'         => __( 'Update Doctor', 'medical-toolskit' ),
			'view_item'           => __( 'View Doctor', 'medical-toolskit' ),
			'search_items'        => __( 'Search Doctors', 'medical-toolskit' ),
			'not_found'           => __( 'Not found', 'medical-toolskit' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'medical-toolskit' ),
		);
		$rewrite = array(
			'slug'                => rewrite_slug('wpl_doctors_url_rewrite', 'doctor'),
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => false,
		);
		$args = array(
			'label'               => __( 'Doctor', 'medical-toolskit' ),
			'description'         => __( 'Doctor Description', 'medical-toolskit' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt', ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			//'menu_position'       => 5,
			'menu_icon'           => 'dashicons-id',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
		);
		register_post_type( WPL_TOOLSKIT_SLUG_SHORT . 'post_doctors', $args );

	}


	/**
	 * Register Custom Taxonomy
	 * 
	 * @since 1.0.0
	 */
	public function wpl_toolskit_doctor_taxomomy() {

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
			'name'                       => _x( 'Doctor Categories', 'Taxonomy General Name', 'medical-toolskit' ),
			'singular_name'              => _x( 'Doctor Category', 'Taxonomy Singular Name', 'medical-toolskit' ),
			'menu_name'                  => __( 'Doctor Categories', 'medical-toolskit' ),
			'all_items'                  => __( 'All Categories', 'medical-toolskit' ),
			'parent_item'                => __( 'Parent Category', 'medical-toolskit' ),
			'parent_item_colon'          => __( 'Parent Category:', 'medical-toolskit' ),
			'new_item_name'              => __( 'New Category Name', 'medical-toolskit' ),
			'add_new_item'               => __( 'Add New Category', 'medical-toolskit' ),
			'edit_item'                  => __( 'Edit Category', 'medical-toolskit' ),
			'update_item'                => __( 'Update Category', 'medical-toolskit' ),
			'view_item'                  => __( 'View Category', 'medical-toolskit' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'medical-toolskit' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'medical-toolskit' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'medical-toolskit' ),
			'popular_items'              => __( 'Popular Categories', 'medical-toolskit' ),
			'search_items'               => __( 'Search Categories', 'medical-toolskit' ),
			'not_found'                  => __( 'Not Found', 'medical-toolskit' ),
		);
		$rewrite = array(
			'slug'                => rewrite_slug('wpl_doctors_category_url_rewrite', 'doctors'),
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => false,
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
		register_taxonomy( 'wpl_doctors_category', array( WPL_TOOLSKIT_SLUG_SHORT . 'post_doctors' ), $args );

	}


	/**
	 * Register Meta Boxes
	 * 
	 * @since 1.0.0
	 */
	public function wpl_toolskit_doctor_meta_boxes() {
		$wpl_toolskit_doctor_meta_box = array(
			'id'          => WPL_TOOLSKIT_SLUG . 'doctor_meta_box',
			'title'       => __( 'Additional Doctor Options', 'medical-toolskit' ),
			'desc'        => '',
			'pages'       => array( WPL_TOOLSKIT_SLUG_SHORT . 'post_doctors' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __( 'Doctor Photo', 'medical-toolskit' ),
					'id'          => WPL_TOOLSKIT_SLUG . 'doctor_image',
					'type'        => 'upload',
					'desc'        => __( 'Add Doctor Photo', 'medical-toolskit' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => ''
				),

				array(
					'label'       => __( 'Doctor Job Title', 'medical-toolskit' ),
					'id'          => WPL_TOOLSKIT_SLUG . 'doctor_job_title',
					'type'        => 'text',
					'desc'        => __( 'Add the doctor\'s job title', 'medical-toolskit' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => ''
				),
				
				array(
					'label'       => __( 'Social Network links', 'medical-toolskit' ),
					'id'          => WPL_TOOLSKIT_SLUG . 'doctor_social_network',
					'type'        => 'list-item',
					'desc'        => __( 'Press the <strong>Add New</strong> button in order to add social media links.', 'medical-toolskit' ),
					'settings'    => array(
						array(
							'label'       => __( 'URL', 'medical-toolskit' ),
							'id'          => WPL_TOOLSKIT_SLUG . 'doctor_social_network_url',
							'type'        => 'text',
							'desc'        => __( 'Enter the URL of the social network site, for example: http://www.facebook.com/stylishwp', 'medical-toolskit' ),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						), 
						array(
							'label'       => __( 'Icon', 'medical-toolskit' ),
							'id'          => WPL_TOOLSKIT_SLUG . 'doctor_social_network_icon',
							'type'        => 'text',
							'desc'        => __( 'Enter Font Awesome icon name, for example: fa-facebook, fa-twitter, fa-google-plus, fa-dribbble', 'medical-toolskit' ),
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
					'section'     => ''
				),

				array(
					'label'       => __( 'Opening times', 'medical-toolskit' ),
					'id'          => WPL_TOOLSKIT_SLUG . 'doctor_opening_times',
					'type'        => 'list-item',
					'desc'        => __( 'Press the <strong>Add New</strong> button in order to add opening hours.', 'medical-toolskit' ),
					'settings'    => array(
						array(
							'label'       => __( 'Time', 'medical-toolskit' ),
							'id'          => WPL_TOOLSKIT_SLUG . 'doctor_opening_times_time',
							'type'        => 'text',
							'desc'        => __( 'Enter the times during which you are open on this day.', 'medical-toolskit' ),
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
					'section'     => ''
				),
			)
		);

		if (Medical_Toolskit::wpl_toolskit_ot_active()) {
			ot_register_meta_box( $wpl_toolskit_doctor_meta_box );
		}
	}


	/**
	 * Add icon select to the taxonomy admin page
	 * 
	 * @since 1.0.0
	 */
	public function wpl_toolskit_doctor_taxomomy_add_new_meta_field() {
	?>
		<div class="form-field icon-picker-parent">
			<label for="term_meta[wpl_category_image]"><?php _e( 'Category icon', 'wplook' ); ?></label>
			<input type="text" name="term_meta[wpl_category_image]" id="term_meta[wpl_category_image]" class="icon-picker-input">
			<p class="description"><?php printf( __('The icon will represent the category in the front-end of the site. <br><br>You can also use icons from %1$sFont Awesome%2$s. Select an icon and use it\'s <i>class</i>, like <code>fa fa-user-md</code> in the input field.', 'medical-toolskit'), '<a href="http://fontawesome.io/icons/" target="_blank">', '</a>' ); ?></p>

			<?php Wpl_Toolskit_Common::output_icon_picker( Wpl_Toolskit_Common::return_medical_icons(), '', 'add_new_category' ); ?>
		</div>
	<?php
	}

	public function wpl_toolskit_doctor_taxomomy_edit_meta_field( $term ) {
		// put the term ID into a variable
		$t_id = $term->term_id;
		
		// retrieve the existing value(s) for this meta field. This returns an array
		$term_meta = get_option( "taxonomy_$t_id" );
	?>
		<tr class="form-field icon-picker-parent">
			<th scope="row" valign="top"><label for="term_meta[wpl_category_image]"><?php _e( 'Category icon', 'wplook' ); ?></label></th>
			<td>
				<input type="text" name="term_meta[wpl_category_image]" id="term_meta[wpl_category_image]" value="<?php echo esc_attr( $term_meta['wpl_category_image'] ) ? esc_attr( $term_meta['wpl_category_image'] ) : ''; ?>" class="icon-picker-input">
				<p class="description"><?php printf( __('The icon will represent the category in the front-end of the site. <br><br>You can also use icons from %1$sFont Awesome%2$s. Select an icon and use it\'s <i>class</i>, like <code>fa fa-user-md</code> in the input field.', 'medical-toolskit'), '<a href="http://fontawesome.io/icons/" target="_blank">', '</a>' ); ?></p>

				<?php Wpl_Toolskit_Common::output_icon_picker( Wpl_Toolskit_Common::return_medical_icons(), $term_meta['wpl_category_image'], 'edit_category' ); ?>
			</td>
		</tr>
	<?php
	}

	public function wpl_toolskit_doctor_taxomomy_save_meta_field( $term_id ) {
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
	public function wpl_toolskit_doctor_archive_posts( $query ) {

		if( $query->is_main_query() && !is_admin() && is_tax( 'wpl_doctors_category' ) ) {
			$query->set( 'posts_per_page', ot_get_option('wpl_doctors_per_page') );
		}

	}
}
?>
