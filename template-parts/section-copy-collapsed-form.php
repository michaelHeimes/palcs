<?php
$heading = get_field('csdl_heading') ?? get_sub_field('csdl_heading') ?? null;
$subheading = get_field('csdl_subheading') ?? get_sub_field('csdl_subheading') ?? null;
$copy = get_field('csdl_copy') ?? get_sub_field('csdl_copy') ?? null;
$form_heading = get_field('form_heading') ?? get_sub_field('form_heading') ?? null;
$form_caption = get_field('form_caption') ?? get_sub_field('form_caption') ?? null;
$gravity_form = get_field('gravity_form') ?? get_sub_field('gravity_form') ?? null;
$stat_images = get_field('stat_images') ?? get_sub_field('stat_images') ?? null;
?>
<section class="copy-collapsed-form" itemprop="text">
	<div class="grid-container">
		<div class="inner grid-x grid-padding-x align-middle align-center">
			<?php if( !empty($heading) || !empty($subheading) || !empty($heading) ):?>
				<div class="left cell small-12 tablet-6 large-6 xlarge-5 has-bg">
					<dig class="bg"></dig>
					<div class="relative">
						<?php if( !empty($heading) ):?>
							<h2 class="color-blue"><?=wp_kses_post( $heading );?></h2>
						<?php endif;?>
						<?php if( !empty($subheading) ):?>
							<h3 class="color-orange-ada"><?=wp_kses_post( $subheading );?></h3>
						<?php endif;?>
						<?php if( !empty($copy) ):?>
							<div class="copy-wrap"><?=wp_kses_post( $copy );?></div>
						<?php endif;?>
					</div>
				</div>
			<?php endif;?>
			<?php if( $form_heading || $form_caption || $gravity_form ) :?>
				<div class="right cell small-12 medium-8 tablet-6 large-6 xlarge-5 grid-x align-center">
					<?php get_template_part('template-parts/part', 'collapsed-form',
						array(
							'form-id' => '1',
							'heading' => $form_heading,
							'caption' => $form_caption,
							'gravity-form' => $gravity_form,
						),
					);?>
				</div>
			<?php endif;?>
		</div>
		<?php if( !empty( $stat_images ) ) {
			get_template_part('template-parts/section', 'stat-images',
				array(
					'stat-images' => $stat_images,
				)
			);	
		};?>
	</div>
</section>
<div class="gradient-border"></div>