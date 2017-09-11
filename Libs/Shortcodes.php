<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs;

class Shortcodes {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->registerShortcodes($this->getShortcodeArray());
	} // END public function __construct()

	/**
	 * getting the supported shortcodes
	 *
	 * @return array Array with all supported shortcodes
	 */
	private function getShortcodeArray() {
		$shortcodes = array(
			'alert',
			'badge',
			'caret',
			'code',
//			'collapse',
//			'collapsibles',
//			'column',
//			'container',
//			'container-fluid',
//			'divider',
//			'emphasis',
//			'icon',
//			'img',
//			'embed-responsive',
//			'jumbotron',
//			'label',
//			'lead',
//			'media',
//			'media-body',
//			'media-object',
//			'modal',
//			'modal-footer',
//			'page-header',
//			'panel',
//			'popover',
//			'responsive',
//			'row',
//			'span',
//			'tab',
//			'table',
//			'table-wrap',
//			'tabs',
//			'thumbnail',
//			'tooltip',
//			'well',
		);

		return $shortcodes;
	} // END private function getShortcodeArray()

	/**
	 * register all shortcodes
	 */
	public function registerShortcodes($shortcodes) {
//		$shortcodes = $this->getShortcodeArray();

		foreach($shortcodes as $shortcode) {
			\add_shortcode($shortcode, array($this, 'shortcode' . \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\StringHelper::getInstance()->camelCase($shortcode, true)));
		} // END foreach($shortcodes as $shortcode)
	} // END public function registerShortcodes()

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
		$class .= ($args['scrollable'] !== false)  ? ' pre-scrollable' : '';
		$class .= ($args['xclass'] !== false)   ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		return \sprintf(
			'<%1$s class="%2$s"%3$s>%4$s</%1$s>',
			($args['inline'] !== false) ? 'code' : 'pre',
			\esc_attr(\trim($class) ),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}
} // END class Shortcodes
