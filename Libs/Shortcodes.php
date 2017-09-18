<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs;

class Shortcodes implements \WordPress\Plugin\BootstrapShortcodes\Libs\Interfaces\ShortcodeInterface {
	/**
	 * Constructor
	 *
	 * @param boolean $init initialize the main class
	 */
	public function __construct($init = false) {
		if($init === true) {
			$this->init();
		}
	} // END public function __construct()

	public function init() {
//		$this->registerShortcodes($this->getShortcodeArray());
		$this->addFilter();
	}

	public function addFilter() {
		\add_filter('the_content', [$this, 'filterFixLinebreaks']);
	}

	public function filterFixLinebreaks($content) {
		$toReplace = array (
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']',
			']<br>' => ']'
		);

		$content = \strtr($content, $toReplace);

		return $content;
	}

	/**
	 * getting the supported shortcodes
	 *
	 * @return array Array with all supported shortcodes
	 */
	public function getShortcodeArray() {
		$shortcodes = array(
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
		foreach($shortcodes as $shortcode) {
			\add_shortcode($shortcode, array($this, 'shortcode' . \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\StringHelper::getInstance()->camelCase($shortcode, true)));
		} // END foreach($shortcodes as $shortcode)
	} // END public function registerShortcodes()
} // END class Shortcodes
