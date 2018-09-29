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
class Progress extends \WordPress\Plugins\BootstrapShortcodes\Libs\Shortcodes implements \WordPress\Plugins\BootstrapShortcodes\Libs\Interfaces\ShortcodeInterface {
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
            'progress',
            'progress-bar'
        );

        return $shortcodes;
    }

    public function shortcodeProgress($atts, $content = null) {
        $args = \shortcode_atts(
            array(
                'striped' => false,
                'animated' => false,
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = 'progress';
        $class .= ($args['striped'] !== false) ? ' progress-striped' : '';
        $class .= ($args['animated'] !== false) ? ' active' : '';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        return sprintf(
            '<div class="%s"%s>%s</div>',
            \esc_attr(\trim($class)),
            ($dataProps !== null) ? ' ' . $dataProps : '',
            \do_shortcode($content)
        );
    }

    public function shortcodeProgressBar($atts) {
        $args = \shortcode_atts(
            array(
                'type' => false,
                'percent' => false,
                'label' => false,
                'xclass' => false,
                'data' => false
            ), $atts
        );

        $class = 'progress-bar';
        $class .= ($args['type'] !== false) ? ' progress-bar-' . $args['type'] : '';
        $class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

        $dataProps = \WordPress\Plugins\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

        return sprintf(
            '<div class="%s" role="progressbar" %s%s>%s</div>',
            \esc_attr(trim($class)),
            ($args['percent'] !== false) ? ' aria-value="' . (int) $args['percent'] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . (int) $args['percent'] . '%;"' : '',
            ($dataProps !== null) ? ' ' . $dataProps : '',
            ($args['percent'] !== false) ? \sprintf('<span%s>%s</span>', (!$args['label']) ? ' class="sr-only"' : '', (int) $args['percent'] . '% ' . \__('Complete', 'bootstrap-3-shortcodes-for-wordpress')) : ''
        );
    }
}
