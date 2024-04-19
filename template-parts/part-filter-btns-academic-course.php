<?php
//get terms for CPT filter btns
$stage_terms = $args['stage_terms'] ?? null; 
$core_elect_terms = $args['core_elect_terms'] ?? null;
$grade_terms = $args['grade_terms'] ?? null;
$specialty_terms = $args['specialty_terms'] ?? null; 

//Faceting functionality

// Initialize an array to store term objects
$stage_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
	$post_terms = wp_get_post_terms($post->ID, 'stage');
	// Merge the term arrays
	$stage_terms_check = array_merge($stage_terms_check, $post_terms);
}

// Initialize an array to store term objects
$core_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
	$post_terms = wp_get_post_terms($post->ID, 'core-elect');
	// Merge the term arrays
	$core_terms_check = array_merge($core_terms_check, $post_terms);
}

// Initialize an array to store term objects
$grade_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
	$post_terms = wp_get_post_terms($post->ID, 'grade');
	// Merge the term arrays
	$grade_terms_check = array_merge($grade_terms_check, $post_terms);
}

// Initialize an array to store term objects
$specialty_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
	$post_terms = wp_get_post_terms($post->ID, 'academic-course-specialty');
	// Merge the term arrays
	$specialty_terms_check = array_merge($specialty_terms_check, $post_terms);
}

?>

<?php if($stage_terms && !is_wp_error($stage_terms)) : foreach($stage_terms as $term):
		if( in_array($term, $stage_terms_check) ):
	?>
	<div class="cell shrink" data-group="schools">
		<div class="button input-wrap">
			<?='<input type="checkbox" name="school" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
		</div>
	</div>
<?php endif; endforeach; endif;?>

<?php if($core_elect_terms && !is_wp_error($core_elect_terms)) : foreach($core_elect_terms as $term):
		if( in_array($term, $core_elect_terms) ):
	?>
	<div class="cell shrink" data-group="core-elects">
		<div class="button input-wrap">
			<?='<input type="checkbox" name="core-elect" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
		</div>
	</div>
<?php endif; endforeach; endif;?>

<?php if($grade_terms && !is_wp_error($grade_terms)) : foreach($grade_terms as $term):
		if( in_array($term, $grade_terms_check) ):
	?>
	<div class="cell shrink" data-group="grades">
		<div class="button input-wrap">
			<?='<input name="grade" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
		</div>
	</div>
<?php endif; endforeach; endif;?>

<?php if($specialty_terms && !is_wp_error($specialty_terms)): foreach($specialty_terms as $term):
		if( in_array($term, $specialty_terms_check) ):
	?>
	<div class="cell shrink" data-group="specialty">
		<div class="button input-wrap">
			<?='<input type="checkbox" name="specialty" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label for="' . $term->slug . '"/>' . $term->name . '</label>';?>
		</div>
	</div>
<?php endif; endforeach; endif;?>