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
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-background" class="">Background<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#ffffff" data-default-color="#ffffff" id="responsi-value-background" name="responsi-value-background" class="icolor-picker" />
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-bordertop" class="">Border Top<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php \A3Rev\RShortcode\HookFunction::general_border_type('bordertop', 3, 'solid', '#a0ce4e');?>
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-borderbottom" class="">Border Bottom<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php \A3Rev\RShortcode\HookFunction::general_border_type('borderbottom', 1, 'solid', '#e8e6e6');?>
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-borderleft" class="">Border Left<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php \A3Rev\RShortcode\HookFunction::general_border_type('borderleft', 1, 'solid', '#e8e6e6');?>
				</td>
			</tr>

			<tr>
				<th valign="top" scope="row"><label for="responsi-value-borderright" class="">Border Right<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php \A3Rev\RShortcode\HookFunction::general_border_type('borderright', 1, 'solid', '#e8e6e6');?>
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
			    <th valign="top" scope="row" width="23%"><label for="responsi-value-defaultshadow" class="">Default Shadow<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-defaultshadow" name="responsi-value-defaultshadow" data-novalue="no" hidden_class="defaultshadowcolor" class="responsi-multi-logic responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
			<tr class="defaultshadowcolor">
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-defaultshadowcolor" class=""><span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#555555" data-default-color="#555555" id="responsi-value-defaultshadowcolor" name="responsi-value-defaultshadowcolor" class="icolor-picker" />
				</td>
			</tr>
			<tr class="defaultshadowcolor">
				<th width="23%" valign="top" scope="row"><label for="responsi-value-defaultshadowopacity" class="">Opacity<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-defaultshadowopacity" name="responsi-value-defaultshadowopacity" class="select input-select">
						<option value="0.1">0.1</option>
						<option value="0.2">0.2</option>
						<option value="0.3">0.3</option>
						<option value="0.4">0.4</option>
						<option value="0.5">0.5</option>
						<option value="0.6">0.6</option>
						<option value="0.7" selected="selected">0.7</option>
						<option value="0.8">0.8</option>
						<option value="0.9">0.9</option>
						<option value="1">1</option>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row" width="23%"><label for="responsi-value-customshadow" class="">Custom Shadow<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-customshadow" name="responsi-value-customshadow" data-novalue="false" hidden_class="customshadow" class="responsi-multi-logic responsi-input responsi-checkbox-iphone" type="checkbox" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
			<tr class="customshadow">
				<th valign="top" scope="row"><label for="responsi-value-shadow_style" class=""><span class="optional"></span></label></th>
				<td class="responsi-marker-shadow-control responsi-control">
					<?php \A3Rev\RShortcode\HookFunction::general_shadow_type( 'customshadow', '0', '0', '0', '0', 'inset','#dbdbdb' );?>
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
					<input type="text" id="responsi-value-margin_bottom" name="responsi-value-margin_bottom" value="20px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
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
					<input type="text" id="responsi-value-padding_top" name="responsi-value-padding_top" value="20px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_bottom" class="">Padding Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_bottom" name="responsi-value-padding_bottom" value="20px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_left" class="">Padding Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_left" name="responsi-value-padding_left" value="20px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="padding">
				<th valign="top" scope="row">
					<label for="responsi-value-padding_right" class="">Padding Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-padding_right" name="responsi-value-padding_right" value="20px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
				<td colspan="2"><h3>Icon Settings</h3></td>
			</tr>

			<tr>
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
					<input type="hidden" value="info-circle" name="responsi-value-icon" id="responsi-value-icon" class="txt input-text regular-text code"  />
					<div class="icon_fontface_grid">
						<div class="icon_picker">
							<?php
							foreach( $ICONS as $val ){
								if( $val == 'info-circle'){
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
				<th width="23%" valign="top" scope="row"><label for="responsi-value-iconsize" class="">Size<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-iconsize" name="responsi-value-iconsize" class="select input-select">
						<option value="10px">Small - 10px</option>
						<option selected="selected" value="18px">Medium - 18px</option>
						<option value="40px">Large - 40px</option>
						<?php
						for($i = 9; $i <= 70; $i++) {
							echo '<option value="'.$i.'px">'.$i.'px</option>';
						}
						?>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-iconcolor" class="">Colour<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#a0ce4e" data-default-color="#a0ce4e" id="responsi-value-iconcolor" name="responsi-value-iconcolor" class="icolor-picker" />
				</td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row"><label for="responsi-value-iconposition" class="">Position<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-iconposition" name="responsi-value-iconposition" class="select input-select">
						<option selected="selected" value="top">Top</option>
						<option value="center">Center</option>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>
		</table>
		<table class="responsi-options-table">
			<tr>
				<td colspan="2"><h3>Content Info Box</h3></td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-content" class="">Content<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-textarea-control">
					<textarea id="responsi-value-content" placeholder="Your Content Goes Here" name="responsi-value-content" class="txt input-textarea input-text regular-text code">Your Content Goes Here</textarea>
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