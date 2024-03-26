<?php 
$post_id = $post->ID;
$term_slugs = [];
$taxonomies = array('stage', 'grade', 'enrichment', 'department-1', 'department-2');
$combined_terms = '';

// Loop through each taxonomy
foreach ($taxonomies as $taxonomy) {
	// Get the terms assigned to the post for the current taxonomy
	$terms = get_the_terms($post_id, $taxonomy);

	// Check if there are any terms
	if ($terms && !is_wp_error($terms)) {
		// Loop through each term and add its slug to the array
		foreach ($terms as $term) {
			$term_slugs[] = $term->slug;
		}
	}
}

// Combine term slugs into a single string separated by spaces
if (!empty($term_slugs)) {
	$combined_terms = implode(' ', $term_slugs);
}

$article_classes = 'teacher-card cell small-12 medium-6 tablet-4 large-3 text-center hidden' . ' ' . $combined_terms;

// Output or use the combined terms as needed
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($article_classes); ?> data-terms="<?= esc_attr($combined_terms); ?>">
	<a href="<?= esc_url(get_permalink()); ?>" rel="bookmark">
		<?php

			$image_id = get_post_thumbnail_id($post_id);
			$image_data = wp_get_attachment_image_src($image_id, 'staff-grid') ?? null;
			
			if ($image_data) {
				$thumbnail_url = $image_data[0];
			
				// Get the attachment metadata
				$attachment_metadata = wp_get_attachment_metadata($image_id);
			
				// Get alt text and title
				$alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
				$title = isset($attachment_metadata['image_meta']['title']) ? $attachment_metadata['image_meta']['title'] : '';
			
				// Output the image with alt text and title
				echo '<div class="circle-thumb-wrap"><img width="596" height="596" src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($alt_text) . '" title="' . esc_attr($title) . '" decoding="async" loading="lazy"></div>';
				
			} elseif( !empty( get_field('post_fallback_thumbnail','option') ) ) {
				$imgID = get_field('post_fallback_thumbnail','option')['ID'];
				$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
				$img = wp_get_attachment_image( $imgID, 'staff-grid', false, [ "class" => "", "alt"=>$img_alt] );
				echo '<div class="circle-thumb-wrap">' . $img . '</div>';
			}
		?>
		<h3 class="h6 color-blue"><?php the_title(); ?></h3>
		<?php
		$excerpt = get_the_excerpt($post_id);
		
		if ($excerpt) {
			echo '<h4>' . esc_html($excerpt) . '</h4>';
		}
		?>
	</a>
</article>