=== WP Add Titles to post thumbnails ===
Contributors: freelancevip
Tags: post thumbnail, the_post_thumbnail, title, thumbnail title, post thumbnail title.
Requires at least: 3.9
Tested up to: 4.6
Stable tag: 4.6
License: GPLv2 or later
License URI:  http://www.gnu.org/licenses/gpl-2.0.html

Authomatically adds title to the_post_thumbnail function.

== Description ==
Authomatically adds titles to the_post_thumbnail function. Adds title attribute for img tag. There are two options: current post title (default) or attachment title (need set SHOW_POST_TITLE_AS_THUMBNAIL_TITLE to FALSE).

= Features =

* Add title attribute to img tag for the_post_thumbnail function.
* Shows post title or attachment title.
* Small and well written code plugin.
* It does not change the database or other files.

= Instructions =

Basically, plugin adds post title to thumbnails.
For displaying attachment title find line
`<?php const SHOW_POST_TITLE_AS_THUMBNAIL_TITLE	 = TRUE; ?>`
in wp-add-title-to-post-thumbnails.php
and replace it with
`<?php const SHOW_POST_TITLE_AS_THUMBNAIL_TITLE	 = FALSE; ?>`

== Installation ==
1. Go to the Add New plugins screen in your WordPress Dashboard
2. Click the upload tab
3. Browse for the plugin file (WP Add Titles to post thumbnails) on your computer
4. Click \"Install Now\" and then hit the activate button.

== Frequently Asked Questions ==

= Can this plugin add title attribute to my thumbnails? =

Yes.

= Is it safe? =

Yes.

== Screenshots ==

For screenshots please visit the plugin page

== Changelog ==
= 1.0 =
* WP Add Titles to post thumbnails is ready.

== Upgrade Notice ==
This plugin is fully update.