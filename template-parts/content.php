<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DEPC_template_theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-featured-thumbnail">
		<a href="<?php the_permalink()?>">
			<?php echo get_the_post_thumbnail($page->ID, 'thumbnail');?>
		</a>
	</div>

	<div class="content-description">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php depc_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'depc' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			?>

			<?php
				/// CUSTOM POST TYPE: Event Date

				if( function_exists('ACF') ) {
					if (get_field('event_date') ) {
						$dateFieldReturn = get_field('event_date');
						//echo $dateFieldReturn . '<br>';
						$formatedDate = explode('_',$dateFieldReturn);
						echo $formatedDate[1];
					}
				}
			?>

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
	</div>

	
</article><!-- #post-## -->
