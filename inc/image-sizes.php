<?php
function add_custom_sizes() {
	// Team Photos
	add_image_size( 'post-card', 804, 804, true );
}
add_action('after_setup_theme','add_custom_sizes');