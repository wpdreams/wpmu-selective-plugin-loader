<?php
namespace WPDreams\WPMU;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once "src/SelectivePluginLoader.php";

//  ONLY EDIT BELOW:
new SelectivePluginLoader(
	/**
	 * Step 1.
	 * This is the list of plugins you want to disable by default, and on step 2. the exceptions are configured.
	 *
	 * As you can see, each line represents one plugin "label" => "plugin_dir/plugin_file.php" format.
	 * You can choose any unique label, but the plugin file must be accurate. Here are some examples:
	 */
	array(
		'events' => 'the-events-calendar/the-events-calendar.php',	// The Events Calendar
		'woocommerce' => 'woocommerce/woocommerce.php',				// WooCommerce
		'elementor' => 'elementor/elementor.php',					// Elementor
		'elementor-pro' => 'elementor-pro/elementor-pro.php',		// Elementor Pro
	),

	/**
	 * Step 2.
	 *
	 * Now, use the simplified labels to allow plugins on specified URLs. Use each label only once,
	 * you can define as many URLs (even partially) as you need for each plugin label.
	 * Format: 'plugin_label' => array('/page-url/', '/another-page-url/' ...)
	 *
	 * WARNING: Partial matches also count! If the URL CONTAINS the string, then it matches, and the plugin
	 * 			will be loaded. So "/product/" will also apply for "/product/my-product-1" and "/product/my-product-1"...
	 */
	array(
		'events' => array('/events/', '/another-events-page/'),
		'woocommerce' => array('/shop/', '/shop-search/'),
		'elementor' => array('wp-json/elementor/', '/my-custom-elementor-page1/'),
		'elementor-pro' => array('wp-json/elementor/', '/my-custom-elementor-page1/'),
	)
);