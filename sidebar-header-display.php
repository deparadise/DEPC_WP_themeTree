<?php
/**
 * The sidebar for the header-display widget area above the main navigation.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DEPC_template_theme
 */

if ( ! is_active_sidebar( 'header-display' ) ) {
	return;
}
?>

<div id="secondary-hd" class="widget-area display row" role="complementary">
	<div class="columns medium-10 medium-push-1">
		<?php dynamic_sidebar( 'header-display' ); ?>
	</div>
</div><!-- #secondary -->
