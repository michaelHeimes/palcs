<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

$post_id = get_the_ID();
$term_slugs = [];
$taxonomies = array('stage', 'grade', 'enrichment', 'department-1', 'department-2');

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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<div class="left cell small-12 xlarge-3">
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
						echo '<div class="circle-thumb-wrap"><img width="724" height="724" src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($alt_text) . '" title="' . esc_attr($title) . '" decoding="async" loading="lazy"></div>';
						
					} elseif( !empty( get_field('post_fallback_thumbnail','option') ) ) {
						$imgID = get_field('post_fallback_thumbnail','option')['ID'];
						$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
						$img = wp_get_attachment_image( $imgID, 'staff-grid', false, [ "class" => "", "alt"=>$img_alt] );
						echo '<div class="circle-thumb-wrap">' . $img . '</div>';
					}
				?>
			</div>
			<div class="right cell small-12 xlarge-5">
				<header class="entry-header">
					
					<?php 
						the_title( '<h1 class="entry-title">', '</h1>' );
						
						if($taxonomies) {
							echo '<ul class="teacher-terms-list no-bullet font-header">';
							// Loop through each taxonomy
							foreach ($taxonomies as $taxonomy) {
								// Get the terms assigned to the post for the current taxonomy
								$terms = get_the_terms($post_id, $taxonomy);
							
								// Check if there are any terms
								if ($terms && !is_wp_error($terms)) {
									// Loop through each term and add its slug to the array
									foreach ($terms as $term) {
										echo '<li class="color-purple">' . $term->name . '</li>';
									}
								}
							}
							echo '</ul>';
						}
				
					?>
				</header><!-- .entry-header -->
				
				<div class="entry-content">
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'trailhead' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						)
					);
				
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'trailhead' ),
							'after'  => '</div>',
						)
					);
					?>
				</div><!-- .entry-content -->
				
				<footer class="entry-footer grid-x">
					<?php
					if($taxonomies) {
						echo '<ul class="tax-menu no-bullet grid-x grid-padding-x font-header">';
						echo '<li class="tax-label cell shrink color-purple">See All</li>';
						// Loop through each taxonomy
						foreach ($taxonomies as $taxonomy) {
							// Get the terms assigned to the post for the current taxonomy
							$terms = get_the_terms($post_id, $taxonomy);
						
							// Check if there are any terms
							if ($terms && !is_wp_error($terms)) {
								// Loop through each term and add its slug to the array
								foreach ($terms as $term) {
									echo '<li class="color-purple cell shrink">';
									echo '<a class="button no-style" href="/about/teachers-staff/?' . $term->slug . '">';
									echo $term->name;
									echo '</a>';
									echo '</li>';
								}
							}
						}
						echo '</ul>';
					}
					?>
				</footer><!-- .entry-footer -->
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
