<?php
/**
 * Custom Functions
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */


/*-----------------------------------------------------------------------------------*/
/*  Add CSS class to menus for submenu indicator
/*-----------------------------------------------------------------------------------*/
 
class wplook_Page_Navigation_Walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $id_field = $this->db_fields['id'];
        if ( !empty( $children_elements[ $element->$id_field ] ) ) {
            $element->classes[] = 'has-dropdown';
        }
        Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"nav-dropdown\">\n";
	}
}

/*-----------------------------------------------------------------------------------*/
/*  Page Navi - Numeric pagination
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_pagination' ) ) {
	function wplook_pagination() {

		global $wp_query;

		$big = 999999999; // need an unlikely integer

		$paginate_links = paginate_links(
			array(
				'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link($big) ) ),
				'format'       => '',
				'current'      => max( 1, get_query_var('paged') ),
				'total'        => $wp_query->max_num_pages,
				'prev_text'    => '&larr;',
				'next_text'    => '&rarr;',
				'type'         => 'list',
				'end_size'     => 3,
				'mid_size'     => 3
			)
		);
		
		$paginate_links = str_replace( "<ul>", "<ul class='pagination'>", $paginate_links );
		$paginate_links = str_replace( '<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links );
		$paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='current'><a href='#'>", $paginate_links );
		$paginate_links = str_replace( "</span>", "</a>", $paginate_links );
		$paginate_links = str_replace( "<li><a href='#'>&hellip;</a></li>", "<li><span class='dots'>&hellip;</span></li>", $paginate_links );
		$paginate_links = preg_replace( "/\s*page-numbers/", "", $paginate_links );
		// Display the pagination if more than one page is found
		if ( $paginate_links ) {
			echo '<div class="paging">';
			echo $paginate_links;
			echo '</div><!--// end .pagination -->';
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Add a container for video
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_custom_oembed_filter' ) ) {

	add_filter( 'embed_oembed_html', 'wplook_custom_oembed_filter', 10, 4 ) ;

	function wplook_custom_oembed_filter($html, $url, $attr, $post_ID) {
		$return = '<div class="video-container">'.$html.'</div>';
	    return $return;
	}
}


/*-----------------------------------------------------------
	Get taxonomies terms links
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_custom_taxonomies_terms_links' ) ) {
	
	function wplook_custom_taxonomies_terms_links() {
		global $post, $post_id;
		// get post by post id
		$post = get_post($post->ID);
		// get post type by post
		$post_type = $post->post_type;
		// get post type taxonomies
		$taxonomies = get_object_taxonomies($post_type);
		foreach ($taxonomies as $taxonomy) {
			// get the terms related to post
			$terms = get_the_terms( $post->ID, $taxonomy );
			if ( !empty( $terms ) ) {
				$out = array();
				foreach ( $terms as $term )
					$out[] = '<a href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a>';
				$return = join( ', ', $out );
			} else {
				$return = '';
			}
			return $return;
		}
	}

}

/*-----------------------------------------------------------------------------------*/
/*  Custom Password Tempalte
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_password_form' ) ) {
	function wplook_password_form() {
	global $post;
		$post = get_post( $post );
		$label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
		$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
		<p>' . __( 'This content is certainly password protected. To view it please enter your password below:', 'healthmedical-wpl' ) . '</p>
		<p><label for="' . $label . '">' . __( 'Password:', 'healthmedical-wpl' ) . ' <input name="post_password" id="' . $label . '" type="password" size="20" /></label> <input class="button tiny grey" type="submit" name="' . __( 'Submit:', 'healthmedical-wpl' ) . '" value="' . esc_attr__( 'Submit', 'healthmedical-wpl' ) . '" /></p>
		</form>
		';
	return $output;
	}
	add_filter('the_password_form','wplook_password_form');
}


/*-----------------------------------------------------------------------------------*/
/*  Display share buttons on posts
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_share_buttons' ) ) {
	
	function wplook_get_share_buttons() { ?>
		<a title="<?php _e('Facebook', 'healthmedical-wpl'); ?>" class="share-icon-fb" id="fbbutton" onclick="fbwindows('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>'); return false;"><i class="icon-facebook"></i></a> 
		<a title="<?php _e('Twitter', 'healthmedical-wpl'); ?>" class="share-icon-tw" id="twbutton" onClick="twwindows('http://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>'); return false;"><i class="icon-twitter"></i></a>
		<a title="<?php _e('Pinterest', 'healthmedical-wpl'); ?>" class="share-icon-pt" id="pinbutton" onClick="pinwindows('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=');"><i class="icon-pinterest"></i></a>
	<?php }

}


/*-----------------------------------------------------------
	Custom Tag cloud Widget
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_tag_cloud_widget' ) ) {

	function wplook_tag_cloud_widget($args) {
		$args['largest'] = 14;
		$args['smallest'] = 14;
		$args['unit'] = 'px';
		return $args;
	}
	add_filter( 'widget_tag_cloud_args', 'wplook_tag_cloud_widget' );

}


/*-----------------------------------------------------------
	Get Date
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_date' ) ) {

	function wplook_get_date() {
		the_time(get_option('date_format'));
	}

}


/*-----------------------------------------------------------
	Get Time
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_time' ) ) {

	function wplook_get_time() {
		the_time(get_option('time_format'));
	}

}


/*-----------------------------------------------------------
	Get Date and Time
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_date_time' ) ) {

	function wplook_get_date_time() {
		the_time(get_option('date_format')); 
		_e( ' at ', 'healthmedical-wpl');
		the_time(get_option('time_format'));
	}

}


/*-----------------------------------------------------------------------------------*/
/*	Trim excerpt
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_short_excerpt' ) ) {

	function wplook_short_excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		}	
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;
	}

}


/*-----------------------------------------------------------
	Display Navigation for post, pages, search
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_content_navigation' ) ) {

	function wplook_content_navigation( $nav_id ) {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="<?php echo $nav_id; ?>">
				<?php if ( get_previous_posts_link() ) { ?>
					<div class="nav-previous"><?php previous_posts_link( __( '<span class="mobile-nav">Previous</span>', 'healthmedical-wpl' ) ); ?></div>
				<?php } ?>
					
				<?php if ( get_next_posts_link() ) { ?>
					<div class="nav-next"><?php next_posts_link( __( '<span class="mobile-nav">Next</span>', 'healthmedical-wpl' ) ); ?></div>
				<?php } ?>
					<div class="clear"></div>
			</nav><!-- #nav -->
		<?php endif;
	}

}


/*-----------------------------------------------------------------------------------*/
/*	Doctitle
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_doctitle' ) ) {

	function wplook_doctitle() {

		if ( is_search() ) { 
		  $content = __('Search Results for:', 'healthmedical-wpl'); 
		  $content .= ' ' . esc_html(stripslashes(get_search_query()));
		}

		elseif ( is_day() ) {
			$content = __( '', 'healthmedical-wpl');
			$content .= ' ' . esc_html(stripslashes( get_the_date()));
		}
		
		elseif ( is_month() ) {
			$content = __( '', 'healthmedical-wpl');
			$content .= ' ' . esc_html(stripslashes( get_the_date( 'F Y' )));
		}
		elseif ( is_year()  ) {
			$content = __( '', 'healthmedical-wpl');
			$content .= ' ' . esc_html(stripslashes( get_the_date( 'Y' ) ));
		}		
		
		elseif ( is_author() ) { 
			$content = __("Author's Posts", 'healthmedical-wpl');

		}

		elseif ( is_404() ) { 
			$content = __('Page Not Found', 'healthmedical-wpl');
		}

		elseif ( is_plugin_active( 'woocommerce/woocommerce.php') && is_shop()  ) {
			$content = __('Shop', 'healthmedical-wpl');
		}
		
		else { 
			$content = '';
		}
		
		$elements = array("content" => $content);   

		// Filters should return an array
		$elements = apply_filters('wplook_doctitle', $elements);
		
		// But if they don't, it won't try to implode
			if(is_array($elements)) {
			  $doctitle = implode(' ', $elements);
			} else {
			  $doctitle = $elements;
			}

			if ( is_search() || is_day() || is_month() || is_year() || is_404() || is_author() ) {
				$doctitle = $doctitle;
			}

		echo $doctitle;

	} 
}


/*-----------------------------------------------------------
	Add custom Colors to the theme
-----------------------------------------------------------*/

