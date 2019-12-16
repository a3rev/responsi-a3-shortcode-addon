<?php

namespace A3Rev\RShortcode;

class Buttons {

	public static $args;
	public static $attr;

	/**
	 * Initiate the shortcode
	 */
	public function __construct () {
		add_filter( 'responsi_list_shortcode', array($this, '_shortcode_hook') );
		add_filter( 'responsi_list_shortcode_font_attr', array( $this, '_filter_field_google_webfonts' ) );
		add_filter( 'responsi_shortcode_attr_button-shortcode-icon-style-divder', array( $this, 'icon_divider_style_attr' ) );
		add_filter( 'responsi_shortcode_attr_button-shortcode-icon-class-divder', array( $this, 'icon_divider_class_attr' ) );
		add_filter( 'responsi_shortcode_attr_button-shortcode-icon', array( $this, 'icon_attr' ) );
		add_filter( 'responsi_shortcode_attr_button-shortcode-button-text', array( $this, 'button_text_attr' ) );
		add_shortcode( 'a3_button', array( $this, 'render' ) );
	}

	public function _filter_field_google_webfonts( $fields ){
		$fields[] = 'font_face';
		return $fields;
	}

	public static function _shortcode_hook( $responsi_list_shortcode ){
		$responsi_list_shortcode[] = 'a3_button';
		return $responsi_list_shortcode;
	}

