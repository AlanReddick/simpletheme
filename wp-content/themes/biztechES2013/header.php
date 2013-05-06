<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
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
		echo sprintf( __( 'Page %s', 'btes' ), max( $paged, $page ) . ' &raquo; ' );
	
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
<!--[if lt IE 9]>
   <script>
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
   </script>
   <link href="<?php bloginfo( 'template_url' ); ?>/styleIE.css" rel="stylesheet" type="text/css">
<![endif]-->
<script src="<?php bloginfo( 'template_url' ); ?>/js/hoverIntent.js"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/superfish.js"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/supersubs.js"></script>
<script> 
 
   jQuery(document).ready(function(){ 
        jQuery("ul.sf-menu").supersubs({ 
            minWidth:    16,   // minimum width of sub-menus in em units 
            maxWidth:    50,   // maximum width of sub-menus in em units 
            extraWidth:  5     // extra width can ensure lines don't sometimes turn over 
                               // due to slight rounding differences and font-family 
        }).superfish();  // call supersubs first, then superfish, so that subs are 
                         // not display:none when measuring. Call before initialising 
                         // containing tabs for same reason. 
    }); 
 
</script>
</head>
<body>
<div id="wrapper">
<div id="container">
<header>
	<nav>
		<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'sf-menu' ) ); ?>
	</nav>
	<div id="logo">
		<hgroup><a href="<?php bloginfo( 'url' ); ?>">
			<h1 class="hidetext">
				<?php bloginfo( 'name' ); ?>
			</h1>
			<h2 class="hidetext">
				<?php bloginfo( 'description' ); ?>
			</h2>
			<img src="<?php bloginfo( 'template_url' ); ?>/images/logo.png" alt="Biztech Enterprise Solutions" width="255" height="83" border="0"></a>
		</hgroup>
	</div>
</header>
