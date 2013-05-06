<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage simpletheme
 * @since simpletheme v1.0
 */

get_header(); ?>

<div id="main">
	<div id="content">
		<?php 
				if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
			<?php if(!is_page()) { ?>
			<p>
				<?php the_date(); ?>
			</p>
			<?php } ?>
			<div class="entry-content">
				<?php the_content('Read more...'); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'simpletheme' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'simpletheme' ), '<div class="edit-link"><p>', '</p></div>' ); ?>
			</div>
			<!-- .entry-content --> 
		</div>
		<!-- #post-## -->
		<?php endwhile; ?>
		<div id="nav-single">
			<div class="alignleft">
				<p><?php previous_post('&laquo; %', 'Previous: ', 'yes'); ?></p>
			</div>
			<div class="alignright">
				<p><?php next_post('% &raquo; ', 'Next: ', 'yes'); ?></p>
			</div>
		</div>
	</div>
	<div id="sidebar">
		<?php dynamic_sidebar ('sidebar-sidebar'); ?>
	</div>
</div>
<?php get_footer(); ?>
