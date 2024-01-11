<?php
/**
 * The template part for displaying offcanvas content
 *
 * For more info: https://jointswp.com/docs/off-canvas-menu/
 */
 $learn_more_cta = get_field('learn_more_cta', 'option');
 $enroll_cta = get_field('enroll_cta', 'option');
 $phone_number = get_field('phone_number', 'option');
?>

<div class="off-canvas position-right grid-x align-right blue-bg uppercase" id="off-canvas" data-off-canvas>
	<div class="inner">
		<div class="menu-toggle-wrap grid-x align-middle">
			<div class="cell small-12 grid-x align-right">
				<button class="menu-toggle no-style color-white align-middle align-right" data-toggle="off-canvas" aria-expanded="false" aria-controls="off-canvas">
					<b>Close</b>
					<svg xmlns="http://www.w3.org/2000/svg" width="30.796" height="30.796" viewBox="0 0 30.796 30.796">
			  		<path id="ic_close_24px" d="M35.8,8.1,32.694,5,20.4,17.3,8.1,5,5,8.1,17.3,20.4,5,32.694l3.1,3.1L20.4,23.5l12.3,12.3,3.1-3.1L23.5,20.4Z" transform="translate(-5 -5)" fill="#fff"/>
					</svg>
				</button>
			</div>
		</div>
		<?php trailhead_off_canvas_nav(); ?>
		<div class="off-canvas-secondary-wrap">
			<?php trailhead_off_canvas_secondary_nav();?>
		</div>
		<?php if( !empty($learn_more_cta) || !empty($learn_more_cta) ):?>
			<div class="ctas">
				<div class="grid-x grid-padding-x align-center">
					<?php if( !empty($learn_more_cta) ):?>
						<?php
							$link = $learn_more_cta;
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<div class="cell shrink">
							<a class="button white-bg" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						</div>
					<?php endif;?>
					<?php if( !empty($enroll_cta) ):?>
						<?php
							$link = $learn_more_cta;
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<div class="cell shrink">
							<a class="button white-bg" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						</div>
					<?php endif;?>
				</div>
			</div>
		<?php endif;?>
		<?php if( !empty($phone_number) ):?>
			<div class="call-wrap text-center color-white">
				<h2><b>Questions?</b></h2>
				<a class="h2 color-white" href="tel:<?=$phone_number;?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="22.232" height="37.623" viewBox="0 0 22.232 37.623">
					  <path id="ic_phone_iphone_24px" d="M22.957,1H9.275A4.277,4.277,0,0,0,5,5.275V34.348a4.277,4.277,0,0,0,4.275,4.275H22.957a4.277,4.277,0,0,0,4.275-4.275V5.275A4.277,4.277,0,0,0,22.957,1ZM16.116,36.913a2.565,2.565,0,1,1,2.565-2.565A2.562,2.562,0,0,1,16.116,36.913Zm7.7-6.841H8.42V6.13H23.812Z" transform="translate(-5 -1)" fill="#fff"/>
					</svg>
					<b><?=$phone_number;?></b>
				</a>
			</div>
		<?php endif;?>
	</div>
</div>
