<?php
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
			<div class="cell small-12 tablet-10 xlarge-8">
				
				<div id="options" class="tax-menu-wrap">
					<div class="stages tax-menu grid-x grid-padding-x font-size-20">
						<?php if($enrichment_terms) : foreach($enrichment_terms as $term):?>
						<div class="cell shrink top-level">
							<a class="button filter-btn no-style" href="/enrichment-courses/<?=esc_attr( $term->slug );?>/">
								<?=esc_html( $term->name );?>
							</a>
						</div>
						<?php endforeach; endif;?>
						<div class="cell shrink top-level">
							<a class="button filter-btn no-style" href="/enrichment-courses/">
								All
							</a>
						</div>
					</div>
					<div class="filter-group">
						<div class="option-set other-terms tax-menu grid-x grid-padding-x" data-group="taxonomy-terms">
							<?php if($stage_terms) : foreach($stage_terms as $term):
									if( in_array($term, $stage_terms_check) ):
								?>
								<div class="cell shrink" data-group="grades">
									<div class="button input-wrap">
										<?='<input type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
									</div>
								</div>
							<?php endif; endforeach; endif;?>
							<?php if($specialty_terms): foreach($specialty_terms as $term):
									if( in_array($term, $specialty_terms_check) ):
								?>
								<div class="cell shrink" data-group="enrichments">
									<div class="button input-wrap">
										<?='<input type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
									</div>
								</div>
							<?php endif; endforeach; endif;?>
						</div>
					</div>
				</div>
				
				<div class="filter-grid grid-x grid-padding-x" data-equalizer data-equalize-on="small">
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
		</div>
	</div>
</section>
