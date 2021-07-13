<?php

namespace A3Rev\RShortcode;

class Infobox {

	public static $args;
	public static $attr;
	private $infobox_box_counter = 1;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 'responsi_list_shortcode', array($this, '_shortcode_hook') );
		add_filter( 'responsi_shortcode_attr_infobox-container-shortcode', array( $this, 'attr' ) );
		add_filter( 'responsi_shortcode_attr_infobox-icon-shortcode', array( $this, 'infobox_icon_attr' ) );
		add_filter( 'responsi_shortcode_attr_infobox-shortcode', array( $this, 'infobox_attr' ) );

		add_shortcode( 'a3_infobox', array( $this, 'render' ) );
	}

	public static function _shortcode_hook( $responsi_list_shortcode ){
		$responsi_list_shortcode[] = 'a3_infobox';
		return $responsi_list_shortcode;
	}

	public function _filter_field_google_webfonts( $fields ){
		return $fields;
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
				'class'					=> '',
				'id'					=> '',
				'background'			=> 'transparent',
				'bordertopsize' 		=> '0px',
				'bordertopstyle' 		=> 'solid',
				'bordertopcolor' 		=> '#a0ce4e',
				'borderbottomsize' 		=> '0px',
				'borderbottomstyle' 	=> 'solid',
				'borderbottomcolor' 	=> '#e8e6e6',
				'borderleftsize' 		=> '0px',
				'borderleftstyle' 		=> 'solid',
				'borderleftcolor' 		=> '#e8e6e6',
				'borderrightsize' 		=> '0px',
				'borderrightstyle' 		=> 'solid',
				'borderrightcolor' 		=> '#e8e6e6',
				'corner' 					=> 'false',
				'border_corner' 			=> '0',
				'defaultshadow' 		=> 'no',
				'defaultshadowcolor' 	=> '#555555',
				'defaultshadowopacity' 	=> '0.7',
				'customshadow' 			=> 'false',
				'customshadowh' 		=> '0',
				'customshadowv' 		=> '0',
				'customshadowblur' 		=> '0',
				'customshadowspread' 	=> '0',
				'customshadowinset' 	=> 'inset',
				'customshadowcolor' 	=> '#dbdbdb',
				'padding' 				=> 'no',
				'padding_top' 			=> '0px',
				'padding_bottom' 		=> '0px',
				'padding_left' 			=> '0px',
				'padding_right' 		=> '0px',
				'margin' 				=> 'no',
				'margin_top' 			=> '0px',
				'margin_bottom' 		=> '0px',
				'margin_left' 			=> '0px',
				'margin_right' 			=> '0px',
				'icon' 					=> '',
				'iconcolor' 			=> '#a0ce4e',
				'iconsize' 				=> '18px',
				'iconposition' 			=> 'top',
			), $args
		);

		$defaults = array_map( 'esc_attr', $defaults );

		self::$args = $defaults;

		extract( $defaults );

		$styles = '';
		$shadow_html = '';
		if( self::$args['defaultshadow'] == 'yes' && self::$args['customshadow'] != 'true' ) {
			//$styles = "<style type='text/css'>.infobox-container-{$this->infobox_box_counter} .element-bottomshadow:before,.infobox-container-{$this->infobox_box_counter} .element-bottomshadow:after{opacity:".$defaultshadowopacity.";-webkit-box-shadow: 0 17px 10px ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['defaultshadowcolor'],0.7).";box-shadow: 0 17px 10px ".\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['defaultshadowcolor'],0.7).";}</style>";
			$shadow_html = '<div class="element-bottomshadowbefore" style="opacity:'.$defaultshadowopacity.';-webkit-box-shadow: 0 17px 10px '.\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['defaultshadowcolor'],0.7).';box-shadow: 0 17px 10px '.\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['defaultshadowcolor'],0.7).';"></div>';
			$shadow_html .= '<div class="element-bottomshadowafter" style="opacity:'.$defaultshadowopacity.';-webkit-box-shadow: 0 17px 10px '.\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['defaultshadowcolor'],0.7).';box-shadow: 0 17px 10px '.\A3Rev\RShortcode\HookFunction::hex2rgba(self::$args['defaultshadowcolor'],0.7).';"></div>';
			//self::$args['margin_bottom'] = (15 + str_replace("px", "", $margin_bottom)).'px';
		}

		$icon_html = '';
		if( $icon != '') {
			$icon_html = sprintf( '<i class="responsi-shortcode-icon shortcode-icon-%s"%s></i>', $icon, \A3Rev\RShortcode\HookFunction::attributes( 'infobox-icon-shortcode' ) );
		}

		$html = sprintf('<div %s><div %s>%s%s<div class="clear"></div>%s</div></div>', \A3Rev\RShortcode\HookFunction::attributes( 'infobox-container-shortcode' ), \A3Rev\RShortcode\HookFunction::attributes( 'infobox-shortcode' ), $icon_html, do_shortcode( $content ), $shadow_html );

		$this->infobox_box_counter++;

		return $html;

	}

	function attr() {

		$attr = array();

		// FIXXXME had clearfix class; group mixin working?
		$attr['class'] = 'responsi-infobox-container infobox-container-' . $this->infobox_box_counter;

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}

		return $attr;

	}

	function infobox_attr() {
		$attr = array();

		$attr['class'] = 'responsi-infobox';
		if( self::$args['defaultshadow'] == 'yes' && self::$args['customshadow'] != 'true' ) {
			$attr['class'] .= ' element-bottomshadow-on';
		}

		$attr['style'] = sprintf( 'background-color:%s;', self::$args['background'] );
		$attr['style'] .= sprintf( 'border-top:%s %s %s;', self::$args['bordertopsize'], self::$args['bordertopstyle'], self::$args['bordertopcolor'] );
		$attr['style'] .= sprintf( 'border-bottom:%s %s %s;', self::$args['borderbottomsize'], self::$args['borderbottomstyle'], self::$args['borderbottomcolor'] );
		$attr['style'] .= sprintf( 'border-left:%s %s %s;', self::$args['borderleftsize'], self::$args['borderleftstyle'], self::$args['borderleftcolor'] );
		$attr['style'] .= sprintf( 'border-right:%s %s %s;', self::$args['borderrightsize'], self::$args['borderrightstyle'], self::$args['borderrightcolor'] );
		$attr['style'] .= sprintf( 'padding-top:%s;', self::$args['padding_top'] );
		$attr['style'] .= sprintf( 'padding-bottom:%s;', self::$args['padding_bottom'] );
		if( self::$args['icon'] != '' ){
			$paddingleft = str_replace('px', '', self::$args['iconsize']) + str_replace('px', '', self::$args['padding_left'])+5;
			$attr['style'] .= sprintf( 'padding-left:%s;', $paddingleft.'px' );
		}else{
			$attr['style'] .= sprintf( 'padding-left:%s;', self::$args['padding_left'] );
		}
		$attr['style'] .= sprintf( 'padding-right:%s;', self::$args['padding_right'] );
		$attr['style'] .= sprintf( 'margin-top:%s;', self::$args['margin_top'] );
		$attr['style'] .= sprintf( 'margin-bottom:%s;', self::$args['margin_bottom'] );
		$attr['style'] .= sprintf( 'margin-left:%s;', self::$args['margin_left'] );
		$attr['style'] .= sprintf( 'margin-right:%s;', self::$args['margin_right'] );

		if( self::$args['corner'] == 'true') $corner = 'rounded';
		else $corner = 'square';
		$border_corner = str_replace('px', '', self::$args['border_corner']);
		$attr['style'] .= sprintf( '%s', responsi_generate_border_radius(array( "corner" => strtolower($corner), "rounded_value" => $border_corner ), true) );

		if( self::$args['customshadow'] != 'false' && self::$args['defaultshadow'] != 'yes' ){
			$shadow_h = str_replace('px', '', self::$args['customshadowh']);
			$shadow_v = str_replace('px', '', self::$args['customshadowv']);
			$shadow_blur = str_replace('px', '', self::$args['customshadowblur']);
			$shadow_spread = str_replace('px', '', self::$args['customshadowspread']);
			$shadow_inset = self::$args['customshadowinset'];
			$shadow_color = self::$args['customshadowcolor'];
			$attr['style'] .= sprintf( '%s', responsi_generate_box_shadow(array( 'onoff' => strtolower(self::$args['customshadow']), 'h_shadow' => $shadow_h.'px' , 'v_shadow' => $shadow_v.'px', 'blur' => $shadow_blur.'px', 'spread' => $shadow_spread.'px', 'color' => $shadow_color, 'inset' => strtolower($shadow_inset) ), true) );
		}

		return $attr;
	}

	function infobox_icon_attr() {
		$left = str_replace('px', '', self::$args['padding_left']);
		$attr['style'] = sprintf( 'font-size:%s;', self::$args['iconsize'] );
		$attr['style'] .= sprintf( 'color:%s;', self::$args['iconcolor'] );
		$attr['style'] .= sprintf( 'line-height:%s;', 'inherit !important' );
		$attr['style'] .= sprintf( 'position:%s;', 'absolute !important' );
		$attr['style'] .= sprintf( 'left:%s;', $left.'px' );
		if( self::$args['iconposition'] == 'center' ){
			$int_icon_size = (int)str_replace('px', '', self::$args['iconsize']);
			$mtop = $int_icon_size/2;
			$attr['style'] .= sprintf( '%s', 'top:50%;margin-top:-'.$mtop.'px;' );
		}
		return $attr;
	}
}

?>
