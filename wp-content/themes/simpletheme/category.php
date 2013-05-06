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
 * @subpackage simpletheme2013
 * @since simpletheme2013 v1.0
 */

get_header(); ?>

<div id="main">
	<div id="content">
		<?php 
				if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h1>
			<?php if(!is_page()) { ?>
			<p>
				<?php the_date(); ?>
			</p>
			<?php } ?>
			<div class="entry-content">
				<?php the_content('Read more...'); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'simpletheme2013' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'simpletheme2013' ), '<div class="edit-link"><p>', '</p></div>' ); ?>
			</div>
			<!-- .entry-content --> 
		</div>
		<!-- #post-## -->
		<?php endwhile; ?>
		<div id="nav-category">
			<?php 
				$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
				
				$pagination = array(
					'base' => @add_query_arg('page','%#%'),
					'format' => '',
					'total' => $wp_query->max_num_pages,
					'current' => $current,
					'show_all' => true,
					'type' => 'plain',
					);
				
				if( $wp_rewrite->using_permalinks() )
					$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
				
				if( !empty($wp_query->query_vars['s']) )
					$pagination['add_args'] = array('s'=>get_query_var('s'));
				
				echo paginate_links($pagination); 		
				?>
		</div>
	</div>
	<div id="sidebar">
		<?php dynamic_sidebar ('sidebar-sidebar'); ?>
	</div>
</div>
<?php get_footer(); ?>
