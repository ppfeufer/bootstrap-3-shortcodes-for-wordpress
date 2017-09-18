<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs\Shortcodes;

class Code extends \WordPress\Plugin\BootstrapShortcodes\Libs\Shortcodes {
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
			'code'
		);

		return $shortcodes;
	} // END private function getShortcodeArray()

	public function shortcodeCode($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'inline'  => false,
				'scrollable' => false,
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class = '';
		$class .= ($args['scrollable'] !== false) ? ' pre-scrollable' : '';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);
		$codeString = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->removeLinebreaksFromCode($content);

		return \sprintf(
			'<%1$s class="%2$s"%3$s>%4$s</%1$s>',
			($args['inline'] !== false) ? 'code' : 'pre',
			\esc_attr(\trim($class) ),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($codeString)
		);
	}
}
