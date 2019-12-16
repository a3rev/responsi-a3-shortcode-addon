<?php

namespace A3Rev\RShortcode;

class Flipboxes {

	private $flipbox_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct () {
		add_filter( 'responsi_list_shortcode', array($this, '_shortcode_hook') );
		add_filter( 'responsi_list_shortcode_font_attr', array( $this, '_filter_field_google_webfonts' ) );
		//add_action( 'responsi_google_webfonts', array( $this, '_addon_google_webfonts' ) );
		add_filter( 'responsi_shortcode_attr_flip-boxes-shortcode', array( $this, 'parent_attr' ) );
		add_filter( 'responsi_shortcode_attr_flip-box-shortcode', array( $this, 'child_attr' ) );
		add_filter( 'responsi_shortcode_attr_flip-box-shortcode-front-box', array( $this, 'front_box_attr' ) );
		add_filter( 'responsi_shortcode_attr_flip-box-shortcode-back-box', array( $this, 'back_box_attr' ) );
		add_filter( 'responsi_shortcode_attr_flip-box-shortcode-heading-front', array( $this, 'heading_front_attr' ) );
		add_filter( 'responsi_shortcode_attr_flip-box-shortcode-heading-back', array( $this, 'heading_back_attr' ) );
		add_filter( 'responsi_shortcode_attr_flip-box-shortcode-grafix', array( $this, 'grafix_attr' ) );
		add_filter( 'responsi_shortcode_attr_flip-box-shortcode-icon', array( $this, 'icon_attr' ) );
		add_shortcode( 'a3_flipboxes', array( $this, 'render_parent' ) );
		add_shortcode( 'flip_box', array( $this, 'render_child' ) );
	}

	public static function _shortcode_hook( $responsi_list_shortcode ){
		$responsi_list_shortcode[] = 'a3_flipboxes';
		$responsi_list_shortcode[] = 'flip_box';
		return $responsi_list_shortcode;
	}

	public function _addon_google_webfonts( $options ){
		global $responsi_options_a3_shortcode;
		if( is_array($responsi_options_a3_shortcode)){
			$default_options = $responsi_options_a3_shortcode;
		}else{
			global $responsi_a3_shortcode_addon;
			$default_options = $responsi_a3_shortcode_addon->global_responsi_options_a3_shortcode();
		}
		if( is_array($options) ){
			$options  = array_merge( $options, $default_options );
		}
		return $options;
	}

	public function _filter_field_google_webfonts( $fields ){
		$fields[] = 'title_front_face';
		$fields[] = 'title_back_face';
		$fields[] = 'text_front_face';
		$fields[] = 'text_back_face';
		return $fields;
	}

