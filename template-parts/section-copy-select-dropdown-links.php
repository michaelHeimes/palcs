<?php
$heading = get_field('csdl_heading') ?? get_sub_field('csdl_heading') ?? null;
$subheading = get_field('csdl_subheading') ?? get_sub_field('csdl_subheading') ?? null;
$copy = get_field('csdl_copy') ?? get_sub_field('csdl_copy') ?? null;
$dropdown_title = get_field('csdl_dropdown_title') ?? get_sub_field('csdl_dropdown_title') ?? null;
$dropdown_button_text = get_field('csdl_dropdown_button_text') ?? get_sub_field('csdl_dropdown_button_text') ?? null;
$dropdown_links = get_field('csdl_dropdown_links') ?? get_sub_field('csdl_dropdown_links') ?? null;
$stat_images = get_field('stat_images') ?? get_sub_field('stat_images') ?? null;
?>
<section class="copy-select-dropdown-links" itemprop="text">
	<div class="grid-container">
		<div class="inner grid-x grid-padding-x align-middle align-center">
			<?php if( !empty($heading) || !empty($subheading) || !empty($heading) ):?>
				<div class="left cell small-12 tablet-6 large-6 xlarge-5 has-bg">
					<dig class="bg"></dig>
					<div class="relative">
						<?php if( !empty($heading) ):?>
							<h2 class="color-blue"><?=$heading;?></h2>
						<?php endif;?>
						<?php if( !empty($subheading) ):?>
							<h1 class="h3 color-orange"><?=$subheading;?></h1>
						<?php endif;?>
						<?php if( !empty($copy) ):?>
							<div class="copy-wrap"><?=$copy;?></div>
						<?php endif;?>
					</div>
				</div>
			<?php endif;?>
			<?php if( !empty($dropdown_title) || !empty($dropdown_button_text) || !is_empty($dropdown_links) ):?>
				<div class="right cell small-12 medium-8 tablet-6 large-6 xlarge-5 grid-x align-center">
					<div class="inner text-center">
						<?php if( !empty($dropdown_title) ):?>
							<h3 class="color-dark-gray"><?=$dropdown_title;?></h3>
						<?php endif;?>
						<div class="dropdown-wrap relative">
							<?php if( !empty($dropdown_button_text) ):?>
								<button class="button grid-x align-middle align-justify weight-black color-white" type="button" data-toggle="csdl-dropdown-<?=sanitize_title($dropdown_button_text);?>">
									<span class="h3"><?=$dropdown_button_text;?></span>
									<svg xmlns="http://www.w3.org/2000/svg" width="28.795" height="17.781" viewBox="0 0 28.795 17.781"><path id="ic_keyboard_arrow_up_24px" d="M9.383,8,20.4,18.99,31.412,8l3.383,3.383-14.4,14.4L6,11.383Z" transform="translate(-6 -8)" fill="#fff"/></svg>
								</button>
							<?php endif;?>
							<?php if(!empty($dropdown_links) ):?>
								<div class="dropdown-pane" id="csdl-dropdown-<?=sanitize_title($dropdown_button_text);?>" data-dropdown data-auto-focus="true">
									<nav>
										<ul class="ul menu vertical">
										<?php foreach($dropdown_links as $dropdown_link):
											$link = $dropdown_link['link'];
											if( $link ): 
												$link_url = $link['url'];
												$link_title = $link['title'];
												$link_target = $link['target'] ? $link['target'] : '_self';
												?>
											<li>
												<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
											</li>
											<?php endif; ?>
										<?php endforeach;?>
										</ul>
									</nav>
								</div>
							<?php endif;?>
						</div>
					</div>
				</div>
			<?php endif;?>
		</div>
		<?php if( !empty( $stat_images ) ):?>
			<div class="stat-images align-center align-center-middle grid-x grid-padding-x">
				<div class="cell small-12 large-10">
					<div class="grid-x grid-padding-x align-center small-up-1 tablet-up-3 xlarge-up-6">
						<?php foreach( $stat_images as $stat_image ):
							$image = $stat_image['image'] ?? null;	
							$hide_on_mobile = $stat_image['hide_on_mobile'] ?? null;	
							$link = $stat_image['link'] ?? null;	
							$classes = '';
							if( $hide_on_mobile == true ) {
								$classes = 'show-for-tablet';
							}
						?>
							<div class="img-wrap cell text-center <?=$classes;?>">
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
	</div>
</section>
<div class="gradient-border"></div>