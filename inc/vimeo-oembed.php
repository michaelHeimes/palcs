<?php

/**
 * Remove the DNT parameter from Vimeo oEmbed requests.
 */
add_filter('oembed_fetch_url', 'remove_vimeo_default_dnt', 10, 3);

function remove_vimeo_default_dnt($provider, $url, $args) {
	if (strpos($provider, 'vimeo.com') !== false) {
		return remove_query_arg('dnt', $provider);
	}

	return $provider;
}