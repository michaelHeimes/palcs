<?php
$home_url = get_home_url();
$post_id = $args['post_id'] ?? null;
$post_type = $args['post_type'];
$categories = $args['categories'] ?? null;
$taxonomies = $args['taxonomies'] ?? null;
$combined_terms = $args['combined_terms'] ?? null;
$slug_front = $args['slug_front'] ?? null;
$image_size = 'circle-thumb';
$thumbwrap_class = 'thumb-wrap circle-thumb-wrap';
if( $post_type == 'event'  ) {
	$thumbwrap_class = 'thumb-wrap';
	$image_size = 'event-card';
}
if( $post_type == 'teacher-staff' || $post_type == 'club' ) {
	$image_size = 'staff-grid';
}
if( $post_type == 'enrichment-course' ) {
	$icon = '';
	$specialty_terms = get_the_terms($post_id, 'specialty');
	if ($specialty_terms && !is_wp_error($specialty_terms)) {
		$first_term = reset($specialty_terms);
		$icon = get_field('icon', $first_term) ?? get_field('enrichment_fallback_icon', 'option');
	}
}

$sidebar_width = $args['sidebar-width'] ?? ' small-12 tablet-4 xlarge-3';
$content_width = $args['content-width'] ?? ' small-12 tablet-6 xlarge-5';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-img-sidebar'); ?>>
	<div class="grid-container">
		<div class="inner grid-x grid-padding-x">
			<div class="left cell<?=$sidebar_width;?>">
				<?php
					$image_id = get_post_thumbnail_id($post_id);
					$image_data = wp_get_attachment_image_src($image_id, $image_size) ?? null;
					
					if ($image_data) {
						$thumbnail_url = $image_data[0];
					
						// Get the attachment metadata
						$attachment_metadata = wp_get_attachment_metadata($image_id);
					
						// Get alt text and title
						$alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
						$title = isset($attachment_metadata['image_meta']['title']) ? $attachment_metadata['image_meta']['title'] : '';
					
						// Output the image with alt text and title
						echo '<div class="' . $thumbwrap_class . '"><img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($alt_text) . '" title="' . esc_attr($title) . '" decoding="async" loading="lazy"></div>';
						
					} elseif( $post_type == 'enrichment-course' && !empty( $icon ) ) {
							$imgID = $icon['ID'];
							$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
							$img = wp_get_attachment_image( $imgID, $image_size, false, [ "class" => "", "alt"=>$img_alt] );
							echo '<div class="icon-wrap relative purple-bg grid-x align-middle align-center">';
							echo $img;
							echo '</div>';
					} elseif( !empty( get_field('post_fallback_thumbnail','option') ) ) {
						$imgID = get_field('post_fallback_thumbnail','option')['ID'];
						$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
						$img = wp_get_attachment_image( $imgID, $image_size, false, [ "class" => "", "alt"=>$img_alt] );
						echo '<div class="' . $thumbwrap_class .'">' . $img . '</div>';
					}
				?>
			</div>
			<div class="right cell<?=$content_width;?>">
				<header class="entry-header">
					
					<?php 
						the_title( '<h1 class="entry-title">', '</h1>' );
						
						if($taxonomies) {
							echo '<ul class="terms-list no-bullet font-header">';
							
							// Loop through each category
							if($categories) {
								foreach ($categories as $category) {
									// Get the terms assigned to the post for the current taxonomy
									$terms = get_the_terms($post_id, $category);
								
									// Check if there are any terms
									if ($terms && !is_wp_error($terms)) {
										// Loop through each term and add its slug to the array
										foreach ($terms as $term) {
											echo '<li class="color-purple">' . $term->name . '</li>';
										}
									}
								}
							}
							
							
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
					if( $categories || $taxonomies) {
						echo '<ul class="tax-menu no-bullet grid-x grid-padding-x font-header">';
						echo '<li class="tax-label cell shrink color-purple">See All</li>';
						
						// Loop through each category
						if($categories) {
							foreach ($categories as $category) {
								// Get the terms assigned to the post for the current taxonomy
								$terms = get_the_terms($post_id, $category);
							
								// Check if there are any terms
								if ($terms && !is_wp_error($terms)) {
									// Loop through each term and add its slug to the array
									foreach ($terms as $term) {
										echo '<li class="color-purple cell shrink">';
										echo '<a class="button no-style" href="' . $slug_front . '' . $term->slug . '">';
										echo $term->name;
										echo '</a>';
										echo '</li>';
									}
								}
							}
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
										echo '<li class="color-purple cell shrink">';
										echo '<a class="button no-style" href="' . $home_url . '/' . $slug_front . '?' . $taxonomy .  '=.' . $term->slug . '">';
										echo $term->name;
										echo '</a>';
										echo '</li>';
									}
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