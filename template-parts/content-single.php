<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DEPC_template_theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("columns large-10 large-push-1"); ?>>
	<header class="entry-header-meta">
		<div class="entry-meta">
			<?php //depc_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'depc' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php depc_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

