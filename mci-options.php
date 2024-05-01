<?php
/**
 *
 * MCI Options
 *
 * @package mci
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * MCI Options
 */
function mci_options() {
	Container::make( 'theme_options', 'MCI Options' )
	->add_fields(
		array(

			// select to select where to show in post or page or singular.
			Field::make( 'select', 'mci_show_in', 'Show In' )
			->add_options(
				array(
					'post'                => 'Post Only',
					'post_and_page'       => 'Post and Page',
					'post_and_wocommerce' => 'Post and WooCommerce',
					'page'                => 'Page Only',
					'page_and_wocommerce' => 'Page and WooCommerce',
					'woocommerce'         => 'WooCommerce Only',
					'all'                 => 'ALL',
				)
			)
			->set_default_value( 'post' ),

			// HTML if mci_show_in is singular.
			Field::make( 'html', 'mci_singular_help_text', 'Singular' )
			->set_html( '<p>Choose <strong>ALL</strong> to show in all post and page include product (woocommerce and any custom post type).</p>' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_show_in',
						'operator' => '==',
						'value'    => 'all',
					),
				)
			),

			// checkbox enable mci_ap_1.
			Field::make( 'checkbox', 'mci_ap_1_enable', 'Enable After Paragraph 1' )
			->set_default_value( true ),
			Field::make( 'rich_text', 'mci_ap_1', 'After Paragraph 1' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_1_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

			// checkbox enable mci_ap_2.
			Field::make( 'checkbox', 'mci_ap_2_enable', 'Enable After Paragraph 2' ),
			Field::make( 'rich_text', 'mci_ap_2', 'After Paragraph 2' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_2_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

			// checkbox enable mci_ap_3.
			Field::make( 'checkbox', 'mci_ap_3_enable', 'Enable After Paragraph 3' ),
			Field::make( 'rich_text', 'mci_ap_3', 'After Paragraph 3' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_3_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

			// checkbox enable mci_ap_4.
			Field::make( 'checkbox', 'mci_ap_4_enable', 'Enable After Paragraph 4' ),
			Field::make( 'rich_text', 'mci_ap_4', 'After Paragraph 4' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_4_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

			// checkbox enable mci_ap_5.
			Field::make( 'checkbox', 'mci_ap_5_enable', 'Enable After Paragraph 5' ),
			Field::make( 'rich_text', 'mci_ap_5', 'After Paragraph 5' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_5_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

			// checkbox enable mci_ap_6.
			Field::make( 'checkbox', 'mci_ap_6_enable', 'Enable After Paragraph 6' ),
			Field::make( 'rich_text', 'mci_ap_6', 'After Paragraph 6' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_6_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

			// checkbox enable mci_ap_7.
			Field::make( 'checkbox', 'mci_ap_7_enable', 'Enable After Paragraph 7' ),
			Field::make( 'rich_text', 'mci_ap_7', 'After Paragraph 7' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_7_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

			// checkbox enable mci_ap_8.
			Field::make( 'checkbox', 'mci_ap_8_enable', 'Enable After Paragraph 8' ),
			Field::make( 'rich_text', 'mci_ap_8', 'After Paragraph 8' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_8_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

			// checkbox enable mci_ap_9.
			Field::make( 'checkbox', 'mci_ap_9_enable', 'Enable After Paragraph 9' ),
			Field::make( 'rich_text', 'mci_ap_9', 'After Paragraph 9' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_9_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

			// checkbox enable mci_ap_10.
			Field::make( 'checkbox', 'mci_ap_10_enable', 'Enable After Paragraph 10' ),
			Field::make( 'rich_text', 'mci_ap_10', 'After Paragraph 10' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_10_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

			// checkbox enable mci_ap_11.
			Field::make( 'checkbox', 'mci_ap_11_enable', 'Enable After Paragraph 11' ),
			Field::make( 'rich_text', 'mci_ap_11', 'After Paragraph 11' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_11_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

			// checkbox enable mci_ap_12.
			Field::make( 'checkbox', 'mci_ap_12_enable', 'Enable After Paragraph 12' ),
			Field::make( 'rich_text', 'mci_ap_12', 'After Paragraph 12' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_12_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

			// checkbox enable mci_ap_13.
			Field::make( 'checkbox', 'mci_ap_13_enable', 'Enable After Paragraph 13' ),
			Field::make( 'rich_text', 'mci_ap_13', 'After Paragraph 13' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'mci_ap_13_enable',
						'operator' => '==',
						'value'    => true,
					),
				)
			),

		)
	);
}
add_action( 'carbon_fields_register_fields', 'mci_options' );
