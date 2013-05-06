<?php
/*
Plugin Name: Course System
Plugin URI: http://www.reddickdesign.com.au/
Description: Add custom taxonomy for Course
Version: 1.0
License: GPLv2
Author: Alan Reddick
Author URI: http://www.reddickdesign.com.au/
*/

add_action('init', 'post_type_courses');

function post_type_courses() {
	register_post_type(
		'course',
		array(
			'labels' => array(
			'name' => __( 'Courses' ),
			'singular_name' => __( 'Course' ),
		),
		'public' => true,
		'show_ui' => true,
		'rewrite' => array('slug' => 'classes', 'with_front' => FALSE), 
		'query_var' => true,
		'hierarchical' => false,
		'register_meta_box_cb' => 'course_meta_boxes',
		'show_in_nav_menus' => true,
		'supports' => array(
			'title',
			'editor',
			'author',
			'excerpt',
			'thumbnail',
			'revisions',
			'page-attributes',)
		)
	);
register_taxonomy_for_object_type('coursetype', 'course');
}


/* Taxonomies */
add_action('init', 'create_course_series_tax');
register_activation_hook( __FILE__, 'activate_course_series_tax' );
function activate_course_series_tax() {
	create_course_series_tax();
	$GLOBALS['wp_rewrite']->flush_rules();
}
function create_course_series_tax() {
	register_taxonomy(
		'coursetype',
		'course',
	array(
		'labels' => array(
		'name' => __( 'Course Types' ),
		'singular_name' => __( 'Course Type' ),
	),
	'hierarchical' => true,
	)
	);
}

add_filter("manage_edit-course_columns", "course_taxonomy_columns");
// rearrange the columns on the Edit screens
function course_taxonomy_columns($defaults) {
	// preserve the default date and comment columns
	$comments = $defaults['comments'];
	$date = $defaults['date'];
	// remove default date and comments
	unset($defaults['comments']);
	unset($defaults['date']);
	// insert college taxonomy column
	$defaults['coursetypes'] = __('Course Type');
	// restore default date and comments
	$defaults['comments'] = $comments;
	$defaults['date'] = $date;
	return $defaults;
}

//add_action("manage_pages_custom_column", "course_taxonomy_custom_column");
// for non-hierarchical content types, use the following instead:
 add_action("manage_posts_custom_column", "course_taxonomy_custom_column");
// print the college taxonomy terms, linked to filter the posts to this taxonomy term only
function course_taxonomy_custom_column($column) {
	global $post;
	if ($column == 'coursetypes') {
		$coursetypes = get_the_terms($post->ID, 'coursetype');
		if (!empty($coursetypes)) {
			$thecoursetype = array();
			foreach ($coursetypes as $coursetype) {
				$thecoursetype[] = '<a href="edit.php?post_type=course&coursetype='.$coursetype->slug.'">' .
				esc_html(sanitize_term_field('name', $coursetype->name, $coursetype->term_id, 'coursetype', 'display'))
				. "</a>";
			}
			echo implode(', ', $thecoursetype);
		}
	}
}

/* Custom Fields */

$new_meta_boxes =
array(
	"for" => array(
		"name" => "for",
		"std" => "",
		"title" => "For",
		"type" => "text",
		"description" => "Prerequisite"),
	"tutor" => array(
		"name" => "tutor",
		"std" => "",
		"title" => "Tutor",
		"type" => "text",
		"description" => "Name of course Tutor"),
	"cost" => array(
		"name" => "cost",
		"std" => "",
		"title" => "Cost",
		"type" => "text",
		"description" => "Cost of Course (eg. $150.00)"),
	"coursesessions" => array(
		"name" => "course-sessions",
		"std" => "",
		"title" => "Sessions",
		"type" => "text",
		"description" => "Number of sessions and duration (eg. 4 weeks x 3 hours)"),
	"courseday" => array(
		"name" => "course-day",
		"std" => "",
		"title" => "Day",
		"type" => "textarea",
		"description" => "Day of course (eg. Monday Afternoon)"),
	"coursetime" => array(
		"name" => "course-time",
		"std" => "",
		"title" => "Time",
		"type" => "textarea",
		"description" => "Time of course (eg. 6pm - 9pm)"),
	"coursedate" => array(
		"name" => "course-date",
		"std" => "",
		"title" => "Dates",
		"type" => "textarea",
		"description" => "Dates of course (eg. 5th 12th 19th and 26th of October)"),
	"skills" => array(
		"name" => "skills",
		"std" => "",
		"title" => "Skills",
		"type" => "textarea",
		"description" => "Skills Learnt (eg. Basic glass working safety practices)"),
	"materials" => array(
		"name" => "materials",
		"std" => "",
		"title" => "Materials",
		"type" => "textarea",
		"description" => "Class Materials (eg. Suitable work clothing, including long pants and an apron or old over-shirt)")
);

