<?php
/**
 * Main Setting Tab.
 *
 * @package geolocation_based_catalogue
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'GBC_Settingtab' ) ) {
	/** Class GBC_Settingtab. */
	class GBC_Settingtab {

		/**  Constructor. */
		public function __construct() {
			add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::GBC_add_settings_tab', 50 );
			add_action( 'woocommerce_settings_tabs_settings_tab_demo', __CLASS__ . '::settings_tab' );
			add_action( 'woocommerce_update_options_settings_tab_demo', __CLASS__ . '::update_settings' );
		}

		/**  Tab Show In Wocommerce Setting.
		 *  *
		 *
		 *  @param array $settings_tabs used to get array.
		 */
		public static function GBC_add_settings_tab( $settings_tabs ) {
			$settings_tabs['settings_tab_demo'] = __( 'Global Setting', 'woocommerce-settings-tab' );
			return $settings_tabs;
		}
		/** Setting Tab . */
		public static function settings_tab() {
			woocommerce_admin_fields( self::get_settings() );
		}
		/**Update Setting . */
		public static function update_settings() {
			woocommerce_update_options( self::get_settings() );
		}
		/** Get Setting . */
		public static function get_settings() {

			$settings = array(
				array(
					'name' => __( 'Geolocation Catalogue', 'woocommerce-settings-tab' ),
					'type' => 'title',
					'desc' => '',
					'id'   => 'gbc_settings_tab_section_title',
				),
				array(
					'name' => __( 'Geo location: ', 'woocommerce-settings-tab' ),
					'type' => 'checkbox',
					'desc' => __( 'Check ME! If you want to enable Geo Location', 'woocommerce-settings-tab' ),
					'id'   => 'gbc_settings_tab_geolocation_checkbox',
				),
				array(
					'title' => __( 'Location Selecter: ', 'woocommerce' ),
					'id'    => 'gbc_settings_tab_countries123',
					'type'  => 'multi_select_countries',
				),
				array(
					'name'     => __( 'Hide Products: ', 'woocommerce-settings-tab' ),
					'id'       => 'gbc_settings_tab_product_dropdown',
					'type'     => 'multiselect',
					'options'  => self::get_products(),
					'desc_tip' => true,
				),
				array(
					'name'     => __( 'Hide Category: ', 'woocommerce-settings-tab' ),
					'id'       => 'gbc_settings_tab_category_dropdown',
					'type'     => 'multiselect',
					'options'  => self::get_categories(),
					'desc_tip' => true,
				),
				array(
					'type' => 'sectionend',
					'id'   => 'gbc_settings_tab_section_end',
				),
			);

			return apply_filters( 'wc_settings_tab_demo_settings', $settings );
		}

		/**
		 * Getting all woocommerce products
		 *
		 * @return array
		 */
		public static function get_products() {
			$wp_products  = wc_get_products(
				array(
					'status' => 'publish',
					'limit'  => -1,
				)
			);
			$showproducts = array();

			if ( ! empty( $wp_products ) ) {
				foreach ( $wp_products as $wp_product ) {
					$showproducts[ $wp_product->get_id() ] = $wp_product->get_title();
				}
			}
			return $showproducts;
		}

		/**
		 * Getting all woocommerce category
		 *
		 * @return array
		 */
		public static function get_categories() {
			$wp_categories = get_categories(
				array(
					'taxonomy' => 'product_cat',
					'limit'    => -1,
				)
			);
			$categories    = array();

			if ( ! empty( $wp_categories ) ) {
				foreach ( $wp_categories as $wp_category ) {
					$categories[ $wp_category->term_id ] = $wp_category->name;
				}
			}
			return $categories;
		}
	}

}

new GBC_Settingtab();

