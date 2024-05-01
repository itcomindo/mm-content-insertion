<?php
/**
 *
 * Plugin Name: MM Content Insertion
 * Description: A simple plugin to insert custom content (shortcode, text, etc) into your post.
 * Version: 1.0.0
 * Author: Budi Haryono
 * Author URI: https://budiharyono.id/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package mci
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

// Define the plugin directory.
define( 'MCI_DIR', plugin_dir_path( __FILE__ ) );

// Define the plugin URL.
define( 'MCI_URL', plugin_dir_url( __FILE__ ) );



/**
 * MasmonsThemeFunction
 *
 * @param array $html_tags_allowed Array of allowed HTML tags.
 */
function mci( $html_tags_allowed = array() ) {
	if ( ! is_array( $html_tags_allowed ) ) {
		return array(); // Kembalikan array kosong jika input tidak valid.
	}
	$pass = array();

	// Definisikan atribut untuk SVG.
	$svg_args = array(
		'class'             => true,
		'aria-hidden'       => true,
		'aria-labelledby'   => true,
		'role'              => true,
		'xmlns'             => true,
		'width'             => true,
		'height'            => true,
		'viewBox'           => true,
		'version'           => true,
		'xmlns:xlink'       => true,
		'x'                 => true,
		'y'                 => true,
		'enable-background' => true,
		'xml:space'         => true,
		'metadata'          => true,
		'style'             => true,
		'viewbox'           => true,
		'path'              => true,
		'fill'              => true,
		'fill-rule'         => true,
		'clip-rule'         => true,
		'd'                 => true,
	);

	foreach ( $html_tags_allowed as $tag ) {
		$attributes = array(
			'class' => array(),
			'id'    => array(), // Tambahkan atribut id.
		);

		// Tambahkan atribut tambahan untuk tag spesifik.
		if ( 'img' === $tag ) {
			$attributes['src']    = array();
			$attributes['alt']    = array();
			$attributes['title']  = array();
			$attributes['width']  = array();
			$attributes['height'] = array();
		}

		if ( 'a' === $tag ) {
			$attributes['href']   = array();
			$attributes['target'] = array();
			$attributes['rel']    = array();
			$attributes['style']  = array();
			$attributes['class']  = array();
		}

		// Jika tag adalah SVG, gunakan atribut yang telah didefinisikan dalam $svg_args.
		if ( 'svg' === $tag ) {
			$attributes = $svg_args;
		}

		// iframe.
		if ( 'iframe' === $tag ) {
			$attributes['src']             = true;
			$attributes['width']           = true;
			$attributes['height']          = true;
			$attributes['frameborder']     = true;
			$attributes['allowfullscreen'] = true;
		}

		// Jika tag adalah div, tambahkan atribut data-xxxx dengan validasi nilai hex.
		if ( 'div' === $tag ) {
			$attributes = array_merge(
				$attributes,
				array(
					'/^data-[a-zA-Z0-9\-]*$/' => array(
						'pattern' => '/^#[a-fA-F0-9]{6}$/',
					),
				)
			);
		}

		$pass[ $tag ] = $attributes;
	}

	// Tambahkan elemen lain yang diperlukan untuk SVG.
	$pass['g']     = array( 'fill' => true );
	$pass['title'] = array( 'title' => true );
	$pass['path']  = array(
		'd'    => true,
		'fill' => true,
	);

	return $pass;
}

/**
 * Check CF Loaded
 */
function mci_call_carbon_fields() {
	if ( ! class_exists( '\Carbon_Fields\Carbon_Fields' ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
		\Carbon_Fields\Carbon_Fields::boot();
	} else {
		return;
	}
}

/**
 * MCS CF Loaded
 */
function mci_cf_loaded() {
	if ( ! function_exists( 'carbon_fields_boot_plugin' ) ) {
		mci_call_carbon_fields();
	} else {
		return;
	}
}
add_action( 'plugins_loaded', 'mci_cf_loaded' );




// Required files.
require_once MCI_DIR . 'assets/assets.php';
require_once MCI_DIR . 'components/components.php';
require_once MCI_DIR . 'mci-options.php';

/**
 * Modify Conten
 *
 * @param string $content The content.
 */
function mm_modify_content( $content ) {
	$mci_get_mci = mci_get_mci();

	// Cek apakah $mci_get_mci kosong atau tidak.
	if ( empty( $mci_get_mci ) ) {
		return $content;
	}

	$split_content   = preg_split( '/(<\/p>)/i', $content, -1, PREG_SPLIT_DELIM_CAPTURE );
	$new_content     = '';
	$paragraph_count = 1;

	foreach ( $split_content as $piece ) {
		$new_content .= $piece;

		if ( strpos( $piece, '</p>' ) !== false ) {
			$key = 'after_par_' . $paragraph_count;
			if ( array_key_exists( $key, $mci_get_mci ) && ! empty( $mci_get_mci[ $key ] ) ) {
				// Menjalankan shortcode jika ada dan menambahkan ke konten.
				$insert_content = do_shortcode( $mci_get_mci[ $key ] );
				$new_content   .= '<div class="mci-content-insertion">' . $insert_content . '</div>';
			}
			++$paragraph_count;
		}
	}

	return $new_content;
}



/**
 * MCI Launcher
 */
function mci_launcher() {
	$mci_show_in = carbon_get_theme_option( 'mci_show_in' );

	// Tentukan kondisi berdasarkan tipe konten.
	$on_single  = is_single();
	$on_page    = is_page();
	$on_product = function_exists( 'is_product' ) && is_product();

	// Cek tipe konten yang diinginkan dan terapkan filter jika sesuai.
	if ( ( 'post' === $mci_show_in && $on_single ) ||
		( 'page' === $mci_show_in && $on_page ) ||
		( 'woocommerce' === $mci_show_in && $on_product ) ||
		( 'post_and_page' === $mci_show_in && ( $on_single || $on_page ) ) ||
		( 'post_and_woocommerce' === $mci_show_in && ( $on_single || $on_product ) ) ||
		( 'page_and_woocommerce' === $mci_show_in && ( $on_page || $on_product ) ) ||
		( 'all' === $mci_show_in ) ) {
		add_filter( 'the_content', 'mm_modify_content' );
	}
}
add_action( 'wp', 'mci_launcher' );
