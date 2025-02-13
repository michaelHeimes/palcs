<?php
$latest_posts_background_image = get_field('latest_posts_background_image') ?? get_sub_field('latest_posts_background_image') ?? null;
$latest_posts_heading = get_field('latest_posts_heading') ?? get_sub_field('latest_posts_heading') ?? null;
$school_wide_post = get_field('school-wide_post') ?? get_sub_field('school-wide_post') ?? null;
$elementary_post = get_field('elementary_post') ?? get_sub_field('elementary_post') ?? null;
$middle_school_post = get_field('middle_school_post') ?? get_sub_field('middle_school_post') ?? null;
$high_school_post = get_field('high_school_post') ?? get_sub_field('high_school_post') ?? null;
$activities_post = get_field('activities_post') ?? get_sub_field('activities_post') ?? null;
$enrichment_post = get_field('enrichment_post') ?? get_sub_field('enrichment_post') ?? null;

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
			
			<?php if( !empty( $school_wide_post ) ) {
				$posts = is_array($school_wide_post) ? $school_wide_post : [$school_wide_post];
				foreach($posts as $post) {
					setup_postdata($post);
					get_template_part('template-parts/loop', 'latest-post',
						array(
							'category_name' => 'school-wide',
						),
					);
				} wp_reset_postdata();
			};?>
			
			<?php if( !empty( $elementary_post ) ) {
				$posts = is_array($elementary_post) ? $elementary_post : [$elementary_post];
				foreach($posts as $post) {
					setup_postdata($post);
					get_template_part('template-parts/loop', 'latest-post',
						array(
							'category_name' => 'elementary',
						),
					);
				} wp_reset_postdata();
			};?>
			
			<?php if( !empty( $middle_school_post ) ) {
				$posts = is_array($middle_school_post) ? $middle_school_post : [$middle_school_post];
				foreach($posts as $post) {
					setup_postdata($post);
					get_template_part('template-parts/loop', 'latest-post',
						array(
							'category_name' => 'middle-school',
						),
					);
				} wp_reset_postdata();
			};?>
			
			<?php if( !empty( $high_school_post ) ) {
				$posts = is_array($high_school_post) ? $high_school_post : [$high_school_post];
				foreach($posts as $post) {
					setup_postdata($post);
					get_template_part('template-parts/loop', 'latest-post',
						array(
							'category_name' => 'high-school',
						),
					);
				} wp_reset_postdata();
			};?>
			
			<?php if( !empty( $activities_post ) ) {
				$posts = is_array($activities_post) ? $activities_post : [$activities_post];
				foreach($posts as $post) {
					setup_postdata($post);
					get_template_part('template-parts/loop', 'latest-post',
						array(
							'category_name' => 'activities',
						),
					);
				} wp_reset_postdata();
			};?>
			
			<?php if( !empty( $enrichment_post ) ) {
				$posts = is_array($enrichment_post) ? $enrichment_post : [$enrichment_post];
				foreach($posts as $post) {
					setup_postdata($post);
					get_template_part('template-parts/loop', 'latest-post',
						array(
							'category_name' => 'enrichment',
						),
					);
				} wp_reset_postdata();
			};?>

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