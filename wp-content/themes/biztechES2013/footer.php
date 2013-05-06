
<footer>
	<div id="brands"><img src="<?php bloginfo( 'template_url' ); ?>/images/adobe.png" width="97" height="25" alt="Adobe Silver Partner">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php bloginfo( 'template_url' ); ?>/images/kofax.png" width="84" height="25" alt="Kofax">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php bloginfo( 'template_url' ); ?>/images/abbyy.png" width="77" height="25" alt="Abbyy Certified Partner"></div>
	<nav>
		<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
	</nav>
	<div id="copyright">
		<p><?php echo comicpress_copyright(); ?> <?php bloginfo( 'name' ); ?>: <?php bloginfo( 'description' ); ?> ~ <?php wp_loginout(); ?></p>
	</div>
</footer>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>