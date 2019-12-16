<?php

namespace A3Rev\RShortcode;

class Dividers {

	public static $args;
	public static $attr;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 'responsi_list_shortcode', array($this, '_shortcode_hook') );
		add_filter( 'responsi_shortcode_attr_separator-shortcode', array( $this, 'attr' ) );
		add_filter( 'responsi_shortcode_attr_separator-shortcode-shadow', array( $this, 'attr_shadow' ) );
		add_filter( 'responsi_shortcode_attr_separator-shortcode-icon-wrapper', array( $this, 'icon_wrapper_attr' ) );
		add_filter( 'responsi_shortcode_attr_separator-shortcode-icon', array( $this, 'icon_attr' ) );
		add_shortcode( 'a3_divider', array( $this, 'render' ) );
	}

	public function _filter_field_google_webfonts( $fields ){
		return $fields;
	}

	public static function _shortcode_hook( $responsi_list_shortcode ){
		$responsi_list_shortcode[] = 'a3_divider';
		return $responsi_list_shortcode;
	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		do_action('_front_enqueue_css_and_js');
		$defaults =	\A3Rev\RShortcode\HookFunction::set_shortcode_defaults(
			array(
				'class'			=> '',
				'id'			=> '',
				'type'			=> 'none',
				'margin_top'	=> '0px',
				'margin_bottom'	=> '0px',
				'color'			=> '#555555',
				'width'			=> '',
				'icon'			=> '',
				'iconcolor'		=> '#e0dede',
				'iconbackground'=> '#ffffff',
				'iconborder'	=> '#e0dede',
			), $args
		);

		extract( $defaults );

		if( $iconbackground == '' || $iconbackground == 'transparent' ){
			$iconbackground = '#ffffff';
			$defaults['iconbackground'] = '#ffffff';
		}

		self::$args = $defaults;

		if ( $icon && $type != 'none' ) {
			$icon_insert = sprintf( '<span %s><i %s></i></span>', \A3Rev\RShortcode\HookFunction::attributes( 'separator-shortcode-icon-wrapper' ), \A3Rev\RShortcode\HookFunction::attributes( 'separator-shortcode-icon' ) );
		} else {
			$icon_insert = '';
		}

		$shadow_wrap = '';
		if ( $type == 'shadow' ) {
			$shadow_wrap = sprintf( '<div class="sepshadow" %s></div>', \A3Rev\RShortcode\HookFunction::attributes( 'separator-shortcode-shadow' ) );
		}

		$html = sprintf( '<div %s></div><div %s>%s%s</div>', \A3Rev\RShortcode\HookFunction::attributes( 'responsi-sep-clear' ), \A3Rev\RShortcode\HookFunction::attributes( 'separator-shortcode' ), $icon_insert, $shadow_wrap );

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'responsi-separator' );
		$attr['style'] = '';


		if( ! self::$args['width'] || self::$args['width'] == '100%' ) {
			$attr['class'] .= ' responsi-full-width-sep';
		}

		$styles = explode( '|', self::$args['type'] );

		if( ! in_array( 'none', $styles ) &&
			! in_array( 'single', $styles ) &&
			! in_array( 'double', $styles ) &&
			! in_array( 'shadow', $styles )
		) {
			$styles[] .= 'single';
		}

		foreach ( $styles as $style ) {
			$attr['class'] .= ' sep-' . $style;
		}

		if( self::$args['color'] ) {
			$attr['style'] = sprintf( 'border-color:%s;', self::$args['color'] );
		}

		$attr['style'] .= sprintf( 'margin-top:%s;', self::$args['margin_top'] );

		if( self::$args['margin_bottom'] ) {
			$attr['style'] .= sprintf( 'margin-bottom:%s;', self::$args['margin_bottom'] );
		}

		if( self::$args['width'] ) {
			$attr['style'] .= sprintf( 'max-width:%s;', self::$args['width'] );
		}

		if( self::$args['type'] == 'shadow' ) {
			$attr['style'] .= "
				background: none;
				background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(150, 150, 150, 0)), color-stop(15%, ".self::$args['color']."), color-stop(50%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.65)."), color-stop(85%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.1)."), color-stop(100%, rgba(150, 150, 150, 0)));
				background: -webkit-linear-gradient(left, rgba(150, 150, 150, 0) 0%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.1)." 15%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.65)." 50%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.1)." 85%, rgba(150, 150, 150, 0) 100%);
				background: -moz-linear-gradient(left, rgba(150, 150, 150, 0) 0%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.1)." 15%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.65)." 50%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.1)." 85%, rgba(150, 150, 150, 0) 100%);
				background: -ms-linear-gradient(left, rgba(150, 150, 150, 0) 0%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.1)." 15%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.65)." 50%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.1)." 85%, rgba(150, 150, 150, 0) 100%);
				background: -o-linear-gradient(left, rgba(150, 150, 150, 0) 0%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.1)." 15%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.65)." 50%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.1)." 85%, rgba(150, 150, 150, 0) 100%);
				background: linear-gradient(left, rgba(150, 150, 150, 0) 0%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.1)." 15%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.65)." 50%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.1)." 85%, rgba(150, 150, 150, 0) 100%);
				filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00".str_replace('#','',self::$args['color'])."', endColorstr='#00".str_replace('#','',self::$args['color'])."', GradientType=1);
			";
		}

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}

		return $attr;

	}

	function attr_shadow() {

		$attr = array();

		if( self::$args['type'] == 'shadow' ) {
			$attr['style'] = "
				background: none;
				background: -webkit-radial-gradient(ellipse at 50% -50%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.7)." 0px, rgba(255, 255, 255, 0) 80%);
			    background: -moz-radial-gradient(ellipse at 50% -50%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.7)." 0px, rgba(255, 255, 255, 0) 80%);
			    background: -o-radial-gradient(ellipse at 50% -50%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.7)." 0px, rgba(255, 255, 255, 0) 80%);
			    background: radial-gradient(ellipse at 50% -50%, ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['color'],0.7)." 0px, rgba(255, 255, 255, 0) 80%);
			";
		}

		return $attr;

	}

	function icon_wrapper_attr() {

		$attr = array();

		$attr['class'] = 'icon-wrapper';

		$attr['style'] = sprintf( 'border-color:%s;', self::$args['iconborder'] );
		$attr['style'] .= sprintf( 'background-color:%s;', self::$args['iconbackground'] );
		$attr['style'] .= sprintf( 'color:%s;', self::$args['iconcolor'] );

		return $attr;

	}

	function icon_attr() {

		$attr = array();

		$attr['class'] = sprintf( 'shortcode-icon shortcode-icon-%s', self::$args['icon'] );

		$attr['style'] = sprintf( 'color:%s;', self::$args['iconcolor'] );

		return $attr;

	}
}

?>
