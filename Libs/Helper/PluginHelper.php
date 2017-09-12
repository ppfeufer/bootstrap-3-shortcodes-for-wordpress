<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs\Helper;

class PluginHelper extends \WordPress\Plugin\BootstrapShortcodes\Libs\Singletons\AbstractSingleton {
	public function getPluginPath($file = '') {
		return \trailingslashit(\WP_CONTENT_DIR) . 'plugins/bootstrap-3-shortcodes-for-wordpress/' . $file;
	} // END public static function getPluginPath($file = '')

	public function getPluginUri($file = '') {
		return \trailingslashit(\WP_CONTENT_URL) . 'plugins/bootstrap-3-shortcodes-for-wordpress/' . $file;
	} // END public static function getPluginUri($file = '')
} // END class PluginHelper

