<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$post_type = get_post_type();
$queried_object = get_queried_object();
$posts_page_id = get_option('page_for_posts'); // Retrieve the ID of the posts page
$posts_page_link = get_permalink($posts_page_id); 
$terms = $queried_object->slug;
$posts_per_load = 12;
$post_type = get_post_type();
if($post_type == 'post') {
	$posts_per_load = 9;
}
if($post_type == 'event') {
	$posts_per_load = 10;
}
?>

	<main id="primary" class="site-main">
		<?php get_template_part('template-parts/banner', 'full-width-image');?>
		<div class="content posts-page primary-only<?php if ( $post_type == 'event' ) { echo ' no-banner';}?>">
			<?php
			if ( have_posts() ) :
				
				if ( $post_type == 'event' ) {
					$tax = 'event-category';
					$post_categories = get_terms( array(
						'taxonomy'   => $tax,
						'hide_empty' => true,
					) );
					
					$args = array(  
						'post_type' => 'event',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'meta_key'  => 'event_date',
						'orderby'   => 'meta_value_num',
						'order'     => 'ASC',
						'tax_query' => array(
							array(
								'taxonomy' => $tax,
								'field'    => 'slug',
								'terms'    => $terms,
							),
						),
					);	 
					
				} else {
					$post_categories = get_categories( array(
						'hide_empty' => true,
					));
					$tax = 'category';
					
					$args = array(  
						'post_type' => $post_type,
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC',
						'tax_query' => array(
							array(
								'taxonomy' => $tax,
								'field'    => 'slug',
								'terms'    => $terms,
							),
						),
					);	 
					
				}


				$posts = get_posts($args);
				
				get_template_part('template-parts/content', 'load-more-filter-grid', 
					array(
						'cpt'   => 'event',
						'posts' => $posts,
						'posts-per-load' => $posts_per_load,
						'post_categories' => $post_categories,
					),
				);
	
			else :
	
				get_template_part( 'template-parts/content', 'none' );
	
			endif;
			?>
		</div>
	</main><!-- #main -->

<?php
get_footer();