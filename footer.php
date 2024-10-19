<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trailhead
 */
$email = get_field('contact_email_address', 'option');
$hours = get_field('hours', 'option');
?>
				<?php get_template_part('template-parts/section', 'cta-centered-heading-two-buttons');?>
				<footer id="colophon" class="site-footer">
					<div class="grid-container">
						<div class="top grid-x grid-padding-x align-center align-bottom">
						<?php 
						$image = get_field('header_logo', 'option');
						if( !empty( $image ) ): ?>
						<div class="left cell small-12 medium-shrink grid-x">
							<ul class="menu">
								<li class="logo"><a href="<?php echo home_url(); ?>">
									<?php if( !empty( get_field('header_logo', 'option') ) ) {
										$imgID = get_field('header_logo', 'option')['ID'];
										$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
										$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
										echo $img;
									}?>
								</a></li>
							</ul>
						</div>
						<?php endif;?>
							<?php if( wp_get_nav_menu_items(get_nav_menu_locations()['social-links']) ):?>
							<div class="right cell small-12 medium-shrink xlarge-shrink">
								<?php trailhead_social_links();?>
							</div>
							<?php endif; ?>
						</div>
						<div class="bottom grid-x grid-padding-x flex-dir-column large-flex-dir-row align-center">
							<?php if( !empty(get_field('locations', 'option')) || !empty(get_field('contact_email_address', 'option')) || !empty(get_field('hours', 'option')) ):
								$locations = get_field('locations', 'option') ?? null;
							?>
							<div class="left cell small-12 large-4 xlarge-3">
								<?php if($locations):?>
									<div class="locations">
										<?php foreach($locations as $location):
											$name = $location['name'] ?? null;
											$address = $location['address'] ?? null;
											$directions_url = $location['directions_url'] ?? null;
											$telephone_number = $location['telephone_number'] ?? null;
										?>
										<div class="location">
											<?php if( !empty($name) ):?>
												<h2 class="h6 font-size-20">
													<?=$name;?>
												</h2>
											<?php endif;?>
											<?php if( !empty($address) || !empty($directions_url) ):?>
												<div class="grid-x align-bottom">
													<?php if( !empty($address) ):?>
														<div><?=$address;?>
														<?php if( !empty($directions_url) ):?>-<?php endif;?>
														</div>
													<?php endif;?>
													<?php if( !empty($directions_url) ):?>
														<div> <a href="<?=$directions_url;?>" target="_blank">directions</a></div>
													<?php endif;?>
												</div>
											<?php endif;?>
											<?php if( !empty($telephone_number) ):?>
												<div class="phone-wrap uppercase">
													Tel: <a href="tel:<?=$telephone_number;?>"><?=$telephone_number;?></a>
												</div>
											<?php endif;?>
										</div>
										<?php endforeach;?>	
									</div>
								<?php endif;?>
								<?php if( !empty($email) || !empty($hours) ):?>
									<div class="email-hours">
										<?php if( !empty($email) ):?>
											<div>
												Email: <a href="mailto:<?=$email;?>"><?=$email;?></a>
											</div>
										<?php endif;?>
										<?php if( !empty($hours) ):?>
											<div>
												<?=$hours;?>
											</div>
										<?php endif;?>
									</div>
								<?php endif;?>
							</div>
							<?php endif;?>
							<?php if( wp_get_nav_menu_items(get_nav_menu_locations()['footer-nav']) ):?>
							<div class="right cell small-12 large-8 xlarge-7">
								<?php trailhead_footer_nav();?>
							</div>
							<?php endif;?>
						</div>
					</div>
					<div class="site-info blue-bg text-center large-text-left">
						<div class="grid-container fluid">
							<div class="grid-x grid-padding-x">
								<div class="cell small-12 large-auto">
									<div class="p">&copy;<?= date("Y");?>
										<?php if( !empty(get_field('footer_copyright', 'option') ) ){
											the_field('footer_copyright', 'option');	
										};?>
										
										<?php 
										$link = get_field('footer_privacy_policy_link', 'option');
										if( $link ): 
											$link_url = $link['url'];
											$link_title = $link['title'];
											$link_target = $link['target'] ? $link['target'] : '_self';
											?>
											 | <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="cell small-12 large-shrink">
									<div class="p">Website by: <a href="https://gopipedream.com/" target="_blank">Pipedream</a></div>
								</div>
							</div>
						</div>
					</div><!-- .site-info -->
				</footer><!-- #colophon -->
					
			</div><!-- #page -->
			
		</div>  <!-- end .off-canvas-content -->
							
	</div> <!-- end .off-canvas-wrapper -->
					
<?php wp_footer(); ?>

<?php if( !empty( get_field('before_closing_body', 'option') ) ) {
	echo get_field('before_closing_footer', 'option');
}?>

</body>
</html>
