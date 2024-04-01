<?php
	$thumb_id = get_post_thumbnail_id();
	$categories = get_the_category();
	$first_category = '';
	if ($categories) {
		$first_category = $categories[0];
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-card cell small-12 medium-6 tablet-4'); ?>>
	<div class="inner relative">
		<?php if( !empty( $thumb_id ) ) {
			$imgID = $thumb_id;
			$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
			$img = wp_get_attachment_image( $imgID, 'recent-post-card', false, [ "class" => "", "alt"=>$img_alt] );
			echo '<div class="thumbnail-wrap">';
			echo $img;
			echo '</div>';
		}?>
		<a class="color-dark-gray permalink grid-x align-bottom" href="<?= esc_url(get_the_permalink());?>">
			<h3><?= esc_attr( get_the_title() );?> </h3>
		</a>
		<a class="cat-link text-center" href="<?=esc_url(get_category_link($first_category->term_id));?>"><?=esc_attr($first_category->name);?></a>
	</div>
</article>