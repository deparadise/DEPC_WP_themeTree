<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package DEPC_template_theme
 */

get_header(); ?>

<?php get_template_part('template-parts/content', 'featuredWindow'); ?>

	<div id="primary" class="content-area single-template row">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<!-- Condition this -->

<div class="large-6 large-centered columns">
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
