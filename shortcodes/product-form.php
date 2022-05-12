<?php
/**
 * Displays the Product Form.
 *
 * @return form html
 */
function display_product_form() {

	$form = file_get_contents( 'product-form.html', true );

	if ( ! is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		$name = '_wpnonce';

		$action = 'ilg_verify_product_form';

		$nonce = '<input type="hidden" id="_wpnonce_product" name="' . $name . '" value="' . wp_create_nonce( $action ) . '" />';

		$nonce .= '<input type="hidden" name="_wp_http_referer" value="' . esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ) ) . '" />';

		$form = str_replace( 'NONCE_FIELD_PH', $nonce, $form );

	}
	if ( get_option( 'ilg_vendor_names' ) === false ) {
		update_option( 'ilg_vendor_names', array() );
	}

	$vendor_array = get_option( 'ilg_vendor_names' );

	$vendor_dropdown_html = '<select style="
	width: 100%;" id="vendor" name="vendor">"
	';

	foreach ( $vendor_array as $vendor ) {
		$vendor_dropdown_html .= '<option value="' . $vendor . '">' . $vendor . '</option>';
	}

	$vendor_dropdown_html .= '	
		</select>';

		$form = str_replace( 'vendor_dropdown', $vendor_dropdown_html, $form );

		$product_materials_html = '';

		$material_arrays = get_option( 'product_materials' );

	foreach ( $material_arrays as $material_array ) {
		$product_materials_html .= '<option value="' . $material_array . '">' . $material_array . '</option>';
	}

			$form = str_replace( 'display_material_options', $product_materials_html, $form );

			$form = str_replace( 'display_manual_entry', display_manual_entry(), $form );

	return $form;

}
