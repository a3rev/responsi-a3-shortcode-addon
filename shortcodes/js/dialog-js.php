<?php
	header( "Content-Type:text/javascript" );

	// Get the path to the root.
	$full_path = __FILE__;

	$path_bits = explode( 'wp-content', $full_path );

	$url = $path_bits[0];

	// Require WordPress bootstrap.
	require_once( $url . '/wp-load.php' );

	global $google_fonts;

	$fonts = '';

	// Build array of usabel typefaces.
	$fonts_whitelist = array(
		'Arial, Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif',
		'Trebuchet MS, Tahoma, sans-serif',
		'Georgia, Times New Roman, serif',
		'Tahoma, Geneva, Verdana, sans-serif',
		'Palatino, Palatino Linotype, serif',
		'Helvetica Neue, Helvetica, sans-serif',
		'Calibri, Candara, Segoe, Optima, sans-serif',
		'Myriad Pro, Myriad, sans-serif',
		'Lucida Grande, Lucida Sans Unicode, Lucida Sans, sans-serif',
		'Arial Black, sans-serif',
		'Gill Sans, Gill Sans MT, Calibri, sans-serif',
		'Geneva, Tahoma, Verdana, sans-serif',
		'Impact, Charcoal, sans-serif'
	);

	//$fonts_whitelist = array(); // Temporarily remove the default fonts.

	// Get just the names of the Google fonts.
	$google_font_names = array();

	if ( count( $google_fonts ) ) {

		foreach ( $google_fonts as $g ) {

			$google_font_names[] = $g['name'];

		} // End FOREACH Loop

		$fonts_whitelist = array_merge( $fonts_whitelist, $google_font_names );

	} // End IF Statement

	foreach ( $fonts_whitelist as $k => $v ) {

		$fonts_whitelist[$k] = str_replace( '|', '\"', $v );

	} // End FOREACH Loop

	$fonts = join( '|', $fonts_whitelist );
?>
var formfieldupload, formfieldid, file_frame;
jQuery(document).on('click', '.upload_button_custom', function (e) {
    e.preventDefault();

    formfieldupload = jQuery(this).prev().attr('name');
    formfieldid = jQuery(this).parent('td').parent('tr').parent('tbody').parent('table').parent('div.sort_table_item').attr('id');
    
    if( formfieldid == undefined ){
       formfieldid = jQuery(this).parent('td').parent('tr').parent('tbody').parent('table').parent().parent('div.sort_table_item').attr('id');
    }

    //jQuery('.supports-drag-drop').remove();

    if ( file_frame ) {
        file_frame.open();
        return;
    }

    file_frame = wp.media.frames.file_frame = wp.media({
        title: 'Select Image',
        button: {
            text: 'Use this image',
        },
        multiple: false  // Set to true to allow multiple files to be selected
    });

    file_frame.open();

    jQuery('.media-menu a:contains(Insert from URL)').remove();


    file_frame.on( 'select', function() {
        var selection = file_frame.state().get('selection');
        var size = jQuery('.attachment-display-settings .size').val();
        var attachment = file_frame.state().get('selection').first().toJSON();
        jQuery('#'+formfieldid+' .'+formfieldupload).val(attachment.url);
        jQuery('#'+formfieldid+' .'+formfieldupload).siblings('.screenshot').html('<img src="'+attachment.url+'" /><i class="shortcode-icon-times image_remove"></i>');
        jQuery('.media-modal-close').trigger('click');
    });
});

var shortcode_generator_url = '<?php echo RESPONSI_A3_SC_SHORTCODES_URL; ?>' + '/js/shortcode-generator';

