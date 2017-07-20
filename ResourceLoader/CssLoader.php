<?php

namespace WordPress\Plugin\BootstrapShortcodes\ResourceLoader;

class CssLoader implements \WordPress\Plugin\BootstrapShortcodes\Interfaces\AssetsInterface {
	public function init() {
		\add_action('wp_enqueue_scripts', array($this, 'enqueue'), 99);
	}

	public function enqueue() {
		\wp_enqueue_style('bootstrap', \WordPress\Plugin\BootstrapShortcodes\Helper\PluginHelper::getPluginUri('bootstrap/css/bootstrap.min.css'));
		\wp_enqueue_style('bootstrap-shortcodes-for-wordpress', \WordPress\Plugin\BootstrapShortcodes\Helper\PluginHelper::getPluginUri('css/bootstrap-3-shortcodes-for-wordpress.min.css'));
	}
}
