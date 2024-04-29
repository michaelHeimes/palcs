<?php
$queried_object = get_queried_object() ?? null;

$intro_copy = '';
if ( is_home() ) {
	$posts_page_id = get_option('page_for_posts');
	$intro_copy = get_field('intro_copy', $posts_page_id);
} elseif ( is_archive() && !empty($queried_object->description) ) {
	$intro_copy = $queried_object->description;
} elseif( !empty( get_field('intro_text') ) ) {
	$intro_copy =  get_field('intro_text') ?? null;
}
echo '<header class="grid-intro-text">';
	if( !empty(get_the_content() && !is_home()) && !is_archive() ) {
		the_content();		
	} elseif( !empty($intro_copy) ) {
		echo $intro_copy;
	};
echo '</header>';
?>
