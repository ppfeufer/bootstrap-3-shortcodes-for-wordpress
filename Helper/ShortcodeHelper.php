<?php

namespace WordPress\Plugin\BootstrapShortcodes\Helper;

class ShortcodeHelper {
	public static function parseDataAttributes($data) {
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
	 *		shortcodeCarousel
	 *		shortcodeTabs
	 *
	 * @param string $string
	 * @param type $att
	 * @return type
	 */
	public static function getAttributeMap($string) {
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
}
