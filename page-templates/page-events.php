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
$current_term_id = get_queried_object_id();
?>

<div class="content posts-page event-posts no-banner primary-only <?php if( !empty( $program) ) { echo  $program->slug; } else { echo 'all'; };?>">
	<div class="inner-content">
 
		<main id="primary" class="site-main">
		
			<?php
			if ( have_posts() ) :?>
				<div class="grid-container">
					<div class="grid-x grid-padding-x align-center">
						<div class="cell small-12 large-10">
							<header class="grid-intro-text">
								<?php the_content();?>
							</header>
						</div>
					</div>
				</div>
			<?php
			endif;
			?>
			
			<?php
			$taxonomy = 'event-category';
			$post_categories = get_terms( array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => true,
			) );			
			?>
			
			<?php 
				$args = array(  
					'post_type' => 'event',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'orderby' => 'title',
					'order' => 'ASC',
				);	 
				$posts = get_posts($args);
			?>
			
			<?php get_template_part('template-parts/content', 'load-more-filter-grid', 
				array(
					'cpt'   => 'event',
					'posts' => $posts,
					'posts-per-load' => 2,
					'post_categories' => $post_categories,
				),
			);?>
	
		</main><!-- #main -->
	</div>
</div>

<?php
get_footer();
