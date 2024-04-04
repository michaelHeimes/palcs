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
$posts_page_link = get_permalink($posts_page_id); 
$current_category_id = get_queried_object_id();
?>

	<main id="primary" class="site-main">
		<?php get_template_part('template-parts/banner', 'full-width-image');?>
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="cell small-12 large-10">
	
					<?php
					if ( have_posts() ) :
			
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
						
						$post_categories = get_categories();
						
						if (!empty($post_categories)) {
							echo '<div class="tax-menu-wrap">';
							echo '<ul class="no-bullet tax-menu grid-x grid-padding-x">';
							foreach ($post_categories as $category) {
								// Check if the category has posts before displaying it
								$active = ($category->term_id == $current_category_id) ? 'active' : '';
								$category_link = get_category_link($category->term_id);
								$category_count = $category->count;
							
								if ($category_count > 0) {
									$link_or_span = ($category->term_id == $current_category_id) ? 'span' : 'a';
									$link_attributes = ($category->term_id == $current_category_id) ? '' : 'href="' . esc_url($category_link) . '"';
									echo '<li class="cell shrink top-level"><' . $link_or_span . ' class="button no-style font-size-20" ' . $link_attributes . '>' . esc_html($category->name) . '</' . $link_or_span . '></li>';
								}
							}
							if ($posts_page_link) {
								$link_or_span = ($current_category_id == get_option('page_for_posts')) ? 'span' : 'a';
								$link_attributes = ($current_category_id == get_option('page_for_posts')) ? '' : 'href="' . esc_url($posts_page_link) . '"';
								echo '<li class="cell shrink top-level"><' . $link_or_span . ' class="button no-style font-size-20" ' . $link_attributes . '>All</' . $link_or_span . '></li>';
							}
							echo '</ul>';
							echo '</div>';
						}?>

						<div class="grid-x grid-padding-x">
							
							<?=do_shortcode( '[ajax_load_more archive="true" post_type="post" posts_per_page="9" css_classes="grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-3"]' );?>
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
