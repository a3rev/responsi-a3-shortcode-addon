<?php

namespace A3Rev\RShortcode;

class Typography {

	public static $args;

	public function __construct () {
		add_filter( 'responsi_list_shortcode', array($this, '_shortcode_hook') );
		add_filter( 'responsi_list_shortcode_font_attr', array( $this, '_filter_field_google_webfonts' ) );
		add_filter( 'responsi_shortcode_attr_title-shortcode', array( $this, 'attr' ) );
		add_filter( 'responsi_shortcode_attr_title-shortcode-heading', array( $this, 'heading_attr' ) );
		add_filter( 'responsi_shortcode_attr_title-shortcode-sep', array( $this, 'sep_attr' ) );
		add_filter( 'widget_text', 'do_shortcode');

		add_shortcode('a3_typography', array($this, 'render_typography'));
		add_shortcode('a3_highlight', array($this, 'render_highlight'));
		add_shortcode('a3_dropcap', array($this, 'render_dropcap'));
		add_shortcode('a3_quotation', array($this, 'render_quotation'));
		add_shortcode('a3_title', array($this, 'render_title'));
        
	}

	public function _filter_field_google_webfonts( $fields ){
		$fields[] = 'face';
		return $fields;
	}

	public static function _shortcode_hook( $responsi_list_shortcode ){
		$responsi_list_shortcode[] = 'a3_typography';
		$responsi_list_shortcode[] = 'a3_highlight';
		$responsi_list_shortcode[] = 'a3_dropcap';
		$responsi_list_shortcode[] = 'a3_quotation';
		$responsi_list_shortcode[] = 'a3_title';
		return $responsi_list_shortcode;
	}

