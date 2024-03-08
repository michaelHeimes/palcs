<?php
/**
 * Template name: Teachers & Staff Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();

$stage_terms = get_terms( array(
	'taxonomy'   => 'stage',
	'hide_empty' => true,
) );

?>
	<div class="content">
		<div class="inner-content">

			<main id="primary" class="site-main">
		
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<header class="entry-header home-banner text-center">

					</header><!-- .entry-header -->
					
					<div class="alm-filter-nav init">
						<div class="stages">
							<?php foreach($stage_terms as $term):?>
								<button type="button" class="filter-btn top-level" data-post-type="teacher-staff" data-taxonomy="stage" data-taxonomy-terms="<?=$term->slug;?>" data-posts-per-page="12" data-scroll="false" data-button-label="More Work"><?=$term->name;?></button>
							<?php endforeach;?>
							<button type="button" class="filter-btn top-level all" data-post-type="teacher-staff" data-taxonomy="" data-taxonomy-terms="" data-posts-per-page="12" data-scroll="false" data-button-label="More Work">All</button>
						</div>
					</div>
				
					<?=do_shortcode( '[ajax_load_more id="alm_8413842141" post_type="teacher-staff" posts_per_page="12" scroll="false"]' );?>
							
					<footer class="article-footer">
						 <?php wp_link_pages(); ?>
					</footer> <!-- end article footer -->
						
				</article><!-- #post-<?php the_ID(); ?> -->
		
			</main><!-- #main -->
				
		</div>
	</div>

<?php
get_footer();