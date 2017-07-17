<?php

namespace WordPress\Plugin\BootstrapShortcodes\Helper;

class PluginHelper {
	public static function getPluginPath($file = '') {
		return \trailingslashit(\WP_CONTENT_DIR) . 'plugins/bootstrap-3-shortcodes-for-wordpress/' . $file;
	} // END public static function getPluginPath($file = '')

	public static function getPluginUri($file = '') {
		return \trailingslashit(\WP_CONTENT_URL) . 'plugins/bootstrap-3-shortcodes-for-wordpress/' . $file;
	} // END public static function getPluginUri($file = '')
} // END class PluginHelper

