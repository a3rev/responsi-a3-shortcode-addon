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
				 	url: ajaxurl,
				 	type: 'POST',
				  	data:  { action : 'shortcode_open_dialog', open_dialog:open_dialog+".php",  icon_type: c.icon_type, title: c.title },
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
