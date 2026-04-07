<?php function add_aria_fix_inline_script() {
	?>
	<script>
	window.addEventListener('load', function() {
		var nav = document.getElementById('header-nav');
		if (!nav) return;

		// Remove menubar role from top-level ul
		nav.removeAttribute('role');

		// Remove menu role from all submenu uls
		nav.querySelectorAll('ul.is-dropdown-submenu').forEach(function(el) {
			el.removeAttribute('role');
		});

		// Remove menuitem role from all links
		nav.querySelectorAll('[role="menuitem"]').forEach(function(el) {
			el.removeAttribute('role');
		});

		// Remove role="none" from all list items
		nav.querySelectorAll('[role="none"]').forEach(function(el) {
			el.removeAttribute('role');
		});

		// Fix aria-haspopup="true" to aria-haspopup="menu"
		nav.querySelectorAll('[aria-haspopup="true"]').forEach(function(el) {
			el.setAttribute('aria-haspopup', 'menu');
		});
	});
	</script>
	<?php
}
add_action('wp_footer', 'add_aria_fix_inline_script');