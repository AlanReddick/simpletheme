<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Blue Dog Glass
 * @since Blue Dog Glass 1.0
 */

get_header(); ?>

<div id="mainbodyOuter">
	<div id="mainbody">
		<div id="bodyCopy">
			<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
			<h1><?php echo $term->name; ?></h1>
			<ul class="coursetypelist-template">
				<?php wp_list_categories('taxonomy=coursetype&hierarchical=true&title_li=&child_of=10&hide_empty=0'); ?>
			</ul>
			<?php
			$r_count = 1;
			if ( have_posts() ) { while ( have_posts() ) : the_post();
				if($r_count%3 == 0){ $r_class = ' last'; $r_clearclass = 'clearall'; }else{ $r_class = ''; $r_clearclass = ''; } $r_count++; ?>
				<div class="coursetype-post">
					<div id="course-post-<?php the_ID(); ?>" class="courselisting<?php echo $r_class; ?>">
					
						<p><?php
								if(has_post_thumbnail()) {
									the_post_thumbnail('thumbnail');
								} else {
									echo '<img src="'.get_bloginfo("template_url").'/images/img-default.png" width=/"267/" height=/"134/" />';
								}
							?>
						</p>
						<h2 class="entry-title"><a href="<?php the_permalink() ?>">
							<?php the_title(); ?>
							</a></h2>
						<div class="entry-ctent">
							<p><strong>Tutor:</strong> <?php echo get_post_meta($post->ID, "tutor_value", $single = true); ?><br />
								<strong>Course Cost:</strong> <?php echo get_post_meta($post->ID, "cost_value", $single = true); ?><br />
								<strong>Course Category:</strong>
								<?php  echo the_terms( $post->ID, 'coursetype', '', ' &raquo; ', '' ); ?>
							</p>
							<?php the_excerpt(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'bluedog' ), 'after' => '</div>' ) ); ?>
							<?php edit_post_link( __( 'Course Edit', 'bluedog' ), '<div class="edit-link"><p> ', '</p></div>' ); ?>
						</div>
						<!-- .entry-content --> 
					</div>
					<!-- #post-## --> 
				</div>
				<div class="<?php echo $r_clearclass; ?>"></div>
			<?php endwhile;  
			} else { ?>
			<div class="no-post"><p>Sorry there are no results for this category yest please visit Blue Dog Glass again for more courses coming soon.</p></div>
			<?php } ?>
			<div class="clearall"></div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
