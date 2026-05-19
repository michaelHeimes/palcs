<?php
/**
 * Template name: Clubs Page
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();

$current_url = home_url( add_query_arg( NULL, NULL ) );
$index_page = substr( $current_url, strlen( home_url() ) );
?>

<div class="posts-page event-posts no-banner primary-only <?php if( !empty( $program) ) { echo  $program->slug; } else { echo 'all'; };?>">
	<div class="inner-content">
 		<main id="primary" class="site-main">
			 <div class="content">
		
				<?php
				$post_categories = get_terms( array(
					'taxonomy'   => 'club-category',
					'hide_empty' => true,
				) );			
				?>
				
				<?php 
					$args = array(  
						'post_type' => 'club',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC',
					);	 
					$posts = get_posts($args);
				?>
				
				<?php get_template_part('template-parts/content', 'load-more-filter-grid', 
					array(
						'cpt'   => 'club',
						'posts' => $posts,
						'posts-per-load' => 9,
						'post_categories' => $post_categories,
						'primary_cat_front' => '/club-category/',
						'index_page' => $index_page,
					),
				);?>
			 </div>
			
	 		<?php get_template_part('template-parts/section', 'cta-centered-heading-two-buttons');?>

		</main><!-- #main -->
	</div>
</div>

<?php
get_footer();
