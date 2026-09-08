<?php 
$stat_images = $args['stat-images'] ?? null;
if( !empty( $stat_images ) ):?>
	<div class="stat-images align-center align-center-middle grid-x grid-padding-x">
		<div class="cell small-12 large-10 xlarge-8">
			<div class="grid-x grid-padding-x align-center">
				<?php foreach( $stat_images as $stat_image ):
					$image = $stat_image['image'] ?? null;	
					$hide_on_mobile = $stat_image['hide_on_mobile'] ?? null;	
					$link = $stat_image['link'] ?? null;	
					$classes = '';
					if( $hide_on_mobile == true ) {
						$classes = 'show-for-tablet';
					}
				?>
					<div class="img-wrap cell small-6 medium-4 text-center grid-x align-middle align-center <?=$classes;?>">
						<?php 
						if( $link ): 
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
							?>
							<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
								<span class="show-for-sr" aria-label="Links to <?php echo esc_html( $link_title ); ?>"><?php echo esc_html( $link_title ); ?></span>
						<?php endif; ?>									
							<?php
							$size = 'full';
							if( $image ) {
								echo wp_get_attachment_image( $image['id'], $size );
							}?>
						<?php if( $link ): ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
<?php endif;?>