<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
 
 $posts_page_id = get_option('page_for_posts'); // Retrieve the ID of the posts page
 $posts_page_link = '/events/'; 
 
 ?>
 
	 <main id="primary" class="site-main">
		 <?php get_template_part('template-parts/banner', 'full-width-image');?>
		 <div class="content">
			 <?php
			 if ( have_posts() ) :
				 
				 $event_categories = get_terms( array(
				 'taxonomy'   => 'event-category',
				 'hide_empty' => true,
				 ) );
 
				 $args = array(  
					 'post_type' => 'event',
					 'post_status' => 'publish',
					 'posts_per_page' => -1,
					 'orderby' => 'title',
					 'order' => 'ASC',
				 );	 
				 $posts = get_posts($args);
				 
				 get_template_part('template-parts/content', 'load-more-filter-grid', 
					 array(
						 'cpt'   => 'event',
						 'posts' => $posts,
						 'posts-per-load' => 2,
						 'post_categories' => $event_categories,
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
