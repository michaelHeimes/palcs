<?php

/**
 * Tabbed Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'block-videos' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block-videos';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}

$overview_video_url = get_field('overview_video_url') ?? null;
$overview_video_thumbnail = get_field('overview_video_thumbnail') ?? null;

$more_videos_copy = get_field('more_videos_copy') ?? null;
$videos = get_field('videos') ?? null;

?>
<section id="<?php echo esc_attr($id); ?>" class="module block <?php echo esc_attr($className); ?>">
	<?php if( !empty($overview_video_url) || !empty($overview_video_thumbnail) || !empty($videos) ):?>
		<ul class="tabs" data-tabs id="<?=$block['id'];?>-tabs">
			<?php if( !empty($overview_video_url) || !empty($overview_video_thumbnail) ):?>
				<li class="tabs-title is-active" aria-selected="true">
					<a href="#overview-<?=$block['id'];?>">Overview</a>
				</li>
			<?php endif;?>
			<?php if( !empty($videos) ):?>
				<li class="tabs-title more-vids-tab" aria-selected="false">
					<a href="#more-videos-<?=$block['id'];?>">More Videos</a>
				</li>
			<?php endif;?>	
		</ul>
		<?php if( !empty($overview_video_url) || !empty($overview_video_thumbnail) ):?>
		<div class="tabs-content" data-tabs-content="<?=$block['id'];?>-tabs">
			<div class="tabs-panel overview is-active" id="overview-<?=$block['id'];?>" aria-hidden="false">
				
				<?php
				
				// Load value.
				$iframe = $overview_video_url;
				
				// Use preg_match to find iframe src.
				preg_match('/src="(.+?)"/', $iframe, $matches);
				$src = $matches[1];
				
				// Add extra parameters to src and replace HTML.
				$params = array(
					'controls'  => 1,
					'hd'        => 1,
					'autohide'  => 1,
					'rel'       => 0,
				);
				$new_src = add_query_arg($params, $src);
				$iframe = str_replace($src, $new_src, $iframe);
				
				// Add extra attributes to iframe HTML.
				$attributes = 'frameborder="0"';
				$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
				
				// Display customized HTML.
				echo '<div class="responsive-embed widescreen">';
				echo $iframe;
				echo '</div>';
				?>
			</div>
			<?php endif;?>
			<div class="tabs-panel more-videos posts-page" id="more-videos-<?=$block['id'];?>" aria-hidden="true">
				<?php if( !empty($more_videos_copy) ):?>
					<div class="form-intro-copy">
						<?=wp_kses_post($more_videos_copy);?>
					</div>
				<?php endif;?>
				<?php
				$form_id = get_field('gravity_form') ?? null;
				if ($form_id && $form_id !== 'none') {
					$escaped_form_id = acf_esc_html($form_id);
					gravity_form( $escaped_form_id, false, false, false, '', true, 12 ); 
				}
				if( !empty($videos) ):?>
					<section class="isotope-filter-loadmore loading overflow-hidden" data-postsinit="0" data-postsper="9" style="height: 0;visibility: hidden;opacity: 0;">
						<div class="grid-container">
							<div class="cell small-12 large-10 xxlarge-8">
								<div class="filter-grid grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-3">
									<?php $i = 1; foreach( $videos as $video ):
										$video_url = $video['video_url'] ?? null;
										$video_thumbnail = $video['video_thumbnail'] ?? null;
										$excerpt = $video['excerpt'] ?? null;
									?>
										<?php if( !empty($video_url) ):?>
											<article class="cell load-more-filter-card hidden">
												<button class="no-style relative" data-open="video-modal-<?=$block['id'];?>-<?=$i;?>">
													<div class="img-play-wrap relative">
														<?php if( !empty( $video_thumbnail ) ) {
															$imgID = $video_thumbnail['ID'];
															$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
															$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
															echo $img;
														}?>
														<div class="play-btn-wrap grid-x align-middle align-center">
															<svg xmlns="http://www.w3.org/2000/svg" width="105" height="105" viewBox="0 0 105 105"><g id="Group_348" data-name="Group 348" transform="translate(557.954 190)"><circle id="Ellipse_2" data-name="Ellipse 2" cx="52.5" cy="52.5" r="52.5" transform="translate(-557.954 -190)" fill="#383838" opacity="0.834"/><path id="Polygon_2" data-name="Polygon 2" d="M27.5,0,55,48H0Z" transform="translate(-476.954 -165) rotate(90)" fill="#ff1b59"/></g></svg>
														</div>
													</div>
													<?php if( !empty($excerpt) ):?>
														<div class="excerpt text-left">
															<?=esc_html( $excerpt );?>
														</div>
													<?php endif;?>
												</button>
											</article>
											<div class="reveal large video-modal" id="video-modal-<?=$block['id'];?>-<?=$i;?>" data-reveal data-animation-in="fade-in fast" data-animation-out="fade-out fast" data-reset-on-close="true" data-deep-link="true">
												<div class="text-right">
													<button class="close-button no-style" data-close aria-label="Close modal" type="button">
														<span aria-hidden="true">&times;</span>
													 </button>
												</div>
												<?php
												
												// Load value.
												$iframe = $video_url;
												
												// Use preg_match to find iframe src.
												preg_match('/src="(.+?)"/', $iframe, $matches);
												$src = $matches[1];
												
												// Add extra parameters to src and replace HTML.
												$params = array(
													'controls'  => 1,
													'hd'        => 1,
													'autohide'  => 1,
													'rel'       => 0,
												);
												$new_src = add_query_arg($params, $src);
												//$iframe = str_replace($src, '', $iframe);
												$iframe = str_replace($src, '', $iframe);
												
												// Add extra attributes to iframe HTML.
												$attributes = 'frameborder="0"';
												$iframe = str_replace('></iframe>', '' . $attributes . '></iframe>', $iframe);
												
												// Display customized HTML.
												echo '<div class="responsive-embed widescreen" data-src-defer="' . $new_src . '">';
												echo $iframe;
												echo '</div>';
												?>
											</div>
										<?php endif;?>
										
									<?php $i++; endforeach;?>
								</div>		
							</div>			
							<div class="text-center load-more-wrap" style="display: none;">
								<button class="button purple-ds" id="load-more">Load More</button>
							</div>
						</div>
					</section>
				<?php endif;?>
				

			</div>
		</div>  
	<?php endif;?>
</section>

