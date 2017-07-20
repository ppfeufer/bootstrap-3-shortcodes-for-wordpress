<?php

namespace WordPress\Plugin\BootstrapShortcodes\ResourceLoader;

class JavascriptLoader implements \WordPress\Plugin\BootstrapShortcodes\Interfaces\AssetsInterface {
	public function init() {
		\add_action('wp_enqueue_scripts', array($this, 'enqueue'), 99);
	}

	public function enqueue() {
		\wp_enqueue_script('bootstrap-js', \WordPress\Plugin\BootstrapShortcodes\Helper\PluginHelper::getPluginUri('bootstrap/js/bootstrap.min.js'), array('jquery'), '', true);
		\wp_enqueue_script('bootstrap-toolkit-js', \WordPress\Plugin\BootstrapShortcodes\Helper\PluginHelper::getPluginUri('bootstrap/bootstrap-toolkit/bootstrap-toolkit.min.js'), array('jquery', 'bootstrap-js'), '', true);
		\wp_enqueue_script('bootstrap-gallery-js', \WordPress\Plugin\BootstrapShortcodes\Helper\PluginHelper::getPluginUri('js/jquery.bootstrap-gallery.min.js'), array('jquery', 'bootstrap-js'), '', true);
		\wp_enqueue_script('bootstrap-shortcodes-for-wordpress-js', \WordPress\Plugin\BootstrapShortcodes\Helper\PluginHelper::getPluginUri('js/bootstrap-3-shortcodes-for-wordpress.min.js'), array('jquery'), '', true);
	}
}
