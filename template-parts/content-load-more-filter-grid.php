<?php
$queried_object = get_queried_object() ?? null;

$sidebar_image = $args['sidebar-image'] ?? null;
// This template is used for all JS load more and filtering
$cpt = $args['cpt'] ?? null;
$index_page = $args['index_page'] ?? null;
$stage = $args['stage'] ?? null;
$team = $args['team'] ?? null;
$program = $args['program'] ?? null;
$post_categories = $args['post_categories'] ?? null;
$posts = $args['posts'];
$posts_per_load = $args['posts-per-load'] ?? 12;
$equalHeightCards = $args['equal-height-cards'] ?? null;

$terms_to_hide_string = $args['terms-to-hide'] ?? null;
$terms_to_hide_string = trim($terms_to_hide_string); // Remove leading and trailing spaces
$terms_to_hide_array = explode(',', $terms_to_hide_string);

$academic_specialty_terms = get_terms( array(
	'taxonomy'   => 'academic-course-specialty',
	'hide_empty' => true,
	'exclude'    => $terms_to_hide_array,
) );

$admin_department_terms = get_terms( array(
	'taxonomy'   => 'admin-department',
	'hide_empty' => true,
	'exclude'    => $terms_to_hide_array,
) );

$department_1s = get_terms( array(
	'taxonomy'   => 'department-1',
	'hide_empty' => true,
	'exclude'    => $terms_to_hide_array,
) );

$department_2s = get_terms( array(
	'taxonomy'   => 'department-2',
	'hide_empty' => true,
	'exclude'    => $terms_to_hide_array,
) );

$core_elect_terms = get_terms( array(
	'taxonomy'   => 'core-elect',
	'hide_empty' => true,
	'exclude'    => $terms_to_hide_array,
) );

$enrichment_terms = get_terms( array(
	'taxonomy'   => 'enrichment',
	'hide_empty' => true,
	'exclude'    => $terms_to_hide_array,
) );

$grade_terms = get_terms( array(
	'taxonomy'   => 'grade',
	'hide_empty' => true,
	'exclude'    => $terms_to_hide_array,
) );

$program_terms = get_terms( array(
	'taxonomy'   => 'program',
	'hide_empty' => true,
	'exclude'    => $terms_to_hide_array,
) );

$specialty_terms = get_terms( array(
	'taxonomy'   => 'specialty',
	'hide_empty' => true,
	'exclude'    => $terms_to_hide_array,
) );

$stage_terms = get_terms( array(
	'taxonomy'   => 'stage',
	'hide_empty' => true,
	'exclude'    => $terms_to_hide_array,
) );

$team_terms = get_terms( array(
	'taxonomy'   => 'team',
	'hide_empty' => true,
	'exclude'    => $terms_to_hide_array,
) );

$primary_cat_terms = '';
$primary_cat_front = '';
$primary_all = '';
$active_term = '';
$all_class = '';

if( $cpt == 'academic-course' ) {
	$primary_cat_terms = $stage_terms;
	$primary_cat_front = '/academic-courses/';
	$primary_all = '/academic-courses/';
	$active_term = $stage;
	$index_page = $primary_cat_front;
}

if( $cpt == 'administration' ) {
	$primary_cat_terms = $team_terms;
	$primary_cat_front = '/about-us/administration/';
	$primary_all = $primary_cat_front;
	$index_page = $primary_cat_front;
	$active_term = $team;
}

if( $cpt == 'club' ) {
	$primary_cat_terms = $post_categories;
	$primary_cat_front = $index_page . 'club-category/';
}

if( $cpt == 'enrichment-course' ) {
	$primary_cat_terms = $program_terms;
	$primary_cat_front = '/enrichment-courses/';
	$primary_all = '/enrichment-courses/';
	$active_term = $program;
	$index_page = $primary_cat_front;
}

if( $cpt == 'event' ) {
	$primary_cat_terms = $post_categories;
	$primary_cat_front = $index_page . 'event-category/';
}

if( $cpt == 'teacher-staff' ) {
	$primary_cat_terms = $stage_terms;
	$primary_cat_front = '/about-us/teachers-staff/';
	$primary_all = $primary_cat_front;
	$index_page = $primary_cat_front;
	$active_term = $stage;
}