	public function render_typography($atts, $content = null) {
		do_action('_front_enqueue_css_and_js');
		$defaults =	\A3Rev\RShortcode\HookFunction::set_shortcode_defaults(
			array(
				'size' => '12px',
				'line_height' => '1',
				'face' => 'Arial, sans-serif',
				'style' => 'normal',
				'color' => '#000000',
			), $atts );

		$defaults = array_map( 'esc_attr', $defaults );

		extract( $defaults );
		$html = '';
		$fonts = \A3Rev\RShortcode\HookFunction::_generate_font_css($size, $face, $style, $color, $line_height);
		$html = '<span class="shortcode-typography" style="'. $fonts .'">' . do_shortcode( $content ) . '</span>';
		return $html;
	}
	public function render_highlight($atts, $content = null) {
		do_action('_front_enqueue_css_and_js');
		$defaults =	\A3Rev\RShortcode\HookFunction::set_shortcode_defaults(
			array(
				'background' => 'transparent',
				'padding' => 'no',
				'paddingtop' => '0px',
				'paddingbottom' => '0px',
				'paddingleft' => '0px',
				'paddingright' => '0px',
			), $atts );

		$defaults = array_map( 'esc_attr', $defaults );

		extract( $defaults );
		$paddingtop = str_replace("px", "", $paddingtop);
		$paddingbottom = str_replace("px", "", $paddingbottom);
		$paddingleft = str_replace("px", "", $paddingleft);
		$paddingright = str_replace("px", "", $paddingright);
		$html = '<span class="shortcode-highlight" style="background:'.$background.';padding-top:'.$paddingtop.'px;padding-bottom:'.$paddingbottom.'px;padding-left:'.$paddingleft.'px;padding-right:'.$paddingright.'px;">' . do_shortcode( $content ) . '</span>';
		return $html;
	}
	public function render_dropcap($atts, $content = null) {
		do_action('_front_enqueue_css_and_js');
		$defaults =	\A3Rev\RShortcode\HookFunction::set_shortcode_defaults(
			array(
				'size' => '12px',
				'line_height' => '1',
				'face' => 'Arial, sans-serif',
				'style' => 'normal',
				'color' => '#000000',
				'margin' => 'no',
				'margintop' => '0px',
				'marginbottom' => '0px',
				'marginleft' => '0px',
				'marginright' => '0px',
			), $atts );

		$defaults = array_map( 'esc_attr', $defaults );

		extract( $defaults );
		$fonts = \A3Rev\RShortcode\HookFunction::_generate_font_css($size, $face, $style, $color, $line_height).'';
		$margintop = str_replace("px", "", $margintop);
		$marginbottom = str_replace("px", "", $marginbottom);
		$marginleft = str_replace("px", "", $marginleft);
		$marginright = str_replace("px", "", $marginright);
		$html = '<span class="dropcap" style="margin-top:'.$margintop.'px;margin-bottom:'.$marginbottom.'px;margin-left:'.$marginleft.'px;margin-right:'.$marginright.'px;'.$fonts.'">' . do_shortcode( $content ) . '</span>';
		return $html;
	}
	public function render_quotation($atts, $content = null) {
		do_action('_front_enqueue_css_and_js');
		$defaults =	\A3Rev\RShortcode\HookFunction::set_shortcode_defaults(
			array(
				'iconcolor' => '#cccccc',
				'textcolor' => '#000000',
				'float' => 'none',
				'container' => 'no',
				'background' => 'transparent',
				'bordersize' => '0px',
				'borderstyle' => 'solid',
				'bordercolor' => '#dbdbdb',
				'corner' => '0',
				'shadow' => 'false',
				'shadow_h' => '0',
				'shadow_v' => '0',
				'shadow_blur' => '0',
				'shadow_spread' => '0',
				'shadow_inset' => 'inset',
				'shadow_color' => '#dbdbdb',
			), $atts );

		$defaults = array_map( 'esc_attr', $defaults );

		extract( $defaults );

		if( $background == '' ) $background = 'transparent';

		$border = '';
		$bordersize = str_replace('px', '', $bordersize);
		if( $bordersize > 0){
			$border = 'border:'.$bordersize.'px '.strtolower($borderstyle).' '.strtolower($bordercolor).' !important;';
		}
		$border_radius = '';
		if( isset( $atts['corner'] )){
		 	$corner = str_replace('px', '', $corner);
		 	$border_radius = responsi_generate_border_radius(array( "corner" => 'rounded', "rounded_value" => $corner ), true);
		}

		$shadow = '';
		if( isset( $atts['shadow_color'] )){
			$shadow_h = str_replace('px', '', $shadow_h);
			$shadow_v = str_replace('px', '', $shadow_v);
			$shadow_blur = str_replace('px', '', $shadow_blur);
			$shadow_spread = str_replace('px', '', $shadow_spread);
			$shadow = responsi_generate_box_shadow(array( 'onoff' => true, 'h_shadow' => $shadow_h.'px' , 'v_shadow' => $shadow_v.'px', 'blur' => $shadow_blur.'px', 'spread' => $shadow_spread.'px', 'color' => $shadow_color, 'inset' => strtolower($shadow_inset) ), true);
		}
		$width = '';
		if( $float != 'none' ){
			$width = 'width:48%;';
		}

		$class = ' align-'.$float;
		if( isset( $atts['shadow_color'] ) ){
			$class .= ' quote-boxed';
		}else{
			$class .= ' quote-no-boxed';
		}

		$cstyle = ' style="float:'.$float.';'.$width.'"';
		$style = ' style="background-color:'.$background.' !important;color:'.$iconcolor.';'.$border.$border_radius.$shadow.'"';
   		return '<div class="responsi-shortcode-quote'.$class.'"'.$cstyle.'><blockquote'.$style.'><div class="blockquote_text" style="color:'.$textcolor.' !important;">' . (($content)) . '</div></blockquote></div>';
	}
	public function render_title($atts, $content = null) {
		do_action('_front_enqueue_css_and_js');
		$defaults =	\A3Rev\RShortcode\HookFunction::set_shortcode_defaults(
			array(
				'class'						=> '',
				'id' 						=> '',
				'tags' 						=> '1',
				'align' 					=> 'left',
				'separator' 				=> 'double',
				'separatorstyle' 			=> 'solid',
				'separatorcolor' 			=> '#dbdbdb',
			), $atts );

		$defaults = array_map( 'esc_attr', $defaults );

		extract( $defaults );

		self::$args = $defaults;

		if( ! $separator ) {
			self::$args['separator'] = $separator = 'double';
		}

		if( strpos( $separator, 'underline' ) === false ) {

			if( self::$args['align'] == 'right' ) {

				$html = sprintf( '<div %s><div %s><div %s></div></div><h%s %s>%s</h%s></div>', \A3Rev\RShortcode\HookFunction::attributes( 'title-shortcode' ),
								\A3Rev\RShortcode\HookFunction::attributes( 'title-sep-container' ), \A3Rev\RShortcode\HookFunction::attributes( 'title-shortcode-sep' ), $tags,
								\A3Rev\RShortcode\HookFunction::attributes( 'title-shortcode-heading' ), do_shortcode( $content ), $tags );

			} else {

				$html = sprintf( '<div %s><h%s %s>%s</h%s><div %s><div %s></div></div></div>', \A3Rev\RShortcode\HookFunction::attributes( 'title-shortcode' ), $tags,
								 \A3Rev\RShortcode\HookFunction::attributes( 'title-shortcode-heading' ), do_shortcode( $content ), $tags,
								 \A3Rev\RShortcode\HookFunction::attributes( 'title-sep-container' ), \A3Rev\RShortcode\HookFunction::attributes( 'title-shortcode-sep' ) );
			}

		} else {

			$html = sprintf( '<div %s><h%s %s>%s</h%s></div>', \A3Rev\RShortcode\HookFunction::attributes( 'title-shortcode' ), $tags,
							 \A3Rev\RShortcode\HookFunction::attributes( 'title-shortcode-heading' ), do_shortcode( $content ), $tags );
		}

		return $html;
	}

	function attr() {

		$attr = array();

		$attr['class'] = 'responsi-shortcode-title title';

		if( strpos( self::$args['separator'], 'underline' ) !== false ) {
			$styles = explode( ' ', self::$args['separator'] );

			foreach ( $styles as $style ) {
				$attr['class'] .= ' sep-' . $style;
			}

			if( self::$args['separatorcolor'] ) {
				$attr['style'] = sprintf( 'border-bottom-color:%s;', self::$args['separatorcolor'] );
			}
			if( self::$args['separatorstyle'] ) {
				$attr['style'] .= sprintf( 'border-style:%s;', self::$args['separatorstyle'] );
			}
		}

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}

		return $attr;

	}

	function heading_attr() {

		$attr = array();

		$attr['class'] = sprintf( 'title-heading-%s', self::$args['align'] );

		return $attr;

	}

	function sep_attr() {

		$attr = array();

		$attr['class'] = 'title-sep';

		$styles = explode( ' ', self::$args['separator'] );

		foreach ( $styles as $style ) {
			$attr['class'] .= ' sep-' . $style;
		}

		if( self::$args['separatorcolor'] ) {
			$attr['style'] = sprintf( 'border-color:%s;', self::$args['separatorcolor'] );
		}
		if( self::$args['separatorstyle'] ) {
			$attr['style'] .= sprintf( 'border-style:%s;', self::$args['separatorstyle'] );
		}

		return $attr;

	}

}

?>