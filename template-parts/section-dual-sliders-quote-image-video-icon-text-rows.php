<?php 
$background_image = get_field('dsivitr_background_image') ?? get_sub_field('dsivitr_background_image') ?? null;
$heading = get_field('dsivitr_heading') ?? get_sub_field('dsivitr_heading') ?? null;
$image_video_slides = get_field('dsivitr_quote_or_imagevideo_slides') ?? get_sub_field('dsivitr_quote_or_imagevideo_slides') ?? null;
$icon_text_rows = get_field('dsivitr_icon_text_rows') ?? get_sub_field('dsivitr_icon_text_rows') ?? null;
$ctahb_heading = get_field('ctahb_heading') ?? get_sub_field('ctahb_heading') ?? null;
$ctahb_button_link = get_field('ctahb_button_link') ?? get_sub_field('ctahb_button_link') ?? null;
?>
<section class="dual-sliders-quote-image-video-icon-text-rows relative overflow-hidden has-bg">
	<?php if( !empty( $background_image ) ) {
		$imgID = $background_image['ID'];
		$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
		$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "bg-img", "alt"=>$img_alt] );
		echo $img;
	}?>
	<div class="grid-container relative">
		<?php if( !empty($heading) ):?>
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 text-center">
					<h2><?=$heading;?></h2>
				</div>
			</div>
		<?php endif;?>
		<?php if( !empty($image_video_slides) || !empty($icon_text_rows) ):?>
			<div class="grid-x grid-padding-x both-wrap">
				<?php if( !empty($image_video_slides) ):?>
					<div class="left cell small-12 tablet-5 xlarge-4 img-pagination-slider grid-x flex-dir-column" data-crossfade="true">
						<div class="swiper-wrapper">
							<?php $i = 1; foreach($image_video_slides as $slide):
								$slide_type = $slide['slide_type'] ?? null;
							?>
								<div class="swiper-slide">
									<?php 
									if( $slide_type == 'image-video' ) {
										$video_thumbnail_image = $slide['video_thumbnail_image'] ?? null;
										$video_url = $slide['video_url'] ?? null;
										$caption = $slide['caption'] ?? null;
										get_template_part('template-parts/part', 'image-video-modal', 
											array(
												'video_thumbnail_image' => $video_thumbnail_image,
												'video_url' => $video_url,
												'caption' => $caption,
												'modal_id' => 'slide-' . $i,
											),
										);
									}
									if( $slide_type == 'quote' ):
										$quote_text = $slide['quote_text'] ?? null;
										$quote_citation = $slide['quote_citation'] ?? null;
									?>
										<?php if( !empty($quote_text) ):?>
											<p class="weight-medium quote-text"><i><?=$quote_text;?></i></p>
										<?php endif;?>
										<?php if( !empty($quote_citation) ):?>
											<cite class="color-blue weight-medium"><?=$quote_citation;?></cite>
										<?php endif;?>
									<?php endif;
									?>
								</div>
							<?php $i++; endforeach;?>
						</div>
						<div class="swiper-pagination grid-x align-center align-bottom"></div>
					</div>
				<?php endif;?>
				<?php if( !empty($icon_text_rows) ):?>
					<div class="right cell small-12 tablet-7 xlarge-8 grouped-2-col-3-row grid-x flex-dir-column overflow-hidden">
						<div class="swiper-wrapper">
							<?php $counter = 0; foreach($icon_text_rows as $row):
								$icon = $row['icon'];
								$heading = $row['heading'];
								$text = $row['text'];
								
								if ($counter % 3 === 0) {
									echo '<div class="swiper-slide">';
								}?>
									<div class="grid-x grid-padding-x">
										<?php if( !empty( $icon ) ) {
											$imgID = $icon['ID'];
											$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
											$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
											echo '<div class="icon-wrap cell small-3 text-center">';
											echo $img;
											echo '</div>';
										}?>
										<?php if( !empty($heading) || !empty($text) ):?>
											<div class="text-wrap cell auto">
												<?php if( !empty($heading) ):?>
													<h3 class="h4 font-poppins weight-medium color-blue"><?=$heading;?></h3>
												<?php endif;?>
												<?php if( !empty($text) ):?>
													<p><?=$text;?></p>
												<?php endif;?>
											</div>
										<?php endif;?>
									</div>
								<?php if ($counter % 3 === 2 || $counter === count($icon_text_rows) - 1) {
									echo '</div>';
								}?>
							<?php $counter++; endforeach;?>
						</div>
						<div class="swiper-pagination grid-x align-center align-bottom"></div>
					</div>
				<?php endif;?>
			</div>
		<?php endif;?>
		<?php if( !empty($ctahb_heading) || !empty($ctahb_button_link) ){
			get_template_part('template-parts/part', 'heading-button-link-cta', 
				array(
					'heading' => $ctahb_heading,
					'link' => $ctahb_button_link,
				)
			);
		}?>
	</div>
</section>
<div class="gradient-border"></div>