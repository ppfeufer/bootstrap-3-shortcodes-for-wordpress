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

namespace WordPress\Plugins\BootstrapShortcodes\Libs\Helper;

class ShortcodeHelper extends \WordPress\Plugins\BootstrapShortcodes\Libs\Singletons\AbstractSingleton {
    public function parseDataAttributes($data) {
        $dataProps = null;

        if(!empty($data)) {
            $data = \explode('|', $data);

            foreach($data as $d) {
                $d = \explode(',', $d);
                $dataProps .= \sprintf('data-%1$s="%2$s" ', \esc_html($d[0]), \esc_attr(\trim($d[1])));
            }
        }

        return $dataProps;
    }

    /**
     * Create attributes map so we can get the attributes of a wrapped shortcode
     *
     * Used by:
     *      shortcodeCarousel
     *      shortcodeTabs
     *
     * @param string $string
     * @param type $att
     * @return type
     */
    public function getAttributeMap($string) {
        $res = array();
        $return = array();
        $reg = \get_shortcode_regex();
        \preg_match_all('~' . $reg . '~', $string, $matches);

        foreach($matches[2] as $key => $name) {
            $parsed = \shortcode_parse_atts($matches[3][$key]);
            $parsed = \is_array($parsed) ? $parsed : array();

            $res[$name] = $parsed;
            $return[] = $res;
        }

        return $return;
    }

    public function removeLinebreaksFromCode($code) {
        $toReplace = array (
            '<p>' => '',
            '</p>' => '',
            '<br />' => '',
            '<br>' => ''
        );

        $code = \strtr($code, $toReplace);

        return $code;
    }
}
