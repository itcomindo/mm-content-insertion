<?php
/**
 *
 * Assets
 *
 * @package mci
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
 * Load Frontend Style
 */
function mci_assets() {
	wp_enqueue_style( 'mci-css', MCI_URL . 'assets/css/mci.css', array(), '1.0.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'mci_assets' );

/**
 * Load MCI Admin Assets
 */
function mci_admin_assets() {
	wp_enqueue_style( 'mci-admin-css', MCI_URL . 'assets/css/mci-admin.css', array(), '1.0.0', 'all' );
}
add_action( 'admin_enqueue_scripts', 'mci_admin_assets' );