	/**
	 * Render the shortcode
	 *
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_parent( $args, $content = '') {
		do_action('_front_enqueue_css_and_js');
		$defaults =	\A3Rev\RShortcode\HookFunction::set_shortcode_defaults(
			array(
				'style'					=> '',
				'wrapelement'			=> 'no',
				'class'					=> '',
				'id' 					=> '',
				'margin_box' 			=> 'no',
				'margin_container' 		=> 'no',
				'margintop'				=> '0px',
				'marginbottom'			=> '0px',
				'columns' 				=> '1',
			), $args
		);

		extract( $defaults );

		self::$parent_args = $defaults;

		if( self::$parent_args['columns'] > 6 ) {
			self::$parent_args['columns'] = 6;
		}

		$html = sprintf( '<div %s><div class="clear"></div>%s<div class="clear"></div></div><div %s></div>', \A3Rev\RShortcode\HookFunction::attributes( 'flip-boxes-shortcode' ), do_shortcode( $content ), \A3Rev\RShortcode\HookFunction::attributes( 'clear' ) );

		return $html;

	}

	function parent_attr() {

		if( self::$parent_args['margin_container'] == 'yes' && self::$parent_args['margintop'] ) {
			$attr['style'] = sprintf( 'margin-top:%s;', self::$parent_args['margintop'] );
		}else{
			$attr['style'] = sprintf( 'margin-top:%s;', '0px' );
		}
		if( self::$parent_args['margin_container'] == 'yes' && self::$parent_args['marginbottom'] ) {
			$attr['style'] .= sprintf( 'margin-bottom:%s;', self::$parent_args['marginbottom'] );
		}else{
			$attr['style'] = sprintf( 'margin-bottom:%s;', '0px' );
		}

		$attr['class'] = sprintf( 'responsi-flip-boxes flip-boxes row margin-box-%s responsi-columns-%s', self::$parent_args['margin_box'] , self::$parent_args['columns']);

		if( self::$parent_args['wrapelement'] == 'yes' && self::$parent_args['class'] ) {
			$attr['class'] .= ' ' . self::$parent_args['class'];
		}

		if( self::$parent_args['wrapelement'] == 'yes' && self::$parent_args['id'] ) {
			$attr['id'] = self::$parent_args['id'];
		}

		return $attr;

	}

	/**
	 * Render the child shortcode
	 *
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_child( $args, $content = '') {
		global $smof_data;
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
				'wrapelement'				=> 'no',
				'class'						=> '',
				'id' 						=> '',
				'margin_box' 				=> 'no',
				'margin_container' 			=> 'no',
				'margintop'					=> '0px',
				'marginbottom'				=> '0px',
				'boxmargintop'				=> '0px',
				'boxmarginbottom'			=> '20px',
				'text_front'				=> '',
				'text_front_size' 			=> $default_options['responsi_sc_flip_boxes_front_text']['size'],
				'text_front_line_height' 	=> $default_options['responsi_sc_flip_boxes_front_text']['line_height'],
				'text_front_face' 			=> $default_options['responsi_sc_flip_boxes_front_text']['face'],
				'text_front_style' 			=> $default_options['responsi_sc_flip_boxes_front_text']['style'],
				'text_front_color'			=> $default_options['responsi_sc_flip_boxes_front_text']['color'],
				'title_front' 				=> '',
				'title_front_size' 			=> $default_options['responsi_sc_flip_boxes_front_heading']['size'],
				'title_front_line_height' 	=> $default_options['responsi_sc_flip_boxes_front_heading']['line_height'],
				'title_front_face' 			=> $default_options['responsi_sc_flip_boxes_front_heading']['face'],
				'title_front_style' 		=> $default_options['responsi_sc_flip_boxes_front_heading']['style'],
				'title_front_color' 		=> $default_options['responsi_sc_flip_boxes_front_heading']['color'],
				'onbackground_color_front'	=> $default_options['responsi_sc_flip_boxes_front_bg']['onoff'],
				'background_color_front'	=> $default_options['responsi_sc_flip_boxes_front_bg']['color'],
				'border_front_color'		=> $default_options['responsi_sc_flip_boxes_front_border']['color'],
				'border_front_style'		=> $default_options['responsi_sc_flip_boxes_front_border']['style'],
				'border_front_size'			=> $default_options['responsi_sc_flip_boxes_front_border']['width'],
				'border_front_radius'		=> $default_options['responsi_sc_flip_boxes_front_radius']['rounded_value'],
				'text_back_size' 			=> $default_options['responsi_sc_flip_boxes_back_text']['size'],
				'text_back_line_height' 	=> $default_options['responsi_sc_flip_boxes_back_text']['line_height'],
				'text_back_face' 			=> $default_options['responsi_sc_flip_boxes_back_text']['face'],
				'text_back_style' 			=> $default_options['responsi_sc_flip_boxes_back_text']['style'],
				'text_back_color'			=> $default_options['responsi_sc_flip_boxes_back_text']['color'],
				'title_back' 				=> '',
				'title_back_size' 			=> $default_options['responsi_sc_flip_boxes_back_heading']['size'],
				'title_back_line_height' 	=> $default_options['responsi_sc_flip_boxes_back_heading']['line_height'],
				'title_back_face' 			=> $default_options['responsi_sc_flip_boxes_back_heading']['face'],
				'title_back_style' 			=> $default_options['responsi_sc_flip_boxes_back_heading']['style'],
				'title_back_color'			=> $default_options['responsi_sc_flip_boxes_back_heading']['color'],
				'onbackground_color_back'	=> $default_options['responsi_sc_flip_boxes_back_bg']['onoff'],
				'background_color_back' 	=> $default_options['responsi_sc_flip_boxes_back_bg']['color'],
				'border_back_color'			=> $default_options['responsi_sc_flip_boxes_back_border']['color'],
				'border_back_style'			=> $default_options['responsi_sc_flip_boxes_back_border']['style'],
				'border_back_size'			=> $default_options['responsi_sc_flip_boxes_back_border']['width'],
				'border_back_radius'		=> $default_options['responsi_sc_flip_boxes_back_radius']['rounded_value'],
				'fronticon'					=> 'no',
				'frontimage'				=> 'no',
				'circle_image'				=> 'no',
				'icon_size' 				=> '24',
				'icon_color' 				=> '#ffffff',
				'circle'					=> 'no',
				'circle_color' 				=> '#a0ce4e',
				'circle_border_color' 		=> '#a0ce4e',
				'circle_paddingbottom' 		=> '0px',
				'circle_paddingleft' 		=> '0px',
				'circle_paddingright'		=> '0px',
				'circle_paddingtop'			=> '0px',
				'icon' 						=> '',
				'flip'						=> 'no',
				'icon_flip'					=> 'horizontal',
				'rotate'					=> 'no',
				'icon_rotate'				=> '90',
				'spin'						=> 'no',
				'spin_speed'				=> '2',
				'animation'					=> '',
				'image' 					=> '',
				'image_width' 				=> '35',
				'image_height' 				=> '35',
				'animation_type' 			=> 'fade',
				'animation_direction' 		=> 'left',
				'animation_speed' 			=> '0.1',
			), $args
		);

		if( $default_options['responsi_sc_flip_boxes_front_radius']['corner'] != 'rounded' ) {
			$defaults['border_front_radius'] = '0';
		}
		if( $default_options['responsi_sc_flip_boxes_back_radius']['corner'] != 'rounded' ) {
			$defaults['border_back_radius'] = '0';
		}

		if( $defaults['margin_box'] == 'yes' ) {
			$defaults['boxmargintop'] = '0px';
			$defaults['boxmarginbottom'] = '20px';
		}else{
			$defaults['boxmargintop'] = '0px';
			$defaults['boxmarginbottom'] = '0px';
		}

		extract( $defaults );

		self::$child_args = $defaults;

		$style = $icon_output = $title_output = $title_front_output = $title_back_output = $alt = '';

		if( $frontimage == 'yes' && $image &&
			$image_width &&
			$image_height
		) {

			$image_id = \A3Rev\RShortcode\HookFunction::get_attachment_id_from_url( $image );

			if( $image_id ) {
				$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			}

			$icon_output = sprintf( '<img src="%s" width="%s" height="%s" alt="%s" %s />', $image, $image_width, $image_height, $alt, \A3Rev\RShortcode\HookFunction::attributes( 'flip-box-shortcode-icon' )  );
		}
		if( $fronticon == 'yes' && $icon ) {
			$icon_output = sprintf( '<i %s></i>', \A3Rev\RShortcode\HookFunction::attributes( 'flip-box-shortcode-icon' ) );
		}

		if( $icon_output ) {
			$icon_output = sprintf( '<div %s>%s</div>', \A3Rev\RShortcode\HookFunction::attributes( 'flip-box-shortcode-grafix' ), $icon_output );
		} else {
			$icon_output = '';
		}

		if( $title_front ) {
			$title_front_output = sprintf( '<h2 %s>%s</h2>', \A3Rev\RShortcode\HookFunction::attributes( 'flip-box-shortcode-heading-front' ), $title_front );
		}

		if( $title_back ) {
			$title_back_output = sprintf( '<h3 %s>%s</h3>', \A3Rev\RShortcode\HookFunction::attributes( 'flip-box-shortcode-heading-back' ), $title_back );
		}

		$front_inner = sprintf( '<div %s>%s</div>', \A3Rev\RShortcode\HookFunction::attributes( 'flip-box-front-inner' ), $icon_output . $title_front_output . $text_front );
		$back_inner = sprintf( '<div %s>%s</div>', \A3Rev\RShortcode\HookFunction::attributes( 'flip-box-back-inner' ), $title_back_output . do_shortcode( $content ) );

		$front = sprintf( '<div %s>%s</div>', \A3Rev\RShortcode\HookFunction::attributes( 'flip-box-shortcode-front-box' ), $front_inner );
		$back = sprintf( '<div %s>%s</div>', \A3Rev\RShortcode\HookFunction::attributes( 'flip-box-shortcode-back-box' ), $back_inner );

		$html = sprintf( '<div %s><div class="responsi-flip-box"><div %s>%s%s</div></div></div>', \A3Rev\RShortcode\HookFunction::attributes( 'flip-box-shortcode' ), \A3Rev\RShortcode\HookFunction::attributes( 'flip-box-inner-wrapper' ), $front, $back );

		$this->flipbox_counter++;

		return $html;

	}

	function child_attr() {

		if( self::$parent_args['columns'] &&
			! empty( self::$parent_args['columns'] )
		) {
			$columns = 12 / self::$parent_args['columns'];
		} else {
			$columns = 1;
		}

		$attr['class'] = sprintf('responsi-flip-box-wrapper col-lg-%s col-md-%s col-sm-%s', $columns, $columns, $columns );

		if( self::$parent_args['columns'] == '5'  ) {
			$attr['class'] = 'responsi-flip-box-wrapper col-lg-2 col-md-2 col-sm-2';
		}

		if( self::$child_args['class'] ) {
			$attr['class'] .= ' ' . self::$child_args['class'];
		}

		if( self::$child_args['id'] ) {
			$attr['id'] = self::$child_args['id'];
		}

		if( self::$child_args['boxmargintop'] ) {
			$attr['style'] = sprintf( 'margin-top:%s;', self::$child_args['boxmargintop'] );
		}
		if( self::$child_args['boxmarginbottom'] ) {
			$attr['style'] .= sprintf( 'margin-bottom:%s;', self::$child_args['boxmarginbottom'] );
		}

		return $attr;

	}

	function front_box_attr() {

		$attr['class'] = 'flip-box-front';

		if( self::$child_args['background_color_front'] && self::$child_args['onbackground_color_front'] != 'false' ) {
			$attr['style'] = sprintf( 'background-color:%s;', self::$child_args['background_color_front'] );
		}else{
			$attr['style'] = sprintf( 'background-color:%s;', 'transparent' );
		}

		if( self::$child_args['border_front_size'] ) {
			$attr['style'] .= sprintf( 'border-width:%s;', self::$child_args['border_front_size'] );
		}

		if( self::$child_args['border_front_style'] ) {
			$attr['style'] .= sprintf( 'border-style:%s;', self::$child_args['border_front_style'] );
		}

		if( self::$child_args['border_front_color'] ) {
			$attr['style'] .= sprintf( 'border-color:%s;', self::$child_args['border_front_color'] );
		}

		if( self::$child_args['border_front_radius'] ) {
			$attr['style'] .= sprintf( 'border-radius:%s;-webkit-border-radius:%s;', self::$child_args['border_front_radius'], self::$child_args['border_front_radius'] );
		}
		$fonts = \A3Rev\RShortcode\HookFunction::_generate_font_css(self::$child_args['text_front_size'], self::$child_args['text_front_face'], self::$child_args['text_front_style'], self::$child_args['text_front_color'],self::$child_args['text_front_line_height'] );
		$attr['style'] .= $fonts;
		//\A3Rev\RShortcode\HookFunction::_google_webfonts();

		return $attr;

	}

	function back_box_attr() {

		$attr['class'] = 'flip-box-back';

		if( self::$child_args['background_color_back'] && self::$child_args['onbackground_color_back'] != 'false' ) {
			$attr['style'] = sprintf( 'background-color:%s;', self::$child_args['background_color_back'] );
		}else{
			$attr['style'] = sprintf( 'background-color:%s;', 'transparent' );
		}

		if( self::$child_args['border_back_size'] ) {
			$attr['style'] .= sprintf( 'border-width:%s;', self::$child_args['border_back_size'] );
		}

		if( self::$child_args['border_back_style'] ) {
			$attr['style'] .= sprintf( 'border-style:%s;', self::$child_args['border_back_style'] );
		}

		if( self::$child_args['border_back_color'] ) {
			$attr['style'] .= sprintf( 'border-color:%s;', self::$child_args['border_back_color'] );
		}

		if( self::$child_args['border_back_radius'] ) {
			$attr['style'] .= sprintf( 'border-radius:%s;-webkit-border-radius:%s;', self::$child_args['border_back_radius'], self::$child_args['border_back_radius'] );
		}
		$fonts = \A3Rev\RShortcode\HookFunction::_generate_font_css(self::$child_args['text_back_size'], self::$child_args['text_back_face'], self::$child_args['text_back_style'], self::$child_args['text_back_color'], self::$child_args['text_back_line_height'] );
		$attr['style'] .= $fonts;

		return $attr;

	}

	function grafix_attr() {

		$attr = array();

		$attr['class'] = 'flip-box-grafix';

		if( ! self::$child_args['image'] ) {

			if( self::$child_args['circle'] == 'yes' ) {
				$attr['class'] .= ' flip-box-circle';

				if( self::$child_args['circle_color'] ) {
					$attr['style'] = sprintf( 'background-color:%s;', self::$child_args['circle_color'] );
				}

				if( self::$child_args['circle_border_color'] ) {
					$attr['style'] .= sprintf( 'border-color:%s;', self::$child_args['circle_border_color'] );
				}

				if( self::$child_args['circle_paddingbottom'] ) {
					$attr['style'] .= sprintf( 'padding-bottom:%s;', self::$child_args['circle_paddingbottom'] );
				}

				if( self::$child_args['circle_paddingleft'] ) {
					$attr['style'] .= sprintf( 'padding-left:%s;', self::$child_args['circle_paddingleft'] );
				}

				if( self::$child_args['circle_paddingright'] ) {
					$attr['style'] .= sprintf( 'padding-right:%s;', self::$child_args['circle_paddingright'] );
				}

				if( self::$child_args['circle_paddingtop'] ) {
					$attr['style'] .= sprintf( 'padding-top:%s;', self::$child_args['circle_paddingtop'] );
				}


			} else {
				$attr['class'] .= ' flip-box-no-circle';
			}
		} else {
			$attr['class'] .= ' flip-box-image';
			if( self::$child_args['circle_image'] == 'yes' ) {
				$attr['class'] .= ' flip-box-circle-image';
			}
		}

		return $attr;

	}

	function icon_attr() {

		$attr = array();

		if( self::$child_args['image'] ) {
			$attr['class'] = 'image';
		} else if( self::$child_args['icon'] ) {
			$attr['class'] = sprintf( 'shortcode-icon shortcode-icon-%s', self::$child_args['icon'] );
		}

		if( self::$child_args['icon_color'] ) {
			$attr['style'] = sprintf( 'color:%s;', self::$child_args['icon_color'] );
		}
		if( self::$child_args['icon_size'] ) {
			$attr['style'] .= sprintf( 'font-size:%s;', self::$child_args['icon_size'] );
		}

		if( self::$child_args['flip'] && self::$child_args['flip'] == 'yes' && self::$child_args['icon_flip'] && self::$child_args['rotate'] != 'yes'  ) {
			$attr['class'] .= ' shortcode-icon-flip-' . self::$child_args['icon_flip'];
		}

		if( self::$child_args['rotate'] && self::$child_args['rotate'] == 'yes' && self::$child_args['icon_rotate'] && self::$child_args['flip'] != 'yes'  ) {
			$attr['class'] .= ' shortcode-icon-rotate-' . self::$child_args['icon_rotate'];
		}

		if( self::$child_args['spin'] && self::$child_args['spin'] == 'yes' ) {
			$attr['class'] .= ' shortcode-icon-spin speed-'.self::$child_args['spin_speed'];
			$attr['style'] .= '-webkit-animation: spin '.self::$child_args['spin_speed'].'s infinite linear;-moz-animation: spin '.self::$child_args['spin_speed'].'s infinite linear;-o-animation: spin '.self::$child_args['spin_speed'].'s infinite linear;animation: spin '.self::$child_args['spin_speed'].'s infinite linear;';
		}

		if( self::$child_args['animation'] && self::$child_args['animation'] == 'yes' && self::$child_args['animation_type'] && self::$child_args['spin'] != 'yes' ) {
			$animations = $this->animations( array(
				'animation'	  => self::$child_args['animation'],
				'type'	  => self::$child_args['animation_type'],
				'direction' => self::$child_args['animation_direction'],
				'speed'	 => self::$child_args['animation_speed'],
			) );

			$attr = array_merge( $attr, $animations );

			$attr['class'] .= ' ' . $attr['animation_class'];
			unset($attr['animation_class']);
		}

		return $attr;

	}

	function heading_front_attr() {

		$attr['class'] = 'flip-box-heading';

		if( ! self::$child_args['text_front'] ) {
			$attr['class'] .= ' without-text';
		}
		$fonts = \A3Rev\RShortcode\HookFunction::_generate_font_css(self::$child_args['title_front_size'], self::$child_args['title_front_face'], self::$child_args['title_front_style'], self::$child_args['title_front_color'], self::$child_args['title_front_line_height'] );
		$attr['style'] = $fonts;

		return $attr;

	}

	function heading_back_attr() {

		$attr['class'] = 'flip-box-heading-back';
		$fonts = \A3Rev\RShortcode\HookFunction::_generate_font_css(self::$child_args['title_back_size'], self::$child_args['title_back_face'], self::$child_args['title_back_style'], self::$child_args['title_back_color'], self::$child_args['title_back_line_height'] );
		$attr['style'] = $fonts;
		return $attr;
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
