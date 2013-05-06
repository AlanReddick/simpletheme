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
 * @subpackage btes
 * @since btes v2.0
 */

get_header(); ?>

<div id="content">
	<div id="mainBody">
		<article>
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content('...find out more'); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'btes' ), 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'Edit', 'btes' ), '<div class="edit-link"><p>', '</p></div>' ); ?>
				</div>
				<!-- .entry-content --> 
			</div>
			<!-- #post-## -->
			<?php endwhile; ?>
		</article>
	</div>
	<div id="mainFeature">
		<aside>
			<?php dynamic_sidebar ('feature-sidebar'); ?>
		</aside>
	</div>
	<div id="mainFooter">
		<aside>
			<div id="address">
				<?php dynamic_sidebar ('address-sidebar'); ?>
			</div>
			<div id="featured">
				<div class="featureBox">
					<?php dynamic_sidebar ('boxleft-sidebar'); ?>
				</div>
				<div class="featureBox">
					<?php dynamic_sidebar ('boxright-sidebar'); ?>
				</div>
			</div>
		</aside>
	</div>
</div>
<?php get_footer(); ?>