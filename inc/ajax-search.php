<?php
function handle_ajax_search() {
	if (isset($_GET['search'])) {
		$keyword = sanitize_text_field($_GET['search']);
		$search_results = array();

		// Define the post types to search
		$post_types = array(
			'page',
			'post',
			'academic-course',
			'administration',
			'club',
			'enrichment-course',
			'event',
			'teacher-staff',
		);

		// Query posts from each post type
		foreach ($post_types as $post_type) {
			$args = array(
				'post_type'      => $post_type,
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
		}

		// Return JSON response with search results
		wp_send_json_success(array(
			'keyword' => $keyword,
			'results' => $search_results,
		));
	} else {
		wp_send_json_error('No search keyword provided.');
	}
}
add_action('wp_ajax_custom_search', 'handle_ajax_search');
add_action('wp_ajax_nopriv_custom_search', 'handle_ajax_search');