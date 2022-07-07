<?php
/**
 * Hide Product Template.
 *
 * @package geolocation_based_catalogue
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( ' GBC_Hide_Products' ) ) {
	/** Class  GBC_Hide_Products. */
	class  GBC_Hide_Products {

		/**  Constructor. */
		public function __construct() {
			add_action( 'woocommerce_product_query', array( $this, 'hide_product_in_country' ), 9999, 2 );
		}

		/** Hide Product Function.
		 *
		 *  @param array $q used to set values.
		 *  @param array $query used to set query.
		 */
		public function hide_product_in_country( $q, $query ) {
			if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
				$real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
			}

			if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
				$real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$real_ip_adress = $_SERVER['REMOTE_ADDR'];
			}

			/** Change IP to location. */
			$cip             = '156.146.59.30';
			$iptolocation    = 'http://api.hostip.info/country.php?ip=' . $cip;
			$creatorlocation = wp_remote_get( $iptolocation );

			/** Get Products Value. */
			$hide_products    = get_option( 'gbc_settings_tab_product_dropdown' );
			$selected_product = array();
			foreach ( $hide_products as $key => $xvalue ) {
				array_push( $selected_product, $xvalue );
			}

			/** Get Country. */
			$hide_country     = get_option( 'gbc_settings_tab_countries' );
			$selected_country = array();
			foreach ( $hide_country as $key => $xvalue ) {
				array_push( $selected_country, $xvalue );
			}

			/** Hide Selected Product Based on Selected Location. */
			foreach ( $selected_country as $yvalue ) {
				if ( $creatorlocation === $yvalue ) {
					$q->set( 'post__not_in', $selected_product );
				}
			}
		}
	}
}
new GBC_Hide_Products();

