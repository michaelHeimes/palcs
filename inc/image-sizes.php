<?php
function add_custom_sizes() {
	add_image_size( 'full-width-banner-image', 2560, 738, true );
	add_image_size( 'post-card', 856, 1002, true ); // post, explore cards
	add_image_size( 'event-card', 848, 656, true ); // event cards
	add_image_size( 'recent-post-card', 958, 1139, true ); // post cards with tag tag
	add_image_size( 'staff-grid', 724, 724, array( 'center', 'top' ));
	add_image_size( 'circle-thumb', 580, 580, true);
	add_image_size( 'event-thumb', 580, 446, true);
	add_image_size( 'video-grid-thumb', 586, 440, true);
}
add_action('after_setup_theme','add_custom_sizes');