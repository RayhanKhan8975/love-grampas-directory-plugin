<?php
/**
 * Manual Material Entry
 *
 * @return void
 */
function manual_entry_material() {

	if ( isset( $_POST['manual_entry'] ) ) {

		if ( get_option( 'product_materials' ) === false ) {

			$array = array( 'Wood', 'Metal', 'Fabric', 'Thread', 'Paper', 'Leather', 'Plastic', 'Rubber', 'Digital File', 'Liquid', 'Recycled Materials', 'Other' );

			update_option( 'product_materials', $array );
		}

		$materials = get_option( 'product_materials' );

		$materials[] = sanitize_text_field( wp_unslash( $_POST['manual_entry'] ) );

		$materials = array_values( array_unique( $materials ) );

		update_option( 'product_materials', $materials );

		$material_arrays = get_option( 'product_materials' );

		foreach ( $material_arrays as $material_array ) {
			$product_materials_html .= '<option value="' . $material_array . '">' . $material_array . '</option>';
		}
		$product_materials_html = '<div style="text-align:center;">
		<h4>Material Used</h4>
	</div>
<select class="selectpicker" id="materials" multiple data-live-search="true">
' . $product_materials_html . '
</select>';
		wp_send_json( $product_materials_html );
	}

}
