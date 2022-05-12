<?php
/**
 * Displays the search form.
 *
 * @return form html
 */
function display_search_form() {

	$form = file_get_contents( 'search-form.html', true );

	if ( ! is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		$name = '_wpnonce';

		$action = 'ilg_vendor_product_search_verify';

		$nonce = '<input type="hidden" id="_wpnonce_search" name="' . $name . '" value="' . wp_create_nonce( $action ) . '" />';

		$nonce .= '<input type="hidden" name="_wp_http_referer" value="' . esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ) ) . '" />';

		$form = str_replace( 'NONCE_FIELD_PH', $nonce, $form );

	}

	if ( current_user_can( 'edit_dashboard' ) ) {
		$form = str_replace(
			'view_all',
			'<button  id="view_all"  style="width:150% ;" class="btn btn-success" type="button">
			View All
		</button>',
			$form
		);

	} else {
		$form = str_replace(
			'view_all',
			'',
			$form
		);
	}

	return $form;

}
