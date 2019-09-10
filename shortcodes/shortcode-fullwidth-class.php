<?php
class Shortcode_Fullwidth_Class {

	public static $args;
	public static $bg_type = 'image';

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 'responsi_list_shortcode', array($this, '_shortcode_hook') );
		add_filter( 'responsi_shortcode_attr_fullwidth-shortcode', array( $this, 'attr' ) );
		add_filter( 'responsi_shortcode_attr_fullwidth-overlay', array( $this, 'overlay_attr' ) );
		add_filter( 'responsi_shortcode_attr_fullwidth-faded', array( $this, 'faded_attr' ) );
		add_shortcode( 'a3_fullwidth', array( $this, 'render' ) );
	}

	public static function _shortcode_hook( $responsi_list_shortcode ){
		$responsi_list_shortcode[] = 'a3_fullwidth';
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

		if( !isset($default_options['responsi_sc_fullwidth_border']) ){
			$default_options['responsi_sc_fullwidth_border'] = array('width' => '0','style' => 'solid','color' => '#eae9e9');
		}
		do_action('_front_enqueue_css_and_js');
		$defaults =	Responsi_A3_Shortcode_Class::set_shortcode_defaults(
			array(
				'wrapelement'				=> 'no',
				'class'						=> '',
				'id' 						=> '',
				'onoff_backgroundimage'		=> 'off',
				'backgroundattachment' 		=> 'scroll',
				'backgroundcolor'			=> 'transparent',
				'backgroundimage' 			=> '',
				'backgroundposition' 		=> 'left top',
				'backgroundrepeat' 			=> 'no-repeat',
				'bordercolor' 				=> 'transparent',
				'bordersize' 				=> '0px',
				'borderstyle' 				=> 'solid',
				'equal_height_columns'		=> 'no',
				'fade'						=> 'no',
				'menuanchor' 				=> '',
				'overlay_color'				=> '',
				'overlay_opacity'			=> '0.5',
				'paddingBottom' 			=> '', // deprecated
				'paddingTop' 				=> '', // deprecated
				'margin'					=> 'no',
				'margintop'					=> '0px',
				'marginbottom'				=> '0px',
				'padding'					=> 'no',
				'paddingbottom' 			=> '0px',
				'paddingtop'				=> '0px',
				'paddingleft' 				=> '0px',
				'paddingright'				=> '0px',
				'video'						=> 'no',
				'video_background'			=> 'no',
				'video_loop'				=> 'no',
				'video_mp4'					=> '',
				'video_mute'				=> 'no',
				'video_ogv'					=> '',
				'video_preview_image'		=> '',
				'video_webm'				=> '',
				'hundred_percent'			=> 'no',
				'contentwidth'				=> $default_options['responsi_sc_fullwidth_content_width'].'px',
				'contentpadding'			=> 'no',
				'contentpaddingbottom' 		=> '0px',
				'contentpaddingleft' 		=> '0px',
				'contentpaddingright'		=> '0px',
				'contentpaddingtop'			=> '0px',
			), $args
		);

		if( $defaults['hundred_percent'] == 'yes' ) {
			$defaults['paddingleft'] = '0px';
			$defaults['paddingright'] = '0px';
			$defaults['contentwidth'] = 'none';
		}

		if( $defaults['margin'] != 'yes' ) {
			$defaults['margintop'] = '0px';
			$defaults['marginbottom'] = '0px';
		}

		if( $defaults['padding'] != 'yes' ) {
			$defaults['paddingtop'] = '0px';
			$defaults['paddingbottom'] = '0px';
			$defaults['paddingleft'] = '0px';
			$defaults['paddingright'] = '0px';
		}
		if( $defaults['contentpadding'] != 'yes' ) {
			$defaults['contentpaddingtop'] = '0px';
			$defaults['contentpaddingbottom'] = '0px';
			$defaults['contentpaddingleft'] = '0px';
			$defaults['contentpaddingright'] = '0px';
		}

		extract( $defaults );

		self::$args = $defaults;

		$this->depracted_args();

		$outer_html = '';

		self::$bg_type = 'image';

		if( ( $video == 'yes' && ($video_mp4 || $video_ogv || $video_webm )) ) {
			self::$bg_type = 'video';
		}

		if( $fade == 'yes' ) {
			self::$bg_type = 'faded';
			$outer_html .= sprintf( '<div %s></div>', Responsi_A3_Shortcode_Class::attributes( 'fullwidth-faded' ) );
		}

		if( self::$bg_type == 'video' ) {
			$video_attributes = 'preload="auto" autoplay';
			$video_src = '';

			if( $video_loop == 'yes' ) {
				$video_attributes .= ' loop';
			}

			if( $video_mute == 'yes' ) {
				$video_attributes .= ' muted';
			}

			if( $video_mp4 ) {
				$video_src .= sprintf( '<source src="%s" type="video/mp4">', $video_mp4 );
			}

			if( $video_ogv ) {
				$video_src .= sprintf( '<source src="%s" type="video/ogg">', $video_ogg );
			}

			if( $video_webm ) {
				$video_src .= sprintf( '<source src="%s" type="video/webm">', $video_webm );
			}

			if( $overlay_color ) {
				$outer_html .= sprintf( '<div %s></div>', Responsi_A3_Shortcode_Class::attributes( 'fullwidth-overlay' ) );
			}

			$video_preview_image_html = '';
			if( $video_preview_image ) {
				$video_preview_image_style = sprintf('background-image:url(\'%s\');', $video_preview_image );
				$video_preview_image_html .= sprintf( '<div class="%s" style="%s"></div>', 'fullwidth-video-image', $video_preview_image_style );
			}

			$outer_html .= sprintf( '<div class="%s"><video class="object-exclude video-shortcode" %s>%s</video>%s</div>', 'fullwidth-video fullwidth-video-'.$video_background, $video_attributes, $video_src,$video_preview_image_html );
		}

		if( $defaults['menuanchor'] ) {
			$html = sprintf( '<div class="clear"></div><div id="%s"><div %s>%s<div %s><div class="fw-container" style="%s"><div class="fw-content" style="%s">%s</div></div></div></div></div><div class="clear"></div>', $defaults['menuanchor'], Responsi_A3_Shortcode_Class::attributes( 'fullwidth-shortcode' ), $outer_html, Responsi_A3_Shortcode_Class::attributes( 'responsi-row' ), Shortcode_Fullwidth_Class::attr_container_style(), Shortcode_Fullwidth_Class::attr_content_style(), do_shortcode( $content ) );
		} else {
			$html = sprintf( '<div class="clear"></div><div %s>%s<div %s><div class="fw-container" style="%s"><div class="fw-content" style="%s">%s</div></div></div></div><div class="clear"></div>', Responsi_A3_Shortcode_Class::attributes( 'fullwidth-shortcode' ), $outer_html, Responsi_A3_Shortcode_Class::attributes( 'responsi-row' ), $this->attr_container_style(), $this->attr_content_style(), do_shortcode( $content ) );
		}

		return $html;

	}

	function attr_container_style() {

		$attr_container_style = '';

		if( self::$args['contentwidth'] ) {
			$attr_container_style .= sprintf( 'max-width:%s;margin:0px auto;', self::$args['contentwidth'] );
		}else{
			$attr_container_style .= 'margin:0px auto;';
		}
		return $attr_container_style;

	}

	function attr_content_style() {

		$attr_content_style = '';

		if( self::$args['contentpaddingbottom'] ) {
			$attr_content_style .= sprintf( 'padding-bottom:%s;', self::$args['contentpaddingbottom'] );
		}

		if( self::$args['contentpaddingleft'] ) {
			$attr_content_style .= sprintf( 'padding-left:%s;', self::$args['contentpaddingleft'] );
		}

		if( self::$args['contentpaddingright'] ) {
			$attr_content_style .= sprintf( 'padding-right:%s;', self::$args['contentpaddingright'] );
		}

		if( self::$args['contentpaddingtop'] ) {
			$attr_content_style .= sprintf( 'padding-top:%s;', self::$args['contentpaddingtop'] );
		}

		return $attr_content_style;

	}

	function attr() {

		$attr['class'] = 'responsi-fullwidth fullwidth-box clearfix';
		$attr['style'] = '';

		if( self::$args['hundred_percent'] == 'yes' ) {
			$attr['class'] .= ' hundred-percent-fullwidth';
		}

		if( self::$bg_type == 'video' ) {
			$attr['class'] .= ' video-background video-background-'.self::$args['video_background'];
		} elseif( self::$bg_type == 'faded' ) {
			$attr['class'] .= ' faded-background';
		}

		if( self::$args['equal_height_columns'] == 'yes' ) {
			$attr['class'] .= ' equal-height-columns';
		}

		if( self::$bg_type != 'faded' && self::$args['backgroundcolor'] ) {
			$attr['style'] .= sprintf( 'background-color:%s;', self::$args['backgroundcolor'] );
		}

		if( self::$bg_type != 'faded' && self::$args['backgroundattachment'] ) {
			$attr['style'] .= sprintf( 'background-attachment:%s;', self::$args['backgroundattachment'] );
		}

		if( self::$bg_type != 'faded' ) {
			if( self::$args['onoff_backgroundimage'] && self::$args['onoff_backgroundimage'] == 'on' && self::$args['backgroundimage'] ) {
				$attr['style'] .= sprintf( 'background-image: url(\'%s\');', self::$args['backgroundimage'] );
			}
		}

		if( self::$bg_type != 'faded' && self::$args['backgroundposition'] ) {
			$attr['style'] .= sprintf( 'background-position:%s;', self::$args['backgroundposition'] );
		}

		if( self::$bg_type != 'faded' && self::$args['backgroundrepeat'] ) {
			$attr['style'] .= sprintf( 'background-repeat:%s;', self::$args['backgroundrepeat'] );
		}

		if( self::$bg_type != 'faded' && self::$args['backgroundrepeat'] == 'no-repeat') {
			$attr['style'] .= '-webkit-background-size:cover;-o-background-size:cover;background-size:cover;';
		}

		if( self::$args['bordercolor'] ) {
			$attr['style'] .= sprintf( 'border-color:%s;', self::$args['bordercolor'] );
		}

		if( self::$args['bordersize'] ) {
			$attr['style'] .= sprintf( 'border-bottom-width: %s;border-top-width: %s;', self::$args['bordersize'], self::$args['bordersize'] );
		}

		if( self::$args['borderstyle'] ) {
			$attr['style'] .= sprintf( 'border-bottom-style: %s;border-top-style: %s;', self::$args['borderstyle'], self::$args['borderstyle'] );
		}

		if( self::$args['paddingbottom'] ) {
			$attr['style'] .= sprintf( 'padding-bottom:%s;', self::$args['paddingbottom'] );
		}

		if( self::$args['paddingleft'] ) {
			$attr['style'] .= sprintf( 'padding-left:%s;', self::$args['paddingleft'] );
		}

		if( self::$args['paddingright'] ) {
			$attr['style'] .= sprintf( 'padding-right:%s;', self::$args['paddingright'] );
		}

		if( self::$args['paddingtop'] ) {
			$attr['style'] .= sprintf( 'padding-top:%s;', self::$args['paddingtop'] );
		}

		if( self::$args['margintop'] ) {
			$attr['style'] .= sprintf( 'margin-top:%s;', self::$args['margintop'] );
		}
		if( self::$args['marginbottom'] ) {
			$attr['style'] .= sprintf( 'margin-bottom:%s;', self::$args['marginbottom'] );
		}

		if( self::$args['wrapelement'] == 'yes' &&  self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}

		if( self::$args['wrapelement'] == 'yes' && self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		return $attr;

	}

	function overlay_attr() {

		$attr['class'] = 'fullwidth-overlay';
		$attr['style'] = '';

		if( self::$args['overlay_color'] ) {
			$attr['style'] .= sprintf( 'background-color:%s;', self::$args['overlay_color'] );
		}

		if( self::$args['overlay_opacity'] ) {
			$attr['style'] .= sprintf( 'opacity:%s;', self::$args['overlay_opacity'] );
		}

		return $attr;

	}

	function faded_attr() {

		$attr['class'] = 'fullwidth-faded';
		$attr['style'] = '';

		if( self::$args['onoff_backgroundimage'] && self::$args['onoff_backgroundimage'] == 'on' && self::$args['backgroundattachment'] ) {
			$attr['style'] .= sprintf( 'background-attachment:%s;', self::$args['backgroundattachment'] );
		}

		if( self::$args['backgroundcolor'] ) {
			$attr['style'] .= sprintf( 'background-color:%s;', self::$args['backgroundcolor'] );
		}

		if( self::$args['onoff_backgroundimage'] && self::$args['onoff_backgroundimage'] == 'on' && self::$args['backgroundimage'] ) {
			$attr['style'] .= sprintf( 'background-image: url(\'%s\');', self::$args['backgroundimage'] );
		}

		if( self::$args['onoff_backgroundimage'] && self::$args['onoff_backgroundimage'] == 'on' && self::$args['backgroundposition'] ) {
			$attr['style'] .= sprintf( 'background-position:%s;', self::$args['backgroundposition'] );
		}

		if( self::$args['onoff_backgroundimage'] && self::$args['onoff_backgroundimage'] == 'on' && self::$args['backgroundrepeat'] ) {
			$attr['style'] .= sprintf( 'background-repeat:%s;', self::$args['backgroundrepeat'] );
		}

		if( self::$args['onoff_backgroundimage'] && self::$args['onoff_backgroundimage'] == 'on' && self::$args['backgroundrepeat'] == 'no-repeat') {
			$attr['style'] .= '-webkit-background-size:cover;-o-background-size:cover;background-size:cover;';
		}

		return $attr;

	}

	private function depracted_args() {
		if( self::$args['paddingBottom'] ) {
			self::$args['paddingbottom'] = self::$args['paddingBottom'];
		}

		if( self::$args['paddingTop'] ) {
			self::$args['paddingtop'] = self::$args['paddingTop'];
		}
	}
}
$GLOBALS['Shortcode_Fullwidth_Class'] = new Shortcode_Fullwidth_Class();
?>
