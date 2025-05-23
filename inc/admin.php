<?php
// This file handles the admin area and functions - You can use this file to make changes to the dashboard.

/************* CUSTOMIZE ADMIN *******************/
// Custom Backend Footer
function trailhead_custom_admin_footer() {
// 	_e('<span id="footer-thankyou">Developed by <a href="https://proprdesign.com/" target="_blank">Propr Design</a></span>.', 'trailhead');
}

// adding it to the admin area
//add_filter('admin_footer_text', 'trailhead_custom_admin_footer');

/* WP Editor
 */

// Don't remove additional line breaks in editor
// http://tinymce.moxiecode.com/wiki.php/Configuration
function custom_tinymce_config( $init ) {
	$init['remove_linebreaks'] = false; 
	return $init;
}
add_filter('tiny_mce_before_init', 'custom_tinymce_config');

function dg_tiny_mce_remove_h1( $in ) {
        $in['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6;Preformatted=pre";
    return $in;
}
//add_filter( 'tiny_mce_before_init', 'dg_tiny_mce_remove_h1' );
	
	
/**
 * Disable Editor
 *
 * @package      ClientName
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Templates and Page IDs without editor
 *
 */
function ea_disable_editor( $id = false ) {

	$excluded_templates = array(
		'page-templates/page-home.php',
		'page-templates/page-teachers-staff.php',
		'page-templates/page-administration.php',

	);

	$excluded_ids = array(
		//This is because we need an ACF field due to inability to use the_content() 
		get_option( 'page_for_posts' )
	);

	if( empty( $id ) )
		return false;

	$id = intval( $id );
	$template = get_page_template_slug( $id );

	return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

/**
 * Disable Gutenberg by template
 *
 */
function ea_disable_gutenberg( $can_edit, $post_type ) {

	if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
		return $can_edit;

	if( ea_disable_editor( $_GET['post'] ) )
		$can_edit = false;

	return $can_edit;

}
add_filter( 'gutenberg_can_edit_post_type', 'ea_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'ea_disable_gutenberg', 10, 2 );

/**
 * Disable Classic Editor by template
 *
 */
function ea_disable_classic_editor() {

	$screen = get_current_screen();
	if( 'page' !== $screen->id || ! isset( $_GET['post']) )
		return;

	if( ea_disable_editor( $_GET['post'] ) ) {
		remove_post_type_support( 'page', 'editor' );
	}

}
add_action( 'admin_head', 'ea_disable_classic_editor' );


/**
* Misc edits to the Wordpress Admin
*/

// Remove useless dashboard widgets
function remove_dashboard_widgets() {
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
	remove_meta_box('dashboard_primary', 'dashboard', 'normal');
	remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
}
add_action('admin_init', 'remove_dashboard_widgets');


// add styleselect to editor
function add_styleselect($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
//add_filter('mce_buttons_2', 'add_styleselect');


// add default styles to styleselect
function add_styleselect_classes( $init_array ) {  
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
        array(  
            'title' => 'Large Blue Text',  
            'block' => 'span',  
            'classes' => 'large-blue-text',
            'wrapper' => true,
        ),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
} 
//add_filter( 'tiny_mce_before_init', 'add_styleselect_classes' ); 


// add editor-style.css
function theme_editor_style() {
	add_editor_style( get_template_directory_uri() . '/assets/styles/style.min.css' );
}
//add_action('init', 'theme_editor_style');


// remove revisions meta box and recreate on right side for all post types
function relocate_revisions_metabox() {
	$args = array(
	'public'   => true,
	'_builtin' => false
	); 
	$output = 'names'; // names or objects
	$post_types = get_post_types($args,$output); 
	foreach ($post_types  as $post_type) {
		remove_meta_box('revisionsdiv',$post_type,'normal'); 
		add_meta_box('revisionssidediv2', __('Revisions'), 'post_revisions_meta_box', $post_type, 'side', 'low');
	}
	
	// page 
	remove_meta_box('revisionsdiv','page','normal'); 
	add_meta_box('revisionssidediv2', __('Revisions'), 'post_revisions_meta_box', 'page', 'side', 'low');
	
	// post 
	remove_meta_box('revisionsdiv','post','normal'); 
	add_meta_box('revisionssidediv2', __('Revisions'), 'post_revisions_meta_box', 'post', 'side', 'low');
	
}
//add_action('do_meta_boxes','relocate_revisions_metabox', 30);


// Hide taxonomy Description field
add_action('admin_head', 'my_admin_area_custom_css');

function my_admin_area_custom_css() {
	echo '<style>
		body:not(.taxonomy-category):not(.taxonomy-event-category):not(.taxonomy-club-category) tr.form-field.term-description-wrap {
			display:none;
		}
  </style>';
}



// Add custom column header
function custom_sticky_column($columns) {
	$columns['is_sticky'] = 'Sticky';
	return $columns;
}
add_filter('manage_posts_columns', 'custom_sticky_column');

// Display sticky status in the custom column
function custom_sticky_column_content($column, $post_id) {
	if ($column == 'is_sticky') {
		$is_sticky = is_sticky($post_id);
		echo $is_sticky ? 'Yes' : 'No';
	}
}
//add_action('manage_posts_custom_column', 'custom_sticky_column_content', 10, 2);



// Add custom admin column for event_date
function custom_event_columns($columns) {
	$columns['event_date'] = 'Event Date';
	return $columns;
}
add_filter('manage_event_posts_columns', 'custom_event_columns');

// Display event_date in custom admin column with format m/d/Y
function custom_event_column_content($column, $post_id) {
	if ($column == 'event_date') {
		$event_date = get_field('event_date', $post_id); // Replace 'event_date' with your ACF field name
		if ($event_date) {
			$formatted_date = date('m/d/Y', strtotime($event_date));
			echo $formatted_date;
		}
	}
}
add_action('manage_event_posts_custom_column', 'custom_event_column_content', 10, 2);


// Add custom column to the 'video' post type admin view
function custom_video_columns($columns) {
	// Add a new column with the key 'video_thumbnail' and the label 'Thumbnail'
	$columns['video_thumbnail'] = 'Thumbnail';
	return $columns;
}
add_filter('manage_video_posts_columns', 'custom_video_columns');

// Populate the custom column with data
function custom_video_column_content($column_name, $post_id) {
	// Check if the current column is 'video_thumbnail'
	if ($column_name === 'video_thumbnail') {
		// Retrieve the image URL from the custom field 'video_thumbnail'
		$thumbnail_url = get_post_meta($post_id, 'video_thumbnail', true);

		// Check if the thumbnail URL is not empty
		if (!empty($thumbnail_url)) {
			// Output the thumbnail image using the WordPress function wp_get_attachment_image()
			echo wp_get_attachment_image($thumbnail_url, array(50, 50), true);
		} else {
			// Output a message if no thumbnail is available
			echo 'No thumbnail';
		}
	}
}
add_action('manage_video_posts_custom_column', 'custom_video_column_content', 10, 2);


// Add custom column to display featured image
function custom_featured_image_column($columns) {
	// Add a new column with key 'featured_image' and title 'Featured Image'
	$columns['featured_image'] = 'Featured Image';
	return $columns;
}
add_filter('manage_posts_columns', 'custom_featured_image_column');

// Display featured image in custom column
function custom_display_featured_image_column($column, $post_id) {
	// Check if column is 'featured_image'
	if ($column === 'featured_image') {
		// Get the post's featured image
		$thumbnail = get_the_post_thumbnail($post_id, array(50, 50), true);
		// Output the thumbnail
		echo $thumbnail ? $thumbnail : 'N/A';
	}
}
add_action('manage_posts_custom_column', 'custom_display_featured_image_column', 10, 2);


// Change post object field for Latest Posts to order by post date
function custom_acf_post_object_order_by_date($args, $field, $post_id) {
	$fields_to_filter = ['school-wide_post', 'elementary_post', 'middle_school_post', 'high_school_post', 'activities_post', 'enrichment_post']; 
	if (in_array($field['name'], $fields_to_filter)) {
		$args['orderby'] = 'date';
		$args['order'] = 'DESC';
	}
	return $args;
}
add_filter('acf/fields/post_object/query', 'custom_acf_post_object_order_by_date', 10, 3);

