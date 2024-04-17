<?php
//get terms for CPT filter btns
$admin_department_terms = $args['admin_department_terms'] ?? null; 

//Faceting functionality

// Initialize an array to store term objects
$admin_department_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
$post_terms = wp_get_post_terms($post->ID, 'admin-department'); // Replace 'your_taxonomy' with your actual taxonomy name
// Merge the term arrays
$admin_department_terms_check = array_merge($admin_department_terms_check, $post_terms);
}

?>

<?php if($admin_department_terms && !is_wp_error($admin_department_terms)) : foreach($admin_department_terms as $term):
		if( in_array($term, $admin_department_terms_check) ):
	?>
	<div class="cell shrink" data-group="grades">
		<div class="button input-wrap">
			<?='<input name="grade" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
		</div>
	</div>
<?php endif; endforeach; endif;?>
