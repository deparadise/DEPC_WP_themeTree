<?php
/**
 * Template part for displaying testimonial posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DEPC_template_theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('testimonial'); ?>>

	<div class="post-featured-thumbnail">
		<a href="<?php the_permalink()?>">
			<?php echo get_the_post_thumbnail($page->ID, 'thumbnail');?>
		</a>
	</div>

	<div class="content-description">
		<header class="entry-header">
			<?php
				echo '<h2 class="paraphrase">', get_field('paraphrase'), '</h2>';
				//the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php //depc_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				echo '<div class="comment">', get_field('comment'), '</div>';

				echo '<p class="cite">', get_field('citation'), '</p>'
				// the_content( sprintf(
				// 	/* translators: %s: Name of current post. */
				// 	wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'depc' ), array( 'span' => array( 'class' => array() ) ) ),
				// 	the_title( '<span class="screen-reader-text">"', '"</span>', false )
				// ) );
			?>

			<?php
				// wp_link_pages( array(
				// 	'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'depc' ),
				// 	'after'  => '</div>',
				// ) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php depc_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>


</article><!-- #post-## -->
