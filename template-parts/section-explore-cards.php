<?php
$bg_img = $args['bg_img'] ?? null;
$heading = $args['heading'] ?? null;
$cards = $args['cards'] ?? null;
?>
<section class="explore-cards relative">
	<?php if( !empty( $bg_img ) ) {
		$imgID = $bg_img['ID'];
		$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
		$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "bg-img", "alt"=>$img_alt] );
		echo $img;
	}?>
	<div class="mask bg-img"></div>
	<div class="grid-container relative">
		<div class="grid-x grid-padding-x text-center align-center">
			<?php if( !empty($heading) ):?>
				<div class="cell small-12">
					<h2 class="color-white"><?=esc_attr( $heading );?></h2>
				</div>
			<?php endif;?>
			<?php if( !empty($cards) ):
				foreach($cards as $card):	
				$image = $card['image'];
				$link = $card['link'];
			?>
				<div class="card cell small-12 medium-6 tablet-3">
					<div class="inner relative">
						<?php if( !empty($image) ) {
							$imgID = $image['ID'];
							$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
							$img = wp_get_attachment_image( $imgID, 'post-card', false, [ "class" => "", "alt"=>$img_alt] );
							echo '<div class="thumbnail-wrap">';
							echo $img;
							if( !empty($link) ) {
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								echo '<a class="color-sky-blue grid-x align-bottom" href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '"><h3 class="color-sky-blue uppercase p grid-x align-middle align-center">' . esc_html( $link_title ) . '<svg xmlns="http://www.w3.org/2000/svg" width="9.445" height="15.295" viewBox="0 0 9.445 15.295"><path id="ic_chevron_right_24px" d="M10.387,6,8.59,7.8l5.838,5.85L8.59,19.5l1.8,1.8,7.647-7.647Z" transform="translate(-8.59 -6)" fill="#379ff8"/></svg></h3></a>';
							}
							echo '</div>';
						}?>
					</div>
				</div>
			<?php endforeach; endif;?>
		</div>
	</div>
</section>
<div class="gradient-border"></div>