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
			<?php 
		if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="entry-title">
					<?php the_title(); ?>
				</h1>
				<div class="entry-content">
					<p><strong>For:</strong> <?php echo get_post_meta($post->ID, "for_value", $single = true); ?><br />
						<strong>Tutor:</strong> <?php echo get_post_meta($post->ID, "tutor_value", $single = true); ?></p>
					<h3> Course Outline</h3>
					<?php the_content(); ?>
					<p><strong>Course Cost:</strong> <?php echo get_post_meta($post->ID, "cost_value", $single = true); ?><br />
						<strong>Contact Hours:</strong>
						<?php if (get_post_meta($post->ID, "course-sessions_value", $single = true) !='') { ?>
						(<?php echo get_post_meta($post->ID, "course-sessions_value", $single = true); ?>)
						<?php } ?>
					</p>
					<table width="70%" border="0" cellspacing="1" cellpadding="0">
						<tr>
							<td><p><strong>Day</strong><br />
									<?php echo get_post_meta($post->ID, "course-day_value", $single = true); ?></p></td>
							<td><p><strong>Time</strong><br />
									<?php echo get_post_meta($post->ID, 'course-time_value', $single = true); ?></p></td>
							<td><p><strong>Dates</strong><br />
									<?php echo get_post_meta($post->ID, 'course-date_value', $single = true); ?></p></td>
						</tr>
					</table>
					<p><strong>You will learn about:</strong><br />
						<?php echo get_post_meta($post->ID, 'skills_value', $single = true); ?></p>
					<h3>Class Materials</h3>
					<p><strong>Please bring the following to class:</strong><br />
						<?php echo get_post_meta($post->ID, 'materials_value', $single = true); ?></p>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'bluedog' ), 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'Edit', 'bluedog' ), '<div class="edit-link"><p>', '</p></div>' ); ?>
				</div>
				<!-- .entry-content --> 
			</div>
			<!-- #post-## -->
			<div id="nav-below">
				<p><strong>Previous and Next Classes</strong></p>
				<div class="nav-previous">
					<p><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'bluedog' ) . '</span> %title' ); ?></p>
				</div>
				<div class="nav-next">
					<p><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'bluedog' ) . '</span>' ); ?></p>
				</div>
			</div>
			<!-- #nav-below -->
			<?php endwhile; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
