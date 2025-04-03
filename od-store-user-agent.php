<?php
/**
 * Plugin Name: Optimization Detective Store User Agent
 * Plugin URI: https://github.com/westonruter/od-store-user-agent
 * Description: Stores the User Agent with a URL Metric in the Optimization Detective plugin. This is useful for debugging URL Metrics, in particular to understand what device has a given viewport dimensions.
 * Requires at least: 6.5
 * Requires PHP: 7.2
 * Requires Plugins: optimization-detective
 * Version: 0.2.0
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

const VERSION = '0.2.0';

add_action(
	'od_init',
	static function ( string $optimization_detective_version ): void {
		$required_od_version = '1.0.0-beta4';
		if ( ! version_compare( $optimization_detective_version, $required_od_version, '>=' ) ) {
			add_action(
				'admin_notices',
				static function (): void {
					global $pagenow;
					if ( ! in_array( $pagenow, array( 'index.php', 'plugins.php' ), true ) ) {
						return;
					}
					wp_admin_notice(
						esc_html(
							sprintf(
								/* translators: %s is plugin name */
								__( 'The %s plugin requires a newer version of the Optimization Detective plugin. Please update your plugins.', 'od-store-user-agent' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch
								plugin_basename( __FILE__ )
							)
						),
						array( 'type' => 'warning' )
					);
				}
			);
			return;
		}

		add_filter( 'od_url_metric_schema_root_additional_properties', __NAMESPACE__ . '\filter_url_metric_schema_root_additional_properties' );
		add_filter( 'od_extension_module_urls', __NAMESPACE__ . '\filter_extension_module_urls' );
	}
);

/**
 * Filters additional root schema properties.
 *
 * @param array<string, array{type: string}> $properties Properties.
 * @return array<string, array{type: string}> Properties.
 */
function filter_url_metric_schema_root_additional_properties( array $properties ): array {
	$properties['userAgent'] = array(
		'type'      => 'string',
		'maxLength' => 400, // Most commonly user agent strings are 100-200 chars.
	);
	return $properties;
}

/**
 * Filters extension URLs.
 *
 * @param string[] $urls Extension URLs.
 * @return string[] Extension URLs.
 */
function filter_extension_module_urls( array $urls ): array {
	$urls[] = plugins_url( add_query_arg( 'ver', VERSION, 'detect.js' ), __FILE__ );
	return $urls;
}
