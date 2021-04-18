<?php
/**
 * Plugin Name: Plugin Downloader
 * Description: Makes it possible to download any plugins installed on a WordPress site.
 * Author:      Drew Jaynes
 * Author URI:  https://werdswords.com
 * Text Domain: plugin-downloader
 * Domain Path: /languages
 * Version:     0.0.1
 */

if ( ! class_exists( 'Sandhills_Requirements_Check' ) ) {
	require_once dirname( __FILE__ ) . '/includes/lib/class-sandhills-requirements-check.php';
}

/**
 * Class used to check requirements for and bootstrap the plugin.
 *
 * @since 1.0.0
 *
 * @see Sandhills_Requirements_Check
 */
class WerdsWords_Plugin_Downloader_Requirements extends Sandhills_Requirements_Check {

	/**
	 * Plugin slug.
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $slug = 'ww-plugin-downloader';

	/**
	 * Add-on requirements.
	 *
	 * @since 1.0.0
	 * @var   array[]
	 */
	protected $addon_requirements = array(
		// WordPress.
		'wp' => array(
			'minimum' => '5.3',
			'name'    => 'WordPress',
			'exists'  => true,
			'current' => false,
			'checked' => false,
			'met'     => false
		),
	);

	/**
	 * Bootstrap everything.
	 *
	 * @since 1.0.0
	 */
	public function bootstrap() {
		\WerdsWords_Plugin_Downloader::instance( __FILE__ );
	}

	/**
	 * Loads the add-on.
	 *
	 * @since 1.0.0
	 */
	protected function load() {
		// Maybe include the bundled bootstrapper.
		if ( ! class_exists( 'WerdsWords_Plugin_Downloader' ) ) {
			require_once dirname( __FILE__ ) . '/includes/class-plugin-downloader.php';
		}

		// Maybe hook-in the bootstrapper.
		if ( class_exists( 'WerdsWords_Plugin_Downloader' ) ) {

			add_action( 'plugins_loaded', array( $this, 'bootstrap' ), 999 );

			// Register the activation hook.
			register_activation_hook( __FILE__, array( $this, 'install' ) );
		}
	}

	/**
	 * Install, usually on an activation hook.
	 *
	 * @since 1.0.0
	 */
	public function install() {
		// Bootstrap to include all of the necessary files
		$this->bootstrap();

		if ( defined( 'WW_PD_VERSION' ) ) {
			update_option( 'ww_pd_version', WW_PD_VERSION );
		}
	}

	/**
	 * Plugin-specific aria label text to describe the requirements link.
	 *
	 * @since 1.0.0
	 *
	 * @return string Aria label text.
	 */
	protected function unmet_requirements_label() {
		return esc_html__( 'Plugin Downloader Requirements', 'plugin-downloader' );
	}

	/**
	 * Plugin-specific text used in CSS to identify attribute IDs and classes.
	 *
	 * @since 1.0.0
	 *
	 * @return string CSS selector.
	 */
	protected function unmet_requirements_name() {
		return 'plugin-downloader-requirements';
	}

	/**
	 * Plugin specific URL for an external requirements page.
	 *
	 * @since 1.0.0
	 *
	 * @return string Unmet requirements URL.
	 */
	protected function unmet_requirements_url() {}
		return '';
	}

}

$requirements = new WerdsWords_Plugin_Downloader_Requirements( __FILE__ );

$requirements->maybe_load();
