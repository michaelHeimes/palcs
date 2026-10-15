<?php

/**
 * iubenda Cookie Solution + privacy & accessibility pill (pmi-iubenda-widget plugin).
 *
 * PALCS_IUBENDA_EMBED is the site's embed script URL from iubenda
 * (https://embeds.iubenda.com/widgets/<id>.js; iubenda site ID 4698673) and
 * PALCS_IUBENDA_POLICY_ID its privacy policy ID, used for the footer's Cookie
 * Policy link (policy 73020016).
 *
 * Until the embed is set, the pill's tracker blocking stays off: blocking switches
 * tracking scripts (GTM, GA, AdRoll) to type="text/plain" for iubenda to run, so
 * without iubenda on the page they would never run at all.
 */
define( 'PALCS_IUBENDA_EMBED', 'https://embeds.iubenda.com/widgets/81d90c65-782d-4487-8c9c-1ba02a8264eb.js' );
define( 'PALCS_IUBENDA_POLICY_ID', '73020016' );

add_action( 'wp_head', 'palcs_iubenda_embed', 1 );
function palcs_iubenda_embed() {
	if ( PALCS_IUBENDA_EMBED ) {
		// iubenda stores consent on the parent domain. Host temp domains
		// (palcs.wpenginepowered.com, *.kinsta.cloud) sit under a public suffix,
		// where browsers reject that cookie and no choice is ever saved, so pin it
		// to the site's own host there. The embed keeps a preset csConfiguration.
		$host = wp_parse_url( home_url(), PHP_URL_HOST );
		if ( preg_match( '/\.(wpenginepowered\.com|kinsta\.cloud)$/', $host ) ) {
			printf( '<script>var _iub = window._iub = window._iub || []; _iub.csConfiguration = { localConsentDomain: %s, localConsentDomainExact: true };</script>' . "\n", wp_json_encode( $host ) );
		}
		printf( '<script type="text/javascript" src="%s"></script>' . "\n", esc_url( PALCS_IUBENDA_EMBED ) );
	}
}

// iubenda.js turns the footer's .iubenda-embed Cookie Policy link into a popup;
// without it the link just navigates to iubenda.com.
add_action( 'wp_enqueue_scripts', 'palcs_iubenda_policy_script' );
function palcs_iubenda_policy_script() {
	if ( PALCS_IUBENDA_POLICY_ID ) {
		wp_enqueue_script( 'iubenda-policy', 'https://cdn.iubenda.com/iubenda.js', array(), null, array( 'in_footer' => true, 'strategy' => 'async' ) );
	}
}

add_filter( 'pmi_iubenda_widget_args', 'palcs_iubenda_widget_args' );
function palcs_iubenda_widget_args( $args ) {
	// No iubenda branding: drops the colored tab and its iubenda mark, leaving just
	// the white buttons.
	$args['brand'] = false;
	// Keyboard focus ring in the PALCS blue (6.4:1 against the white halo).
	$args['focus_color'] = '#0052d4';
	$args['blocking']    = (bool) PALCS_IUBENDA_EMBED;
	return $args;
}

// Vimeo's GA4 extension sends video plays to Google Analytics, so it's held back
// on a sale opt-out like the rest of analytics.
add_filter( 'pmi_iubenda_blocking_vendors', 'palcs_iubenda_blocking_vendors' );
function palcs_iubenda_blocking_vendors( $vendors ) {
	$vendors['extend.vimeocdn.com'] = 's';
	return $vendors;
}
