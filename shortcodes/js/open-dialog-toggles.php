<?php
//if ( ! isset( $_GET['shortcodes-nonce'] ) || ( $_GET['shortcodes-nonce'] == '' ) ) die( 'Security check' );

// Get the path to the root.
$full_path = __FILE__;

$path_bits = explode( 'wp-content', $full_path );

$url = $path_bits[0];

// Require WordPress bootstrap.
require_once( $url . '/wp-load.php' );

// Nonce security check.    
//$nonce = $_GET['shortcodes-nonce'];
//if ( ! wp_verify_nonce( $nonce, 'responsi-shortcode-fontface-generator' ) ) die( 'Security check' );

wp_enqueue_script('jquery-ui-core');
wp_enqueue_script("jquery-ui-sortable");
wp_enqueue_script("jquery-ui-draggable");
global $ICONS;

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php do_action('responsi_before_popup_shortcode'); ?>
</head>
<body>
<div id="responsi-dialog">
<input type="hidden" id="icon_type" name="icon_type" value="<?php echo $_REQUEST['icon_type'];?>" >
<div id="responsi-options-buttons" class="clear_fix">
	<div class="alignleft">
	    <input type="button" id="responsi-btn-cancel" class="button" name="cancel" value="Cancel" accesskey="C" />
	</div>
	<div class="alignright">
	    <input type="button" id="responsi-btn-insert" class="button-primary" name="insert" value="Insert" accesskey="I" />  
	</div>
	<div class="clear"></div><!--/.clear_fix-->
</div><!--/#responsi-options-buttons .clear_fix-->

