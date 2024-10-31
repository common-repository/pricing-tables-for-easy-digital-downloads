<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Print scripts
 *
 * @since 1.0
*/
function pricing_tables_for_edd_scripts() {
	wp_register_style( 'ptf-pricing-tables-css', PTFEDD_PLUGIN_URL . 'assets/css/ptf-pricing-tables.css', array(), PTFEDD_VERSION, 'screen' );
	wp_enqueue_style( 'ptf-pricing-tables-css' );
	if( !wp_style_is( 'fontawesome', 'registered' ) ) {
		wp_register_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_enqueue_style( 'fontawesome' );
	}
}
add_action( 'wp_enqueue_scripts', 'pricing_tables_for_edd_scripts', 100 );

/**
 * Show or hide the table row based on the checkbox option
 *
 * @since 1.0.0
 */
function pricing_tables_for_edd_admin_scripts() {

	$screen = get_current_screen();

	if ( $screen->id !== 'download' ) {
		return;
	}

	?>
	<script>

		jQuery(document).ready(function($) {

			// All options are hidden by default with display:none on the div
			// When "Create pricing table" is checked it will show these options
			var enablePricingTable = $('#ptf-pricing-tables');

			// The "Show advanced options" checkbox
			var enableAdvancedOptions = $('#ptf-pricing-tables-advanced-options');

			// The pricing options
			var pricingTableOptions = $('#pricing-tables-for-easy-digital-downloads-variable-pricing-options');

			// Store all the advanced options
			var advancedOptions = $('.pricing-tables-for-easy-digital-downloads-option-advanced');

			// Advanced options wrap
			var optionAdvancedOptions = $('#pricing-tables-for-easy-digital-downloads-advanced-options');

			// Show or hide the pricing table options
			enablePricingTable.click( function() {

				if ( this.checked ) {
					$( pricingTableOptions ).show();
					$( optionAdvancedOptions ).show();
				} else {
					$( pricingTableOptions ).hide();
					$( optionAdvancedOptions ).hide();
				}

			});

			// Show or hide the pricing table options on page load
			if ( enablePricingTable.is(':checked') ) {
				$( pricingTableOptions ).show();
				$( optionAdvancedOptions ).show();
			} else {
				$( pricingTableOptions ).hide();
				$( optionAdvancedOptions ).hide();
			}

			// Show or hide the advanced options
			enableAdvancedOptions.click( function() {

				if ( this.checked ) {
					$( advancedOptions ).show();
				} else {
					$( advancedOptions ).hide();
				}

			});

			// Show or hide the advanced options on page load
			if ( enableAdvancedOptions.is(':checked') ) {
				$( advancedOptions ).show();
			} else {
				$( advancedOptions ).hide();
			}

		});
	</script>

	<?php
}
add_action( 'in_admin_footer', 'pricing_tables_for_edd_admin_scripts' );
