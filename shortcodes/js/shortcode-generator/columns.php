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
		for (var d in a) {
            var g = a[d];
           fs += " " + d + '="' + g + '"'
        }

        var shortcode = '';

		jQuery( ".sort_table .sort_table_item").each(function (index) {
			var cf = '';
			var objsub = responsiDialogHelper.makeShortcodeCustom(jQuery(this));
			var arr = responsiShortcodeMeta.filterAttributeShortCodeCustom(objsub);
			var content = 'Your Content Goes Here';
			var f = "";
			for (var i in arr) {
				if( i != 'content' && i != 'column_type' ){
					var g = arr[i];
	           		f += " " + i + '="' + g + '"'
				}else{
					content = arr[i];
				}
	        }
	        if(f != ''){
				cf = ' '+f;
	        }
	        shortcode += '['+arr["column_type"]+''+ cf +']'+content+'[/'+arr["column_type"]+']';
        });

		shortcode += '';
		return shortcode;
	},
	filterAttributeShortCodeCustom:function(obj){
		if( obj.last != 'yes' ){
			delete obj.last;
		}
		if( obj.spacing != 'yes' ){
			delete obj.spacing;
			delete obj.margintop;
			delete obj.marginbottom;
		}
		if( obj.backgroundcolor == '' || obj.backgroundcolor == 'transparent' ){
			delete obj.backgroundcolor;
		}

		if( obj.onoff_backgroundimage != 'on' ){
			delete obj.backgroundimage;
			delete obj.backgroundposition;
			delete obj.backgroundrepeat;
			delete obj.onoff_backgroundimage;
		}
		if( obj.padding != 'yes' ){
			delete obj.padding;
			delete obj.paddingleft;
			delete obj.paddingright;
			delete obj.paddingbottom;
			delete obj.paddingtop;
		}
		if( obj.bordersize == '0px' ){
			delete obj.bordersize;
			delete obj.bordercolor;
			delete obj.borderstyle;
		}
		if( obj.wrapelement != 'yes'){
			delete obj.wrapelement;
			delete obj.class;
			delete obj.id;
		}
		return obj;
	},
	filterAttributeShortCode:function(obj){
		return obj;
	}
};