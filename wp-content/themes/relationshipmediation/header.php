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
		echo sprintf( __( 'Page %s', 'relationshipmediation' ), max( $paged, $page ) . ' &raquo; ' );
	
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
</head>

<body>
<div class="container">
<div class="header">
	<div class="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'sf-menu' ) ); ?>
	</div>
	<div class="feature"><a href="<?php bloginfo( 'url' ); ?>"><span class="hidetext">
		<?php bloginfo( 'name' ); ?>
		:
		<?php bloginfo( 'description' ); ?>
		</span><img src="<?php bloginfo( 'template_url' ); ?>/images/ParentingPlansPlus.png" width="916" height="195" alt="Parenting Plans Plus" /></a></div>
</div>
