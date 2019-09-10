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
			var content = arr['content'];
			var f = "";
			for (var i in arr) {
				if( i != 'content' ){
					var g = arr[i];
	           		f += " " + i + '="' + g + '"'
				}
	        }
	        shortcode += '[a3_infobox'+ f +']'+content+'[/a3_infobox]';
        });
		return shortcode;
	},
	filterAttributeShortCodeCustom:function(obj){
		if( obj.background == 'transparent' ){
			delete obj.background;
		}
		if( obj.bordertopsize == '0px' ){
			delete obj.bordertopsize;
			delete obj.bordertopcolor;
			delete obj.bordertopstyle;
		}
		if( obj.borderbottomsize == '0px' ){
			delete obj.borderbottomsize;
			delete obj.borderbottomcolor;
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
		if( obj.corner != 'true' ){
			delete obj.corner;
			delete obj.border_corner;
		}
		if( obj.defaultshadow != 'yes' ){
			delete obj.defaultshadow;
			delete obj.defaultshadowcolor;
			delete obj.defaultshadowopacity;
		}
		if( obj.customshadow != 'true' ){
			delete obj.customshadow;
			delete obj.customshadowh;
			delete obj.customshadowv;
			delete obj.customshadowblur;
			delete obj.customshadowspread;
			delete obj.customshadowinset;
			delete obj.customshadowcolor;
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
		if( obj.container != 'true'){
			delete obj.container;
			delete obj.icon;
			delete obj.iconsize;
			delete obj.iconposition;
			delete obj.iconcolor;
		}else{
			delete obj.container;
		}
		if( obj.iconposition == 'top'){
			delete obj.iconposition;
		}
		if( obj.class == ''){
			delete obj.class;
		}
		if( obj.id == ''){
			delete obj.id;
		}
		if( obj.wrapelement != 'yes'){
			delete obj.wrapelement;
			delete obj.class;
			delete obj.id;
		}else{
			delete obj.wrapelement;
		}
		return obj;
	},
	filterAttributeShortCode:function(obj){
		return obj;
	}
};