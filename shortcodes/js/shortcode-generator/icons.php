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
	        if( f != '' ){
	        	shortcode += '[a3_fontawesome '+ f +']';
	        }
        });
		return shortcode;
	},
	filterAttributeShortCodeCustom:function(obj){
		if( obj.fronticon != 'yes' && obj.frontimage != 'yes' ){
			delete obj.size;
			delete obj.color;
			delete obj.onbackground;
			delete obj.background;
			delete obj.border_size;
			delete obj.border_style;
			delete obj.border_color;
			delete obj.corner;
			delete obj.border_corner;
			delete obj.shadow;
			delete obj.shadow_h;
			delete obj.shadow_v;
			delete obj.shadow_blur;
			delete obj.shadow_spread;
			delete obj.shadow_inset;
			delete obj.shadow_color;
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
			delete obj.container;
			delete obj.flip;
			delete obj.icon_flip;
			delete obj.rotate;
			delete obj.icon_rotate;
			delete obj.spin;
			delete obj.spin_speed;
			delete obj.animation;
			delete obj.animation_type;
			delete obj.animation_direction;
			delete obj.animation_speed;
		}

		if( obj.fronticon != 'yes'){
			delete obj.fronticon;
			delete obj.icon;
			delete obj.size;
			delete obj.color;
		}
		if( obj.frontimage != 'yes'){
			delete obj.frontimage;
			delete obj.image;
			delete obj.image_width;
			delete obj.image_height;
		}
		if( obj.flip != 'yes'){
			delete obj.flip;
			delete obj.icon_flip;
		}
		if( obj.rotate != 'yes'){
			delete obj.rotate;
			delete obj.icon_rotate;
		}
		if( obj.spin != 'yes'){
			delete obj.spin;
			delete obj.spin_speed;
		}
		if( obj.animation != 'yes'){
			delete obj.animation;
			delete obj.animation_type;
			delete obj.animation_direction;
			delete obj.animation_speed;
		}

		if( obj.container != 'yes' ){
			delete obj.onbackground;
			delete obj.background;
			delete obj.border_size;
			delete obj.border_style;
			delete obj.border_color;
			delete obj.corner;
			delete obj.border_corner;
			delete obj.shadow;
			delete obj.shadow_h;
			delete obj.shadow_v;
			delete obj.shadow_blur;
			delete obj.shadow_spread;
			delete obj.shadow_inset;
			delete obj.shadow_color;
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
			delete obj.container;
		}

		if( obj.background == '' || obj.background == 'transparent' || obj.onbackground == false ){
			delete obj.background;
			delete obj.onbackground;
		}else{
			delete obj.onbackground;
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

		return obj;
	},
	filterAttributeShortCode:function(obj){
		return obj;
	}
};