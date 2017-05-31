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
			var content = arr['text'];
			var f = "";
			for (var i in arr) {
				if( i != 'text' ){
					var g = arr[i];
	           		f += " " + i + '="' + g + '"'
				}
	        }
	        shortcode += '[a3_button '+ f +']'+content+'[/a3_button]';
        });
		return shortcode;
	},
	filterAttributeShortCodeCustom:function(obj){
		if( obj.link == '' ){
			delete obj.link;
		}
		if( obj.background == '' || obj.background == 'transparent' ){
			delete obj.background;
		}
		if( obj.gradient_from == '' || obj.gradient_from == 'transparent' ){
			delete obj.gradient_from;
		}
		if( obj.gradient_to == '' || obj.gradient_to == 'transparent' ){
			delete obj.gradient_to;
		}
		if( obj.transform == 'none' ){
			delete obj.transform;
		}
		if( obj.align == 'none' ){
			delete obj.align;
		}
		if( obj.window != 'true' ){
			delete obj.window;
		}
		if( obj.border_size == '0px' ){
			delete obj.border_size;
			delete obj.border_color;
			delete obj.border_style;
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
		if( obj.shadow != 'true' ){
			delete obj.shadow;
			delete obj.shadow_h;
			delete obj.shadow_v;
			delete obj.shadow_blur;
			delete obj.shadow_spread;
			delete obj.shadow_inset;
			delete obj.shadow_color;
		}
		if( obj.container != 'true' ){
			delete obj.container;
			delete obj.icon;
			delete obj.iconcolor;
			delete obj.position;
			delete obj.divider;
			delete obj.divider_color;
		}
		if( obj.divider != 'yes' ){
			delete obj.divider;
			delete obj.divider_color;
		}
		if( obj.wrapelement != 'yes'){
			delete obj.wrapelement;
			delete obj.class;
			delete obj.id;
		}
		delete obj.padding;
		delete obj.margin;
		delete obj.container;
		return obj;
	},
	filterAttributeShortCode:function(obj){
		return obj;
	}
};