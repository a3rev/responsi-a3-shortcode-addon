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

global $responsi_options_a3_shortcode;
if( is_array($responsi_options_a3_shortcode)){
	$default_options = $responsi_options_a3_shortcode;
}else{
	global $responsi_a3_shortcode_addon;
	$default_options = $responsi_a3_shortcode_addon->global_responsi_options_a3_shortcode();
}
if( !isset($default_options['responsi_sc_fullwidth_border']) ){
	$default_options['responsi_sc_fullwidth_border'] = array('width' => '0','style' => 'solid','color' => '#eae9e9');
}
$bgfw = '';
if($default_options['responsi_sc_fullwidth_bg']['onoff'] == 'true'){
	$bgfw = ' checked="checked"';
}
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
    <div class="sort_table">
	  <div class="sort_table_item" id="sort_table_item-1">
		<table class="responsi-options-table">
			<tr>
				<td colspan="2"><h3>Section Content</h3></td>
			</tr>
			<tr>
				<th  width="23%" valign="top" scope="row">
					<label for="responsi-value-content" class="">Content<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-textarea-control">
					<textarea id="responsi-value-content" placeholder="Your Content Goes Here" name="responsi-value-content" class="txt input-textarea input-text regular-text code">Your Content Goes Here</textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2"><h3>Section Borders</h3></td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row"><label for="responsi-value-border" class="">Section Border<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php Responsi_A3_Shortcode_Class::general_border_type('border', $default_options['responsi_sc_fullwidth_border']['width'], $default_options['responsi_sc_fullwidth_border']['style'], $default_options['responsi_sc_fullwidth_border']['color']);?><span class="responsi-input-help">Section top and bottom border.</span>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-margin" class="">Border Margin<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-margin" data-novalue="" hidden_class="margin" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-margin" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to add a margin outside of section borders.</span>
				</td>
			</tr>
			<tr class="margin">
				<th valign="top" scope="row">
					<label for="responsi-value-margintop" class="">Margin Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-margintop" name="responsi-value-margintop" value="0px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="margin">
				<th valign="top" scope="row">
					<label for="responsi-value-marginbottom" class="">Margin Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-marginbottom" name="responsi-value-marginbottom" value="0px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-padding" class="">Border Padding<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-padding" data-novalue="" hidden_class="padding" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-padding" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">Adds padding between Border and Inner Content Container border.</span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-paddingtop" class="">Padding Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-paddingtop" name="responsi-value-paddingtop" value="20px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-paddingbottom" class="">Padding Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-paddingbottom" name="responsi-value-paddingbottom" value="20px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="padding hundred_percent1">
				<th valign="top" scope="row">
					<label for="responsi-value-paddingleft" class="">Padding Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-paddingleft" name="responsi-value-paddingleft" value="0px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="padding hundred_percent1">
				<th valign="top" scope="row">
					<label for="responsi-value-paddingright" class="">Padding Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-paddingright" name="responsi-value-paddingright" value="0px" class="txt input-text regular-text code" />
				</td>
			</tr>

			<tr>
				<td colspan="2"><h3>Section Style</h3></td>
			</tr>

			<tr class="icon_bg_ctrl" scope="row" width="23%">
			    <th valign="top" scope="row"><label for="responsi-value-onbackgroundcolor" class="">Background Colour<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-onbackgroundcolor"<?php echo $bgfw;?> data-novalue="false" hidden_class="icon_bg" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-onbackgroundcolor" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>

			<tr class="icon_bg">
				<th valign="top" scope="row">
					<label for="responsi-value-backgroundcolor" class=""><span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="<?php echo $default_options['responsi_sc_fullwidth_bg']['color'];?>" data-default-color="<?php echo $default_options['responsi_sc_fullwidth_bg']['color'];?>" id="responsi-value-backgroundcolor" name="responsi-value-backgroundcolor" class="responsi-color-picker" style="display:none" />
				</td>
			</tr>

			<tr class="video_css">
			    <th valign="top" scope="row"><label for="responsi-value-onoff_backgroundimage" class="">Background  Image<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-onoff_backgroundimage" data-novalue="off" hidden_class="on_bg_image" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-onoff_backgroundimage" value="on" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>

			<tr class="on_bg_image">
				<th valign="top" scope="row"><label for="responsi-value-backgroundimage" class="">Select Image<span class="optional"></span></label></th>
				<td class="responsi-marker-upload-control">
				    <div class="screenshot"></div>
					<input type="text" value="" id="responsi-value-backgroundimage" name="responsi-value-backgroundimage" class="upload responsi-value-backgroundimage" />
					<a title="Add Image" class="button upload_button_custom add_image" id="insert-media-button" href="#">Upload</a>
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
			<tr class="on_bg_image">
				<th valign="top" scope="row"><label for="responsi-value-backgroundattachment" class="">Background Attachment<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-backgroundattachment" name="responsi-value-backgroundattachment" class="select input-select">
						<option value="scroll">Scroll</option>
						<option value="fixed">Fixed</option>
						<option value="local">Local</option>
					</select>
				</td>
			</tr>
			<tr class="tr_fade">
			    <th valign="top" scope="row"><label for="responsi-value-fade" class="">Fading Animation<sLoop Videopan class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-fade" name="responsi-value-fade" data-novalue="no" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to create background colour and image fade and blur on scroll. NOTE! Do not turn ON this setting if adding a Self Hosted Video.</span>
				</td>
			</tr>

			<tr class="video_css">
				<th valign="top" scope="row" colspan="2">
					<h3>Inner Content Container<span class="optional"></span></h3>
				</th>
			</tr>
			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-hundred_percent" class="">Full Wide<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-hundred_percent" name="responsi-value-hundred_percent" data-novalue="no" hidden_off_class="hundred_percent" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON for edge to edge Content. OFF to set a max width in px.</span>
				</td>
			</tr>
			<tr class="hundred_percent">
				<th valign="top" scope="row">
					<label for="responsi-value-contentwidth" class="">Content Wide<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-contentwidth" name="responsi-value-contentwidth" value="<?php echo $default_options['responsi_sc_fullwidth_content_width'];?>px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-contentpadding" class="">Content Padding<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-contentpadding" data-novalue="" hidden_class="contentpadding" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-contentpadding" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">Adds padding between inner container border and content.</span>
				</td>
			</tr>
			<tr class="contentpadding">
				<th valign="top" scope="row">
					<label for="responsi-value-contentpaddingtop" class="">Padding Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-contentpaddingtop" name="responsi-value-contentpaddingtop" value="0px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="contentpadding">
				<th valign="top" scope="row">
					<label for="responsi-value-contentpaddingbottom" class="">Padding Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-contentpaddingbottom" name="responsi-value-contentpaddingbottom" value="0px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="contentpadding">
				<th valign="top" scope="row">
					<label for="responsi-value-contentpaddingleft" class="">Padding Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-contentpaddingleft" name="responsi-value-contentpaddingleft" value="0px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="contentpadding">
				<th valign="top" scope="row">
					<label for="responsi-value-contentpaddingright" class="">Padding Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-contentpaddingright" name="responsi-value-contentpaddingright" value="0px" class="txt input-text regular-text code" />
				</td>
			</tr>

			<tr class="video_css">
				<th valign="top" scope="row" colspan="2">
					<h3>Special Effects<span class="optional"></span></h3>
				</th>
			</tr>
			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-equal_height_columns" class="">Equal Height Columns<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-equal_height_columns" name="responsi-value-equal_height_columns" data-novalue="no" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">If using Columns shortcode.</span>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-menuanchor" class="">Section Menu Anchor<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-menuanchor" name="responsi-value-menuanchor" value="" class="txt input-text regular-text code" /><span class="responsi-input-help">This name will be the id you will have to use in your one page menu.</span>
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-wrapelement" class="">Wrap HTML Elements<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-wrapelement" name="responsi-value-wrapelement" data-novalue="no" hidden_class="wrapelement" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
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

			<tr class="video_css">
				<th valign="top" scope="row" colspan="2">
					<h3>Self Hosted Video<span class="optional"></span></h3>
				</th>
			</tr>

			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-video" class="">Video<sLoop Videopan class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-video" name="responsi-value-video" data-novalue="no" hidden_class="video" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">Only Self Hosted Video in WebM, MP4 or OVG formats</span>
				</td>
			</tr>

			<tr class="tr_video_background video">
			    <th valign="top" scope="row"><label for="responsi-value-video_background" class="">Video Background<sLoop Videopan class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-video_background" name="responsi-value-video_background" data-novalue="no" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON this will use video as background of container (WARNING: Only works when Fading Animation is OFF).</span>
				</td>
			</tr>

			<tr class="video">
				<th valign="top" scope="row">
					<label for="responsi-value-video_webm" class="">Video WebM Upload<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-video_webm" name="responsi-value-video_webm" value="" class="txt input-text regular-text code" /><span class="responsi-input-help">Video must be in a 16:9 aspect ratio. Add your WebM video file. WebM and MP4 format must be included to render your video with cross browser compatibility. OGV is optional.</span>
				</td>
			</tr>
			<tr class="video">
				<th valign="top" scope="row">
					<label for="responsi-value-video_mp4" class="">Video MP4 Upload<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-video_mp4" name="responsi-value-video_mp4" value="" class="txt input-text regular-text code" /><span class="responsi-input-help">Video must be in a 16:9 aspect ratio. Add your MP4 video file. MP4 and WebM format must be included to render your video with cross browser compatibility. OGV is optional.</span>
				</td>
			</tr>
			<tr class="video">
				<th valign="top" scope="row">
					<label for="responsi-value-video_ogv" class="">Video OGV Upload<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-video_ogv" name="responsi-value-video_ogv" value="" class="txt input-text regular-text code" /><span class="responsi-input-help">Add your OGV video file. This is optional.</span>
				</td>
			</tr>
			<tr class="video">
				<th valign="top" scope="row"><label for="responsi-value-video_preview_image" class="">Video Preview Image<span class="optional"></span></label></th>
				<td class="responsi-marker-upload-control">
				    <div class="screenshot"></div>
					<input type="text" value="" id="responsi-value-video_preview_image" name="responsi-value-video_preview_image" class="upload responsi-value-preview_image" />
					<a title="Add Image" class="button upload_button_custom add_image" id="insert-media-button" href="#">Upload</a><span class="responsi-input-help">IMPORTANT: This field must be used for self hosted videos. Self hosted videos do not work correctly on mobile devices. The preview image will be seen in place of your video on older browsers or mobile devices.</span>
				</td>
			</tr>
			<tr class="video">
				<th valign="top" scope="row">
					<label for="responsi-value-overlay_color" class="">Video Overlay Color<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="transparent" data-default-color="transparent" id="responsi-value-overlay_color" name="responsi-value-overlay_color" class="responsi-color-picker" style="display:none" />
				</td>
			</tr>
			<tr class="video">
				<th valign="top" scope="row">
					<label for="responsi-value-overlay_opacity" class="">Video Overlay Opacity<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-overlay_opacity" name="responsi-value-overlay_opacity" value="0.5" class="txt input-text regular-text code" /><span class="responsi-input-help">Opacity ranges between 0 (transparent) and 1 (opaque). ex: .4</span>
				</td>
			</tr>

			<tr class="video">
			    <th valign="top" scope="row"><label for="responsi-value-video_mute" class="">Mute Video<sLoop Videopan class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input checked="checked" id="responsi-value-video_mute" name="responsi-value-video_mute" data-novalue="no" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
			<tr class="video">
			    <th valign="top" scope="row"><label for="responsi-value-video_loop" class="">Loop Video<sLoop Videopan class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input checked="checked" id="responsi-value-video_loop" name="responsi-value-video_loop" data-novalue="no" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
		</table>
	  </div>
	</div>
	<script type="text/javascript">
	</script>
	<style type="text/css">
	.image_remove{
		cursor: pointer;
		color: red;
	}
	.video_css1{background-color: #fafafa;}
	.video_css1 label, .video_css1 h2{padding-left: 5px;}
	</style>
</div>
<div class="clear"></div>
<?php do_action('responsi_after_popup_shortcode'); ?>
</div>
</body>
</html>