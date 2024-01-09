<?php
// Register menus
register_nav_menus(
	array(
		'social-links'	=> __( 'Social Links', 'trailhead' ),		// Social Nav
		'header-secondary-nav'	=> __( 'Header Secondary Menu', 'trailhead' ),		// Social Nav
		'header-nav'		=> __( 'The Header Menu', 'trailhead' ),		// Main nav in header
		'offcanvas-nav'	=> __( 'The Off-Canvas Menu', 'trailhead' ),	// Off-Canvas nav
		'offcanvas-supplemental-nav'	=> __( 'The Off-Canvas Supplemental Menu', 'trailhead' ),	// Off-Canvas nav
		'footer-nav'	=> __( 'Footer Menu', 'trailhead' ),		// Secondary nav in footer
	)
);

// The Social Links Menu
function trailhead_social_links() {
	wp_nav_menu(array(
		'container'			=> 'false',				// Remove nav container
		'menu_id'			=> 'social-links',		// Adding custom nav id
		'menu_class'		=> 'menu',				// Adding custom nav class
		'theme_location'	=> 'social-links',		// Where it's located in the theme
		'depth'				=> 0,					// Limit the depth of the nav
		'fallback_cb'		=> ''					// Fallback function
	));
} /* End Social Links Menu */

// The Header Menu
function trailhead_header_secondary_nav() {
	wp_nav_menu(array(
		'container'			=> false,						// Remove nav container
		'menu_id'			=> 'header-secondary-nav',					// Adding custom nav id
		'menu_class'		=> 'horizontal menu',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location'	=> 'header-nav',					// Where it's located in the theme
		'depth'				=> 1,							// Limit the depth of the nav
		'fallback_cb'		=> false,						// Fallback function (see below)
	));
}

// The Header Menu
function trailhead_header_nav() {
	wp_nav_menu(array(
		'container'			=> false,						// Remove nav container
		'menu_id'			=> 'header-nav',					// Adding custom nav id
		'menu_class'		=> 'horizontal menu dropdown',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-dropdown-menu data-submenu-toggle="true" data-hover-delay="200" data-closing-time="200">%3$s</ul>',
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
		'container'			=> false,							// Remove nav container
		'menu_id'			=> 'offcanvas-nav',					// Adding custom nav id
		'menu_class'		=> 'vertical menu drilldown',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-drilldown>%3$s</ul>',
		'theme_location'	=> 'offcanvas-nav',					// Where it's located in the theme
		'depth'				=> 5,								// Limit the depth of the nav
		'fallback_cb'		=> false,							// Fallback function (see below)
		'walker'			=> new Off_Canvas_Menu_Walker(),
	));
}

class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = Array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\">\n";
	}
}

// The Off Canvas Utility Menu
function trailhead_off_canvas_supplemental_nav() {
	wp_nav_menu(array(
		'container'			=> false,							// Remove nav container
		'menu_id'			=> 'offcanvas-secondary-nav',					// Adding custom nav id
		'menu_class'		=> 'menu accordion-menu',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
		'theme_location'	=> 'offcanvas-supplemental-nav',					// Where it's located in the theme
		'depth'				=> 5,								// Limit the depth of the nav
		'fallback_cb'		=> false,							// Fallback function (see below)
		'walker'			=> new Off_Canvas_Secondary_Menu_Walker()
	));
}

// The Footer Menu
function trailhead_footer_nav() {
	wp_nav_menu(array(
		'container'			=> false,							// Remove nav container
		'menu_id'			=> 'footer-nav',					// Adding custom nav id
		'menu_class'		=> 'menu',	// Adding custom nav class
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
				$icon = get_field('icon', $item);
				$size = 'full';						
				// append icon
				if( $icon ) {
					
					$item->title = '<span class="icon" aria-hidden="true"><img class="style-svg" src="' . $icon['url'] . '" alt="' . $icon['alt'] . '"></span><span class="show-for-sr"' . $item->title . '</span>';
					
				}
				
			}
			
			// return
			return $items;		

		} else {			
			// loop
			foreach( $items as &$item ) {}
			return $items;	
		}
		
	}
	
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);