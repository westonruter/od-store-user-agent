<?php
/**
 * Plugin Name: Optimization Detective Store User Agent
 * Plugin URI: https://gist.github.com/westonruter/fade0cc61d351d8013292f815fcbb70d
 * Description: Stores the User Agent with a URL Metric in the Optimization Detective plugin. This is useful for debugging URL Metrics, in particular what the slug was computed from.
 * Requires at least: 6.5
 * Requires PHP: 7.2
 * Requires Plugins: optimization-detective
 * Version: 0.1.0
 * Author: Weston Ruter
 * Author URI: https://weston.ruter.net/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: optimization-detective-store-user-agent
 * Update URI: https://gist.github.com/westonruter/fade0cc61d351d8013292f815fcbb70d
 * Gist Plugin URI: https://gist.github.com/westonruter/fade0cc61d351d8013292f815fcbb70d
 *
 * @package OptimizationDetective\StoreUserAgent
 */

namespace OptimizationDetective\StoreUserAgent;

add_filter(
	'od_url_metric_schema_root_additional_properties',
	static function ( array $properties ): array {
		$properties['userAgent'] = array(
			'type' => 'string',
		);
		return $properties;
	}
);

add_filter(
	'od_extension_module_urls',
	static function ( array $urls ): array {
		$urls[] = plugins_url( 'detect.js', __FILE__ );
		return $urls;
	}
);
