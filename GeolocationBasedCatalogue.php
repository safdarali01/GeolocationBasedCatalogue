<?php
/**
 * Plugin Name: GeolocationBasedCatalogue
 * Description: Made for Safdar Ali.
 * Version: 1.1.1.0
 * Author: Safdar
 * Author URI: https://muhammadsafdarali.com/
 * Text Domain: geolocation-based-catalogue
 *
 * @package geolocation_based_catalogue
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'GBC_PLUGIN_DIR' ) ) {
	define( 'GBC_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'GBC_PLUGIN_DIR_URL' ) ) {
	define( 'GBC_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'GBC_ABSPATH' ) ) {
	define( 'GBC_ABSPATH', dirname( __FILE__ ) );
}
require GBC_PLUGIN_DIR . '/includes/class-gbc-loader.php';


