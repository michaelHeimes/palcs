<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cell small-12 medium-6 tablet-4'); ?>>
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
					?>
					
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="cell small-12 large-8 xlarge-6">
					<div class="navigation-links grid-x grid-padding-x align-justify">
						<div class="previous-link cell shrink">
							<?php previous_post_link('<span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="9.609" height="15.561" viewBox="0 0 9.609 15.561"><path id="prev" d="M16.371,6,18.2,7.828,12.26,13.781,18.2,19.733l-1.828,1.828L8.59,13.781Z" transform="translate(-8.59 -6)" fill="#0150d4"/></svg></span> %link', 'Previous Event'); ?>
						</div>
						<div class="next-link cell shrink">
							<?php next_post_link('%link <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="9.609" height="15.561" viewBox="0 0 9.609 15.561"><path id="prev" d="M10.419,6,8.59,7.828l5.939,5.952L8.59,19.733l1.829,1.828L18.2,13.781Z" transform="translate(-8.59 -6)" fill="#0150d4"/></svg></span>', 'Next Event'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

