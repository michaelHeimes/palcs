<?php

 // Teacher and Admin Redirects
 add_filter('request', function($query) {
 
	 $uri = $_SERVER['REQUEST_URI'] ?? '';
 
	 // --- Redirect any /administration/* URL ---
	 if (strpos($uri, '/administration/') === 0 && $uri !== '/administration/') {
		 wp_redirect('https://palcs.org/about-us/administration/', 301);
		 exit;
	 }
 
	 // --- Redirect any /teachers-staff/* URL ---
	 if (strpos($uri, '/teachers-staff/') === 0 && $uri !== '/teachers-staff/') {
		 wp_redirect('https://palcs.org/about-us/teachers-staff/', 301);
		 exit;
	 }
 
	 return $query;
 });