<?php

namespace WordPress\Plugin\BootstrapShortcodes\Libs;

class Shortcodes {
	private $carouselCount = null;
	private $carouselDefaultCount = null;
	private $carouselDefaultActive = true;

	private $accordionCount = null;
	private $accordionGroupCount = null;

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
			'accordion',
			'accordion-group',
			'accordion-item',
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

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

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

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

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

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<div class="%1$s"%2$s id="%3$s" role="tabpanel" aria-labelledby="%5$s"><div class="panel-body">%5$s</div></div>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			'collapse' . $this->accordionCount,
			'heading' . $this->accordionCount,
			\do_shortcode($content)
		);
	}

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

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<span class="%1$s"%2$s>%3$s</span>',
			\esc_attr(\trim($class)),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	} // END public function shortcodeBadge($atts, $content = null)

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

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

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
	} // END public function shortcodeBreadcrumbItem($atts, $content = null)

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
	public function shortcodeButton($atts, $content = null) {
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
	} // END public function shortcodeButton($atts, $content = null)

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
	public function shortcodeButtonGroup($atts, $content = null) {
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
	} // END public function shortcodeButtonGroup($atts, $content = null)

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
	public function shortcodeButtonToolbar($atts, $content = null) {
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
	} // END public function shortcodeButtonToolbar($atts, $content = null)

	public function shortcodeCaret($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class  = 'caret';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return sprintf(
			'<span class="%1$s"%2$s>%3$s</span>',
			\esc_attr(\trim($class) ),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}

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

		$divClass  = 'carousel slide';
		$divClass .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$innerClass = 'carousel-inner';

		$elementId = 'bootstrap-carousel-'. $this->carouselCount;

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);
		$attributeMap = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::getAttributeMap($content);

		// Extract the slide titles for use in the carousel widget.
		if($attributeMap) {
			$indicators = array();
			$this->carouselDefaultActive = true;

			foreach($attributeMap as $check) {
				if(!empty($check['carousel-item']['active'])) {
					$this->carouselDefaultActive = false;
				}
			}

			$i = 0;
			foreach($attributeMap as $slide) {
				$indicators[] = \sprintf(
					'<li class="%1$s" data-target="%2$s" data-slide-to="%3$s"></li>',
					(!empty($slide['carousel-item']['active']) || ($this->carouselDefaultActive && $i == 0)) ? 'active' : '',
					\esc_attr('#' . $elementId),
					\esc_attr($i)
				);

				$i++;
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

		$class  = 'item';
		$class .= ($args['active'] !== false) ? ' active' : '';
		$class .= ($args['xclass'] !== false) ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

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

	public function shortcodeCode($atts, $content = null) {
		$args = \shortcode_atts(
			array(
				'inline'  => false,
				'scrollable' => false,
				'xclass' => false,
				'data' => false
			), $atts
		);

		$class  = '';
		$class .= ($args['scrollable'] !== false)  ? ' pre-scrollable' : '';
		$class .= ($args['xclass'] !== false)   ? ' ' . $args['xclass'] : '';

		$dataProps = \WordPress\Plugin\BootstrapShortcodes\Helper\ShortcodeHelper::parseDataAttributes($args['data']);

		return \sprintf(
			'<%1$s class="%2$s"%3$s>%4$s</%1$s>',
			($args['inline'] !== false) ? 'code' : 'pre',
			\esc_attr(\trim($class) ),
			($dataProps !== null) ? ' ' . $dataProps : '',
			\do_shortcode($content)
		);
	}
} // END class Shortcodes
