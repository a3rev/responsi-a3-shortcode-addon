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
        var shortcode = '[a3_toggles'+ fs +']';
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
	        shortcode += '[a3_toggle '+ f +']'+content+'[/a3_toggle]';
        });
		shortcode += '[/a3_toggles]';
		return shortcode;
	},
	filterAttributeShortCodeCustom:function(obj){
		if( obj.title == '' ){
			delete obj.title;
		}
		if( obj.open == 'no' ){
			delete obj.open;
		}
		if( obj.bordersize == '0px' ){
			delete obj.bordersize;
			delete obj.bordercolor;
			delete obj.borderstyle;
		}
		if( obj.title_padding != 'yes' ){
			delete obj.title_padding;
			delete obj.title_padding_top;
			delete obj.title_padding_bottom;
			delete obj.title_padding_left;
			delete obj.title_padding_right;
		}

		var tpt = false;
		if( obj.title_padding_top == '' || obj.title_padding_top == '0px' ){
			delete obj.title_padding_top;
			tpt = true;
		}
		var tpb = false;
		if( obj.title_padding_bottom == '' || obj.title_padding_bottom == '0px' ){
			delete obj.title_padding_bottom;
			tpb = true;
		}
		var tpl = false;
		if( obj.title_padding_left == '' || obj.title_padding_left == '0px' ){
			delete obj.title_padding_left;
			tpl = true;
		}
		var tpr = false;
		if( obj.title_padding_right == '' || obj.title_padding_right == '0px' ){
			delete obj.title_padding_right;
			tpr = true;
		}
		if( tpt == true && tpb == true && tpl == true && tpr == true ){
			delete obj.title_padding;
			delete obj.title_padding_top;
			delete obj.title_padding_bottom;
			delete obj.title_padding_left;
			delete obj.title_padding_right;
		}
		delete obj.title_padding;

		var cpt = false;
		if( obj.content_padding_top == '' || obj.content_padding_top == '0px' ){
			delete obj.content_padding_top;
			cpt = true;
		}
		var cpb = false;
		if( obj.content_padding_bottom == '' || obj.content_padding_bottom == '0px' ){
			delete obj.content_padding_bottom;
			cpb = true;
		}
		var cpl = false;
		if( obj.content_padding_left == '' || obj.content_padding_left == '0px' ){
			delete obj.content_padding_left;
			cpl = true;
		}
		var cpr = false;
		if( obj.content_padding_right == '' || obj.content_padding_right == '0px' ){
			delete obj.content_padding_right;
			cpr = true;
		}
		if( cpt == true && cpb == true && cpl == true && cpr == true ){
			delete obj.content_padding;
			delete obj.content_padding_top;
			delete obj.content_padding_bottom;
			delete obj.content_padding_left;
			delete obj.content_padding_right;
		}
		delete obj.content_padding;

		if( obj.containers != 'yes' ){
			delete obj.background;
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
			delete obj.corner;
			delete obj.border_corner;
			delete obj.padding;
			delete obj.padding_top;
			delete obj.padding_bottom;
			delete obj.padding_left;
			delete obj.padding_right;
			delete obj.margin;
			delete obj.margin_top;
			delete obj.margin_bottom;
			delete obj.margin_left;
			delete obj.margin_right;
			delete obj.containers;
		}

		if( obj.background == '' || obj.background == 'transparent' ){
			delete obj.background;
		}

		if( obj.bordertopsize == '0px' ){
			delete obj.bordertopsize;
			delete obj.bordetopcolor;
			delete obj.bordertopstyle;
		}
		if( obj.borderbottomsize == '0px' ){
			delete obj.borderbottomsize;
			delete obj.bordebottomcolor;
			delete obj.borderbottomstyle;
		}
		if( obj.borderleftsize == '0px' ){
			delete obj.borderleftsize;
			delete obj.borderleftcolor;
			delete obj.borderleftstyle;
		}
		if( obj.borderrightsize == '0px' ){
			delete obj.borderrightsize;
			delete obj.borderrightcolor;
			delete obj.borderrightstyle;
		}

		if( obj.margin != 'yes' ){
			delete obj.margin;
			delete obj.margin_top;
			delete obj.margin_bottom;
			delete obj.margin_left;
			delete obj.margin_right;
		}
		var mt = false;
		if( obj.margin_top == '' || obj.margin_top == '0px' ){
			delete obj.margin_top;
			mt = true;
		}
		var mb = false;
		if( obj.margin_bottom == '' || obj.margin_bottom == '0px' ){
			delete obj.margin_bottom;
			mb = true;
		}
		var ml = false;
		if( obj.margin_left == '' || obj.margin_left == '0px' ){
			delete obj.margin_left;
			ml = true;
		}
		var mr = false;
		if( obj.margin_right == '' || obj.margin_right == '0px' ){
			delete obj.margin_right;
			mr = true;
		}
		if( mt == true && mb == true && ml == true && mr == true ){
			delete obj.margin;
			delete obj.margin_top;
			delete obj.margin_bottom;
			delete obj.margin_left;
			delete obj.margin_right;
		}

		if( obj.padding != 'yes' ){
			delete obj.padding;
			delete obj.padding_top;
			delete obj.padding_bottom;
			delete obj.padding_left;
			delete obj.padding_right;
		}

		var pt = false;
		if( obj.padding_top == '' || obj.padding_top == '0px' ){
			delete obj.padding_top;
			pt = true;
		}
		var pb = false;
		if( obj.padding_bottom == '' || obj.padding_bottom == '0px' ){
			delete obj.padding_bottom;
			pb = true;
		}
		var pl = false;
		if( obj.padding_left == '' || obj.padding_left == '0px' ){
			delete obj.padding_left;
			pl = true;
		}
		var pr = false;
		if( obj.padding_right == '' || obj.padding_right == '0px' ){
			delete obj.padding_right;
			pr = true;
		}
		if( pt == true && pb == true && pl == true && pr == true ){
			delete obj.padding;
			delete obj.padding_top;
			delete obj.padding_bottom;
			delete obj.padding_left;
			delete obj.padding_right;
		}

		if( obj.corner != 'true' ){
			delete obj.corner;
			delete obj.border_corner;
		}
		delete obj.containers;
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
		delete obj.wrapelement;

		var cmt = false;
		if( obj.margintop == '' || obj.margintop == '0px' ){
			delete obj.cmargin_top;
			cmt = true;
		}
		var cmb = false;
		if( obj.marginbottom == '' || obj.marginbottom == '0px' ){
			delete obj.marginbottom;
			cmb = true;
		}
		if( cmt == true && cmb == true ){
			delete obj.cmargin;
			delete obj.margintop;
			delete obj.marginbottom;
		}
		delete obj.margin;
		return obj;
	}
};