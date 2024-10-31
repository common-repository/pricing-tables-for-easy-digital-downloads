<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class PTF_Pricing_Tables_For_EDD_Shortcodes {

	public function __construct() {
        add_shortcode( 'ptf_pricing_tables', array( $this, 'ptf_pricing_tables_shortcode' ) );
	}

    /**
    * [ptf_pricing_tables] shortcode
    *
    * @since  1.0
    */
	public function ptf_pricing_tables_shortcode( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			'id'  => '',
			'ids' => '',
		), $atts, 'ptf_pricing_tables' );

		$content = pricing_tables_for_edd()->frontend->ptf_pricing_tables( $atts );

		return do_shortcode( $content );

	}

}
new PTF_Pricing_Tables_For_EDD_Shortcodes;
