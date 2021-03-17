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
    	<h3><?php echo sprintf(__( 'Customize the default <i class="mce-ico mce-i-awesome shortcode-icon-%s"></i> Shortcode style [<a href="%s" target="_blank" rel="noopener">create here</a>]', 'responsi_a3_shortcode' ), $_REQUEST['icon_type'], admin_url( 'admin.php?page=responsithemes_a3_shortcode' )); ?></h3>
    <?php
    }else{
    	?>
	    <h3><?php echo $_REQUEST['title'];?> Shortcode</h3>
	    <?php
    }
	?>
	<table id="responsi-options-table">
	</table>
    <div class="sort_table">
	  <div class="sort_table_item" id="sort_table_item-1">
		<h2 class="item-title column">Column <span class="_no">[1]</span> <i class="shortcode-icon-times click_remove"></i><i class="shortcode-icon-minus click_toggle"></i></h2>
		<table class="responsi-options-table">

			<tr class="video_css">
				<td colspan="2"><h3>Column Layout</h3></td>
			</tr>

			<tr class="video_css">
				<th valign="top" scope="row" width="23%"><label for="responsi-value-column_type" class="">Column Type<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-column_type" name="responsi-value-column_type" class="select input-select">
						<option value="one_half">One Half</option>
						<option value="one_third">One Third</option>
						<option value="two_third">Two Thirds</option>
						<option value="one_fourth">One Fourth</option>
						<option value="three_fourth">Three Fourth</option>
						<option value="one_fifth">One Fifth</option>
						<option value="two_fifth">Two Fifth</option>
						<option value="three_fifth">Three Fifth</option>
						<option value="four_fifth">Four Fifth</option>
						<option value="one_sixth">One Sixth</option>
						<option value="five_sixth">Five Sixth</option>
					</select><span class="responsi-input-help">Select the width of the column</span>
				</td>
			</tr>

			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-last" class="">Last Column<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-last" name="responsi-value-last" data-novalue="no" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">Choose if the column is last in a set. This has to be set to "ON" for the last column in a set</span>
				</td>
			</tr>

			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-spacing" class="">Column Spacing<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input checked="checked" id="responsi-value-spacing" name="responsi-value-spacing" data-novalue="no" hidden_class="spacing" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">Set to "OFF" to eliminate margin between columns.</span>
				</td>
			</tr>

			<tr class="spacing">
				<th valign="top" scope="row">
					<label for="responsi-value-margintop" class="">Margin Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-margintop" name="responsi-value-margintop" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help">Adds a Margin (space) in px above the columns</span>
				</td>
			</tr>
			<tr class="spacing">
				<th valign="top" scope="row">
					<label for="responsi-value-marginbottom" class="">Margin Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-marginbottom" name="responsi-value-marginbottom" value="20px" class="txt input-text regular-text code" /><span class="responsi-input-help">Adds a Margin (space) in px below the columns</span>
				</td>
			</tr>

			<tr class="video_css">
				<td colspan="2"><h3>Column Container</h3></td>
			</tr>

			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-backgroundcolor" class="">Background Color<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="transparent" data-default-color="transparent" id="responsi-value-backgroundcolor" name="responsi-value-backgroundcolor" class="icolor-picker" />
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border" class="">Border<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php \A3Rev\RShortcode\HookFunction::general_border_type('border');?>
				</td>
			</tr>

			<tr class="video_css">
			    <th valign="top" scope="row"><label for="responsi-value-onoff_backgroundimage" class="">Enable Background  &nbsp;&nbsp;<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-onoff_backgroundimage" data-novalue="off" hidden_class="on_bg_image" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-onoff_backgroundimage" value="on" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>

			<tr class="on_bg_image">
				<th valign="top" scope="row"><label for="responsi-value-backgroundimage" class="">Background Image<span class="optional"></span></label></th>
				<td class="responsi-marker-upload-control">
				    <div class="screenshot"></div>
					<input type="text" value="" id="responsi-value-backgroundimage" name="responsi-value-backgroundimage" class="upload responsi-value-backgroundimage" />
					<a title="Add Image" class="button upload_button_custom button-small wp-picker-defaultadd_image" id="insert-media-button" href="#">Upload</a>
				</td>
			</tr>
			<tr class="on_bg_image">
				<th valign="top" scope="row"><label for="responsi-value-backgroundrepeat" class="">Background Repeat<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-backgroundrepeat" name="responsi-value-backgroundrepeat" class="select input-select">
						<option value="no-repeat">No Repeat</option>
						<option value="repeat">Repeat Vertically and Horizontally</option>
						<option value="repeat-x">Repeat Horizontally</option>
						<option value="repeat-y">Repeat Vertically</option>
					</select>
				</td>
			</tr>
			<tr class="on_bg_image">
				<th valign="top" scope="row"><label for="responsi-value-backgroundposition" class="">Background Position<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-backgroundposition" name="responsi-value-backgroundposition" class="select input-select">
						<option value="left top">Left Top</option>
						<option value="left center">Left Center</option>
						<option value="left bottom">Left Bottom</option>
						<option value="right top">Right Top</option>
						<option value="right center">Right Center</option>
						<option value="right bottom">Right Bottom</option>
						<option value="center top">Center Top</option>
						<option value="center center">Center Center</option>
						<option value="center bottom">Center Bottom</option>
					</select>
				</td>
			</tr>

			<tr class="video_css">
				<td colspan="2"><h3>Content Padding</h3></td>
			</tr>

			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-padding" class="">Padding<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-padding" name="responsi-value-padding" data-novalue="no" hidden_class="padding" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to add Padding between column borders and content.</span>
				</td>
			</tr>

			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-paddingtop" class="">Padding Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-paddingtop" name="responsi-value-paddingtop" value="0px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-paddingbottom" class="">Padding Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-paddingbottom" name="responsi-value-paddingbottom" value="0px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-paddingleft" class="">Padding Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-paddingleft" name="responsi-value-paddingleft" value="0px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-paddingright" class="">Padding Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-paddingright" name="responsi-value-paddingright" value="0px" class="txt input-text regular-text code" />
				</td>
			</tr>

			<tr class="video_css">
				<td colspan="2"><h3>Column Content</h3></td>
			</tr>

			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-content" class="">Content<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-textarea-control">
					<textarea id="responsi-value-content" placeholder="Your Content Goes Here" name="responsi-value-content" class="txt input-textarea input-text regular-text code wp-editor-area">Your Content Goes Here</textarea>
				</td>
			</tr>

			<tr class="video_css">
				<td colspan="2"><h3>Wrap HTML Elements</h3></td>
			</tr>

			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-wrapelement" class="">Wrap HTML Elements<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-wrapelement" name="responsi-value-wrapelement" data-novalue="no" hidden_class="wrapelement" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
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
	  </div>
	</div>
	<div class="add_new_item_button"><a id="form-child-add" href="#">Add New Column</a></div>
	<script type="text/javascript">
	var html_item = jQuery('.sort_table').find('.sort_table_item').html();

	jQuery('.add_new_item_button a').on( 'click', function (e) {
    	jQuery('.sort_table').append('<div class="sort_table_item">'+html_item+'</div>');
    	var _items = jQuery('.sort_table').find('h2.column');
		jQuery.each( _items, function( key, value ) {
			jQuery(this).children('span').html('['+(key+1)+']');
			jQuery(this).parent('.sort_table_item').attr('id','sort_table_item-'+key);
		});
		jQuery( '.responsi-marker-colourpicker-control .icolor-picker').each ( function () {
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
    });

	jQuery(".sort_table").sortable({
		update: function( event, ui ) {
			var _items = jQuery('.sort_table').find('h2.column');
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
	</style>

</div>
<div class="clear"></div>
<?php do_action('responsi_after_popup_shortcode'); ?>
</div>
</body>
</html>