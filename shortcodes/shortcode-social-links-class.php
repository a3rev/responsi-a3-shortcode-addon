<?php

namespace A3Rev\RShortcode;

class SocialLinks {

	public static $args;

	public function __construct () {
		add_filter( 'responsi_list_shortcode', array($this, '_shortcode_hook') );
        add_filter( 'widget_text', 'do_shortcode');
        
        add_shortcode('a3_social_icon', array($this, 'render'));
	}

	public static function _shortcode_hook( $responsi_list_shortcode ){
		$responsi_list_shortcode[] = 'a3_social_icon';
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
				'icon' => '',
				'url' => '#',
				'window' => 'false',
				'size' => '14',
				'color' => '#000000',
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
			), $atts );

		extract( $defaults );

		$border_size = str_replace('px', '', $border_size);

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

		$size = str_replace('px', '', $size);

		$style .= 'font-size: '.$size.'px !important;color:'.$color.' !important;';

		$target = '';
		if ( $window == 'true') $target = 'target="_blank" rel="noopener"';
		$container_mp = '';
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
			$style .= 'background-color:'.$background.' !important;border:'.$border_size.'px '.strtolower($border_style).' '.strtolower($border_color).' !important;padding-left:'.$padding_left.' !important;padding-right:'.$padding_right.' !important;padding-top:'.$padding_top.' !important;padding-bottom:'.$padding_bottom.' !important;'.$border_radius.$shadow;
			$container_mp .= 'margin-left:'.$margin_left.' !important;margin-right:'.$margin_right.' !important;margin-top:'.$margin_top.' !important;margin-bottom:'.$margin_bottom.' !important;';
		}

		$css = 'style="'.$style.'"';

		$icons = '';
		$alt = '';

		if( $icon != '') {
			$icons = sprintf( '<a class="responsi-social-icon" %s href="%s" style="%s"><i class="responsi-shortcode-icon shortcode-icon-%s%s%s" %s></i></a>', $target, $url, $container_mp, $icon, $size_class,$class, $css );
		}

		return $icons;
	}
}
?>