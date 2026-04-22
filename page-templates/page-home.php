<?php
/**
 * Template name: Home Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$hidden_h1 = get_field('hidden_h1') ?? null;
?>
<div class="content">
	<div class="inner-content">

		<main id="primary" class="site-main">
	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<?php if( !empty($hidden_h1) ):?>
						<h1 class="show-for-sr">
							<?=wp_kses_post( $hidden_h1 );?>
						</h1>
					<?php endif;?>
			
					<?php get_template_part('template-parts/section', 'ctas-video-slider');?>
					
					<?php get_template_part('template-parts/section', 'copy-select-dropdown-links');?>
					
					<?php get_template_part('template-parts/section', 'dual-sliders-quote-image-video-icon-text-rows');?>
					
					<?php get_template_part('template-parts/section', 'latest-posts');?>
						
				<div class="article-footer">
					<?php wp_link_pages(); ?>
				</div> <!-- end article footer -->
					
			</article><!-- #post-<?php the_ID(); ?> -->
	
		</main><!-- #main -->
			
	</div>
</div>

<?php
get_footer();