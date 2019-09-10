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
    <div class="sort_table">
	  <div class="sort_table_item" id="sort_table_item-1">
		<table class="responsi-options-table">

			<tr>
				<th valign="top" scope="row" width="23%">
					<label for="responsi-value-text" class="">Text<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-text" name="responsi-value-text" value="Button" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-link" class="">Link<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-link" name="responsi-value-link" value="" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row"><label for="responsi-value-font" class="">Font<span class="optional"></span></label></th>
				<td class="responsi-marker-font-control">
					<?php Responsi_A3_Shortcode_Class::general_font_type('font','Arial, sans-serif' ,14,1,'normal','#FFFFFF');?>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-transform" class="">Transform<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-transform" name="responsi-value-transform" class="select input-select">
						<option selected="selected" value="none">None</option>
						<option value="uppercase">Uppercase</option>
						<option value="lowercase">Lowercase</option>
					</select>
				</td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-background" class="">Background<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#000000" data-default-color="#000000" id="responsi-value-background" name="responsi-value-background" class="icolor-picker" />
				</td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-gradient_from" class="">Gradient from<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#555555" data-default-color="#555555" id="responsi-value-gradient_from" name="responsi-value-gradient_from" class="icolor-picker" />
				</td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-gradient_to" class="">Gradient to<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#000000" data-default-color="#000000" id="responsi-value-gradient_to" name="responsi-value-gradient_to" class="icolor-picker" />
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-border" class="">Border<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php Responsi_A3_Shortcode_Class::general_border_type('border_', 0, 'solid', '#000000');?>
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
			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-shadow" class="">Shadow<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-shadow" data-novalue="false" hidden_class="shadow" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-shadow" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">Add shadow effect to Button Border</span>
				</td>
			</tr>
			<tr class="shadow">
				<th valign="top" scope="row"><label for="responsi-value-shadow_style" class=""><span class="optional"></span></label></th>
				<td class="responsi-marker-shadow-control responsi-control">
					<?php Responsi_A3_Shortcode_Class::general_shadow_type( 'shadow_', '0', '0', '0', '0', 'inset','#dbdbdb' );?>
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
					<input type="text" id="responsi-value-margin_top" name="responsi-value-margin_top" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="margin">
				<th valign="top" scope="row">
					<label for="responsi-value-margin_bottom" class="">Margin Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-margin_bottom" name="responsi-value-margin_bottom" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
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
					<input type="text" id="responsi-value-padding_top" name="responsi-value-padding_top" value="5px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_bottom" class="">Padding Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_bottom" name="responsi-value-padding_bottom" value="5px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_left" class="">Padding Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_left" name="responsi-value-padding_left" value="15px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_right" class="">Padding Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_right" name="responsi-value-padding_right" value="15px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-align" class="">Button Alignment<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-align" name="responsi-value-align" class="select input-select">
						<option selected="selected" value="none">None (Default)</option>
						<option value="leftwrap">Left - wrap</option>
						<option value="leftnowrap">Left - no wrap</option>
						<option value="center">Center</option>
						<option value="rightwrap">Right - wrap</option>
						<option value="rightnowrap">Right - no wrap</option>
					</select>
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-window" class="">Open in a new window<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-window" data-novalue="false" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-window" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON and link will open in a new window</span>
				</td>
			</tr>
			<tr>
				<td colspan="2"><h3>Icons</h3></td>
			</tr>
			<tr class="iconctrl">
			    <th valign="top" scope="row"><label for="responsi-value-container" class="">Icon<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-container" data-novalue="false" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-container" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>

		</table>
		<table class="responsi-options-table container">

			<tr>
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
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-iconcolor" class="">Icon Colour<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#FFFFFF" data-default-color="#FFFFFF" id="responsi-value-iconcolor" name="responsi-value-iconcolor" class="icolor-picker" />
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-position" class="">Icon Position<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-position" name="responsi-value-position" class="select input-select">
						<option value="left">Left</option>
						<option value="right">Right</option>
					</select>
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row"><label for="responsi-value-divider" class="">Divider<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-divider" data-novalue="no" hidden_class="divider" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-divider" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="divider">
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-divider_color" class="">Divider Colour<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#FFFFFF" data-default-color="#FFFFFF" id="responsi-value-divider_color" name="responsi-value-divider_color" class="icolor-picker" />
				</td>
			</tr>
		</table>
		<table class="responsi-options-table">
			<tr>
				<td colspan="2"><h3>Wrap HTML Elements</h3></td>
			</tr>
			<tr>
			    <th width="23%" valign="top" scope="row"><label for="responsi-value-wrapelement" class="">Wrap HTML Elements<span class="optional"></span></label></th>
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