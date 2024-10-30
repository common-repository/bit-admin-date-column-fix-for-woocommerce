<?php

/**
 * @wordpress-plugin
 * Plugin Name:       BIT Admin Date Column fix for WooCommerce
 * Plugin URI:        http://www.blackicetrading.com/plugin-bit-wc-date-column-fix
 * Description:       Adds the full time and date to the date column for those that find the '1 hour ago' stupid.
 * Version:           1.2.0
 * Author:            Dan
 * Author URI:        http://www.blackicetrading.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bit_wc_admin-date-column
 * WC requires at least: 6.0.0
 * WC tested up to:   7.5.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
        die;
}

if ( ! class_exists( 'BIT_WC_Admin_Date_Column' ) ) {
 class BIT_WC_Admin_Date_Column {

    public function __construct() {

    }

    public function init() {
        register_activation_hook( __FILE__, array( $this, 'plugin_activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'plugin_deactivate' ) );

	add_action( 'manage_shop_order_posts_custom_column', array( $this, 'add_timedate_to_column' ), 20, 2 );
    }

    /**
     * The code that runs during plugin activation.
     */
    public function plugin_activate() {
        if ( !class_exists( 'WooCommerce' ) ) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            wp_die( __( 'Please install and Activate WooCommerce.', 'woocommerce-addon-slug' ), 'Plugin dependency check', array( 'back_link' => true ) );
        }
    }

    /**
     * The code that runs during plugin deactivation.
     */
    public function plugin_deactivate() {

    }

   /**
    * Add Time & Date to the date column on orders less than 1 day old.
    */
   public function add_timedate_to_column( $column, $order_id ) {
	if ( $column == 'order_date' ) {
		$order = wc_get_order( $order_id );
		if( ! is_wp_error( $order ) ) {
			$order_timestamp = $order->get_date_created() ? $order->get_date_created()->getTimestamp() : '';
			// Check if the order was created within the last 24 hours, and not in the future.
			if ( $order_timestamp > strtotime( '-1 day', time() ) && $order_timestamp <= time() ) {
				echo ", " . $order->get_date_created()->format ('H:i jS F Y'); // pass any PHP date format
			}
		}
	}
   }

 }
 $GLOBALS['BIT_WC_Admin_Date_Column'] = new BIT_WC_Admin_Date_Column();
 $GLOBALS['BIT_WC_Admin_Date_Column']->init();
}
