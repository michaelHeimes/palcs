<?php
$sidebar_image = get_field('sidebar_image') ?? null;
$enrichment = $args['enrichment'] ?? null;
$posts = $args['posts'];
// Initialize an array to store term objects

$stage_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
	$post_terms = wp_get_post_terms($post->ID, 'stage'); // Replace 'your_taxonomy' with your actual taxonomy name
	// Merge the term arrays
	$stage_terms_check = array_merge($stage_terms_check, $post_terms);
}

// Initialize an array to store term objects
$enrichment_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
	$post_terms = wp_get_post_terms($post->ID, 'enrichment'); // Replace 'your_taxonomy' with your actual taxonomy name
	// Merge the term arrays
	$enrichment_terms_check = array_merge($enrichment_terms_check, $post_terms);
}


// Initialize an array to store term objects
$specialty_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
	$post_terms = wp_get_post_terms($post->ID, 'specialty'); // Replace 'your_taxonomy' with your actual taxonomy name
	// Merge the term arrays
	$specialty_terms_check = array_merge($specialty_terms_check, $post_terms);
}

$enrichment_terms = get_terms( array(
'taxonomy'   => 'enrichment',
'hide_empty' => true,
) );

$stage_terms = get_terms( array(
'taxonomy'   => 'stage',
'hide_empty' => true,
) );

$specialty_terms = get_terms( array(
'taxonomy'   => 'specialty',
'hide_empty' => true,
) );

?>

<section class="isotope-filter-loadmore" data-postsper="10">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<div class="cell small-12 xlarge-10 xxlarge-8">
				
				<div id="options" class="tax-menu-wrap">
					<div class="stages tax-menu grid-x grid-padding-x font-size-20">
						<?php if($enrichment_terms && !is_wp_error($enrichment_terms)) : foreach($enrichment_terms as $term):?>
						<div class="cell shrink top-level">
							<a class="button filter-btn no-style<?php if( !empty($enrichment) && $term->slug == $enrichment->slug) { echo ' active'; };?>" href="/enrichment-courses/<?=esc_attr( $term->slug );?>">
								<?=esc_html( $term->name );?>
							</a>
						</div>
						<?php endforeach; endif;?>
						<div class="cell shrink top-level">
							<a class="button filter-btn no-style all" href="/enrichment-courses/">
								All
							</a>
						</div>
					</div>
					<div class="filter-group">
						<div class="option-set other-terms tax-menu grid-x grid-padding-x" data-group="taxonomy-terms">
							<?php if($stage_terms && !is_wp_error($stage_terms)) : foreach($stage_terms as $term):
									if( in_array($term, $stage_terms_check) ):
								?>
								<div class="cell shrink" data-group="grades">
									<div class="button input-wrap">
										<?='<input type="checkbox" name="stage" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
									</div>
								</div>
							<?php endif; endforeach; endif;?>
							<?php if($specialty_terms && !is_wp_error($specialty_terms)): foreach($specialty_terms as $term):
									if( in_array($term, $specialty_terms_check) ):
								?>
								<div class="cell shrink" data-group="enrichments">
									<div class="button input-wrap">
										<?='<input type="checkbox" name="specialty" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
									</div>
								</div>
							<?php endif; endforeach; endif;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="grid-x grid-padding-x align-center">
		<div class="cell small-12 medium-7 tablet-8 xlarge-7 xxlarge-5">
			<div class="filter-grid equal-heights grid-x grid-padding-x" data-equalizer data-equalize-on="small">
				<?php foreach( $posts as $post ){
					get_template_part('template-parts/loop', 'enrichment-course', 
						array(
						),
					);
				}?>
			</div>
			<div class="text-center load-more-wrap">
				<button class="button purple-ds" id="load-more">Load More</button>
			</div>
		</div>
		<?php if( !empty( $sidebar_image ) ) {
			$imgID = $sidebar_image['ID'];
			$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
			$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
			echo '<div class="img-wrap cell small-12 medium-5 xlarge-3 tablet-4 xxlarge-3">';
			echo $img;
			echo '</div>';
		}?>
	</div>
</section>
