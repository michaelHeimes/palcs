<?php
/**
 * Template name: Administration
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();

$team = $fields['team'] ?? null;
$terms_to_hide = $fields['terms_to_hide'] ?? null;

if( !empty($team) ) {
	$args = array(  
		'post_type' => 'administration',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'meta_key'  => 'last_name',
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'team',
				'field'    => 'slug',
				'terms'    => $team->slug,
			),
		),
	);
} else {
	$args = array(  
		'post_type' => 'administration',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'meta_key'  => 'last_name',
		'orderby' => 'meta_value',
		'order' => 'ASC',
	);
}

$posts = get_posts($args);

$classes = 'no-banner';
if( get_field('cta_video_slider_slides') ) {
	$classes = 'has-banner';
}

?>

<div class="content posts-page teachers-staff-posts <?php if( !empty($team) ) { echo $team->slug; } else { echo 'all'; };?>">
	<div class="inner-content">
	
		<main id="primary" class="site-main">
	
			<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
			
				<header class="entry-header">
					<?php get_template_part('template-parts/section', 'ctas-video-slider');?>
				</header><!-- .entry-header -->
				
				<?php get_template_part('template-parts/content', 'load-more-filter-grid', 
					array(
						'cpt'   => 'administration',
						'posts' => $posts,
						'posts-per-load' => 12,
						'team' => $team,
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
<div class="gradient-border"></div>
<?php
get_footer();