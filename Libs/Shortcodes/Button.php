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

class Button extends \WordPress\Plugins\BootstrapShortcodes\Libs\Shortcodes implements \WordPress\Plugins\BootstrapShortcodes\Libs\Interfaces\ShortcodeInterface {
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
            'button',
            'button-group',
            'button-toolbar'
        );

        return $shortcodes;
    }

    /**
     * Shortcode:
     *      [button][/button]
     *
     * Supported Arguments:
     *      type
     *      size
     *      block
     *      dropdown
     *      target
     *      disabled
     *      title
     *      link
     *      active
     *      xclass
     *      data
     *
     * @link http://getbootstrap.com/components/#btn-groups Bootstrap 3 Button Groups
     *
     * @param array $atts
     * @param string $content
     * @return string
     */
    public function shortcodeButton($atts, $content = null) {
        $args = \shortcode_atts(
            array(
                'type' => false,
                'size' => false,
                'block' => false,
                'dropdown' => false,
                'target' => false,
                'disabled' => false,
                'title' => false,
                'link' => false,
                'active' => false,
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = 'btn';
        $class .= ($args['type'] !== false) ? ' btn-' . $args['type'] : ' btn-default';
        $class .= ($args['size'] !== false) ? ' btn-' . $args['size'] : '';
        $class .= ($args['block'] !== false) ? ' btn-block' : '';
        $class .= ($args['dropdown'] !== false) ? ' dropdown-toggle' : '';
        $class .= ($args['disabled'] !== false) ? ' disabled' : '';
        $class .= ($args['active'] !== false) ? ' active' : '';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        return \sprintf(
            '<a href="%1$s" class="%2$s"%3$s%4$s%5$s>%6$s</a>',
            \esc_url($args['link']),
            \esc_attr(\trim($class)),
            ($args['target'] !== false) ? \sprintf(' target="%s"', \esc_attr($args['target'])) : '',
            ($args['title'] !== false) ? \sprintf(' title="%s"', \esc_attr($args['title'])) : '',
            ($dataProps !== null) ? ' ' . $dataProps : '',
            \do_shortcode($content)
        );
    }

    /**
     * Shortcode:
     *      [button-group][/button-group]
     *
     * Supported Arguments:
     *      size
     *      vertical
     *      justified
     *      dropup
     *      xclass
     *      data
     *
     * @link http://getbootstrap.com/components/#btn-groups Bootstrap 3 Button Groups
     *
     * @param array $atts
     * @param string $content
     * @return string
     */
    public function shortcodeButtonGroup($atts, $content = null) {
        $args = \shortcode_atts(
            array(
                'size' => false,
                'vertical' => false,
                'justified' => false,
                'dropup' => false,
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = 'btn-group';
        $class .= ($args['size'] !== false) ? ' btn-group-' . $args['size'] : '';
        $class .= ($args['vertical'] !== false) ? ' btn-group-vertical' : '';
        $class .= ($args['justified'] !== false) ? ' btn-group-justified' : '';
        $class .= ($args['dropup'] !== false) ? ' dropup' : '';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        return \sprintf(
            '<div class="%1$s"%2$s>%3$s</div>',
            \esc_attr(\trim($class)),
            ($dataProps !== null) ? ' ' . $dataProps : '',
            \do_shortcode($content)
        );
    }

    /**
     * Shortcode:
     *      [button-toolbar][/button-toolbar]
     *
     * Supported Arguments:
     *      xclass
     *      data
     *
     * @link http://getbootstrap.com/components/#btn-groups-toolbar Bootstrap 3 Button Toolbar
     *
     * @param array $atts
     * @param string $content
     * @return string
     */
    public function shortcodeButtonToolbar($atts, $content = null) {
        $args = \shortcode_atts(
            array(
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = 'btn-toolbar';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        return sprintf(
            '<div class="%1$s"%2$s>%3$s</div>',
            \esc_attr(\trim($class) ),
            ($dataProps !== null) ? ' ' . $dataProps : '',
            \do_shortcode($content)
        );
    }
}
