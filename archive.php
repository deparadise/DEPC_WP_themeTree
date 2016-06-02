<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DEPC_template_theme
 */

get_header(); ?>

<?php get_template_part('template-parts/content', 'featuredWindow'); ?>

	<div id="primary" class="content-area archive-template row">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					//the_archive_title( '<h1 class="page-title">', '</h1>' );
					//the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php
				// Get the queryObj to access and test post-type
				$archiveQueryObj = get_queried_object();
				//print_r($archiveQueryObj);
				$postTypeSetup = $archiveQueryObj->query_var;
				//echo $postTypeSetup;

				if ($postTypeSetup == 'events') {
					
					if ( function_exists('ACF') ) {
						if ( get_field('event_date') ) {
							//echo "I am the events page!!!";
							
							$posts = get_posts(array(
								'post_type'	=> 'events',
								'meta_key'	=> 'event_date',
								'orderby'	=> 'meta_value_num',
								'order'		=> 'ASC'
							));
							//print_r($posts);

							// loop
							if( $posts ) {
								
								foreach( $posts as $post ) {
									
									setup_postdata( $post );

									// do something
									get_template_part( 'template-parts/content', get_post_format() );
								}

								wp_reset_postdata();
								
							}
						}
					}else{ // Business as usual...
						while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );
						
						endwhile;
					}

				}else{ // Business as usual...
					while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
					
					endwhile;
				}
			?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
