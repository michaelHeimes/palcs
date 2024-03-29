<?php
/**
 * Template name: Academics Interior
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
						if( !empty( $fields['parent_title'] ) || !empty( $fields['onpage_links'] ) ) {
							$parent_title = $fields['parent_title'] ?? null;
							$onpage_links = $fields['onpage_links'] ?? null;
							get_template_part('template-parts/section', 'onpage-nav',
								array(
									'parent_title' => $parent_title,
									'onpage_links' => $onpage_links,
								),
							);
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
								get_template_part('template-parts/part', 'image-copy-row',
									array(
										'is_intro' => true,
										'layout' => 'image-right',
										'image' => $image,
										'copy' => $copy,
										'bottom_border_style' => $bottom_border_style,
									),
								);
							}
							if( $layout == '50-50' ) {
								$wywiwygs_50_50 = $fields['wywiwygs_50_50'];
								if( !empty($wywiwygs_50_50 ) ) {
									get_template_part('template-parts/part', 'wywiwygs-50-50', 
										array(
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
					
					<?php if (has_blocks()):?>
						<div class="blocks grid-container">
							<div class="grid-x grid-padding-x align-center">
								<div class="cell small-12 large-11 xlarge-10">
									<?php the_content();?>
								</div>
							</div>
						</div>
					<?php endif;?>
					
					<?php
						if( !empty( $fields['latest_category_posts_category'] ) ) {
							$lcp_cat = $fields['latest_category_posts_category'] ?? null;
							$lcp_bg_img = $fields['latest_category_posts_background_image'] ?? null;
							$lcp_heading = $fields['latest_category_posts_heading'] ?? null;
							$lcp_link = $fields['latest_category_posts_cta_button_link'] ?? null;
							get_template_part('template-parts/section', 'latest-posts-category',
								array(
									'lcp_cat' => $lcp_cat,
									'lcp_bg_img' => $lcp_bg_img,
									'lcp_heading' => $lcp_heading,
									'lcp_link' => $lcp_link,
								),
							);
						}
					?>
					
					<?php
						if( !empty( $fields['cta_teachers_background_image'] ) || !empty( $fields['cta_teachers_heading'] ) || !empty( $fields['cta_teachers_background_image'] ) || !empty( $fields['cta_teachers_background_image'] ) ) {
							$teachers_cta_bg = $fields['cta_teachers_background_image'] ?? null;
							$cta_teachers_heading = $fields['cta_teachers_heading'] ?? null;
							$cta_teachers_text = $fields['cta_teachers_text'] ?? null;
							$cta_teachers_button_link = $fields['cta_teachers_button_link'] ?? null;
							get_template_part('template-parts/section', 'cta-teachers',
								array(
									'teachers_cta_bg' => $teachers_cta_bg,
									'cta_teachers_heading' => $cta_teachers_heading,
									'cta_teachers_text' => $cta_teachers_text,
									'cta_teachers_button_link' => $cta_teachers_button_link,
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