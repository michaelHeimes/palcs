<?php
/**
 * Template name: Landing Page 3
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$hidden_h1 = get_field('hidden_h1') ?? null;
$faq = get_field('faq') ?? null;
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
					
					<?php get_template_part('template-parts/section', 'copy-collapsed-form');?>
					
					<?php get_template_part('template-parts/section', 'image-copy-repeater');?>
					
					
					<?php if( !empty($faq) && is_array($faq) ):?>
						<section class="faq-section module block accordion-block ">
							<div class="grid-container">
								<div class="inner grid-x grid-padding-x align-middle align-center">
									<div class="cell small-12 large-10 xlarge-8">
										<ul class="accordion" data-accordion="kzmhsl-accordion" data-allow-all-closed="true" data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-deep-link-smudge-delay="500" data-deep-link-smudge-offset="50">
											
											<?php $i = 1; foreach( $faq as $accordion ):
												$title = $accordion['title'];    
												$content = $accordion['content'];    
											?>    
											<li class="accordion-item" data-accordion-item>
												<a href="#<?= sanitize_title($title);?>" class="accordion-title font-header">
													<b><?= esc_attr($title);?></b>
													<span class="marker"></span>
												</a>
												<div class="accordion-content entry-content" data-tab-content id="<?= sanitize_title($title);?>">
													<?= $content;?>
												</div>
											</li>
											<?php $i++; endforeach;?>
										</ul>
									</div>
								</div>
							</div>
						</section>
						<div class="gradient-border"></div>
					<?php endif;?>
					
					<section class="entry-content">
						<div class="grid-container">
							<div class="inner grid-x grid-padding-x align-middle align-center">
								<div class="cell small-12 large-10 xlarge-8">
									<?php the_content();?>
								</div>
							</div>
						</div>
					</section>
								
				<div class="article-footer">
					<?php wp_link_pages(); ?>
				</div> <!-- end article footer -->
				
				<?php get_template_part('template-parts/section', 'cta-centered-heading-two-buttons');?>
					
			</article><!-- #post-<?php the_ID(); ?> -->
	
		</main><!-- #main -->
			
	</div>
</div>

<?php
get_footer();