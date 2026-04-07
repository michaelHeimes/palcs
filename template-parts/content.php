<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('cell small-12 medium-6 tablet-4'); ?>>
	<?php get_template_part('template-parts/banner', 'full-width-image');?>
	<header class="entry-header">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="cell small-12 large-11 xlarge-10">
		
					<?php the_title( '<h1 class="entry-title">', '</h1>' );?>
					
				</div>
			</div>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="cell small-12 large-11 xlarge-10">
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'trailhead' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						)
					);
			
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'trailhead' ),
							'after'  => '</div>',
						)
					);
					?>
					
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->
</div><!-- #post-<?php the_ID(); ?> -->

