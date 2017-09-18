<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs\Shortcodes;

class Caret extends \WordPress\Plugin\BootstrapShortcodes\Libs\Shortcodes {
	/**
	 * Constructor
	 */
	public function __construct($addFilter = false) {
		parent::__construct($addFilter);

		$this->registerShortcodes($this->getShortcodeArray());
	} // END public function __construct()

	/**
	 * getting the supported shortcodes
	 *
	 * @return array Array with all supported shortcodes
	 */
	public function getShortcodeArray() {
		$shortcodes = array(
			'caret'
		);

		return $shortcodes;
	} // END private function getShortcodeArray()

	public function shortcodeCaret($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class = 'caret';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		return sprintf(
			'<span class="%1$s"%2$s>%3$s</span>',
			\esc_attr(\trim($class) ),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}
}
