<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs\Shortcodes;

class Alert extends \WordPress\Plugin\BootstrapShortcodes\Libs\Shortcodes {
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
			'alert'
		);

		return $shortcodes;
	} // END private function getShortcodeArray()

	/**
	 * Shortcode:
	 *		[alert]Lorem Ipsum[/alert]
	 *
	 * Supported Arguments:
	 *		type			success, info, warning, danger (default: success)
	 *		dismissable		true/false
	 *		xclass
	 *		data
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

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		return \sprintf(
			'<div class="%1$s"%2$s>%3$s%4$s</div>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			$dismissableButton,
			\do_shortcode($content)
		);
	} // END public function shortcodeAlert($atts, $content = null)
}
