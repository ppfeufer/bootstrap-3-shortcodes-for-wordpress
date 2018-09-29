<?php

/*
 * Copyright (C) 2017 ppfeufer
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace WordPress\Plugins\BootstrapShortcodes\Libs\ResourceLoader;

class JavascriptLoader implements \WordPress\Plugins\BootstrapShortcodes\Libs\Interfaces\AssetsInterface {
    public function init() {
        \add_action('wp_enqueue_scripts', array($this, 'enqueue'), 99);
    }

    public function enqueue() {
        \wp_enqueue_script('bootstrap-js', \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\PluginHelper::getInstance()->getPluginUri('bootstrap/js/bootstrap.min.js'), array('jquery'), '', true);
        \wp_enqueue_script('bootstrap-toolkit-js', \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\PluginHelper::getInstance()->getPluginUri('bootstrap/bootstrap-toolkit/bootstrap-toolkit.min.js'), array('jquery', 'bootstrap-js'), '', true);
//        \wp_enqueue_script('bootstrap-gallery-js', \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\PluginHelper::getInstance()->getPluginUri('js/jquery.bootstrap-gallery.min.js'), array('jquery', 'bootstrap-js'), '', true);
        \wp_enqueue_script('bootstrap-shortcodes-for-wordpress-js', \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\PluginHelper::getInstance()->getPluginUri('js/bootstrap-3-shortcodes-for-wordpress.min.js'), array('jquery'), '', true);
    }
}
