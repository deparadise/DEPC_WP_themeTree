<div id="page-banner-container row"
	class="
	featured-window
	<?php if(is_front_page()):?>home-banner<?php else:?>page-banner<?php endif;?>
">
	<?php // DEPC todo: account for archive template
	if(is_front_page()) {

		if ( function_exists('ACF') ) {
			if (get_field('simple_slider') && is_page_template('home.php')) {
				$url_collection = get_field('simple_slider');
				$url_collection = str_getcsv($url_collection, ",");

				?>
					<span>
						<?php
							// TEST DISPLAY OUTPUT FROM ACF TO TEMPLATE
							//print_r ($url_collection)
						?>
					</span>

					<div class="simple-slider">
						<?php foreach($url_collection as $index=>$url) { ?>
							<div><img src="<?php echo $url?>"></div>
						<?php } ?>
					</div>
				<?php
			} else {
				echo get_the_post_thumbnail($page->ID, 'full');
				?> <span class="img-screen"></span> <?php
			}
		} else {
			echo get_the_post_thumbnail($page->ID, 'full');
			?> <span class="img-screen"></span> <?php
		}

		if ( function_exists('ACF') ) {
			if (get_field('tagline') && is_page_template('home.php')) {

				?>
				<header class="home-page-header columns medium-8 medium-push-2">
					<span class="tag-1"><h1><?php echo get_field('tagline') ?></h1></span>
				</header>
				<?php
			}
		}

	}elseif ( is_archive() ) {

		//the_archive_title( '<h1 class="page-title">', '</h1>' );

		$archiveTitle = get_the_archive_title();
		$colonPos = stripos($archiveTitle, ":");
		$archiveTitle = substr($archiveTitle, $colonPos + 2);

		echo '<h1 class="page-title">' . $archiveTitle . '</h1>';

	}else{ // DEFAULT HEADER DISPLAYS

			if($pageTemplate == 'Archive-Posts') :?>
			<?php //echo("<span style=\"color: red;\">ARCHIVE POSTS!</span>");
				$thumbCheck = z_taxonomy_image_url();
				//echo z_taxonomy_image_url();
			?>
			<?php if ($thumbCheck == !null):

			?>
				<img src="<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url(); ?>"/>
			<?php endif;?>

		<?php // DEPC todo: account for Single Post

			elseif ($pageTemplate == 'Single-Post') : ?>
			<?php //echo("<span style=\"color: green;\">SINGLE ARCHIVE POST!</span>");?>
			 <img src="<?php echo z_taxonomy_image_url($currentTerm); ?>" />

		<?php else:// DEFAULT PAGES?>

			<?php echo get_the_post_thumbnail($page->ID, 'full'); ?>

		<?php endif;?>

		<span class="img-screen"></span>

		<header class="entry-header columns medium-10 medium-push-1">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php } ?>
</div> <!-- END #page-banner-container -->
