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
?>

	<main id="primary" class="site-main">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="cell small-12 large-10">
					<div class="grid-x grid-padding-x">
	
						<?php
						if ( have_posts() ) :
				
							if ( is_home() && ! is_front_page() ) :
								$current_page_id = get_queried_object_id();
								$intro_copy = get_field('intro_copy', $current_page_id);
								?>
								<header class="cell small-12">
									<?php if(!empty($intro_copy)):?>
										<?=$intro_copy;?>
									<?php else:?>
										<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
									<?php endif;?>
								</header>
								<?php
							endif;
				
							/* Start the Loop */
							while ( have_posts() ) :?>
								<?php
								the_post();
				
								/*
				 				* Include the Post-Type-specific template for the content.
				 				* If you want to override this in a child theme, then include a file
				 				* called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 				*/
								get_template_part( 'template-parts/loop', get_post_type() );
				
							endwhile;?>
							
							<div class="cell small-12">
							<?php trailhead_page_navi();?>
							</div>
						<?php
						else :
				
							get_template_part( 'template-parts/content', 'none' );
				
						endif;
						?>
					
					</div>
					<?php get_template_part('template-parts/section', 'post-footer-nav');?>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
