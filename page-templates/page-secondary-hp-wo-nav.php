<?php
/**
 * Template name: Secondary HP: w/o Nav

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

					<?php 
						if( !empty( $fields['cta_video_slider_slides'] ) ) {
							get_template_part('template-parts/section', 'ctas-video-slider');
						}
					?>
					
					<?php 
						if( !empty( $fields['page_intro_layout'] ) ) {
							$layout = $fields['page_intro_layout'] ?? null;
							$bottom_border_style = $fields['bottom_border_style'] ?? null;
							if( $layout == 'copy-image' ) {
								$copy_image = $fields['copy_image'] ?? null;
								$image = $copy_image['image'] ?? null;
								$copy = $copy_image['copy'] ?? null;
								$button_link = $copy_image['button_link'] ?? null;
								get_template_part('template-parts/part', 'image-copy-row',
									array(
										'is_intro' => true,
										'layout' => 'image-right intro-img',
										'image' => $image,
										'copy' => $copy,
										'bottom_border_style' => $bottom_border_style,
										'button_link' => $button_link,
									),
								);
							}
							if( $layout == '50-50' ) {
								$wywiwygs_50_50 = $fields['wywiwygs_50_50'];
								if( !empty($wywiwygs_50_50 ) ) {
									get_template_part('template-parts/part', 'wywiwygs-50-50', 
										array(
											'is_intro' => true,
											'wywiwygs_50_50' => $wywiwygs_50_50,
										) 
									);
								}
							}
							
						}
						if( $bottom_border_style != 'none' ) {
							echo '<div class="gradient-border"></div>';
						}
					?>
											
					<?php
						if( !empty( $fields['image_copy_repeater'] ) ) {
							get_template_part('template-parts/section', 'image-copy-repeater');
						}
					?>
					
					<?php if (has_blocks()):?>
						<div class="blocks grid-container">
							<div class="grid-x grid-padding-x align-center">
								<div class="cell small-12 large-10 xlarge-8">
									<?php the_content();?>
								</div>
							</div>
						</div>
					<?php endif;?>
					
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