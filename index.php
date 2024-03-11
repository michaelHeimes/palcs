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

?>

	<main id="primary" class="site-main">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="cell small-12 large-10">
	
						<?php
						if ( have_posts() ) :
				
							if ( is_home() && ! is_front_page() ) :
								$current_page_id = get_queried_object_id();
								$intro_copy = get_field('intro_copy', $current_page_id);
								?>
								<header class="grid-intro-text">
									<?php if(!empty($intro_copy)):?>
										<?=$intro_copy;?>
									<?php else:?>
										<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
									<?php endif;?>
								</header>
								
								<?php
							endif;
							
							$post_categories = get_categories();
							
							if (!empty($post_categories)) {
								echo '<div class="tax-menu-wrap">';
								echo '<ul class="no-bullet tax-menu grid-x grid-padding-x">';
								foreach ($post_categories as $category) {
									// Check if the category has posts before displaying it
									$category_link = get_category_link($category->term_id);
									$category_count = $category->count;
							
									if ($category_count > 0) {
										echo '<li class="cell shrink top-level"><a class="button no-style font-size-20" href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a></li>';
									}
								}
								if ($posts_page_link) {
									echo '<li class="cell shrink top-level"><span class="button no-style font-size-20" href="' . esc_url($posts_page_link) . '">All</span></li>';
								}
								echo '</ul>';
								echo '</div>';
							}?>

							<div class="grid-x grid-padding-x">
								<?=do_shortcode( '[ajax_load_more archive="true" post_type="post" posts_per_page="9" css_classes="grid-x grid-padding-x"]' );?>
							</div>
							
							<div class="">
							<?php trailhead_page_navi();?>
							</div>
						<?php
						else :
				
							get_template_part( 'template-parts/content', 'none' );
				
						endif;
						?>
					
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
