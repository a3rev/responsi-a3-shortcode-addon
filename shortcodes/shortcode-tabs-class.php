<?php
class Shortcode_Tabs_Class {

	private $tabs_counter = 1;
	private $tabs = array();
	private $active = false;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 'responsi_list_shortcode', array($this, '_shortcode_hook') );
		add_filter( 'responsi_list_shortcode_font_attr', array( $this, '_filter_field_google_webfonts' ) );
		add_filter( 'responsi_shortcode_attr_tabs-shortcode', array( $this, 'attr' ) );
		add_filter( 'responsi_shortcode_attr_tabs-shortcode-link', array( $this, 'link_attr' ) );
		add_filter( 'responsi_shortcode_attr_tabs-shortcode-icon', array( $this, 'icon_attr' ) );
		add_filter( 'responsi_shortcode_attr_tabs-shortcode-tab', array( $this, 'tab_attr' ) );

		add_shortcode( 'dotabs', array( $this, 'render_parent' ) );
		add_shortcode( 'dotab', array( $this, 'render_child' ) );
		add_shortcode( 'a3_tabs', array( $this, 'a3_tabs' ) );
		add_shortcode( 'a3_tab', array( $this, 'a3_tab' ) );

	}

	public static function _shortcode_hook( $responsi_list_shortcode ){
		$responsi_list_shortcode[] = 'dotabs';
		$responsi_list_shortcode[] = 'dotab';
		$responsi_list_shortcode[] = 'a3_tabs';
		$responsi_list_shortcode[] = 'a3_tab';
		return $responsi_list_shortcode;
	}

	public function _filter_field_google_webfonts( $fields ){
		$fields[] = 'font_face';
		$fields[] = 'fontcontent_face';
		return $fields;
	}

	/**
	 * Render the parent shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_parent( $args, $content = '') {

		do_action('_front_enqueue_css_and_js');

		$defaults =  self::$parent_args;

		extract( $defaults );

		if( $cornertl == 'square'){
			$cornertopleft = 0;
		}
		if( $cornertr == 'square'){
			$cornertopright = 0;
		}
		if( $cornerbl == 'square'){
			$cornerbottomleft = 0;
		}
		if( $cornerbr == 'square'){
			$cornerbottomright = 0;
		}

		if( $ccornertl == 'square'){
			$ccornertopleft = 0;
		}
		if( $ccornertr == 'square'){
			$ccornertopright = 0;
		}
		if( $ccornerbl == 'square'){
			$ccornerbottomleft = 0;
		}
		if( $ccornerbr == 'square'){
			$ccornerbottomright = 0;
		}

		$justified_class = '';
		if( $justified == 'yes' &&
			$layout != 'vertical'
		) {
			$justified_class = ' nav-justified';
		}

		$tabitemwidth = '15';
		if( $layout== 'vertical' ) {
			$tabitemwidth = $tabwidth;
		}

		$tabcontentwidth = ( 100 - $tabitemwidth ) - 0.01;

		$fonts = Responsi_A3_Shortcode_Class::_generate_font_css($font_size, $font_face, $font_style, $font_color, $font_line_height, true);
		$contentfonts = Responsi_A3_Shortcode_Class::_generate_font_css($fontcontent_size, $fontcontent_face, $fontcontent_style, $fontcontent_color, $fontcontent_line_height, true);
		$tabcorner = '';
		if( $tab_corner == 'rounded'){
			$tabcorner = Responsi_A3_Shortcode_Class::_generate_border_radius_css( $tab_cornervalue, $tab_cornervalue, $tab_cornervalue, $tab_cornervalue );
		}else{
			$tabcorner = Responsi_A3_Shortcode_Class::_generate_border_radius_css();
		}

		if( $ctmargin == 'false' || $ctmargin == false){
			$ctmargin_top = 0;
			$ctmargin_bottom = 0;
		}

		$styles = '
			.responsi-tabs.responsi-tabs-'.$this->tabs_counter.'{
				margin-top:'.str_replace("px", "", $ctmargin_top).'px;
				margin-bottom:'.str_replace("px", "", $ctmargin_bottom).'px;
			}
		';

		if( $layout== 'vertical' ) {
			$styles .= '.responsi-tabs.vertical-tabs.responsi-tabs-'.$this->tabs_counter.' .nav-tabs{
				width:'.$tabitemwidth.'%;
			}
			.responsi-tabs.vertical-tabs.responsi-tabs-'.$this->tabs_counter.' .tab-content{
				width:'.$tabcontentwidth.'%;
			}
			';
		}

		$styles .= '
			.responsi-tabs.responsi-tabs-'.$this->tabs_counter.' .nav-tabs, .responsi-tabs.responsi-tabs-'.$this->tabs_counter.' .tab-pane{
				border:'.str_replace("px", "", $tab_bordersize).'px '.strtolower($tab_borderstyle).' '.strtolower($tab_bordercolor).' !important;
				'.$tabcorner.'
			}
		';

		if( $layout == 'horizontal' ){
			$styles .= '
				.responsi-tabs.nav-not-justified.horizontal-tabs.responsi-tabs-'.$this->tabs_counter.' .nav-tabs{
					margin-bottom:-'.str_replace("px", "", $tab_bordersize).'px;
				}
			';
		}else{
			$styles .= '
				.responsi-tabs.vertical-tabs.responsi-tabs-'.$this->tabs_counter.' .nav-tabs{
					margin-right:-'.str_replace("px", "", $tab_bordersize).'px;
				}
			';
		}

		if ($onbackgroundcolor == 'false'){
			$backgroundcolor = 'transparent';
		}
		if ($onbackgroundcoloractive == 'false'){
			$backgroundcoloractive = 'transparent';
		}
		$styles .='
		.responsi-tabs.responsi-tabs-'.$this->tabs_counter.' .nav-tabs li .tab-link,.responsi-tabs.responsi-tabs-'.$this->tabs_counter.' .nav-tabs li > a{
			background-color:'.$backgroundcolor.';
			'.$fonts.'
			border-top:'.str_replace("px", "", $bordertopsize).'px '.strtolower($bordertopstyle).' '.strtolower($bordertopcolor).' !important;
			border-bottom:'.str_replace("px", "", $borderbottomsize).'px '.strtolower($borderbottomstyle).' '.strtolower($borderbottomcolor).' !important;
			border-left:'.str_replace("px", "", $borderleftsize).'px '.strtolower($borderleftstyle).' '.strtolower($borderleftcolor).' !important;
			border-right:'.str_replace("px", "", $borderrightsize).'px '.strtolower($borderrightstyle).' '.strtolower($borderrightcolor).' !important;
			padding-top:'.str_replace("px", "",$padding_top).'px;padding-bottom:'.str_replace("px", "",$padding_bottom).'px;padding-left:'.str_replace("px", "",$padding_left).'px;padding-right:'.str_replace("px", "",$padding_right).'px;
			margin-top:'.str_replace("px", "",$margin_top).'px;margin-bottom:'.str_replace("px", "",$margin_bottom).'px;margin-left:'.str_replace("px", "",$margin_left).'px;margin-right:'.str_replace("px", "",$margin_right).'px;
			'.Responsi_A3_Shortcode_Class::_generate_border_radius_css( $cornertopleft, $cornertopright, $cornerbottomleft, $cornerbottomright ).'
		}

		.responsi-tabs.responsi-tabs-'.$this->tabs_counter.' .nav-tabs li.active .tab-link, .responsi-tabs.responsi-tabs-'.$this->tabs_counter.' .nav-tabs li.active > a,.responsi-tabs.responsi-tabs-'.$this->tabs_counter.' .nav-tabs li:hover .tab-link, .responsi-tabs.responsi-tabs-'.$this->tabs_counter.' .nav-tabs li:hover > a{
			background-color:'.$backgroundcoloractive.' !important;
			color:'.$coloractive.' !important;
			border-top-color:'.$bordertopactive.' !important;
			border-bottom-color:'.$borderbottomactive.' !important;
			border-left-color:'.$borderleftactive.' !important;
			border-right-color:'.$borderrightactive.' !important;
		}
		.responsi-tabs.responsi-tabs-'.$this->tabs_counter.' .tab-pane{
			background-color:'.$backgroundcoloractive.' !important;
		}
		.responsi-tabs.responsi-tabs-'.$this->tabs_counter.' .tab-pane .content-tabs{
			'.$contentfonts.';
			border-top:'.str_replace("px", "", $cbordertopsize).'px '.strtolower($cbordertopstyle).' '.strtolower($cbordertopcolor).' !important;
			border-bottom:'.str_replace("px", "", $cborderbottomsize).'px '.strtolower($cborderbottomstyle).' '.strtolower($cborderbottomcolor).' !important;
			border-left:'.str_replace("px", "", $cborderleftsize).'px '.strtolower($cborderleftstyle).' '.strtolower($cborderleftcolor).' !important;
			border-right:'.str_replace("px", "", $cborderrightsize).'px '.strtolower($cborderrightstyle).' '.strtolower($cborderrightcolor).' !important;
			padding-top:'.str_replace("px", "",$cpadding_top).'px;padding-bottom:'.str_replace("px", "",$cpadding_bottom).'px;padding-left:'.str_replace("px", "",$cpadding_left).'px;padding-right:'.str_replace("px", "",$cpadding_right).'px;
			margin-top:'.str_replace("px", "",$cmargin_top).'px;margin-bottom:'.str_replace("px", "",$cmargin_bottom).'px;margin-left:'.str_replace("px", "",$cmargin_left).'px;margin-right:'.str_replace("px", "",$cmargin_right).'px;
			'.Responsi_A3_Shortcode_Class::_generate_border_radius_css( $ccornertopleft, $ccornertopright, $ccornerbottomleft, $ccornerbottomright ).'
		}
		';

		$styles = sprintf( '<style type="text/css">%s</style>', $styles );

		$html = sprintf( '<div %s>%s<div %s><ul %s>', Responsi_A3_Shortcode_Class::attributes( 'tabs-shortcode' ), $styles, Responsi_A3_Shortcode_Class::attributes( 'nav' ), Responsi_A3_Shortcode_Class::attributes( 'nav-tabs'.$justified_class ) );

		$is_first_tab = true;

		if( empty( $this->tabs ) ) {
			$this->parse_tab_parameter( $content, 'dotab', $args );
		}

		for( $i = 0; $i < count( $this->tabs ); $i++ ) {
			$icon = '';
			if(	$this->tabs[$i]['icon'] != 'none' ) {
				if( $this->tabs[$i]['icon_color'] != 'transparent' ){
					$icon_color = ' style="color:'.$this->tabs[$i]['icon_color'].'"';
				}
				$icon =  sprintf( '<i %s%s></i>', Responsi_A3_Shortcode_Class::attributes( 'tabs-shortcode-icon', array( 'index' => $i ) ),$icon_color  );
			}

			if( $is_first_tab ) {
				$html .= sprintf( '<li %s><a %s>%s%s</a></li>', Responsi_A3_Shortcode_Class::attributes( 'active' ), Responsi_A3_Shortcode_Class::attributes( 'tabs-shortcode-link', array( 'index' => $i ) ),
								  $icon, $this->tabs[$i]['title'] );
				$is_first_tab = false;
			} else {
				$html .= sprintf( '<li><a %s>%s%s</a></li>', Responsi_A3_Shortcode_Class::attributes( 'tabs-shortcode-link', array( 'index' => $i ) ),
								  $icon, $this->tabs[$i]['title'] );
			}
		}

		$html .= '';
		$html .= sprintf( '</ul></div><div %s>%s</div></div>', Responsi_A3_Shortcode_Class::attributes( 'tab-content' ), do_shortcode($content) );

		$this->tabs_counter++;
		$this->active = false;
		unset( $this->tabs );

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'responsi-tabs responsi-tabs-%s %s justified-%s', $this->tabs_counter, self::$parent_args['design'], self::$parent_args['justified'] );

		if( self::$parent_args['justified'] != 'yes' &&
			self::$parent_args['layout'] != 'vertical'
		) {
			$attr['class'] .= ' nav-not-justified';
		}else{
			$attr['class'] .= ' nav-justified';
		}

		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}

		if( self::$parent_args['layout'] == 'vertical' ) {
			$attr['class'] .= ' vertical-tabs';
		} else {
			$attr['class'] .= ' horizontal-tabs';
		}

		if( self::$parent_args['id'] ) {
			$attr['id'] = self::$parent_args['id'];
		}

		return $attr;

	}

	function link_attr( $atts ) {

		$attr = array();

		$index = $atts['index'];

		$attr['class'] = 'tab-link';
		$attr['id'] = strtolower( preg_replace( '/\s+/', '', $this->tabs[$index]['title'] ) );
		$attr['href'] = '#' . $this->tabs[$index]['unique_id'];
		$attr['data-toggle'] = 'tab';

		return $attr;

	}

	function icon_attr( $atts ) {

		$attr = array();

		$index = $atts['index'];

		$attr['class'] = sprintf( 'responsi-shortcode-icon shortcode-icon-%s', $this->tabs[$index]['icon'] );

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
				'icon'			=> 'none',
				'id'			=> '',
				'a3_tab'	=> 'no'
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;

		$html = sprintf( '<div %s><div class="content-tabs">%s</div></div>', Responsi_A3_Shortcode_Class::attributes( 'tabs-shortcode-tab' ), do_shortcode( $content ) );

		return $html;

	}

	function tab_attr() {

		$attr = array();

		if( ! isset( $this->active ) ) {
			$this->active = false;
		}

		if( ! $this->active ) {
			$attr['class'] = 'tab-pane fade in active';
			$this->active = true;
		} else {
			$attr['class'] = 'tab-pane fade';
		}

		if( self::$child_args['a3_tab'] == 'yes' ) {
			$attr['id'] = self::$child_args['id'];
		} else {
			$index = self::$child_args['id'] - 1;
			$attr['id'] = $this->tabs[$index]['unique_id'];
		}

		return $attr;

	}

	function a3_tabs( $atts, $content = null ) {
		global $responsi_options_a3_shortcode;
		if( is_array($responsi_options_a3_shortcode)){
			$default_options = $responsi_options_a3_shortcode;
		}else{
			global $responsi_a3_shortcode_addon;
			$default_options = $responsi_a3_shortcode_addon->global_responsi_options_a3_shortcode();
		}
		$defaults = Responsi_A3_Shortcode_Class::set_shortcode_defaults(
			array(
				'class' 					=> '',
				'id' 						=> '',
				'layout' 					=> 'horizontal',
				'justified'					=> 'no',
				'tabwidth'					=> '15',
				'design'					=> 'classic',
				'tab_bordersize'     		=> $default_options['responsi_sc_tab_border']['width'],
				'tab_borderstyle'			=> $default_options['responsi_sc_tab_border']['style'],
				'tab_bordercolor'			=> $default_options['responsi_sc_tab_border']['color'],
				'tab_corner'				=> $default_options['responsi_sc_tab_corner']['corner'],
				'tab_cornervalue'			=> $default_options['responsi_sc_tab_corner']['rounded_value'],
				'ctmargin' 					=> $default_options['responsi_sc_tab_ctmargin_on'],
				'ctmargin_top' 				=> $default_options['responsi_sc_tab_ctmargin_top'],
				'ctmargin_bottom' 			=> $default_options['responsi_sc_tab_ctmargin_bottom'],
				'font_size' 				=> $default_options['responsi_sc_tab_font']['size'],
				'font_line_height' 			=> $default_options['responsi_sc_tab_font']['line_height'],
				'font_face' 				=> $default_options['responsi_sc_tab_font']['face'],
				'font_style' 				=> $default_options['responsi_sc_tab_font']['style'],
				'font_color' 				=> $default_options['responsi_sc_tab_font']['color'],
				'onbackgroundcolor' 		=> $default_options['responsi_sc_tab_backgroundcolor']['onoff'],
				'backgroundcolor' 			=> $default_options['responsi_sc_tab_backgroundcolor']['color'],
				'bordertopsize'     		=> $default_options['responsi_sc_tab_bordertop']['width'],
				'bordertopstyle'			=> $default_options['responsi_sc_tab_bordertop']['style'],
				'bordertopcolor'			=> $default_options['responsi_sc_tab_bordertop']['color'],
				'borderbottomsize'     		=> $default_options['responsi_sc_tab_borderbottom']['width'],
				'borderbottomstyle'			=> $default_options['responsi_sc_tab_borderbottom']['style'],
				'borderbottomcolor'			=> $default_options['responsi_sc_tab_borderbottom']['color'],
				'borderleftsize'     		=> $default_options['responsi_sc_tab_borderleft']['width'],
				'borderleftstyle'			=> $default_options['responsi_sc_tab_borderleft']['style'],
				'borderleftcolor'			=> $default_options['responsi_sc_tab_borderleft']['color'],
				'borderrightsize'     		=> $default_options['responsi_sc_tab_borderright']['width'],
				'borderrightstyle'			=> $default_options['responsi_sc_tab_borderright']['style'],
				'borderrightcolor'			=> $default_options['responsi_sc_tab_borderright']['color'],
				'cornertl'					=> $default_options['responsi_sc_tab_cornertopleft']['corner'],
				'cornertopleft'				=> $default_options['responsi_sc_tab_cornertopleft']['rounded_value'],
				'cornertr'					=> $default_options['responsi_sc_tab_cornertopright']['corner'],
				'cornertopright'			=> $default_options['responsi_sc_tab_cornertopright']['rounded_value'],
				'cornerbl'					=> $default_options['responsi_sc_tab_cornerbottomleft']['corner'],
				'cornerbottomleft'			=> $default_options['responsi_sc_tab_cornerbottomleft']['rounded_value'],
				'cornerbr'					=> $default_options['responsi_sc_tab_cornerbottomright']['corner'],
				'cornerbottomright'			=> $default_options['responsi_sc_tab_cornerbottomright']['rounded_value'],
				'margin' 					=> $default_options['responsi_sc_tab_margin_on'],
				'margin_top' 				=> $default_options['responsi_sc_tab_margin_top'],
				'margin_bottom' 			=> $default_options['responsi_sc_tab_margin_bottom'],
				'margin_left' 				=> $default_options['responsi_sc_tab_margin_left'],
				'margin_right' 				=> $default_options['responsi_sc_tab_margin_right'],
				'padding' 					=> $default_options['responsi_sc_tab_padding_on'],
				'padding_top' 				=> $default_options['responsi_sc_tab_padding_top'],
				'padding_bottom' 			=> $default_options['responsi_sc_tab_padding_bottom'],
				'padding_left' 				=> $default_options['responsi_sc_tab_padding_left'],
				'padding_right' 			=> $default_options['responsi_sc_tab_padding_right'],
				'coloractive' 				=> $default_options['responsi_sc_tab_coloractive'],
				'onbackgroundcoloractive' 	=> $default_options['responsi_sc_tab_backgroundcoloractive']['onoff'],
				'backgroundcoloractive' 	=> $default_options['responsi_sc_tab_backgroundcoloractive']['color'],
				'bordertopactive' 			=> $default_options['responsi_sc_tab_bordertopactive'],
				'borderbottomactive' 		=> $default_options['responsi_sc_tab_borderbottomactive'],
				'borderleftactive' 			=> $default_options['responsi_sc_tab_borderleftactive'],
				'borderrightactive' 		=> $default_options['responsi_sc_tab_borderrightactive'],
				'fontcontent_size' 			=> $default_options['responsi_sc_tab_fontcontent']['size'],
				'fontcontent_line_height' 	=> $default_options['responsi_sc_tab_fontcontent']['line_height'],
				'fontcontent_face' 			=> $default_options['responsi_sc_tab_fontcontent']['face'],
				'fontcontent_style' 		=> $default_options['responsi_sc_tab_fontcontent']['style'],
				'fontcontent_color' 		=> $default_options['responsi_sc_tab_fontcontent']['color'],
				'cbordertopsize'     		=> $default_options['responsi_sc_tab_cbordertop']['width'],
				'cbordertopstyle'			=> $default_options['responsi_sc_tab_cbordertop']['style'],
				'cbordertopcolor'			=> $default_options['responsi_sc_tab_cbordertop']['color'],
				'cborderbottomsize'     	=> $default_options['responsi_sc_tab_cborderbottom']['width'],
				'cborderbottomstyle'		=> $default_options['responsi_sc_tab_cborderbottom']['style'],
				'cborderbottomcolor'		=> $default_options['responsi_sc_tab_cborderbottom']['color'],
				'cborderleftsize'     		=> $default_options['responsi_sc_tab_cborderleft']['width'],
				'cborderleftstyle'			=> $default_options['responsi_sc_tab_cborderleft']['style'],
				'cborderleftcolor'			=> $default_options['responsi_sc_tab_cborderleft']['color'],
				'cborderrightsize'     		=> $default_options['responsi_sc_tab_cborderright']['width'],
				'cborderrightstyle'			=> $default_options['responsi_sc_tab_cborderright']['style'],
				'cborderrightcolor'			=> $default_options['responsi_sc_tab_cborderright']['color'],
				'ccornertl'					=> $default_options['responsi_sc_tab_ccornertopleft']['corner'],
				'ccornertopleft'			=> $default_options['responsi_sc_tab_ccornertopleft']['rounded_value'],
				'ccornertr'					=> $default_options['responsi_sc_tab_ccornertopright']['corner'],
				'ccornertopright'			=> $default_options['responsi_sc_tab_ccornertopright']['rounded_value'],
				'ccornerbl'					=> $default_options['responsi_sc_tab_ccornerbottomleft']['corner'],
				'ccornerbottomleft'			=> $default_options['responsi_sc_tab_ccornerbottomleft']['rounded_value'],
				'ccornerbr'					=> $default_options['responsi_sc_tab_ccornerbottomright']['corner'],
				'ccornerbottomright'		=> $default_options['responsi_sc_tab_ccornerbottomright']['rounded_value'],
				'cmargin' 					=> $default_options['responsi_sc_tab_cmargin_on'],
				'cmargin_top' 				=> $default_options['responsi_sc_tab_cmargin_top'],
				'cmargin_bottom' 			=> $default_options['responsi_sc_tab_cmargin_bottom'],
				'cmargin_left' 				=> $default_options['responsi_sc_tab_cmargin_left'],
				'cmargin_right' 			=> $default_options['responsi_sc_tab_cmargin_right'],
				'cpadding' 					=> $default_options['responsi_sc_tab_cpadding_on'],
				'cpadding_top' 				=> $default_options['responsi_sc_tab_cpadding_top'],
				'cpadding_bottom' 			=> $default_options['responsi_sc_tab_cpadding_bottom'],
				'cpadding_left' 			=> $default_options['responsi_sc_tab_cpadding_left'],
				'cpadding_right' 			=> $default_options['responsi_sc_tab_cpadding_right'],
				'icon_color' 				=> $default_options['responsi_sc_tab_icon_color'],
			), $atts
		);


		$atts = $defaults;
		self::$parent_args = $defaults;

		extract( $defaults );

		$content = preg_replace('/dotab\][^\[]*/','dotab]', $content);
		$content = preg_replace('/^[^\[]*\[/','[', $content);

		$this->parse_tab_parameter( $content, 'a3_tab' );

		$shortcode_wrapper = '[dotabs design="' . $atts['design'] . '" layout="' . $atts['layout'] . '" justified="' . $atts['justified'] . '" class="' . $atts['class'] . '" id="' . $atts['id'] . '"]';
		$shortcode_wrapper .= $content;
		$shortcode_wrapper .= '[/dotabs]';

		return do_shortcode($shortcode_wrapper);
	}

	function a3_tab( $atts, $content = null) {
		global $responsi_options_a3_shortcode;
		if( is_array($responsi_options_a3_shortcode)){
			$default_options = $responsi_options_a3_shortcode;
		}else{
			global $responsi_a3_shortcode_addon;
			$default_options = $responsi_a3_shortcode_addon->global_responsi_options_a3_shortcode();
		}
		$defaults = Responsi_A3_Shortcode_Class::set_shortcode_defaults(
			array(
				'id'	=> '',
				'icon'	=> '',
				'icon_color' => $default_options['responsi_sc_tab_icon_color'],
				'title' => '',
			), $atts
		);

		extract( $defaults );

		$atts = $defaults;

		// create unique tab id for linking
		$sanitized_title = hash("md5", $title, false);
		$sanitized_title = 'tab'. str_replace( '-', '_', $sanitized_title );
		$unique_id = substr( md5( $this->tabs_counter . '-' . $sanitized_title), 15 );

		$shortcode_wrapper = sprintf( '[dotab id="%s" icon="%s" icon_color="%s" a3_tab="yes"]%s[/dotab]', $unique_id, $icon, $icon_color, do_shortcode( $content ) );

		return do_shortcode( $shortcode_wrapper );
	}

	function parse_tab_parameter( $content, $shortcode, $args = null ) {
		$preg_match_tabs_single = preg_match_all( Responsi_A3_Shortcode_Class::get_shortcode_regex( $shortcode ), $content, $tabs_single );

		if( is_array( $tabs_single[0] ) ) {
			$id = '';
			foreach( $tabs_single[0] as $key => $tab ) {

				if( is_array( $args ) ) {
					$preg_match_titles = preg_match_all( '/' . $shortcode . ' id=([0-9]+)/i', $tab, $ids );

					if( array_key_exists( '0', $ids[1] ) ) {
						$id = $ids[1][0];
					} else {
						$title = 'default';
					}

					foreach ( $args as $key => $value ) {

						if( $key == $shortcode . $id ) {

							$title = $value;
						}
					}
				} else {
					$preg_match_titles = preg_match_all( '/' . $shortcode . ' title="([^\"]+)"/i', $tab, $titles );
					if( array_key_exists( '0', $titles[1] ) ) {
						$title = $titles[1][0];
					} else {
						$title = 'default';
					}
				}

				$preg_match_icons = preg_match_all( '/' . $shortcode . '( id=[0-9]+| title="[^\"]+")? icon="([^\"]+)"/i', $tab, $icons );
				if( array_key_exists( '0', $icons[2] ) ) {
					$icon = $icons[2][0];
				} else {
					$icon = 'none';
				}



				$preg_match_icons_color = preg_match_all( '/' . $shortcode . '( id=[0-9]+| title="[^\"]+" icon="[^\"]+")? icon_color="([^\"]+)"/i', $tab, $icons_color );
				if( array_key_exists( '0', $icons_color[2] ) ) {
					$icon_color = $icons_color[2][0];
				} else {
					$icon_color = 'transparent';
				}

				// create unique tab id for linking
				$sanitized_title = hash("md5", $title, false);
				$sanitized_title = 'tab'. str_replace( '-', '_', $sanitized_title );
				$unique_id = substr( md5( $this->tabs_counter . '-' . $sanitized_title), 15 );

				// create array for every single tab shortcode
				$this->tabs[] = array( 'title' => $title, 'icon' => $icon,'icon_color' => $icon_color, 'unique_id' => $unique_id );
			}
		}
	}
}
$GLOBALS['Shortcode_Tabs_Class'] = new Shortcode_Tabs_Class();
?>
