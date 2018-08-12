<?php
/**
 * Template Name: Empty Template
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.4
 */
?>

<?php get_header(); ?>
	<div class="main">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
		<?php endwhile; endif; ?>		
	</div><!-- /.main -->
<?php get_footer(); ?>