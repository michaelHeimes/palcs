<?php
$latest_posts_background_image = get_field('latest_posts_background_image') ?? get_sub_field('latest_posts_background_image') ?? null;
$latest_posts_heading = get_field('latest_posts_heading') ?? get_sub_field('latest_posts_heading') ?? null;
$latest_posts_cta_heading = get_field('latest_posts_cta_heading') ?? get_sub_field('latest_posts_cta_heading') ?? null;
$latest_posts_cta_button_link = get_field('latest_posts_cta_button_link') ?? get_sub_field('latest_posts_cta_button_link') ?? null;
?>
<section class="latest-posts relative overflow-hidden has-bg">
	<?php if( !empty( $latest_posts_background_image ) ) {
		$imgID = $latest_posts_background_image['ID'];
		$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
		$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "bg-img", "alt"=>$img_alt] );
		echo $img;
	}?>
	<div class="mask bg-img"></div>
	<div class="grid-container relative">
		<div class="grid-x grid-padding-x">
			<?php if( !empty($latest_posts_heading) ):?>
				<div class="cell small-12">
					<h2 class="text-center color-white"><?=$latest_posts_heading;?></h2>
				</div>
			<?php endif;?>
			
			<?php
			$categories = get_categories();
			
			foreach ($categories as $category) {
				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => 1,
					'cat' => $category->cat_ID,
					'orderby' => 'date',
					'order' => 'DESC',
				);
			
				$loop = new WP_Query($args);
			
				$sticky_args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => 1,
					'cat' => $category->cat_ID,
					'ignore_sticky_posts' => 1, // Ignore regular posts in the sticky posts loop
					'orderby' => 'date',
					'order' => 'DESC',
					'post__in' => get_option( 'sticky_posts' ),
				);
			
				$sticky_loop = new WP_Query($sticky_args);
			
				// Check if there's a sticky post, if not, fall back to regular posts
				if ($sticky_loop->have_posts()) :
					while ($sticky_loop->have_posts()) : $sticky_loop->the_post();
						get_template_part('template-parts/loop', 'latest-post');
					endwhile;
				elseif ($loop->have_posts()) :
					while ($loop->have_posts()) : $loop->the_post();
						get_template_part('template-parts/loop', 'latest-post');
					endwhile;
				endif;
			
				wp_reset_postdata();
			}
			?>


		</div>
		
		<?php if( !empty($latest_posts_cta_heading) || !empty($latest_posts_cta_button_link) ){
			get_template_part('template-parts/part', 'heading-button-link-cta', 
				array(
					'heading' => $latest_posts_cta_heading,
					'link' => $latest_posts_cta_button_link,
				)
			);
		}?>
		
	</div>
</section>
<div class="gradient-border"></div>