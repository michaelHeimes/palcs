<?php
$full_width_banner_image = '';

if ( is_home() ) {
	$posts_page_id = get_option('page_for_posts');
	$full_width_banner_image = get_field('full_width_banner_image', $posts_page_id);
} elseif ( is_archive() ) {
	$current_category = get_queried_object();
	if ($current_category && function_exists('get_field')) {
		$full_width_banner_image = get_field('full_width_banner_image', 'category_' . $current_category->term_id);
	}
} elseif ( is_404() ) {
	$full_width_banner_image = get_field('404_error_feature_image', 'option');

} else {
	$full_width_banner_image = get_field('full_width_banner_image');
}

$intro_size_classes = ' small-12 large-10';
if ( is_home() || is_archive() ) {
	$intro_size_classes = ' small-12 large-10 xxlarge-8';
}
?>

<header class="entry-header banner-full-width-image text-center">
	<?php 
	if( !empty( $full_width_banner_image ) ) {
		$imgID = $full_width_banner_image['ID'];
		$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
		$img = wp_get_attachment_image( $imgID, 'full-width-banner-image', false, [ "class" => "object-cover", "alt"=>$img_alt] );
		echo '<div class="img-wrap text-center">';
		echo $img;
		echo '<div class="gradient-border"></div>';
		echo '</div>';
	}?>
</header>
