<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs;

/**
 * Bootstrap Progress Bars
 *
 * @see http://getbootstrap.com/components/#progress
 */
class ShortcodesList extends Shortcodes {
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
	private function getShortcodeArray() {
		$shortcodes = array(
			'list-group',
			'list-group-item',
			'list-group-item-heading',
			'list-group-item-text'
		);

		return $shortcodes;
	} // END private function getShortcodeArray()

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

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

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
		$class .= ($args['active'] !== false)   ? ' active' : '';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

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

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

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

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		return \sprintf(
			'<p class="%s"%s>%s</p>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}
} // END class
