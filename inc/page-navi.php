<?php // Borrowed with love from FoundationPress
	function trailhead_page_navi() {
		global $wp_query;
		$big = 999999999; // This needs to be an unlikely integer
		// For more options and info view the docs for paginate_links()
		// http://codex.wordpress.org/Function_Reference/paginate_links
		$paginate_links = paginate_links( array(
			'base' => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $wp_query->max_num_pages,
			'mid_size' => 5,
			'prev_next' => true,
		    'prev_text' => __( '<svg xmlns="http://www.w3.org/2000/svg" width="9.609" height="15.561" viewBox="0 0 9.609 15.561"><path id="prev" d="M16.371,6,18.2,7.828,12.26,13.781,18.2,19.733l-1.828,1.828L8.59,13.781Z" transform="translate(-8.59 -6)" fill="#0150d4"/></svg>
 Prev', 'trailhead' ),
		    'next_text' => __( 'Next <svg xmlns="http://www.w3.org/2000/svg" width="9.609" height="15.561" viewBox="0 0 9.609 15.561"><path id="prev" d="M10.419,6,8.59,7.828l5.939,5.952L8.59,19.733l1.829,1.828L18.2,13.781Z" transform="translate(-8.59 -6)" fill="#0150d4"/></svg>', 'trailhead' ),
			'type' => 'list',
		) );
		$paginate_links = str_replace( "<ul class='page-numbers'>", "<ul class='pagination'>", $paginate_links );
		$paginate_links = str_replace( '<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links );
		$paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='current'>", $paginate_links );
		$paginate_links = str_replace( '</span>', '</a>', $paginate_links );
		$paginate_links = str_replace( "<li><a href='#'>&hellip;</a></li>", "<li><span class='dots'>&hellip;</span></li>", $paginate_links );
		$paginate_links = preg_replace( '/\s*page-numbers/', '', $paginate_links );
		// Display the pagination if more than one page is found.
		if ( $paginate_links ) {
			echo '<div class="page-navigation">';
			echo $paginate_links;
			echo '</div><!--// end .pagination -->';
		}
	}