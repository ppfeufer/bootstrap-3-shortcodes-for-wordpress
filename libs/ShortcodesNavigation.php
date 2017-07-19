<?php


namespace WordPress\Plugin\BootstrapShortcodes\Libs;

class ShortcodesNavigation extends Shortcodes {
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
			'nav',
			'nav-item',
			'dropdown',
			'dropdown-header',
			'dropdown-item'
		);

		return $shortcodes;
	} // END private function getShortcodeArray()

	public function shortcodeNav( $atts, $content = null ) {
		$args = \shortcode_atts(
			array(
				'type' => false,
				'stacked' => false,
				'justified' => false,
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class  = 'nav';
		$class .= ($args['type'] !== false) ? ' nav-' . $args['type'] : ' nav-tabs';
		$class .= ($args['stacked'] !== false) ? ' nav-stacked' : '';
		$class .= ($args['justified'] !== false) ? ' nav-justified' : '';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<ul class="%s"%s>%s</ul>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode( $content )
		);
	}

	public function shortcodeNavItem( $atts, $content = null ) {
		$args = \shortcode_atts(
			array(
				'link' => false,
				'active' => false,
				'disabled' => false,
				'dropdown' => false,
				'xclass' => false,
				'data' => false
			), $atts
		);

		$liClasses  = '';
		$liClasses .= ($args['dropdown'] !== false) ? 'dropdown' : '';
		$liClasses .= ($args['active'] !== false)   ? ' active' : '';
		$liClasses .= ($args['disabled'] !== false) ? ' disabled' : '';

		$anchorClasses  = '';
		$anchorClasses .= ($args['dropdown'] !== false) ? ' dropdown-toggle' : '';
		$anchorClasses .= ($args['xclass'] !== false)   ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		# Wrong idea I guess ....
		#$pattern = ( $dropdown ) ? '<li%1$s><a href="%2$s"%3$s%4$s%5$s></a>%6$s</li>' : '<li%1$s><a href="%2$s"%3$s%4$s%5$s>%6$s</a></li>';

		//* If we have a dropdown shortcode inside the content we end the link before the dropdown shortcode, else all content goes inside the link
		$content = ($args['dropdown'] !== false) ? \str_replace( '[dropdown]', '</a>[dropdown]', $content) : $content . '</a>';

		return \sprintf(
			'<li%1$s><a href="%2$s"%3$s%4$s%5$s>%6$s</li>',
			(!empty($liClasses)) ? \sprintf(' class="%s"', \esc_attr($liClasses)) : '',
			\esc_url($args['link']),
			(!empty($anchorClasses))  ? \sprintf(' class="%s"', \esc_attr($anchorClasses))  : '',
			($args['dropdown'])   ? ' data-toggle="dropdown"' : '',
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}

	/**
	 * Shortcode:
	 *		[dropdown][/dropdown]
	 *
	 * Supported Arguments:
	 *		xclass
	 *		data
	 *
	 * @link http://getbootstrap.com/javascript/#dropdowns Bootstrap 3 Dropdown
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	public function shortcodeDropdown($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class  = 'dropdown-menu';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<ul role="menu" class="%s"%s>%s</ul>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	} // END public function shortcodeDropdown($atts, $content = null)

	/**
	 * Shortcode:
	 *		[dropdown-header][/dropdown-header]
	 *
	 * Supported Arguments:
	 *		xclass
	 *		data
	 *
	 * @link http://getbootstrap.com/javascript/#dropdowns Bootstrap 3 Dropdown
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	public function shortcodeDropdownHeader($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class  = 'dropdown-header';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<li class="%s"%s>%s</li>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	} // END public function shortcodeDropdownHeader($atts, $content = null)

	/**
	 * Shortcode:
	 *		[dropdown-item][/dropdown-item]
	 *
	 * Supported Arguments:
	 *		link
	 *		disabled
	 *		xclass
	 *		data
	 *
	 * @link http://getbootstrap.com/javascript/#dropdowns Bootstrap 3 Dropdown
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	public function shortcodeDropdownItem($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'link' => false,
				'disabled' => false,
				'xclass' => false,
				'data' => false
			), $atts
		);

		$liClass  = '';
		$liClass .= ($args['disabled'] !== false) ? ' disabled' : '';

		$anchorClass  = '';
		$anchorClass .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = $dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<li role="presentation" class="%s"><a role="menuitem" href="%s" class="%s"%s>%s</a></li>',
			\esc_attr($liClass),
			\esc_url($args['link']),
			\esc_attr($anchorClass),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	} // END public function shortcodeDropdownItem($atts, $content = null)
} // END class
