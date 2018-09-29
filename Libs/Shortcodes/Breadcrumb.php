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

class Breadcrumb extends \WordPress\Plugins\BootstrapShortcodes\Libs\Shortcodes implements \WordPress\Plugins\BootstrapShortcodes\Libs\Interfaces\ShortcodeInterface {
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
            'breadcrumb',
            'breadcrumb-item'
        );

        return $shortcodes;
    }

    /**
     * Shortcode:
     *      [breadcrumb][/breadcrumb]
     *
     * Supported Arguments:
     *      xclass
     *      data
     *
     * @link http://getbootstrap.com/components/#breadcrumbs Bootstrap 3 Breadcrumbs
     * @depends shortcodeBreadcrumbItem
     *
     * @param array $atts
     * @param string $content
     * @return string
     */
    public function shortcodeBreadcrumb($atts, $content = null) {
        $args = \shortcode_atts(
            array(
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = 'breadcrumb';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        return \sprintf(
            '<ol class="%1$s"%2$s>%3$s</ol>',
            \esc_attr(\trim($class)),
            ($dataProps !== null) ? ' ' . $dataProps : '',
            \do_shortcode($content)
        );
    }

    /**
     * Shortcode:
     *      [breadcrumb-item][/breadcrumb-item]
     *
     * Supported Arguments:
     *      link
     *      active
     *      xclass
     *      data
     *
     * @link http://getbootstrap.com/components/#breadcrumbs Bootstrap 3 Breadcrumbs
     * @depends shortcodeBreadcrumb
     *
     * @param array $atts
     * @param string $content
     * @return string
     */
    public function shortcodeBreadcrumbItem($atts, $content = null) {
        $args = \shortcode_atts(
            array(
                'link' => false,
                'active' => false,
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = '';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $active = ($args['active'] !== false) ? ' class="active"' : '';
        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        $link = ($args['link']) ? \sprintf('<a href="%1$s" class="%2$s"%3$s>%4$s</a>',
            \esc_url($args['link']),
            \esc_attr(\trim($class)),
            ($dataProps !== null) ? ' ' . $dataProps : '',
            \do_shortcode($content)
        ) : \do_shortcode($content);

        return \sprintf(
            '<li%1$s>%2$s</li>',
            $active,
            $link
        );
    }
}
