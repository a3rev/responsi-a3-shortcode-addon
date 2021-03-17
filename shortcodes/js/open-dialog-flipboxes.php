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
global $responsi_options_a3_shortcode;
if( is_array($responsi_options_a3_shortcode)){
	$default_options = $responsi_options_a3_shortcode;
}else{
	global $responsi_a3_shortcode_addon;
	$default_options = $responsi_a3_shortcode_addon->global_responsi_options_a3_shortcode();
}
if( $default_options['responsi_sc_flip_boxes_front_radius']['corner'] != 'rounded' ) {
	$default_options['responsi_sc_flip_boxes_front_radius']['rounded_value'] = '0';
}
if( $default_options['responsi_sc_flip_boxes_back_radius']['corner'] != 'rounded' ) {
	$default_options['responsi_sc_flip_boxes_back_radius']['rounded_value'] = '0';
}

$bgfrontcheck = '';
if($default_options['responsi_sc_flip_boxes_front_bg']['onoff'] == 'true'){
	$bgfrontcheck = ' checked="checked"';
}
$bgbackcheck = '';
if($default_options['responsi_sc_flip_boxes_back_bg']['onoff'] == 'true'){
	$bgbackcheck = ' checked="checked"';
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
    	<h3><?php echo sprintf(__( 'Customize the default <i class="mce-ico mce-i-awesome shortcode-icon-%s"></i> Shortcode style [<a href="%s" target="_blank" rel="noopener">create here</a>]', 'responsi_a3_shortcode' ), $_REQUEST['icon_type'], admin_url( 'admin.php?page=responsithemes_a3_shortcode' )); ?></h3>
    <?php
    }else{
    	?>
	    <h3><?php echo $_REQUEST['title'];?> Shortcode</h3>
	    <?php
    }
	?>
	<table id="responsi-options-table">
		<tr>
			<td colspan="2"><h3>General Settings</h3></td>
		</tr>
		<tr>
			<th valign="top" scope="row" width="23%"><label for="responsi-value-columns" class="">Boxes per Row<span class="optional"></span></label></th>
			<td class="responsi-marker-select-control">
				<select id="responsi-value-columns" name="responsi-value-columns" class="select input-select">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select>
				<span class="responsi-input-help">Max number of Flip Boxes / row in large screens</span>
			</td>
		</tr>
		<tr>
		    <th valign="top" scope="row"><label for="responsi-value-margin_box" class="">Box Margin<span class="optional"></span></label></th>
			<td class="responsi-marker-checkbox-iphone-control section">
				<div class="checkbox-wrapper"><input id="responsi-value-margin_box" checked="checked" data-novalue="no" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-margin_box" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">OFF to remove margin around each Box</span>
			</td>
		</tr>
		<tr>
		    <th valign="top" scope="row"><label for="responsi-value-margin_container" class="">Container Margin<span class="optional"></span></label></th>
			<td class="responsi-marker-checkbox-iphone-control section">
				<div class="checkbox-wrapper"><input id="responsi-value-margin_container" checked="checked" data-novalue="no" hidden_class="margin_container" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-margin_box" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">Margin above and below shortcode container</span>
			</td>
		</tr>
		<tr class="margin_container">
			<th valign="top" scope="row">
				<label for="responsi-value-margintop" class="">Margin Top<span class="optional"></span></label>
			</th>
			<td>
				<input type="text" id="responsi-value-margintop" name="responsi-value-margintop" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help">Outside top border.</span>
			</td>
		</tr>
		<tr class="margin_container">
			<th valign="top" scope="row">
				<label for="responsi-value-marginbottom" class="">Margin Bottom<span class="optional"></span></label>
			</th>
			<td>
				<input type="text" id="responsi-value-marginbottom" name="responsi-value-marginbottom" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help">Outside bottom border.</span>
			</td>
		</tr>
		<tr>
			<td colspan="2"><h3>Wrap HTML Elements</h3></td>
		</tr>
		<tr>
		    <th valign="top" scope="row"><label for="responsi-value-wrapelement" class="">Wrap HTML Elements<span class="optional"></span></label></th>
			<td class="responsi-marker-checkbox-iphone-control section">
				<div class="checkbox-wrapper"><input id="responsi-value-wrapelement" data-novalue="no" hidden_class="wrapelement" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-margin_box" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
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
		<h2 class="flipboxe item-title">Flip Box<span class="_no">[1]</span> <i class="click_remove shortcode-icon-times"></i><i class="click_toggle shortcode-icon-minus"></i></h2>
		<table class="responsi-options-table">

			<tr>
				<td colspan="2"><h3>Front Container Style</h3></td>
			</tr>

			<tr class="icon_bg_ctrl">
			    <th valign="top" scope="row"><label for="responsi-value-onbackground_color_front" class="">Box Background Colour<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-onbackground_color_front"<?php echo $bgfrontcheck;?> data-novalue="false" hidden_class="icon_bg" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-onbackground_color_front" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>

			<tr class="icon_bg">
				<th valign="top" scope="row">
					<label for="responsi-value-background_color_front" class=""><span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="<?php echo $default_options['responsi_sc_flip_boxes_front_bg']['color'];?>" data-default-color="<?php echo $default_options['responsi_sc_flip_boxes_front_bg']['color'];?>" id="responsi-value-background_color_front" name="responsi-value-background_color_front" class="icolor-picker" />
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border_front_style" class="">Box Border Style<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php \A3Rev\RShortcode\HookFunction::general_border_type('border_front_', $default_options['responsi_sc_flip_boxes_front_border']['width'], $default_options['responsi_sc_flip_boxes_front_border']['style'], $default_options['responsi_sc_flip_boxes_front_border']['color']);?>
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border_front_radius" class="">Box Border Corners<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-border_front_radius" name="responsi-value-border_front_radius" class="select input-select">
						<?php
						for($i = 0; $i <= 200; $i++) {
							echo '<option '.selected( $i, $default_options['responsi_sc_flip_boxes_front_radius']['rounded_value'], true ).' value="'.$i.'px">'.$i.'px</option>';
						}
						?>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>

			<tr>
				<td colspan="2"><h3>Front Content</h3></td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border" class="">Title Font<span class="optional"></span></label></th>
				<td class="responsi-marker-font-control">
					<?php \A3Rev\RShortcode\HookFunction::general_font_type('title_front',$default_options['responsi_sc_flip_boxes_front_heading']['face'] ,$default_options['responsi_sc_flip_boxes_front_heading']['size'],$default_options['responsi_sc_flip_boxes_front_heading']['line_height'],$default_options['responsi_sc_flip_boxes_front_heading']['style'],$default_options['responsi_sc_flip_boxes_front_heading']['color']);?>
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row" width="23%">
					<label for="responsi-value-title_front" class="">Title Text<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-title_front" name="responsi-value-title_front" value="Your Content Goes Here" class="txt input-text regular-text code" />
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border" class="">Content Font<span class="optional"></span></label></th>
				<td class="responsi-marker-font-control">
					<?php \A3Rev\RShortcode\HookFunction::general_font_type('text_front',$default_options['responsi_sc_flip_boxes_front_text']['face'] ,$default_options['responsi_sc_flip_boxes_front_text']['size'],$default_options['responsi_sc_flip_boxes_front_text']['line_height'],$default_options['responsi_sc_flip_boxes_front_text']['style'],$default_options['responsi_sc_flip_boxes_front_text']['color']);?>
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-text_front" class="">Content<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-textarea-control">
					<textarea id="responsi-value-text_front" placeholder="Your Content Goes Here" name="responsi-value-text_front" class="txt input-textarea input-text regular-text code">Your Content Goes Here</textarea>
				</td>
			</tr>

			<tr>
				<td colspan="2"><h3>Front Icon / Image</h3></td>
			</tr>

			<tr class="iconctrl">
			    <th valign="top" scope="row" width="23%"><label for="responsi-value-fronticon" class="">Icon<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input checked="checked" id="responsi-value-fronticon" name="responsi-value-fronticon" data-novalue="no" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
			<tr class="imagectrl">
			    <th valign="top" scope="row" width="23%"><label for="responsi-value-frontimage" class="">Image<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-frontimage" name="responsi-value-frontimage" data-novalue="no" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>

		</table>
		<table class="responsi-options-table tbopicon">
			<tr class="tr_icon">
				<th valign="top" scope="row" width="23%"><label for="responsi-value-icon" class="">Select Icon<span class="optional"></span></label></th>
				<td class="responsi-marker-icon-control">
					<input type="hidden" value="" name="responsi-value-icon" id="responsi-value-icon" class="txt input-text regular-text code"  />
					<div class="icon_fontface_grid">
						<div class="icon_picker">
							<?php
							foreach( $ICONS as $val ){
								echo '<i class="shortcode-icon-'.$val.'" data-icon="'.$val.'"></i>';
							}
							?>
						</div>
					</div>
					<span class="responsi-input-help">Click an icon to select, click again to deselect.</span>
				</td>
			</tr>

			<tr>
				<td colspan="2"><h3>Icon Size and Style</h3></td>
			</tr>

			<tr class="tr_icon">
				<th valign="top" scope="row">
					<label for="responsi-value-icon_size" class="">Icon Size<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-icon_size" name="responsi-value-icon_size" class="select input-select">
						<?php
						for($i = 9; $i <= 70; $i++) {
							echo '<option '.selected( $i, 24, true ).' value="'.$i.'px">'.$i.'px</option>';
						}
						?>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>

			<tr class="tr_icon">
				<th valign="top" scope="row">
					<label for="responsi-value-icon_color" class="">Icon Color<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#ffffff" data-default-color="#ffffff" id="responsi-value-icon_color" name="responsi-value-icon_color" class="icolor-picker" />
				</td>
			</tr>
			<tr class="tr_icon">
			    <th valign="top" scope="row"><label for="responsi-value-circle" class="">Icon Circle<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-circle" name="responsi-value-circle" checked="checked" data-novalue="no" hidden_class="setting_circle" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>

			<tr class="tr_icon setting_circle">
				<th valign="top" scope="row">
					<label for="responsi-value-circle_color" class="">Circle Background<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#a0ce4e" data-default-color="#a0ce4e" id="responsi-value-circle_color" name="responsi-value-circle_color" class="icolor-picker" />
				</td>
			</tr>

			<tr class="tr_icon setting_circle">
				<th valign="top" scope="row">
					<label for="responsi-value-circle_border_color" class="">Circle Border<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#a0ce4e" data-default-color="#a0ce4e" id="responsi-value-circle_border_color" name="responsi-value-circle_border_color" class="icolor-picker" />
				</td>
			</tr>

			<tr class="tr_icon setting_circle">
				<th valign="top" scope="row">
					<label for="responsi-value-circle_paddingtop" class="">Circle Padding Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-circle_paddingtop" name="responsi-value-circle_paddingtop" value="20px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="tr_icon setting_circle">
				<th valign="top" scope="row">
					<label for="responsi-value-circle_paddingbottom" class="">Circle Padding Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-circle_paddingbottom" name="responsi-value-circle_paddingbottom" value="20px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="tr_icon setting_circle">
				<th valign="top" scope="row">
					<label for="responsi-value-circle_paddingleft" class="">Circle Padding Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-circle_paddingleft" name="responsi-value-circle_paddingleft" value="20px" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="tr_icon setting_circle">
				<th valign="top" scope="row">
					<label for="responsi-value-circle_paddingright" class="">Circle Padding Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-circle_paddingright" name="responsi-value-circle_paddingright" value="20px" class="txt input-text regular-text code" />
				</td>
			</tr>

		</table>
		<table class="responsi-options-table tbopimg">
			<tr class="tr_image">
				<th valign="top" scope="row" width="23%"><label for="responsi-value-image" class="">Select Image<span class="optional"></span></label></th>
				<td class="responsi-marker-upload-control">
				    <div class="screenshot"></div>
					<input type="text" value="" id="responsi-value-image" name="responsi-value-image" class="upload responsi-value-image" />
					<a title="Add Image" class="button upload_button_custom button-small wp-picker-defaultadd_image" id="insert-media-button" href="#">Upload</a>
				</td>
			</tr>

			<tr class="tr_image">
				<th valign="top" scope="row">
					<label for="responsi-value-image_width" class="">Image Width<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-image_width" name="responsi-value-image_width" value="35" class="txt input-text regular-text code" />
				</td>
			</tr>

			<tr class="tr_image">
				<th valign="top" scope="row">
					<label for="responsi-value-image_height" class="">Image Height<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-image_height" name="responsi-value-image_height" value="35" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr class="tr_image">
			    <th valign="top" scope="row"><label for="responsi-value-circle_image" class="">Image Circle<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-circle_image" name="responsi-value-circle_image" data-novalue="no" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to create circular image.</span>
				</td>
			</tr>
		</table>
		<table class="responsi-options-table tbeffect">
			<tr>
				<td colspan="2"><h3>Axis Position (Static)</h3></td>
			</tr>
			<tr class="tr_noflip">
			    <th  width="23%" valign="top" scope="row"><label for="responsi-value-flip" class="">Flip<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-flip" name="responsi-value-flip" data-novalue="no" hidden_off_class="" hidden_class="opflip" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>

			<tr class="tr_icon opflip">
				<th valign="top" scope="row"><label for="responsi-value-icon_flip" class=""><span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-icon_flip" name="responsi-value-icon_flip" class="select input-select">
						<option value="horizontal">Horizontal</option>
						<option value="vertical">Vertical</option>
					</select>
				</td>
			</tr>

			<tr class="tr_norotate">
			    <th valign="top" scope="row"><label for="responsi-value-rotate" class="">Rotate<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-rotate" name="responsi-value-rotate" data-novalue="no" hidden_off_class="" hidden_class="oprotate" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>

			<tr class="tr_icon oprotate">
				<th valign="top" scope="row"><label for="responsi-value-icon_rotate" class=""><span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-icon_rotate" name="responsi-value-icon_rotate" class="select input-select">
						<option value="90">90 degrees</option>
						<option value="180">180 degrees</option>
						<option value="270">270 degrees</option>
					</select>
				</td>
			</tr>

		</table>
		<table class="responsi-options-table tbeffect">

			<tr>
				<td colspan="2"><h3>Dynamic Effect</h3></td>
			</tr>

			<tr class="tr_nospin">
			    <th width="23%" valign="top" scope="row"><label for="responsi-value-spin" class="">Spin<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-spin" name="responsi-value-spin" data-novalue="no" hidden_off_class="" hidden_class="opspin" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
			<tr class="opspin">
				<th valign="top" scope="row"><label for="responsi-value-spin_speed" class="">Speed<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-spin_speed" name="responsi-value-spin_speed" class="select input-select">
						<?php
						for($i = 1; $i <= 30; $i++) {
							echo '<option '.selected( $i, 2, true ).' value="'.$i.'">'.$i.'s</option>';
						}
						?>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>

			<tr class="tr_icon tr_noanimation">
			    <th valign="top" scope="row"><label for="responsi-value-animation" class="">Animation<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-animation" name="responsi-value-circle" data-novalue="no" hidden_off_class="" hidden_class="tr_animation" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>

			<tr class="tr_animation">
				<th valign="top" scope="row"><label for="responsi-value-animation_type" class="">Animation Type<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-animation_type" name="responsi-value-animation_type" class="select input-select">
						<option value="bounce">Bounce</option>
						<option selected="selected" value="fade">Fade</option>
						<option value="flash">Flash</option>
						<option value="shake">Shake</option>
						<option value="slide">Slide</option>
					</select>
				</td>
			</tr>

			<tr class="tr_animation">
				<th valign="top" scope="row"><label for="responsi-value-animation_direction" class="">Direction of Animation<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-animation_direction" name="responsi-value-animation_direction" class="select input-select">
						<option value="down">Down</option>
						<option value="left">Left</option>
						<option value="right">Right</option>
						<option value="up">Up</option>
					</select>
				</td>
			</tr>

			<tr class="tr_animation">
				<th valign="top" scope="row"><label for="responsi-value-animation_speed" class="">Speed of Animation<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-animation_speed" name="responsi-value-animation_speed" class="select input-select">
						<option value="0.1">0.1</option>
						<option value="0.2">0.2</option>
						<option value="0.3">0.3</option>
						<option value="0.4">0.4</option>
						<option value="0.5">0.5</option>
						<option value="0.6">0.6</option>
						<option value="0.7">0.7</option>
						<option value="0.8">0.8</option>
						<option value="0.9">0.9</option>
						<option value="1">1</option>
					</select>
				</td>
			</tr>
		</table>
		<table class="responsi-options-table">
			<tr>
				<td colspan="2"><h3>Back Container Style</h3></td>
			</tr>

			<tr class="icon_bg_ctrl" scope="row" width="23%">
			    <th valign="top" scope="row"><label for="responsi-value-onbackground_color_back" class="">Box Background Colour<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-onbackground_color_back"<?php echo $bgbackcheck;?> data-novalue="false" hidden_class="icon_bg" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-onbackground_color_back" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>

			<tr class="icon_bg">
				<th valign="top" scope="row">
					<label for="responsi-value-background_color_back" class=""><span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="<?php echo $default_options['responsi_sc_flip_boxes_back_bg']['color'];?>" data-default-color="<?php echo $default_options['responsi_sc_flip_boxes_back_bg']['color'];?>" id="responsi-value-background_color_back" name="responsi-value-background_color_back" class="icolor-picker" />
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border_front_style" class="">Box Border Style<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php \A3Rev\RShortcode\HookFunction::general_border_type('border_back_', $default_options['responsi_sc_flip_boxes_back_border']['width'], $default_options['responsi_sc_flip_boxes_back_border']['style'], $default_options['responsi_sc_flip_boxes_back_border']['color']);?>
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border_back_radius" class="">Box Border Corners<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-border_back_radius" name="responsi-value-border_back_radius" class="select input-select">
						<?php
						for($i = 0; $i <= 200; $i++) {
							echo '<option '.selected( $i, $default_options['responsi_sc_flip_boxes_back_radius']['rounded_value'], true ).' value="'.$i.'px">'.$i.'px</option>';
						}
						?>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>

			<tr>
				<td colspan="2"><h3>Back Content</h3></td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-text_back" class="">Title Font<span class="optional"></span></label></th>
				<td class="responsi-marker-font-control">
					<?php \A3Rev\RShortcode\HookFunction::general_font_type('title_back',$default_options['responsi_sc_flip_boxes_back_heading']['face'] ,$default_options['responsi_sc_flip_boxes_back_heading']['size'],$default_options['responsi_sc_flip_boxes_back_heading']['line_height'],$default_options['responsi_sc_flip_boxes_back_heading']['style'],$default_options['responsi_sc_flip_boxes_back_heading']['color']);?>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-title_back" class="">Title Text<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-title_back" name="responsi-value-title_back" value="Your Content Goes Here" class="txt input-text regular-text code" />
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-text_back" class="">Content Font<span class="optional"></span></label></th>
				<td class="responsi-marker-font-control">
					<?php \A3Rev\RShortcode\HookFunction::general_font_type('text_back',$default_options['responsi_sc_flip_boxes_back_text']['face'] ,$default_options['responsi_sc_flip_boxes_back_text']['size'],$default_options['responsi_sc_flip_boxes_back_text']['line_height'],$default_options['responsi_sc_flip_boxes_back_text']['style'],$default_options['responsi_sc_flip_boxes_back_text']['color']);?>
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-content" class="">Content<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-textarea-control">
					<textarea id="responsi-value-content" placeholder="Your Content Goes Here" name="responsi-value-content" class="txt input-textarea input-text regular-text code">Your Content Goes Here</textarea>
				</td>
			</tr>

		</table>
	  </div>
	</div>
	<div class="add_new_flipboxe add_new_item_button"><a id="form-child-add" href="#">Add New Flip Box</a></div>
	<script type="text/javascript">

	var html_item = jQuery('.sort_table').find('.sort_table_item').html();

	jQuery('.add_new_item_button a').on( 'click', function (e) {
    	jQuery('.sort_table').append('<div class="sort_table_item">'+html_item+'</div>');
    	var _items = jQuery('.sort_table').find('h2.flipboxe');
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
		responsiDialogHelper.customLogicIconImage();
    });
	jQuery(".sort_table").sortable({
		update: function( event, ui ) {
			var _items = jQuery('.sort_table').find('h2.flipboxe');
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