<?php
$intro_text = $args['intro_text'] ?? null;
$stage = $args['stage'] ?? null;
$posts = $args['posts'];

// Initialize an array to store term objects
$grade_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
$post_terms = wp_get_post_terms($post->ID, 'grade'); // Replace 'your_taxonomy' with your actual taxonomy name
// Merge the term arrays
$grade_terms_check = array_merge($grade_terms_check, $post_terms);
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
$department_1s_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
$post_terms = wp_get_post_terms($post->ID, 'department-1'); // Replace 'your_taxonomy' with your actual taxonomy name
// Merge the term arrays
$department_1s_check = array_merge($department_1s_check, $post_terms);
}


// Initialize an array to store term objects
$department_2s_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
$post_terms = wp_get_post_terms($post->ID, 'department-2'); // Replace 'your_taxonomy' with your actual taxonomy name
// Merge the term arrays
$department_2s_check = array_merge($department_2s_check, $post_terms);
}

$stage_terms = get_terms( array(
'taxonomy'   => 'stage',
'hide_empty' => true,
) );

$grade_terms = get_terms( array(
'taxonomy'   => 'grade',
'hide_empty' => true,
) );

$enrichment_terms = get_terms( array(
'taxonomy'   => 'enrichment',
'hide_empty' => true,
) );

$department_1s = get_terms( array(
'taxonomy'   => 'department-1',
'hide_empty' => true,
) );

$department_2s = get_terms( array(
'taxonomy'   => 'department-2',
'hide_empty' => true,
) );

?>

<section class="isotope-filter-loadmore loading" data-postsper="12">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<div class="cell small-12 xlarge-10">
				
				<div id="options" class="tax-menu-wrap">
					<div class="stages tax-menu grid-x grid-padding-x font-size-20">
						<?php if($stage_terms && !is_wp_error($stage_terms)) : foreach($stage_terms as $term):?>
						<div class="cell shrink top-level">
							<a class="button filter-btn no-style<?php if( !empty($stage) && $term->slug == $stage->slug) { echo ' active'; };?>" href="/about-us/meet-our-team/<?=esc_attr( $term->slug );?>/">
								<?=esc_html( $term->name );?>
							</a>
						</div>
						<?php endforeach; endif;?>
						<div class="cell shrink top-level">
							<a class="button filter-btn no-style all" href="/about-us/meet-our-team/">
								All
							</a>
						</div>
					</div>
					<div class="filter-group">
						<div class="option-set other-terms tax-menu grid-x grid-padding-x" data-group="taxonomy-terms">
							<?php if($grade_terms && !is_wp_error($grade_terms)) : foreach($grade_terms as $term):
									if( in_array($term, $grade_terms_check) ):
								?>
								<div class="cell shrink" data-group="grades">
									<div class="button input-wrap">
										<?='<input name="grade" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
									</div>
								</div>
							<?php endif; endforeach; endif;?>
							<?php if($enrichment_terms && !is_wp_error($enrichment_terms)): foreach($enrichment_terms as $term):
									if( in_array($term, $enrichment_terms_check) ):
								?>
								<div class="cell shrink" data-group="enrichments">
									<div class="button input-wrap">
										<?='<input name="enrichment" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
									</div>
								</div>
							<?php endif; endforeach; endif;?>
							<?php if($department_1s && !is_wp_error($department_1s)): foreach($department_1s as $term):
									if( in_array($term, $department_1s_check) ):
								?>
								<div class="cell shrink" data-group="department-1">
									<div class="button input-wrap">
										<?='<input name="department-1" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
									</div>
								</div>
							<?php endif; endforeach; endif;?>
							<?php if($department_2s && !is_wp_error($department_2s)): foreach($department_2s as $term):
									if( in_array($term, $department_2s_check) ):
								?>
								<div class="cell shrink" data-group="department-2">
									<div class="button input-wrap">
										<?='<input name="department-2" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
									</div>
								</div>
							<?php endif; endforeach; endif;?>
						</div>
					</div>
				</div>
				
				<div class="filter-grid grid-x grid-padding-x">
					<?php foreach( $posts as $post ){
						get_template_part('template-parts/loop', 'teacher-staff', 
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