var responsiDialogHelper = {

    needsPreview: false,
    setUpButtons: function () {
        var a = this;

        jQuery(document).on( 'click', '#responsi-btn-cancel', function () {
            a.closeDialog()
        });
    
        jQuery(document).on( 'click', '#responsi-btn-insert', function () {
            a.insertAction()
        });

    },

    setUpColourPicker: function () {
    	jQuery( '.responsi-marker-colourpicker-control .responsi-color-picker').each ( function () {

			jQuery(this).wpColorPicker({
				change: function( event, ui ) {
					//bgImage.css('background-color', ui.color.toString());
				},
				clear: function() {
					//bgImage.css('background-color', '');
				}
			});
        });
    },
    onOffCheckbox:function(){
        jQuery( '.responsi-marker-checkbox-iphone-control .responsi-checkbox-iphone').not('.added').each ( function (i) {
            var checked_label = 'ON';
            var unchecked_label = 'OFF';
            var container_width = 80;
            var callback = "maincheck";
            var hidden_class = '';
            var hidden_off_class = '';
            if( jQuery(this).attr('hidden_class') != undefined ) hidden_class = jQuery(this).attr('hidden_class');
            if( jQuery(this).attr('hidden_off_class') != undefined ) hidden_off_class = jQuery(this).attr('hidden_off_class');
            if( jQuery(this).attr('container_width') != undefined ) container_width = jQuery(this).attr('container_width');
            if( jQuery(this).attr('checked_label') != undefined ) checked_label = jQuery(this).attr('checked_label');
            if( jQuery(this).attr('unchecked_label') != undefined ) unchecked_label = jQuery(this).attr('unchecked_label');
            if( jQuery(this).attr('callback') != undefined ) callback = jQuery(this).attr('callback');
            var input_name = jQuery(this);
            if ( jQuery(this).prop('checked') ) {
                if ( hidden_class != '' ) {
                    jQuery(this).parent().parent().parent('tr').siblings('tr.'+hidden_class).show();
                }
                if ( hidden_off_class != '' ) {
                    jQuery(this).parent().parent().parent('tr').siblings('tr.'+hidden_off_class).hide();
                }
            } else {
                if( hidden_class != '' ){
                    jQuery(this).parent().parent().parent('tr').siblings('tr.'+hidden_class).hide();
                }
                if ( hidden_off_class != '' ) {
                    jQuery(this).parent().parent().parent('tr').siblings('tr.'+hidden_off_class).show();
                }
            }

            jQuery(this).iphoneStyle({
                resizeContainer: true,
                containerWidth:container_width,
                resizeHandle: false,
                handleMargin: 10,
                handleRadius: 5,
                containerRadius: 0,
                checkedLabel: checked_label,
                uncheckedLabel: unchecked_label,
                onChange: function(elem, value) {
                    var status = value.toString();
                    //jQuery('input[name="' + input_name + '"]').parent().parent().parent('td.section').addClass('added');
                    input_name.trigger("responsi-ui-onoff_checkbox-switch", [elem, status]);
                }
            });
        });
    },

    customLogicMultiCheck:function(){
        jQuery('table.responsi-options-table').find('input.responsi-multi-logic').each(function(){
            if ( jQuery(this).prop('checked')) {
                jQuery("div."+jQuery(this).attr('hidden_class')).show();
            }else{
                jQuery("div."+jQuery(this).attr('hidden_class')).hide();
            }
        });
    },

    customLogicIconImage:function(){
        jQuery('table.responsi-options-table').find('input#responsi-value-fronticon').each(function(){
            if ( jQuery(this).prop('checked')) {
                jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbopicon').show();
                jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbeffect').show();
            } else {
                jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbopicon').hide();
                if( jQuery(this).parent().parent().parent().parent().siblings('tr.imagectrl').find('input#responsi-value-frontimage').prop('checked') == false ){
                    jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbeffect').hide();
                }
            }
        });

        jQuery('table.responsi-options-table').find('input#responsi-value-frontimage').each(function(){
            if ( jQuery(this).prop('checked')) {
                jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbopimg').show();
                jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbeffect').show();
            } else {
                jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbopimg').hide();
                if( jQuery(this).parent().parent().parent().parent().siblings('tr.iconctrl').find('input#responsi-value-fronticon').prop('checked') == false ){
                    jQuery(this).parent().parent().parent().parent().parent().parent().siblings('table.tbeffect').hide();
                }
            }
        });

        jQuery('table.responsi-options-table').find('input#responsi-value-spin').each(function(){
            if ( jQuery(this).prop('checked')) {
                jQuery(this).parent().parent().parent().parent().siblings('tr.tr_noanimation').find('input#responsi-value-animation').removeAttr('checked').iphoneStyle("refresh");
            }
        });

        jQuery('table.responsi-options-table').find('input#responsi-value-flip').each(function(){
            if ( jQuery(this).prop('checked')) {
                jQuery(this).parent().parent().parent().parent().siblings('tr.tr_norotate').find('input#responsi-value-rotate').removeAttr('checked').iphoneStyle("refresh");
            }
        });

        jQuery('table.responsi-options-table').find('input#responsi-value-fade').each(function(){
            if ( jQuery(this).prop('checked')) {
                jQuery(this).parent().parent().parent().parent().siblings('tr.tr_video_background').find('input#responsi-value-video_background').removeAttr('checked').iphoneStyle("refresh");
            }
        });

        jQuery('table.responsi-options-table').find('input#responsi-value-video_background').each(function(){
            if ( jQuery(this).prop('checked')) {
                jQuery(this).parent().parent().parent().parent().siblings('tr.tr_fade').find('input#responsi-value-fade').removeAttr('checked').iphoneStyle("refresh");
            }
        });

        jQuery('table.responsi-options-table').find('input#responsi-value-container').each(function(){
            if ( jQuery(this).prop('checked')) {
                jQuery("table.container").show();
            }else{
                jQuery("table.container").hide();
            }
        });

        jQuery('table.responsi-options-table').find('input#responsi-value-containers').each(function(){
            if ( jQuery(this).prop('checked') ) {
                jQuery(this).parent().parent().parent('td').parent('tr').parent().parent('table').siblings("table."+jQuery(this).attr('hidden_class')).show();
            } else {
                jQuery(this).parent().parent().parent('td').parent('tr').parent().parent('table').siblings("table."+jQuery(this).attr('hidden_class')).hide();
            }
        });

        if(jQuery('select#responsi-value-design').val() == 'custom'){
            jQuery('tr.custom').show();
        }else{
            jQuery('tr.custom').hide();
        }
    },

    loadShortcodeDetails: function () {
        if (responsiSelectedShortcodeFontfaceType) {

            var a = this;
            jQuery.getScript(shortcode_generator_url + "/" + responsiSelectedShortcodeFontfaceType + ".php", function () {
                a.initializeDialog();

                // Set the default content to the highlighted text, for certain shortcode types.
                switch ( responsiSelectedShortcodeFontfaceType ) {

					case 'box':
					case 'ilink':
					case 'quote':
					case 'button':
					case 'abbr':
					case 'unordered_list':
					case 'ordered_list':
					case 'typography':

						jQuery( 'input#responsi-value-content').val( selectedText );

					case 'toggle':

						jQuery( 'textarea#responsi-value-content').val( selectedText );

					break;

				} // End SWITCH Statement
            })

        }

    },
    initializeDialog: function () {

        if (typeof responsiShortcodeMeta == "undefined") {
            jQuery( "#responsi-options").append( "<p>Error loading details for shortcode: " + responsiSelectedShortcodeFontfaceType + "</p>" );
        } else {
            if (responsiShortcodeMeta.disablePreview) {
                jQuery( "#responsi-preview").remove();
                jQuery( "#responsi-btn-preview").remove()
            }
            var a = responsiShortcodeMeta.attributes,
                b = jQuery( "#responsi-options-table" );

            for (var c in a) {
                var f = "responsi-value-" + a[c].id,
                    d = a[c].isRequired ? "responsi-required" : "",
                    g = jQuery( '<th valign="top" scope="row"></th>' );

                var requiredSpan = '<span class="optional"></span>';

                if (a[c].isRequired) {

                    requiredSpan = '<span class="required">*</span>';

                } // End IF Statement
                jQuery( "<label/>").attr( "for", f).attr( "class", d).html(a[c].label).append(requiredSpan).appendTo(g);
                f = jQuery( "<td/>" );

                d = (d = a[c].controlType) ? d : "text-control";

                switch (d) {

                case "column-control":

                    this.createColumnControl(a[c], f, c == 0);

                    break;

                case "tab-control":

                    this.createTabControl(a[c], f, c == 0);

                    break;

                case "icon-control":
                case "color-control":
                case "link-control":
                case "text-control":

                    this.createTextControl(a[c], f, c == 0);

                    break;

                case "textarea-control":

                    this.createTextAreaControl(a[c], f, c == 0);

                    break;

                case "select-control":

                    this.createSelectControl(a[c], f, c == 0);

                    break;

                case "font-control":

                    this.createFontControl(a[c], f, c == 0);

                    break;

                 case "range-control":

                    this.createRangeControl(a[c], f, c == 0);

                    break;

                 case "colourpicker-control":

                 	this.createColourPickerControl(a[c], f, c == 0);

                 	break;

                }

                jQuery( "<tr/>").append(g).append(f).appendTo(b)
            }
            jQuery( ".responsi-focus-here:first").focus()

			// Add additional wrappers, etc, to each select box.

			jQuery( '#responsi-options select').wrap( '<div class="select_wrapper"></div>' ).before( '<span></span>' );

			jQuery( '#responsi-options select option:selected').each( function () {

				jQuery(this).parents( '.select_wrapper').find( 'span').text( jQuery(this).text() );

			});

			// Setup the colourpicker.
            this.setUpColourPicker();

        } // End IF Statement
    },

    /* Column Generator Element */

    createColumnControl: function (a, b, c) {
        new responsiColumnMaker(b, 6, c ? "responsi-focus-here" : null);
        b.addClass( "responsi-marker-column-control")
    },

     /* Tab Generator Element */

    createTabControl: function (a, b, c) {
        new responsiTabMaker(b, 10, c ? "responsi-focus-here" : null);
        b.addClass( "responsi-marker-tab-control")
    },

	/* Colour Picker Element */

    createColourPickerControl: function (a, b, c) {

        var f = a.validateLink ? "responsi-validation-marker" : "",
            d = a.isRequired ? "responsi-required" : "",
            g = "responsi-value-" + a.id,
            defaultValue = a.defaultValue ? a.defaultValue : "";

		b.attr( 'id', 'responsi-marker-colourpicker-control').addClass( "responsi-marker-colourpicker-control" );

		jQuery( '<div></div>').appendTo(b);

        jQuery( '<input type="text" data-default-color="'+defaultValue+'" value="'+defaultValue+'">').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'txt input-text responsi-color-picker').addClass(c ? "responsi-focus-here" : "").appendTo(b);

        if (a = a.help) {
            //jQuery( "<br/>").appendTo(b);
            jQuery( "<span/>").addClass( "responsi-input-help").html(a).appendTo(b)
        }

        var h = this;
        b.find( "#" + g).bind( "keydown focusout", function (e) {
        })

    },

    /* Generic Text Element */

    createTextControl: function (a, b, c) {

        var f = a.validateLink ? "responsi-validation-marker" : "",
            d = a.isRequired ? "responsi-required" : "",
            g = "responsi-value-" + a.id,
            defaultValue = a.defaultValue ? a.defaultValue : "";

        jQuery( '<input type="text">').attr( "id", g).attr( "name", g).attr( 'value', defaultValue ).addClass(f).addClass(d).addClass( 'txt input-text regular-text code').addClass(c ? "responsi-focus-here" : "").appendTo(b);

        if (a = a.help) {
            //jQuery( "<br/>").appendTo(b);
            jQuery( "<span/>").addClass( "responsi-input-help").html(a).appendTo(b)
        }

        var h = this;
        b.find( "#" + g).bind( "keydown focusout", function (e) {
        })

    },

    /* Generic TextArea Element */

    createTextAreaControl: function (a, b, c) {

        var f = a.validateLink ? "responsi-validation-marker" : "",
            d = a.isRequired ? "responsi-required" : "",
            g = "responsi-value-" + a.id;

        jQuery( '<textarea>').attr( "id", g).attr( "name", g).attr( "rows", 10).attr( "cols", 30).addClass(f).addClass(d).addClass( 'txt input-textarea input-text regular-text code').addClass(c ? "responsi-focus-here" : "").appendTo(b);
        b.addClass( "responsi-marker-textarea-control" );

        if (a = a.help) {
            //jQuery( "<br/>").appendTo(b);
            jQuery( "<span/>").addClass( "responsi-input-help").html(a).appendTo(b)
        }

        var h = this;
        b.find( "#" + g).bind( "keydown focusout", function (e) {
        })

    },

    /* Select Box Element */

    createSelectControl: function (a, b, c) {

        var f = a.validateLink ? "responsi-validation-marker" : "",
            d = a.isRequired ? "responsi-required" : "",
            g = "responsi-value-" + a.id;

        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select').addClass(c ? "responsi-focus-here" : "" );

        b.addClass( 'responsi-marker-select-control' );

        var selectBoxValues = a.selectValues;

        var labelValues = a.selectValues;

        //selectNode.append( '<option value="none">None</option>' );

        for (v in selectBoxValues) {

            var value = selectBoxValues[v];
            var label = labelValues[v];
            var selected = '';

            if (value == '') {

                if (a.defaultValue == value) {

                    label = a.defaultText;

                } // End IF Statement
            } else {

                if (value == a.defaultValue) {
                    label = a.defaultText;
                } // End IF Statement
            } // End IF Statement
            if (value == a.defaultValue) {
                selected = ' selected="selected"';
            } // End IF Statement

            selectNode.append( '<option value="' + value + '"' + selected + '>' + label + '</option>' );

        } // End FOREACH Loop

        selectNode.appendTo(b);

        if (a = a.help) {
            //jQuery( "<br/>").appendTo(b);
            jQuery( "<span/>").addClass( "responsi-input-help").html(a).appendTo(b)
        }

        var h = this;

        b.find( "#" + g).bind( "change", function (e) {
            // Update the text in the appropriate span tag.
            var newText = jQuery(this).children( 'option:selected').text();

            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
        })

    },

    /* Range Select Box Element */

    createRangeControl: function (a, b, c) {

        var f = a.validateLink ? "responsi-validation-marker" : "",
            d = a.isRequired ? "responsi-required" : "",
            g = "responsi-value-" + a.id;

        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select input-select-range').addClass(c ? "responsi-focus-here" : "" );

        b.addClass( 'responsi-marker-select-control' );

        // var selectBoxValues = a.selectValues;

        var rangeStart = a.rangeValues[0];
        var rangeEnd = a.rangeValues[1];
		var defaultValue = 0;
		if ( a.defaultValue ) {

			defaultValue = a.defaultValue;

		} // End IF Statement

        selectNode.append( '<option value="none">None</option>' );

		for ( var i = rangeStart; i <= rangeEnd; i++ ) {

			var selected = '';

			if ( i == defaultValue ) { selected = ' selected="selected"'; } // End IF Statement

			selectNode.append( '<option value="' + i + '"' + selected + '>' + i + '</option>' );

		} // End FOR Loop

        selectNode.appendTo(b);

        if (a = a.help) {
            //jQuery( "<br/>").appendTo(b);
            jQuery( "<span/>").addClass( "responsi-input-help").html(a).appendTo(b)
        }

        var h = this;

        b.find( "#" + g).bind( "change", function (e) {
            // Update the text in the appropriate span tag.
            var newText = jQuery(this).children( 'option:selected').text();

            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
        })

    },

    /* Fonts Select Box Element */

    createFontControl: function (a, b, c) {

        var f = a.validateLink ? "responsi-validation-marker" : "",
            d = a.isRequired ? "responsi-required" : "",
            g = "responsi-value-" + a.id;

        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select input-select-font').addClass(c ? "responsi-focus-here" : "" );

        b.addClass( 'responsi-marker-select-control').addClass( 'responsi-marker-font-control' );

        var selectBoxValues = '<?php echo $fonts; ?>';
        selectBoxValues = selectBoxValues.split( '|' );

        selectNode.append( '<option value="none">None</option>' );

        for (v in selectBoxValues) {

            var value = selectBoxValues[v];
            var label = selectBoxValues[v];
            var selected = '';

            if (value == '') {

                if (a.defaultValue == value) {

                    label = a.defaultText;

                } // End IF Statement
            } else {

                if (value == a.defaultValue) {
                    label = a.defaultText;
                } // End IF Statement
            } // End IF Statement
            if (value == a.defaultValue) {
                selected = ' selected="selected"';
            } // End IF Statement

            selectNode.append( '<option value=\'' + value + '\'' + selected + '>' + label + '</option>' );

        } // End FOREACH Loop

        selectNode.appendTo(b);

        if (a = a.help) {
            //jQuery( "<br/>").appendTo(b);
            jQuery( "<span/>").addClass( "responsi-input-help").html(a).appendTo(b)
        }

        var h = this;

        b.find( "#" + g).bind( "change", function (e) {
            // Update the text in the appropriate span tag.
            var newText = jQuery(this).children( 'option:selected').text();

            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
        })

    },

   getTextKeyValue: function (a) {
	    var b = a.find( "input" );
	    if (!b.length) return null;
	    a = 'text-input-id';
	    if ( b.attr( 'id' ) != undefined ) {
	    	a = b.attr( "id" ).substring(15);
	    }
	    b = b.val();
	    return {
	        key: a,
	        value: b
	    }
	},

    getCheckBoxKeyValue: function (a) {
        var b = a.find( "input" );
        if (!b.length) return null;
        a = 'text-input-id';
        if ( b.attr( 'id' ) != undefined ) {
            a = b.attr( "id" ).substring(15);
        }
        if (!b.is(':checked')){
            if(b.data('novalue') != '' || b.data('novalue') == 'false'|| b.data('novalue') == false){
                b = b.data('novalue');
            }else{
                b = 'off';
            }
        }else{
            b = b.val();
        }
        return {
            key: a,
            value: b
        }
    },

	getTextAreaKeyValue: function (a) {
        var b = a.find( "textarea" );
        if (!b.length) return null;
        a = b.attr( "id").substring(15);
        b = b.val();
		b = b.replace(/\n\r?/g, '<br />');
        return {
            key: a,
            value: b
        }
    },

    getColumnKeyValue: function (a) {
        var b = a.find( "#responsi-column-text").text();
        if (a = Number(a.find( "select option:selected").val())) return {
            key: "data",
            value: {
                content: b,
                numColumns: a
            }
        }
    },

    getTabKeyValue: function (a) {
        var b = a.find( "#responsi-tab-text").text();
        if (a = Number(a.find( "select option:selected").val())) return {
            key: "data",
            value: {
                content: b,
                numTabs: a
            }
        }
    },
    getBorderValue: function (a) {
        var bsize = a.find( "select.input-select-size" );
        var bstyle = a.find( "select.input-select-style" );
        var bcolor = a.find( "input" );

        var idsize = bsize.attr( "id" ).substring(15);
        var idstyle = bstyle.attr( "id" ).substring(15);
        var idcolor = bcolor.attr( "id" ).substring(15);

        var sizev = bsize.val();
        var stylev = bstyle.val();
        var colorv = bcolor.val();
        if( colorv == '' ){
            colorv = 'transparent';
        }

        return {
            sizek:idsize,
            sizev:sizev,
            stylek:idstyle,
            stylev:stylev,
            colork:idcolor,
            colorv:colorv
        };
    },
    getFontValue: function (a) {
        var fsize = a.find( "select.input-select-size" );
        var fline_height = a.find( "select.input-select-line_height" );
        var ffont = a.find( "select.input-select-font" );
        var fstyle = a.find( "select.input-select-style" );
        var fcolor = a.find( "input" );

        var idsize = fsize.attr( "id" ).substring(15);
        var idline_height = fline_height.attr( "id" ).substring(15);
        var idfont = ffont.attr( "id" ).substring(15);
        var idstyle = fstyle.attr( "id" ).substring(15);
        var idcolor = fcolor.attr( "id" ).substring(15);

        var sizev = fsize.val();
        var line_heightv = fline_height.val();
        var fontv = ffont.val();
        var stylev = fstyle.val();
        var colorv = fcolor.val();
        if( colorv == '' ){
            colorv = 'transparent';
        }

        return {
            sizek:idsize,
            sizev:sizev,
            line_heightk:idline_height,
            line_heightv:line_heightv,
            fontk:idfont,
            fontv:fontv,
            stylek:idstyle,
            stylev:stylev,
            colork:idcolor,
            colorv:colorv
        };
    },
    getShadowValue: function (a) {
        var sh = a.find( "select.input-select-h" );
        var sv = a.find( "select.input-select-v" );
        var sblur = a.find( "select.input-select-blur" );
        var sspread = a.find( "select.input-select-spread" );
        var sinset = a.find( "select.input-select-inset" );
        var scolor = a.find( "input" );

        var idsh= sh.attr( "id" ).substring(15);
        var idsv= sv.attr( "id" ).substring(15);
        var idblur= sblur.attr( "id" ).substring(15);
        var idspread= sspread.attr( "id" ).substring(15);
        var idinset= sinset.attr( "id" ).substring(15);
        var idcolor = scolor.attr( "id" ).substring(15);

        var hv = sh.val();
        var vv = sv.val();
        var blurv = sblur.val();
        var spreadv = sspread.val();
        var insetv = sinset.val();
        var colorv = scolor.val();
        if( colorv == '' ){
            colorv = 'transparent';
        }

        return {
            hk:idsh,
            hv:hv,
            vk:idsv,
            vv:vv,
            blurk:idblur,
            blurv:blurv,
            spreadk:idspread,
            spreadv:spreadv,
            insetk:idinset,
            insetv:insetv,
            colork:idcolor,
            colorv:colorv
        };
    },
    makeShortcodeCustom: function (item) {

        var a = {},
            b = this;

        item.find( "td").each(function () {

            var h = jQuery(this),
                e = null;

            if (e = h.hasClass( "responsi-marker-border-control") ? b.getBorderValue(h) : '' ){
                a[e.sizek] = e.sizev;
                a[e.stylek] = e.stylev;
                a[e.colork] = e.colorv;
            }

            if (e = h.hasClass( "responsi-marker-font-control") ? b.getFontValue(h) : '' ){
                a[e.sizek] = e.sizev;
                a[e.line_heightk] = e.line_heightv;
                a[e.fontk] = e.fontv;
                a[e.stylek] = e.stylev;
                a[e.colork] = e.colorv;
            }
            if (e = h.hasClass( "responsi-marker-shadow-control") ? b.getShadowValue(h) : '' ){
                a[e.hk] = e.hv;
                a[e.vk] = e.vv;
                a[e.blurk] = e.blurv;
                a[e.spreadk] = e.spreadv;
                a[e.insetk] = e.insetv;
                a[e.colork] = e.colorv;
            }

            if (e = h.hasClass( "responsi-marker-column-control") ? b.getColumnKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
            if (e = h.hasClass( "responsi-marker-select-control") ? b.getSelectKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
            if (e = h.hasClass( "responsi-marker-tab-control") ? b.getTabKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
            if (e = h.hasClass( "responsi-marker-textarea-control") ? b.getTextAreaKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
            if (e = h.hasClass( "responsi-marker-checkbox-iphone-control") ? b.getCheckBoxKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
        });
        return a;
    },

    makeShortcode: function () {

        var a = {},
            b = this;

        var icon_type = jQuery( "#icon_type").val();

        jQuery( "#responsi-options-table td").each(function () {

            var h = jQuery(this),
                e = null;

            if (e = h.hasClass( "responsi-marker-border-control") ? b.getBorderValue(h) : '' ){
                a[e.sizek] = e.sizev;
                a[e.stylek] = e.stylev;
                a[e.colork] = e.colorv;
            }
            if (e = h.hasClass( "responsi-marker-font-control") ? b.getFontValue(h) : '' ){
                a[e.sizek] = e.sizev;
                a[e.line_heightk] = e.line_heightv;
                a[e.fontk] = e.fontv;
                a[e.stylek] = e.stylev;
                a[e.colork] = e.colorv;
            }
            if (e = h.hasClass( "responsi-marker-shadow-control") ? b.getShadowValue(h) : '' ){
                a[e.hk] = e.hv;
                a[e.vk] = e.vv;
                a[e.blurk] = e.blurv;
                a[e.spreadk] = e.spreadv;
                a[e.insetk] = e.insetv;
                a[e.colork] = e.colorv;
            }
            if (e = h.hasClass( "responsi-marker-column-control") ? b.getColumnKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
            if (e = h.hasClass( "responsi-marker-select-control") ? b.getSelectKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
            if (e = h.hasClass( "responsi-marker-tab-control") ? b.getTabKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
            if (e = h.hasClass( "responsi-marker-textarea-control") ? b.getTextAreaKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
            if (e = h.hasClass( "responsi-marker-checkbox-iphone-control") ? b.getCheckBoxKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
        });

        if (responsiShortcodeMeta.customMakeShortcode) return responsiShortcodeMeta.customMakeShortcode(a);
        var c = a.content ? a.content : responsiShortcodeMeta.defaultContent,
            f = "";



        for (var d in a) {
            var g = a[d];
            if ( (g != '') && (g != "none") && g && d != "content") f += " " + d + '="' + g + '"'
        }



        // Customise the shortcode output for various shortcode types.

        switch ( responsiShortcodeMeta.shortcodeType ) {

        	case 'text-replace':

        		//var shortcode = "[" + responsiShortcodeMeta.shortcode + f + "]" + (c ? c + "[/" + responsiShortcodeMeta.shortcode + "]" : " ")

        	break;

        	default:

        		//var shortcode = "[" + responsiShortcodeMeta.shortcode + f + "]" + (c ? c + "[/" + responsiShortcodeMeta.shortcode + "] " : " ")
                var shortcode = '[' + responsiShortcodeMeta.shortcode + ' icon="'+icon_type+'" ' + f + ']';

        	break;

        } // End SWITCH Statement

        return shortcode;
    },

    getSelectKeyValue: function (a) {
        var b = a.find( "select" );
        if (!b.length) return null;
        a = b.attr( "id").substring(15);
        b = b.val();
        return {
            key: a,
            value: b
        }
    },

    insertAction: function () {
        if (typeof responsiShortcodeMeta != "undefined") {
            var a = this.makeShortcode();
            tinyMCE.activeEditor.execCommand( "mceInsertContent", false, a);
            this.closeDialog()
        }
    },

    closeDialog: function () {
        this.needsPreview = false;
        tb_remove();
        jQuery( "#responsi-dialog").remove()
    },

    validateLinkFor: function (a) {
        var b = jQuery(a);
        b.removeClass( "responsi-validation-error" );
        b.removeClass( "responsi-validated" );
        if (a = b.val()) {
            b.addClass( "responsi-validating" );
            jQuery.ajax({
                url: ajaxurl,
                dataType: "json",
                data: {
                    action: "responsi_check_url_action",
                    url: a
                },
                error: function () {
                    b.removeClass( "responsi-validating")
                },
                success: function (c) {
                    b.removeClass( "responsi-validating" );
                    c.error || b.addClass(c.exists ? "responsi-validated" : "responsi-validation-error")
                }
            })
        }
    }

};

responsiDialogHelper.setUpButtons();
responsiDialogHelper.loadShortcodeDetails();
responsiDialogHelper.onOffCheckbox();
responsiDialogHelper.customLogicIconImage();
responsiDialogHelper.customLogicMultiCheck();
