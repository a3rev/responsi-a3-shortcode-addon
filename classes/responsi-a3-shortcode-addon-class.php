<?php
class Responsi_A3_Shortcode_Addon {
	var $admin_page;

	public function __construct () {
		add_action( 'init',array( $this,'customize_options'), 2 );
		add_action( 'responsi_build_dynamic_css_success', array( $this,'a3_shortcode_sass_compile_less_mincss') );
		add_action( 'responsi_after_setup_theme', array( $this,'responsi_build_css_theme_actived') );
		add_action( 'init',array( $this,'init') );
		add_action( 'customize_save_after', array( $this, 'responsi_customize_save_options') );
	}

	public function init () {
		if ( $this->_is_active() ) {
			add_filter( 'responsi_google_webfonts', array( $this,'responsi_addon_google_webfonts'));
			add_action( 'wp_head',  array( $this, 'customize_preview_inline_style'), 11 );
		}
	}

	public function _is_active(){
		global $responsi_options_a3_shortcode;
		$active = true;
		return $active;
	}

	public function responsi_customize_save_options( $settings ) {

		$slug = 'a3_shortcode';

	    global ${'responsi_options_' . $slug}, $wp_customize;

		$post_value = array();

		if( isset($_POST['customized']) ){
			$post_value = json_decode( wp_unslash( $_POST['customized'] ), true );
			$post_value = apply_filters( 'responsi_customized_post_value', $post_value );
		}else{
			$post_value = $settings->changeset_data();
			$post_value = apply_filters( 'responsi_customized_changeset_data_value', $post_value );
		}

		if( is_array( ${'responsi_options_' . $slug} ) && count( ${'responsi_options_' . $slug} ) > 0 && is_array( $post_value ) && count( $post_value ) > 0 ){
			
			add_filter( 'default_settings_' . $slug, create_function( '', 'return true;' ) );
			
			$_default_options = responsi_default_options( $slug );

			if ( defined( str_replace("-","_", get_stylesheet() ) . '_' . $slug ) ) {
				if ( function_exists('default_option_child_theme') ){
					$_default_options = array_replace_recursive( $_default_options, default_option_child_theme() );
				}
			}

			if( is_array( $_default_options ) && count( $_default_options ) > 0 ){
				
				$new_options = get_option( $slug . '_'.get_stylesheet(), array() );

				$build_sass = false;

				if( is_array( $new_options ) ){
					
					if ( is_array($post_value) ) {
						
						if ( is_object( $post_value ) ){
			                $post_value = clone $post_value;
			            }

			            foreach( $post_value as $key => $value ){
							if( array_key_exists( $key, $_default_options ) ){

								if( is_array( $value ) && isset( $new_options[$key] ) && is_array( $new_options[$key] ) ){
									$new_options[$key] = array_merge( $new_options[$key], $value );
								}else{
									$new_options[$key] = $value;
								}
								$build_sass = true;
							}
						}

						$_customize_options = array_replace_recursive( ${'responsi_options_' . $slug}, $post_value );
						foreach( $_customize_options as $key => $value ){
							if( array_key_exists( $key, $_default_options )){
								if( isset( $new_options[$key] ) ){
									if( is_array( $new_options[$key] ) && is_array( $_default_options[$key] ) ){
										$new_opt = array_diff_assoc( $new_options[$key], $_default_options[$key] );
										if( is_array( $new_opt ) && count( $new_opt ) > 0 ){
											$new_options[$key] = $new_opt;
										}else{
											unset($new_options[$key]);
										}
									}else{
										if( !is_array( $new_options[$key] ) && !is_array($_default_options[$key]) && $new_options[$key] == $_default_options[$key] ){
											unset($new_options[$key]);
										}
									}
								}
								delete_option( $key );
							}
						}
					}
				}

				if( $wp_customize && !$wp_customize->is_theme_active()){
					$build_sass = true;
				}

				if( $build_sass ) {
					update_option( $slug . '_'.get_stylesheet(), $new_options );
					$this->responsi_dynamic_css();
					do_action( $slug . '_build_dynamic_css_success', $post_value );
				}
			}
		}
	}

