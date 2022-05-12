<?php
/**
 * Process Product data
 *
 * @return void
 */
function send_ilg_product_form() {

	check_ajax_referer( 'ilg_verify_product_form' );

	$output['status'] = 0;

	if ( ! isset( $_POST['product_name'], $_POST['product_type'], $_POST['materials'], $_POST['built_type'], $_POST['sold_by'], $_POST['vendor'], $_POST['brand_name'], $_POST['tags'], $_POST['price_range'] ) ) {
		wp_send_json( $output );
	}

	$product_name = sanitize_text_field( wp_unslash( $_POST['product_name'] ) );
	$product_type = sanitize_text_field( wp_unslash( $_POST['product_type'] ) );
	$materials    = sanitize_text_field( wp_unslash( $_POST['materials'] ) );
	$built_type   = sanitize_text_field( wp_unslash( $_POST['built_type'] ) );
	$sold_by      = sanitize_text_field( wp_unslash( $_POST['sold_by'] ) );
	$vendor       = sanitize_text_field( wp_unslash( $_POST['vendor'] ) );
	$price_range  = sanitize_text_field( wp_unslash( $_POST['price_range'] ) );

	$arr_img_ext = array( 'image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/webp' );

	if ( isset( $_FILES['image_file'] ) ) {
		if ( in_array( $_FILES['image_file']['type'], $arr_img_ext, true ) ) {
			$upload_overrides = array( 'test_form' => false );

			$upload = wp_handle_upload( $_FILES['image_file'], $upload_overrides );

			$image_url = $upload['url'];
		}
	}

	if ( 'undefined' !== $_POST['tags'] ) {

		$tags = sanitize_text_field( wp_unslash( $_POST['tags'] ) );

	} else {
		$tags = '';
	}

	if ( 'undefined' !== $_POST['brand_name'] ) {

		$brand_name = sanitize_text_field( wp_unslash( $_POST['brand_name'] ) );

	} else {
		$brand_name = '';
	}

	global $wpdb;

	$table_name = $wpdb->prefix . 'ilg_product_info';

	$product_data_array = array(
		'product_type'     => $product_type,
		'product_name'     => $product_name,
		'product_material' => $materials,
		'built_type'       => $built_type,
		'sold_type'        => $sold_by,
		'vendor'           => $vendor,
		'tags'             => $tags,
		'brand_name'       => $brand_name,
		'image_url'        => $image_url,
		'price_range'      => $price_range,
	);

	$wpdb->insert( $table_name, $product_data_array );// db call ok.

	$output['status'] = 1;

	wp_send_json( $output );
}
