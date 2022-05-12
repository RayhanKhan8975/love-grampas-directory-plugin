<?php
/**
 * if uninstall.php is not called by WordPress, die
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

$option_name = 'ilg_vendor_names';

delete_option( $option_name );

// drop a custom database table
global $wpdb;
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}ilg_vendor_info" );// db call ok. no-cache ok.
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}ilg_product_info" );// db call ok. no-cache ok.
