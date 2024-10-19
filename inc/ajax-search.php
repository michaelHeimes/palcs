<?php
function handle_ajax_search() {
	if (isset($_GET['search']) && isset($_GET['post_type'])) {
		$keyword = sanitize_text_field($_GET['search']);
		$post_type = sanitize_text_field($_GET['post_type']); // Get the selected post type from AJAX
		$search_results = array();

		// Define the post types to search
		$allowed_post_types = array('page', 'post', 'club', 'teacher-staff');
		
		// Determine which post types to search based on the input
		if ($post_type === 'posttypeall') {
			$post_types = $allowed_post_types; // Search all post types
		} else {
			$post_types = array($post_type); // Only search the selected post type
		}

		// Query posts for the selected post type
		$args = array(
			'post_type'      => $post_types,
			'posts_per_page' => -1,
			's'              => $keyword,
		);

		$query = new WP_Query($args);

		// Add post titles and URLs to search results
		while ($query->have_posts()) {
			$query->the_post();
			$search_results[] = array(
				'title' => get_the_title(),
				'url'   => get_permalink()
			);
		}

		wp_reset_postdata();

		// Return JSON response with search results
		wp_send_json_success(array(
			'keyword' => $keyword,
			'results' => $search_results,
		));
	} else {
		wp_send_json_error('No search keyword or post type provided.');
	}
}
add_action('wp_ajax_custom_search', 'handle_ajax_search');
add_action('wp_ajax_nopriv_custom_search', 'handle_ajax_search');
