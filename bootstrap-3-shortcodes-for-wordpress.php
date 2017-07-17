<?php

/**
 * Plugin Name: Bootstrap 3 Shortcodes for WordPress
 * Plugin URI: https://github.com/ppfeufer/bootstrap-3-shortcodes-for-wordpress
 * Git URI: https://github.com/ppfeufer/bootstrap-3-shortcodes-for-wordpress
 * Description: Provides a way to implement the Bootstrap 3 stuff into WordPress via shortcodes. (Best with a theme running with <a href="http://getbootstrap.com/">Bootstrap</a>)
 * Version: 0.1-r20170717
 * Author: Peter Pfeufer
 * Author URI: http://ppfeufer.de
 * Text Domain: bootstrap-3-shortcodes-for-wordpress
 * Domain Path: /l10n
 */

namespace WordPress\Plugin\BootstrapShortcodes;

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

		/**
		 * Initialize the plugin
		 *
		 * @todo https://premium.wpmudev.org/blog/activate-deactivate-uninstall-hooks/
		 */
		$this->init();
	} // END public function __construct()

	public function init() {
		// Loading the libs and helper
		$this->loadLibs();

		// loading shortcodes
		new Libs\Shortcodes;

		// Enqueue scripts and styles
		\add_action('wp_enqueue_scripts', array($this, 'enqueueJavaScript'), 99);
		\add_action('wp_enqueue_scripts', array($this, 'enqueueStylesheet'), 99);
	} // END public function init()

	/**
	 * Loading all libs
	 */
	public function loadLibs() {
		// Loading helper classes
		foreach(\glob($this->pluginDir . 'helper/*.php') as $lib) {
			include_once($lib);
		} // END foreach(\glob($this->pluginDir . 'libs/*.php') as $lib)

		// loading libs
		foreach(\glob($this->pluginDir . 'libs/*.php') as $lib) {
			include_once($lib);
		} // END foreach(\glob($this->pluginDir . 'libs/*.php') as $lib)
	} // END public function loadLibs()

	/**
	 * Enqueue our javascript
	 */
	public function enqueueJavaScript() {
		\wp_enqueue_script('bootstrap-js', Helper\PluginHelper::getPluginUri('bootstrap/js/bootstrap.min.js'), array('jquery'), '', true);
		\wp_enqueue_script('bootstrap-toolkit-js', Helper\PluginHelper::getPluginUri('bootstrap/bootstrap-toolkit/bootstrap-toolkit.min.js'), array('jquery', 'bootstrap-js'), '', true);
		\wp_enqueue_script('bootstrap-gallery-js', Helper\PluginHelper::getPluginUri('js/jquery.bootstrap-gallery.min.js'), array('jquery', 'bootstrap-js'), '', true);
		\wp_enqueue_script('bootstrap-shortcodes-for-wordpress-js', Helper\PluginHelper::getPluginUri('js/bootstrap-3-shortcodes-for-wordpress.min.js'), array('jquery'), '', true);
	} // END public function enqueueJavaScript()

	/**
	 * Enqueue our css
	 */
	public function enqueueStylesheet() {
		\wp_enqueue_style('bootstrap', Helper\PluginHelper::getPluginUri('bootstrap/css/bootstrap.min.css'));
		\wp_enqueue_style('bootstrap-shortcodes-for-wordpress', Helper\PluginHelper::getPluginUri('css/bootstrap-3-shortcodes-for-wordpress.min.css'));
	} // END public function enqueueStylesheet()
} // END class BootstrapShortcodes

// Start the show
new BootstrapShortcodes;
