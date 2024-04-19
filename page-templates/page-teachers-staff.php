<?php
/**
 * Template name: Teachers & Staff
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();

$stage = $fields['stage'] ?? null;
$terms_to_hide = $fields['terms_to_hide'] ?? null;

if( !empty($stage) ) {
	$args = array(  
		'post_type' => 'teacher-staff',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'meta_key'  => 'last_name',
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'stage',
				'field'    => 'slug',
				'terms'    => $stage->slug,
			),
		),
	);
} else {
	$args = array(  
		'post_type' => 'teacher-staff',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'meta_key'  => 'last_name',
		'orderby' => 'meta_value',
		'order' => 'ASC',
	);
}

$posts = get_posts($args);

$intro_text = $fields['intro_text'];

?>

<div class="content posts-page teachers-staff-posts <?php if( !empty($stage) ) { echo $stage->slug; } else { echo 'all'; };?>">
	<div class="inner-content">
	
		<main id="primary" class="site-main">
	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<header class="entry-header">
					<?php get_template_part('template-parts/section', 'ctas-video-slider');?>
					<div class="grid-container">
						<div class="grid-x grid-padding-x align-center">
							<div class="cell small-12 xlarge-10 xxlarge-8">
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
				
				<?php get_template_part('template-parts/content', 'load-more-filter-grid', 
					array(
						'cpt'   => 'teacher-staff',
						'posts' => $posts,
						'posts-per-load' => 12,
						'stage' => $stage,
						'terms-to-hide' => $terms_to_hide,
					),
				);?>

				<footer class="article-footer">
					 <?php wp_link_pages(); ?>
				</footer> <!-- end article footer -->
					
			</article><!-- #post-<?php the_ID(); ?> -->
	
		</main><!-- #main -->
			
	</div>
</div>

<?php
get_footer();