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
	        shortcode += '[a3_fullwidth '+ f +']'+content+'[/a3_fullwidth]';
        });
		return shortcode;
	},
	filterAttributeShortCodeCustom:function(obj){

		if( obj.paddingtop == '' || obj.paddingtop == '0px' ){
			delete obj.paddingtop;
		}
		if( obj.paddingbottom == '' || obj.paddingbottom == '0px' ){
			delete obj.paddingbottom;
		}
		if( obj.paddingleft == '' || obj.paddingleft == '0px' ){
			delete obj.paddingleft;
		}
		if( obj.paddingright == '' || obj.paddingright == '0px' ){
			delete obj.paddingright;
		}
		if( obj.padding != 'yes' ){
			delete obj.paddingtop;
			delete obj.paddingbottom;
			delete obj.paddingleft;
			delete obj.paddingright;
			delete obj.padding;
		}

		if( obj.margintop == '' || obj.margintop == '0px' ){
			delete obj.margintop;
		}
		if( obj.marginbottom == '' || obj.marginbottom == '0px' ){
			delete obj.marginbottom;
		}
		if( obj.margin != 'yes' ){
			delete obj.margintop;
			delete obj.marginbottom;
			delete obj.margin;
		}

		if( obj.equal_height_columns != 'yes'){
			delete obj.equal_height_columns;
		}
		if( obj.menuanchor == ''){
			delete obj.menuanchor;
		}
		if( obj.wrapelement != 'yes'){
			delete obj.wrapelement;
			delete obj.class;
			delete obj.id;
		}

		if( obj.backgroundcolor == '' || obj.backgroundcolor == 'transparent' || obj.onbackgroundcolor == false ){
			delete obj.backgroundcolor;
			delete obj.onbackgroundcolor;
		}else{
			delete obj.onbackgroundcolor;
		}

		if( obj.onoff_backgroundimage != 'on' ){
			delete obj.backgroundimage;
			delete obj.backgroundposition;
			delete obj.backgroundrepeat;
			delete obj.backgroundattachment;
			delete obj.onoff_backgroundimage;
		}
		if( obj.fade != 'yes'){
			delete obj.fade;
		}
		if( obj.bordersize == '0px' ){
			delete obj.bordersize;
			delete obj.bordercolor;
			delete obj.borderstyle;
		}

		if( obj.video != 'yes' ){
			delete obj.video_background;
			delete obj.video_webm;
			delete obj.video_mp4;
			delete obj.video_ogv;
			delete obj.video_background;
			delete obj.video_preview_image;
			delete obj.overlay_color;
			delete obj.overlay_opacity;
			delete obj.video_mute;
			delete obj.video_loop;
			delete obj.video;
		}
		if( obj.video_background != 'yes'){
			delete obj.video_background;
		}

		if( obj.video_webm == '' && obj.video_mp4 == '' && obj.video_ogv == '' ){
			delete obj.video_webm;
			delete obj.video_mp4;
			delete obj.video_ogv;
			delete obj.video_background;
			delete obj.video_preview_image;
			delete obj.overlay_color;
			delete obj.overlay_opacity;
			delete obj.video_mute;
			delete obj.video_loop;
			delete obj.video;
		}
		if( obj.video_webm == '' ){
			delete obj.video_webm;
		}
		if( obj.video_mp4 == '' ){
			delete obj.video_mp4;
		}
		if( obj.video_ogv == '' ){
			delete obj.video_ogv;
		}
		if( obj.video_preview_image == '' ){
			delete obj.video_preview_image;
		}
		if( obj.overlay_color == '' || obj.overlay_color == 'transparent'  ){
			delete obj.overlay_color;
		}
		if( obj.overlay_opacity != ''){
			delete obj.overlay_opacity;
		}
		if( obj.video_mute != 'yes'){
			delete obj.video_mute;
		}
		if( obj.video_loop != 'yes'){
			delete obj.video_loop;
		}

		if( obj.hundred_percent != 'yes'){
			delete obj.hundred_percent;
		}else{
			delete obj.paddingleft;
			delete obj.paddingright;
			delete obj.contentwidth;
		}

		if( obj.contentpaddingtop == '' || obj.contentpaddingtop == '0px' ){
			delete obj.contentpaddingtop;
		}
		if( obj.contentpaddingbottom == '' || obj.contentpaddingbottom == '0px' ){
			delete obj.contentpaddingbottom;
		}
		if( obj.contentpaddingleft == '' || obj.contentpaddingleft == '0px' ){
			delete obj.contentpaddingleft;
		}
		if( obj.contentpaddingright == '' || obj.contentpaddingright == '0px' ){
			delete obj.contentpaddingright;
		}
		if( obj.contentpadding != 'yes' ){
			delete obj.contentpaddingtop;
			delete obj.contentpaddingbottom;
			delete obj.contentpaddingleft;
			delete obj.contentpaddingright;
			delete obj.contentpadding;
		}

		return obj;
	},
	filterAttributeShortCode:function(obj){
		return obj;
	}
};