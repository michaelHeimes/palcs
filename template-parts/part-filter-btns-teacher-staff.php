<?php
//get terms for CPT filter btns
$grade_terms = $args['grade_terms'] ?? null; 
$enrichment_terms = $args['enrichment_terms'] ?? null; 
$department_1s = $args['department_1s'] ?? null; 
$department_2s = $args['department_2s'] ?? null; 

//Faceting functionality

// Initialize an array to store term objects
$grade_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
$post_terms = wp_get_post_terms($post->ID, 'grade'); // Replace 'your_taxonomy' with your actual taxonomy name
// Merge the term arrays
$grade_terms_check = array_merge($grade_terms_check, $post_terms);
}

// Initialize an array to store term objects
$enrichment_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
$post_terms = wp_get_post_terms($post->ID, 'enrichment'); // Replace 'your_taxonomy' with your actual taxonomy name
// Merge the term arrays
$enrichment_terms_check = array_merge($enrichment_terms_check, $post_terms);
}


// Initialize an array to store term objects
$department_1s_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
$post_terms = wp_get_post_terms($post->ID, 'department-1'); // Replace 'your_taxonomy' with your actual taxonomy name
// Merge the term arrays
$department_1s_check = array_merge($department_1s_check, $post_terms);
}


// Initialize an array to store term objects
$department_2s_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
$post_terms = wp_get_post_terms($post->ID, 'department-2'); // Replace 'your_taxonomy' with your actual taxonomy name
// Merge the term arrays
$department_2s_check = array_merge($department_2s_check, $post_terms);
}

?>

<?php if($grade_terms && !is_wp_error($grade_terms)) : foreach($grade_terms as $term):
		if( in_array($term, $grade_terms_check) ):
	?>
	<div class="cell shrink" data-group="grades">
		<div class="button input-wrap">
			<?='<input name="grade" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
		</div>
	</div>
<?php endif; endforeach; endif;?>
<?php if($enrichment_terms && !is_wp_error($enrichment_terms)): foreach($enrichment_terms as $term):
		if( in_array($term, $enrichment_terms_check) ):
	?>
	<div class="cell shrink" data-group="enrichments">
		<div class="button input-wrap">
			<?='<input name="enrichment" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
		</div>
	</div>
<?php endif; endforeach; endif;?>
<?php if($department_1s && !is_wp_error($department_1s)): foreach($department_1s as $term):
		if( in_array($term, $department_1s_check) ):
	?>
	<div class="cell shrink" data-group="department-1">
		<div class="button input-wrap">
			<?='<input name="department-1" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
		</div>
	</div>
<?php endif; endforeach; endif;?>
<?php if($department_2s && !is_wp_error($department_2s)): foreach($department_2s as $term):
		if( in_array($term, $department_2s_check) ):
	?>
	<div class="cell shrink" data-group="department-2">
		<div class="button input-wrap">
			<?='<input name="department-2" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
		</div>
	</div>
<?php endif; endforeach; endif;?>