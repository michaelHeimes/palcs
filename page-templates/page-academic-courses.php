<?php
/**
 * Template name: Academic Courses
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

 get_header();

 $fields = get_fields();
 $stage = $fields['stage'] ?? null;
 $sidebar_image = get_field('sidebar_image') ?? null;

 if( !empty($stage) ) {
	$args = array(  
		'post_type' => 'academic-course',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'tax_query' => array(
			 array(
				 'taxonomy' => 'stage',
				 'field'    => 'slug',
				 'terms'    =>  $stage->slug,
			 ),
		 ),
	);
 } else {
	$args = array(  
		'post_type' => 'academic-course',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
	);	 
 }
 

 
 $posts = get_posts($args);?>
 
<div class="content posts-page course-posts <?php if( !empty( $stage) ) { echo  $stage->slug; } else { echo 'all'; };?>">
	<div class="inner-content">
	 
		<main id="primary" class="site-main">
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			 
				<?php get_template_part('template-parts/content', 'load-more-filter-grid', 
					array(
						'cpt'   => 'academic-course',
						'posts' => $posts,
						'posts-per-load' => 12,
						'stage' => $stage,
						'equal-height-cards' => true,
						'sidebar-image' => $sidebar_image,
					),
				);?>

			</article>
	 
		</main><!-- #main -->
			 
	</div>
</div>
 <div class="gradient-border"></div>
<?php
get_footer();