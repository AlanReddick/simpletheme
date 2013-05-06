<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;


	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo "$site_description  &raquo; ";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo sprintf( __( 'Page %s', 'simpletheme2013' ), max( $paged, $page ) . ' &raquo; ' );
	
	// Add the blog name.
	wp_title( '&raquo;', true, 'right' );
	
	bloginfo( 'name' );
?>
</title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/superfish.css" media="screen">

<?php wp_enqueue_script("jquery"); ?>
<?php
	wp_head();
?>
<script src="<?php bloginfo( 'template_url' ); ?>/js/hoverIntent.js"></script> 
<script src="<?php bloginfo( 'template_url' ); ?>/js/superfish.js"></script> 
<script src="<?php bloginfo( 'template_url' ); ?>/js/supersubs.js"></script> 
<script> 
 
   jQuery(document).ready(function(){ 
        jQuery("ul.sf-menu").supersubs({ 
            minWidth:    12,   // minimum width of sub-menus in em units 
            maxWidth:    27,   // maximum width of sub-menus in em units 
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
                               // due to slight rounding differences and font-family 
        }).superfish();  // call supersubs first, then superfish, so that subs are 
                         // not display:none when measuring. Call before initialising 
                         // containing tabs for same reason. 
    }); 
 
</script>
<!-- Search Clear initial content -->
<script language="javascript" type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#searchinput').addClass("idleField");
	jQuery('#searchinput').focus(function() {
		jQuery(this).removeClass("idleField").addClass("focusField");
        if (this.value == this.defaultValue){
        	this.value = '';
    	}
        if(this.value != this.defaultValue){
	    	this.select();
        }
    });
});
</script>
<!-- Search enable submit after three char -->
<script language="javascript" type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#searchinput").bind("keyup", valform);
	function valform(){
		var value = jQuery("#searchinput").val();
    	if ( value.length > 2 && value != "search" ) {
			jQuery("input[type='submit']").removeAttr('disabled');

		}
	}});
</script>
</head>

<body>
<div id="outer">
	<div id="header">
		<h1><a href="<?php bloginfo( 'url' ); ?>"><span class="hidetext"><?php bloginfo( 'name' ); ?>: <?php bloginfo( 'description' ); ?></span></a></h1>
	</div>
	<div id="navigation"><?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'sf-menu' ) ); ?><?php get_search_form(); ?></div>
