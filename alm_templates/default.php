<?php
$post_id = get_the_ID();
$term_slugs = [];
$taxonomies = array('stage', 'grade');

// Loop through each taxonomy
foreach ($taxonomies as $taxonomy) {
	// Get the terms assigned to the post for the current taxonomy
	$terms = get_the_terms($post_id, $taxonomy);

	// Check if there are any terms
	if ($terms && !is_wp_error($terms)) {
		// Loop through each term and add its name to the array
		foreach ($terms as $term) {
			$term_names[] = $term->slug;
		}
	}
}

// Combine term names into a single string separated by spaces
$combined_terms = implode(' ', $term_names);

// Output or use the combined terms as needed
echo esc_html($combined_terms);

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-terms="<?=$combined_terms;?>">
	<a href="<?=esc_url( get_permalink() );?>" rel="bookmark">
		<h3><?php the_title();?></h3>
	</a>
	<?php
		// Get the post ID
	
		
		// Specify the taxonomy you want to retrieve terms from
		
		// Get the terms assigned to the post for the specified taxonomy
		
		$terms = get_the_terms($post_id, 'stage');
		// Check if there are any terms
		if ($terms && !is_wp_error($terms)) {
			// Loop through each term and do something with it
			foreach ($terms as $term) {
				$term_name = $term->name; // Get the term name
				$term_link = get_term_link($term); // Get the term link
		
				// Output or use the term information as needed
				echo '<p>' . esc_html($term_name) . '</p>';
			}
		}

	?>
</article>