<?php 
$post_id = $post->ID;
$term_slugs = [];
$taxonomies = array('stage', 'specialty');
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

$article_classes = 'enrichment-card load-more-filter-card cell small-12 hidden' . ' ' . $combined_terms;

// Output or use the combined terms as needed
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($article_classes); ?> data-terms="<?= esc_attr($combined_terms); ?>">
	<a class="grid-x color-white" href="<?= esc_url(get_permalink()); ?>" rel="bookmark" data-equalizer-watch>
		<?php if( !empty( get_field('icon') ) ) {
			$imgID = get_field('icon')['ID'];
			$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
			$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
			echo '<div class="icon-wrap cell shrink">';
			echo '<div class="purple-bg grid-x align-middle align-center">';
			echo $img;
			echo '</div>';
			echo '</div>';
		}?>
		<div class="cell auto">
			<h3 class="h6"><?php the_title(); ?></h3>
		</div>
	</a>
</article>