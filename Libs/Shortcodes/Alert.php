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

class Alert extends \WordPress\Plugins\BootstrapShortcodes\Libs\Shortcodes implements \WordPress\Plugins\BootstrapShortcodes\Libs\Interfaces\ShortcodeInterface {
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
            'alert'
        );

        return $shortcodes;
    }

    /**
     * Shortcode:
     *      [alert]Lorem Ipsum[/alert]
     *
     * Supported Arguments:
     *      type            success, info, warning, danger (default: success)
     *      dismissable     true/false
     *      xclass
     *      data
     *
     * @link http://getbootstrap.com/components/#alerts Bootstrap 3 Alerts
     *
     * @param array $atts
     * @param string $content
     * @return string
     */
    public function shortcodeAlert($atts, $content = null) {
        $args = \shortcode_atts(
            array(
                'type' => false,
                'dismissable' => false,
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = 'alert';
        $class .= ($args['type'] !== false) ? ' alert-' . $args['type'] : ' alert-success';
        $class .= ($args['dismissable'] !== false) ? ' alert-dismissable' : '';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $dismissableButton = ($args['dismissable']) ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' : '';

        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        return \sprintf(
            '<div class="%1$s"%2$s>%3$s%4$s</div>',
            \esc_attr(\trim($class)),
            ($dataProps !== null) ? ' ' . $dataProps : '',
            $dismissableButton,
            \do_shortcode($content)
        );
    }
}
