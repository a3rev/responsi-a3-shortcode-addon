<?php
header( "Content-Type:text/javascript" );

// Get the path to the root.
$full_path = __FILE__;

$path_bits = explode( 'wp-content', $full_path );

$url = $path_bits[0];

// Require WordPress bootstrap.
require_once( $url . '/wp-load.php' );
global $ICONS;

$str_icon = '';
$note_icon = '';
foreach( $ICONS as $value ){
	$str_icon .= $note_icon.'"'.$value.'"';
	$note_icon = ", ";
}
$sc_url = wp_make_link_relative(RESPONSI_A3_SC_SHORTCODES_JS_URL);
?>
var $ICONS = [<?php echo $str_icon;?>];
(function () {
	tinymce.create("tinymce.plugins.A3revShortcodesFontface", {
		init: function (d, e) {

			d.addCommand("responsiVisitResponsiThemes", function () {
				window.open("http://a3rev.com/")
			});

			d.addCommand("responsiShortcodeOpenDialog", function (a, c) {
				var popup_name  = '';
				selectedText = '';
				if (d.selection.getContent().length > 0) {
					selectedText = d.selection.getContent();
				}
				responsiSelectedShortcodeFontfaceType = c.identifier;
				responsiSelectedShortcodeFontfaceTitle = c.title;

				popup_name  = c.name;

				responsiShortcodeType = c.icon_type;
				var open_dialog = 'open-dialog';
				if(responsiShortcodeType == false){
					open_dialog += '-'+responsiSelectedShortcodeFontfaceType;
				}
				jQuery.ajax({
				 	url: "<?php echo $sc_url;?>/"+open_dialog+".php",
				  	data:  { icon_type: c.icon_type, title: c.title },
				  	success: function( b ){
						jQuery('#responsi-options').addClass('shortcode-' + responsiSelectedShortcodeFontfaceType);
						switch (responsiSelectedShortcodeFontfaceType) {
						default:
							jQuery("#responsi-dialog").remove();
							jQuery("body").append(b);
							jQuery("#responsi-dialog").hide();
							var f = jQuery(window).width();
							b = jQuery(window).height();
							f = 720 < f ? 720 : f;
							f -= 80;
							b -= 84;
							tb_show('Insert '+popup_name+' Shortcode', "#TB_inline?width=" + f + "&height=" + (b-40) + "&inlineId=responsi-dialog");
							break;
						}
				  	}
				});
			
				
			});

			d.addButton('A3revShortcodesFontface', {
				icon: 'responsi-icon-rf responsi-icon-addon',
				tooltip: 'Insert Add-on Plugin Shortcodes',
				type: 'menubutton',
				onclick: function(){
					jQuery('html').find('.mce-stack-layout').addClass('a3test');
				},
				menu:[
					{
						text: 'Icons',
						onclick: function(){
							d.execCommand('responsiShortcodeOpenDialog', false, {
								name: 'Icons',
								title: 'Icons',
								identifier: 'icons',
								icon_type: false
							})
						}
					},
					{
						text: 'Flip Boxes',
						onclick: function(){
							d.execCommand('responsiShortcodeOpenDialog', false, {
								name: 'Flip Boxes',
								title: 'Flip Boxes',
								identifier: 'flipboxes',
								icon_type: false
							})
						}
					},
					{
						text: 'Full Width Section',
						onclick: function(){
							d.execCommand('responsiShortcodeOpenDialog', false, {
								name: 'Full Width',
								title: 'Full Width',
								identifier: 'fullwidth',
								icon_type: false
							})
						}
					},
					{
						text: 'Columns',
						onclick: function(){
							d.execCommand('responsiShortcodeOpenDialog', false, {
								name: 'Columns',
								title: 'Columns',
								identifier: 'columns',
								icon_type: false
							})
						}
					},
					{
						text: 'List Generator',
						onclick: function(){
							d.execCommand('responsiShortcodeOpenDialog', false, {
								name: 'List Generator',
								title: 'List Generator',
								identifier: 'list-generator',
								icon_type: false
							})
						}
					},
					{
						text: 'Typography',
						onclick: function(){
							d.execCommand('responsiShortcodeOpenDialog', false, {
								name: 'Typography',
								title: 'Typography',
								identifier: 'typography',
								icon_type: false
							})
						}
					},
					{
						text: 'Buttons',
						onclick: function(){
							d.execCommand('responsiShortcodeOpenDialog', false, {
								name: 'Buttons',
								title: 'Buttons',
								identifier: 'button',
								icon_type: false
							})
						}
					},
					{
						text: 'Dividers',
						onclick: function(){
							d.execCommand('responsiShortcodeOpenDialog', false, {
								name: 'Dividers',
								title: 'Dividers',
								identifier: 'divider',
								icon_type: false
							})
						}
					},
					{
						text: 'Info Box',
						onclick: function(){
							d.execCommand('responsiShortcodeOpenDialog', false, {
								name: 'Info Box',
								title: 'Info Box',
								identifier: 'infobox',
								icon_type: false
							})
						}
					},
					{
						text: 'Toggles',
						onclick: function(){
							d.execCommand('responsiShortcodeOpenDialog', false, {
								name: 'Toggles',
								title: 'Toggles',
								identifier: 'toggles',
								icon_type: false
							})
						}
					},
					{
						text: 'Tabs',
						onclick: function(){
							d.execCommand('responsiShortcodeOpenDialog', false, {
								name: 'Tabs',
								title: 'Tabs',
								identifier: 'tabs',
								icon_type: false
							})
						}
					},
					{
						text: 'Social Links',
						onclick: function(){
							d.execCommand('responsiShortcodeOpenDialog', false, {
								name: 'Social Links',
								title: 'Social Links',
								identifier: 'social-links',
								icon_type: false
							})
						}
					}
				]
			});
		},
		createControl: function (d, e) {
			return null
		},
		getInfo: function () {
			return {
				longname: "Shortcode Fontface Generator",
				author: "http://a3rev.com/steve",
				authorurl: "http://a3rev.com/steve",
				infourl: "http://a3rev.com/",
				version: "1.0"
			}
		}
	});
	tinymce.PluginManager.add("A3revShortcodesFontface", tinymce.plugins.A3revShortcodesFontface);
})();
jQuery(document).on('click', '.screenshot .image_remove', function (e) {
    jQuery(this).parent('.screenshot').parent('.responsi-marker-upload-control').find('input').val('');
    jQuery(this).parent('.screenshot').html('');
});

