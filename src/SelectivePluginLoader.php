<?php
namespace WPDreams\WPMU;

class SelectivePluginLoader {
	private
		$disable_plugins = array(
			'events' => 'the-events-calendar/the-events-calendar.php',
			'woocommerce' => 'woocommerce/woocommerce.php',
			'elementor' => 'elementor/elementor.php',
			'elementor-pro' => 'elementor-pro/elementor-pro.php',
		),
		$allow_on_pages = array(
			'events' => array('/events/', '/another-events-page/'),
			'woocommerce' => array('/shop/', '/shop-search/'),
			'elementor' => array('wp-json/elementor/', '/my-custom-elementor-page1/'),
			'elementor-pro' => array('wp-json/elementor/', '/my-custom-elementor-page1/'),
		),
		$request_uri;


	function __construct( $disable_plugins, $allow_on_pages ) {
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