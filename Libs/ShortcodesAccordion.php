<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs;

class ShortcodesAccordion extends Shortcodes {
	private $accordionCount = null;
	private $accordionGroupCount = null;

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
			'accordion',
			'accordion-group',
			'accordion-item'
		);

		return $shortcodes;
	} // END private function getShortcodeArray()

	public function shortcodeAccordion($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'title' => false,
				'xclass' => false,
				'data' => false
			), $atts
		);

		$this->accordionCount = \uniqid();

		$class = 'panel panel-default bootstrap-accordion';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		return \sprintf(
			'<div class="%1$s"%2$s><div class="panel-heading" role="tab" id="%3$s"><h4 class="panel-title"><a class="bootstrap-accordion-title collapsed" role="button" data-toggle="collapse" data-parent="%4$s" href="%5$s" aria-expanded="false" aria-controls="%6$s">%7$s<span class="caret collapse-toggle" data-toggle="collapse"><i></i></span></a></h4></div>%8$s</div>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			'heading' . $this->accordionCount,
			'#accordion-' . $this->accordionGroupCount,
			'#collapse' . $this->accordionCount,
			'collapse' . $this->accordionCount,
			($args['title'] !== false) ? ' ' . $args['title'] : '',
			\do_shortcode($content)
		);
	}

	public function shortcodeAccordionGroup($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'xclass' => false,
				'data' => false
			), $atts
		);

		$this->accordionGroupCount = \uniqid();

		$class = 'panel-group';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		return \sprintf(
			'<div class="%1$s" id="%2$s"%3$s role="tablist" aria-multiselectable="true">%4$s</div>',
			\esc_attr(\trim($class)),
			'accordion-' . $this->accordionGroupCount,
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}

	public function shortcodeAccordionItem($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class = 'panel-collapse collapse';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		return \sprintf(
			'<div class="%1$s"%2$s id="%3$s" role="tabpanel" aria-labelledby="%5$s"><div class="panel-body">%5$s</div></div>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			'collapse' . $this->accordionCount,
			'heading' . $this->accordionCount,
			\do_shortcode($content)
		);
	}
}
