<?php
/**
 * Processes the Vendor Form
 */

function send_ilg_vendor_form() {

	$output = array( 'status' => 0 );

	check_ajax_referer( 'vendor_form_verify' );

	if ( ! isset( $_POST['business_name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['site'], $_POST['fein'], $_POST['driver_license'], $_POST['sbr'], $_POST['built_type'] ) ) {
		wp_send_json( $output );
	}

	if ( ! is_email( wp_unslash( $_POST['email'] ) ) ) {
		wp_send_json( $output );
	}

	$bn             = sanitize_text_field( wp_unslash( $_POST['business_name'] ) );
	$email          = sanitize_email( wp_unslash( $_POST['email'] ) );
	$phone          = sanitize_text_field( wp_unslash( $_POST['phone'] ) );
	$address        = sanitize_text_field( wp_unslash( $_POST['address'] ) );
	$city           = sanitize_text_field( wp_unslash( $_POST['city'] ) );
	$state          = sanitize_text_field( wp_unslash( $_POST['state'] ) );
	$site           = esc_url_raw( wp_unslash( $_POST['site'] ) );
	$fein           = sanitize_text_field( wp_unslash( $_POST['fein'] ) );
	$driver_license = sanitize_text_field( wp_unslash( $_POST['driver_license'] ) );
	$sbr            = sanitize_text_field( wp_unslash( $_POST['sbr'] ) );
	$built_type     = sanitize_text_field( wp_unslash( $_POST['built_type'] ) );

	$data =
	array(
		'business_name'               => $bn,
		'street_address'              => $address,
		'city_state'                  => $city . '/' . $state,
		'email'                       => $email,
		'phone'                       => $phone,
		'website'                     => $site,
		'built_type'                  => $built_type,
		'fein_ssn'                    => $fein,
		'driver_license'              => $driver_license,
		'state_business_registration' => $sbr,
	);

	global $wpdb;

	$table_name = $wpdb->prefix . 'ilg_vendor_info';

	$result = $wpdb->insert( $table_name, $data );// db call ok.

	if ( false === $result ) {
		wp_send_json( $output );
	}

	$field_name = 'business_name';

	$vendor_query = $wpdb->get_col( $wpdb->prepare( "SELECT {$field_name} from {$table_name}" ) );// db call ok; no-cache ok.

	update_option( 'ilg_vendor_names', $vendor_query );

	$output['status'] = 1;

	wp_send_json( $output );

}
