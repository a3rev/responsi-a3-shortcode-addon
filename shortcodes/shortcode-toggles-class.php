<?php
class Shortcode_Toggles_Class {

	private $accordian_counter = 1;
	private $collapse_counter = 1;
	private $collapse_id;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 'responsi_list_shortcode', array($this, '_shortcode_hook') );
		add_filter( 'responsi_shortcode_attr_toggle-shortcode', array( $this, 'attr' ) );
		add_filter( 'responsi_shortcode_attr_toggle-shortcode-item', array( $this, 'item_attr' ) );
		add_filter( 'responsi_shortcode_attr_toggle-shortcode-panelgroup', array( $this, 'panelgroup_attr' ) );
		add_filter( 'responsi_shortcode_attr_toggle-shortcode-icon', array( $this, 'icon_attr' ) );
		add_filter( 'responsi_shortcode_attr_toggle-shortcode-data-toggle', array( $this, 'data_toggle_attr' ) );
		add_filter( 'responsi_shortcode_attr_toggle-shortcode-content-collapse', array( $this, 'collapse_content_attr' ) );
		add_filter( 'responsi_shortcode_attr_toggle-shortcode-collapse', array( $this, 'collapse_attr' ) );

		add_shortcode( 'a3_toggles', array( $this, 'render_parent' ) );
		add_shortcode( 'a3_toggle', array( $this, 'render_child' ) );

	}

	public static function _shortcode_hook( $responsi_list_shortcode ){
		$responsi_list_shortcode[] = 'a3_toggles';
		$responsi_list_shortcode[] = 'a3_toggle';
		return $responsi_list_shortcode;
	}

	/**
	 * Render the parent shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_parent( $args, $content = '') {
		do_action('_front_enqueue_css_and_js');
		$defaults = Responsi_A3_Shortcode_Class::set_shortcode_defaults(
			array(
				'class' 	=> '',
				'id' 		=> '',
				'title_size' 		=> '18px',
				'color' 		=> '#333333',
				'activecolor' 		=> '#a0ce4e',
				'iconcolor' 		=> '#ffffff',
				'iconactivecolor' 		=> '#ffffff',
				'margintop' 		=> '0px',
				'marginbottom' 		=> '0px',
			), $args
		);

		extract( $defaults );

		self::$parent_args = $defaults;
		$styles = "<style type='text/css'>
		#accordion-{$this->accordian_counter}.panel-group h4 a{
			color:".$color.";
		}
		#accordion-{$this->accordian_counter}.panel-group h4{
			font-size:".$title_size.";
			line-height:100%;
		}
		#accordion-{$this->accordian_counter}.panel-group h4 a .shortcode-icomoon-box::before, #accordion-{$this->accordian_counter}.panel-group h4 .shortcode-icomoon-box::before{
			line-height:1 !important;
			font-size:".$title_size.";
		}
		#accordion-{$this->accordian_counter}.panel-group h4 a .shortcode-icomoon-box, #accordion-{$this->accordian_counter}.panel-group h4 .panel-collapse .shortcode-icomoon-box{
			line-height:1;
			width:".$title_size.";
			height:".$title_size.";
			padding-left:1px;
		}
		#accordion-{$this->accordian_counter}.panel-group h4 a.active,#accordion-{$this->accordian_counter}.panel-group h4 a:hover{
			color:".$activecolor.";
		}
		#accordion-{$this->accordian_counter}.panel-group h4 a i{
			background-color:".$color.";
			color:".$iconcolor.";
		}
		#accordion-{$this->accordian_counter}.panel-group h4 a.active i,#accordion-{$this->accordian_counter}.panel-group h4 a:hover i{
			background-color:".$activecolor.";
			color:".$iconactivecolor.";
		}
		</style>";
		$html = sprintf( '<div class="clear"></div><div %s><div %s>%s</div></div><div class="clear"></div>', Responsi_A3_Shortcode_Class::attributes( 'toggle-shortcode' ), Responsi_A3_Shortcode_Class::attributes( 'toggle-shortcode-panelgroup' ),  do_shortcode( $content ) );

		$this->accordian_counter++;
		//return '';
		return $html.$styles;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'shortcode-accordian responsi-accordian';

		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' . self::$parent_args['class'];
		}

		if( self::$parent_args['id'] ) {
			$attr['id'] = self::$parent_args['id'];
		}
		$attr['style'] = sprintf( 'margin-top:%s;', self::$parent_args['margintop'] );
		$attr['style'] .= sprintf( 'margin-bottom:%s;', self::$parent_args['marginbottom'] );
		return $attr;

	}

	function panelgroup_attr() {
		$attr = array();
		$attr['class'] = 'panel-group';
		$attr['id'] = 'accordion-' . $this->accordian_counter;
		return $attr;

	}

	/**
	 * Render the child shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_child( $args, $content = '') {

		$defaults = Responsi_A3_Shortcode_Class::set_shortcode_defaults(
			array(
				'open' 		=> 'no',
				'title'		=> '&nbsp;',
				'title_padding_top' 		=> '0px',
				'title_padding_bottom' 		=> '0px',
				'title_padding_left' 		=> '0px',
				'title_padding_right' 		=> '0px',
				'content_padding_top' 		=> '0px',
				'content_padding_bottom' 		=> '0px',
				'content_padding_left' 		=> '0px',
				'content_padding_right' 		=> '0px',
				'background' 		=> 'transparent',
				'bordertopsize' 		=> '0px',
				'bordertopstyle' 		=> 'solid',
				'bordertopcolor' 		=> '#e5e4e3',
				'borderbottomsize' 		=> '0px',
				'borderbottomstyle' 		=> 'solid',
				'borderbottomcolor' 		=> '#e5e4e3',
				'borderleftsize' 		=> '0px',
				'borderleftstyle' 		=> 'solid',
				'borderleftcolor' 		=> '#e5e4e3',
				'borderrightsize' 		=> '0px',
				'borderrightstyle' 		=> 'solid',
				'borderrightcolor' 		=> '#e5e4e3',
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
				'corner' 					=> 'false',
				'border_corner' 			=> '0',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		self::$child_args['toggle_class'] = '';

		if( $open == 'yes' ) {
			self::$child_args['toggle_class'] = 'in';
		}

		$this->collapse_id = substr( md5( sprintf( 'collapse-%s-%s', $this->accordian_counter, $this->collapse_counter ) ), 15 );

		$html = sprintf( '<div %s %s><div %s><h4 %s><a %s><i %s></i>%s</a></h4></div><div %s><i %s></i><div %s %s>%s</div></div></div>', Responsi_A3_Shortcode_Class::attributes( 'responsi-panel panel-default' ), Responsi_A3_Shortcode_Class::attributes( 'toggle-shortcode-item' ),
						 Responsi_A3_Shortcode_Class::attributes( 'panel-heading' ), Responsi_A3_Shortcode_Class::attributes( 'panel-title toggle' ), Responsi_A3_Shortcode_Class::attributes( 'toggle-shortcode-data-toggle' ),
						 Responsi_A3_Shortcode_Class::attributes( 'toggle-shortcode-icon' ), $title, Responsi_A3_Shortcode_Class::attributes( 'toggle-shortcode-collapse' ),
						 Responsi_A3_Shortcode_Class::attributes( 'toggle-shortcode-icon' ),Responsi_A3_Shortcode_Class::attributes( 'panel-body toggle-content' ), Responsi_A3_Shortcode_Class::attributes( 'toggle-shortcode-content-collapse' ), do_shortcode($content));

		$this->collapse_counter++;

		return $html;

	}

	function icon_attr() {

		$attr = array();

		$attr['class'] = 'shortcode-icomoon-box';

		return $attr;

	}

	function data_toggle_attr() {

		$attr = array();

		if( self::$child_args['open'] == 'yes' ) {
			$attr['class'] = 'active';
		}
		$attr['data-toggle'] = 'collapse';
		$attr['data-parent'] = '#accordion-' . $this->accordian_counter;
		$attr['data-target'] = '#' . $this->collapse_id;
		$attr['href'] = '#' . $this->collapse_id;
		$attr['style'] = sprintf( 'padding-top:%s;', self::$child_args['title_padding_top'] );
		$attr['style'] .= sprintf( 'padding-bottom:%s;', self::$child_args['title_padding_bottom'] );
		$attr['style'] .= sprintf( 'padding-left:%s;', self::$child_args['title_padding_right'] );
		$attr['style'] .= sprintf( 'padding-right:%s;', self::$child_args['title_padding_right'] );
		$attr['style'] .= sprintf( 'clear:%s;', 'both' );

		return $attr;

	}

	function collapse_attr() {

		$attr = array();

		$attr['id'] = $this->collapse_id;
		$attr['class'] = 'panel-collapse collapse ' . self::$child_args['toggle_class'];
		return $attr;

	}
	function collapse_content_attr() {
		$attr = array();
		$attr['style'] = sprintf( 'padding-top:%s;', self::$child_args['content_padding_top'] );
		$attr['style'] .= sprintf( 'padding-bottom:%s;', self::$child_args['content_padding_bottom'] );
		$attr['style'] .= sprintf( 'padding-left:%s;', self::$child_args['content_padding_left'] );
		$attr['style'] .= sprintf( 'padding-right:%s;', self::$child_args['content_padding_right'] );
		return $attr;

	}

	function item_attr() {
		$attr = array();
		$attr['style'] = sprintf( 'background-color:%s;', self::$child_args['background'] );
		$attr['style'] .= sprintf( 'border-top:%s %s %s;', self::$child_args['bordertopsize'], self::$child_args['bordertopstyle'], self::$child_args['bordertopcolor'] );
		$attr['style'] .= sprintf( 'border-bottom:%s %s %s;', self::$child_args['borderbottomsize'], self::$child_args['borderbottomstyle'], self::$child_args['borderbottomcolor'] );
		$attr['style'] .= sprintf( 'border-left:%s %s %s;', self::$child_args['borderleftsize'], self::$child_args['borderleftstyle'], self::$child_args['borderleftcolor'] );
		$attr['style'] .= sprintf( 'border-right:%s %s %s;', self::$child_args['borderrightsize'], self::$child_args['borderrightstyle'], self::$child_args['borderrightcolor'] );
		$attr['style'] .= sprintf( 'padding-top:%s;', self::$child_args['padding_top'] );
		$attr['style'] .= sprintf( 'padding-bottom:%s;', self::$child_args['padding_bottom'] );
		$attr['style'] .= sprintf( 'padding-top:%s;', self::$child_args['padding_left'] );
		$attr['style'] .= sprintf( 'padding-right:%s;', self::$child_args['padding_right'] );
		$attr['style'] .= sprintf( 'padding-left:%s;', self::$child_args['padding_right'] );
		$attr['style'] .= sprintf( 'margin-top:%s;', self::$child_args['margin_top'] );
		$attr['style'] .= sprintf( 'margin-bottom:%s;', self::$child_args['margin_bottom'] );
		$attr['style'] .= sprintf( 'margin-left:%s;', self::$child_args['margin_left'] );
		$attr['style'] .= sprintf( 'margin-right:%s;', self::$child_args['margin_right'] );
		if( self::$child_args['corner'] == 'true') $corner = 'rounded';
		else $corner = 'square';
		$border_corner = str_replace('px', '', self::$child_args['border_corner']);
		$attr['style'] .= sprintf( '%s', responsi_generate_border_radius(array( "corner" => strtolower($corner), "rounded_value" => $border_corner ), true) );
		return $attr;

	}
}
$GLOBALS['Shortcode_Toggles_Class'] = new Shortcode_Toggles_Class();
?>
