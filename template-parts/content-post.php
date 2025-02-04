<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */
$classes = 'no-banner';
 if( get_field('full_width_banner_image') ) {
	 $classes = 'has-banner';
 }
 $classes .= ' cell small-12 medium-6 tablet-4';
 
 $featured_image_alignment_in_content = get_field('featured_image_alignment_in_content') ?? null;
 
 $post_title = get_the_title();
 $post_permalink = get_permalink();
 
 // Construct the mailto link
 $subject = rawurlencode("Shared from PALCS.org: $post_title");
 $body = rawurlencode("I wanted to share with you this post from PALCS.org: $post_permalink");
 $mailto_link = "mailto:?subject=$subject&body=$body";
 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<?php 
		if( get_field('full_width_banner_image') ) {
			get_template_part('template-parts/banner', 'full-width-image');
		}
	?>
	<header class="entry-header">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="cell small-12 large-11 xlarge-10">
		
					<?php the_title( '<h1 class="entry-title">', '</h1>' );?>
					
					<?php if( !$featured_image_alignment_in_content ):?>
						<div class="thumb-banner text-center">
							<?php the_post_thumbnail( 'large' );?>
						</div>
					<?php endif;?>
					
				</div>
			</div>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class=" cell small-12 large-11 xlarge-10">
					<?php if( $featured_image_alignment_in_content ):?>
						<span class="thumb-float">
							<?php the_post_thumbnail( 'large' );?>
						</span>
					<?php endif;?>
					<div class="content-wrap">
						<?php
						the_content(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'trailhead' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								wp_kses_post( get_the_title() )
							)
						);
						?>
					</div>
					
					
					<div class="social-links a2a_kit grid-x grid-padding-x align-middle">
					
						<div class="cell shrink share-label font-header cell shrink color-purple">
							Share
						</div>
					
						<div class="cell shrink">
							<a class="a2a_button_facebook" href="#">
								<svg data-name="Group 365" xmlns="http://www.w3.org/2000/svg" width="40.544" height="40.544"><path data-name="Path 354" d="M20.272 40.544A20.272 20.272 0 0 1 0 20.272 20.272 20.272 0 0 1 20.272 0a20.272 20.272 0 0 1 20.272 20.272 20.272 20.272 0 0 1-20.272 20.272Z" fill="#0151d4"/><g data-name="Group 5"><path data-name="Path 237" d="M25.085 20.285h-3.141v11.249h-4.685V20.285h-2.213v-3.964h2.214v-2.574a5.571 5.571 0 0 1 .36-2.034 3.951 3.951 0 0 1 1.416-1.879 4.943 4.943 0 0 1 2.935-.824l3.475.026v3.861h-2.523a1 1 0 0 0-.644.206 1.084 1.084 0 0 0-.335.875v2.343h3.552Z" fill="#fff"/></g></svg>
							</a>
						</div>
																
						<div class="cell shrink">
							<a class="a2a_button_twitter" href="#">
								<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" version="1.1" width="40.544" height="40.544" viewBox="0 0 216 216"><circle class="st1" cx="108" cy="108" r="107.7" fill="#0151d4"/><path class="st0" d="M40.4 167.9h12.7L169.2 48.4h-12.6L40.4 167.9z" fill="#ffffff"/><path class="st1" d="M159.4 162.9h-25.9L50.8 53.3h26l82.6 109.6z" fill="#0151d4"/><path class="st0" d="M169.5 167.9H131L40.7 48.3h38.5l90.2 119.6Zm-33.6-10h13.5L74.3 58.3H60.8l75.1 99.6Z" fill="#ffffff"/></svg>
							</a>
						</div>
					
						<div class="cell shrink">
							<a class="a2a_button_linkedin" data-url="<?php echo get_permalink();?>" href="#">
								<img width="40.544" height ="40.544" src="<?=get_template_directory_uri();?>/assets/images/li-blue-icon.png" alt="Linkedin icon">
							</a>
						</div>
						
						<div class="cell shrink">
							<a href="<?= esc_url($mailto_link); ?>" target="_blank">
								<img width="40.544" height ="40.544" src="<?=get_template_directory_uri();?>/assets/images/palcs-email-share.png" alt="Mail icon">
							</a>
						</div>
						
					</div>
					
					<script async src="https://static.addtoany.com/menu/page.js"></script>					
					
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->

	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<div class="cell small-12 large-11 xlarge-10">
				<footer class="entry-footer">

					<?php
					$post_id = get_the_ID();		
					$categories = get_the_category($post_id);
					if( $categories && !is_wp_error($categories)) {
						echo '<ul class="tax-menu no-bullet grid-x grid-padding-x font-header">';
						echo '<li class="tax-label cell shrink color-purple">See All</li>';
						
						// Loop through each category
						if($categories) {
							foreach ($categories as $category) {
								$category_link = get_category_link($category->term_id);
								// Get the terms assigned to the post for the current taxonomy
								echo '<li class="color-purple cell shrink">';
								echo '<a class="button no-style" href="' . esc_url($category_link) . '">';
								echo esc_html($category->name);
								echo '</a>';
								echo '</li>';
							}
						}
					
						echo '</ul>';
					}
					?>
					<div class="grid-x grid-padding-x align-center">
						<div class="cell small-10 large-8 xlarge-6">
							<ul class="pagination grid-x grid-padding-x align-justify">
								<li class="previous-link cell shrink">
									<?php previous_post_link('<span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="9.609" height="15.561" viewBox="0 0 9.609 15.561"><path id="prev" d="M16.371,6,18.2,7.828,12.26,13.781,18.2,19.733l-1.828,1.828L8.59,13.781Z" transform="translate(-8.59 -6)" fill="#0150d4"/></svg></span> %link', 'Previous'); ?>
								</li>
								<li class="next-link cell shrink">
									<?php next_post_link('%link <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="9.609" height="15.561" viewBox="0 0 9.609 15.561"><path id="prev" d="M10.419,6,8.59,7.828l5.939,5.952L8.59,19.733l1.829,1.828L18.2,13.781Z" transform="translate(-8.59 -6)" fill="#0150d4"/></svg></span>', 'Next'); ?>
								</li>
							</ul>
						</div>
					</div>
				</footer><!-- .entry-footer -->
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->

