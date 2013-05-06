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

<div id="subcontent">
	<section>
		<div id="subFeature">
			<aside>
				<?php dynamic_sidebar ('feature-sidebar'); ?>
			</aside>
		</div>
	</section>
	<div id="subBody">
		<article>
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
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
	<div id="sidebar">
		<?php if(is_page()) { ?>
		<aside>
			<?php dynamic_sidebar('latestnews-sidebar'); ?>
		</aside>
		<?php } ?>
		<aside>
			<?php dynamic_sidebar('customizable-sidebar'); ?>
		</aside>
	</div>
</div>
<?php get_footer(); ?>
