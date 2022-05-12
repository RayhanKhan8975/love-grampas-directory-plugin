<?php
/**
 * Processes the Vendor Product Search
 *
 * @return void
 */
function vendor_product_search() {

	$output['status'] = 0;

	check_ajax_referer( 'ilg_vendor_product_search_verify' );
	if ( ! isset( $_GET['search_type'], $_GET['vendor_product_search_query'], $_GET['by_vendor'] ) ) {
		wp_send_json( $output );
	}

	$search_type = sanitize_text_field( wp_unslash( $_GET['search_type'] ) );

	if ( 'Vendor' !== $search_type && 'Product' !== $search_type ) {
		wp_send_json( $output );
	}

	$search_query = sanitize_text_field( wp_unslash( $_GET['vendor_product_search_query'] ) );

	if ( 3 > strlen( $search_query ) && true != $_GET['by_vendor'] ) {
		wp_send_json( $output );
	}

	global $wpdb;

	if ( 'Product' === $search_type ) {
		$table_name = $wpdb->prefix . 'ilg_product_info';

		if ( isset( $_GET['by_vendor'] ) && true === $_GET['by_vendor'] ) {

			$main_query = $wpdb->prepare( "SELECT * FROM $table_name WHERE vendor = %s ", $search_query );

			$result = $wpdb->get_results( $main_query );// db call ok; no-cache ok.

			$result_html = product_table_html( $result );

			wp_send_json( $result_html );
		}
			$wild = '%';

			$like = $wild . $wpdb->esc_like( $search_query ) . $wild;

			$main_query = $wpdb->prepare( "SELECT * FROM  $table_name WHERE product_type LIKE %s OR product_name LIKE %s OR product_material LIKE %s OR vendor LIKE %s or tags LIKE %s or brand_name LIKE %s or built_type LIKE %s or sold_type LIKE %s", $like, $like, $like, $like, $like, $like, $like, $like );

			$result = $wpdb->get_results( $main_query ); // db call ok; no-cache ok.

		if ( is_wp_error( $result ) ) {
			wp_send_json( $output );
		}

			$result_html = product_table_html( $result );

			wp_send_json( $result_html );

	}

	if ( 'Vendor' === $search_type ) {

		$table_name = $wpdb->prefix . 'ilg_vendor_info';

		$main_query = $wpdb->prepare( "SELECT * FROM $table_name WHERE business_name = %s ", $search_query );

		$result = $wpdb->get_results( $main_query );// db call ok; no-cache ok.

		$result_html = vendor_table_html( $result );

		wp_send_json( $result_html );
	}
}
