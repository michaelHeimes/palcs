<?php
$image_type = $args['image_type'] ?? null; // used for background or right-half images
$modal_id = $args['modal_id'] ?? null;
$video_thumbnail_image = $args['video_thumbnail_image'] ?? null;
$video_url = $args['video_url'] ?? null;
$caption = $args['caption'] ?? null;
?>
<div class="inner">
	<?php if( !empty( $video_thumbnail_image ) || !empty( $video_url ) || !empty( $caption ) ) {
		
		if( !empty( $video_thumbnail_image) ) {
			$imgID = $video_thumbnail_image['ID'];
			$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
			$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "image", "alt"=>$img_alt] );
		}
		
		echo '<div class="img-wrap relative">';
		
		if( !empty( $video_thumbnail_image) ) {
			echo $img;
		}
		
		if( !empty($video_url) ) {
			echo '<button type="button" class="no-style" data-open="' . sanitize_title($modal_id) . '-video-modal"><img class="play-icon" src="' . get_template_directory_uri() . '/assets/images/play-icon.svg"></button>';
		}
		
		echo '</div>';
		
		if( !empty($caption) ) {
			echo '<p class="caption"><i>' . $caption . '</i></p>';
		}
		
	}?>
</div>
<?php if( !empty($video_url) ):?>
	<div class="reveal large video-modal" id="<?=sanitize_title($modal_id);?>-video-modal" data-reveal data-animation-in="fade-in fast" data-animation-out="fade-out fast" data-reset-on-close="true" data-deep-link="true">
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
			'rel' => 0, 
		);
		$new_src = add_query_arg($params, $src);
		$iframe = str_replace($src, '', $iframe);
		
		// Add extra attributes to iframe HTML.
		$attributes = 'frameborder="0"';
		$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
		
		// Display customized HTML.
		echo '<div class="responsive-embed widescreen" data-src-defer="' . $new_src . '">';
		echo $iframe;
		echo '</div>';
		?>
	</div>	
<?php endif;?>