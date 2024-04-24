<?php
/**
 * Template name: Search Page
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
			<div class="grid-container">
				<div class="grid-x grid-padding-x align-center">
					<div class="cell small-12 large-10 xxlarge-8">
						<?php the_content();?>
						<div class="search-wrap">
							<form id="search-form" class="purple-ds font-size-20 grid-x">
								<input type="text" id="search-input" name="search" placeholder="Search text goes here">
								<button type="submit">Search</button>
							</form>
						</div>
						<div id="search-query" class="h3 color-black"></div>
						<div id="search-results"></div>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div>
</div>
<div class="gradient-border"></div>
<?php
get_footer();