add_action( 'customize_register', 'wplook_customize_colors' );
function wplook_customize_colors($wp_customize) {
	
	$colors = array();
	$colors[] = array( 'slug'=>'wpl_link_color', 'default' => '#117dbf', 'label' => __( 'Link color', 'healthmedical-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_hover_link_color', 'default' => '#117dbf', 'label' => __( 'Hover link color', 'healthmedical-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_accent_color', 'default' => '#51b8f2', 'label' => __( 'Accent color', 'healthmedical-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_accent_color2', 'default' => '#7f64b5', 'label' => __( 'Accent color 2', 'healthmedical-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_footer_background', 'default' => '#54667a', 'label' => __( 'Footer Background', 'healthmedical-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );

	foreach($colors as $color) {
		add_option( $color['slug'], $color['default'] );
		// SETTINGS
		$wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ));
		// CONTROLS
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'colors', 'settings' => $color['slug'] )));
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Print Custom Color Styles
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_print_custom_color_style' ) ) {

	function wplook_print_custom_color_style() { ?>
		<?php
			$link_color = get_option('wpl_link_color');
			$hover_link_color = get_option('wpl_hover_link_color');
			$accent_color = get_option('wpl_accent_color');
			$accent_color2 = get_option('wpl_accent_color2');
			$footer_background = get_option('wpl_footer_background');
		?>
		<style>
			a { color: <?php echo esc_html($link_color); ?>; }
			a:hover, a:focus { color: <?php echo esc_html($hover_link_color); ?>;}

			/* Accent Color */
			.header .button, .intro-slider .slide-caption > h5, .intro-small .intro-caption h5, .doctor-name, .ad, .event-date, .paging .current a, .paging li:hover a,
			.section-updates .section-actions .button, .form-appointment .form-actions .button, .subscribe-btn, .widget_wplook_book_appointment_widget, .widget_search, .widget_form, .form-submit .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt,
			.woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover  { background: <?php echo esc_html($accent_color); ?>; }
			.intro-slider .slide-caption-inner, .intro-small .intro-caption h2, .doctor-box, .event-box { border-left-color: <?php echo esc_html($accent_color); ?>; }
			.intro-slider .slide-caption-inner a, .doctor-box a, .event-body > .fa, .format-blockquote blockquote .fa, .section-testimonials .section-head .fa, .woocommerce .woocommerce-result-count { color: <?php echo esc_html($accent_color); ?>; }

			/* Accent Color2  */
			.page-template-template-homepage .list-services li + li:before { background-color: #fff; }
			.page-template-template-homepage .tab-head, .page-template-template-homepage .section-services .section-head, .page-template-template-homepage .section-departments .section-ribbon { background-color: <?php echo esc_html($accent_color2); ?>!important; }
			.page-template-template-homepage .section-departments .section-ribbon:before { border-color: transparent transparent <?php echo esc_html($accent_color2); ?> transparent; }

			.intro.no-bg-img, .doctor-program, .mejs-inner, .mejs-container, .mejs-embed, .mejs-embed body, .mejs-container .mejs-controls, .woocommerce span.onsale, .woocommerce ul.products li.product .button:hover, .cart-status:hover { background: <?php echo esc_html($accent_color2); ?>!important; }
			.list-services-alt li:hover a, .list-services-alt .current a, .list-services-alt .current [class^="icon-"], .list-services-alt .current .fa, .list-services-alt li:hover [class^="icon-"], .list-services-alt li:hover .fa,
			.section-ribbon i, .list-event-meta a.link, .event h3, .woocommerce .star-rating span, .cart-status a, .cart-status i { color: <?php echo esc_html($accent_color2); ?>!important; }
			.article-single-event blockquote { border-left-color: <?php echo esc_html($accent_color2); ?>; }
			.woocommerce ul.products li.product .button, .woocommerce ul.products li.product .button:hover { border-color: <?php echo esc_html($accent_color2); ?> }
			.slider-home .slide-body .columns:after, .footer-section-alt::before, .main-head-content .columns::before, .no-main-image, .team-tile-image::after, .service-tile-image::after, .project-tile-image::after, .news-tile-image::after, .section-quote .section-image::after, .section-project .section-head-content .columns::before, .section-project .section-head-actions .scroll-down { background: <?php echo esc_html($accent_color); ?>;}
			.footer { background: <?php echo esc_html($footer_background); ?>;}
		</style>
	<?php }
	if (get_option('wpl_link_color')) {
		add_action( 'wp_head', 'wplook_print_custom_color_style' );
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Custom CSS
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_custom_css' ) ) {

	function wplook_custom_css() {
		$wpl_css = ot_get_option('wpl_css');
		if ($wpl_css) {
			echo "<style>";
			echo esc_html($wpl_css);
			echo "</style>";
		}
			
	}
	add_action( 'wp_head', 'wplook_custom_css' );

}
/*-----------------------------------------------------------------------------------*/
/*	Custom Favicon
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_custom_favicon' ) ) {
	
	function wplook_custom_favicon() {
		$wplook_favicon = ot_get_option('wpl_favicon');

		if ( $wplook_favicon ) {
			$fav = '';
			$fav .= '<link rel="shortcut icon" href="'. $wplook_favicon .'" type="image/x-icon"/>';
			echo $fav;
		}
			
	}
	add_action( 'wp_head', 'wplook_custom_favicon' );

}

/*-----------------------------------------------------------------------------------*/
/*	BE Dashbord Widget
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_dashboard_widgets' ) ) {

	function wplook_dashboard_widgets() {
		global $wp_meta_boxes;
		unset(
			$wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
		);
			wp_add_dashboard_widget( 'dashboard_custom_feed', '<a href="https://wplook.com?utm_source=Our-Themes&utm_medium=rss&utm_campaign=Health-Medical">WPlook News</a>' , 'wplook_dashboard_custom_feed_output' );
	}
	add_action('wp_dashboard_setup', 'wplook_dashboard_widgets');
}


if ( ! function_exists( 'wplook_dashboard_custom_feed_output' ) ) {

	function wplook_dashboard_custom_feed_output() {
		echo '<div class="rss-widget rss-wplook">';
		wp_widget_rss_output(array(
			'url' => 'http://feeds.feedburner.com/wplook',
			'title' => '',
			'items' => 5,
			'show_summary' => 1,
			'show_author' => 0,
			'show_date' => 1
			));
		echo '</div>';
	}
}

if ( ! function_exists( 'wplook_bar_menu' ) ):

	function wplook_bar_menu() {
		global $wp_admin_bar;
		if ( !is_super_admin() || !is_admin_bar_showing() )
			return;
		$admin_dir = get_admin_url();

		$wp_admin_bar->add_menu( 
			array(
				'id' => 'custom_menu',
				'title' => __( 'WPlook Panel', 'healthmedical-wpl' ),
				'href' => FALSE,
				'meta' => array('title' => 'WPlook Options Panel', 'class' => 'wplookpanel') 
			) 
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wplook_theme_options',
				'parent' => 'custom_menu',
				'title' => __( 'Theme Options', 'healthmedical-wpl' ),
				'href' => $admin_dir .'themes.php?page=ot-theme-options',
				'meta' => array('title' => 'Theme Option') 
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wplook_custom_support',
				'parent' => 'custom_menu',
				'title' => __( 'Support', 'healthmedical-wpl' ),
				'href' => 'https://wplook.com/help/?utm_source=Support&utm_medium=link&utm_campaign=Health-Medical',
				'meta' => array('title' => 'Support') 
			)
		);


		$wp_admin_bar->add_menu(
			array(
				'id' => 'wplook_themes',
				'parent' => 'custom_menu',
				'title' => __( 'More Themes', 'healthmedical-wpl' ),
				'href' => 'https://wplook.com/wordpress/themes/?utm_source=Our-Themes&utm_medium=link&utm_campaign=Health-Medical',
				'meta' => array('title' => 'Our Themes')
				)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wplook_facebook',
				'parent' => 'custom_menu',
				'title' => __( 'Become our fan on Facebook', 'healthmedical-wpl' ),
				'href' => 'http://www.facebook.com/wplookthemes',
				'meta' => array('target' => 'blank', 'title' => 'Become our fan on Facebook') 
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wplook_twitter',
				'parent' => 'custom_menu',
				'title' => __( 'Follow us on Twitter', 'healthmedical-wpl' ),
				'href' => 'http://twitter.com/#!/wplook',
				'meta' => array('target' => 'blank', 'title' => 'Follow us on Twitter')
			)
		);
	}
	add_action('admin_bar_menu', 'wplook_bar_menu', '1000');
endif;



/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Staff
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'add_new_staff_columns' ) ) {

	function add_new_staff_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Name', 'healthmedical-wpl' ),
			'wpl_candidate_position' => __( 'Position', 'healthmedical-wpl' ),
			'wpl_candidate_phone' => __( 'Phone', 'healthmedical-wpl' ),
			'wpl_candidate_email' => __( 'Email', 'healthmedical-wpl' ),
			'date' => __( 'Date', 'healthmedical-wpl' )
		);

	return $columns;

	}
	add_filter("manage_edit-post_staff_columns", "add_new_staff_columns");

}
 

if ( ! function_exists( 'wpl_staff_columns' ) ) {

	function wpl_staff_columns( $column, $post_id ) {
		
		switch ($column) {
			

			/*-----------------------------------------------------------
				Staff: Position
			-----------------------------------------------------------*/
			case 'wpl_candidate_position' :

			$wpl_candidate_position = get_post_meta( $post_id, 'wpl_candidate_position', true );

			if ( empty( $wpl_candidate_position ) )
				echo __( 'Unknown', 'healthmedical-wpl' );

			else
				printf( __( '%s', 'healthmedical-wpl' ), $wpl_candidate_position );

			break;


			/*-----------------------------------------------------------
				Staff: Phone
			-----------------------------------------------------------*/
			case 'wpl_candidate_phone' :

			$wpl_candidate_phone = get_post_meta( $post_id, 'wpl_candidate_phone', true );

			if ( empty( $wpl_candidate_phone ) )
				echo __( 'Unknown', 'healthmedical-wpl' );

			else
				printf( __( '%s', 'healthmedical-wpl' ), $wpl_candidate_phone );

			break;
			

			/*-----------------------------------------------------------
				Staff: Email
			-----------------------------------------------------------*/
			case 'wpl_candidate_email' :

			$wpl_candidate_email = get_post_meta( $post_id, 'wpl_candidate_email', true );

			if ( empty( $wpl_candidate_email ) )
				echo __( 'Unknown', 'healthmedical-wpl' );

			else
				printf( __( '%s', 'healthmedical-wpl' ), $wpl_candidate_email );

			break;

		
		} // end switch
	}
	add_action('manage_post_staff_posts_custom_column', 'wpl_staff_columns', 10, 2);
}


/*-----------------------------------------------------------------------------------*/
/*	Generate breadcrumbs
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_breadcrumbs' ) ) {
	function wplook_breadcrumbs() {
		$showOnHome 	= '0'; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter 	= '<span class="delimiter"><i class="fa fa-angle-right"></i></span>'; // delimiter between crumbs
		
		$showCurrent 	= '1'; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$before 		= '<span class="current">'; // tag before the current crumb
		$after 		= '</span>'; // tag after the current crumb
		
		$text['home'] = __('Home','healthmedical-wpl'); // text for the 'Home' link
		$text['category'] = __('Archive for %s','healthmedical-wpl'); // text for a category page
		$text['search'] = __('Search results for: %s','healthmedical-wpl'); // text for a search results page
		$text['tag'] = __('Posts tagged %s','healthmedical-wpl'); // text for a tag page
		$text['author'] = __('Posts by %s','healthmedical-wpl'); // text for an author page
		$text['404'] = __('Error 404','healthmedical-wpl'); // text for the 404 page
		
		global $post;
		$homeLink = home_url( '/' );
		echo '<a href="' . $homeLink . '">' . $text['home'] . '</a> ';
		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			echo $delimiter . ' ' . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
		} elseif ( is_search() ) {
			echo $delimiter . ' ' . $before . sprintf($text['search'], get_search_query()) . $after;
		} elseif ( is_day() ) {
			echo $delimiter . ' ' . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ';
			echo $delimiter . ' ' . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ';
			echo $delimiter . ' ' . $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			echo $delimiter . ' ' . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ';
			echo $delimiter . ' ' . $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			echo $delimiter . ' ' . $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				//$slug = $post_type->rewrite;
				//echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
				echo $delimiter . ' ' . '<span>' . $post_type->labels->singular_name .'</span>' ;
				if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = $delimiter . ' ' . get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				if ($showCurrent == 0) $cats = preg_replace("/^(.+)\s$delimiter\s$/", "$1", $cats);
				echo $cats;
					if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}
		} elseif ( (is_plugin_active( 'woocommerce/woocommerce.php')) && is_shop() ) {
			echo $delimiter . ' ' . __('Shop','healthmedical-wpl');
		} elseif ( is_tax() ) {
			echo $delimiter . ' ' . single_cat_title();
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $delimiter . ' ' . $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			//$cat = get_the_category($parent->ID); $cat = $cat[0];
			//echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo $delimiter . ' ' . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $delimiter . ' ' . $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = $delimiter . ' ' . '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
			}
			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
		} elseif ( is_tag() ) {
			echo $delimiter . ' ' . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $delimiter . ' ' . $before . sprintf($text['author'], $userdata->display_name) . $after;
		} elseif ( is_404() ) {
			echo $delimiter . ' ' . $before . $text['404'] . $after;
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo ' ' . $delimiter . ' '; echo __('Page', 'healthmedical-wpl') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
	} // end breadcrumbs()
}


/*-----------------------------------------------------------------------------------*/
/*	Check if tab bar link matches the current taxonomy
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_check_if_current_taxonomy' ) ) {
	function wplook_check_if_current_taxonomy( $object ) {
		if( get_queried_object() && $object ) {
			$current_taxonomy = get_queried_object()->slug;

			if( $current_taxonomy == $object ) {
				echo 'current';
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Get link for "All doctors" or "All services"
/*-----------------------------------------------------------------------------------*/

if( !function_exists('wplook_get_all_cpt_link') ) {
	function wplook_get_all_cpt_link( $page_template, $theme_option ) {

		$wpl_doctors_all_link = ot_get_option( $theme_option );
		
		$args = array(
			'meta_key' => '_wp_page_template',
			'meta_value' => 'template-' . $page_template . '.php'
		);
		$wpl_doctors_fallback = get_pages( $args );

		if( !empty( $wpl_doctors_all_link ) ) {
			return esc_url( get_permalink( $wpl_doctors_all_link ) );
		} elseif ( !empty( $wpl_doctors_fallback ) ) {
			return esc_url( get_permalink( $wpl_doctors_fallback[0]->ID ) );
		} else {
			return '#';
		}

	}
}


/*-----------------------------------------------------------------------------------*/
/*	Add itemprop attribute to the comment reply link
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'comment_reply_link_itemprop' ) ) {

	function comment_reply_link_itemprop( $html ) {
		if( false === stripos( $html, 'itemprop="' ) )
			$html = str_ireplace( '<a ', '<a itemprop="replyToUrl" ', $html ); 
		return $html;
	}

	add_filter('comment_reply_link', 'comment_reply_link_itemprop', 99 );

}


/*-----------------------------------------------------------------------------------*/
/*	Generate a dropdown list of posts
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_dropdown_posts' ) ) {

	function wplook_dropdown_posts( $options, $widget_context ) {

		$defaults = array(

			'get_posts_args' => array(),
			'field_name' => '',
			'selected' => ''

		);

		$options = array_merge( $defaults, $options );
		
		$posts = get_posts( $options['get_posts_args'] );

		?>

		<?php if( !empty( $posts ) ) : ?>

			<select id="<?php echo $widget_context->get_field_id( $options['field_name'] ); ?>" name="<?php echo $widget_context->get_field_name( $options['field_name'] ); ?>">
				<?php foreach ($posts as $post) : ?>
					<option value="<?php echo $post->ID; ?>" <?php echo ( $options['selected'] == $post->ID ? 'selected' : '' ); ?>><?php echo $post->post_title; ?></option>
				<?php endforeach; ?>
			</select>

		<?php else: ?>

			<p><?php _e( 'No contact forms available.', 'healthmedical-wpl' ); ?></p>

		<?php endif; ?>

		<?php

	}

}

/*-----------------------------------------------------------------------------------*/
/*	Change jQuery UI Date Picker language default
/*-----------------------------------------------------------------------------------*/

// Translate jQuery UI Date Picker. The language file is included in headerdata.php.
// This just injects the JS code which tells jQuery UI to use the correct language.

if( !function_exists( 'wplook_datepicker_i18n' ) ) {

	function wplook_datepicker_i18n() {
		
		if( wp_script_is( 'jquery-ui-datepicker-i18n' ) ) {

			$wp_locale = get_locale();
			$wp_locale_short = substr( $wp_locale, 0, 2 );
			$available_languages = array( 'ar', 'bg', 'ca', 'cs', 'da', 'de', 'el', 'eo', 'es', 'fa', 'fi', 'fr', 'he', 'hr', 'hu', 'hy', 'id', 'is', 'it', 'ja', 'ko', 'lt', 'lv', 'ms', 'nl', 'no', 'pl', 'pt-BR', 'sk', 'sl', 'sq', 'sr-SR', 'sr', 'sv', 'tr', 'uk', 'zh-CN', 'zh-TW' );

			// Translate WP locale strings to locale strings used by jQuery UI
			if( $wp_locale == 'ru_UA' ) {
				$language = 'uk';
			} elseif( $wp_locale == 'pt_BR' ) {
				$language = 'pt-BR';
			} elseif( $wp_locale == 'sr_RS' ) {
				$language = 'sr-SR';
			} elseif( $wp_locale == 'zh_CN' ) {
				$language = 'zh-CN';
			} elseif( $wp_locale == 'zh_TW' ) {
				$language = 'zh-TW';
			} elseif( $wp_locale == 'ido' ) {
				// Language not supported by jQuery UI, but could be confused for 'id'
				$language = '';
			} elseif( $wp_locale == 'srd' ) {
				// Language not supported by jQuery UI, but could be confused for 'sr'
				$language = '';
			} elseif( $wp_locale_short == 'nb' || $wp_locale_short == 'nn' ) {
				// Two types of Norwegian in WP, just one in jQuery UI
				$language = 'no';
			} elseif ( in_array( $wp_locale_short, $available_languages ) ) {
				// More generic locale strings can just be cut and used straight away
				$language = $wp_locale_short;
			} else {
				// If all else fails, default to English
				$language = '';
			}

			echo '<script>jQuery(document).ready(function( $ ) { $.datepicker.setDefaults($.datepicker.regional["' . $language . '"]); });</script>';

		}

	}

	add_action( 'wp_footer', 'wplook_datepicker_i18n' );

}


/*-----------------------------------------------------------------------------------*/
/*	OptionTree icon picker option type
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'ot_type_wplook_icon_picker' ) ) {

	function ot_type_wplook_icon_picker( $args = array() ) {

		/* turns arguments array into variables */
		extract( $args );
		
		/* verify a description */
		$has_desc = $field_desc ? true : false;
		
		?>

		<div class="icon-picker-parent">

			<div class="format-setting type-wpl_icon_picker <?php echo ( $has_desc ? 'has-desc' : 'no-desc' ); ?>">
				<?php if( $has_desc ) : ?>
					<div class="description"><?php echo htmlspecialchars_decode( $field_desc ); ?></div>
				<?php endif; ?>
				
				<div class="format-setting-inner">
					<input type="text" name="<?php echo esc_attr( $field_name ); ?>" id="<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_attr( $field_value ); ?>" class="widefat option-tree-ui-input icon-picker-input <?php echo esc_attr( $field_class ); ?>" />
				</div>
			</div>

			<div class="icon-picker option-tree">
				<div class="icon-list">

					<?php foreach( $field_choices as $code => $name ) : ?>
						<div class="item <?php echo ( $code == $field_value ? 'selected' : '' ); ?>" data-code="<?php echo $code; ?>">
							<div class="item-wrapper">
								<div class="item-image">
									<i class="<?php echo $code; ?>"></i>
								</div>

								<span class="item-name"><?php echo $name; ?></span>
							</div>
						</div>
					<?php endforeach; ?>

				</div>

				<div class="show-more">
					<div class="background"></div>
					<button type="button" class="button show-more-button"><?php _e( 'Show all icons', 'healthmedical-wpl' ); ?></button>
				</div>
			</div>

		</div>

		<?php
	}

}

