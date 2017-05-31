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
			<tr class="typography">
			    <th valign="top" scope="row" width="23%"><label for="responsi-value-typography" class="">Custom Typography<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input checked="checked" id="responsi-value-typography" name="responsi-value-typography" data-novalue="no" hidden_class="typography_container" class="responsi-multi-logic responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
			<tr class="highlight" style="background:none;">
			    <th valign="top" scope="row" width="23%"><label for="responsi-value-highlight" class="">Highlight<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-highlight" name="responsi-value-highlight" data-novalue="no" hidden_class="highlight_container" class="responsi-multi-logic responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
			<tr class="dropcap">
			    <th valign="top" scope="row" width="23%"><label for="responsi-value-dropcap" class="">Dropcap<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-dropcap" name="responsi-value-dropcap" data-novalue="no" hidden_class="dropcap_container" class="responsi-multi-logic responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
			<tr class="quotation">
			    <th valign="top" scope="row" width="23%"><label for="responsi-value-quotation" class="">Quotation<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-quotation" name="responsi-value-quotation" data-novalue="no" hidden_class="quotation_container" class="responsi-multi-logic responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
			<tr class="title">
			    <th valign="top" scope="row" width="23%"><label for="responsi-value-title" class="">Section Heading<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-title" name="responsi-value-title" data-novalue="no" hidden_class="title_container" class="responsi-multi-logic responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
		</table>

	  	<div class="typography_container">
		<table class="responsi-options-table">
			<tr>
				<td colspan="2"><h3>Typography</h3></td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-tcontent" class="">Content<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-tcontent" name="responsi-value-tcontent" value="Your Content Goes Here" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row"><label for="responsi-value-typography" class="">Font<span class="optional"></span></label></th>
				<td class="responsi-marker-font-control">
					<?php Responsi_A3_Shortcode_Class::general_font_type('typography','Arial, sans-serif' ,12,1.2,'normal','#000000');?>
				</td>
			</tr>
		</table>
		</div>

		<div class="highlight_container" style="background:none;">
		<table class="responsi-options-table">
			<tr>
				<td colspan="2"><h3>Highlight</h3></td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-hcontent" class="">Content<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-hcontent" name="responsi-value-hcontent" value="Your Content Goes Here" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-hbackground" class="">Background Colour<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#ffa" data-default-color="#ffa" id="responsi-value-hbackground" name="responsi-value-hbackground" class="responsi-color-picker" style="display:none" />
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-hpadding" class="">Padding<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-hpadding" data-novalue="no" hidden_class="hpadding" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-hpadding" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="hpadding">
				<th valign="top" scope="row">
					<label for="responsi-value-hpadding_top" class="">Padding Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-hpadding_top" name="responsi-value-hpadding_top" value="3px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="hpadding">
				<th valign="top" scope="row">
					<label for="responsi-value-hpadding_bottom" class="">Padding Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-hpadding_bottom" name="responsi-value-hpadding_bottom" value="1px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="hpadding">
				<th valign="top" scope="row">
					<label for="responsi-value-hpadding_left" class="">Padding Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-hpadding_left" name="responsi-value-hpadding_left" value="3px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="hpadding">
				<th valign="top" scope="row">
					<label for="responsi-value-hpadding_right" class="">Padding Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-hpadding_right" name="responsi-value-hpadding_right" value="3px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
		</table>
		</div>

		<div class="dropcap_container">
		<table class="responsi-options-table">
			<tr>
				<td colspan="2"><h3>Dropcap</h3></td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-dcontent" class="">Content<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-dcontent" name="responsi-value-dcontent" value="Your Content Goes Here" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row"><label for="responsi-value-dropcap" class="">Font<span class="optional"></span></label></th>
				<td class="responsi-marker-font-control">
					<?php Responsi_A3_Shortcode_Class::general_font_type('dropcap','Arial, sans-serif' ,40,1.2,'normal','#000000');?>
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-dmargin" class="">Margin<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-dmargin" data-novalue="no" hidden_class="dmargin" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-dmargin" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="dmargin">
				<th valign="top" scope="row">
					<label for="responsi-value-dmargin_top" class="">Margin Top<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-dmargin_top" name="responsi-value-dmargin_top" value="7px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="dmargin">
				<th valign="top" scope="row">
					<label for="responsi-value-dmargin_bottom" class="">Margin Bottom<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-dmargin_bottom" name="responsi-value-dmargin_bottom" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="dmargin">
				<th valign="top" scope="row">
					<label for="responsi-value-dmargin_left" class="">Margin Left<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-dmargin_left" name="responsi-value-dmargin_left" value="0px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="dmargin">
				<th valign="top" scope="row">
					<label for="responsi-value-dmargin_right" class="">Margin Right<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-dmargin_right" name="responsi-value-dmargin_right" value="7px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
		</table>
		</div>

		<div class="quotation_container">
		<table class="responsi-options-table">
			<tr>
				<td colspan="2"><h3>Quote Icon and Text</h3></td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-qcontent" class="">Content<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-qcontent" name="responsi-value-qcontent" value="Your Content Goes Here" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-qcolor" class="">Icon Colour<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#cccccc" data-default-color="#cccccc" id="responsi-value-qcolor" name="responsi-value-qcolor" class="responsi-color-picker" style="display:none" />
				</td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-qtextcolor" class="">Text Colour<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#000000" data-default-color="#000000" id="responsi-value-qtextcolor" name="responsi-value-qtextcolor" class="responsi-color-picker" style="display:none" />
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-qfloat" class="">Float<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-qfloat" data-novalue="no" hidden_class="qfloat" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-dmargin" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="qfloat">
				<th valign="top" scope="row"><label for="responsi-value-qposition" class=""><span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-qposition" name="responsi-value-qposition" class="select input-select">
						<option value="left">Left</option>
						<option value="right">Right</option>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>
		</table>
		<table class="responsi-options-table tbcontainer">
			<tr>
				<td colspan="2"><h3>Quote Container</h3></td>
			</tr>
			<tr>
			    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-container" class="">Container<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-container" data-novalue="no" hidden_class="container" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-container" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
		</table>
		<table class="responsi-options-table container">
			<tr class="container">
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-qbackground" class="">Background Colour<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#fafafa" data-default-color="#fafafa" id="responsi-value-qbackground" name="responsi-value-qbackground" class="responsi-color-picker" style="display:none" />
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-qborder" class="">Border<span class="optional"></span></label></th>
				<td class="responsi-marker-border-control responsi-control">
					<?php Responsi_A3_Shortcode_Class::general_border_type('qborder_', 0, 'solid', '#dbdbdb');?>
				</td>
			</tr>

			<tr class="tbcorner">
			    <th valign="top" scope="row"><label for="responsi-value-qcorner" class="">Rounded Corners<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-qcorner" data-novalue="false" hidden_class="qcorner" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-qcorner" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="qcorner">
				<th valign="top" scope="row"><label for="responsi-value-qborder_corner" class="">Border Corners<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-qborder_corner" name="responsi-value-qborder_corner" class="select input-select">
						<?php
						for($i = 0; $i <= 100; $i++) {
							echo '<option '.selected( $i, 10, false ).' value="'.$i.'px">'.$i.'px</option>';
						}
						?>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>

			<tr class="tbshadow">
			    <th valign="top" scope="row"><label for="responsi-value-qshadow" class="">Border Shadow<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-qshadow" data-novalue="false" hidden_class="qshadow" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-shadow" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr class="qshadow">
				<th valign="top" scope="row"><label for="responsi-value-qshadow_style" class=""><span class="optional"></span></label></th>
				<td class="responsi-marker-shadow-control responsi-control">
					<?php Responsi_A3_Shortcode_Class::general_shadow_type( 'qshadow_', 0, 0, 0, 0, 'inset','#dbdbdb' );?>
				</td>
			</tr>
		</table>
		</div>

		<div class="title_container">
		<table class="responsi-options-table">
			<tr>
				<td colspan="2"><h3>Section Heading</h3></td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-tcontent" class="">Heading Text<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-tcontent" name="responsi-value-tcontent" value="Your Content Goes Here" class="txt input-text regular-text code" />
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-ttags" class="">Headding Tag<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-ttags" name="responsi-value-ttags" class="select input-select">
						<option value="1">H1</option>
						<option value="2">H2</option>
						<option value="3">H3</option>
						<option value="4">H4</option>
						<option value="5">H5</option>
						<option value="6">H6</option>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-talignment" class="">Text Alignment<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-talignment" name="responsi-value-talignment" class="select input-select">
						<option value="left">Left</option>
						<option value="right">Right</option>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-tseparator" class="">Separator<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-tseparator" name="responsi-value-tseparator" class="select input-select">
						<option value="single">Single</option>
						<option selected="selected" value="double">Double</option>
						<option value="underline">Underline</option>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row"><label for="responsi-value-tseparatorstyle" class="">Separator Style<span class="optional"></span></label></th>
				<td class="responsi-marker-select-control">
					<select id="responsi-value-tseparatorstyle" name="responsi-value-tseparatorstyle" class="select input-select">
						<option value="solid">Solid</option>
						<option value="dashed">Dashed</option>
						<option value="dotted">Dotted</option>
					</select>
					<span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-tseparatorcolor" class="">Separator Colour<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="#dbdbdb" data-default-color="#dbdbdb" id="responsi-value-tseparatorcolor" name="responsi-value-tseparatorcolor" class="responsi-color-picker" style="display:none" />
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

		</div>

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