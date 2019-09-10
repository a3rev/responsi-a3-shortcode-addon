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
		var fs = "";
		a = responsiShortcodeMeta.filterAttributeShortCode(a);
		for (var d in a) {
            var g = a[d];
           fs += " " + d + '="' + g + '"'
        }
        var shortcode = '[a3_tabs'+ fs +']';
		jQuery( ".sort_table .sort_table_item").each(function (index) {
			var objsub = responsiDialogHelper.makeShortcodeCustom(jQuery(this));
			var arr = responsiShortcodeMeta.filterAttributeShortCodeCustom(objsub);
			var content = 'Your Content Goes Here';
			var f = "";
			for (var i in arr) {
				if( i != 'content' ){
					var g = arr[i];
	           		f += " " + i + '="' + g + '"'
				}else{
					content = arr[i];
				}
	        }
	        shortcode += '[a3_tab'+ f +']'+content+'[/a3_tab]';
        });
		shortcode += '[/a3_tabs]';

		return shortcode;
	},
	filterAttributeShortCodeCustom:function(obj){
		if( obj.tabicon != 'yes'){
			delete obj.icon;
			delete obj.icon_color;
		}
		delete obj.tabicon;
		return obj;
	},
	filterAttributeShortCode:function(obj){
		if( obj.wrapelement != 'yes'){
			delete obj.wrapelement;
			delete obj.class;
			delete obj.id;
		}
		if( obj.class == '' ){
			delete obj.class;
		}
		if( obj.id == '' ){
			delete obj.id;
		}
		if( obj.layout == 'horizontal'){
			delete obj.layout;
			delete obj.tabwidth;
		}
		if( obj.layout == 'vertical'){
			delete obj.justified;
		}
		if( obj.justified != 'yes'){
			delete obj.justified;
		}
		if( obj.tabwidth == '15'){
			delete obj.tabwidth;
		}
		if( obj.design == 'classic'){
			delete obj.design;

			delete obj.tab_bordersize;
			delete obj.tab_borderstyle;
			delete obj.tab_bordercolor;

			delete obj.tab_corner;
			delete obj.tab_cornervalue;

			delete obj.font_size;
			delete obj.font_line_height;
			delete obj.font_face;
			delete obj.font_style;
			delete obj.font_color;
			delete obj.onbackgroundcolor;
			delete obj.backgroundcolor;

			delete obj.bordertopsize;
			delete obj.bordertopstyle;
			delete obj.bordertopcolor;

			delete obj.borderbottomsize;
			delete obj.borderbottomstyle;
			delete obj.borderbottomcolor;

			delete obj.borderleftsize;
			delete obj.borderleftstyle;
			delete obj.borderleftcolor;

			delete obj.borderrightsize;
			delete obj.borderrightstyle;
			delete obj.borderrightcolor;

			delete obj.cornertl;
			delete obj.cornertopleft;
			delete obj.cornertr;
			delete obj.cornertopright;
			delete obj.cornerbl;
			delete obj.cornerbottomleft;
			delete obj.cornerbr;
			delete obj.cornerbottomright;

			delete obj.margin;
			delete obj.margin_top;
			delete obj.margin_bottom;
			delete obj.margin_left;
			delete obj.margin_right;
			delete obj.padding;
			delete obj.padding_top;
			delete obj.padding_bottom;
			delete obj.padding_left;
			delete obj.padding_right;

			delete obj.coloractive;
			delete obj.onbackgroundcoloractive;
			delete obj.backgroundcoloractive;
			delete obj.bordertopactive;
			delete obj.borderbottomactive;
			delete obj.borderleftactive;
			delete obj.borderrightactive;

			delete obj.fontcontent_size;
			delete obj.fontcontent_face;
			delete obj.fontcontent_line_height;
			delete obj.fontcontent_style;
			delete obj.fontcontent_color;

			delete obj.cbordertopsize;
			delete obj.cbordertopstyle;
			delete obj.cbordertopcolor;

			delete obj.cborderbottomsize;
			delete obj.cborderbottomstyle;
			delete obj.cborderbottomcolor;

			delete obj.cborderleftsize;
			delete obj.cborderleftstyle;
			delete obj.cborderleftcolor;

			delete obj.cborderrightsize;
			delete obj.cborderrightstyle;
			delete obj.cborderrightcolor;

			delete obj.ccornertl;
			delete obj.ccornertopleft;
			delete obj.ccornertr;
			delete obj.ccornertopright;
			delete obj.ccornerbl;
			delete obj.ccornerbottomleft;
			delete obj.ccornerbr;
			delete obj.ccornerbottomright;

			delete obj.cmargin;
			delete obj.cmargin_top;
			delete obj.cmargin_bottom;
			delete obj.cmargin_left;
			delete obj.cmargin_right;
			delete obj.cpadding;
			delete obj.cpadding_top;
			delete obj.cpadding_bottom;
			delete obj.cpadding_left;
			delete obj.cpadding_right;

			delete obj.design;

		}

		delete obj.wrapelement;
		return obj;
	}
};