function new_meta_boxes() {
	global $post, $new_meta_boxes;
	
	foreach($new_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
	
	if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];
		if($meta_box['type'] == 'text') {
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
			echo'<p><span style="display:block; width:60px; float: left; padding-top: 3px;"><strong>'.$meta_box['title'].'</strong></span> ';
			echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';
			echo'<label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
		} 
		if($meta_box['type'] == 'textarea') {
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
			echo'<p><strong>'.$meta_box['title'].'</strong></span><br />';
			echo'<div style="border: solid 1px #E0E0E0"><textarea class="theEditor" name="'.$meta_box['name'].'_value" cols="49" rows="5" />'.$meta_box_value.'</textarea></div><br />';
			echo'<label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
		} 
	}
}

function course_meta_boxes() {
	global $theme_name;
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-boxes', 'Details', 'new_meta_boxes', 'course', 'normal', 'high' );
	}
}

function save_postdata( $post_id ) {
	global $post, $new_meta_boxes;
	
	foreach($new_meta_boxes as $meta_box) {
		// Verify
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		
		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
				return $post_id;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ))
					return $post_id;
		}
		
		$data = $_POST[$meta_box['name'].'_value'];
		
		if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
		elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
			update_post_meta($post_id, $meta_box['name'].'_value', $data);
		elseif($data == "")
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
	}
}
function new_excerpt_more($more) {
	global $post;
	return '<a href="'. get_permalink($post->ID) . '">' . '&#8230; Read the Rest' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function new_excerpt_length($length) {
	return 40;
}
add_filter('excerpt_length', 'new_excerpt_length');

function courses_shortcode() {
	
	global $post;
	
	ob_start();

	//The Query
	query_posts('post_type=course&order=ASC'); ?>
		<ul class="coursetypelist">
			<?php wp_list_categories('taxonomy=coursetype&hierarchical=true&title_li=&child_of=10&hide_empty=0&depth=1'); ?>
        </ul>
<?php
		$r_count = 1;
		if ( have_posts() ) while ( have_posts() ) : the_post();
        	if($r_count%3 == 0){ $r_class = ' last'; $r_clearclass = 'clearall'; }else{ $r_class = ''; $r_clearclass = ''; } $r_count++; ?>
				<?php if(is_category()) { ?>
				<div class="course-post">
				<div id="course-post-<?php the_ID(); ?>" class="courselisting<?php echo $r_class; ?>">
				<p><?php the_post_thumbnail(); ?></p>
                    <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-ctent">
                      <p><strong>Tutor:</strong> <?php echo get_post_meta($post->ID, "tutor_value", $single = true); ?><br />
                         <strong>Course Cost:</strong> <?php echo get_post_meta($post->ID, "cost_value", $single = true); ?><br />
					     <strong>Course Category:</strong> <?php  echo the_terms( $post->ID, 'coursetype', '', ' &raquo; ', '' ); ?></p>
                      <?php the_excerpt(); ?>
                      <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'bluedog' ), 'after' => '</div>' ) ); ?>
                      <?php edit_post_link( __( 'Course Edit', 'bluedog' ), '<div class="edit-link"><p> ', '</p></div>' ); ?>
                </div>
            <!-- .entry-content --> 
            </div>
			<?php } ?>
          <!-- #post-## -->
        </div>
		  <div class="<?php echo $r_clearclass; ?>"></div>
        <?php endwhile;  ?>
		  <div class="clearall"></div>
<?php	//Reset Query
	wp_reset_query();
	
	$courses = ob_get_clean();
	return $courses;

}
add_shortcode('course', 'courses_shortcode');

add_action('admin_menu', 'course_meta_boxes');
add_action('save_post', 'save_postdata');

?>