	public function responsi_dynamic_css() {
	    $dynamic_css      = '';
	    $dynamic_css = $this->responsi_build_dynamic_css();
	    if ( '' !== $dynamic_css ) {
	        set_theme_mod( 'a3_shortcode_custom_css', $dynamic_css );
	    }
	}

	public function customize_options(){

		$slug = 'a3_shortcode';

	    global ${'responsi_options_' . $slug}, $wp_customize;

	    if( !function_exists('responsi_default_options') ){
	    	return;
	    }

	    $_childthemes = get_stylesheet();

	    $_default_options = responsi_default_options( $slug );

	    $_customize_options = $_default_options;

		if ( defined( str_replace("-","_", $_childthemes ) . '_' . $slug ) ) {
			if ( function_exists('default_option_child_theme') ){
				$_customize_options = array_replace_recursive( $_customize_options, default_option_child_theme() );
			}
		}

		$responsi_mods = get_option( $slug . '_'.$_childthemes, array() );

	    if( is_array( $responsi_mods ) ){
	        $_customize_options = array_replace_recursive( $_customize_options, $responsi_mods );
	    }
	    
	    if( 'responsi-blank-child' == $_childthemes ){
	        $responsi_mods = get_option( $slug .'_responsi', array() );
	        $responsi_blank_child =  get_option( $slug . '_responsi-blank-child', array() );
	        if( is_array($responsi_mods) ){
	            $_customize_options = array_replace_recursive( $_customize_options, $responsi_mods );
	        }
	        if( is_array($responsi_blank_child) ){
	            $_customize_options = array_replace_recursive( $_customize_options, $responsi_blank_child );
	        }
	    }

	    if( is_customize_preview() && ( isset( $_REQUEST['changeset_uuid'] ) || isset( $_REQUEST['customize_changeset_uuid'] ) ) ){
	        $changeset_data = $wp_customize->changeset_data();
	        if ( is_array($changeset_data) ) {
	            if( count( $changeset_data ) > 0 ){
	                $_customize_options_preview = array();
	                foreach ( $changeset_data as $setting_id => $setting_params ){
	                    if ( ! array_key_exists( 'value', $setting_params ) ) {
	                        continue;
	                    }
	                    if ( isset( $setting_params['type'] ) && 'theme_mod' === $setting_params['type'] ) {
							$namespace_pattern = '/^(?P<stylesheet>.+?)::(?P<setting_id>.+)$/';
							if ( preg_match( $namespace_pattern, $setting_id, $matches ) && get_stylesheet() === $matches['stylesheet'] ) {
								$_customize_options_preview[ $matches['setting_id'] ] = $setting_params['value'];
							}
						} else {
							$_customize_options_preview[ $setting_id ] = $setting_params['value'];
						}
	                }
	                $_customize_options_preview = apply_filters( 'responsi_customized_post_value', $_customize_options_preview );
	                if ( is_array($_customize_options) && is_array( $_customize_options_preview ) && count( $_customize_options_preview ) > 0 ) {
	                    if ( is_object( $_customize_options_preview ) ){
	                        $_customize_options_preview = clone $_customize_options_preview;
	                    }
	                    $_customize_options = array_replace_recursive( $_customize_options, $_customize_options_preview );
	                }
	            }
	        }
	    }

	    if (isset($_POST['customized'])) {
	        
	        $post_value = json_decode(wp_unslash($_POST['customized']), true);
	        $post_value = apply_filters('responsi_customized_post_value', $post_value);
	        if ( is_array($_customize_options) && is_array($post_value) ) {
	            if ( is_object( $post_value ) ){
	                $post_value = clone $post_value;
	            }
	            $_customize_options = array_replace_recursive($_customize_options, $post_value);
	        }

	    }

	    ${'responsi_options_' . $slug} = $_customize_options;

	    return ${'responsi_options_' . $slug};
	}

