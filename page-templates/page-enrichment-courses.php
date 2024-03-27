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
 
 $enrichment = $fields['enrichment'] ?? null;
 
 if( !empty($enrichment) ) {
	$args = array(  
		'post_type' => 'enrichment-course',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'tax_query' => array(
			 array(
				 'taxonomy' => 'enrichment',
				 'field'    => 'term_id',
				 'terms'    =>  $enrichment,
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
 
<div class="content posts-page enrichment-course-posts">
	<div class="inner-content">
	 
		<main id="primary" class="site-main">
	 
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				 
				<?php get_template_part('template-parts/content', 'enrichment-filter-grid', 
					array(
						'posts' => $posts,
					),
				);?>
 
				<footer class="article-footer">
					<?php wp_link_pages(); ?>
				</footer> <!-- end article footer -->
					 
			</article><!-- #post-<?php the_ID(); ?> -->
	 
		</main><!-- #main -->
			 
	</div>
</div>
 
<?php
get_footer();