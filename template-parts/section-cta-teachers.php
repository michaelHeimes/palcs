<?php
$teachers_cta_bg = $args['teachers_cta_bg'] ?? null;
$cta_teachers_heading = $args['cta_teachers_heading'] ?? null; 
$cta_teachers_text = $args['cta_teachers_text'] ?? null;
$link = $args['cta_teachers_button_link'] ?? null;
?>
<section class="teachers-cta relative">
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
					<h2 class="color-white"><?=esc_attr( $heading );?></h2>
				</div>
			</div>
		<?php endif;?>
		<?php			
		$args = array(  
			'post_type'      => 'teacher-staff',
			'posts_per_page' => 4,
			'orderby'        => 'rand',
		);
		
		$loop = new WP_Query( $args ); 
		
		if ( $loop->have_posts() ) : ?>
			<div class="grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-3 large-up-4 align-center">
				<?php
				while ( $loop->have_posts() ) : $loop->the_post();
					the_title();
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