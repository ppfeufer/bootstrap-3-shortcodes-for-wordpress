<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs;

class ShortcodesBreadcrumb extends Shortcodes {
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
			'breadcrumb',
			'breadcrumb-item'
		);

		return $shortcodes;
	} // END private function getShortcodeArray()

	/**
	 * Shortcode:
	 *		[breadcrumb][/breadcrumb]
	 *
	 * Supported Arguments:
	 *		xclass
	 *		data
	 *
	 * @link http://getbootstrap.com/components/#breadcrumbs Bootstrap 3 Breadcrumbs
	 * @depends shortcodeBreadcrumbItem
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	public function shortcodeBreadcrumb($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class = 'breadcrumb';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		return \sprintf(
			'<ol class="%1$s"%2$s>%3$s</ol>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	} // END public function shortcodeBreadcrumb($atts, $content = null)

	/**
	 * Shortcode:
	 *		[breadcrumb-item][/breadcrumb-item]
	 *
	 * Supported Arguments:
	 *		link
	 *		active
	 *		xclass
	 *		data
	 *
	 * @link http://getbootstrap.com/components/#breadcrumbs Bootstrap 3 Breadcrumbs
	 * @depends shortcodeBreadcrumb
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	public function shortcodeBreadcrumbItem($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'link' => false,
				'active' => false,
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class = '';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$active = ($args['active'] !== false) ? ' class="active"' : '';
		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		$link = ($args['link']) ? \sprintf('<a href="%1$s" class="%2$s"%3$s>%4$s</a>',
			\esc_url($args['link']),
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		) : \do_shortcode($content);

		return \sprintf(
			'<li%1$s>%2$s</li>',
			$active,
			$link
		);
	} // END public function shortcodeBreadcrumbItem($atts, $content = null)
}
