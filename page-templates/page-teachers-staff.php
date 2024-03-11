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

$grade_terms = get_terms( array(
	'taxonomy'   => 'grade',
	'hide_empty' => true,
) );

$enrichment_terms = get_terms( array(
	'taxonomy'   => 'enrichment',
	'hide_empty' => true,
) );

$department_1s = get_terms( array(
	'taxonomy'   => 'department-1',
	'hide_empty' => true,
) );

$department_2s = get_terms( array(
	'taxonomy'   => 'department-2',
	'hide_empty' => true,
) );

$intro_text = get_field('intro_text') ?? null;

?>
	<div class="content">
		<div class="inner-content">

			<main id="primary" class="site-main">
		
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<header class="entry-header">
						<div class="grid-container">
							<div class="grid-x grid-padding-x align-center">
								<div class="cell small-12 xlarge-10">
									<?php if( !empty($intro_text) ) {
										get_template_part('template-parts/part', 'grid-intro', 
											array(
												'intro_text' => $intro_text,
											),
										);
									};?>
								</div>
							</div>
						</div>
					</header><!-- .entry-header -->
					
					<div class="alm-filtered teachers-staff alm-filtered-grid init">
						<div class="grid-container">
							<div class="grid-x grid-padding-x align-center">
								<div class="cell small-12 xlarge-10">
						
									<div class="alm-filter-nav tax-menu-wrap">
										<div class="stages tax-menu grid-x grid-padding-x font-size-20">
											<?php foreach($stage_terms as $term):?>
												<div class="cell shrink top-level">
													<button type="button" class="filter-btn no-style" data-post-type="teacher-staff" data-taxonomy="stage" data-taxonomy-terms="<?=$term->slug;?>" data-posts-per-page="12" data-scroll="false" data-button-label="Load More "><?=$term->name;?></button>
												</div>
											<?php endforeach;?>
											<div class="cell shrink top-level">
												<button type="button" class="filter-btn no-style all" data-post-type="teacher-staff" data-taxonomy="" data-taxonomy-terms="" data-posts-per-page="12" data-scroll="false" data-button-label="Load More">All</button>
											</div>
										</div>
										<div class="other-terms tax-menu grid-x grid-padding-x">
											<?php foreach($grade_terms as $term):?>
												<div class="cell shrink">
													<button type="button" class="filter-btn top-level no-style" data-post-type="teacher-staff" data-taxonomy="grade" data-taxonomy-terms="<?=$term->slug;?>" data-posts-per-page="12" data-scroll="false" data-button-label="Load More "><?=$term->name;?></button>
												</div>
											<?php endforeach;?>
											<?php foreach($enrichment_terms as $term):?>
												<div class="cell shrink">
													<button type="button" class="filter-btn top-level no-style" data-post-type="teacher-staff" data-taxonomy="enrichment" data-taxonomy-terms="<?=$term->slug;?>" data-posts-per-page="12" data-scroll="false" data-button-label="Load More "><?=$term->name;?></button>
												</div>
											<?php endforeach;?>
											<?php foreach($department_1s as $term):?>
												<div class="cell shrink">
													<button type="button" class="filter-btn top-level no-style" data-post-type="teacher-staff" data-taxonomy="department-1" data-taxonomy-terms="<?=$term->slug;?>" data-posts-per-page="12" data-scroll="false" data-button-label="Load More "><?=$term->name;?></button>
												</div>
											<?php endforeach;?>
											<?php foreach($department_2s as $term):?>
												<div class="cell shrink">
													<button type="button" class="filter-btn top-level no-style" data-post-type="teacher-staff" data-taxonomy="department-2" data-taxonomy-terms="<?=$term->slug;?>" data-posts-per-page="12" data-scroll="false" data-button-label="Load More "><?=$term->name;?></button>
												</div>
											<?php endforeach;?>
										</div>
									</div>

									<?=do_shortcode( '[ajax_load_more id="alm_8413842141" post_type="teacher-staff" order="ASC" orderby="meta_value" sort_key="last_name" posts_per_page="12" scroll="false" css_classes="grid-x grid-padding-x"]' );?>
								</div>
							</div>
						</div>
					</div>
										
					<footer class="article-footer">
						 <?php wp_link_pages(); ?>
					</footer> <!-- end article footer -->
						
				</article><!-- #post-<?php the_ID(); ?> -->
		
			</main><!-- #main -->
				
		</div>
	</div>

<?php
get_footer();