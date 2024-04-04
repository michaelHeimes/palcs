<?php
$is_intro = $args['is_intro'] ?? null;
$layout = $args['layout'] ?? null;
$image = $args['image'] ?? null;
$copy = $args['copy'] ?? null;
$button_link = $args['button_link'] ?? null;
?>
<div class="icr-row grid-container<?php if( $is_intro == true ):?> intro<?php endif;?>">
	<div class="grid-x grid-padding-x <?=$layout;?>">
		<?php if( !empty( $image ) ):
			$imgID = $image['ID'];
			$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
			$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
		?>
			<div class="cell small-12<?php if( $is_intro == true ):?> tablet-6<?php else:?> tablet-5<?php endif;?>">
				<div class="img-wrap">
					<?php echo $img;?>
				</div>
			</div>
		<?php endif?>
		<?php if( !empty($copy) ):?>
			<div class="copy-wrap cell small-12<?php if( $is_intro == true ):?> tablet-6 large-5<?php else:?> tablet-7 large-6  xlarge-5<?php endif;?>">
				<div class="inner h1-style-h2">
					<?= wp_kses_post( $copy );?>
					<?php 
					$link = $button_link;
					if( $link ): 
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
					<div class="btn-wrap">
						<a class="button purple-ds" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif;?>
	</div>
</div>