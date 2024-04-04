<?php
if (!wp_next_scheduled('expire_posts')){
  wp_schedule_event(time(), 'hourly', 'expire_posts'); // this can be hourly, twicedaily, or daily
}

add_action('expire_posts', 'expire_posts_function');

// Determine Expired Posts by date field called 'event_post_expiration'

// function expire_posts_function() {
// 	$today = date('Ymd');
// 	$args = array(
// 		'post_type' => array('event'), // post types you want to check
// 		'posts_per_page' => -1,
// 		'orderby' => 'meta_value',
// 		'meta_query' => array(
// 			array(
// 				'key' => 'event_post_expiration',
// 				'value' => $today,
// 				'compare' => '<',
// 			),
// 		),
// 	);
// 	$posts = get_posts($args);
// 	foreach($posts as $p){
// 		$expiredate = date( 'Ymd', strtotime( get_field( 'event_post_expiration', $p->ID ) ) ); // get the raw date from the db
// 		if ($expiredate) {
// 			if($expiredate < $today){
// 				$postdata = array(
// 					'ID' => $p->ID,
// 					'post_status' => 'draft'
// 				);
// 				wp_update_post($postdata);
// 			}
// 		}
// 	}
// }


// Determine Expired Posts by the date of the last 'day' repeater field

function expire_posts_function() {
	$today = date('Ymd');
	$args = array(
		'post_type' => array('event'), // post types you want to check
		'posts_per_page' => -1,
	);
	$posts = get_posts($args);
	foreach($posts as $p){
		$date = get_field('event_date', $p->ID);
			
		if($date < $today){
			$postdata = array(
				'ID' => $p->ID,
				'post_status' => 'draft'
			);
			wp_update_post($postdata);
		}
	
	}
}