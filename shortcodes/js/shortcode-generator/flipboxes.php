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
        var shortcode = '[a3_flipboxes '+ fs +']';
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
	        shortcode += '[flip_box '+ f +']'+content+'[/flip_box]';
        });
		shortcode += '[/a3_flipboxes]';
		return shortcode;
	},
	filterAttributeShortCodeCustom:function(obj){

		if( obj.fronticon != 'yes' && obj.frontimage != 'yes' ){
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
			delete obj.icon_size;
			delete obj.icon_color;
			delete obj.circle;
			delete obj.circle_color;
			delete obj.circle_border_color;
			delete obj.circle_paddingtop;
			delete obj.circle_paddingbottom;
			delete obj.circle_paddingleft;
			delete obj.circle_paddingright;
		}
		if( obj.frontimage != 'yes'){
			delete obj.frontimage;
			delete obj.image;
			delete obj.image_width;
			delete obj.image_height;
			delete obj.circle_image;
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
		if( obj.circle != 'yes'){
			delete obj.circle;
			delete obj.circle_color;
			delete obj.circle_border_color;
			delete obj.circle_paddingtop;
			delete obj.circle_paddingbottom;
			delete obj.circle_paddingleft;
			delete obj.circle_paddingright;
		}
		if( obj.animation != 'yes'){
			delete obj.animation;
			delete obj.animation_type;
			delete obj.animation_direction;
			delete obj.animation_speed;
		}
		return obj;
	},
	filterAttributeShortCode:function(obj){

		if( obj.margin_box != 'yes'){
			delete obj.margin_box;
		}
		if( obj.margin_container != 'yes'){
			delete obj.margin_container;
			delete obj.margintop;
			delete obj.marginbottom;
		}
		if( obj.wrapelement != 'yes'){
			delete obj.wrapelement;
			delete obj.class;
			delete obj.id;
		}
		return obj;
	}
};