<div id="responsi-options" class="shortcode-popup-container align_left">
	<?php
	if( 'false' != $_REQUEST['icon_type']){
	?>
    	<h3><?php echo sprintf(__( 'Customize the default <i class="mce-ico mce-i-awesome shortcode-icon-%s"></i> Shortcode style [<a href="%s" target="_blank">create here</a>]', 'responsi_a3_shortcode' ), $_REQUEST['icon_type'], admin_url( 'admin.php?page=responsithemes_a3_shortcode' )); ?></h3>
    <?php
    }else{
    	?>
	    <h3><?php echo $_REQUEST['title'];?> Shortcode</h3>
	    <?php
    }
	?>
	<table id="responsi-options-table">
		<tr>
			<th width="23%" valign="top" scope="row"><label for="responsi-value-title_size" class="">Title / Icon Size<span class="optional"></span></label></th>
			<td class="responsi-marker-select-control">
				<select id="responsi-value-title_size" name="responsi-value-title_size" class="select input-select">
					<option value="10px">Small - 10px</option>
					<option value="18px">Medium - 18px</option>
					<option value="40px">Large - 40px</option>
					<?php
					for($i = 9; $i <= 70; $i++) {
						echo '<option '.selected( $i, 18, false ).' value="'.$i.'px">'.$i.'px</option>';
					}
					?>
				</select>
				<span class="responsi-input-help"></span>
			</td>
		</tr>
		<tr>
			<th width="23%" valign="top" scope="row">
				<label for="responsi-value-color" class="">Title Color<span class="optional"></span></label>
			</th>
			<td class="responsi-marker-colourpicker-control">
				<input type="text" value="#333333" data-default-color="#333333" id="responsi-value-color" name="responsi-value-color" class="responsi-color-picker" style="display:none" />
			</td>
		</tr>
		<tr>
			<th width="23%" valign="top" scope="row">
				<label for="responsi-value-activecolor" class="">Title Active Color<span class="optional"></span></label>
			</th>
			<td class="responsi-marker-colourpicker-control">
				<input type="text" value="#a0ce4e" data-default-color="#a0ce4e" id="responsi-value-activecolor" name="responsi-value-activecolor" class="responsi-color-picker" style="display:none" />
			</td>
		</tr>
		<tr>
			<th width="23%" valign="top" scope="row">
				<label for="responsi-value-iconcolor" class="">Icon Color<span class="optional"></span></label>
			</th>
			<td class="responsi-marker-colourpicker-control">
				<input type="text" value="#FFFFFF" data-default-color="#FFFFFF" id="responsi-value-iconcolor" name="responsi-value-iconcolor" class="responsi-color-picker" style="display:none" />
			</td>
		</tr>
		<tr>
			<th width="23%" valign="top" scope="row">
				<label for="responsi-value-iconactivecolor" class="">Icon Active Color<span class="optional"></span></label>
			</th>
			<td class="responsi-marker-colourpicker-control">
				<input type="text" value="#FFFFFF" data-default-color="#FFFFFF" id="responsi-value-iconactivecolor" name="responsi-value-iconactivecolor" class="responsi-color-picker" style="display:none" />
			</td>
		</tr>
		<tr>
		    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-cmargin" class="">Margin<span class="optional"></span></label></th>
			<td class="responsi-marker-checkbox-iphone-control section">
				<div class="checkbox-wrapper"><input id="responsi-value-cmargin" data-novalue="no" hidden_class="cmargin" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-margin" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">Margin above and below inserted toggle shortcode</span>
			</td>
		</tr>
		<tr class="cmargin">
			<th valign="top" scope="row">
				<label for="responsi-value-margin_top" class="">Margin Above<span class="optional"></span></label>
			</th>
			<td>
				<input type="text" id="responsi-value-margintop" name="responsi-value-margintop" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
			</td>
		</tr>
		<tr class="cmargin">
			<th valign="top" scope="row">
				<label for="responsi-value-margin_bottom" class="">Margin Below<span class="optional"></span></label>
			</th>
			<td>
				<input type="text" id="responsi-value-marginbottom" name="responsi-value-marginbottom" value="15px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
			</td>
		</tr>
		<tr>
			<td colspan="2"><h3>Wrap HTML Elements</h3></td>
		</tr>
		<tr>
		    <th width="23%" valign="top" scope="row"><label for="responsi-value-wrapelement" class="">Wrap HTML Elements<span class="optional"></span></label></th>
			<td class="responsi-marker-checkbox-iphone-control section">
				<div class="checkbox-wrapper"><input id="responsi-value-wrapelement" data-novalue="no" hidden_class="wrapelement" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-wrapelement" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
			</td>
		</tr>
		<tr class="wrapelement">
			<th valign="top" scope="row">
				<label for="responsi-value-class" class="">Css Class<span class="optional"></span></label>
			</th>
			<td>
				<input type="text" id="responsi-value-class" name="responsi-value-class" value="" class="txt input-text regular-text code" /><span class="responsi-input-help">Add a class to the wrapping HTML element.</span>
			</td>
		</tr>
		<tr class="wrapelement">
			<th valign="top" scope="row">
				<label for="responsi-value-id" class="">Css ID<span class="optional"></span></label>
			</th>
			<td>
				<input type="text" id="responsi-value-id" name="responsi-value-id" value="" class="txt input-text regular-text code" /><span class="responsi-input-help">Add a ID to the wrapping HTML element.</span>
			</td>
		</tr>
	</table>
    <div class="sort_table">
	  <div class="sort_table_item" id="sort_table_item-1">
		<h2 class="toggle item-title">Toggle<span class="_no">[1]</span> <i class="click_remove shortcode-icon-times"></i><i class="click_toggle shortcode-icon-minus"></i></h2>
		<table class="responsi-options-table">
			<tr>
				<td colspan="2"><h3>Title</h3></td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-title" class="">Title<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-title" name="responsi-value-title" value="Your Title Goes Here" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-title_padding" class="">Title Padding<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-title_padding" checked="checked" data-novalue="no" hidden_class="title_padding" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-title_padding" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="title_padding">
				<th valign="top" scope="row">
					<label for="responsi-value-title_padding_top" class="">Padding Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-title_padding_top" name="responsi-value-title_padding_top" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="title_padding">
				<th valign="top" scope="row">
					<label for="responsi-value-title_padding_bottom" class="">Padding Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-title_padding_bottom" name="responsi-value-title_padding_bottom" value="5px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="title_padding">
				<th valign="top" scope="row">
					<label for="responsi-value-title_padding_left" class="">Padding Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-title_padding_left" name="responsi-value-title_padding_left" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="title_padding">
				<th valign="top" scope="row">
					<label for="responsi-value-title_padding_right" class="">Padding Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-title_padding_right" name="responsi-value-title_padding_right" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-open" class="">Open by Default<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-open" data-novalue="no" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-open" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">Choose to have the toggle open when page loads.</span>
				</td>
			</tr>
			<tr>
				<td colspan="2"><h3>Content</h3></td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-content" class=""><span class="optional"></span></label>
				</th>
				<td class="responsi-marker-textarea-control">
					<textarea id="responsi-value-content" placeholder="Your Content Goes Here" name="responsi-value-content" class="txt input-textarea input-text regular-text code">Your Content Goes Here</textarea>
				</td>
			</tr>

			<tr>
			    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-content_padding" class="">Content Padding<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-content_padding" checked="checked" data-novalue="no" hidden_class="content_padding" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-content_padding" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="content_padding">
				<th valign="top" scope="row">
					<label for="responsi-value-content_padding_top" class="">Padding Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-content_padding_top" name="responsi-value-content_padding_top" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="content_padding">
				<th valign="top" scope="row">
					<label for="responsi-value-content_padding_bottom" class="">Padding Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-content_padding_bottom" name="responsi-value-content_padding_bottom" value="5px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="content_padding">
				<th valign="top" scope="row">
					<label for="responsi-value-content_padding_left" class="">Padding Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-content_padding_left" name="responsi-value-content_padding_left" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="content_padding">
				<th valign="top" scope="row">
					<label for="responsi-value-content_padding_right" class="">Padding right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-content_padding_right" name="responsi-value-content_padding_right" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>

			<tr>
				<td colspan="2"><h3>Container</h3></td>
			</tr>

			<tr>
			    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-containers" class="">Container<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-containers" checked="checked" data-novalue="no" hidden_class="containers" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-itemcontainer" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>

		</table>
		<table class="responsi-options-table containers">

			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-background" class="">Background<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#ffffff" data-default-color="#ffffff" id="responsi-value-background" name="responsi-value-background" class="responsi-color-picker" style="display:none" />
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border" class="">Border Top<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php Responsi_A3_Shortcode_Class::general_border_type('bordertop', 0, 'solid', '#e5e4e3');?>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border" class="">Border Bottom<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php Responsi_A3_Shortcode_Class::general_border_type('borderbottom', 1, 'solid', '#e5e4e3');?>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border" class="">Border Left<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php Responsi_A3_Shortcode_Class::general_border_type('borderleft', 0, 'solid', '#e5e4e3');?>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border" class="">Border Right<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php Responsi_A3_Shortcode_Class::general_border_type('borderright', 0, 'solid', '#e5e4e3');?>
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-margin" class="">Margin<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-margin" checked="checked" data-novalue="no" hidden_class="margin" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-margin" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="margin">
				<th valign="top" scope="row">
					<label for="responsi-value-margin_top" class="">Margin Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-margin_top" name="responsi-value-margin_top" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="margin">
				<th valign="top" scope="row">
					<label for="responsi-value-margin_bottom" class="">Margin Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-margin_bottom" name="responsi-value-margin_bottom" value="5px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="margin">
				<th valign="top" scope="row">
					<label for="responsi-value-margin_left" class="">Margin Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-margin_left" name="responsi-value-margin_left" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="margin">
				<th valign="top" scope="row">
					<label for="responsi-value-margin_right" class="">Margin Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-margin_right" name="responsi-value-margin_right" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-padding" class="">Padding<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-padding" checked="checked" data-novalue="no" hidden_class="padding" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-padding" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_top" class="">Padding Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_top" name="responsi-value-padding_top" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_bottom" class="">Padding Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_bottom" name="responsi-value-padding_bottom" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_left" class="">Padding Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_left" name="responsi-value-padding_left" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_right" class="">Padding Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_right" name="responsi-value-padding_right" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>

			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-corner" class="">Corners<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-corner" data-novalue="false" hidden_class="corner" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-corner" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to Create Circular background</span>
				</td>
			</tr>
			<tr class="corner">
				<th valign="top" scope="row"><label for="responsi-value-border_corner" class="">Border Corners<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-border_corner" name="responsi-value-border_corner" class="select input-select">
						<?php
						for($i = 0; $i <= 100; $i++) {
							echo '<option '.selected( $i, '0', false ).' value="'.$i.'px">'.$i.'px</option>';
						}
						?>
					</select>
					<span class="responsi-input-help">0px = square, 100px = circle</span>
				</td>
			</tr>

		</table>

	  </div>
	</div>
	<div class="add_new_toggle add_new_item_button"><a id="form-child-add" href="#">Add Toggle</a></div>
	<script type="text/javascript">

	var html_item = jQuery('.sort_table').find('.sort_table_item').html();

	jQuery('.add_new_item_button a').click(function (e) {
    	jQuery('.sort_table').append('<div class="sort_table_item">'+html_item+'</div>');
    	var _items = jQuery('.sort_table').find('h2.toggle');
		jQuery.each( _items, function( key, value ) {
			jQuery(this).children('span').html('['+(key+1)+']');
			jQuery(this).parent('.sort_table_item').attr('id','sort_table_item-'+key);
		});
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

        jQuery( '.sort_table_item .responsi-marker-select-control > select, .responsi-marker-border-control > select, .responsi-marker-font-control > select').wrap( '<div class="select_wrapper adding"></div>' ).before( '<span></span>' );
        jQuery('.select_wrapper.adding').each(function () {
        	jQuery(this).find( 'span').remove();
			jQuery(this).prepend('<span>' + jQuery(this).find('option:selected').text() + '</span>');
			jQuery(this).removeClass('adding');
		});
		responsiDialogHelper.onOffCheckbox();
		responsiDialogHelper.customLogicIconImage();
    });
	jQuery(".sort_table").sortable({
		update: function( event, ui ) {
			var _items = jQuery('.sort_table').find('h2.toggle');
			jQuery.each( _items, function( key, value ) {
				jQuery(this).children('span').html('['+(key+1)+']');
				jQuery(this).parent('.sort_table_item').attr('id','sort_table_item-'+key);
			});
		}
	});

	</script>
	<style type="text/css">
	.icon_picker{
		background: none repeat scroll 0 0 #fff;
	    border: 1px solid #aaa;
	    cursor: pointer;
	    height: 250px;
	    overflow-y: scroll;
	    width: 99.8%;
	}
	.icon_picker [class^="shortcode-icon-"]{
	    background: #fff;
		font-family: FontAwesome;
		font-weight: normal;
		font-style: normal;
		text-decoration: inherit;
		-webkit-font-smoothing: antialiased;
		font-size: 14px;
		line-height: 32px;
		text-align: center;
		cursor: pointer;
		width: 32px;
		height: 32px;
		display: inline-block;
		color: #494949;
		border: 1px solid #e1e1e1;
		margin-left: -1px;
		margin-top: -1px;
		transition: 		all 0.1s ease-out;
		-moz-transition: 	all 0.1s ease-out; /* Firefox 4 */
		-webkit-transition: all 0.1s ease-out; /* Safari and Chrome */
		-o-transition: 		all 0.1s ease-out; /* Opera */
	    width: 6.47%;
	}
	.icon_picker [class^="shortcode-icon-"]:hover {
		background-color: #eeeded;
		-webkit-transform:scale(1.3);
		-o-transform:scale(1.3);
		-moz-transform:scale(1.3);
		transform:scale(1.3);
	}
	.icon_picker [class^="shortcode-icon-"].active {
		background-color: #eeeded;
	}
	.sort_table_item {
	    background: #f8f6f6 none repeat scroll 0 0;
	    border: 1px solid #d6d6d6;
	    cursor: move;
	    margin-bottom: 5px;
	    padding: 8px 8px 0 !important;
	}
	.item-title{margin-top: 0; padding: 0 2px;}
	.click_toggle {
	    cursor: pointer;
	    float: right;
	    font-size: 18px;
	    margin-right: 5px;
	    position: relative;
	    top: 0;
	}
	.click_remove{float: right;margin-right: 0px;cursor: pointer;}
	.add_new_item_button{
		text-align: center;
		background: #ffffff;
		border:1px solid #dadada;
		margin-bottom: 5px;
		padding: 15px 15px;
		cursor: pointer;
	}
	.image_remove{
		cursor: pointer;
		color: red;
	}
	.add_new_item_button a{font-size: 1.5em;text-decoration: none;cursor: pointer;border: none;box-shadow: none;-webkit-box-shadow: none;}
	.tbopicon,.tbopimg{margin-bottom:0 !important;}
	</style>

</div>
<div class="clear"></div>
<?php
do_action('responsi_after_popup_shortcode');
?>
</div>
</body>
</html>