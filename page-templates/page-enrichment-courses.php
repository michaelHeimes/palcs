<?php
/**
 * Template name: Enrichment Courses
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

 get_header();

 $fields = get_fields();
 $program = $fields['program'] ?? null;
 $sidebar_image = get_field('sidebar_image') ?? null;

 if( !empty($program) ) {
	$args = array(  
		'post_type' => 'enrichment-course',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'tax_query' => array(
			 array(
				 'taxonomy' => 'program',
				 'field'    => 'slug',
				 'terms'    =>  $program->slug,
			 ),
		 ),
	);
 } else {
	$args = array(  
		'post_type' => 'enrichment-course',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
	);	 
 }
 

 
 $posts = get_posts($args);?>
 
<div class="content posts-page course-posts <?php if( !empty( $program) ) { echo  $program->slug; } else { echo 'all'; };?>">
	<div class="inner-content">
	 
		<main id="primary" class="site-main">
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			 
				<?php get_template_part('template-parts/content', 'load-more-filter-grid', 
					array(
						'cpt'   => 'enrichment-course',
						'posts' => $posts,
						'posts-per-load' => 12,
						'program' => $program,
						'equal-height-cards' => true,
						'sidebar-image' => $sidebar_image,
					),
				);?>

			</article>
	 
		</main><!-- #main -->
			 
	</div>
</div>
 
<?php
get_footer();