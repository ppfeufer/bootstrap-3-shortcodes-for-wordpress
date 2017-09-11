<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs;

class ShortcodesCarousel extends Shortcodes {
	private $carouselCount = null;
	private $carouselDefaultCount = null;
	private $carouselDefaultActive = true;

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
			'carousel',
			'carousel-item'
		);

		return $shortcodes;
	} // END private function getShortcodeArray()

	/**
	 * Shortcode:
	 *		[carousel][/carousel]
	 *
	 * Supported Arguments:
	 *		interval
	 *		pause
	 *		wrap
	 *		xclass
	 *		data
	 *
	 * @link http://getbootstrap.com/javascript/#carousel Bootstrap 3 Carousel
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	public function shortcodeCarousel($atts, $content = null) {
		$this->carouselCount = \uniqid();

		$this->carouselDefaultCount = 0;

		$args = \shortcode_atts(
			array(
				'interval' => false,
				'pause'  => false,
				'wrap' => false,
				'xclass' => false,
				'data' => false
			), $atts
		);

		$divClass = 'carousel slide';
		$divClass .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$innerClass = 'carousel-inner';

		$elementId = 'bootstrap-carousel-'. $this->carouselCount;

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);
		$attributeMap = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->getAttributeMap($content);

		// Extract the slide titles for use in the carousel widget.
		if($attributeMap) {
			$indicators = array();
			$this->carouselDefaultActive = true;

			foreach($attributeMap as $check) {
				if(!empty($check['carousel-item']['active'])) {
					$this->carouselDefaultActive = false;
				}
			}

			$count = 0;
			foreach($attributeMap as $slide) {
				$indicators[] = \sprintf(
					'<li class="%1$s" data-target="%2$s" data-slide-to="%3$s"></li>',
					(!empty($slide['carousel-item']['active']) || ($this->carouselDefaultActive && $count == 0)) ? 'active' : '',
					\esc_attr('#' . $elementId),
					\esc_attr($count)
				);

				$count++;
			}
		}

		return \sprintf(
			'<div class="%1$s" id="%2$s" data-ride="carousel"%3$s%4$s%5$s%6$s>%7$s<div class="%8$s">%9$s</div>%10$s%11$s</div>',
			\esc_attr($divClass),
			\esc_attr($elementId),
			($args['interval'] !== false) ? \sprintf(' data-interval="%1$d"', $args['interval']) : '',
			($args['pause'] !== false) ? \sprintf(' data-pause="%1$s"', \esc_attr($args['pause'])) : '',
			($args['wrap'] !== false) ? \sprintf(' data-wrap="%1$s"', \esc_attr($args['wrap'])) : '',
			($dataProps !== null) ? ' ' . $dataProps : '',
			(\count($indicators) > 0) ? '<ol class="carousel-indicators">' . \implode($indicators) . '</ol>' : '',
			\esc_attr($innerClass),
			\do_shortcode($content),
			'<a class="left carousel-control" href="' . \esc_url('#' . $elementId) . '" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>',
			'<a class="right carousel-control" href="' . \esc_url('#' . $elementId) . '" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>'
		);
	}

	/**
	 * Shortcode:
	 *		[carousel-item][/carousel-item]
	 *
	 * Supported Arguments:
	 *		active
	 *		caption
	 *		xclass
	 *		data
	 *
	 * @link http://getbootstrap.com/javascript/#carousel Bootstrap 3 Carousel
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	public function shortcodeCarouselItem($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'active'  => false,
				'caption' => false,
				'xclass' => false,
				'data' => false
			), $atts
		);

		if($this->carouselDefaultActive && $this->carouselDefaultCount == 0 ) {
			$args['active'] = true;
		}

		$this->carouselDefaultCount++;

		$class = 'item';
		$class .= ($args['active'] !== false) ? ' active' : '';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Libs\Helper\ShortcodeHelper::getInstance()->parseDataAttributes($args['data']);

		//$content = preg_replace('/class=".*?"/', '', $content);
		$content = \preg_replace('/alignnone/', '', $content);
		$content = \preg_replace('/alignright/', '', $content);
		$content = \preg_replace('/alignleft/', '', $content);
		$content = \preg_replace('/aligncenter/', '', $content);

		return \sprintf(
			'<div class="%1$s"%2$s>%3$s%4$s</div>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content),
			($args['caption'] !== false) ? '<div class="carousel-caption">' . \esc_html($args['caption']) . '</div>' : ''
		);
	}
}
