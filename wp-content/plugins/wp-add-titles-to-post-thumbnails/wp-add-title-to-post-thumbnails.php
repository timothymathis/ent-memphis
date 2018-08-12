<?php

/*
  Plugin Name: WP Add titles to post thumbnails
  Plugin URI:
  Description: Authomatically adds titles to the_post_thumbnail function
  Author: Anatoliy Vladimirovich Demchenko
  Version: 1.0
  Author URI: http://freelancevip.pro
 */

/*  Copyright 2016  Anatoliy Vladimirovich Demchenko  (email: freelancevip@yandex.ru)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

add_filter( 'post_thumbnail_html', array( 'Freelancevip_Add_Title_To_Post_Thumbnails', 'add_title' ), 99, 5 );

class Freelancevip_Add_Title_To_Post_Thumbnails {

	// Set SHOW_POST_TITLE_AS_THUMBNAIL_TITLE false to show attachment title
	// or true to show post title
	// for post thumbnails
	const SHOW_POST_TITLE_AS_THUMBNAIL_TITLE	 = TRUE;
	const PATTERN								 = '~\stitle=~';
	const NEEDLE								 = '<img ';

	/**
	 * 
	 * @param string $html
	 * @param int $post_id
	 * @param int $post_thumbnail_id
	 * @param array | string $size
	 * @param array $attr
	 * @return string
	 */
	static function add_title( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
		if ( TRUE === self::title_exists( $html ) ) {
			return $html;
		}
		$title = self::get_title( $post_id, $post_thumbnail_id );
		return self::replace_tag( $html, $title );
	}

	/**
	 * 
	 * @param string $html
	 * @return bool
	 */
	static function title_exists( $html ) {
		return preg_match( self::PATTERN, $html );
	}

	/**
	 * 
	 * @param string $html
	 * @param string $title
	 * @return string
	 */
	static function replace_tag( $html, $title ) {
		$new_title	 = sprintf( self::NEEDLE . 'title="%s"', $title );
		$html		 = str_replace( self::NEEDLE, $new_title, $html );
		return $html;
	}

	/**
	 * 
	 * @param int $post_id
	 * @param int $post_thumbnail_id
	 * @return string
	 */
	static function get_title( $post_id, $post_thumbnail_id ) {
		if ( TRUE === self::SHOW_POST_TITLE_AS_THUMBNAIL_TITLE ) {
			return get_the_title( $post_id );
		}
		return apply_filters( 'the_title', get_post( $post_thumbnail_id )->post_title );
	}

}
