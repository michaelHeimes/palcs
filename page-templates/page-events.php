<?php
/**
 * Template name: Events Page
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

<div class="content posts-page event-posts no-banner primary-only <?php if( !empty( $program) ) { echo  $program->slug; } else { echo 'all'; };?>">
	<div class="inner-content">
 
		<main id="primary" class="site-main">
	
			<?php
			$post_categories = get_terms( array(
				'taxonomy'   => 'event-category',
				'hide_empty' => true,
			) );			
			?>
			
			<?php 
				$args = array(  
					'post_type' => 'event',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'meta_key'  => 'event_date',
					'orderby'   => 'meta_value_num',
					'order'     => 'ASC',
				);	 
				$posts = get_posts($args);
			?>
			
			<?php get_template_part('template-parts/content', 'load-more-filter-grid', 
				array(
					'cpt'   => 'event',
					'posts' => $posts,
					'posts-per-load' => 10,
					'post_categories' => $post_categories,
					'primary_cat_front' => '/event-category/',
					'index_page' => $index_page,
				),
			);?>
	
		</main><!-- #main -->
	</div>
</div>
<div class="gradient-border"></div>
<?php
get_footer();
