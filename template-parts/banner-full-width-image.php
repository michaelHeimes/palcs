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
} else {
	$full_width_banner_image = get_field('full_width_banner_image');
}
?>

<header class="entry-header full-width-banner text-center">
	<?php 
	if( !empty( $full_width_banner_image ) ) {
		$imgID = $full_width_banner_image['ID'];
		$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
		$img = wp_get_attachment_image( $imgID, 'full-width-banner-image', false, [ "class" => "object-cover", "alt"=>$img_alt] );
		echo $img;
	}?>
	<div class="gradient-border"></div>
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<div class="cell small-12 large-10 text-left">
				<?php if ( is_archive() || is_home() ) {
					get_template_part('template-parts/part', 'grid-intro');
				}?>
			</div>
		</div>
	</div>
</header>
