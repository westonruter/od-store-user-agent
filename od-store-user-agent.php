<?php
/**
 * Plugin Name: Optimization Detective Store User Agent
 * Plugin URI: https://github.com/westonruter/od-store-user-agent
 * Description: Stores the User Agent with a URL Metric in the Optimization Detective plugin. This is useful for debugging URL Metrics, in particular to understand what device has a given viewport dimensions.
 * Requires at least: 6.5
 * Requires PHP: 7.2
 * Requires Plugins: optimization-detective
 * Version: 0.1.1
 * Author: Weston Ruter
 * Author URI: https://weston.ruter.net/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: optimization-detective-store-user-agent
 * Update URI: https://github.com/westonruter/od-store-user-agent
 * GitHub Plugin URI: https://github.com/westonruter/od-store-user-agent
 *
 * @package OptimizationDetective\StoreUserAgent
 */

namespace OptimizationDetective\StoreUserAgent;

add_filter(
	'od_url_metric_schema_root_additional_properties',
	static function ( array $properties ): array {
		$properties['userAgent'] = array(
			'type'      => 'string',
			'maxLength' => 400, // Most commonly user agent strings are 100-200 chars.
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
