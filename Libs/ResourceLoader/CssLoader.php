<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs\ResourceLoader;

class CssLoader implements \WordPress\Plugin\BootstrapShortcodes\Libs\Interfaces\AssetsInterface {
	public function init() {
		\add_action('wp_enqueue_scripts', array($this, 'enqueue'), 99);
	}

	public function enqueue() {
		\wp_enqueue_style('bootstrap', \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\PluginHelper::getInstance()->getPluginUri('bootstrap/css/bootstrap.min.css'));
		\wp_enqueue_style('bootstrap-shortcodes-for-wordpress', \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\PluginHelper::getInstance()->getPluginUri('css/bootstrap-3-shortcodes-for-wordpress.min.css'));
	}
}
