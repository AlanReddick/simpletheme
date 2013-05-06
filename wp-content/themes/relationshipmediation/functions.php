<?php 
if ( function_exists('register_sidebar')) {	

	register_sidebar(array(
		'name'				=> 'Sidebar',
		'id'				=> 'sidebar-sidebar',
		'description'   	=> 'Sidebar',
		'before_widget'	 	=> '<div>',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h1>',
		'after_title' 		=> '</h1>'
	));	
}

// Wordpress 3.0 Menu Support
add_theme_support( 'menus' );

if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'main-menu' => 'Main Menu',
		)
	);
}

function comicpress_copyright() {
	global $wpdb;
	$copyright_dates = $wpdb->get_results("SELECT YEAR(min(post_date_gmt)) AS firstdate, YEAR(max(post_date_gmt)) AS lastdate FROM $wpdb->posts WHERE post_status = 'publish'");
	$output = '';
	if($copyright_dates) {
		$copyright = "&copy; " . $copyright_dates[0]->firstdate;
		if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
			$copyright .= '-' . $copyright_dates[0]->lastdate;
		}
		$output = $copyright;
	}
	return $output;
}

add_editor_style('editor-style.css');

function new_excerpt_more($more) {
	global $post;
	
	if (!is_search()) {
		return " <a href=\"".get_permalink($post->ID)."\" rel=\"bookmark\">" . "&#8230; read more" . "</a>";
	} else {
		return " ...";
	}
}
add_filter('excerpt_more', 'new_excerpt_more');

// in default filters.
add_filter('get_the_excerpt', array('SearchExcerpt', 'the_excerpt'), 5);

add_theme_support( 'automatic-feed-links' );

?>