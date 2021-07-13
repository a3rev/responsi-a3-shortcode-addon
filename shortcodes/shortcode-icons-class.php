<?php

namespace A3Rev\RShortcode;

class Icons {

	public function __construct () {
		add_filter('responsi_list_shortcode', array($this, '_shortcode_hook'));
        add_filter('widget_text', 'do_shortcode');

        add_shortcode('a3_fontawesome', array($this, 'render'));
	}

	public static function _shortcode_hook( $responsi_list_shortcode ){
		$responsi_list_shortcode[] = 'a3_fontawesome';
		return $responsi_list_shortcode;
	}

	public function render($atts, $content = null) {
		do_action('_front_enqueue_css_and_js');
		global $responsi_options_a3_shortcode;
		if( is_array($responsi_options_a3_shortcode)){
			$default_options = $responsi_options_a3_shortcode;
		}else{
			global $responsi_a3_shortcode_addon;
			$default_options = $responsi_a3_shortcode_addon->global_responsi_options_a3_shortcode();
		}
		$defaults =	\A3Rev\RShortcode\HookFunction::set_shortcode_defaults(
			array(
				'fronticon' => 'no',
				'icon' => '',
				'size' => '14',
				'color' => '#000000',
				'frontimage' => 'no',
				'image' => '',
				'image_width' => '35',
				'image_height' => '35',
				'container' => 'no',
				'background' => 'transparent',
				'border_size' => 0,
				'border_style' => 'solid',
				'border_color' => '#000000',
				'corner' => 'false',
				'border_corner' => '0',
				'shadow' => 'false',
				'shadow_h' => '0',
				'shadow_v' => '0',
				'shadow_blur' => '0',
				'shadow_spread' => '0',
				'shadow_inset' => 'inset',
				'shadow_color' => '#dbdbdb',
				'padding' => 'no',
				'padding_top' => '0',
				'padding_bottom' => '0',
				'padding_left' => '0',
				'padding_right' => '0',
				'margin' => 'no',
				'margin_top' => '0',
				'margin_bottom' => '0',
				'margin_left' => '0',
				'margin_right' => '0',
				'flip'						=> 'no',
				'icon_flip'					=> 'horizontal',
				'rotate'					=> 'no',
				'icon_rotate'				=> '90',
				'spin'						=> 'no',
				'spin_speed'				=> '2',
				'animation'					=> 'no',
				'animation_type' 			=> 'fade',
				'animation_direction' 		=> 'left',
				'animation_speed' 			=> '0.1',
			), $atts );

		$defaults = array_map( 'esc_attr', $defaults );

		extract( $defaults );

		if( isset($atts['border_width']) ){
			$border_size = $border_width;
		}
		$border_size = str_replace('px', '', $border_size);

		$image_width = str_replace('px', '', $image_width);
		$image_height = str_replace('px', '', $image_height);

		if( $margin == 'no' ){
			$margin_top = 0;
			$margin_bottom = 0;
			$margin_left = 0;
			$margin_right = 0;
		}
		if( $padding == 'no' ){
			$padding_top = 0;
			$padding_bottom = 0;
			$padding_left = 0;
			$padding_right = 0;
		}

		$style = '';
		$class= '';
		$size_class= '';

		if( $size == 'small' ){
			$size_class= ' iconsmall';
			$size = '10';
		}elseif( $size == 'medium' ){
			$size_class= ' iconmedium';
			$size = '18';
		}elseif( $size == 'large' ){
			$size_class= ' iconlarge';
			$size = '40';
		}else{
			$size = str_replace('px', '', $size);
		}

		if( $flip && $flip == 'yes' && $icon_flip && $rotate != 'yes'  ) {
			$class .= ' shortcode-icon-flip-' . $icon_flip;
		}

		if( $rotate && $rotate == 'yes' && $icon_rotate && $flip != 'yes'  ) {
			$class .= ' shortcode-icon-rotate-' . $icon_rotate;
		}

		if( $spin && $spin == 'yes' ) {
			$class .= ' shortcode-icon-spin speed-'.$spin_speed;
			$style .= '-webkit-animation: spin '.$spin_speed.'s infinite linear;-moz-animation: spin '.$spin_speed.'s infinite linear;-o-animation: spin '.$spin_speed.'s infinite linear;animation: spin '.$spin_speed.'s infinite linear;';
		}

		$data_animation = '';
		if( $animation && $animation == 'yes' && $animation_type && $spin != 'yes' ) {
			$animations = $this->animations( array(
				'animation'	  => $animation,
				'type'	  => $animation_type,
				'direction' => $animation_direction,
				'speed'	 => $animation_speed,
			) );
			//$style .= 'opacity: 0;';
			$class .= ' '.$animations['animation_class'];
			$data_animation .= 'data-animationType="'.$animations['data-animationType'].'" data-animationDuration="'.$animations['data-animationDuration'].'"';
		}

		$style .= 'font-size: '.$size.'px !important;color:'.$color.' !important;';

		if( $container == 'yes' ){

			if($background == '') $background = 'transparent';
			if( $corner == 'true') $corner = 'rounded';
			$border_corner = str_replace('px', '', $border_corner);
			$shadow_h = str_replace('px', '', $shadow_h);
			$shadow_v = str_replace('px', '', $shadow_v);
			$shadow_blur = str_replace('px', '', $shadow_blur);
			$shadow_spread = str_replace('px', '', $shadow_spread);
			$border_radius = responsi_generate_border_radius(array( "corner" => strtolower($corner), "rounded_value" => $border_corner ), true);
			$shadow = responsi_generate_box_shadow(array( 'onoff' => strtolower($shadow), 'h_shadow' => $shadow_h.'px' , 'v_shadow' => $shadow_v.'px', 'blur' => $shadow_blur.'px', 'spread' => $shadow_spread.'px', 'color' => $shadow_color, 'inset' => strtolower($shadow_inset) ), true);
			$style .= 'background-color:'.$background.' !important;border:'.$border_size.'px '.strtolower($border_style).' '.strtolower($border_color).' !important;margin-left:'.$margin_left.' !important;margin-right:'.$margin_right.' !important;margin-top:'.$margin_top.' !important;margin-bottom:'.$margin_bottom.' !important;padding-left:'.$padding_left.' !important;padding-right:'.$padding_right.' !important;padding-top:'.$padding_top.' !important;padding-bottom:'.$padding_bottom.' !important;'.$border_radius.$shadow;
		}

		$css = 'style="'.$style.'"';

		$icons = '';
		$alt = '';
		if( $fronticon != 'yes' && $frontimage == 'yes' && $image && $image_width && $image_height ) {
			$image_id = \A3Rev\RShortcode\HookFunction::get_attachment_id_from_url( $image );

			if( $image_id ) {
				$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			}

			$icons = sprintf( '<img src="%s" width="%s" height="%s" alt="%s" class="image-icon%s" %s %s />', $image, $image_width, $image_height, $alt, $class, $data_animation, $css  );
		}

		if( $fronticon == 'yes' && $frontimage != 'yes' && $icon != '') {
			$icons = sprintf( '<i class="responsi-shortcode-icon shortcode-icon-%s%s%s" %s %s></i>', $icon, $size_class,$class, $data_animation, $css );
		}

		return $icons;
	}

	/**
	 * Function to return animation classes for shortcodes mainly.
	 *
	 * @param  array  $args Animation type, direction and speed
	 * @return array		Array with data attributes
	 */
	public static function animations( $args = array() ) {

		$defaults = array(
			'animation' 		=> '',
			'type' 		=> 'fade',
			'direction' => 'left',
			'speed' 	=> '0.1',
		);

		$args = wp_parse_args( $args, $defaults );

		if( $args['animation'] && $args['animation'] == 'yes' && $args['type'] ) {

			$animation_attribues['animation_class'] = 'responsi-animated';

			if( $args['type'] != 'bounce' &&
				$args['type'] != 'flash' &&
				$args['type'] != 'shake'
			) {
				$direction_suffix = 'In' . ucfirst( $args['direction'] );
				$args['type'] .= $direction_suffix;
			}

			$animation_attribues['data-animationType'] = $args['type'];

			if( $args['speed'] ) {
				$animation_attribues['data-animationDuration'] = $args['speed'];
			}

			return $animation_attribues;

		}

	}
}

?>