	public function a3_shortcode_sass_compile_less_mincss( $post_value ){
		if( isset( $post_value['responsi_layout_gutter'] ) ){
			$this->responsi_dynamic_css();
		}
	}

	public function responsi_build_dynamic_css( $preview = false ) {

		global $responsi_options, $responsi_options_a3_shortcode;

	    if( !function_exists('responsi_default_options') ){
	    	return;
	    }

	    /*if ( !$preview ) {
	        $responsi_options_a3_shortcode = $this->customize_options();
	    } else {
	        global $responsi_options_a3_shortcode;
	    }*/

	    if (!is_array($responsi_options_a3_shortcode)) {
            return '';
        }

		$output = '';

		$gutter = 2;
		if(isset( $responsi_options['responsi_layout_gutter']) ){
			$gutter = $responsi_options['responsi_layout_gutter'];
		}

		$row = $gutter/2;

		$output .= '.row {
		    margin-left: -'.$row.'%;
		    margin-right: -'.$row.'%;
		}
		.margin-box-no.row {
		    margin-left: 0px;
		    margin-right: 0px;
		}
		.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
		    position: relative;
		    min-height: 1px;
		    padding-left: '.$row.'%;
		    padding-right: '.$row.'%;
		}';

		$output .= '
		body .responsi-column.last {
		    margin-right: 0;
		}
		.responsi-column.responsi-one-sixth, .responsi-column.responsi-five-sixth, .responsi-column.responsi-one-fifth, .responsi-column.responsi-two-fifth, .responsi-column.responsi-three-fifth, .responsi-column.responsi-four-fifth, .responsi-column.responsi-one-fourth, .responsi-column.responsi-three-fourth, .responsi-column.responsi-one-third, .responsi-column.responsi-two-third, .responsi-column.responsi-one-half {
		    position: relative;
		    float: left;
		    margin-right: '.$gutter.'%;
		}
		.responsi-column.responsi-one-sixth {
		    width: '.((100-($gutter*5))/6).'% !important;
		}
		.responsi-column.responsi-five-sixth {
		    width: '.((100-((100-($gutter*5))/6))-$gutter).'% !important;
		}
		.responsi-column.responsi-one-fifth {
		    width: '.((100-($gutter*4))/5).'% !important;
		}
		.responsi-column.responsi-two-fifth {
		    width: '.((((100-($gutter*4))/5)*2)+$gutter).'% !important;
		}
		.responsi-column.responsi-three-fifth {
		    width: '.((((100-($gutter*4))/5)*3)+($gutter*2)).'% !important;
		}
		.responsi-column.responsi-four-fifth {
		    width: '.((((100-($gutter*4))/5)*4)+($gutter*3)).'% !important;
		}
		.responsi-column.responsi-one-fourth {
		    width: '.((100-($gutter*3))/4).'% !important;
		}
		.responsi-column.responsi-three-fourth {
		    width: '.((((100-($gutter*3))/4)*3)+($gutter*2)).'% !important;
		}
		.responsi-column.responsi-one-third {
		    width: '.((100-($gutter*2))/3).'% !important;
		}
		.responsi-column.responsi-two-third {
		    width: '.((((100-($gutter*2))/3)*2)+$gutter).'% !important;
		}
		.responsi-column.responsi-one-half {
		    width: '.((100-($gutter))/2).'% !important;
		}
		
		.responsi-column.responsi-five-sixth.spacing-no{ width:'.(((100-((100-($gutter*5))/6))-$gutter)+$gutter).'% !important; }

		.responsi-column.responsi-four-fifth.spacing-no{ width: '.(((((100-($gutter*4))/5)*4)+($gutter*3))+$gutter).'% !important; }

		.responsi-column.responsi-one-fifth.spacing-no{ width: '.(((100-($gutter*4))/5)+$gutter).'% !important; }

		.responsi-column.responsi-one-fourth.spacing-no{ width: '.(((100-($gutter*3))/4)+$gutter).'% !important; }

		.responsi-column.responsi-one-half.spacing-no{ width:'.(((100-($gutter))/2)+$gutter).'% !important; }

		.responsi-column.responsi-one-sixth.spacing-no{ width:'.((((100-($gutter*5))/6))+$gutter).'% !important; }

		.responsi-column.responsi-one-third.spacing-no{ width:'.(((100-($gutter*2))/3)+$gutter).'% !important; }

		.responsi-column.responsi-three-fifth.spacing-no{ width: '.(((((100-($gutter*4))/5)*3)+($gutter*2))+$gutter).'% !important; }

		.responsi-column.responsi-three-fourth.spacing-no{ width: '.(((((100-($gutter*3))/4)*3)+($gutter*2))+$gutter).'% !important; }

		.responsi-column.responsi-two-fifth.spacing-no{ width: '.(((((100-($gutter*4))/5)*2)+$gutter)+$gutter).'% !important; }

		.responsi-column.responsi-two-third.spacing-no{ width: '.(((((100-($gutter*2))/3)*2)+$gutter)+$gutter).'% !important; }
		
		@media only screen and (max-width:782px) {
		    .responsi-column.responsi-layout-column{
		        width: '.((100-($gutter))/2).'% !important;
		        margin-right:'.$gutter.'% !important;
		    }
		    .responsi-columns-5 .responsi-column:first-child, .responsi-columns-4 .responsi-column:first-child, .responsi-columns-3 .responsi-column:first-child, .responsi-columns-2 .responsi-column:first-child, .responsi-columns-1 .responsi-column:first-child {
		        margin-left: 0 !important;
		    }
		    .responsi-column.responsi-layout-column:nth-child(2n), .responsi-column {
		        margin-right: 0 !important;
		    }
		    .responsi-column.spacing-no {
		        margin-bottom: 0;
		    }
		}

		@media only screen and (max-width:480px) {
		    .responsi-columns-5 .responsi-column:first-child, .responsi-columns-4 .responsi-column:first-child, .responsi-columns-3 .responsi-column:first-child, .responsi-columns-2 .responsi-column:first-child, .responsi-columns-1 .responsi-column:first-child {
		        margin-left: 0 !important;
		    }
		    .responsi-column:nth-child(5n), .responsi-column:nth-child(4n), .responsi-column:nth-child(3n), .responsi-column:nth-child(2n), .responsi-column {
		        margin-right: 0 !important;
		    }
		    .responsi-column.spacing-no {
		        margin-bottom: 0;
		        width: 100% !important;
		    }
		    .responsi-column.spacing-yes {
		        width: 100% !important;
		    }
		}
		';

		$border_general            = 'transparent';
		if( trim($responsi_options_a3_shortcode['responsi_style_border']) != '' )
	    	$border_general = $responsi_options_a3_shortcode['responsi_style_border'];

	    if ( $border_general != 'transparent' ) {
	        $output .= '
			hr,.entry .wp-caption,.responsi-sc-hr{
				border-bottom:1px solid ' . $border_general . ' !important;
			    box-sizing: border-box;
			    max-width:100% !important;
			}';
	    }

	 	$_blockquote_icon                = $responsi_options_a3_shortcode['responsi_blockquote_icon'];
		$_blockquote_icon_color            = 'transparent';
		if( trim($responsi_options_a3_shortcode['responsi_blockquote_icon_color']) != '' )
	    	$_blockquote_icon_color          = $responsi_options_a3_shortcode['responsi_blockquote_icon_color'];
	    $_blockquote_boxed               = $responsi_options_a3_shortcode['responsi_blockquote_boxed'];
		$_blockquote_boxed_bg            = $responsi_options_a3_shortcode['responsi_blockquote_boxed_bg'];
	    if( !is_array( $_blockquote_boxed_bg ) ){
		    $_blockquote_boxed_bg = array( 'onoff' => 'true', 'color' => $_blockquote_boxed_bg );
		}

	    $_blockquote_boxed_border_top    = $responsi_options_a3_shortcode['responsi_blockquote_boxed_border_top'];
	    $_blockquote_boxed_border_bottom = $responsi_options_a3_shortcode['responsi_blockquote_boxed_border_bottom'];
	    $_blockquote_boxed_border_lr     = $responsi_options_a3_shortcode['responsi_blockquote_boxed_border_lr'];
	    $_blockquote_boxed_border_radius = responsi_generate_border_radius($responsi_options_a3_shortcode['responsi_blockquote_boxed_border_radius']);
	    $_blockquote_boxed_box_shadow    = responsi_generate_box_shadow($responsi_options_a3_shortcode['responsi_blockquote_boxed_box_shadow']);

	    if ($_blockquote_icon == 'true') {
	        $output .= '.entry blockquote:before, #main * blockquote:before, .term-description:before, .entry blockquote:before, #main blockquote:before,.responsi-sc-quote:before{color:' . $_blockquote_icon_color . ' !important;}';
	    } else {
	        $output .= '.entry blockquote:before, #main * blockquote:before, .term-description:before, .entry blockquote:before, #main blockquote:before,.responsi-sc-quote:before{color:#CCCCCC !important;}';
	    }

	    $_blockquote_boxed_css = '';
	    if ($_blockquote_boxed == 'true') {
	        $_blockquote_boxed_css .= responsi_generate_background_color($_blockquote_boxed_bg,true);
	        $_blockquote_boxed_css .= 'border-top:' . $_blockquote_boxed_border_top["width"] . 'px ' . $_blockquote_boxed_border_top["style"] . ' ' . $_blockquote_boxed_border_top["color"] . ';';
	        $_blockquote_boxed_css .= 'border-bottom:' . $_blockquote_boxed_border_bottom["width"] . 'px ' . $_blockquote_boxed_border_bottom["style"] . ' ' . $_blockquote_boxed_border_bottom["color"] . ';';
	        $_blockquote_boxed_css .= 'border-left:' . $_blockquote_boxed_border_lr["width"] . 'px ' . $_blockquote_boxed_border_lr["style"] . ' ' . $_blockquote_boxed_border_lr["color"] . ';';
	        $_blockquote_boxed_css .= 'border-right:' . $_blockquote_boxed_border_lr["width"] . 'px ' . $_blockquote_boxed_border_lr["style"] . ' ' . $_blockquote_boxed_border_lr["color"] . ';';
	        $_blockquote_boxed_css .= $_blockquote_boxed_border_radius;
	        $_blockquote_boxed_css .= $_blockquote_boxed_box_shadow;
	        $output .= '.responsi-sc-quote.boxed,.entry blockquote.boxed, #main blockquote.boxed, .type-post blockquote, .type-page blockquote, .entry blockquote,.page-description blockquote{' . $_blockquote_boxed_css . '}';
	    }

	    if( function_exists('responsi_minify_css') ){
        	$output = responsi_minify_css( $output );
        }

	    return $output;
	}

	public function responsi_build_css_theme_actived(){
		$this->responsi_dynamic_css();
	}

	public function build_css_after_addon_updated(){
		$this->responsi_dynamic_css();
	}

	public function customize_preview_inline_style(){
		if ( is_customize_preview() ) {
			wp_add_inline_style( 'responsi-shortcode-css', $this->responsi_build_dynamic_css( true ) );
		} else {
			$a3_shortcode_custom_css = get_theme_mod( 'a3_shortcode_custom_css' );
			if ( false === $a3_shortcode_custom_css ) {
				$this->responsi_dynamic_css();
				wp_add_inline_style( 'responsi-shortcode-css', $this->responsi_build_dynamic_css( true ) );
			}else{
				wp_add_inline_style( 'responsi-shortcode-css', get_theme_mod( 'a3_shortcode_custom_css' ) );
			}
		}
	}

	public function responsi_addon_google_webfonts( $options ){
		global $responsi_options_a3_shortcode;
		if( is_array( $options ) && is_array( $responsi_options_a3_shortcode ) )
			$options  = array_merge( $options, $responsi_options_a3_shortcode );
		return $options;
	}

}

global $responsi_a3_shortcode_addon;
$responsi_a3_shortcode_addon = new Responsi_A3_Shortcode_Addon();
?>
