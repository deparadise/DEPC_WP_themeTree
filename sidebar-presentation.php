<?php
/**
 * The sidebar for the home page presentation widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DEPC_template_theme
 */

if ( ! is_active_sidebar( 'present-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area presentation row" role="complementary">
	<div class="columns medium-8 medium-push-2">
		<?php dynamic_sidebar( 'present-1' ); ?>
	</div>
</div><!-- #secondary -->
