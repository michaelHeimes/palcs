<?php
$cta_video_slider_slides = get_field('cta_video_slider_slides') ?? get_sub_field('cta_video_slider_slides') ?? null;
?>
<section class="ctas-video-slider overflow-hidden" itemprop="text">

	<?php if( !empty($cta_video_slider_slides) ):?>
		<div class="ctas-video-slider-swiper img-pagination-slider" data-autoplaydelay="5000">
			<div class="swiper-wrapper">
				<?php $i = 0; foreach($cta_video_slider_slides as $cta_video_slider_slide):
					$heading = $cta_video_slider_slide['heading'] ?? null;
					$button_1 = $cta_video_slider_slide['button_1'] ?? null;
					$button_2 = $cta_video_slider_slide['button_2'] ?? null;
					$video_thumbnail_image = $cta_video_slider_slide['video_thumbnail_image'] ?? null;
					$video_url = $cta_video_slider_slide['video_url'] ?? null;
				?>
					<div class="swiper-slide">
						<div class="grid-container">
							<div class="grid-x grid-padding-x inner-height-control">
								<?php if( !empty($heading) || !empty($button_1) || !empty($button_2) ):?>
									<div class="left cell small-12 tablet-6 xxlarge-5 grid-x align-middle">
										<div class="bg gradient-1 vw-flush-left"></div>
										<div class="inner grid-x grid-padding-x">
											<?php if( !empty($heading) ):?>
												<div class="cell heading-wrap white-color">
													<?=$heading;?>
												</div>
												<?php if( !empty($button_1) || !empty($button_2) ):?>
													<div class="cell button-group grid-x grid-padding-x">
														<?php 
														$link = $button_1;
														if( $link ): 
															$link_url = $link['url'];
															$link_title = $link['title'];
															$link_target = $link['target'] ? $link['target'] : '_self';
															?>
														<div class="cell small-12<?php if( $button_2 ) { echo ' xlarge-6'; };?>">
															<a class="button black-ds" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
														</div>
														<?php endif; ?>
														<?php 
														$link = $button_2;
														if( $link ): 
															$link_url = $link['url'];
															$link_title = $link['title'];
															$link_target = $link['target'] ? $link['target'] : '_self';
															?>
														<div class="cell small-12 xlarge-6">
															<a class="button black-ds" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
														</div>
														<?php endif; ?>
													</div>
												<?php endif;?>	
											<?php endif;?>
										</div>
									</div>
								<?php endif;?>
								<?php if( !empty($video_thumbnail_image) || !empty($video_url) ):?>
									<div class="right cell small-12 tablet-6 xxlarge-7">
										<?php get_template_part('template-parts/part', 'image-video-modal', 
											array(
												'video_thumbnail_image' => $video_thumbnail_image,
												'video_url' => $video_url,
												'modal_id' => $heading,
											),
										);?>
									</div>
								<?php endif;?>
							</div>
						</div>
					</div>
				<?php $i++; endforeach;?>
			</div>
			<div class="grid-x grid-padding-x align-right">
				<div class="right sp-wrap cell small-12 tablet-6 xxlarge-7">
					<div class="inner">
						<div class="swiper-pagination"></div>
					</div>
				</div>
			</div>
		</div>
	<?php endif;?>
	<div class="gradient-border"></div>
</section>