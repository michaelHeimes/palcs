<?php
function add_custom_sizes() {
	add_image_size( 'full-width-banner-image', 2560, 738, true );
	add_image_size( 'post-card', 856, 1002, true ); // post, explore cards
	add_image_size( 'recent-post-card', 958, 1139, true ); // post cards with tag tag
	add_image_size( 'staff-grid', 724, 724, array( 'center', 'top' ));
}
add_action('after_setup_theme','add_custom_sizes');