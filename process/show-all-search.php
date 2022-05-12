<?php
/**
 * Shows all data;
 *
 * @return void
 */
function show_all_search() {

	$output['status'] = 0;

	check_ajax_referer( 'ilg_vendor_product_search_verify' );

	if ( ! current_user_can( 'edit_dashboard' ) ) {
		wp_send_json( $output );
	}

	$search_type = sanitize_text_field( wp_unslash( $_GET['search_type'] ) );

	global $wpdb;

	if ( 'Vendor' === $search_type ) {
		$table_name = $wpdb->prefix . 'ilg_vendor_info';
		$results    = $wpdb->get_results( "SELECT * FROM $table_name" );

		$result_html = vendor_table_html( $results );

		wp_send_json( $result_html );
	}

	if ( 'Product' === $search_type ) {
		$table_name = $wpdb->prefix . 'ilg_product_info';
		$result     = $wpdb->get_results( "SELECT * FROM $table_name" );

		$result_html = product_table_html( $result );

		wp_send_json( $result_html );

	}

	wp_send_json( $output );
}
