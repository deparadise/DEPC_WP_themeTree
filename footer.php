<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DEPC_template_theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer row" role="contentinfo">
		<div class="small-12 columns">
			<div class="site-info">
				&copy; <?php echo date('Y'); ?> Unique Impressions Promotionals. All Rights Reserved.
			</div>
			<!-- DEPC Bug -->
			<div class="DEPC-bug">
				<a href="http://www.deparadise.com" target="_blank">
					Website by DEParadise Creative
					<img class="bug" src="<?php bloginfo('template_url');?>/assets/imgs/DEPC_bug.png" alt="DEParadise Creative Logo">
					Design / Web
				</a>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
