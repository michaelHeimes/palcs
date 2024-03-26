<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package trailhead
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			
			if( is_singular('teacher-staff') || is_singular('enrichment-course') ) { 
			
				$post_id = get_the_ID();
				$term_slugs = [];
				
				if( is_singular('teacher-staff') ) { 
					$categories = array('stage');
					$taxonomies = array('grade', 'enrichment', 'department-1', 'department-2');
					$slug_front = '/about/teachers-staff/';
				}
				
				if( is_singular('enrichment-course') ) { 
					$categories = array('enrichment');
					$taxonomies = array('stage', 'specialty') ?? null;
					$slug_front = '/enrichments/';
				}
				
				// Loop through each taxonomy
				if($taxonomies) {
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
				}
				
				// Combine term slugs into a single string separated by spaces
				if (!empty($term_slugs)) {
			 	$combined_terms = implode(' ', $term_slugs);
				}
				
				get_template_part('template-parts/content', 'filtered-post-single',
					array(
						'post_id' => $post_id,	
						'categories' => $categories,
						'taxonomies' => $taxonomies,
						'combined_terms' => $combined_terms,
						'slug_front' => $slug_front,
					),
				);
				
			} else {

				get_template_part( 'template-parts/content', get_post_type() );
				
			}


		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
