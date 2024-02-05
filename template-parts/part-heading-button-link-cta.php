<?php
$heading = $args['heading'] ?? null;
$link = $args['link'] ?? null;
?>
<div class="part-header-button-link-cta">
	<div class="grid-x grid-padding-x align-center">
		<div class="cell small-12 large-11 xlarge-10">
			<div class="inner white-bg relative">
				<div class="grid-x grid-padding-x">
					<?php if( !empty($heading) ):?>
						<div class="cta-left cell small-12 tablet-6 large-8 color-white relative">
							<div class="grid-x align-middle">
								<div class="bg gradient-bg clip-path"></div>
								<h3 class="relative"><?=$heading;?></h3>
							</div>
						</div>
					<?php endif;?>
					<?php if( !empty($link) ):?>
						<div class="cta-right cell small-12 tablet-6 large-4 grid-x align-middle align-center">
							<?php 
							if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a class="button purple-ds" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php endif; ?>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>