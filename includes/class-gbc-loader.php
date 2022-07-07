<?php
/**
 * Main Loader.
 *
 * @package geolocation_based_catalogue
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'GBC_Loader' ) ) {

	/** Class GBC_Loader. */
	class GBC_Loader {

		/** Constructor. */
		public function __construct() {
			$this->includes();
			add_action( 'admin_enqueue_scripts', array( $this, 'gbc_scripts' ) );
		}

		/** Include Files depend on platform. */
		public function includes() {
			include_once 'class-gbc-settingtab.php';
			include_once 'class-gbc-hide-products.php';
			include_once 'class-gbc-hide-category.php';
		}

		/** Include Scripts. */
		public function gbc_scripts() {
			wp_enqueue_script( 'gbc_scripts', plugin_dir_url( __DIR__ ) . 'assets/js/gbc-scripts.js', array( 'jquery' ), wp_rand() );
			wp_localize_script( 'gbc_scripts', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		}
	}
}

new GBC_Loader();
