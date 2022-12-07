# WordPress Selective Plugin Loader Must Use Plugin
A lightweight must use WordPress Plugin (WPMU) for Selective Plugin loading. This is a very simple and handy tool to improve WordPress
page loading times, by disabling selected plugin programmatically, and only allowing them on specific URLs.

This is **not a regular plugin**, but a WPMU plugin, which means, that it can not be installed via the plugin menu.

## Installation

Copy the `wpmu-selective-plugin-loader` folder to the `/wp-content/mu-plugins/` directory. If the `mu-plugins` directory does not exist,
then **create it first**.

The `mu-plugins` directory automatically loads any PHP files in it, but **not the ones in subdirectories**, so you will need
to load it. For that, create a `load.php` file in your `mu-plugins` directory, and add this:

```PHP
<?php // mu-plugins/load.php
require WPMU_PLUGIN_DIR.'/wpmu-selective-plugin-loader/plugin.php';
```

This will automatically include the plugin every time.

## Configuration

All you need to change is the `plugin.php` file. Open up the `mu-plugins/wpmu-selective-plugin-loader/plugin.php` file
in your favourite editor (or even notepad) and let's get to it.

After the line `//  ONLY EDIT BELOW:` you will find the init class and it accepts two parameters:
  * Plugins to disable by default
  * List of URLs where specific plugins should be enabled. **Parts of URL are also matches!**

### Example 1
You want to disable WooCommerce everywhere, except for the shop page and the product pages.
The shop located on the `/shop/` URL and the product pages have the `/product/` prefix.

```PHP
//  ONLY EDIT BELOW:
new SelectivePluginLoader(
	array(
		'woocommerce' => 'woocommerce/woocommerce.php',				// WooCommerce
	),
	array(
		'woocommerce' => array('/shop/', '/product/'),
	)
);
```

### Example 2
On top of WooCommerce, you also want to allow **The Events Calendar** on the `/events/` URL and on the individual event
pages, which use the `/event/` prefix.

```PHP
//  ONLY EDIT BELOW:
new SelectivePluginLoader(
	array(
		'events' => 'the-events-calendar/the-events-calendar.php',	// The Events Calendar
		'woocommerce' => 'woocommerce/woocommerce.php',				// WooCommerce
	),
	array(
		'events' => array('/events/', '/another-events-page/'),
		'woocommerce' => array('/shop/', '/product/'),
	)
);
```

