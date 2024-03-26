<?php
/**
 * Template name: Teachers & Staff Page: Elementary School
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();

$args = array(  
	'post_type' => 'teacher-staff',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'stage',
			'field'    => 'slug',
			'terms'    => 'elementary-school',
		),
	),
);
$posts = get_posts($args);


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


$intro_text = get_field('intro_text') ?? null;

?>
	<div class="content">
		<div class="inner-content">

			<main id="primary" class="site-main">
		
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<header class="entry-header">
						<?php get_template_part('template-parts/section', 'ctas-video-slider');?>
						<div class="grid-container">
							<div class="grid-x grid-padding-x align-center">
								<div class="cell small-12 xlarge-10">
									<?php if( !empty($intro_text) ) {
										get_template_part('template-parts/part', 'grid-intro', 
											array(
												'intro_text' => $intro_text,
											),
										);
									};?>
								</div>
							</div>
						</div>
					</header><!-- .entry-header -->
					
					<div class="alm-filtered teachers-staff alm-filtered-grid init unfiltered">
						<div class="grid-container">
							<div class="grid-x grid-padding-x align-center">
								<div class="cell small-12 xlarge-10">
						
									<div class="alm-filter-nav tax-menu-wrap">
										<div class="stages tax-menu grid-x grid-padding-x font-size-20">
											<div class="cell shrink top-level">
												<a class="button filter-btn no-style active" href="/about/teachers-staff/elementary-school/">
													Elementary School
												</a>
											</div>
											<div class="cell shrink top-level">
												<a class="button filter-btn no-style" href="/about/teachers-staff/middle-school/">
													Middle School
												</a>
											</div>
											<div class="cell shrink top-level">
												<a class="button filter-btn no-style" href="/about/teachers-staff/high-school/">
													High School
												</a>
											</div>
											<div class="cell shrink top-level">
												<a class="button filter-btn no-style" href="/about/teachers-staff/">
													All
												</a>
											</div>
										</div>
										<div class="other-terms tax-menu grid-x grid-padding-x">
											<?php foreach($grade_terms as $term):
													if( in_array($term, $grade_terms_check) ):
												?>
												<div class="cell shrink">
													<button type="button" class="filter-btn top-level no-style" data-post-type="teacher-staff" data-taxonomy="grade" data-taxonomy-terms="<?=$term->slug;?>" data-posts-per-page="12" data-scroll="false" data-button-label="Load More "><?=$term->name;?></button>
												</div>
											<?php endif; endforeach;?>
											<?php foreach($enrichment_terms as $term):
													if( in_array($term, $enrichment_terms_check) ):
												?>
												<div class="cell shrink">
													<button type="button" class="filter-btn top-level no-style" data-post-type="teacher-staff" data-taxonomy="enrichment" data-taxonomy-terms="<?=$term->slug;?>" data-posts-per-page="12" data-scroll="false" data-button-label="Load More "><?=$term->name;?></button>
												</div>
											<?php endif; endforeach;?>
											<?php foreach($department_1s as $term):
													if( in_array($term, $department_1s_check) ):
												?>
												<div class="cell shrink">
													<button type="button" class="filter-btn top-level no-style" data-post-type="teacher-staff" data-taxonomy="department-1" data-taxonomy-terms="<?=$term->slug;?>" data-posts-per-page="12" data-scroll="false" data-button-label="Load More "><?=$term->name;?></button>
												</div>
											<?php endif; endforeach;?>
											<?php foreach($department_2s as $term):
													if( in_array($term, $department_2s_check) ):
												?>
												<div class="cell shrink">
													<button type="button" class="filter-btn top-level no-style" data-post-type="teacher-staff" data-taxonomy="department-2" data-taxonomy-terms="<?=$term->slug;?>" data-posts-per-page="12" data-scroll="false" data-button-label="Load More "><?=$term->name;?></button>
												</div>
											<?php endif; endforeach;?>
										</div>
									</div>

									<?=do_shortcode( '[ajax_load_more id="alm_8413842141" post_type="teacher-staff" taxonomy="stage" taxonomy_terms="elementary-school" taxonomy_operator="IN" order="ASC" orderby="meta_value" sort_key="last_name" posts_per_page="12" scroll="false" css_classes="grid-x grid-padding-x"]' );?>
	
								</div>
							</div>
						</div>
					</div>
										
					<footer class="article-footer">
						 <?php wp_link_pages(); ?>
					</footer> <!-- end article footer -->
						
				</article><!-- #post-<?php the_ID(); ?> -->
		
			</main><!-- #main -->
				
		</div>
	</div>

<?php
get_footer();