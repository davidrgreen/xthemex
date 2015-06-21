<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 */
?>
	</div> <?php /* Closes #content */ ?>

	<?php /*
	<div class="footer-widgets">
		<div class="wrap">
			<section class="one-half first">
			</section>
			<section class="one-half">
			</section>
		</div>
	</div>
	*/ ?>

</div> <?php /* Closes site-container */ ?>
<footer id="colophon" class="site-footer clearfix" role="contentinfo">
	<div class="wrap">
	&copy; <?php echo date( 'Y' ); ?> All Rights Reserved.
	</div>
</footer>
<div class="mobile-menu">
	<button class="mobile-menu-toggle" role="button" aria-pressed="false">&#10006; Close Menu</button>
	<div class="mobile-menu-primary">
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'mobile-primary', 'fallback_cb' => '__return_false' ) ); ?>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
