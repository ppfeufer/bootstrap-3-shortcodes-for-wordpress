<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs;

class Shortcodes {
	public function __construct() {
		$this->registerShortcodes();
	} // END public function __construct()

	private function getShortcodeArray() {
		$shortcodes = array(
			'alert',
			'badge',
			'breadcrumb',
			'breadcrumb-item',
			'button',
			'button-group',
			'button-toolbar',
			'caret',
			'carousel',
			'carousel-item',
			'code',
			'collapse',
			'collapsibles',
			'column',
			'container',
			'container-fluid',
			'divider',
			'dropdown',
			'dropdown-header',
			'dropdown-item',
			'emphasis',
			'icon',
			'img',
			'embed-responsive',
			'jumbotron',
			'label',
			'lead',
			'list-group',
			'list-group-item',
			'list-group-item-heading',
			'list-group-item-text',
			'media',
			'media-body',
			'media-object',
			'modal',
			'modal-footer',
			'nav',
			'nav-item',
			'page-header',
			'panel',
			'popover',
			'progress',
			'progress-bar',
			'responsive',
			'row',
			'span',
			'tab',
			'table',
			'table-wrap',
			'tabs',
			'thumbnail',
			'tooltip',
			'well',
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
} // END class Shortcodes
