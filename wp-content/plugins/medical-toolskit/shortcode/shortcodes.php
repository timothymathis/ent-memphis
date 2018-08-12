<?php
/**
 * The default Shortcode Functions
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0
 */

// [row]
if (!function_exists('shortcode_row')) {
	function shortcode_row($params = array(), $content = null) {  
		extract(shortcode_atts(array(
			'bg_color' => '',
			'bg_image' => '',
			'bg_repeat' => 'no-repeat',
			'bg_size' => '',
			'text_color' => '',
			'text_align' => '',
			'padding' => ''
		), $params));

		// init variables
		$html = '';
		$style = '';
		$content = do_shortcode($content);

		if($bg_image != "") {
			$style .= "background: url('".$bg_image."') ".$bg_repeat." 0 0;";
		}

		if($bg_color != "") {
			$style .= "background-color: ".$bg_color.";";
		}

		if($bg_size != "") {
			$style .= "background-size: ".$bg_size.";";
		}

		if($text_color != "") {
			$style .= "color: ".$text_color.";";
		}

		if($text_align != "") {
			$style .= "text-align: ".$text_align.";";
		}

		if($padding != "") {
			$style .= "padding: ".$padding.";";
		}

		$html .= '<div class="row grey" style="' .$style. '">';
		$html .= ' '.$content.' ';
		$html .= '</div>';

		return $html;
	}
	add_shortcode('row', 'shortcode_row');
}


// [one_half]
if (!function_exists('shortcode_grid_one_half')) {
	function shortcode_grid_one_half($params = array(), $content = null) { 
		extract(shortcode_atts(array(
		   'bg_color' => '',
		   'padding' => '',
		   'last' => '',
		), $params));

		// init variables
		$html = '';
		$style = '';
		$content = do_shortcode($content);

		if($bg_color != "") {
			$style .= "background-color: ".$bg_color.";";
		}

		if($padding != "") {
			$style .= "padding: ".$padding.";";
		}

		if ( $last == 'yes' ) {
			$html .= '<div class="large-6 columns end" style="' .$style. '">';
			$html .= ' '.$content.' ';
			$html .= '</div>';
		} else {
			$html .= '<div class="large-6 columns" style="' .$style. '">';
			$html .= ' '.$content.' ';
			$html .= '</div>';        
		}
		
		return $html;
	}
	add_shortcode('one_half', 'shortcode_grid_one_half');
}


// [one_third]
if (!function_exists('shortcode_grid_one_third')) {
	function shortcode_grid_one_third($params = array(), $content = null) {   
		extract(shortcode_atts(array(
			'bg_color' => '',
			'padding' => '',
			'last' => ''
		), $params));

		// init variables
		$html = '';
		$style = '';
		$content = do_shortcode($content); 

		if($bg_color != "") {
			$style .= "background-color: ".$bg_color.";";
		}

		if($padding != "") {
			$style .= "padding: ".$padding.";";
		}
		
		if ( $last == 'yes' ) {
			$html .= '<div class="large-4 columns end" style="' .$style. '">'.$content.'</div><div class="cf"></div>';
		} else {
			$html .= '<div class="large-4 columns" style="' .$style. '">'.$content.'</div>';
		}

		return $html;
	}
	add_shortcode('one_third', 'shortcode_grid_one_third');
}


// [two_third]
if (!function_exists('shortcode_grid_two_third')) {
	function shortcode_grid_two_third($params = array(), $content = null) { 
		extract(shortcode_atts(array(
			'bg_color' => '',
			'padding' => '',
			'last' => '',
		), $params));

		// init variables
		$html = '';
		$style = '';
		$content = do_shortcode($content);

		if($bg_color != "") {
			$style .= "background-color: ".$bg_color.";";
		}

		if($padding != "") {
			$style .= "padding: ".$padding.";";
		}
		
		if ( $last == 'yes' ) {
			$html .= '<div class="large-8 columns end" style="' .$style. '">'.$content.'</div><div class="cf"></div>';
		} else {
			$html .= '<div class="large-8 columns" style="' .$style. '">'.$content.'</div>';
		}
		
	   return $html;
	}
	add_shortcode('two_third', 'shortcode_grid_two_third');
}


