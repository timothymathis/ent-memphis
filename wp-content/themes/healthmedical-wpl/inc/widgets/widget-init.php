<?php 
/**
 * Register widgets and widget areas
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */


/*-----------------------------------------------------------
	Include Widgets
-----------------------------------------------------------*/

// Initiate sidebar/footer widgets
get_template_part( '/inc/widgets/widget', 'businesshours' );
get_template_part( '/inc/widgets/widget', 'contact-details' );
get_template_part( '/inc/widgets/widget', 'contact' );
get_template_part( '/inc/widgets/widget', 'departments' );
get_template_part( '/inc/widgets/widget', 'newsletter' );
get_template_part( '/inc/widgets/widget', 'posts' );
get_template_part( '/inc/widgets/widget', 'social' );

// Initiate front page widgets
get_template_part( '/inc/widgets/widget', 'about-home' );
get_template_part( '/inc/widgets/widget', 'departments-home' );
get_template_part( '/inc/widgets/widget', 'doctors-home' );
get_template_part( '/inc/widgets/widget', 'posts-home' );
get_template_part( '/inc/widgets/widget', 'services-home' );
get_template_part( '/inc/widgets/widget', 'testimonials-home' );
get_template_part( '/inc/widgets/widget', 'cf7-home' );


function wplook_widgets_init() {

	/*-----------------------------------------------------------
		Home page widget areas
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Home page widget area', 'healthmedical-wpl' ),
		'id' => 'homepage-top',
		'description' => __('Widgets in this area will be shown only on the Home Page Template. This is a full width widget.','healthmedical-wpl' ),
		'before_widget' => '<div id="%1$s" class="front-page-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	) );


	/*-----------------------------------------------------------
		Pages widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Page Widget area', 'healthmedical-wpl' ),
		'id' => 'page-1',
		'description' => __('Widgets in this area will be shown on all Pages.','healthmedical-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget widget-sidebar %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3 class="widgettitle">',
		'after_title' => '</h3></div>'
	) );
	

	/*-----------------------------------------------------------
		Posts Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Blog Widget area', 'healthmedical-wpl' ),
		'id' => 'post-1',
		'description' => __('Widgets in this area will be shown on all Posts.','healthmedical-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget widget-sidebar %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3 class="widgettitle">',
		'after_title' => '</h3></div>'
	) );


	/*-----------------------------------------------------------
		Services Widget area
	-----------------------------------------------------------*/
		
	register_sidebar( array(
		'name' => __( 'Services Widget area', 'healthmedical-wpl' ),
		'id' => 'services-1',
		'description' => __('Widgets in this area will be shown on all Services.','healthmedical-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget widget-sidebar %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3 class="widgettitle">',
		'after_title' => '</h3></div>'
	) );


	/*-----------------------------------------------------------
		Doctors widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Doctors Widget area', 'healthmedical-wpl' ),
		'id' => 'doctors-1',
		'description' => __('Widgets in this area will be shown on all Doctors pages.','healthmedical-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget widget-sidebar %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3 class="widgettitle">',
		'after_title' => '</h3></div>'
	) );



	/*-----------------------------------------------------------
		Shopping widget area
	-----------------------------------------------------------*/

	if(is_plugin_active( 'woocommerce/woocommerce.php')) {
		register_sidebar( array(
			'name' => __( 'Shopping Widget area', 'healthmedical-wpl' ),
			'id' => 'shop-1',
			'description' => __('Widgets in this area will be shown on shop section.','healthmedical-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget widget-sidebar %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3 class="widgettitle">',
			'after_title' => '</h3><div class="clear"></div></div>'
		) );
	}


	/*-----------------------------------------------------------
		Footer Widget areas
	-----------------------------------------------------------*/

	$footer_sidebars = ot_get_option( 'wpl_footer_sidebars', 4 );

	if ( $footer_sidebars == 1 ) {
		$footer_before_class = 'large-12';
	} elseif ( $footer_sidebars == 2 ) {
		$footer_before_class = 'large-6';
	} elseif ( $footer_sidebars == 3 ) {
		$footer_before_class = 'large-4';
	} else {
		$footer_before_class = 'large-3';
	};

	if( $footer_sidebars >= 1 ) {
		register_sidebar( array(
			'name' => __( 'First Footer Widget Area', 'healthmedical-wpl' ),
			'id' => 'f1-widgets',
			'description' => __( 'The first footer widget area', 'healthmedical-wpl' ),
			'before_widget' => '<section id="%1$s" class="columns ' . $footer_before_class . ' medium-12 widget-footer %2$s">',
			'after_widget' => "</section>",
			'before_title' => '<div class="footer-section-head"><h5 class="footer-section-title">',
			'after_title' => '</h5></div>'
		) );
	}
	
	if( $footer_sidebars >= 2 ) {
		register_sidebar( array(
			'name' => __( 'Second Footer Widget Area', 'healthmedical-wpl' ),
			'id' => 'f2-widgets',
			'description' => __( 'The second footer widget area', 'healthmedical-wpl' ),
			'before_widget' => '<section id="%1$s" class="columns ' . $footer_before_class . ' medium-12 widget-footer %2$s">',
			'after_widget' => "</section>",
			'before_title' => '<div class="footer-section-head"><h5 class="footer-section-title">',
			'after_title' => '</h5></div>'
		) );
	}
	
	if( $footer_sidebars >= 3 ) {
		register_sidebar( array(
			'name' => __( 'Third Footer Widget Area', 'healthmedical-wpl' ),
			'id' => 'f3-widgets',
			'description' => __( 'The third footer widget area', 'healthmedical-wpl' ),
			'before_widget' => '<section id="%1$s" class="columns ' . $footer_before_class . ' medium-12 widget-footer %2$s">',
			'after_widget' => "</section>",
			'before_title' => '<div class="footer-section-head"><h5 class="footer-section-title">',
			'after_title' => '</h5></div>'
		) );
	}
	
	if( $footer_sidebars >= 4 ) {
		register_sidebar( array(
			'name' => __( 'Fourth Footer Widget Area', 'healthmedical-wpl' ),
			'id' => 'f4-widgets',
			'description' => __( 'The fourth footer widget area', 'healthmedical-wpl' ),
			'before_widget' => '<section id="%1$s" class="columns ' . $footer_before_class . ' medium-12 widget-footer %2$s">',
			'after_widget' => "</section>",
			'before_title' => '<div class="footer-section-head"><h5 class="footer-section-title">',
			'after_title' => '</h5></div>'
		) );
	}

	/*-----------------------------------------------------------
		Custom sidebars
	-----------------------------------------------------------*/

	$wpl_multiple_sidebars = ot_get_option( 'wpl_multiple_sidebars', array() ); 
	if( $wpl_multiple_sidebars ) :
		
		foreach( $wpl_multiple_sidebars as $item ) :
			$name = $item['wpl_widget_area_name'];
			$widget_id = $item['wpl_widget_area_id'];
			$description = $item['wpl_widget_area_description'];

			register_sidebar( array(
				'name' => $name,
				'id' => $widget_id,
				'description' => $description,
				'before_widget' => '<aside id="%1$s" class="widget widget-sidebar %2$s">',
				'after_widget' => "</aside>",
				'before_title' => '<div class="widget-title"><h3 class="widgettitle">',
				'after_title' => '</h3></div>'
			) );
		endforeach;
	endif;
}
/** Register sidebars */
add_action( 'widgets_init', 'wplook_widgets_init' );
?>
