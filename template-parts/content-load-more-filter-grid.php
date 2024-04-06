<?php
// This template is used for all JS load more and filtering
$cpt = $args['cpt'] ?? null;
$intro_text = $args['intro_text'] ?? null;
$stage = $args['stage'] ?? null;
$program = $args['program'] ?? null;
$post_categories = $args['post_categories'] ?? null;
$posts = $args['posts'];
$posts_per_load = $args['posts-per-load'] ?? 12;

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

$program_terms = get_terms( array(
'taxonomy'   => 'program',
'hide_empty' => true,
) );

$specialty_terms = get_terms( array(
'taxonomy'   => 'specialty',
'hide_empty' => true,
) );

$stage_terms = get_terms( array(
'taxonomy'   => 'stage',
'hide_empty' => true,
) );
$primary_cat_terms = '';
$primary_cat_front = '';
$primary_all = '';
$active_term = '';

if( $cpt == 'teacher-staff' ) {
	$primary_cat_terms = $stage_terms;
	$primary_cat_front = '/about-us/teachers-staff/';
	$primary_all = $primary_cat_front;
	$active_term = $stage;
}
if( $cpt == 'enrichment-course' ) {
	$primary_cat_terms = $program_terms;
	$primary_all = '/enrichment-courses/';
	$active_term = $program;
}
if( $cpt == 'event' ) {
	$primary_cat_terms = $post_categories;
}

?>

<section class="isotope-filter-loadmore loading" data-postsper="<?=esc_attr( $posts_per_load );?>">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<div class="cell small-12 xlarge-10">
				
				<div id="options" class="tax-menu-wrap">
					<div class="stages tax-menu grid-x grid-padding-x font-size-20">
						<?php if($primary_cat_terms && !is_wp_error($primary_cat_terms)) : foreach($primary_cat_terms as $term):?>
						<div class="cell shrink top-level">
							<a class="button filter-btn no-style<?php if( !empty($active_term) && $term->slug == $active_term->slug) { echo ' active'; };?>" href="<?=esc_url($primary_cat_front);?><?=esc_attr( $term->slug );?>/">
								<?=esc_html( $term->name );?>
							</a>
						</div>
						<?php endforeach; endif;?>
						<div class="cell shrink top-level">
							<a class="button filter-btn no-style all" href="<?=esc_url($primary_cat_front);?>">
								All
							</a>
						</div>
					</div>
					<div class="filter-group">
						<div class="option-set other-terms tax-menu grid-x grid-padding-x" data-group="taxonomy-terms">
							<?php 
								if( $cpt == 'teacher-staff' ) {
									get_template_part('template-parts/part-filter-btns', 'teacher-staff',
										array (
											'grade_terms' => $grade_terms, 
											'enrichment_terms' => $enrichment_terms,
											'department_1s' => $department_1s,
											'department_2s' > $department_2s,
										),
									);
								}
								if( $cpt == 'enrichment-course' ) {
									get_template_part('template-parts/part-filter-btns', 'enrichment-course',
										array (
											'stage_terms' => $stage_terms,
											'specialty_terms' => $specialty_terms, 
										),
									);
								}
							?>
						</div>
					</div>
				</div>
				
				<div class="filter-grid grid-x grid-padding-x">
					<?php foreach( $posts as $post ){
						if( $cpt == 'teacher-staff' ) {
							get_template_part('template-parts/loop', 'teacher-staff');
						}
						if( $cpt == 'enrichment-course' ) {
							get_template_part('template-parts/loop', 'enrichment-course');
						}
						if( $cpt == 'event' ) {
							get_template_part('template-parts/loop', 'event');
						}
					}?>
				</div>
				<div class="text-center load-more-wrap">
					<button class="button purple-ds" id="load-more">Load More</button>
				</div>
			</div>
		</div>
	</div>
</section>
