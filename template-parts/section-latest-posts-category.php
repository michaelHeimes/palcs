<?php
$cat = $args['lcp_cat'] ?? null;
if($cat) {
	$cat_string = implode(',', $cat) ?? null;
	$cat_ids = explode(',', $cat_string);
}
$bg_img = $args['lcp_bg_img'] ?? null; 
$heading = $args['lcp_heading'] ?? null;
$link = $args['lcp_link'] ?? null;
?>
<section class="latest-posts-category relative">
	hi
	<?php if( !empty( $bg_img ) ) {
		$imgID = $bg_img['ID'];
		$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
		$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "bg-img", "alt"=>$img_alt] );
		echo $img;
	}?>
	<div class="bg-img mask"></div>
	<div class="grid-container relative">
		<?php if( !empty($heading) ):?>
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 text-center">
					<h2 class="cta-heading color-white"><?=esc_attr( $heading );?></h2>
				</div>
			</div>
		<?php endif;?>
		<?php	
		if( !$cat ) {
			$args = array(  
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => 4,
			);

		} else {
			$args = array(  
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => 4,
				'tax_query' => array(
					array(
						'taxonomy'  => 'category',
						'field'     => 'term_id',
						'terms'     => $cat_ids,
					)
				),
			);
		}
		
		$loop = new WP_Query( $args ); 
		
		if ( $loop->have_posts() ) : ?>
			<div class="grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-3 large-up-4 align-center">
				<?php
				while ( $loop->have_posts() ) : $loop->the_post();
					get_template_part('template-parts/loop', 'post');	
				
				endwhile;?>
			</div>
		<?php endif;
		wp_reset_postdata(); 
		?>
		<?php 
		if( $link ): 
			$link_url = $link['url'];
			$link_title = $link['title'];
			$link_target = $link['target'] ? $link['target'] : '_self';
			?>
			<div class="btn-wrap grid-x grid-padding-x text-center">
				<div class="cell small-12">
					<a class="button white-bg purple-ds" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				</div>
			</div>
		<?php endif; ?>

	</div>
</section>
<div class="gradient-border"></div>