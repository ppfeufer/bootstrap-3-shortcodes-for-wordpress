<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs\Shortcodes;

class Badge extends \WordPress\Plugin\BootstrapShortcodes\Libs\Shortcodes {
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
			'badge'
		);

		return $shortcodes;
	} // END private function getShortcodeArray()

	/**
	 * Shortcode:
	 *		[badge]42[/badge]
	 *
	 * Supported Arguments:
	 *		right	true/false (Default: false) / pull the badge to the right side or not
	 *		xclass
	 *		data
	 *
	 * @link http://getbootstrap.com/components/#badges Bootstrap 3 Badges
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	public function shortcodeBadge($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'right' => false,
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class = 'badge';
		$class .= ($args['right'] !== false) ? ' pull-right' : '';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		return \sprintf(
			'<span class="%1$s"%2$s>%3$s</span>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	} // END public function shortcodeBadge($atts, $content = null)
}
