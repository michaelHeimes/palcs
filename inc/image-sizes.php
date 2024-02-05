<?php
function add_custom_sizes() {
	// Team Photos
	add_image_size( 'post-card', 886, 1046, true );
}
add_action('after_setup_theme','add_custom_sizes');