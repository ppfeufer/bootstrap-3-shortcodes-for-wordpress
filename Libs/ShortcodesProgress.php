<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs;

/**
 * Bootstrap Progress Bars
 *
 * @see http://getbootstrap.com/components/#progress
 */
class ShortcodesProgress extends Shortcodes {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();

		$this->registerShortcodes($this->getShortcodeArray());
	} // END public function __construct()

	/**
	 * getting the supported shortcodes
	 *
	 * @return array Array with all supported shortcodes
	 */
	private function getShortcodeArray() {
		$shortcodes = array(
			'progress',
			'progress-bar'
		);

		return $shortcodes;
	} // END private function getShortcodeArray()

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
		$class .= ($args['striped'] !== false)  ? ' progress-striped' : '';
		$class .= ($args['animated'] !== false) ? ' active' : '';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		return sprintf(
			'<div class="%s"%s>%s</div>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}

	public function shortcodeProgressBar($atts, $content = null) {
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
		$class .= ($args['type'] !== false)   ? ' progress-bar-' . $args['type'] : '';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		return sprintf(
			'<div class="%s" role="progressbar" %s%s>%s</div>',
			\esc_attr(trim($class)),
			($args['percent'] !== false) ? ' aria-value="' . (int) $args['percent'] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . (int) $args['percent'] . '%;"' : '',
			($dataProps !== null) ? ' ' . $dataProps : '',
			($args['percent'] !== false) ? \sprintf('<span%s>%s</span>', (!$args['label']) ? ' class="sr-only"' : '', (int) $args['percent'] . '% ' . \__('Complete', 'bootstrap-3-shortcodes-for-wordpress')) : ''
		);
	}
} // END class
