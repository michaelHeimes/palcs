<?php
$cta_video_slider_slides = get_field('cta_video_slider_slides') ?? get_sub_field('cta_video_slider_slides') ?? null;
?>
<section class="ctas-video-slider" itemprop="text">

				<?php if( !empty($cta_video_slider_slides) ):?>
					<div class="ctas-video-slider-swiper">
						<div class="swiper-wrapper">
							<?php foreach($cta_video_slider_slides as $cta_video_slider_slide):
								$heading = $cta_video_slider_slide['heading'] ?? null;
								$button_1 = $cta_video_slider_slide['button_1'] ?? null;
								$button_2 = $cta_video_slider_slide['button_2'] ?? null;
								$video_thumbnail_image = $cta_video_slider_slide['video_thumbnail_image'] ?? null;
								$video_url = $cta_video_slider_slide['video_url'] ?? null;
							?>
								<div class="swiper-slide">
									<div class="grid-container">
										<div class="grid-x grid-margin-x inner-height-control">
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
													<div class="inner">
														<?php if( !empty( $video_thumbnail_image ) ) {
															$imgID = $video_thumbnail_image['ID'];
															$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
															$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "image", "alt"=>$img_alt] );
															
															echo '<div class="img-wrap">';
															echo $img;
															
															if( !empty($video_url) ) {
																echo '<button type="button" class="no-style" data-open="' . sanitize_title($heading) . '-video-modal"><img class="play-icon" src="' . get_template_directory_uri() . '/assets/images/play-icon.svg"></button>';
															}
															
															echo '</div>';
															
														}?>
													</div>
												</div>
												<?php if( !empty($video_url) ):?>
													<div class="reveal large" id="<?=sanitize_title($heading);?>-video-modal" data-reveal data-animation-in="fade-in fast" data-animation-out="fade-out fast" data-reset-on-close="true">
														<div class="text-right">
															<button class="close-button no-style" data-close aria-label="Close modal" type="button">
																<span aria-hidden="true">&times;</span>
															 </button>
														</div>
														<div class="responsive-embed widescreen">
															<?php
															
															// Load value.
															$iframe = $video_url;
															
															// Use preg_match to find iframe src.
															preg_match('/src="(.+?)"/', $iframe, $matches);
															$src = $matches[1];
															
															// Add extra parameters to src and replace HTML.
															$params = array(
																'controls'  => 0,
																'hd'        => 1,
																'autohide'  => 1,
																'rel' => 0, 
															);
															$new_src = add_query_arg($params, $src);
															$iframe = str_replace($src, $new_src, $iframe);
															
															// Add extra attributes to iframe HTML.
															$attributes = 'frameborder="0"';
															$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
															
															// Display customized HTML.
															echo $iframe;
															?>
														</div>
													</div>	
												<?php endif;?>
											<?php endif;?>
										</div>
									</div>
								</div>
							<?php endforeach;?>
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

</section>