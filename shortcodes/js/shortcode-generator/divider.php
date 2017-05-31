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
	        shortcode += '[a3_divider'+ f +']';
        });
		return shortcode;
	},
	filterAttributeShortCodeCustom:function(obj){
		if( obj.type == 'none' ){
			delete obj.type;
		}
		if( obj.color == '#555555' || obj.color == '' ){
			delete obj.color;
		}
		if( obj.width == '' ){
			delete obj.width;
		}
		if( obj.margin != 'yes' ){
			delete obj.margin;
			delete obj.margin_top;
			delete obj.margin_bottom;
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
		if( mt == true && mb == true ){
			delete obj.margin;
			delete obj.margin_top;
			delete obj.margin_bottom;
		}
		if( obj.container != 'true' ){
			delete obj.container;
			delete obj.icon;
			delete obj.iconcolor;
			delete obj.iconbackground;
			delete obj.iconborder;
		}else{
			delete obj.container;
		}
		if( obj.iconbackground == 'transparent' ){
			delete obj.iconbackground;
		}
		if( obj.wrapelement != 'yes'){
			delete obj.wrapelement;
			delete obj.class;
			delete obj.id;
		}else{
			delete obj.wrapelement;
		}
		if( obj.class == '' ){
			delete obj.class;
		}
		if( obj.id == '' ){
			delete obj.id;
		}
		return obj;
	},
	filterAttributeShortCode:function(obj){
		return obj;
	}
};