jQuery(document).on( "change",'#responsi-options select.input-select', function (e) {
    var newText = jQuery(this).children( 'option:selected').text();
    jQuery(this).parents( '.select_wrapper').find( 'span').remove();
    jQuery(this).parents( '.select_wrapper').prepend('<span>' + newText + '</span>');
});

jQuery(document).on( "click",'h2.item-title i.click_toggle', function (e) {
	if( jQuery(this).parent('h2.item-title').parent('.sort_table_item').hasClass('hidethis') ){
		jQuery(this).parent('h2.item-title').parent('.sort_table_item').removeClass('hidethis');
		jQuery(this).removeClass('shortcode-icon-plus').addClass('shortcode-icon-minus');
	}else{
		jQuery(this).parent('h2.item-title').parent('.sort_table_item').addClass('hidethis');
		jQuery(this).removeClass('shortcode-icon-minus').addClass('shortcode-icon-plus');
	}
});
jQuery(document).on( "click",'i.click_toggle_main', function (e) {
	if( jQuery(this).parent().parent().parent().parent().siblings('.'+jQuery(this).data('hidden')).hasClass('hidethis') ){
		jQuery(this).parent().parent().parent().parent().siblings('.'+jQuery(this).data('hidden')).removeClass('hidethis');
		jQuery(this).removeClass('shortcode-icon-plus').addClass('shortcode-icon-minus');
	}else{
		jQuery(this).parent().parent().parent().parent().siblings('.'+jQuery(this).data('hidden')).addClass('hidethis');
		jQuery(this).removeClass('shortcode-icon-minus').addClass('shortcode-icon-plus');
	}
});
jQuery(document).on("click", 'h2.item-title i.click_remove', function (e) {
    var count_item = jQuery('.sort_table').find('.sort_table_item').length;
    if(count_item > 1 && confirm("Are you sure remove this item ?")){
        jQuery(this).parent('h2.item-title').parent('.sort_table_item').remove();
        var _items = jQuery('.sort_table').find('h2.item-title');
        jQuery.each( _items, function( key, value ) {
            jQuery(this).children('span').html('['+(key+1)+']');
            jQuery(this).parent('.sort_table_item').attr('id','sort_table_item-'+key);
        });
    }
});
jQuery(document).on('click', '.icon_picker i', function (e) {
    jQuery(this).parent().parent().parent('.responsi-marker-icon-control').find('input').val(jQuery(this).data('icon'));
    jQuery(this).parent('.icon_picker').find('i').removeClass('active');
    jQuery(this).addClass('active');
});

jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input.responsi-checkbox-iphone', function (event, elem , status) {
	var hidden_class = '';
	var hidden_off_class = '';
    if( jQuery(this).attr('hidden_class') != undefined ) hidden_class = jQuery(this).attr('hidden_class');
    if( jQuery(this).attr('hidden_off_class') != undefined ) hidden_off_class = jQuery(this).attr('hidden_off_class');
	if ( status == 'true' && hidden_class != '' ) {
        jQuery(this).parent().parent().parent('td').parent('tr').parent().parent('table').find('.'+hidden_class).show();
    } else {
        if( hidden_class != '' ){
            jQuery(this).parent().parent().parent('td.section').parent('tr').parent().parent('table').find('.'+hidden_class).hide();
        }
    }

    if ( status == 'true' && hidden_off_class != '' ) {
        jQuery(this).parent().parent().parent('td').parent('tr').parent().parent('table').find('.'+hidden_off_class).hide();
    } else {
        if( hidden_off_class != '' ){
            jQuery(this).parent().parent().parent('td.section').parent('tr').parent().parent('table').find('.'+hidden_off_class).show();
        }
    }
});

jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input#responsi-value-fronticon', function (event, elem , status) {
	if ( status == 'true' ) {
		jQuery(this).parent().parent().parent('td.section').parent('tr.iconctrl').siblings('tr.imagectrl').find('input[name="responsi-value-frontimage"]').removeAttr('checked').iphoneStyle("refresh");
        jQuery(this).parent().parent().parent('td.section').parent('tr').parent().parent('table').siblings('table.tbopicon').show();
        jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbeffect').show();
        jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbcontainer').show();
        //jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbcontainer').find('input#responsi-value-container').attr('checked','checked').iphoneStyle("refresh");
    } else {
        jQuery(this).parent().parent().parent('td.section').parent('tr').parent().parent('table').siblings('table.tbopicon').hide();
        if( jQuery(this).parent().parent().parent().parent().siblings('tr.imagectrl').find('input#responsi-value-frontimage').prop('checked') == false ){
            jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbeffect').hide();
            jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbcontainer').hide();
            jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbcontainer').find('input#responsi-value-container').removeAttr('checked').iphoneStyle("refresh");
        }
    }
});

jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input#responsi-value-frontimage', function (event, elem , status) {
	if ( status == 'true' ) {
		jQuery(this).parent().parent().parent('td.section').parent('tr.imagectrl').siblings('tr.iconctrl').find('input[name="responsi-value-fronticon"]').removeAttr('checked').iphoneStyle("refresh");
        jQuery(this).parent().parent().parent('td.section').parent('tr').parent().parent('table').siblings('table.tbopimg').show();
        jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbeffect').show();
        jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbcontainer').show();
        //jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbcontainer').find('input#responsi-value-container').attr('checked','checked').iphoneStyle("refresh");
    } else {
    	jQuery(this).parent().parent().parent('td.section').parent('tr').parent().parent('table').siblings('table.tbopimg').hide();
    	if( jQuery(this).parent().parent().parent().parent().siblings('tr.iconctrl').find('input#responsi-value-fronticon').prop('checked') == false ){
            jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbeffect').hide();
            jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbcontainer').hide();
            jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbcontainer').find('input#responsi-value-container').removeAttr('checked').iphoneStyle("refresh");
        }
    }
});

jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input#responsi-value-spin', function (event, elem , status) {
	if ( status == 'true' ) {
		jQuery(this).parent().parent().parent().parent().siblings('tr.tr_noanimation').find('input#responsi-value-animation').removeAttr('checked').iphoneStyle("refresh");
	}
});
jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input#responsi-value-animation', function (event, elem , status) {
	if ( status == 'true' ) {
		jQuery(this).parent().parent().parent().parent().siblings('tr.tr_nospin').find('input#responsi-value-spin').removeAttr('checked').iphoneStyle("refresh");
	}
});

jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input#responsi-value-flip', function (event, elem , status) {
	if ( status == 'true' ) {
		jQuery(this).parent().parent().parent().parent().siblings('tr.tr_norotate').find('input#responsi-value-rotate').removeAttr('checked').iphoneStyle("refresh");
	}
});
jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input#responsi-value-rotate', function (event, elem , status) {
	if ( status == 'true' ) {
		jQuery(this).parent().parent().parent().parent().siblings('tr.tr_noflip').find('input#responsi-value-flip').removeAttr('checked').iphoneStyle("refresh");
	}
});

jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input#responsi-value-fade', function (event, elem , status) {
	if ( status == 'true' ) {
		jQuery(this).parent().parent().parent().parent().siblings('tr.tr_video_background').find('input#responsi-value-video_background').removeAttr('checked').iphoneStyle("refresh");
	}
});
jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input#responsi-value-video_background', function (event, elem , status) {
	if ( status == 'true' ) {
		jQuery(this).parent().parent().parent().parent().siblings('tr.tr_fade').find('input#responsi-value-fade').removeAttr('checked').iphoneStyle("refresh");
	}
});

jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input#responsi-value-container', function (event, elem , status) {
	if ( status == 'true' ) {
	}else{
		jQuery(this).parent().parent().parent().parent().siblings('tr.tbshadow').find('input#responsi-value-shadow').removeAttr('checked').iphoneStyle("refresh");
		jQuery(this).parent().parent().parent().parent().siblings('tr.tbcorner').find('input#responsi-value-corner').removeAttr('checked').iphoneStyle("refresh");
	}
});

jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input#responsi-value-container', function (event, elem , status) {
	if ( status == 'true' ) {
        jQuery("table.container").show();
    } else {
    	jQuery("table.container").hide();
    }
});

jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input#responsi-value-containers', function (event, elem , status) {
	if ( status == 'true' ) {
		jQuery(this).parent().parent().parent('td').parent('tr').parent().parent('table').siblings("table."+jQuery(this).attr('hidden_class')).show();
    } else {
    	jQuery(this).parent().parent().parent('td.section').parent('tr').parent().parent('table').siblings("table."+jQuery(this).attr('hidden_class')).hide();
    }
});

jQuery(document).on( 'responsi-ui-onoff_checkbox-switch', 'input.responsi-multi-logic', function (event, elem , status) {
	if ( jQuery(this).prop('checked')) {
        jQuery("div."+jQuery(this).attr('hidden_class')).show();
        jQuery(this).parent().parent().parent().parent().siblings('tr').find('input.responsi-multi-logic').removeAttr('checked').iphoneStyle("refresh");
    }else{
        jQuery("div."+jQuery(this).attr('hidden_class')).hide();
    }
});

jQuery(document).on( "change",'#responsi-options select#responsi-value-design', function (e) {
    if( jQuery(this).val() == 'custom' ){
		jQuery('tr.custom').show();
    }else{
		jQuery('tr.custom').hide();
    }
});
jQuery(document).on( "change",'#responsi-options select#responsi-value-layout', function (e) {
    if( jQuery(this).val() == 'horizontal' ){
		jQuery('tr.tab_horizontal').show();
		jQuery('tr.tab_vertical').hide();
    }else{
		jQuery('tr.tab_horizontal').hide();
		jQuery('tr.tab_vertical').show();
    }
});
