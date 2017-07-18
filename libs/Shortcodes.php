<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs;

class Shortcodes {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->registerShortcodes();
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
//			'breadcrumb',
//			'breadcrumb-item',
//			'button',
//			'button-group',
//			'button-toolbar',
//			'caret',
//			'carousel',
//			'carousel-item',
//			'code',
//			'collapse',
//			'collapsibles',
//			'column',
//			'container',
//			'container-fluid',
//			'divider',
//			'dropdown',
//			'dropdown-header',
//			'dropdown-item',
//			'emphasis',
//			'icon',
//			'img',
//			'embed-responsive',
//			'jumbotron',
//			'label',
//			'lead',
//			'list-group',
//			'list-group-item',
//			'list-group-item-heading',
//			'list-group-item-text',
//			'media',
//			'media-body',
//			'media-object',
//			'modal',
//			'modal-footer',
//			'nav',
//			'nav-item',
//			'page-header',
//			'panel',
//			'popover',
//			'progress',
//			'progress-bar',
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
	public function registerShortcodes() {
		$shortcodes = $this->getShortcodeArray();

		foreach($shortcodes as $shortcode) {
			\add_shortcode($shortcode, array($this, 'shortcode' . \WordPress\Plugin\BootstrapShortcodes\Helper\StringHelper::camelCase($shortcode, true)));
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

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<div class="%1$s"%2$s>%3$s%4$s</div>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			$dismissableButton,
			\do_shortcode($content)
		);
	}

	/**
	 * Shortcode:
	 *		[badge]42[/badge]
	 *
	 * Supported Arguments:
	 *		right	true/false (Default: false) / pull the badge to teh right side or not
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
		$class .= ($args['xclass'] ) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<span class="%1$s"%2$s>%3$s</span>',
			\esc_attr(trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}
} // END class Shortcodes