if( !is_front_page() && is_home() || is_archive() ) {
	$primary_cat_terms = $post_categories;
	$active_term = $queried_object;
	$primary_cat_front = '/category/';
	
	if( $queried_object->taxonomy == 'event-category' || $queried_object->taxonomy == 'club-category' ) {
		
		// Get the term archive URL
		if( $queried_object->taxonomy == 'event-category' ) {
			$archive_url = get_term_link($queried_object->slug, 'event-category');
		}
		if( $queried_object->taxonomy == 'club-category' ) {
			$archive_url = get_term_link($queried_object->slug, 'club-category');
		}
		
		
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

if( !is_front_page() && is_home() ) {
	$all_class = 'active';
}
if (is_archive() && $queried_object->taxonomy == 'category' ) {
	$index_page = get_permalink( get_option( 'page_for_posts' ) );
}

$filter_grid_classes = [];
if($equalHeightCards == true) { 
	$filter_grid_classes[] = ' equal-heights'; 
}
if( $cpt == 'post' || $cpt == 'club' ) {
	$filter_grid_classes[] = ' small-up-1 medium-up-2 tablet-up-3';
}
$filter_grid_classes_string = implode(' ', $filter_grid_classes);

?>

<section class="isotope-filter-loadmore loading overflow-hidden" data-postsper="<?=esc_attr( $posts_per_load );?>">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<div class="cell small-12 large-10 xxlarge-8">
				<?php 
					get_template_part('template-parts/part', 'grid-intro');
				?>

				<div id="options" class="tax-menu-wrap">
					<div class="stages tax-menu grid-x grid-padding-x font-size-20">
						<?php if($primary_cat_terms && !is_wp_error($primary_cat_terms)) : foreach($primary_cat_terms as $term):?>
							<div class="cell shrink top-level">
								<a class="button filter-btn no-style<?php if( !empty($active_term) && $term->slug == $active_term->slug) { echo ' active'; };?>" href="<?=esc_url($primary_cat_front);?><?=esc_attr( $term->slug );?>/">
									<?=esc_html( $term->name );?>
								</a>
							</div>
							<?php endforeach;?>
							<div class="cell shrink top-level">
								<a class="button filter-btn no-style all <?=$all_class;?>" href="<?=esc_url($index_page);?>">
									All
								</a>
							</div>
						<?php endif;?>
					</div>
					<div class="filter-group">
						<div class="option-set other-terms tax-menu grid-x grid-padding-x" data-group="taxonomy-terms">
							<?php 
								if( $cpt == 'academic-course' ) {
									get_template_part('template-parts/part-filter-btns', 'academic-course',
										array (
											'stage_terms' => $stage_terms,
											'core_elect_terms' => $core_elect_terms,
											'grade_terms' => $grade_terms,
											'specialty_terms' => $academic_specialty_terms, 
										),
									);
								}
								if( $cpt == 'administration' ) {
									get_template_part('template-parts/part-filter-btns', 'administration',
										array (
											'admin_department_terms' => $team_terms,
											'admin_department_terms' => $admin_department_terms,
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
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="cell small-12<?php if( $sidebar_image != null ) { echo '  medium-7 tablet-8 large-6 xxlarge-5'; } else { echo ' large-10 xxlarge-8'; }?>">
				<div class="filter-grid grid-x grid-padding-x<?=esc_attr( $filter_grid_classes_string );?>">
					<?php foreach( $posts as $post ){
						if( $cpt == 'administration' || $cpt == 'teacher-staff' ) {
							get_template_part('template-parts/loop', 'teacher-staff');
						}
						if( $cpt == 'academic-course' || $cpt == 'enrichment-course' ) {
							get_template_part('template-parts/loop', 'enrichment-course');
						}
						if( $cpt == 'event' ) {
							get_template_part('template-parts/loop', 'event');
						}
						if( $cpt == 'post' || $cpt == 'club' ) {
							get_template_part('template-parts/loop', 'post',
								array(
									'card-classes' => 'hidden',
								),
							);
						}
					}?>
				</div>		
			</div>			
			<?php if( !empty( $sidebar_image ) ) {
				$imgID = $sidebar_image['ID'];
				$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
				$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
				echo '<div class="img-wrap cell small-12 medium-5 tablet-4 large-4 xxlarge-3">';
				echo $img;
				echo '</div>';
			}?>
		<div class="text-center load-more-wrap">
			<button class="button purple-ds" id="load-more">Load More</button>
		</div>
		</div>
	</div>
</section>
