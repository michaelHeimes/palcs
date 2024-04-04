<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;
$term_slug = $queried_object->slug;
$post_type = get_post_type();
$current_term_id = $queried_object->term_id;
?>

	<main id="primary" class="site-main">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="cell small-12 large-10">
	
					
					<?php
					$post_categories = get_terms( array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => true,
					) );
					
					if (!empty($post_categories)) {
						echo '<div class="tax-menu-wrap">';
						echo '<ul class="no-bullet tax-menu grid-x grid-padding-x">';
						foreach ($post_categories as $term) {
							// Check if the term has posts before displaying it
								$active = ($term->term_id == $current_term_id) ? 'active' : '';
								$term_link = get_term_link($term->term_id, $taxonomy);
								$term_count = $term->count;
						
								if ($term_count > 0) {
									$link_or_span = ($term->term_id == $current_term_id) ? 'span' : 'a';
									$link_attributes = ($term->term_id == $current_term_id) ? '' : 'href="' . esc_url($term_link) . '"';
									echo '<li class="cell shrink top-level"><' . $link_or_span . ' class="button no-style font-size-20" ' . $link_attributes . '>' . esc_html($term->name) . '</' . $link_or_span . '></li>';
								}
							}
							echo '</ul>';
							echo '</div>';
						}
						?>

					<div class="grid-x grid-padding-x">
						
						<?=do_shortcode( '[ajax_load_more archive="true" post_type="' . $post_type . '" taxonomy="' . $taxonomy .  '"  taxonomy_terms="' . $term_slug . '" posts_per_page="9" order="ASC" orderby="meta_value" sort_key="event_date" css_classes="grid-x grid-padding-x small-up-1"]' );?>
					</div>
					
					
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
