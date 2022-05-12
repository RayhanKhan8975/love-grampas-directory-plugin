<?php
/**
 * Displays the Vendor search results
 *
 * @param [type] $results
 * @return Search Result HTML.
 */
function vendor_table_html( $results ) {

	$html = '<table class="table">
    <thead class="">
      <tr>
        <th scope="col">Business Name</th>
        <th scope="col">City & State</th>
        <th scope="col">Email</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Website</th>
        <th scope="col">Built Type</th>';

	if ( current_user_can( 'edit_dashboard' ) ) {
		$html .= '
            <th scope="col">Street Address</th>
            <th scope="col">Driver&#39s License.</th>
            <th scope="col">FEIN/SSN</th>
            <th scope="col">State Business Registration</th>';
	}

		$html .= '</tr>
        </thead>
        <tbody>';

	foreach ( $results as $result ) {
		$html .= '
        <tr>
          <td> <a class="vendor_name_search"  data-name="' . esc_html( $result->business_name ) . '" style="    text-decoration: underline;
          cursor: pointer;">' . esc_html( $result->business_name ) . '</a></td>
          <td>' . esc_html( $result->city_state ) . '</td>
          <td>' . esc_html( $result->email ) . '</td>
          <td>' . esc_html( $result->phone ) . '</td>
          <td>' . esc_html( $result->website ) . '</td>
          <td>' . esc_html( $result->built_type ) . '</td>';

		if ( current_user_can( 'edit_dashboard' ) ) {
			$html .= '
<td>' . esc_html( $result->street_address ) . '</td>
<td>' . esc_html( $result->driver_license ) . '</td>
<td>' . esc_html( $result->fein_ssn ) . '</td>
<td>' . esc_html( $result->state_business_registration ) . '</td>';
		}

		$html .= '</tr>';

	}

	$html .= '</tbody>
  </table>';

	return $html;

}
