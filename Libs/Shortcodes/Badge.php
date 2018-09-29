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

namespace WordPress\Plugins\BootstrapShortcodes\Libs\Shortcodes;

class Badge extends \WordPress\Plugins\BootstrapShortcodes\Libs\Shortcodes implements \WordPress\Plugins\BootstrapShortcodes\Libs\Interfaces\ShortcodeInterface {
    /**
     * Constructor
     */
    public function __construct($addFilter = false) {
        parent::__construct($addFilter);

        $this->registerShortcodes($this->getShortcodeArray());
    }

    /**
     * getting the supported shortcodes
     *
     * @return array Array with all supported shortcodes
     */
    public function getShortcodeArray() {
        $shortcodes = array(
            'badge'
        );

        return $shortcodes;
    }

    /**
     * Shortcode:
     *      [badge]42[/badge]
     *
     * Supported Arguments:
     *      right   true/false (Default: false) / pull the badge to the right side or not
     *      xclass
     *      data
     *
     * @link http://getbootstrap.com/components/#badges Bootstrap 3 Badges
     *
     * @param array $atts
     * @param string $content
     * @return string
     */
    public function shortcodeBadge($atts, $content = null) {
        $args = \shortcode_atts(
            array(
                'right' => false,
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = 'badge';
        $class .= ($args['right'] !== false) ? ' pull-right' : '';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        return \sprintf(
            '<span class="%1$s"%2$s>%3$s</span>',
            \esc_attr(\trim($class)),
            ($dataProps !== null) ? ' ' . $dataProps : '',
            \do_shortcode($content)
        );
    }
}
