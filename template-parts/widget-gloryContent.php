<div class="glory-display widget">
	<?php
		if ( function_exists('ACF') ) {
			if (get_field('glory_display') && is_page_template('home.php')) {

				echo get_field('glory_display'); 

			}
		}
	?>
</div>