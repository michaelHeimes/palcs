<?php
// Register menus
register_nav_menus(
	array(
		'social-links'	=> __( 'Social Links', 'trailhead' ),		// Social Nav
		'header-secondary-nav'	=> __( 'Header Secondary Menu', 'trailhead' ),		// Social Nav
		'header-nav'		=> __( 'The Header Menu', 'trailhead' ),		// Main nav in header
		'offcanvas-nav'	=> __( 'The Off-Canvas Menu', 'trailhead' ),	// Off-Canvas nav
		'offcanvas-secondary-nav'	=> __( 'The Off-Canvas Secondary Menu', 'trailhead' ),	// Off-Canvas nav
		'footer-nav'	=> __( 'Footer Menu', 'trailhead' ),		// Secondary nav in footer
	)
);

// The Social Links Menu
function trailhead_social_links() {
	wp_nav_menu(array(
		'container'			=> false,				// Remove nav container
		'menu_id'			=> '',		// Adding custom nav id
		'menu_class'		=> 'social-links menu',				// Adding custom nav class
		'theme_location'	=> 'social-links',		// Where it's located in the theme
		'depth'				=> 0,					// Limit the depth of the nav
		'fallback_cb'		=> ''					// Fallback function
	));
} /* End Social Links Menu */

// The Header Menu
function trailhead_header_secondary_nav() {
	wp_nav_menu(array(
		'container'			=> true,						// Remove nav container
		'menu_id'			=> 'header-secondary-nav',					// Adding custom nav id
		'menu_class'		=> 'horizontal menu header-secondary-nav',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location'	=> 'header-secondary-nav',					// Where it's located in the theme
		'depth'				=> 1,							// Limit the depth of the nav
		'fallback_cb'		=> false,						// Fallback function (see below)
	));
}

// The Header Menu
function trailhead_header_nav() {
	wp_nav_menu(array(
		'container'			=> true,						// Remove nav container
		'menu_id'			=> 'header-nav',					// Adding custom nav id
		'menu_class'		=> 'horizontal menu dropdown',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-dropdown-menu data-submenu-toggle="true" data-hover-delay="0" data-closing-time="0">%3$s</ul>',
		'theme_location'	=> 'header-nav',					// Where it's located in the theme
		'depth'				=> 5,							// Limit the depth of the nav
		'fallback_cb'		=> false,						// Fallback function (see below)
		'walker'			=> new Header_Menu_Walker(),
	));
}

// Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
class Header_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = Array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"menu\">\n";
	}
}

// The Off Canvas Menu
function trailhead_off_canvas_nav() {
	wp_nav_menu(array(
		'container'			=> true,							// Remove nav container
		'menu_id'			=> 'offcanvas-nav',					// Adding custom nav id
		'menu_class'		=> 'vertical menu drilldown',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-drilldown data-parent-link="true" data-auto-height="true" data-animate-height="true">%3$s</ul>',
		'theme_location'	=> 'offcanvas-nav',					// Where it's located in the theme
		'depth'				=> 5,								// Limit the depth of the nav
		'fallback_cb'		=> false,							// Fallback function (see below)
		'walker'			=> new Off_Canvas_Menu_Walker(),
		'link_before'    => '<span>',
		'link_after'     => '</span>'	
	));
}

class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = Array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\">\n";
	}
}

// The Off Canvas Utility Menu
function trailhead_off_canvas_secondary_nav() {
	wp_nav_menu(array(
		'container'			=> true,							// Remove nav container
		'menu_id'			=> 'offcanvas-secondary-nav',					// Adding custom nav id
		'menu_class'		=> 'men',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
		'theme_location'	=> 'offcanvas-secondary-nav',					// Where it's located in the theme
		'depth'				=> 5,								// Limit the depth of the nav
		'fallback_cb'		=> false,							// Fallback function (see below)
	));
}

// The Footer Menu
function trailhead_footer_nav() {
	wp_nav_menu(array(
		'container'			=> true,							// Remove nav container
		'menu_id'			=> 'footer-nav',					// Adding custom nav id
		'menu_class'		=> 'list-menu',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location'	=> 'footer-nav',					// Where it's located in the theme
		'depth'				=> 2,								// Limit the depth of the nav
		'fallback_cb'		=> false,							// Fallback function (see below)
		'walker'			=> new Footer_Menu_Walker()
	));
}

class Footer_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = Array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\">\n";
	}
}


// Header Fallback Menu
function trailhead_main_nav_fallback() {
	wp_page_menu( array(
		'show_home'		=> true,
		'menu_class'	=> '',		// Adding custom nav class
		'include'		=> '',
		'exclude'		=> '',
		'echo'			=> true,
		'link_before'	=> '',		// Before each link
		'link_after'	=> ''		// After each link
	));
}

// Footer Fallback Menu
function trailhead_footer_links_fallback() {
	/* You can put a default here if you like */
}

// Add Foundation active class to menu
function required_active_nav_class( $classes, $item ) {
	if ( $item->current == 1 || $item->current_item_ancestor == true ) {
		$classes[] = 'active';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );


// Add ACF Fields to Main Nav

	function my_wp_nav_menu_objects( $items, $args ) {
					
		if ( $args->theme_location == 'social-links') {
			
			// loop
			foreach( $items as &$item ) {
				
				// vars
				$icon_header = get_field('white_bg_icon', $item);
				$icon_footer = get_field('blue_bg_icon', $item);				
				// append icon if either exists
				if( !empty($icon_header) || !empty($icon_footer) ) {
					
					
					// check if icons exist before accessing their properties
					$header_img = $icon_header ? '<img class="header" src="' . esc_url($icon_header['url']) . '" alt="' . esc_attr($icon_header['alt']) . '">' : '';
					$footer_img = $icon_footer ? '<img class="footer" style="dislay: none;" src="' . esc_url($icon_footer['url']) . '" alt="' . esc_attr($icon_footer['alt']) . '">' : '';
					
					// build the title with icons and screen reader text
					$item->title = '<span class="icon" aria-hidden="true">' . $header_img . $footer_img . '</span><span class="show-for-sr">' . esc_html($item->title) . '</span>';
					
				}
				
			}
			
			// return
			return $items;		
		
		}
 else {			
			// loop
			foreach( $items as &$item ) {}
			return $items;	
		}
		
	}
	
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);