<?php /** @noinspection PhpUndefinedFunctionInspection */

namespace WPDreams\WPMU;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SelectivePluginLoader {
	private
		$disable_plugins,
		$allow_on_pages,
		$request_uri;

	function __construct( $disable_plugins, $allow_on_pages ) {
		$this->disable_plugins = $disable_plugins;
		$this->allow_on_pages = $allow_on_pages;
		$this->request_uri = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
		if ( strpos( $this->request_uri, '/wp-admin/' ) === false ) {
			add_filter( 'option_active_plugins', array($this, 'handle'));
		}
	}

	/**
	 * Handles the plugin exclusion
	 *
	 * @param $plugins array Plugins list
	 * @return array
	 */
	function handle( $plugins ) {
		foreach ( $this->allow_on_pages as $pkey => $pages ) {
			foreach ( $pages as $page ) {
				if ( strpos( $this->request_uri, $page ) !== false ) {
					unset($this->disable_plugins[$pkey]);
				}
			}
		}

		foreach ( $this->disable_plugins as $plugin ) {
			$k = array_search( $plugin, $plugins );
			if( false !== $k ){
				unset( $plugins[$k] );
			}
		}
		return $plugins;
	}
}