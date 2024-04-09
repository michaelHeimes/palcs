<?php
$queried_object = get_queried_object();
// This template is used for all JS load more and filtering
$cpt = $args['cpt'] ?? null;
$index_page = $args['index_page'] ?? null;
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
	$index_page = $primary_cat_front;
	$active_term = $stage;
}
if( $cpt == 'enrichment-course' ) {
	$primary_cat_terms = $program_terms;
	$primary_all = '/enrichment-courses/';
	$active_term = $program;
	$index_page = $primary_cat_front;
}
if( $cpt == 'event' ) {
	$primary_cat_terms = $post_categories;
	$primary_cat_front = $index_page . 'event-category/';
}
if( !is_front_page() && is_home() || is_archive() ) {
	$primary_cat_terms = $post_categories;
	$active_term = $queried_object;
	$primary_cat_front = '/category/';

	if( $queried_object->taxonomy == 'event-category') {
		
		// Get the term archive URL
		$archive_url = get_term_link($queried_object->slug, 'event-category');
		
		// Get the current URL
		$current_url = home_url(add_query_arg(array(), $wp->request));
		
		// Remove the last segment (slug) from the URL
		$current_url_parts = explode('/', rtrim($current_url, '/'));
		array_pop($current_url_parts);
		$current_url_without_last_slug = implode('/', $current_url_parts);
		
		// Remove the last two segments (slugs) from the URL
		$current_url_parts_without_last_two = $current_url_parts;
		array_pop($current_url_parts_without_last_two);
		$current_url_without_last_two_slugs = implode('/', $current_url_parts_without_last_two);
		
		// Output or use the modified URLs as needed
		$primary_cat_front = $current_url_without_last_slug;
		$index_page = $current_url_without_last_two_slugs;
		
		// Add trailing slashes if not there
		if (substr($primary_cat_front, -1) !== '/') {
			$primary_cat_front .= '/';
		}
		
		if (substr($index_page, -1) !== '/') {
			$index_page .= '/';
		}

		
	}
}



?>

<section class="isotope-filter-loadmore loading" data-postsper="<?=esc_attr( $posts_per_load );?>">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<div class="cell small-12 xlarge-10">
				<?php if( !empty(get_the_content() && !is_home()) && !is_archive() ) {
					echo '<header class="grid-intro-text">';
						the_content();
					echo '</header>';
				} else {
					if( !empty($queried_object->description) ) {
						echo '<header class="grid-intro-text">';
							echo $queried_object->description;
						echo '</header>';
					}
				};?>

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
							<a class="button filter-btn no-style all" href="<?=esc_url($index_page);?>">
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
