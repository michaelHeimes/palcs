<?php
$no_single_post = get_field('no_single_post') ?? null;
$show_content_on_hover = get_field('show_content_on_hover') ?? null;
$card_classes = $args['card-classes'] ?? null;
$thumb_id = get_post_thumbnail_id();
if( $card_classes != null ) {
	$card_classes = 'post-card cell load-more-filter-card hidden';
} else {
	$card_classes = 'post-card cell';
}
if( $show_content_on_hover == true ) {
	$card_classes .= ' hover-card loading';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($card_classes); ?>>
	<div class="inner relative">
		<?php if( !empty( $thumb_id ) ) {
			$imgID = $thumb_id;
			$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
			$img = wp_get_attachment_image( $imgID, 'post-card', false, [ "class" => "", "alt"=>$img_alt] );
			echo '<div class="thumbnail-wrap">';
			echo $img;
			echo '</div>';
		}?>
		<?php if( !$show_content_on_hover ):?>
			<a class="color-blue permalink grid-x align-bottom" href="<?= esc_url(get_the_permalink());?>">
				<div class="text-wrap">
				<h3 class="color-blue"><?php the_title();?></h3>
				</div>
			</a>
			
		<?php else:
			$hover_text = get_field('hover_text') ?? null;	
		?>
			<div class="color-blue permalink grid-x align-bottom" href="<?= esc_url(get_the_permalink());?>">
				<div class="text-wrap">
					<h3 class="color-blue"><?php the_title();?></h3>
					<div class="content-wrap">
						<?=esc_html( $hover_text );?>
					</div>
				</div>
			</div>
		<?php endif;?>		
	</div>
</article>