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
}
