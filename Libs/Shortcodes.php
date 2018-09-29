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

namespace WordPress\Plugins\BootstrapShortcodes\Libs;

class Shortcodes {
    /**
     * Constructor
     *
     * @param boolean $addFilter Adding the filters for main class
     */
    public function __construct($addFilter = false) {
        if($addFilter === true) {
            $this->addFilter();
        }
    }

    public function addFilter() {
        \add_filter('the_content', [$this, 'filterFixLinebreaks']);
    }

    public function filterFixLinebreaks($content) {
        $toReplace = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']',
            ']<br>' => ']'
        );

        $content = \strtr($content, $toReplace);

        return $content;
    }

    /**
     * register all shortcodes
     */
    public function registerShortcodes($shortcodes) {
        foreach($shortcodes as $shortcode) {
            \add_shortcode($shortcode, array($this, 'shortcode' . \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\StringHelper::getInstance()->camelCase($shortcode, true)));
        }
    }
}
