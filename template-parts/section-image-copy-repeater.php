<?php
$icrs = get_field('image_copy_repeater') ?? get_sub_field('image_copy_repeater') ?? null;
?>

<?php foreach($icrs as $icr):
	$row_type = $icr['row_type'];
	$content_layout = $icr['content_layout'] ?? null;
	$bottom_border_style = $icr['bottom_border_style'] ?? null;
	$layout = '';
	if ( $content_layout == 'image-right' ) {
		$layout = ' tablet-flex-dir-row-reverse';
	}
	if( $row_type == 'single' ) {
		$content = $icr['content'] ?? null;
	}
	if( $row_type == 'slider' ) {
		$slides = $icr['slides'] ?? null;
	}
?>
	<section class="image-copy-repeater type-<?=$row_type;?> layout-<?=$content_layout?> border-<?=$bottom_border_style;?>">
		<?php if( $row_type == 'single' ) {
			$image = $content['image'];
			$copy = $content['copy'];
			get_template_part('template-parts/part', 'image-copy-row',
				array(
					'layout' => $layout,
					'image' => $image,
					'copy' => $copy,
				),
			);
			
		}?>
		<?php if( $row_type == 'slider' ) :?>
			<div class="ics-slider img-pagination-slider">
				<div class="swiper-wrapper">
					<?php foreach($slides as $slide) {
						echo '<div class="swiper-slide">';
						$image = $slide['image'];
						$copy = $slide['copy'];
						get_template_part('template-parts/part', 'image-copy-row',
							array(
								'layout' => $layout,
								'image' => $image,
								'copy' => $copy,
							),
						);
						echo '</div>';
					}?>
				</div>
				<div class="grid-container">
					<div class="grid-x grid-padding-x align-middle<?=$layout;?>">
						<div class=" cell small-12 tablet-5"></div>
						<div class="cell small-12 tablet-7 large-6 xlarge-5">
							<div class="pagination-wrap">
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif;?>
	</section>
	<?php if( $bottom_border_style == 'gradient' ):?>
		<div class="gradient-border"></div>
	<?php endif;?>
<?php endforeach;?>