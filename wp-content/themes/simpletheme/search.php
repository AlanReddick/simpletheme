<?php
global $query_string;

$query_args = explode("&", $query_string. "&post_type=any");
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = $query_split[1];
} // foreach

$search = new WP_Query($search_query);
?>
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
		<?php if ( have_posts() ) : ?>
		<h1 class="pagetitle">Search Results for:
			<?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e(' ('); echo $count . ' '; _e('results)'); wp_reset_query(); ?>
		</h1>
		<?php while ( have_posts() ) : the_post() ?>
		<?php if( $post->post_type == 'post' ) { ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'simpletheme2013'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php $title = get_the_title(); $keys= explode(" ",$s); $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title); ?>
				<?php echo $title; ?></a>
			</h1>
			<?php if(!is_page()) { ?>
			<p>
				<?php the_date(); ?>
			</p>
			<?php } ?>
			<div class="entry-content">
				<?php the_excerpt('Read more...'); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'simpletheme2013' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'simpletheme2013' ), '<div class="edit-link"><p>', '</p></div>' ); ?>
			</div>
			<!-- .entry-summary -->
			
			<div class="entry-utility">
				<p><span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links">
					<?php _e( 'Posted in ', 'simpletheme2013' ); ?>
					</span><?php echo get_the_category_list(', '); ?></span>
					<?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged ', 'simpletheme2013' ) . '</span>', ", ", "</span>\n\t\t\t\t\t\t\n" ) ?>
					<?php edit_post_link( __( 'Edit', 'simpletheme2013' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ) ?>
				</p>
			</div>
			<!-- #entry-utility --> 
		</div>
		<!-- #post-<?php the_ID(); ?> -->
		<?php 
			} elseif ($post->post_type == 'page') { ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'simpletheme2013'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
				<?php $title = get_the_title(); $keys= explode(" ",$s); $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title); ?>
				<?php echo $title; ?>
				</a></h1>
			<div class="entry-summary noimages">
				<?php the_excerpt('Read more...'); ?>
				<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'simpletheme2013' ) . '&after=</div>') ?>
			</div>
			<!-- .entry-summary -->
			
			<div class="entry-utility">
				<p>
					<?php edit_post_link( __( 'Edit', 'simpletheme2013' ), "<span class=\"meta-sep\"></span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ) ?>
				</p>
			</div>
			<!-- #entry-utility --> 
		</div>
		<!-- #post-<?php the_ID(); ?> -->
		<?php } ?>
		<?php endwhile; ?>
		<div id="nav-resource">
			<?php 
				$search->query_vars['paged'] > 1 ? $current = $search->query_vars['paged'] : $current = 1;
				
				$pagination = array(
					'base' => @add_query_arg('page','%#%'),
					'format' => '',
					'total' => $search->max_num_pages,
					'current' => $current,
					'show_all' => true,
					'type' => 'plain',
					);
				
				if( $wp_rewrite->using_permalinks() )
					$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
				
				if( !empty($search->query_vars['s']) )
					$pagination['add_args'] = array('s'=>get_query_var('s'));
				
				echo paginate_links($pagination); 		
				?>
		</div>
		<?php else : ?>
		<div id="post-0" class="post no-results not-found">
			<h2 class="entry-title">
				<?php _e( 'Nothing Found', 'simpletheme2013' ) ?>
			</h2>
			<div class="entry-content">
				<p>
					<?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'simpletheme2013' ); ?>
				</p>
				<?php get_search_form(); ?>
			</div>
			<!-- .entry-content --> 
		</div>
		<?php endif; ?>
	</div>
	<div id="sidebar">
		<?php dynamic_sidebar ('sidebar-sidebar'); ?>
	</div>
</div>
<?php get_footer(); ?>
