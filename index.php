<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();

$posts_page_id = get_option('page_for_posts'); // Retrieve the ID of the posts page
$posts_page_link = get_permalink($posts_page_id); 
$posts_per_load = 9;
?>

	<main id="primary" class="site-main">
		<?php get_template_part('template-parts/banner', 'full-width-image');?>
		<div class="content posts-page">
			<?php
			if ( have_posts() ) :
				
				$post_categories = get_categories(array(
					'hide_empty' => 1,
					'exclude' => get_cat_ID('Uncategorized')
				));

				$args = array(  
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'orderby' => 'title',
					'order' => 'ASC',
				);	 
				$posts = get_posts($args);
				
				get_template_part('template-parts/content', 'load-more-filter-grid', 
					array(
						'cpt'   => 'post',
						'posts' => $posts,
						'post_categories' => $post_categories,
						'posts-per-load' => $posts_per_load,
					),
				);

			else :
	
				get_template_part( 'template-parts/content', 'none' );
	
			endif;
			?>
		</div>
	</main><!-- #main -->
	<div class="gradient-border"></div>

<?php
get_footer();
