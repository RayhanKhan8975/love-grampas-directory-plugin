<?php
/**
 * Displays the product table html
 *
 * @param [type] $results
 * @return product html.
 */
function product_table_html( $results ) {

	$html = '<table class="table">
    <thead class="">
      <tr>
        <th scope="col">Image</th>
        <th scope="col">Product Name</th>
        <th scope="col">Brand</th>
        <th scope="col">Vendor</th>
        <th scope="col">Type</th>
        <th scope="col">Material</th>
        <th scope="col">Built Type</th>
        <th scope="col">Sold type</th>
        <th scope="col">Price</th>
        <th scope="col">Tags</th>
      </tr>
    </thead>
    <tbody>';

	foreach ( $results as $result ) {
		$html .= '
        <tr>
        <td class="img-td-leg"">
		<img class="img-fluid img-thumbnail leg-image" style="max-height:200px;" src="' . esc_url_raw( $result->image_url ) . '" alt="product_image">
		</td>
          <td>' . esc_html( $result->product_name ) . '</td>
          <td>' . esc_html( $result->brand_name ) . '</td>
          <td> <a class="vendor_name_search"  data-name="' . esc_html( $result->vendor ) . '" style="    text-decoration: underline;
          cursor: pointer;">' . esc_html( $result->vendor ) . '</a></td>
          <td>' . esc_html( $result->product_type ) . '</td>
          <td>' . esc_html( $result->product_material ) . '</td>
          <td>' . esc_html( $result->built_type ) . '</td>
          <td>' . esc_html( $result->sold_type ) . '</td>
          <td>' . esc_html( $result->price_range ) . '</td>
          <td>' . esc_html( $result->tags ) . '</td>
         
        </tr>';

	}

	$html .= '</tbody>
  </table>';

	return $html;
}
