<?php
$post_id = get_the_ID();
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

// Output or use the combined terms as needed
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('cell small-12 medium-6 tablet-4 large-3'); ?> data-terms="<?= esc_attr($combined_terms); ?>">
	<a href="<?= esc_url(get_permalink()); ?>" rel="bookmark">
		<?=get_the_post_thumbnail( $post_id, 'thumbnail' );?>
		<h3><?php the_title(); ?></h3>
		<?php the_excerpt();?>
	</a>
</article>
