<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package trailhead
 */

get_header();
?>
	<div class="content">
		<main id="primary" class="site-main">
	
			<article class="content-not-found">
				<?php get_template_part('template-parts/banner', 'full-width-image');?>
				<div class="grid-container">
					<div class="grid-x grid-padding-x align-center">
						<div class="cell small-12 large-11 xlarge-10">

							<section class="entry-content">
								<?=wp_kses_post( get_field('404_error_text', 'option') );?>
							</section> <!-- end article section -->
							
						</div>
					</div>
				</div>
			</article> <!-- end article -->
	
		</main><!-- #main -->
	</div>
<?php
get_footer();
