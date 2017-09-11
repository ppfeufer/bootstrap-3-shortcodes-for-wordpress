<?php

/**
 * Plugin Name: Bootstrap 3 Shortcodes for WordPress
 * Plugin URI: https://github.com/ppfeufer/bootstrap-3-shortcodes-for-wordpress
 * GitHub Plugin URI: https://github.com/ppfeufer/bootstrap-3-shortcodes-for-wordpress
 * Description: Provides a way to implement the Bootstrap 3 stuff into WordPress via shortcodes. (Best with a theme running with <a href="http://getbootstrap.com/">Bootstrap</a>)
 * Version: 0.1-r20170802
 * Author: Peter Pfeufer
 * Author URI: http://ppfeufer.de
 * Text Domain: bootstrap-3-shortcodes-for-wordpress
 * Domain Path: /l10n
 */

namespace WordPress\Plugin\BootstrapShortcodes;
const WP_GITHUB_FORCE_UPDATE = true;

// Include the autoloader so we can dynamically include the rest of the classes.
require_once(\trailingslashit(\dirname(__FILE__)) . 'inc/autoloader.php');

class BootstrapShortcodes {
	private $textDomain = null;
	private $pluginDir = null;
	private $pluginUri = null;

	public function __construct() {
		/**
		 * Initializing Variables
		 */
		$this->textDomain = 'bootstrap-3-shortcodes-for-wordpress';
		$this->pluginDir = \plugin_dir_path(__FILE__);
		$this->pluginUri = \trailingslashit(\plugins_url('/', __FILE__));
	} // END public function __construct()

	public function init() {
		// Loaduing CSS
		$cssLoader = new Libs\ResourceLoader\CssLoader;
		$cssLoader->init();

		// Loading JavaScript
		$javascriptLoader = new Libs\ResourceLoader\JavascriptLoader;
		$javascriptLoader->init();

		if(\is_admin()) {
			/**
			 * Check Github for updates
			 */
			$githubConfig = array(
				'slug' => \plugin_basename(__FILE__),
				'proper_folder_name' => \dirname(\plugin_basename(__FILE__)),
				'api_url' => 'https://api.github.com/repos/ppfeufer/bootstrap-3-shortcodes-for-wordpress',
				'raw_url' => 'https://raw.github.com/ppfeufer/bootstrap-3-shortcodes-for-wordpress/master',
				'github_url' => 'https://github.com/ppfeufer/bootstrap-3-shortcodes-for-wordpress',
				'zip_url' => 'https://github.com/ppfeufer/bootstrap-3-shortcodes-for-wordpress/archive/master.zip',
				'sslverify' => true,
				'requires' => '4.7',
				'tested' => '4.8',
				'readme' => 'README.md',
				'access_token' => '',
			);

			new Libs\GithubUpdater($githubConfig);
		}

		$this->initShortcodes();
	} // END public function init()

	private function initShortcodes() {
		new Libs\Shortcodes;
		new Libs\ShortcodesAccordion;
		new Libs\ShortcodesBreadcrumb;
		new Libs\ShortcodesButton;
		new Libs\ShortcodesCarousel;
		new Libs\ShortcodesList;
		new Libs\ShortcodesNavigation;
		new Libs\ShortcodesProgress;
	}
} // END class BootstrapShortcodes

function initializePlugin() {
	$bootstrapShortcodes = new BootstrapShortcodes;

	/**
	 * Initialize the plugin
	 *
	 * @todo https://premium.wpmudev.org/blog/activate-deactivate-uninstall-hooks/
	 */
	$bootstrapShortcodes->init();
} // END function initializePlugin()

// Start the show
\add_action('plugins_loaded', 'WordPress\Plugin\BootstrapShortcodes\initializePlugin');
