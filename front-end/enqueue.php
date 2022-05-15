<?php
/**
 * Enqueues Scripts and Styles
 *
 * @return void
 */
function ilg_enqueue() {
	wp_register_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', false, false );
	wp_register_style( 'ilg_multiselect_css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css', false, false );
	wp_register_style( 'ilg_custom_css', plugins_url( 'assets/custom.css', ILG_PATH ), false, false );
	wp_register_style( 'ilg_fa_css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', false, false );

	wp_register_script( 'bootstrap_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'ilg_multi_select_js', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js', array( 'wp-i18n', 'jquery', 'bootstrap_js' ), false, true );
	wp_register_script( 'ilg_custom_js', plugins_url( 'assets/custom.js', ILG_PATH ), array( 'wp-i18n', 'jquery', 'ilg_multi_select_js' ), false, true );

	wp_enqueue_style( 'bootstrap_css' );
	wp_enqueue_style( 'ilg_multiselect_css' );
	wp_enqueue_style( 'ilg_custom_css' );
	wp_enqueue_style( 'ilg_fa_css' );

	wp_enqueue_script( 'bootstrap_js' );
	wp_enqueue_script( 'ilg_multi_select_js' );
	wp_enqueue_script( 'ilg_custom_js' );

	wp_localize_script( 'ilg_custom_js', 'ilg', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	wp_set_script_translations(
		'ilg_custom_js',
		'ilg',
		plugin_dir_path( __FILE__ ) . 'languages'
	);
}
