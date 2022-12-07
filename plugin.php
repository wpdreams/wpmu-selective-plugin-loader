<?php
namespace WPDreams\WPMU;

require_once "src/SelectivePluginLoader.php";

new SelectivePluginLoader(
	// Disable all of these plugins
	array(
		'events' => 'the-events-calendar/the-events-calendar.php',
		'woocommerce' => 'woocommerce/woocommerce.php',
		'elementor' => 'elementor/elementor.php',
		'elementor-pro' => 'elementor-pro/elementor-pro.php',
	),
	// ...but allow them on the following pages
	array(
		'events' => array('/events/', '/another-events-page/'),
		'woocommerce' => array('/shop/', '/shop-search/'),
		'elementor' => array('wp-json/elementor/', '/my-custom-elementor-page1/'),
		'elementor-pro' => array('wp-json/elementor/', '/my-custom-elementor-page1/'),
	)
);