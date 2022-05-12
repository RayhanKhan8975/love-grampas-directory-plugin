<?php

/**
 * @package           ILG
 * @author            Aman Khan
 * @license           GPL-2.0-or-later
 * Plugin Name:       Vendor/Product Directory plugin
 * Plugin URI:        https://github.com/RayhanKhan8975/love-grampas-directory-plugin
 * Description:       The Plugins helps in building a directory of Vendors and products
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Aman Khan
 * Author URI:        https://github.com/RayhanKhan8975
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ILG
 * Domain Path:       /languages
 */

if ( ! function_exists( 'add_action' ) ) {
	esc_html_e( 'Hi there!  I\'m just a plugin, not much I can do when called directly.', 'codeable' );
	exit;
}

// Setup.
DEFINE( 'ILG_PATH', __FILE__ );


// Includes.
require 'includes/activation.php';
require 'front-end/enqueue.php';
require 'shortcodes/vendor-form.php';
require 'process/send-ilg-vendor-form.php';
require 'shortcodes/product-form.php';
require 'process/send-ilg-product-form.php';
require 'shortcodes/search-form.php';
require 'process/vendor-product-search.php';
require 'utilities/product-table-html.php';
require 'utilities/vendor-table-html.php';
require 'process/show-all-search.php';
require 'shortcodes/display-manual-entry.php';
require 'process/manual-entry-material.php';

// Hooks.
register_activation_hook( __FILE__, 'ilg_activate' );
add_action( 'wp_enqueue_scripts', 'ilg_enqueue', 100 );
add_action( 'wp_ajax_send_ilg_vendor_form', 'send_ilg_vendor_form' );
add_action( 'wp_ajax_nopriv_send_ilg_vendor_form', 'send_ilg_vendor_form' );
add_action( 'wp_ajax_send_ilg_product_form', 'send_ilg_product_form' );
add_action( 'wp_ajax_nopriv_send_ilg_product_form', 'send_ilg_product_form' );
add_action( 'wp_ajax_vendor_product_search', 'vendor_product_search' );
add_action( 'wp_ajax_nopriv_vendor_product_search', 'vendor_product_search' );
add_action( 'wp_ajax_show_all_search', 'show_all_search' );
add_action( 'wp_ajax_manual_entry_material', 'manual_entry_material' );
add_action( 'wp_ajax_nopriv_manual_entry_material', 'manual_entry_material' );

// ShortCodes.
add_shortcode( 'display_vendor_form', 'display_vendor_form' );
add_shortcode( 'display_product_form', 'display_product_form' );
add_shortcode( 'display_search_form', 'display_search_form' );
add_shortcode( 'display_manual_entry', 'display_manual_entry' );

