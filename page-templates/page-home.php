<?php
/**
 * Template name: Home Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();
?>
	<div class="content">
		<div class="inner-content">

			<main id="primary" class="site-main">
		
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<header class="entry-header home-banner text-center">

					</header><!-- .entry-header -->
				
						<?php get_template_part('template-parts/section', 'ctas-video-slider');?>
						
						<?php get_template_part('template-parts/section', 'copy-select-dropdown-links');?>
						
						<?php get_template_part('template-parts/section', 'dual-sliders-quote-image-video-icon-text-rows');?>
						
						<?php get_template_part('template-parts/section', 'latest-posts');?>
						
						<?php get_template_part('template-parts/section', 'cta-centered-heading-two-buttons');?>
							
					<footer class="article-footer">
						 <?php wp_link_pages(); ?>
					</footer> <!-- end article footer -->
						
				</article><!-- #post-<?php the_ID(); ?> -->
		
			</main><!-- #main -->
				
		</div>
	</div>

<?php
get_footer();