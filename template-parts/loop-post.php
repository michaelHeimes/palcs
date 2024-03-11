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
			$img = wp_get_attachment_image( $imgID, 'post-card', false, [ "class" => "", "alt"=>$img_alt] );
			echo '<div class="thumbnail-wrap">';
			echo $img;
			echo '<a class="color-blue permalink grid-x align-bottom" href="' . get_the_permalink() . '"><h3 class="color-blue">' . get_the_title() . '</h3></a>';
			echo '</div>';
		}?>
	</div>
</article>