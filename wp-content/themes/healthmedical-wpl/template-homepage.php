<?php
/**
 * Template Name: Home page template
 *
 * This template has been deprecated template, replaced by front-page.php. It has been
 * kept in the theme to avoid breaking it for customers who used the theme before this
 * change.
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php get_header(); ?>
	
	<?php get_template_part('inc', 'slider'); ?>

	<div class="main">

		<!-- Home page widget area -->
		<?php dynamic_sidebar( 'homepage-top' ); ?>

	</div><!-- /.main -->

<?php get_footer(); ?>
