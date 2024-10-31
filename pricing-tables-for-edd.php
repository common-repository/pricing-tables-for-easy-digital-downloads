<?php
/*
Plugin Name: Pricing Tables for Easy Digital Downloads
Plugin URI: https://www.wponlinesupport.com/plugins/
Description: Easily create pricing tables for Easy Digital Downloads. Also work with Gutenberg shortcode block.
Text Domain: pricing-tables-for-easy-digital-downloads
Domain Path: /languages/
Version: 1.0.2
Author: WP OnlineSupport
Author URI: https://www.wponlinesupport.com/
License: GPL-2.0+
License URI: http://www.opensource.org/licenses/gpl-license.php
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'PTF_Pricing_Tables_For_EDD' ) ) {

	class PTF_Pricing_Tables_For_EDD {

		private static $instance;

		/**
		 * Plugin Version
		 */
		private $version = '1.0.2';

		/**
		 * Plugin Title
		 */
		public $title = 'Pricing Tables for Easy Digital Downloads';

		/**
		 * The frontend instance variable.
		 *
		 * @access public
		 * @since  1.0
		 * @var    object
		 */
		public $frontend;

		public static function get_instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof PTF_Pricing_Tables_For_EDD ) ) {
				self::$instance = new PTF_Pricing_Tables_For_EDD;
				self::$instance->setup_constants();
				self::$instance->includes();
				self::$instance->setup_actions();
				self::$instance->load_textdomain();
				self::$instance->frontend = new PTF_Pricing_Tables_For_EDD_Frontend;
			}

			return self::$instance;
		}


		/**
		 * Constructor Function
		 *
		 * @since 1.0
		 * @access private
		 */
		private function __construct() {
			self::$instance = $this;
		}

		/**
		 * Setup plugin constants
		 *
		 * @access private
		 * @since  1.0
		 *
		 * @return void
		 */
		private function setup_constants() {

			// Plugin version
			if ( ! defined( 'PTFEDD_VERSION' ) ) {
				define( 'PTFEDD_VERSION', $this->version );
			}

			// Plugin Folder Path
			if ( ! defined( 'PTFEDD_PLUGIN_DIR' ) ) {
				define( 'PTFEDD_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'PTFEDD_PLUGIN_URL' ) ) {
				define( 'PTFEDD_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

		}

		/**
		 * Setup the default hooks and actions
		 *
		 * @since 1.0
		 *
		 * @return void
		 */
		private function setup_actions() {
			do_action( 'pricing_tables_for_edd_setup_actions' );
		}

		/**
		 * Loads the plugin language files
		 *
		 * @access public
		 * @since 1.0.4
		 * @return void
		 */
		public function load_textdomain() {

			// Set filter for plugin's languages directory
			$lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
			$lang_dir = apply_filters( 'pricing_tables_for_edd_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale',  get_locale(), 'pricing-tables-for-easy-digital-downloads' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'pricing-tables-for-easy-digital-downloads', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/pricing-tables-for-easy-digital-downloads/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/pricing-tables-for-easy-digital-downloads/ folder
				load_textdomain( 'pricing-tables-for-easy-digital-downloads', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/pricing-tables-for-easy-digital-downloads/languages/ folder
				load_textdomain( 'pricing-tables-for-easy-digital-downloads', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'pricing-tables-for-easy-digital-downloads', false, $lang_dir );
			}
		}

		/**
		 * Include required files.
		 *
		 * @since 1.0
		 *
		 * @return void
		 */
		private function includes() {

			require_once( PTFEDD_PLUGIN_DIR . 'includes/class-shortcodes.php' );
			require_once( PTFEDD_PLUGIN_DIR . 'includes/class-frontend.php' );
			require_once( PTFEDD_PLUGIN_DIR . 'includes/scripts.php' );
			require_once( PTFEDD_PLUGIN_DIR . 'includes/functions.php' );

			if ( is_admin() ) {
				require_once( PTFEDD_PLUGIN_DIR . 'includes/class-admin.php' );
			}

		}

	}

	/**
	 * Loads a single instance
	 *
	 * This follows the PHP singleton design pattern.
	 *
	 * Use this function like you would a global variable, except without needing
	 * to declare the global. 
	 *
	 * @since 1.0
	 *
	 */
	function pricing_tables_for_edd() {

	    if ( ! class_exists( 'Easy_Digital_Downloads' ) ) {

	        if ( ! class_exists( 'EDD_Extension_Activation' ) ) {
	            require_once 'includes/class-activation.php';
	        }

	        $activation = new EDD_Extension_Activation( plugin_dir_path( __FILE__ ), basename( __FILE__ ) );
	        $activation = $activation->run();

	    } else {
	        return PTF_Pricing_Tables_For_EDD::get_instance();
	    }
	}
	add_action( 'plugins_loaded', 'pricing_tables_for_edd', apply_filters( 'pricing_tables_for_edd_action_priority', 10 ) );

}