// Register the type with OptionTree
if( !function_exists( 'wplook_register_ot_custom_types' ) ) {

	function wplook_register_ot_custom_types( $types ) {

		$types['wplook_icon_picker'] = __( 'Icon Picker', 'healthmedical-wpl' );

		return $types;

	}

	add_filter( 'ot_option_types_array', 'wplook_register_ot_custom_types' );

}


/*-----------------------------------------------------------------------------------*/
/*  Remove colour from Google Web Fonts options for body and headings
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_optiontree_typography_colours_filter' ) ) {

	function wplook_optiontree_typography_colours_filter( $array, $field_id ) {

		if( $field_id == 'wpl_fonts_body' || $field_id == 'wpl_fonts_heading' ) {

			$array = array_diff( $array, array( 'font-color' ) );

		}

		return $array;

	}

	add_filter( 'ot_recognized_typography_fields', 'wplook_optiontree_typography_colours_filter', 10, 2 );

}


/*-----------------------------------------------------------------------------------*/
/*  Echo CSS for custom fonts function
/*
/*  This function is used to enter the correct CSS for typography elements defined
/*  in OptionTree. It takes a CSS selector as $selector and an OT ID as $ot_option_id.
/*  Every option must also be accompanied by an option with the same name, but ending
/*  in _bool.
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_optiontree_typography_echo_font' ) ) {

	function wplook_optiontree_typography_echo_font( $selector, $ot_option_id ) {

		$font = ot_get_option( $ot_option_id );

		if( ot_get_option( $ot_option_id . '_bool' ) == 'on' ) : ?>

			<style id="<?php echo $ot_option_id . '_style'; ?>">

				<?php echo $selector; ?> {

					<?php foreach( $font as $attribute => $value ) {

						if( $attribute == 'font-family' ) {
							$google_fonts = get_theme_mod( 'ot_google_fonts', array() ); // Get list of all available Google Fonts

							if( array_key_exists( $value, $google_fonts ) ) {
								echo 'font-family: "' . $google_fonts[$value]['family'] . '", sans-serif; '; // Find the correct font-family name in said list
							} else {
								echo 'font-family: ' . $value . ', sans-serif; '; // Output the font name as is
							}
						} elseif( !empty( $value ) ) {
							echo $attribute . ': ' . $value . '; '; // Echo all other attributes
						}

					} ?>

				}

			</style>

		<?php endif;

	}

}


/*-----------------------------------------------------------------------------------*/
/*  Echo CSS for defined custom fonts
/*
/*  This is where the above function is used to actually output the CSS
/*  based on the function variables entered here
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_optiontree_typography_echo_fonts' ) ) {

	function wplook_optiontree_typography_echo_fonts() {

		wplook_optiontree_typography_echo_font( 'body, p, cite, .paging a, h4 a, li p a, .doctor-name, h6, .section-testimonials .section-head h6, .breadcrumbs span, .breadcrumbs a, .list-work-times p span + span, .header-bar p', 'wpl_fonts_body' );
		wplook_optiontree_typography_echo_font( 'h1, h2, h3, h4, h5, .service-benefits h3, .widget_posts .post-small-content a, .section-about-us-bg .section-about-us h3', 'wpl_fonts_heading' );		
		wplook_optiontree_typography_echo_font( 'nav.nav, nav.nav a', 'wpl_fonts_menu' );		

	}

	add_action( 'wp_head', 'wplook_optiontree_typography_echo_fonts', 100 );

}


/*-----------------------------------------------------------------------------------*/
/*  List available icons for the icon pickers
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_return_medical_icon_array' ) ) {

	function wplook_return_medical_icon_array() {

		$icons = array(
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

		return $icons;

	}

}


/*-----------------------------------------------------------------------------------*/
/*  Return HTML for an icon picker
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_return_icon_picker' ) ) {

	function wplook_return_icon_picker( $field_choices = array(), $field_value, $location ) {

		ob_start();
		?>

			<div class="icon-picker <?php echo ( !empty( $location ) ? $location : 'plugin-location' ); ?>">
				<div class="icon-list">

					<?php foreach( $field_choices as $code => $name ) : ?>
						<div class="item <?php echo ( $code == $field_value ? 'selected' : '' ); ?>" data-code="<?php echo $code; ?>">
							<div class="item-wrapper">
								<div class="item-image">
									<i class="<?php echo $code; ?>"></i>
								</div>

								<span class="item-name"><?php echo $name; ?></span>
							</div>
						</div>
					<?php endforeach; ?>

				</div>

				<div class="show-more">
					<div class="background"></div>
					<button type="button" class="button show-more-button"><?php _e( 'Show all icons', 'healthmedical-wpl' ); ?></button>
				</div>
			</div>

		<?php
		return ob_get_clean();

	}

}

?>
