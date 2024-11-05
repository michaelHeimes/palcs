<?php
// Function to generate the button link shortcode
function custom_button_link_shortcode($atts) {
	// Extract shortcode attributes
	$atts = shortcode_atts(
		array(
			'link' => '',
			'text' => '',
			'target' => '',
		),
		$atts
	);
	
	$target = '_self';
	
	if( $atts['target'] == 'new tab' ) {
		$target = '_blank';
	}

	// Check if both link and text attributes are provided
	if (empty($atts['link']) || empty($atts['text'])) {
		return 'Please provide both link and text attributes.';
	}

	// Generate the HTML for the button link
	$button_link_html = '<div class="shortcode-btn-wrap"><a href="' . esc_url($atts['link']) . '" class="button shortcode-btn purple-ds" target="' . $target . '">' . esc_html($atts['text']) . '</a></div>';

	return $button_link_html;
}

// Register the shortcode
add_shortcode('button_link', 'custom_button_link_shortcode');
