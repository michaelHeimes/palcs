<?php
/**
 * The off-canvas menu uses the Off-Canvas Component
 *
 * For more info: https://jointswp.com/docs/off-canvas-menu/
 */
 $ctachwtb_button_link_1 = get_field('ctachwtb_button_link_1', 'option') ?? get_field('ctachwtb_button_link_1') ?? get_sub_field('ctachwtb_button_link_1') ?? null;
 $ctachwtb_button_link_2 = get_field('ctachwtb_button_link_2', 'option') ?? get_field('ctachwtb_button_link_2') ?? get_sub_field('ctachwtb_button_link_2') ?? null;
?>

<div class="top-bar-wrap">
	
	<?php if( wp_get_nav_menu_items(get_nav_menu_locations()['social-links']) || wp_get_nav_menu_items(get_nav_menu_locations()['header-secondary-nav']) ): ?>
		<div class="pre-header-nav blue-bg uppercase">
			<div class="grid-container fluid">
				<div class="grid-x grid-padding-x align-middle">
					<?php if( wp_get_nav_menu_items(get_nav_menu_locations()['social-links'])):?>
						<div class="cell shrink show-for-tablet">
							<nav>
								<?php trailhead_social_links();?>
							</nav>
						</div>
					<?php endif;?>
					<?php if( wp_get_nav_menu_items(get_nav_menu_locations()['header-secondary-nav'])):?>
						<div class="right cell small-12 tablet-auto grid-x align-middle color-white">
							<?php trailhead_header_secondary_nav();?>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	<?php endif;?>
	
	<div class="header-middle">
		<div class="site-branding show-for-sr">
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$trailhead_description = get_bloginfo( 'description', 'display' );
			if ( $trailhead_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?= esc_html( $trailhead_description );?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-bottom">
				<?php 
				$image = get_field('header_logo', 'option');
				if( !empty( $image ) ): ?>
				<div class="left cell small-12 large-auto">
					<ul class="menu">
						<li class="logo"><a href="<?= home_url(); ?>">
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
				<?php if( !empty($ctachwtb_button_link_1) || !empty($ctachwtb_button_link_2) ):?>
					<div class="right cell small-12 large-shrink">
						<div class="grid-x grid-padding-x">
							<?php if( !empty($ctachwtb_button_link_1) ):?>
								<?php
									$link = $ctachwtb_button_link_1;
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<div class="cell small-12 medium-shrink large-6">
									<a class="button purple-ds" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
								</div>
							<?php endif;?>
							<?php if( !empty($ctachwtb_button_link_2) ):?>
								<?php
									$link = $ctachwtb_button_link_2;
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<div class="cell small-12 medium-shrink large-6">
									<a class="button purple-ds" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
								</div>
							<?php endif;?>
						</div>
					</div>
				<?php endif;?>
			</div>
		</div>
	</div>

	<?php if( wp_get_nav_menu_items(get_nav_menu_locations()['header-secondary-nav']) || wp_get_nav_menu_items(get_nav_menu_locations()['offcanvas-nav']) ):?>
	<div id="sticky-nav-trigger">
		<div data-sticky-container>
			<div class="sticky sticky-nav" data-sticky data-sticky-on="small" style="width:100%" data-top-anchor="sticky-nav-trigger" data-btm-anchor="primary:bottom" data-options="marginTop:0;">
				<div class="top-bar uppercase" id="top-bar-menu">
					<div class="grid-container">
						<div class="grid-x grid-padding-x">
							<?php if( wp_get_nav_menu_items(get_nav_menu_locations()['header-secondary-nav']) ):?>
							<div class="top-bar-left cell small-12 large-auto relative grid-x align-middle show-for-large">
								<?php if( !empty( get_field('header_logo', 'option') ) ) {
									$imgID = get_field('header_logo', 'option')['ID'];
									$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
									$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
									echo '<div class="sticky-logo" style="visibility: hidden;"><a href="' . home_url() . '">';
									echo $img;
									echo '</a></div>';
								}?>
								<?php trailhead_header_nav();?>
							</div>
							<?php endif;?>
							<?php if( wp_get_nav_menu_items(get_nav_menu_locations()['offcanvas-nav']) ):?>
							<div class="top-bar-right cell small-12 large-shrink">
								<div class="grid-x align-right grid-x align-middle">
									<ul class="menu">
										<!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
										<li>
											<button class="menu-toggle no-style" data-toggle="off-canvas">
												<span class="uppercase">Full Menu</span>
												<svg xmlns="http://www.w3.org/2000/svg" width="17.334" height="16.788" viewBox="0 0 17.334 16.788">
							  					<path id="Path_457" data-name="Path 457" d="M-3997.248-7.817v-2.8h11.581v2.8Zm-2.285-7v-2.8h13.866v2.8Zm-3.467-7v-2.8h17.334v2.8Z" transform="translate(4003 24.605)" fill="#272727"/>
												</svg>
											</button>
										</li>
									</ul>
								</div>
							</div>
							<?php endif;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif;?>
	
</div>