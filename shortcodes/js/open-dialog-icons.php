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
$corner = '';
if($default_options['responsi_sc_icon_border_radius']['corner'] == 'rounded'){
	$corner = ' checked="checked"';
}
$shadow = '';
if($default_options['responsi_sc_icon_shadow']['onoff'] == 'true'){
	$shadow = ' checked="checked"';
}

$bgcheck = '';
if($default_options['responsi_sc_icon_background']['onoff'] == 'true'){
	$bgcheck = ' checked="checked"';
}

global $ICONS;

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php do_action('responsi_before_popup_shortcode'); ?>
</head>
<body>
<div id="responsi-dialog">
<input type="hidden" id="icon_type" name="icon_type" value="<?php echo $_GET['icon_type'];?>" >
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
	if( 'false' != $_GET['icon_type']){
	?>
    	<h3><?php echo sprintf(__( 'Customize the default <i class="mce-ico mce-i-awesome shortcode-icon-%s"></i> Shortcode style [<a href="%s" target="_blank">create here</a>]', 'responsi_a3_shortcode' ), $_GET['icon_type'], admin_url( 'admin.php?page=responsithemes_a3_shortcode' )); ?></h3>
    <?php
    }else{
    	?>
	    <h3><?php echo $_GET['title'];?> Shortcode</h3>
	    <?php
    }
	?>
    <div class="sort_table">
	  <div class="sort_table_item" id="sort_table_item-1">
		<table class="responsi-options-table">
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
				<td colspan="2" class="responsi-marker-icon-control">
					<input type="hidden" value="adjust" name="responsi-value-icon" id="responsi-value-icon" class="txt input-text regular-text code"  />
					<div class="icon_fontface_grid">
						<div class="icon_picker">
							<?php
							foreach( $ICONS as $val ){
								if( $val == 'adjust'){
									echo '<i class="shortcode-icon-'.$val.' active" dataicon="'.$val.'"></i>';
								}else{echo '<i class="shortcode-icon-'.$val.'" data-icon="'.$val.'"></i>';}
							}
							?>
						</div>
					</div>
					<span class="responsi-input-help">Click an icon to select, click again to deselect.</span>
				</td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row"><label for="responsi-value-size" class="">Size<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-size" name="responsi-value-size" class="select input-select">
						<option value="small" <?php echo selected( 'small', $default_options['responsi_sc_icon_size'], false );?>>Small - 10px</option>
						<option value="medium"<?php echo selected( 'medium', $default_options['responsi_sc_icon_size'], false );?>>Medium - 18px</option>
						<option value="large"<?php echo selected( 'large', $default_options['responsi_sc_icon_size'], false );?>>Large - 40px</option>
						<?php
						for($i = 9; $i <= 70; $i++) {
							echo '<option '.selected( $i, $default_options['responsi_sc_icon_size'], false ).' value="'.$i.'px">'.$i.'px</option>';
						}
						?>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-color" class="">Colour<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="<?php echo $default_options['responsi_sc_icon_color'];?>" data-default-color="<?php echo $default_options['responsi_sc_icon_color'];?>" id="responsi-value-color" name="responsi-value-color" class="responsi-color-picker" style="display:none" />
				</td>
			</tr>
		</table>
		<table class="responsi-options-table tbopimg">
			<tr class="tr_image">
				<th valign="top" scope="row" width="23%"><label for="responsi-value-image" class="">Select Image<span class="optional"></span></label></th>
				<td class="responsi-marker-upload-control">
				    <div class="screenshot"></div>
					<input type="text" value="" id="responsi-value-image" name="responsi-value-image" class="upload responsi-value-image" />
					<a title="Add Image" class="button upload_button_custom add_image" id="insert-media-button" href="#">Upload</a>
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
		</table>
		<table class="responsi-options-table tbcontainer">
			<tr>
				<td colspan="2"><h3>Icons Container</h3></td>
			</tr>
			<tr>
			    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-container" class="">Container<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-container" data-novalue="no" hidden_class="container" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-container" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to create a custom conatiner for the icon.</span>
				</td>
			</tr>
		</table>
		<table class="responsi-options-table container">
			<tr class="icon_bg_ctrl">
			    <th valign="top" scope="row"><label for="responsi-value-onbackground" class="">Background Colour<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-onbackground"<?php echo $bgcheck;?> data-novalue="false" hidden_class="icon_bg" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-onbackground" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
			<tr class="icon_bg">
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-background" class=""><span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="<?php echo $default_options['responsi_sc_icon_background']['color'];?>" data-default-color="<?php echo $default_options['responsi_sc_icon_background']['color'];?>" id="responsi-value-background" name="responsi-value-background" class="responsi-color-picker" style="display:none" />
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border" class="">Border<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php Responsi_A3_Shortcode_Class::general_border_type('border_', $default_options['responsi_sc_icon_border']['width'], $default_options['responsi_sc_icon_border']['style'], $default_options['responsi_sc_icon_border']['color']);?>
				</td>
			</tr>

			<tr class="tbcorner">
			    <th valign="top" scope="row"><label for="responsi-value-corner" class="">Rounded Corners<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-corner"<?php echo $corner;?> data-novalue="false" hidden_class="corner" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-corner" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to Create Circular background</span>
				</td>
			</tr>
			<tr class="corner">
				<th valign="top" scope="row"><label for="responsi-value-border_corner" class="">Border Corners<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-border_corner" name="responsi-value-border_corner" class="select input-select">
						<!-- <option value="0">Square</option>
						<option value="100%" selected="selected">Circle</option> -->
						<?php
						for($i = 0; $i <= 100; $i++) {
							echo '<option '.selected( $i, $default_options['responsi_sc_icon_border_radius']['rounded_value'], false ).' value="'.$i.'px">'.$i.'px</option>';
						}
						?>
					</select>
					<span class="responsi-input-help">0px = square, 100px = circle</span>
				</td>
			</tr>

			<tr class="tbshadow">
			    <th valign="top" scope="row"><label for="responsi-value-shadow" class="">Border Shadow<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-shadow"<?php echo $shadow;?> data-novalue="false" hidden_class="shadow" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-shadow" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">Add shadow effect to Container Border</span>
				</td>
			</tr>
			<tr class="shadow">
				<th valign="top" scope="row"><label for="responsi-value-shadow_style" class=""><span class="optional"></span></label></th>
				<td class="responsi-marker-shadow-control responsi-control">
					<?php Responsi_A3_Shortcode_Class::general_shadow_type( 'shadow_', $default_options['responsi_sc_icon_shadow']['h_shadow'], $default_options['responsi_sc_icon_shadow']['v_shadow'], $default_options['responsi_sc_icon_shadow']['blur'], $default_options['responsi_sc_icon_shadow']['spread'], $default_options['responsi_sc_icon_shadow']['inset'],$default_options['responsi_sc_icon_shadow']['color'] );?>
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-margin" class="">Margin<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-margin" data-novalue="no" hidden_class="margin" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-margin" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="margin">
				<th valign="top" scope="row">
					<label for="responsi-value-margin_top" class="">Margin Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-margin_top" name="responsi-value-margin_top" value="<?php echo $default_options['responsi_sc_icon_margin_top'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="margin">
				<th valign="top" scope="row">
					<label for="responsi-value-margin_bottom" class="">Margin Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-margin_bottom" name="responsi-value-margin_bottom" value="<?php echo $default_options['responsi_sc_icon_margin_bottom'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="margin">
				<th valign="top" scope="row">
					<label for="responsi-value-margin_left" class="">Margin Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-margin_left" name="responsi-value-margin_left" value="<?php echo $default_options['responsi_sc_icon_margin_left'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="margin">
				<th valign="top" scope="row">
					<label for="responsi-value-margin_right" class="">Margin Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-margin_right" name="responsi-value-margin_right" value="<?php echo $default_options['responsi_sc_icon_margin_right'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-padding" class="">Padding<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-padding" data-novalue="no" hidden_class="padding" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-padding" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_top" class="">Padding Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_top" name="responsi-value-padding_top" value="<?php echo $default_options['responsi_sc_icon_padding_top'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_bottom" class="">Padding Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_bottom" name="responsi-value-padding_bottom" value="<?php echo $default_options['responsi_sc_icon_padding_bottom'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_left" class="">Padding Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_left" name="responsi-value-padding_left" value="<?php echo $default_options['responsi_sc_icon_padding_left'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_right" class="">Padding Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_right" name="responsi-value-padding_right" value="<?php echo $default_options['responsi_sc_icon_padding_right'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
		</table>
		<table class="responsi-options-table tbeffect">
			<tr>
				<td colspan="2"><h3>Axis Position (Static)</h3></td>
			</tr>
			<tr class="tr_noflip">
			    <th width="23%" valign="top" scope="row"><label for="responsi-value-flip" class="">Flip<span class="optional"></span></label></th>
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
	  </div>
	</div>
	<script type="text/javascript">
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
	.item-title{margin-top: 0; padding: 0 2px;}
	.image_remove{
		cursor: pointer;
		color: red;
	}
	.tbopicon,.tbopimg{margin-bottom:0 !important;}
	</style>
</div>
<div class="clear"></div>
<?php do_action('responsi_after_popup_shortcode'); ?>
</div>
</body>
</html>
