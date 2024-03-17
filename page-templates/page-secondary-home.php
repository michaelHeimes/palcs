<?php
/**
 * Template name: Secondary Home Page

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
						
						<?php
							if( !empty( $fields['parent_link'] ) || !empty( $fields['onpage_links'] ) ) {
								$parent_link = $fields['parent_link'] ?? null;
								$onpage_links = $fields['onpage_links'] ?? null;
								get_template_part('template-parts/section', 'onpage-links',
									array(
										'parent_link' => $parent_link,
										'onpage_links' => $onpage_links,
									),
								);
							}
						?>
						
					</header><!-- .entry-header -->
				
						<?php 
							if( !empty( $fields['cta_video_slider_slides'] ) ) {
								get_template_part('template-parts/section', 'ctas-video-slider');
							}
						?>
						
						<?php 
							if( !empty( $fields['page_intro_layout'] ) ) {
								$layout = $fields['page_intro_layout'] ?? null;
								
								if( $layout == 'copy-image' ) {
									$copy_image = $fields['copy_image'] ?? null;
									$image = $copy_image['image'] ?? null;
									$copy = $copy_image['copy'] ?? null;
									get_template_part('template-parts/part', 'image-copy-row',
										array(
											'is_intro' => true,
											'layout' => 'image-right',
											'image' => $image,
											'copy' => $copy,
										),
									);
								}
								
							}
							echo '<div class="gradient-border"></div>';
						?>
						
						<?php
							if( !empty( $fields['image_copy_repeater'] ) ) {
								get_template_part('template-parts/section', 'image-copy-repeater');
							}
						?>
						
						<?php
							if( !empty( $fields['explore_cta_background_image'] ) || !empty( $fields['explore_cta_heading'] ) || !empty( $fields['explore_cta_cards'] ) ) {
								$bg_img = $fields['explore_cta_background_image'] ?? null;
								$heading = $fields['explore_cta_heading'] ?? null;
								$cards = $fields['explore_cta_cards'] ?? null;
								get_template_part('template-parts/section', 'explore-cards', 
									array(
										'bg_img' => $bg_img,
										'heading' => $heading,
										'cards' => $cards,
									),
								);
							}
						?>
							
					<footer class="article-footer">
						 <?php wp_link_pages(); ?>
					</footer> <!-- end article footer -->
						
				</article><!-- #post-<?php the_ID(); ?> -->
		
			</main><!-- #main -->
				
		</div>
	</div>

<?php
get_footer();