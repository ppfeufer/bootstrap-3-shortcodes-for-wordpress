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
			'breadcrumb',
			'breadcrumb-item',
			'button',
			'button-group',
			'button-toolbar',
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

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<span class="%1$s"%2$s>%3$s</span>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}

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
	function shortcodeBreadcrumb($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class = 'breadcrumb';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<ol class="%1$s"%2$s>%3$s</ol>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}

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
	function shortcodeBreadcrumbItem($atts, $content = null) {
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
		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

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
	}

	/**
	 * Shortcode:
	 *		[button][/button]
	 *
	 * Supported Arguments:
	 *		type
	 *		size
	 *		block
	 *		dropdown
	 *		target
	 *		disabled
	 *		title
	 *		link
	 *		active
	 *		xclass
	 *		data
	 *
	 * @link http://getbootstrap.com/components/#btn-groups Bootstrap 3 Button Groups
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function shortcodeButton($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'type' => false,
				'size' => false,
				'block' => false,
				'dropdown' => false,
				'target' => false,
				'disabled' => false,
				'title' => false,
				'link' => false,
				'active' => false,
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class = 'btn';
		$class .= ($args['type'] !== false) ? ' btn-' . $args['type'] : ' btn-default';
		$class .= ($args['size'] !== false) ? ' btn-' . $args['size'] : '';
		$class .= ($args['block'] !== false) ? ' btn-block' : '';
		$class .= ($args['dropdown'] !== false) ? ' dropdown-toggle' : '';
		$class .= ($args['disabled'] !== false) ? ' disabled' : '';
		$class .= ($args['active'] !== false) ? ' active' : '';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<a href="%1$s" class="%2$s"%3$s%4$s%5$s>%6$s</a>',
			\esc_url($args['link']),
			\esc_attr(\trim($class)),
			($args['target'] !== false) ? \sprintf(' target="%s"', \esc_attr($args['target'])) : '',
			($args['title'] !== false) ? \sprintf(' title="%s"', \esc_attr($args['title'])) : '',
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}

	/**
	 * Shortcode:
	 *		[button-group][/button-group]
	 *
	 * Supported Arguments:
	 *		size
	 *		vertical
	 *		justified
	 *		dropup
	 *		xclass
	 *		data
	 *
	 * @link http://getbootstrap.com/components/#btn-groups Bootstrap 3 Button Groups
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function shortcodeButtonGroup($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'size' => false,
				'vertical' => false,
				'justified' => false,
				'dropup' => false,
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class  = 'btn-group';
		$class .= ($args['size'] !== false) ? ' btn-group-' . $args['size'] : '';
		$class .= ($args['vertical'] !== false) ? ' btn-group-vertical' : '';
		$class .= ($args['justified'] !== false) ? ' btn-group-justified' : '';
		$class .= ($args['dropup'] !== false) ? ' dropup' : '';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<div class="%1$s"%2$s>%3$s</div>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}

	/**
	 * Shortcode:
	 *		[button-toolbar][/button-toolbar]
	 *
	 * Supported Arguments:
	 *		xclass
	 *		data
	 *
	 * @link http://getbootstrap.com/components/#btn-groups-toolbar Bootstrap 3 Button Toolbar
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function shortcodeButtonToolbar($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class  = 'btn-toolbar';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return sprintf(
			'<div class="%1$s"%2$s>%3$s</div>',
			\esc_attr(\trim($class) ),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}
} // END class Shortcodes