	/**
	 * Render the shortcode
	 *
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $responsi_options_a3_shortcode;
		if( is_array($responsi_options_a3_shortcode)){
			$default_options = $responsi_options_a3_shortcode;
		}else{
			global $responsi_a3_shortcode_addon;
			$default_options = $responsi_a3_shortcode_addon->global_responsi_options_a3_shortcode();
		}

		do_action('_front_enqueue_css_and_js');
		$defaults =	\A3Rev\RShortcode\HookFunction::set_shortcode_defaults(
			array(
				'wrapelement'				=> 'no',
				'class'						=> '',
				'id' 						=> '',
				'link'						=> '#',
				'font_size' 				=> '14px',
				'font_line_height' 			=> '1',
				'font_face' 				=> 'Arial, sans-serif',
				'font_style' 				=> 'normal',
				'font_color' 				=> '#FFFFFF',
				'transform' 				=> 'none',
				'background' 				=> 'transparent',
				'gradient_from' 			=> 'transparent',
				'gradient_to' 				=> 'transparent',
				'border_size' 				=> '0px',
				'border_style' 				=> 'solid',
				'border_color' 				=> '#dbdbdb',
				'corner' 					=> 'false',
				'border_corner' 			=> '0',
				'shadow' 					=> 'false',
				'shadow_h' 					=> '0',
				'shadow_v' 					=> '0',
				'shadow_blur' 				=> '0',
				'shadow_spread' 			=> '0',
				'shadow_inset' 				=> 'inset',
				'shadow_color' 				=> '#dbdbdb',
				'padding' 					=> 'no',
				'padding_top' 				=> '0px',
				'padding_bottom' 			=> '0px',
				'padding_left' 				=> '0px',
				'padding_right' 			=> '0px',
				'margin' 					=> 'no',
				'margin_top' 				=> '0px',
				'margin_bottom' 			=> '0px',
				'margin_left' 				=> '0px',
				'margin_right' 				=> '0px',
				'align' 					=> 'none',
				'window' 					=> 'false',
				'onofficon' 				=> 'false',
				'icon' 						=> '',
				'iconcolor' 				=> '#ffffff',
				'position' 					=> 'left',
				'divider' 					=> 'no',
				'divider_color' 			=> '#ffffff',
			), $args
		);

		self::$args = $defaults;

		extract( $defaults );

		$wrap_before = '';
		$wrap_after = '';

		if( $corner == 'true') $corner = 'rounded';
		$border_corner = str_replace('px', '', $border_corner);
		$shadow_h = str_replace('px', '', $shadow_h);
		$shadow_v = str_replace('px', '', $shadow_v);
		$shadow_blur = str_replace('px', '', $shadow_blur);
		$shadow_spread = str_replace('px', '', $shadow_spread);

		$fonts = \A3Rev\RShortcode\HookFunction::_generate_font_css($font_size, $font_face, $font_style, $font_color, $font_line_height, true);
		$bt_background = 'background-color: '.$background.';background: '.$background.';background: -webkit-gradient(linear, left top, left bottom, from('.$gradient_from.'), to('.$gradient_to.'));background: -webkit-linear-gradient('.$gradient_from.', '.$gradient_to.');background: -moz-linear-gradient(center top, '.$gradient_from.' 0%, '.$gradient_to.' 100%);background: -moz-gradient(center top, '.$gradient_from.' 0%, '.$gradient_to.' 100%);';
		$bt_margin = 'margin-left:'.$margin_left.' !important;margin-right:'.$margin_right.' !important;margin-top:'.$margin_top.' !important;margin-bottom:'.$margin_bottom.' !important;';
		$bt_padding = 'padding-left:'.$padding_left.' !important;padding-right:'.$padding_right.' !important;padding-top:'.$padding_top.' !important;padding-bottom:'.$padding_bottom.' !important;';
		$bt_transform = 'text-transform:'.strtolower($transform).' !important;';
		$bt_border = 'border:'.$border_size.' '.strtolower($border_style).' '.strtolower($border_color).' !important;';
		$bt_border_radius = responsi_generate_border_radius(array( "corner" => strtolower($corner), "rounded_value" => $border_corner ), true);
		$bt_shadow = responsi_generate_box_shadow(array( 'onoff' => strtolower($shadow), 'h_shadow' => $shadow_h.'px' , 'v_shadow' => $shadow_v.'px', 'blur' => $shadow_blur.'px', 'spread' => $shadow_spread.'px', 'color' => $shadow_color, 'inset' => strtolower($shadow_inset) ), true);

		$float = 'float:none !important;';
		$align = strtolower($align);
		if( $align == 'none'){
			$float = 'float:none !important;';
		}elseif( $align == 'leftnowrap'){
			$float = 'float:left !important;';
			$wrap_before = '<div class="clear"></div>';
			$wrap_after = '<div class="clear"></div>';
		}elseif( $align == 'leftwrap'){
			$float = 'float:left !important;';
		}elseif( $align == 'center'){
			$float = 'float:none !important;display:table !important;';
			$wrap_before = '<div class="clear"></div>';
			$wrap_after = '<div class="clear"></div>';
			$bt_margin = 'margin-left: auto !important;margin-right: auto !important;margin-top:'.$margin_top.' !important;margin-bottom:'.$margin_bottom.' !important;';
		}elseif( $align == 'rightnowrap'){
			$float = 'float:right !important;';
			$wrap_before = '<div class="clear"></div>';
			$wrap_after = '<div class="clear"></div>';
		}elseif( $align == 'rightwrap'){
			$float = 'float:right !important;';
		}

		$bt_style = 'style="display:inline-flex;color:'.$font_color.' !important;'.$fonts.$bt_transform.$bt_background.$bt_border.$bt_border_radius.$bt_shadow.$bt_padding.$bt_margin.$float.'"';

		$class_output = '';
		if( $class!= '' ) {
			$class_output .= ' '.$class;
		}

		$id_output = '';
		if( $id != '' ) {
			$id_output .= ' id="'.$id.'"';
		}

		if ( $window == 'true') $_window = 'target="_blank" rel="noopener"';
		else $_window = '';

		$html = '';
		if( $icon ) {
			$icon_html = sprintf( '<i %s></i>', \A3Rev\RShortcode\HookFunction::attributes( 'button-shortcode-icon' ) );
			if( $divider == 'yes' ) {
				if( $position == 'left'){
					$icon_html = sprintf( '<span %s>%s<span %s></span></span>', \A3Rev\RShortcode\HookFunction::attributes( 'button-shortcode-icon-class-divder' ), $icon_html, \A3Rev\RShortcode\HookFunction::attributes( 'button-shortcode-icon-style-divder' ) );
				}else{
					$icon_html = sprintf( '<span %s><span %s></span>%s</span>', \A3Rev\RShortcode\HookFunction::attributes( 'button-shortcode-icon-class-divder' ), \A3Rev\RShortcode\HookFunction::attributes( 'button-shortcode-icon-style-divder' ), $icon_html );
				}
			}
			if( $position == 'left'){
				$html .= $wrap_before.'<a'.$id_output.' href="' . esc_attr( esc_url( $link ) ) . '" ' . $_window . ' class="responsi-button' . esc_attr( $class_output ) . '" ' . $bt_style . '>' .$icon_html.'<span class="responsi-button-text" style="color:'.$font_color.'">'. wp_kses_post( responsi_remove_wpautop_shortcode( $content ) ) . '</span></a>'.$wrap_after;
			}else{
				$html .= $wrap_before.'<a'.$id_output.' href="' . esc_attr( esc_url( $link ) ) . '" ' . $_window . ' class="responsi-button' . esc_attr( $class_output ) . '" ' . $bt_style . '><span class="responsi-button-text" style="color:'.$font_color.'">' . wp_kses_post( responsi_remove_wpautop_shortcode( $content ) ).'</span>' .$icon_html. '</a>'.$wrap_after;
			}
		}else{
				$html .= $wrap_before.'<a'.$id_output.' href="' . esc_attr( esc_url( $link ) ) . '" ' . $_window . ' class="responsi-button' . esc_attr( $class_output ) . '" ' . $bt_style . '><span class="responsi-button-text" style="color:'.$font_color.'">' . wp_kses_post( responsi_remove_wpautop_shortcode( $content ) ) . '</span></a>'.$wrap_after;
		}
		//$html = '';
		return $html;
	}

	function icon_divider_class_attr() {
		$attr = array();
		$attr['style'] = '';
		if( self::$args['icon'] != '' && self::$args['divider'] == 'yes'){
			$attr['class'] = sprintf( 'responsi-button-divider divider-%s', self::$args['position'] );
			if( self::$args['divider'] == 'yes' ){
				if( self::$args['position'] == 'left' ){
					$attr['style'] .= sprintf( 'padding-right:%s;', self::$args['padding_left'] );
				}else{
					$attr['style'] .= sprintf( 'padding-left:%s;', self::$args['padding_right'] );
				}
			}else{
				if( self::$args['position'] == 'left' ){
					$attr['style'] .= sprintf( 'margin-right:%s;', '10px' );
				}else{
					$attr['style'] .= sprintf( 'margin-left:%s;', '10px' );
				}
			}
		}
		return $attr;
	}

	function icon_divider_style_attr() {
		$attr['style'] = '';
		if( self::$args['icon'] != '' && self::$args['divider'] == 'yes'){
		   	$attr['style'] .= sprintf( 'background-color:%s;', self::$args['divider_color'] );
		}
		return $attr;
	}

	function icon_attr() {
		$attr = array();
		$attr['style'] = '';
		if( self::$args['icon'] != '' ){
			$attr['class'] = sprintf( 'shortcode-icon shortcode-icon-%s', self::$args['icon'] );
			$attr['class'] .= sprintf( ' button-icon-%s', self::$args['position'] );

			if( self::$args['divider'] == 'yes' ){
				if( self::$args['position'] == 'left' ){
					$attr['style'] .= sprintf( 'margin-right:%s;', self::$args['padding_left'] );
				}else{
					$attr['style'] .= sprintf( 'margin-left:%s;', self::$args['padding_right'] );
				}
			}else{
				if( self::$args['position'] == 'left' ){
					$attr['style'] .= sprintf( 'margin-right:%s;', '10px' );
				}else{
					$attr['style'] .= sprintf( 'margin-left:%s;', '10px' );
				}
			}

			if( self::$args['iconcolor'] ) {
		   		$attr['style'] .= sprintf( 'color:%s;', self::$args['iconcolor'] );
		   	}
		}
		return $attr;

	}

	function button_text_attr() {

		$attr = array();

		if( self::$args['icon'] ) {
 			$attr['class'] = sprintf( 'responsi-button responsi-button-text-%s', self::$args['position'] );
 		} else {
 			$attr['class'] = 'responsi-buttonresponsi-button-text';
 		}

		return $attr;

	}
}

?>
