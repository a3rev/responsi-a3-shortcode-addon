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
	attributes:[
			{
				label:"Size",
				id:"size",
				help:" (px).", 
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[9, 70]
			},
			{
				label:"Color",
				id:"color",
				controlType:"colourpicker-control",
				defaultValue: '', 
				help:""
			},
			{
				label:"Background",
				id:"background",
				controlType:"colourpicker-control",
				defaultValue: '',
				help:""
			},
            {
				label:"Border Width",
				id:"border_width",
				help:"The border width.", 
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[0, 20]
			},
			{
				label:"Border Style",
				id:"border_style",
				help:"The border style.", 
				controlType:"select-control", 
				selectValues:['none', 'Solid', 'Dashed', 'Dotted', 'Double', 'Groove', 'Ridge', 'Inset', 'Outset'],
				defaultValue: 'none', 
				defaultText: 'None (Default)'
			},
			{
				label:"Border Color",
				id:"border_color",
				defaultValue: '',
				controlType:"colourpicker-control",
				help:""
			},
			{
				label:"Border Corner",
				id:"border_corner",
				help:" (px).", 
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[0, 100]
			},
            {
				label:"Shadow",
				id:"shadow",
				help:"The Shadow.", 
				controlType:"select-control", 
				selectValues:['none', 'true', 'false'],
				defaultValue: 'none', 
				defaultText: 'None (Default)'
			},
			{
				label:"Shadow Horizontal",
				id:"shadow_h",
				help:"(px)", 
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[-20, 20]
			},
			{
				label:"Shadow Vertical",
				id:"shadow_v",
				help:"(px)", 
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[-20, 20]
			},
			{
				label:"Shadow Blur",
				id:"shadow_blur",
				help:"(px)", 
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[-20, 20]
			},
			{
				label:"Shadow Spread",
				id:"shadow_spread",
				help:"(px)", 
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[-20, 20]
			},
			{
				label:"Shadow Type",
				id:"shadow_inset",
				help:"The Shadow tyle.", 
				controlType:"select-control", 
				selectValues:['none', 'Inset', 'Outset'],
				defaultValue: 'none', 
				defaultText: 'None (Default)'
			},
			
			{
				label:"Shadow Color",
				id:"shadow_color",
				defaultValue: '',
				controlType:"colourpicker-control",
				help:""
			},
			{
				label:"Padding Top",
				id:"padding_top",
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[0, 100],
				help:"(px)."
			},
			{
				label:"Padding Bottom",
				id:"padding_bottom",
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[0, 100],
				help:"(px)."
			},
			{
				label:"Padding Left",
				id:"padding_left",
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[0, 100],
				help:"(px)."
			},
			{
				label:"Padding Right",
				id:"padding_right",
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[0, 100],
				help:"(px)."
			},
			{
				label:"Margin Top",
				id:"margin_top",
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[0, 100],
				help:"(px)."
			},
			{
				label:"Margin Bottom",
				id:"margin_bottom",
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[0, 100],
				help:"(px)."
			},
			{
				label:"Margin Left",
				id:"margin_left",
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[0, 100],
				help:"(px)."
			},
			{
				label:"Margin Right",
				id:"margin_right",
				controlType:"range-control", 
				defaultValue: 'none',
				rangeValues:[0, 100],
				help:"(px)."
			}
			
			],
	defaultContent:"",
	shortcode:"a3_fontawesome"
};