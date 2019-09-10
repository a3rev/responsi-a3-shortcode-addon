<?php
class Shortcode_Columns_OneSixth {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'responsi_shortcode_attr_one-sixth-shortcode', array( $this, 'attr' ) );
		add_filter( 'responsi_shortcode_attr_one-sixth-shortcode-wrapper', array( $this, 'wrapper_attr' ) );
		add_shortcode( 'one_sixth', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 *
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		do_action('_front_enqueue_css_and_js');
		$defaults =	shortcode_atts(
			array(
				'wrapelement'			=> 'no',
				'class'					=> '',
				'id'					=> '',
				'backgroundcolor'		=> 'transparent',
				'onoff_backgroundimage'		=> 'off',
				'backgroundimage'		=> '',
				'backgroundposition' 	=> 'left top',
				'backgroundrepeat' 	=> 'no-repeat',
				'bordercolor'			=> '#ffffff',
				'bordersize'			=> '0',
				'borderstyle'			=> 'solid',
				'last'  				=> 'no',
				'padding'			=> 'no',
				'paddingtop'				=> '',
				'paddingbottom'				=> '',
				'paddingleft'				=> '',
				'paddingright'				=> '',
				'spacing'				=> 'no',
				'margintop'				=> '0px',
				'marginbottom'				=> '20px'
			), $args
		);

		extract( $defaults );

		self::$args = $defaults;

		$clearfix = '';
		if( self::$args['last'] == 'yes' ) {
			$clearfix = sprintf( '<div %s></div>', Responsi_A3_Shortcode_Class::attributes( 'responsi-clearfix' ) );
		}

		$html = sprintf( trim('<div %s><div %s>%s</div></div>%s'), Responsi_A3_Shortcode_Class::attributes( 'one-sixth-shortcode' ), Responsi_A3_Shortcode_Class::attributes( 'one-sixth-shortcode-wrapper' ), do_shortcode( $content ), $clearfix );

		return $html;

	}

	function attr() {

		$attr['class'] = 'responsi-one-sixth responsi-layout-column responsi-column';
		$attr['style'] = '';
		if( self::$args['spacing'] == 'no' ) {
			//$attr['style'] = 'width:16.6666%';
		}

		if( self::$args['spacing'] == 'yes' && self::$args['margintop'] ) {
			$attr['style'] .= sprintf( 'margin-top:%s;', self::$args['margintop'] );
		}
		if( self::$args['spacing'] == 'yes' && self::$args['marginbottom'] ) {
			$attr['style'] .= sprintf( 'margin-bottom:%s;', self::$args['marginbottom'] );
		}

		if( self::$args['last'] == 'yes' || 
			self::$args['spacing'] == 'no'
		) {
			$attr['class'] .= ' last';
		}

		$attr['class'] .= ' spacing-' . self::$args['spacing'];

		if( self::$args['wrapelement'] == 'yes' && self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['wrapelement'] == 'yes' && self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}


		return $attr;

	}

	function wrapper_attr() {
		$attr = array();

		$attr['class'] = 'responsi-column-wrapper';

		$attr['style'] = '';


		if( self::$args['onoff_backgroundimage'] && self::$args['onoff_backgroundimage'] == 'on' && self::$args['backgroundimage'] ) {
			//$attr['style'] .= sprintf( 'background:url(\'%s\') %s %s %s;', self::$args['backgroundimage'], self::$args['backgroundposition'], self::$args['backgroundrepeat'], self::$args['backgroundcolor']  );
			$attr['style'] .= sprintf( 'background-image:url("%s");', self::$args['backgroundimage'] );
			$attr['style'] .= sprintf( 'background-position:%s;', self::$args['backgroundposition'] );
			$attr['style'] .= sprintf( 'background-repeat:%s;', self::$args['backgroundrepeat'] );
			$attr['style'] .= sprintf( 'background-color:%s;', self::$args['backgroundcolor'] );

			if( self::$args['backgroundrepeat'] == 'no-repeat') {
				$attr['style'] .= '-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;';
			}
		}elseif( self::$args['backgroundcolor'] ) {
			$attr['style'] .= sprintf( 'background-color:%s;', self::$args['backgroundcolor'] );
		}

		if( self::$args['bordercolor'] && self::$args['bordersize'] && self::$args['borderstyle'] ) {
			if( Responsi_A3_Shortcode_Class::is_transparent_color( self::$args['bordercolor'] ) ) {
				$attr['style'] .= sprintf( 'outline:%s %s %s;', self::$args['bordersize'], self::$args['borderstyle'], self::$args['bordercolor'] );
				$attr['style'] .= sprintf( 'outline-offset: -%s;', self::$args['bordersize'] );
			} else {
				$attr['style'] .= sprintf( 'border:%s %s %s;', self::$args['bordersize'], self::$args['borderstyle'], self::$args['bordercolor'] );
			}
		}

		if( self::$args['padding'] == 'yes' ){

			if( self::$args['paddingtop'] ) {
				$attr['style'] .= sprintf( 'padding-top:%s;', self::$args['paddingtop'] );
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
		}
		return $attr;
	}

}
