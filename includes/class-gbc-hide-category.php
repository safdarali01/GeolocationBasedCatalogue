<?php 

if (! defined( 'ABSPATH' )) 
{
	exit;
}
if (! class_exists( 'GBC_hide_category')) 
{
    /** Class GBC_hide_category. */

    class GBC_hide_category
    {
        /**  Constructor. */

        public function __construct() 
        {
            add_action( 'woocommerce_product_query', array($this, 'hide_category_in_country'), 9999, 2 );
            // add_filter( 'pre_get_posts',  array($this,'custom_pre_get_posts_query' ));
        }

        /** Hide Product Function. */

        public function hide_category_in_country( $q, $query ) 
        {
            if (isset($_SERVER['HTTP_CLIENT_IP']))
            {
                $real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
            }
            if (isset($_SERVER['HTTP_X_FOhide_productsRWARDED_FOR']))
            {
                $real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else
            {
                $real_ip_adress = $_SERVER['REMOTE_ADDR'];
            }

            /** Change IP to location. */

            $cip = "156.146.59.30";
            $iptolocation = 'http://api.hostip.info/country.php?ip=' . $cip;
            $creatorlocation = file_get_contents($iptolocation);
            
            
            /** Get Category. */
            $hide_category = get_option('gbc_settings_tab_category_dropdown');
            $selected_category = array();
            foreach ($hide_category as $key => $xvalue) 
            {
                array_push( $selected_category, $xvalue ); 
            }

            /** Get Country. */
            $hide_country = get_option("gbc_settings_tab_countries");
            $selected_country = array();
            foreach ($hide_country as $key => $xvalue) 
            {
                array_push( $selected_country, $xvalue ); 
            }
        
            /** Hide Selected Category Based on Selected Location. */
            foreach ($selected_country as $yvalue) 
            {
                if ( $creatorlocation === $yvalue ) 
                {
                    if( is_shop()  || is_page('product') )
                    {
                        $tax_query = (array) $q -> get( 'tax_query' );
        
                        $tax_query[] = array(
                            'taxonomy' => 'product_cat',
                            'field' => 'term_id ',
                            'terms' => $selected_category,
                            'operator' => 'NOT IN'
                        );
                        $q -> set('tax_query', $tax_query);
                    }
                }
            }
        }
    }
}

new GBC_hide_category();
?>