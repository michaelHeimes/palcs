<?php
/**
 * Template name: Landing Page 2


 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();
$gravity_form = $fields['gravity_form'] ?? null;
$gravity_form_title = $fields['gravity_form_title'] ?? null;
$gravity_form_subtitle = $fields['gravity_form_subtitle'] ?? null;
$gravity_form_text = $fields['gravity_form_text'] ?? null;
$wywiwygs_50_50 = $fields['wywiwygs_50_50'];
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
						if( !empty( $wywiwygs_50_50 ) ) {
					
							$wywiwygs_50_50 = $fields['wywiwygs_50_50'];
							$intro_button_link = $fields['intro_cta_button'] ?? null;
							if( !empty($wywiwygs_50_50 ) ) {
								get_template_part('template-parts/part', 'wywiwygs-50-50', 
									array(
										'is_intro' => true,
										'wywiwygs_50_50' => $wywiwygs_50_50,
										'button_link' => $intro_button_link,
									) 
								);
							}
							
						}
						
						echo '<div class="gradient-border"></div>';
						
					?>
					
					<?php
						if( !empty( $fields['image_copy_repeater'] ) ) {
							get_template_part('template-parts/section', 'image-copy-repeater', 
								array(
								'is_intro' => true,
								)
							);
						}
					?>
					
					<?php if (has_blocks()):?>
						<div class="blocks grid-container entry-content">
							<div class="grid-x grid-padding-x align-center">
								<div class="cell small-12 large-10 xlarge-8">
									<?php the_content();?>
								</div>
							</div>
						</div>
					<?php endif;?>
					
					<?php
						if( !empty( $fields['latest_category_posts_category_id'] ) || !empty( $fields['latest_category_posts_background_image'] ) || !empty( $fields['latest_category_posts_heading'] ) || !empty( $fields['latest_category_posts_cta_button_link'] ) ) {
							$lcp_cat = $fields['latest_category_posts_category_id'] ?? null;
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
							
					<?php if($gravity_form || $gravity_form_title || $gravity_form_subtitle || $gravity_form_text ):?>
						<section id="form" class="lp-form">
							<div class="grid-container">
								<div class="grid-x grid-padding-x align-center">
									<div class="cell small-12 large-10 xlarge-8">
										<?php if($gravity_form_title):?>
											<h2 class="h1 text-center"><?=wp_kses_post( $gravity_form_title );?></h2>
										<?php endif;?>
										<?php if($gravity_form_subtitle):?>
											<h3 class="text-center"><?=wp_kses_post( $gravity_form_subtitle );?></h3>
										<?php endif;?>
										<?php if($gravity_form_text):?>
											<div class="text-wrap text-center font-size-20"><?=wp_kses_post( $gravity_form_text );?></div>
										<?php endif;?>
										<?php if ($gravity_form && $gravity_form !== 'none') :?>
											<div class="form-wrap">
												<?php
												$escaped_gravity_form = acf_esc_html($gravity_form);
												gravity_form( $escaped_gravity_form, false, false, false, '', true, 12 ); 
												?>
											</div>
										<?php endif;?>
									</div>
								</div>
							</div>
						</section>
					<?php endif;?>
						
				</article><!-- #post-<?php the_ID(); ?> -->
		
			</main><!-- #main -->
				
		</div>
	</div>
	<div class="gradient-border"></div>

<?php
get_footer();