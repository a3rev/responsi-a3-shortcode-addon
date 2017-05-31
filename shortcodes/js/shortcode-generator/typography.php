<?php
header( "Content-Type:text/javascript" );

// Get the path to the root.
$full_path = __FILE__;

$path_bits = explode( 'wp-content', $full_path );

$url = $path_bits[0];

// Require WordPress bootstrap.
require_once( $url . '/wp-load.php' );

global $responsi_options;
?>
responsiShortcodeMeta={
	defaultContent:"",
	customMakeShortcode: function(a){
		var shortcode = '';
		jQuery( ".sort_table .sort_table_item").each(function (index) {
			var objsub = responsiDialogHelper.makeShortcodeCustom(jQuery(this));
			var arr = responsiShortcodeMeta.filterAttributeShortCodeCustom(objsub);
			if( arr.typography == 'yes'){
			 	shortcode += '[a3_typography size="'+arr.typography_size+'" line_height="'+arr.typography_line_height+'" face="'+arr.typography_face+'" style="'+arr.typography_style+'" color="'+arr.typography_color+'"]'+arr.tcontent+'[/a3_typography]';
			}
			if( arr.highlight == 'yes'){
				var _background = '';
				if(arr.hbackground != '' && arr.hbackground != 'transparent'){
					_background = ' background="'+arr.hbackground+'"';
				}
				var _padding = '';
				if(arr.hpadding == 'yes'){
					if( arr.hpadding_top != '' && arr.hpadding_top != '0px' ){
						_padding += ' paddingtop="'+arr.hpadding_top+'"';
					}
					if( arr.hpadding_bottom != '' && arr.hpadding_bottom != '0px' ){
						_padding += ' paddingbottom="'+arr.hpadding_bottom+'"';
					}
					if( arr.hpadding_left != '' && arr.hpadding_left != '0px' ){
						_padding += ' paddingleft="'+arr.hpadding_left+'"';
					}
					if( arr.hpadding_right != '' && arr.hpadding_right != '0px' ){
						_padding += ' paddingright="'+arr.hpadding_right+'"';
					}
				}
			 	shortcode += '[a3_highlight'+_background+_padding+']'+arr.hcontent+'[/a3_highlight]';
			}
			if( arr.dropcap == 'yes'){
				var _font = ' size="'+arr.dropcap_size+'" line_height="'+arr.dropcap_line_height+'" face="'+arr.dropcap_face+'" style="'+arr.dropcap_style+'" color="'+arr.dropcap_color+'"';
				var _margin = '';
				if(arr.dmargin == 'yes'){
					if( arr.dmargin_top != '' && arr.dmargin_top != '0px' ){
						_margin += ' margintop="'+arr.dmargin_top+'"';
					}
					if( arr.dmargin_bottom != '' && arr.dmargin_bottom != '0px' ){
						_margin += ' marginbottom="'+arr.dmargin_bottom+'"';
					}
					if( arr.dmargin_left != '' && arr.dmargin_left != '0px' ){
						_margin += ' marginleft="'+arr.dmargin_left+'"';
					}
					if( arr.dmargin_right != '' && arr.dmargin_right != '0px' ){
						_margin += ' marginright="'+arr.dmargin_right+'"';
					}
				}
			 	shortcode += '[a3_dropcap'+_font+_margin+']'+arr.dcontent+'[/a3_dropcap]';
			}

			if( arr.quotation == 'yes'){
				var _iconcolor = '';
				if( arr.qcolor != '' && arr.qcolor != 'transparent' ){
					_iconcolor = ' iconcolor="'+arr.qcolor+'"';
				}
				var _textcolor = '';
				if( arr.qtextcolor != '' && arr.qtextcolor != 'transparent' ){
					_textcolor = ' textcolor="'+arr.qtextcolor+'"';
				}
				var _float = '';
				if( arr.qfloat == 'yes' ){
					_float = ' float="'+arr.qposition+'"';
				}
				var _container = '';
				if( arr.container == 'yes' ){
					if(arr.qbackground != '' && arr.qbackground != 'transparent'){
						_container += ' background="'+arr.qbackground+'"';
					}
					if (arr.qborder_size != '0px' ){
						_container += ' bordersize="'+arr.qborder_size+'"';
						_container += ' borderstyle="'+arr.qborder_style+'"';
						_container += ' bordercolor="'+arr.qborder_color+'"';
					}
					if (arr.qcorner == 'true' ){
						_container += ' corner="'+arr.qborder_corner+'"';
					}
					if (arr.qshadow == 'true' ){
						_container += ' shadow_h="'+arr.qshadow_h+'"';
						_container += ' shadow_v"'+arr.qshadow_v+'"';
						_container += ' shadow_blur="'+arr.qshadow_blur+'"';
						_container += ' shadow_spread="'+arr.qshadow_spread+'"';
						_container += ' shadow_inset="'+arr.qshadow_inset+'"';
						_container += ' shadow_color="'+arr.qshadow_color+'"';
					}
				}
			 	shortcode += '[a3_quotation'+_iconcolor+_textcolor+_float+_container+']'+arr.qcontent+'[/a3_quotation]';
			}

			if( arr.title == 'yes'){
				var _wrap = '';
				if( arr.wrapelement == 'yes' ){
					if( arr.id != '' ){
						_wrap += ' id="'+arr.id+'"';
					}
					if( arr.class != '' ){
						_wrap += ' class="'+arr.class+'"';
					}
				}
				var _h = ' tags="'+arr.ttags+'"';
				var _align = ' align="'+arr.talignment+'"';
				var _separator = ' separator="'+arr.tseparator+'"';
				var _separatorstyle = ' separatorstyle="'+arr.tseparatorstyle+'"';
				var _separatorcolor = ' separatorcolor="'+arr.tseparatorcolor+'"';
			 	shortcode += '[a3_title'+_wrap+_h+_align+_separator+_separatorstyle+_separatorcolor+']'+arr.tcontent+'[/a3_title]';
			}

        });
        //shortcode = '';
		return shortcode;
	},
	filterAttributeShortCodeCustom:function(obj){
		return obj;
	},
	filterAttributeShortCode:function(obj){
		return obj;
	}
};