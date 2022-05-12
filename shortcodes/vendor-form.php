<?php
/**
 * The Shortcode displays the Vendor Form
 */
function display_vendor_form() {

	$form = file_get_contents( 'vendor-form.html', true );

	if ( ! is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		$name = '_wpnonce';

		$action = 'vendor_form_verify';

		$nonce = '<input type="hidden" id="' . $name . '" name="' . $name . '" value="' . wp_create_nonce( $action ) . '" />';

		$nonce .= '<input type="hidden" name="_wp_http_referer" value="' . esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ) ) . '" />';

		$form = str_replace( 'NONCE_FIELD_PH', $nonce, $form );

	}

	return $form;

}
