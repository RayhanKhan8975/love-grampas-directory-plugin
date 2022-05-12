<?php
/**
 * Sets up inital values after activation
 *
 * @return void
 */
function ilg_activate() {
	if ( version_compare( get_bloginfo( 'version' ), '5.2.0', '<' ) ) {
		wp_die( esc_html__( 'Minimum WordPress version required is 5.2.0', 'codeable' ) );
	}

	global $wpdb;

	$table_name1  = $wpdb->prefix . 'ilg_vendor_info';
	$wpdb_collate = $wpdb->collate;
	$table_name2  = $wpdb->prefix . 'ilg_product_info';

	$sql1 = 'CREATE TABLE `' . $table_name1 . "` (
        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        `business_name` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
        `street_address` VARCHAR(250) NOT NULL COLLATE 'utf8mb4_general_ci',
        `city_state` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
        `email` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
        `phone` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
        `website` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
        `built_type` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
        `fein_ssn` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
        `driver_license` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
        `state_business_registration` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
         PRIMARY KEY (`id`)
    )
    COLLATE='{$wpdb_collate}'
    ENGINE=InnoDB
    ;
    ";

	$sql2 = 'CREATE TABLE `' . $table_name2 . "` (
        `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `product_type` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
        `product_name` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
        `product_material` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
        `built_type` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
        `sold_type` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
        `vendor` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
        `tags` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
        `brand_name` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
        `image_url` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
        `price_range` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_unicode_ci',
        PRIMARY KEY (`id`)
    )
    COLLATE='{$wpdb_collate}'
    ENGINE=InnoDB
    ;
    ";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	dbDelta( array( $sql1, $sql2 ) );

}
