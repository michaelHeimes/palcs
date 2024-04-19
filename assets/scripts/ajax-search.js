jQuery(document).ready(function($) {
	$('#search-form').submit(function(event) {
		event.preventDefault();

		var keyword = $('#search-input').val();
		
		// Clear previous search results
		$('#search-results').empty();
		
		// Show loading indicator
		$('#search-query').html('Searching...');
		
		$.ajax({
			url: ajax_search_params.ajax_url,
			type: 'GET',
			data: {
				action: 'custom_search',
				search: keyword
			},
			success: function(response) {
				$('#search-query').addClass('has-results');
				$('#search-query').html("Search results for ‘" + response.data.keyword + "’");

				var html = '<ul class="search-results-list no-bullet">';

				if (response.data.results.length > 0) {
					response.data.results.forEach(function(result) {
						html += '<li><h4 class="h3"><a href="' + result.url + '">' + result.title + '</a></h4></li>';
					});
				} else {
					html += '<li><h5>No results found.</h5></li>';
				}

				html += '</ul>';

				$('#search-results').append(html);
			},
			error: function(xhr, status, error) {
				console.error(error);
			}
		});
	});
});

