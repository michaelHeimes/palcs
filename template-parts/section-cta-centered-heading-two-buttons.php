<?php
$hide_pre_footer_cta = get_field('hide_pre-footer_cta') ?? null;
if( $hide_pre_footer_cta != true ):
	$ctachwtb_background_image = get_field('ctachwtb_background_image', 'option') ?? get_field('ctachwtb_background_image') ?? get_sub_field('ctachwtb_background_image') ?? null;
	$ctachwtb_heading = get_field('ctachwtb_heading', 'option') ?? get_field('ctachwtb_heading') ?? get_sub_field('ctachwtb_heading') ?? null;
	$ctachwtb_button_link_1 = get_field('ctachwtb_button_link_1', 'option') ?? get_field('ctachwtb_button_link_1') ?? get_sub_field('ctachwtb_button_link_1') ?? null;
	$ctachwtb_button_link_2 = get_field('ctachwtb_button_link_2', 'option') ?? get_field('ctachwtb_button_link_2') ?? get_sub_field('ctachwtb_button_link_2') ?? null;
	?>
	<section class="cta-centered-heading-two-buttons has-bg">
		<?php if( !empty( $ctachwtb_background_image ) ) {
			$imgID = $ctachwtb_background_image['ID'];
			$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
			$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "bg-img", "alt"=>$img_alt] );
			echo $img;
		}?>
		<div class="mask bg-img"></div>
		<div class="grid-container relative">
			<div class="grid-x grid-padding-x align-center text-center">
				<div class="cell small-12 medium-10 tablet-8 large-6 color-white">
					<h2><?=$ctachwtb_heading;?></h2>
				</div>
			</div>
			<div class="grid-x grid-padding-x align-center text-center">
				<?php 
				$link = $ctachwtb_button_link_1;
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
				<div class="cell small-12 medium-shrink">
					<a class="button white-bg blue-ds" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				</div>
				<?php endif; ?>
				<?php 
				$link =$ctachwtb_button_link_2;
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
				<div class="cell small-12 medium-shrink">
					<a class="button white-bg blue-ds" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<div class="gradient-border"></div>
<?php endif;?>