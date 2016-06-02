<div class="partners-display widget">
	<?php
		if ( function_exists('ACF') ) {
			if (get_field('partners_display') && is_page_template('home.php')) {

				echo get_field('partners_display'); 

			}
		}
	?>
</div>