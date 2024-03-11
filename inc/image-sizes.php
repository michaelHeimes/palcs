<?php
function add_custom_sizes() {
	add_image_size( 'post-card', 848, 1002, true );
	add_image_size( 'recent-post-card', 964, 1146, true );
	add_image_size( 'staff-grid', 724, 724, array( 'center', 'top' ));
}
add_action('after_setup_theme','add_custom_sizes');