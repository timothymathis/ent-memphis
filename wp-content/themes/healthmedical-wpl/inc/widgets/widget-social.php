<?php
/*
 * Plugin Name: Social Widget
 * Plugin URI: http://www.wplook.com
 * Description: This is a widget to display Social Media
 * Author: Victor Tihai	
 * Version: 1.0.0
 * @since: Charitas 1.0.1
 * Author URI: http://wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_social_widget");'));
class wplook_social_widget extends WP_Widget {

	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
			'wplook_social_widget',
			__( 'WPlook Social', 'healthmedical-wpl' ),
			array( 'description' => __( 'A widget for displaying social networking links', 'healthmedical-wpl' ), )
		);
	}
	
	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/
	
	public function form( $instance ) {
	// outputs the options form on admin

		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		}

		else {
			$title = __( '', 'healthmedical-wpl' );
		} 

		if ( $instance ) {
			$twitter = esc_attr( $instance[ 'twitter' ] );
		}
		else {
			$twitter = __( '', 'healthmedical-wpl' );
		} 

		if ( $instance ) {
			$facebook = esc_attr( $instance[ 'facebook' ] );
		}
		else {
			$facebook = __( '', 'healthmedical-wpl' );
		} 
		if ( $instance ) {
			$rss = esc_attr( $instance[ 'rss' ] );
		}
		else {
			$rss = __( '', 'healthmedical-wpl' );
		} 
		if ( $instance ) {
			$googleplus = esc_attr( $instance[ 'googleplus' ] );
		}
		else {
			$googleplus = __( '', 'healthmedical-wpl' );
		} 
		if ( $instance ) {
			$youtube = esc_attr( $instance[ 'youtube' ] );
		}
		else {
			$youtube = __( '', 'healthmedical-wpl' );
		}
		
		if ( $instance ) {
			$vimeo = esc_attr( $instance[ 'vimeo' ] );
		}
		else {
			$vimeo = __( '', 'healthmedical-wpl' );
		}
		if ( $instance ) {
			$soundcloud = esc_attr( $instance[ 'soundcloud' ] );
		}
		else {
			$soundcloud = __( '', 'healthmedical-wpl' );
		} 
		if ( $instance ) {
			$lastfm = esc_attr( $instance[ 'lastfm' ] );
		}
		else {
			$lastfm = __( '', 'healthmedical-wpl' );
		} 
		if ( $instance ) {
			$pinterest = esc_attr( $instance[ 'pinterest' ] );
		}
		else {
			$pinterest = __( '', 'healthmedical-wpl' );
		}
		if ( $instance ) {
			$flickr = esc_attr( $instance[ 'flickr' ] );
		}
		else {
			$flickr = __( '', 'healthmedical-wpl' );
		}
		if ( $instance ) {
			$linked = esc_attr( $instance[ 'linked' ] );
		}
		else {
			$linked = __( '', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$instagram = esc_attr( $instance[ 'instagram' ] );
		}
		else {
			$instagram = __( '', 'healthmedical-wpl' );
		}

		?>
		<!-- Title-->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Title:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
		<!-- Twitter-->
		<p>
			<label for="<?php echo $this->get_field_id('twitter'); ?>">
				<?php _e('Twitter:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Twitter profile.', 'healthmedical-wpl'); ?>
			</p>
		</p>
		
		<!-- Facebook-->
		<p>
			<label for="<?php echo $this->get_field_id('facebook'); ?>">
				<?php _e('Facebook:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Facebook profile, page or group.', 'healthmedical-wpl'); ?>
			</p>
		</p>
		
		<!-- RSS-->
		<p>
			<label for="<?php echo $this->get_field_id('rss'); ?>">
				<?php _e('RSS:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo $rss; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the URL of your RSS feed. You may include your RSS feed from Feedburner.', 'healthmedical-wpl'); ?>
			</p>
		</p>
		
		<!-- Google Plus-->
		<p>
			<label for="<?php echo $this->get_field_id('googleplus'); ?>">
				<?php _e('Google+:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('googleplus'); ?>" name="<?php echo $this->get_field_name('googleplus'); ?>" type="text" value="<?php echo $googleplus; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Google+ profile', 'healthmedical-wpl'); ?>
			</p>
		</p>
		
		<!-- YouTube-->
		<p>
			<label for="<?php echo $this->get_field_id('youtube'); ?>">
				<?php _e('YouTube:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo $youtube; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your YouTube profile.', 'healthmedical-wpl'); ?>
			</p>
		</p>
		
		<!-- Vimeo-->
		<p>
			<label for="<?php echo $this->get_field_id('vimeo'); ?>">
				<?php _e('Vimeo:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo $vimeo; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Vimeo profile.', 'healthmedical-wpl'); ?>
			</p>
		</p>
		
		<!-- Last.fm-->
		<p>
			<label for="<?php echo $this->get_field_id('lastfm'); ?>">
				<?php _e('Last.fm:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('lastfm'); ?>" name="<?php echo $this->get_field_name('lastfm'); ?>" type="text" value="<?php echo $lastfm; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Last.fm profile.', 'healthmedical-wpl'); ?>
			</p>
		</p>

		<!-- SoundCloud -->
		<p>
			<label for="<?php echo $this->get_field_id('soundcloud'); ?>">
				<?php _e('Soundcloud:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('soundcloud'); ?>" name="<?php echo $this->get_field_name('soundcloud'); ?>" type="text" value="<?php echo $soundcloud; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your SoundCloud profile.', 'healthmedical-wpl'); ?>
			</p>
		</p>
		
		<!--Pinterest-->
		<p>
			<label for="<?php echo $this->get_field_id('pinterest'); ?>">
				<?php _e('Pinterest:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo $pinterest; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Pinterest profile.', 'healthmedical-wpl'); ?>
			</p>
		</p>

		<!--Flickr-->
		<p>
			<label for="<?php echo $this->get_field_id('flickr'); ?>">
				<?php _e('Flickr:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo $flickr; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Flickr profile.', 'healthmedical-wpl'); ?>
			</p>
		</p>
		
		<!--LinkedIn-->
		<p>
			<label for="<?php echo $this->get_field_id('linked'); ?>">
				<?php _e('LinkedIn:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('linked'); ?>" name="<?php echo $this->get_field_name('linked'); ?>" type="text" value="<?php echo $linked; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your LinkedIn profile.', 'healthmedical-wpl'); ?>
			</p>
		</p>

		<!--Instagram-->
		<p>
			<label for="<?php echo $this->get_field_id('instagram'); ?>">
				<?php _e('Instagram:', 'healthmedical-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo $instagram; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Instagram profile.', 'healthmedical-wpl'); ?>
			</p>
		</p>

<?php 

	} 

function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['twitter'] = sanitize_text_field($new_instance['twitter']);
		$instance['facebook'] = $new_instance['facebook'];
		$instance['rss'] = $new_instance['rss'];
		$instance['googleplus'] = $new_instance['googleplus'];
		$instance['youtube'] = $new_instance['youtube'];
		$instance['vimeo'] = $new_instance['vimeo'];
		$instance['lastfm'] = $new_instance['lastfm'];
		$instance['soundcloud'] = $new_instance['soundcloud'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['flickr'] = $new_instance['flickr'];
		$instance['linked'] = $new_instance['linked'];
		$instance['instagram'] = $new_instance['instagram'];

	return $instance;
	}

function widget($args, $instance) {
		// outputs the content of the widget
		 extract( $args );
			$title = apply_filters('widget_title', $instance['title']);
			$twitter = apply_filters('widget_twitter', $instance['twitter']);
			$facebook = apply_filters('widget_facebook', $instance['facebook']);
			$rss = apply_filters('widget_rss', $instance['rss']);
			$googleplus = apply_filters('widget_googleplus', $instance['googleplus']);
			$youtube = apply_filters('widget_youtube', $instance['youtube']);
			$vimeo = apply_filters('widget_vimeo', $instance['vimeo']);
			$lastfm = apply_filters('widget_lastfm', $instance['lastfm']);
			$soundcloud = apply_filters('widget_soundcloud', $instance['soundcloud']);
			$pinterest = apply_filters('widget_pinterest', $instance['pinterest']);
			$flickr = apply_filters('widget_flickr', $instance['flickr']);
			$linked = apply_filters('widget_linked', $instance['linked']);
			$instagram = apply_filters('widget_instagram', $instance['instagram']);

			?>
<?php if ($title=="") $title = "Social Widget"; ?>
<?php echo $before_widget; ?>
<?php if ( $title )
		echo $before_title . $title . $after_title; 
		echo '<div class="socials socials-secondary"><ul>';
			// Twitter
			if ($twitter != "") {
				echo '<li>'.'<a href="' . esc_url($twitter) . '" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>'.'</li>';
			}
			// Facebook
			if ($facebook != '') {
				echo '<li>' . '<a href="' . esc_url($facebook) . '" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>' .'</li>';
			}		
			// RSS
			if ($rss != '') {
				echo '<li>'.'<a href="' . esc_url($rss) . '" target="_blank" class="rss"><i class="fa fa-rss"></i></a>' .'</li>';
			}
			// Google Plus
			if ($googleplus != '') {
				echo '<li>'.'<a href="' . esc_url($googleplus) . '" target="_blank" class="google"><i class="fa fa-google-plus"></i></a>' .'</li>';
			}
			// YouTube
			if ($youtube != '') {
				echo '<li>'.'<a href="' . esc_url($youtube) . '" target="_blank" class="youtube"><i class="fa fa-youtube"></i></a>' .'</li>';
			}
			// vimeo
			if ($vimeo != '') {
				echo '<li>'.'<a href="' . esc_url($vimeo) . '" target="_blank" class="vimeo"><i class="fa fa-vimeo-square"></i></a>' .'</li>';
			}
			// lastfm
			if ($lastfm != '') {
				echo '<li>'.'<a href="' . esc_url($lastfm) . '" target="_blank" class="lastfm"><i class="fa fa-lastfm"></i></a>' .'</li>';
			}
			// soundcloud
			if ($soundcloud != '') {
				echo '<li>'.'<a href="' . esc_url($soundcloud) . '" target="_blank" class="soundcloud"><i class="fa fa-soundcloud"></i></a>' .'</li>';
			}
			// Pinterest
			if ($pinterest != '') {
				echo '<li>'.'<a href="' . esc_url($pinterest) . '" target="_blank" class="pinterest"><i class="fa fa-pinterest"></i></a>' .'</li>';
			}
			// Flickr
			if ($flickr != '') {
				echo '<li>'.'<a href="' . esc_url($flickr) . '" target="_blank" class="flickr"><i class="fa fa-flickr"></i></a>' .'</li>';
			}
			// Linkedin
			if ($linked != '') {
				echo '<li>'.'<a href="' . esc_url($linked) . '" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>' .'</li>';
			}
			// Instagram
			if ($instagram != '') {
				echo '<li>'.'<a href="' . esc_url($instagram) . '" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>' .'</li>';
			}
		echo '</ul></div>';
	 	echo $after_widget; ?>
<?php
	}
}
?>
