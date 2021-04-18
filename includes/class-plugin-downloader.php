<?php
/**
 * Plugin Downloader Bootstrap
 *
 * @package     Plugin Downloader
 * @subpackage  Core
 * @copyright   Copyright (c) 2021, Drew A Picture Media, LLC
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WerdsWords_Plugin_Downloader' ) ) {

	/**
	 * Setup class.
	 *
	 * @since 1.0.0
	 */
	final class WerdsWords_Plugin_Downloader {

		/**
		 * Main plugin instance.
		 *
		 * @since 1.0.0
		 * @var   \WerdsWords_Plugin_Downloader
		 * @static
		 */
		private static $instance;

		/**
		 * The version number.
		 *
		 * @since 1.0.0
		 * @var   string
		 */
		private $version = '0.0.1';

		/**
		 * Main plugin file.
		 *
		 * @since 1.0.0
		 * @var   string
		 */
		private $file = '';

		/**
		 * Generates the main plugin instance.
		 *
		 * @since 1.0.0
		 * @static
		 *
		 * @param string $file Main plugin file.
		 * @return \WerdsWords_Plugin_Downloader The one true AffiliateWP_Affiliate_Portal instance.
		 */
		public static function instance( $file = null ) {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WerdsWords_Plugin_Downloader ) ) {

				self::$instance = new \WerdsWords_Plugin_Downloader;

				self::$instance->file = $file;

				self::$instance->setup_constants();
				self::$instance->includes();
				self::$instance->init();
			}

			return self::$instance;
		}

		/**
		 * Throws an error on object clone.
		 *
		 * @access protected
		 * @since  1.0.0
		 *
		 * @return void
		 */
		protected function __clone() {
			// Cloning instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh? This object cannot be cloned.', 'plugin-downloader' ), '1.0.0' );
		}

		/**
		 * Disables un-serializing of the class.
		 *
		 * @access protected
		 * @since  1.0.0
		 *
		 * @return void
		 */
		protected function __wakeup() {
			// Un-serializing instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh? This class cannot be unserialized.', 'plugin-downloader' ), '1.0.0' );
		}

		/**
		 * Sets up the class.
		 *
		 * @access private
		 * @since  1.0.0
		 */
		private function __construct() {
			self::$instance = $this;
		}

		/**
		 * Setup plugin constants
		 *
		 * @access private
		 * @since  1.0.0
		 *
		 * @return void
		 */
		private function setup_constants() {
			// Plugin version
			if ( ! defined( 'WW_PD_VERSION' ) ) {
				define( 'WW_PD_VERSION', $this->version );
			}

			// Plugin Folder Path
			if ( ! defined( 'WW_PD_PLUGIN_DIR' ) ) {
				define( 'WW_PD_PLUGIN_DIR', plugin_dir_path( $this->file ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'WW_PD_PLUGIN_URL' ) ) {
				define( 'WW_PD_PLUGIN_URL', plugin_dir_url( $this->file ) );
			}

			// Plugin Root File
			if ( ! defined( 'WW_PD_PLUGIN_FILE' ) ) {
				define( 'WW_PD_PLUGIN_FILE', $this->file );
			}
		}

		/**
		 * Include necessary files.
		 *
		 * @access private
		 * @since  1.0.0
		 *
		 * @return void
		 */
		private function includes() {
			// Bring in the autoloader.
			require_once __DIR__ . '/lib/autoload.php';
		}

		/**
		 * Initializes the plugin.
		 *
		 * @since 1.0.0
		 */
		private function init() {

		}

	}

	/**
	 * Retrieves a copy of the plugin instance.
	 *
	 * @since  1.0.0
	 *
	 * @return \WerdsWords_Plugin_Downloader Plugin instance.
	 */
	function ww_plugin_downloader() {
		return WerdsWords_Plugin_Downloader::instance();
	}

}
