<?php
/**
 *
 * Dummy Content
 *
 * @package mci
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );


/**
 * Get Content Update
 */
function mci_get_mci() {
	$content          = array();
	$number_of_fields = 13;

	for ( $i = 1; $i <= $number_of_fields; $i++ ) {
		$field_id     = 'mci_ap_' . $i;
		$option_value = carbon_get_theme_option( $field_id );
		if ( ! empty( $option_value ) ) {
			$content[ 'after_par_' . $i ] = apply_filters( 'mci_filter_' . $field_id, $option_value );
		}
	}

	return $content;
}