// [one_fourth]
if (!function_exists('shortcode_grid_one_fourth')) {
	function shortcode_grid_one_fourth($params = array(), $content = null) {   
		extract(shortcode_atts(array(
			'bg_color' => '',
			'padding' => '',
			'last' => '',
		), $params));

		// init variables
		$html = '';
		$style = '';
		$content = do_shortcode($content);

		if($bg_color != "") {
			$style .= "background-color: ".$bg_color.";";
		}

		if($padding != "") {
			$style .= "padding: ".$padding.";";
		}
		
		if ( $last == 'yes' ) {
			$html .= '<div class="large-3 columns end" style="' .$style. '">'.$content.'</div><div class="cf"></div>';
		} else {
			$html .= '<div class="large-3 columns" style="' .$style. '">'.$content.'</div>';
		}

		return $html;
	}
	add_shortcode('one_fourth', 'shortcode_grid_one_fourth');
}


// [three_fourth]
if (!function_exists('shortcode_grid_three_fourth')) {
	function shortcode_grid_three_fourth($params = array(), $content = null) {   
		extract(shortcode_atts(array(
			'bg_color' => '',
			'padding' => '',
			'last' => '',
		), $params));

		// init variables
		$html = '';
		$style = '';
		$content = do_shortcode($content);

		if($bg_color != "") {
			$style .= "background-color: ".$bg_color.";";
		}

		if($padding != "") {
			$style .= "padding: ".$padding.";";
		}
		
		if ( $last == 'yes' ) {
			$html .= '<div class="large-9 columns end" style="' .$style. '">'.$content.'</div><div class="cf"></div>';
		} else {
			$html .= '<div class="large-9 columns" style="' .$style. '">'.$content.'</div>';
		}

		return $html;
	}
	add_shortcode('three_fourth', 'shortcode_grid_three_fourth');
}


// [heading_block]
if (!function_exists('shortcode_heading_block')) {
	function shortcode_heading_block($params = array(), $content = null) {
		extract(shortcode_atts(array(
			'bg_color' => '',
			'bg_image' => '',
			'text_align' => '',
			'text_color' => '',
			'text_size' => '',
			'font_weight' => ''
		), $params));

		// init variables
		$html = '';
		$headingstyle = '';
		$divstyle = '';
		$content = do_shortcode($content);

		if($bg_color != "") {
			$divstyle .= 'background: '.$bg_color.';';
		}

		if($bg_image != "") {
			$divstyle .= 'background: '.$bg_color.' url('.$bg_image.');';
		}

		if($text_align != "") {
			$divstyle .= 'text-align: '.$text_align.';';
		}

		if($text_color != "") {
			$headingstyle .= 'color: '.$text_color.';';
		}

		if($text_size != "") {
			$headingstyle .= 'font-size: '.$text_size.';';
		}

		if($font_weight != "") {
			$headingstyle .= 'font-weight: '.$font_weight.';';
		}

		$html .= '<div class="shortcode_heading_block" style="'.$divstyle. '">';
		$html .= '<h1 style="'.$headingstyle. '">'.$content.'</h1>';
		$html .= '</div>';

		return $html;
	}
	add_shortcode('heading_block', 'shortcode_heading_block');
}


// [text_block]
if (!function_exists('shortcode_text_block')) {
	function shortcode_text_block($params = array(), $content = null) {
		extract(shortcode_atts(array(
			'title_tag' => 'h1',
			'title' => 'Title',
			'title_color' => '#1c1c1e',
			'bg_color' => '#fff',
			'bg_image' => '',
			'text_color' => '#9c9d9f',
			'sep_padding' => '5px',
			'sep_color' => '#1c1c1e',
			'padding_top' => '',
			'padding_bottom' => ''
		), $params));

		$headings_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');         
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

		// init variables
		$html               = "";
		$style              = "";
		$style_title        = "";
		$content = do_shortcode($content);

		if($title_color != "") {
			$style_title .= 'color: '.$title_color.';';
		}

		if($bg_color != "") {
			$style .= 'background: '.$bg_color.';';
		}

		if($bg_image != "") {
			$style .= 'background-image: url('.$bg_image.');';
		}

		if($padding_top != "") {
			$style .= 'padding-top: '.$padding_top.';';
		}

		if($padding_bottom != "") {
			$style .= 'padding-bottom: '.$padding_bottom.';';
		}

		$html .= '<div class="shortcode_text_block" style="'.$style.'">';
			$html .= '<'.$title_tag.' class="title" style="'.$style_title.'">'.$title.'</'.$title_tag.'>';
			$html .= '<div class="text_block_sep" style="margin:'.$sep_padding.' auto; background-color:'.$sep_color.';"></div>';
			$html .= '<p style="color:'.$text_color.'">'.$content.'</p>';
		$html .= '</div>';
		
		return $html;
	}
	add_shortcode('text_block', 'shortcode_text_block');
}

