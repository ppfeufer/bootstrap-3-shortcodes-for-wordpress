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

/**
 * Bootstrap Progress Bars
 *
 * @see http://getbootstrap.com/components/#progress
 */
class Lists extends \WordPress\Plugins\BootstrapShortcodes\Libs\Shortcodes implements \WordPress\Plugins\BootstrapShortcodes\Libs\Interfaces\ShortcodeInterface {
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
            'list-group',
            'list-group-item',
            'list-group-item-heading',
            'list-group-item-text'
        );

        return $shortcodes;
    }

    public function shortcodeListGroup($atts, $content = null) {
        $args = \shortcode_atts(
            array(
                'linked' => false,
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = 'list-group';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        return \sprintf(
            '<%1$s class="%2$s"%3$s>%4$s</%1$s>',
            ($args['linked'] !== false) ? 'div' : 'ul',
            \esc_attr(\trim($class)),
            ($dataProps !== null) ? ' ' . $dataProps : '',
            \do_shortcode($content)
        );
    }

    public function shortcodeListGroupItem($atts, $content = null) {
        $args = \shortcode_atts(
            array(
                'link' => false,
                'type' => false,
                'active' => false,
                'target' => false,
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = 'list-group-item';
        $class .= ($args['type'] !== false) ? ' list-group-item-' . $args['type'] : '';
        $class .= ($args['active'] !== false) ? ' active' : '';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        return \sprintf(
            '<%1$s %2$s %3$s class="%4$s"%5$s>%6$s</%1$s>',
            ($args['link'] !== false) ? 'a' : 'li',
            ($args['link'] !== false) ? 'href="' . \esc_url($args['link']) . '"' : '',
            ($args['target'] !== false) ? \sprintf(' target="%s"', \esc_attr($args['target'])) : '',
            \esc_attr(\trim($class)),
            ($dataProps !== null) ? ' ' . $dataProps : '',
            \do_shortcode($content)
        );
    }

    public function shortcodeListGroupItemHeading($atts, $content = null) {
        $args = \shortcode_atts(
            array(
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = 'list-group-item-heading';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        return \sprintf(
            '<h4 class="%s"%s>%s</h4>',
            \esc_attr(\trim($class)),
            ($dataProps !== null) ? ' ' . $dataProps : '',
            \do_shortcode($content)
        );
    }

    public function shortcodeListGroupItemText($atts, $content = null) {
        $args = \shortcode_atts(
            array(
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = 'list-group-item-text';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        return \sprintf(
            '<p class="%s"%s>%s</p>',
            \esc_attr(\trim($class)),
            ($dataProps !== null) ? ' ' . $dataProps : '',
            \do_shortcode($content)
        );
    }
}
