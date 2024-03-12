<?php
$intro_text = '';
if( is_archive() ) {
	$current_category = get_queried_object();
	if ($current_category && function_exists('get_field')) {
		$intro_text = get_field('intro_copy', 'category_' . $current_category->term_id);
	}
	
	
} elseif ( is_home() )  {
	$current_page_id = get_queried_object_id();
	$intro_text = get_field('intro_copy', $current_page_id);	
} else {
	$intro_text = $args['intro_text'];
}
if( !empty($intro_text) ):
?>
<div class="grid-intro-text">
	<?=$intro_text;?>
</div>
<?php endif;?>