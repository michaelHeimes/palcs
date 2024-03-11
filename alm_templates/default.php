<?php
$post_type = get_post_type();

if( $post_type == 'teacher-staff' ) {
	
	get_template_part('template-parts/loop', $post_type, 
		array(
		),
	);

} else {
	
	get_template_part( 'template-parts/loop', get_post_type() );

}

?>

