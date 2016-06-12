<?php
/**
 * The sidebar for the presentation-2 widget area after the content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DEPC_template_theme
 */

if ( ! is_active_sidebar( 'presentation-2' ) ) {
	return;
}
?>

<div id="secondary-p2" class="widget-area presentation row" role="complementary">
	<div class="columns medium-8 medium-push-2">
		<?php dynamic_sidebar( 'presentation-2' ); ?>
	</div>
</div><!-- #secondary -->