// [button]
if (!function_exists('shortcode_button')) {
	function shortcode_button($atts, $content = null) {           
		$args = array(
			"type"                      => "",
			"text"                      => "",
			"text_color"                => "",
			"icon"                      => "",
			"icon_color"                => "",
			"link"                      => "",
			"target"                    => "_self",
			"font_style"                => "",
			"font_weight"               => "",
			"align"                     => "",
			"margin"                    => ""
		);    
		extract(shortcode_atts($args, $atts));
			
		if($target == ""){
			$target = "_self";
		}
			
		//init variables
		$html  = "";
		$button_classes = "button ";
		$button_styles  = "";
		$add_icon       = "";
		
		if($type != "") {
			$button_classes .= " {$type}";
		}

		if($align != "") {
			$button_classes .= " {$align}";
		}

		

		if($text_color != ""){
			$button_styles .= 'color: '.$text_color.'; ';
		}

		if($font_style != ""){
			$button_styles .= 'font-style: '.$font_style.'; ';
		}

		if($font_weight != ""){
			$button_styles .= 'font-weight: '.$font_weight.'; ';
		}

		if($icon != ""){
			$icon_style = "";
			if($icon_color != ""){
				$icon_style .= 'color: '.$icon_color.';';
			}
			$add_icon .= '<i class="fa fa-fx '.$icon.'" style="'.$icon_style.'"></i>';
		}
		
		if($margin != ""){
			$button_styles .= 'margin: '.$margin.'; ';
		}
				
		$html .=  '<a href="'.$link.'" target="'.$target.'" class="'.$button_classes.'" style="'.$button_styles.'">'.$text.$add_icon.'</a>';

		return $html;
	}
	add_shortcode('button', 'shortcode_button');
}

// [list]
if(!function_exists('shortcode_list')) {
	function shortcode_list($atts, $content = null) {
		$default_atts = array(
			"type"          => "circle",
		);

		extract(shortcode_atts($default_atts, $atts));

		// init variables
		$html = "";
		$content = do_shortcode($content);

		$html .= '<ul class="' .$type. '">';
		$html .= ''.$content.'';
		$html .= '</ul>';

		return $html;
	}
	add_shortcode('list', 'shortcode_list');
}

// [Headline]
if(!function_exists('shortcode_headline')) {
	function shortcode_headline($atts, $content = null) {
		$default_atts = array(
			"class"          => "section-default-title inside-content",
		);

		extract(shortcode_atts($default_atts, $atts));

		// init variables
		$html = "";
		$content = do_shortcode($content);

		$html .= '<h3 class="' .$class. '">';
		$html .= ''.$content.'';
		$html .= '</h3>';

		return $html;
	}
	add_shortcode('headline', 'shortcode_headline');
}

// [spacer]
if (!function_exists('shortcode_spacer')) {
	function shortcode_spacer($params = array(), $content = null) {
		extract(shortcode_atts(array(
			'top' => '0px',
			'bottom' => '0px'
		), $params));

		// init variables
		$html = '';

		$html .= '<div class="clear" style="margin-top:'.$top.';margin-bottom:'.$bottom.'"></div>';
		return $html;
	}
	add_shortcode('spacer', 'shortcode_spacer');
}


// [lead]
if (!function_exists('shortcode_lead')) {
	function shortcode_lead($params = array(), $content = null) {
		extract(shortcode_atts(array(
			'text_color' => ''
		), $params));
		
		// init variables
		$html = '';    
		$style = '';
		$content = do_shortcode($content);

		if($text_color != ""){
			$style = "style='color: ".$text_color.";'";
		}

		$html .= '<p class="lead" '.$style.'>'.$content.'</p>';
		return $html;
	}
	add_shortcode('lead', 'shortcode_lead');
}

// [highlight]
if (!function_exists('shortcode_highlight')) {
	function shortcode_highlight($params = array(), $content = null) {

		// init variables
		$html = '';
		$content = do_shortcode($content);

		$html .= '<span class="shortcode_highlight">'.$content.'</span>';
		return $html;
	}
	add_shortcode('highlight', 'shortcode_highlight');
}


// [padding]
if (!function_exists('shortcode_padding')) {
	function shortcode_padding($params = array(), $content = null) {
		extract(shortcode_atts(array(
			'top' => '8%',
			'bottom' => '8%',
			'left' => '8%',
			'right' => '8%'
		), $params));

		// init variables
		$html = '';
		$style = '';
		$content = do_shortcode($content);

		if($top != "") {
			$style .= "padding-top: ".$top.";";
		}

		if($bottom != "") {
			$style .= "padding-bottom: ".$bottom.";";
		}

		if($left != "") {
			$style .= "padding-left: ".$left.";";
		}

		if($right != "") {
			$style .= "padding-right: ".$right.";";
		}

		$html .= '<div class="shortcode_padding" style="' .$style. '">';
		$html .= ' '.$content.' ';
		$html .= '</div>';
		
		return $html;
	}
	add_shortcode('padding', 'shortcode_padding');
}


// [map]
if (!function_exists('shortcode_map')) {
	function shortcode_map ($params = array(), $content = null) {
		extract(shortcode_atts(array(           
			'address' => '',
			'height' => '400',
			'zoom' => '15',
			'saturation' => '0',
			'lightness' => '0',
			'hue' => ''
		), $params));

		// init variables
		$html = '';

		if ($address) {
			
			$rand = rand( 0, 9999 );
			$html .= '

			<div id="map_canvas-'. $rand .'" class="google-map" style="height: '. $height .'px;"></div>
			
			<script type="text/javascript">
				jQuery(document).ready(function($) {

					var siteStyles = [
						{
						  featureType: "all",
						  stylers: [
							{ saturation: '.$saturation.' },
							{ lightness: '.$lightness.' },
							{ hue: "'.$hue.'" }
						  ]
						},
					];

					var mapOptions = {
						zoom: '. $zoom .',
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						disableDefaultUI: true,
						scrollwheel: false,
						styles: siteStyles
					}
					
					var map = new google.maps.Map(document.getElementById("map_canvas-'. $rand .'"), mapOptions);                   
					
					geocoder = new google.maps.Geocoder();
					var address = "'. $address .'";
					geocoder.geocode( { "address": address }, 
						function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								map.setCenter(results[0].geometry.location);
								var marker = new google.maps.Marker({
									map: map, 
									position: results[0].geometry.location
								});
							}
						});
				});
			</script>';

			return $html;
			
		}

	}
	add_shortcode('map', 'shortcode_map');
}


/**
 * Filters
 */

if ( !function_exists( 'remove_wautop' ) ) {
	function remove_wautop( $content ) {
		$content = do_shortcode( shortcode_unautop( $content ) );
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
		return $content;	
	}
}

function empty_tag_fix( $content ) {
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']',
		']<br />' => ']'
	);

	$content = strtr( $content, $array );
	return $content;
}
add_filter( 'the_content', 'empty_tag_fix' );

/**
 * Add Shortcode within the WP Editor
 */
function add_sc_select(){
	global $shortcode_tags;
	 /* ------------------------------------- */
	 /* enter names of shortcode to exclude bellow */
	 /* ------------------------------------- */
	$exclude = array("caption", "gallery", "playlist", "embed", "wp_caption", "audio", "video", "acf");
	echo ' <select id="sc_select" class="sc_select"><option>Shortcodes</option>';
	foreach ($shortcode_tags as $key => $val){
			if(!in_array($key,$exclude)){
			$shortcodes_list .= '<option value="['.$key.'][/'.$key.']">'.$key.'</option>';
			}
		}
	 echo $shortcodes_list;
	 echo '</select>';
}
add_action('media_buttons','add_sc_select',11);

function button_js() {
		echo '<script type="text/javascript">
		jQuery(document).ready(function(){
		   jQuery(".sc_select").change(function() {
			   wpActiveEditor = jQuery( "textarea.mceEditor,textarea.wp-editor-area", jQuery(this).closest(".wp-media-buttons").parent().parent() ).attr( "id" );
			   send_to_editor(jQuery(":selected", this).val());
			   jQuery(this).val("Shortcodes");
			   return false;
		   });
		});
		</script>';
}
add_action('admin_head', 'button_js');
	
?>