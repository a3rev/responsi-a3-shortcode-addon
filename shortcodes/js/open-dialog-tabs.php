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
<?php
global $responsi_options_a3_shortcode;
if( is_array($responsi_options_a3_shortcode)){
	$default_options = $responsi_options_a3_shortcode;
}else{
	global $responsi_a3_shortcode_addon;
	$default_options = $responsi_a3_shortcode_addon->global_responsi_options_a3_shortcode();
}
$tab_corner = '';
if($default_options['responsi_sc_tab_corner']['corner'] == 'rounded'){
	$tab_corner = ' checked="checked"';
}

$cornertopleft = '';
if($default_options['responsi_sc_tab_cornertopleft']['corner'] == 'rounded'){
	$cornertopleft = ' checked="checked"';
}
$cornertopright = '';
if($default_options['responsi_sc_tab_cornertopright']['corner'] == 'rounded'){
	$cornertopright = ' checked="checked"';
}
$cornerbottomleft = '';
if($default_options['responsi_sc_tab_cornerbottomleft']['corner'] == 'rounded'){
	$cornerbottomleft = ' checked="checked"';
}
$cornerbottomright = '';
if($default_options['responsi_sc_tab_cornerbottomright']['corner'] == 'rounded'){
	$cornerbottomright = ' checked="checked"';
}

$ccornertopleft = '';
if($default_options['responsi_sc_tab_ccornertopleft']['corner'] == 'rounded'){
	$ccornertopleft = ' checked="checked"';
}
$ccornertopright = '';
if($default_options['responsi_sc_tab_ccornertopright']['corner'] == 'rounded'){
	$ccornertopright = ' checked="checked"';
}
$ccornerbottomleft = '';
if($default_options['responsi_sc_tab_ccornerbottomleft']['corner'] == 'rounded'){
	$ccornerbottomleft = ' checked="checked"';
}
$ccornerbottomright = '';
if($default_options['responsi_sc_tab_ccornerbottomright']['corner'] == 'rounded'){
	$ccornerbottomright = ' checked="checked"';
}
$ctmargin = '';
if($default_options['responsi_sc_tab_ctmargin_on'] == 'true'){
	$ctmargin = ' checked="checked"';
}
$margin = '';
if($default_options['responsi_sc_tab_margin_on'] == 'true'){
	$margin = ' checked="checked"';
}
$padding = '';
if($default_options['responsi_sc_tab_padding_on'] == 'true'){
	$padding = ' checked="checked"';
}
$cmargin = '';
if($default_options['responsi_sc_tab_cmargin_on'] == 'true'){
	$cmargin = ' checked="checked"';
}
$cpadding = '';
if($default_options['responsi_sc_tab_cpadding_on'] == 'true'){
	$cpadding = ' checked="checked"';
}
$bgtabs = '';
if($default_options['responsi_sc_tab_backgroundcolor']['onoff'] == 'true'){
	$bgtabs = ' checked="checked"';
}
$bgtabsactive = '';
if($default_options['responsi_sc_tab_backgroundcoloractive']['onoff'] == 'true'){
	$bgtabsactive = ' checked="checked"';
}
?>
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
		    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-ctmargin" class="">Tabs Margin<span class="optional"></span></label></th>
			<td class="responsi-marker-checkbox-iphone-control section">
				<div class="checkbox-wrapper"><input<?php echo $ctmargin;?> id="responsi-value-ctmargin" data-novalue="false" hidden_class="ctmargin" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-margin" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">Margin above and below inserted Tabs shortcode</span>
			</td>
		</tr>
		<tr class="ctmargin">
			<th valign="top" scope="row">
				<label for="responsi-value-ctmargin_top" class="">Margin Top<span class="optional"></span></label>
			</th>
			<td>
				<input type="text" id="responsi-value-ctmargin_top" name="responsi-value-ctmargin_top" value="<?php echo $default_options['responsi_sc_tab_ctmargin_top'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
			</td>
		</tr>
		<tr class="ctmargin">
			<th valign="top" scope="row">
				<label for="responsi-value-ctmargin_bottom" class="">Margin Bottom<span class="optional"></span></label>
			</th>
			<td>
				<input type="text" id="responsi-value-ctmargin_bottom" name="responsi-value-ctmargin_bottom" value="<?php echo $default_options['responsi_sc_tab_ctmargin_bottom'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
			</td>
		</tr>
		<tr>
			<th width="23%" valign="top" scope="row"><label for="responsi-value-layout" class="">Tabs Alignment<span class="optional"></span></label></th>
			<td class="responsi-marker-select-control">
				<select id="responsi-value-layout" name="responsi-value-layout" class="select input-select">
					<option value="horizontal">Horizontal</option>
					<option value="vertical">Vertical</option>
				</select>
				<span class="responsi-input-help"></span>
			</td>
		</tr>
		<tr class="tab_horizontal">
		    <th valign="top" scope="row" width="23%"><label for="responsi-value-justified" class="">Tabs Justified<span class="optional"></span></label></th>
			<td class="responsi-marker-checkbox-iphone-control section">
				<div class="checkbox-wrapper"><input id="responsi-value-justified" name="responsi-value-justified" data-novalue="no" hidden_class="" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">On to make tabs Full width of content area</span>
			</td>
		</tr>
		<tr class="tab_vertical" style="display:none;">
			<th valign="top" scope="row"><label for="responsi-value-tabwidth" class="">Tab Width<span class="optional"></span></label></th>
			<td class="responsi-marker-select-control">
				<select id="responsi-value-tabwidth" name="responsi-value-tabwidth" class="select input-select">
					<?php
					for($i = 15; $i <= 30; $i++) {
						echo '<option '.selected( $i, 15, false ).' value="'.$i.'">'.$i.'%</option>';
					}
					?>
				</select>
				<span class="responsi-input-help"></span>
			</td>
		</tr>
		<tr>
			<th width="23%" valign="top" scope="row"><label for="responsi-value-design" class="">Design<span class="optional"></span></label></th>
			<td class="responsi-marker-select-control">
				<select id="responsi-value-design" name="responsi-value-design" class="select input-select">
					<option value="classic">Default</option>
					<option value="custom">Custom</option>
				</select>
				<span class="responsi-input-help"></span>
			</td>
		</tr>

		<tr class="custom">
			<td colspan="2" style="padding-right:0;">
				<table class="responsi-options-table">
					<tr>
						<td colspan="2" style="padding-right:0;"><h3 class="toggle_custom">Tabs Style <span style="float:right"><i data-hidden="tabstyle" class="click_toggle_main shortcode-icon-plus"></i></span></h3></td>
					</tr>
					<tr class="tabstyle hidethis">
						<td colspan="2" style="padding-right:0;">
							<table class="responsi-options-table">
								<tr>
									<th valign="top" scope="row"><label for="responsi-value-tab_border" class="">Tabs Border<span class="optional"></span></label></th>
									<td class="responsi-marker-border-control responsi-control">
										<?php \A3Rev\RShortcode\HookFunction::general_border_type('tab_border', $default_options['responsi_sc_tab_border']['width'], $default_options['responsi_sc_tab_border']['style'], $default_options['responsi_sc_tab_border']['color']);?>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row"><label for="responsi-value-tab_corner" class="">Tabs Corners<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $tab_corner;?> id="responsi-value-tab_corner" name="responsi-value-tab_corner" data-novalue="square" hidden_class="tab_corner" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="rounded" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to Create Circular background</span>
									</td>
								</tr>
								<tr class="tab_corner">
									<th valign="top" scope="row"><label for="responsi-value-tab_cornervalue" class=""><span class="optional"></span></label></th>
									<td class="responsi-marker-select-control">
										<select id="responsi-value-tab_cornervalue" name="responsi-value-tab_cornervalue" class="select input-select">
											<?php
											for($i = 0; $i <= 100; $i++) {
												echo '<option '.selected( $i, $default_options['responsi_sc_tab_corner']['rounded_value'], false ).' value="'.$i.'px">'.$i.'px</option>';
											}
											?>
										</select>
										<span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr width="23%">
									<th valign="top" scope="row"><label for="responsi-value-font" class="">Font<span class="optional"></span></label></th>
									<td class="responsi-marker-font-control">
										<?php \A3Rev\RShortcode\HookFunction::general_font_type('font',$default_options['responsi_sc_tab_font']['face'] ,$default_options['responsi_sc_tab_font']['size'],$default_options['responsi_sc_tab_font']['line_height'],$default_options['responsi_sc_tab_font']['style'],$default_options['responsi_sc_tab_font']['color']);?>
									</td>
								</tr>
								<tr class="icon_bg_ctrl">
								    <th valign="top" scope="row"><label for="responsi-value-onbackgroundcolor" class="">Box Background Colour<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input id="responsi-value-onbackgroundcolor"<?php echo $bgtabs;?> data-novalue="false" hidden_class="icon_bg" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-onbackgroundcolor" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
									</td>
								</tr>

								<tr class="icon_bg">
									<th valign="top" scope="row">
										<label for="responsi-value-backgroundcolor" class=""><span class="optional"></span></label>
									</th>
									<td class="responsi-marker-colourpicker-control">
										<input type="text" value="<?php echo $default_options['responsi_sc_tab_backgroundcolor']['color'];?>" data-default-color="<?php echo $default_options['responsi_sc_tab_backgroundcolor']['color'];?>" id="responsi-value-backgroundcolor" name="responsi-value-backgroundcolor" class="icolor-picker" />
									</td>
								</tr>

								<tr>
									<th valign="top" scope="row"><label for="responsi-value-bordertop" class="">Border Top<span class="optional"></span></label></th>
									<td class="responsi-marker-border-control responsi-control">
										<?php \A3Rev\RShortcode\HookFunction::general_border_type('bordertop', $default_options['responsi_sc_tab_bordertop']['width'], $default_options['responsi_sc_tab_bordertop']['style'], $default_options['responsi_sc_tab_bordertop']['color']);?>
									</td>
								</tr>
								<tr>
									<th valign="top" scope="row"><label for="responsi-value-borderbottom" class="">Border Bottom<span class="optional"></span></label></th>
									<td class="responsi-marker-border-control responsi-control">
										<?php \A3Rev\RShortcode\HookFunction::general_border_type('borderbottom', $default_options['responsi_sc_tab_borderbottom']['width'], $default_options['responsi_sc_tab_borderbottom']['style'], $default_options['responsi_sc_tab_borderbottom']['color']);?>
									</td>
								</tr>
								<tr>
									<th valign="top" scope="row"><label for="responsi-value-borderleft" class="">Border Left<span class="optional"></span></label></th>
									<td class="responsi-marker-border-control responsi-control">
										<?php \A3Rev\RShortcode\HookFunction::general_border_type('borderleft', $default_options['responsi_sc_tab_borderleft']['width'], $default_options['responsi_sc_tab_borderleft']['style'], $default_options['responsi_sc_tab_borderleft']['color']);?>
									</td>
								</tr>
								<tr>
									<th valign="top" scope="row"><label for="responsi-value-borderright" class="">Border Right<span class="optional"></span></label></th>
									<td class="responsi-marker-border-control responsi-control">
										<?php \A3Rev\RShortcode\HookFunction::general_border_type('borderright', $default_options['responsi_sc_tab_borderright']['width'], $default_options['responsi_sc_tab_borderright']['style'], $default_options['responsi_sc_tab_borderright']['color']);?>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row"><label for="responsi-value-cornertl" class="">Corners Top/Left<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $cornertopleft;?> id="responsi-value-cornertl" name="responsi-value-cornertl" data-novalue="square" hidden_class="cornertl" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="rounded" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to Create Circular background</span>
									</td>
								</tr>
								<tr class="cornertl">
									<th valign="top" scope="row"><label for="responsi-value-cornertopleft" class=""><span class="optional"></span></label></th>
									<td class="responsi-marker-select-control">
										<select id="responsi-value-cornertopleft" name="responsi-value-cornertopleft" class="select input-select">
											<?php
											for($i = 0; $i <= 100; $i++) {
												echo '<option '.selected( $i, $default_options['responsi_sc_tab_cornertopleft']['rounded_value'], false ).' value="'.$i.'px">'.$i.'px</option>';
											}
											?>
										</select>
										<span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row"><label for="responsi-value-cornertr" class="">Corners Top/Right<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $cornertopright;?> id="responsi-value-cornertr" name="responsi-value-cornertr" data-novalue="square" hidden_class="cornertr" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="rounded" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to Create Circular background</span>
									</td>
								</tr>
								<tr class="cornertr">
									<th valign="top" scope="row"><label for="responsi-value-cornertopright" class=""><span class="optional"></span></label></th>
									<td class="responsi-marker-select-control">
										<select id="responsi-value-cornertopright" name="responsi-value-cornertopright" class="select input-select">
											<?php
											for($i = 0; $i <= 100; $i++) {
												echo '<option '.selected( $i, $default_options['responsi_sc_tab_cornertopright']['rounded_value'], false ).' value="'.$i.'px">'.$i.'px</option>';
											}
											?>
										</select>
										<span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row"><label for="responsi-value-cornerbl" class="">Corners Bottom/Left<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $cornerbottomleft;?> id="responsi-value-cornerbl" name="responsi-value-cornerbl" data-novalue="square" hidden_class="cornerbl" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="rounded" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to Create Circular background</span>
									</td>
								</tr>
								<tr class="cornerbl">
									<th valign="top" scope="row"><label for="responsi-value-cornerbottomleft" class=""><span class="optional"></span></label></th>
									<td class="responsi-marker-select-control">
										<select id="responsi-value-cornerbottomleft" name="responsi-value-cornerbottomleft" class="select input-select">
											<?php
											for($i = 0; $i <= 100; $i++) {
												echo '<option '.selected( $i, $default_options['responsi_sc_tab_cornerbottomleft']['rounded_value'], false ).' value="'.$i.'px">'.$i.'px</option>';
											}
											?>
										</select>
										<span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row"><label for="responsi-value-cornerbr" class="">Corners Bottom/Right<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $cornerbottomright;?> id="responsi-value-cornerbr" name="responsi-value-cornerbr" data-novalue="square" hidden_class="cornerbr" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="rounded" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to Create Circular background</span>
									</td>
								</tr>
								<tr class="cornerbr">
									<th valign="top" scope="row"><label for="responsi-value-cornerbottomright" class=""><span class="optional"></span></label></th>
									<td class="responsi-marker-select-control">
										<select id="responsi-value-cornerbottomright" name="responsi-value-cornerbottomright" class="select input-select">
											<?php
											for($i = 0; $i <= 100; $i++) {
												echo '<option '.selected( $i, $default_options['responsi_sc_tab_cornerbottomright']['rounded_value'], false ).' value="'.$i.'px">'.$i.'px</option>';
											}
											?>
										</select>
										<span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-margin" class="">Margin<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $margin;?> id="responsi-value-margin" data-novalue="false" hidden_class="margin" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-margin" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="margin">
									<th valign="top" scope="row">
										<label for="responsi-value-margin_top" class="">Margin Top<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-margin_top" name="responsi-value-margin_top" value="<?php echo $default_options['responsi_sc_tab_margin_top'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="margin">
									<th valign="top" scope="row">
										<label for="responsi-value-margin_bottom" class="">Margin Bottom<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-margin_bottom" name="responsi-value-margin_bottom" value="<?php echo $default_options['responsi_sc_tab_margin_bottom'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="margin">
									<th valign="top" scope="row">
										<label for="responsi-value-margin_left" class="">Margin Left<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-margin_left" name="responsi-value-margin_left" value="<?php echo $default_options['responsi_sc_tab_margin_left'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="margin">
									<th valign="top" scope="row">
										<label for="responsi-value-margin_right" class="">Margin Right<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-margin_right" name="responsi-value-margin_right" value="<?php echo $default_options['responsi_sc_tab_margin_right'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-padding" class="">Padding<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $padding;?> id="responsi-value-padding" checked="checked" data-novalue="false" hidden_class="padding" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-padding" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="padding">
									<th valign="top" scope="row">
										<label for="responsi-value-padding_top" class="">Padding Top<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-padding_top" name="responsi-value-padding_top" value="<?php echo $default_options['responsi_sc_tab_padding_top'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="padding">
									<th valign="top" scope="row">
										<label for="responsi-value-padding_bottom" class="">Padding Bottom<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-padding_bottom" name="responsi-value-padding_bottom" value="<?php echo $default_options['responsi_sc_tab_padding_bottom'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="padding">
									<th valign="top" scope="row">
										<label for="responsi-value-padding_left" class="">Padding Left<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-padding_left" name="responsi-value-padding_left" value="<?php echo $default_options['responsi_sc_tab_padding_left'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="padding">
									<th valign="top" scope="row">
										<label for="responsi-value-padding_right" class="">Padding Right<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-padding_right" name="responsi-value-padding_right" value="<?php echo $default_options['responsi_sc_tab_padding_right'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="padding-right:0;"><h3 class="toggle_custom">Tabs Inactive Style <span style="float:right"><i data-hidden="tabinactive" class="click_toggle_main shortcode-icon-plus"></i></span></h3></td>
					</tr>
					<tr class="tabinactive hidethis">
						<td colspan="2" style="padding-right:0;">
							<table class="responsi-options-table">
								<tr class="icon_bg_ctrl">
								    <th valign="top" scope="row"><label for="responsi-value-onbackgroundcoloractive" class="">Box Background Colour<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input id="responsi-value-onbackgroundcoloractive"<?php echo $bgtabsactive;?> data-novalue="false" hidden_class="icon_bg" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-onbackgroundcoloractive" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
									</td>
								</tr>

								<tr class="icon_bg">
									<th valign="top" scope="row">
										<label for="responsi-value-backgroundcoloractive" class=""><span class="optional"></span></label>
									</th>
									<td class="responsi-marker-colourpicker-control">
										<input type="text" value="<?php echo $default_options['responsi_sc_tab_backgroundcoloractive']['color'];?>" data-default-color="<?php echo $default_options['responsi_sc_tab_backgroundcoloractive']['color'];?>" id="responsi-value-backgroundcoloractive" name="responsi-value-backgroundcoloractive" class="icolor-picker" />
									</td>
								</tr>
								<tr>
									<th width="23%" valign="top" scope="row">
										<label for="responsi-value-bordertopcolor" class="">Border Top Colour<span class="optional"></span></label>
									</th>
									<td class="responsi-marker-colourpicker-control">
										<input type="text" value="<?php echo $default_options['responsi_sc_tab_bordertopactive'];?>" data-default-color="<?php echo $default_options['responsi_sc_tab_bordertopactive'];?>" id="responsi-value-bordertopactive" name="responsi-value-bordertopactive" class="icolor-picker" />
									</td>
								</tr>
								<tr>
									<th width="23%" valign="top" scope="row">
										<label for="responsi-value-borderbottomcolor" class="">Border Bottom Colour<span class="optional"></span></label>
									</th>
									<td class="responsi-marker-colourpicker-control">
										<input type="text" value="<?php echo $default_options['responsi_sc_tab_borderbottomactive'];?>" data-default-color="<?php echo $default_options['responsi_sc_tab_borderbottomactive'];?>" id="responsi-value-borderbottomactive" name="responsi-value-borderbottomactive" class="icolor-picker" />
									</td>
								</tr>
								<tr>
									<th width="23%" valign="top" scope="row">
										<label for="responsi-value-borderleftcolor" class="">Border Left Colour<span class="optional"></span></label>
									</th>
									<td class="responsi-marker-colourpicker-control">
										<input type="text" value="<?php echo $default_options['responsi_sc_tab_borderleftactive'];?>" data-default-color="<?php echo $default_options['responsi_sc_tab_borderleftactive'];?>" id="responsi-value-borderleftactive" name="responsi-value-borderleftactive" class="icolor-picker" />
									</td>
								</tr>
								<tr>
									<th width="23%" valign="top" scope="row">
										<label for="responsi-value-borderrightcolor" class="">Border Right Colour<span class="optional"></span></label>
									</th>
									<td class="responsi-marker-colourpicker-control">
										<input type="text" value="<?php echo $default_options['responsi_sc_tab_borderrightactive'];?>" data-default-color="<?php echo $default_options['responsi_sc_tab_borderrightactive'];?>" id="responsi-value-borderrightactive" name="responsi-value-borderrightactive" class="icolor-picker" />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="padding-right:0;"><h3 class="toggle_custom">Tabs Content <span style="float:right"><i data-hidden="tabcontent" class="click_toggle_main shortcode-icon-plus"></i></span></h3></td>
					</tr>
					<tr class="tabcontent hidethis">
						<td colspan="2" style="padding-right:0;">
							<table class="responsi-options-table">
								<tr width="23%">
									<th valign="top" scope="row"><label for="responsi-value-fontcontent" class="">Font<span class="optional"></span></label></th>
									<td class="responsi-marker-font-control">
										<?php \A3Rev\RShortcode\HookFunction::general_font_type('fontcontent',$default_options['responsi_sc_tab_fontcontent']['face'] ,$default_options['responsi_sc_tab_fontcontent']['size'],$default_options['responsi_sc_tab_fontcontent']['line_height'],$default_options['responsi_sc_tab_fontcontent']['style'],$default_options['responsi_sc_tab_fontcontent']['color']);?>
									</td>
								</tr>
								<tr>
									<th valign="top" scope="row"><label for="responsi-value-cbordertop" class="">Border Top<span class="optional"></span></label></th>
									<td class="responsi-marker-border-control responsi-control">
										<?php \A3Rev\RShortcode\HookFunction::general_border_type('cbordertop', $default_options['responsi_sc_tab_cbordertop']['width'], $default_options['responsi_sc_tab_cbordertop']['style'], $default_options['responsi_sc_tab_cbordertop']['color']);?>
									</td>
								</tr>
								<tr>
									<th valign="top" scope="row"><label for="responsi-value-cborderbottom" class="">Border Bottom<span class="optional"></span></label></th>
									<td class="responsi-marker-border-control responsi-control">
										<?php \A3Rev\RShortcode\HookFunction::general_border_type('cborderbottom', $default_options['responsi_sc_tab_cborderbottom']['width'], $default_options['responsi_sc_tab_cborderbottom']['style'], $default_options['responsi_sc_tab_cborderbottom']['color']);?>
									</td>
								</tr>
								<tr>
									<th valign="top" scope="row"><label for="responsi-value-cborderleft" class="">Border Left<span class="optional"></span></label></th>
									<td class="responsi-marker-border-control responsi-control">
										<?php \A3Rev\RShortcode\HookFunction::general_border_type('cborderleft', $default_options['responsi_sc_tab_cborderleft']['width'], $default_options['responsi_sc_tab_cborderleft']['style'], $default_options['responsi_sc_tab_cborderleft']['color']);?>
									</td>
								</tr>
								<tr>
									<th valign="top" scope="row"><label for="responsi-value-cborderright" class="">Border Right<span class="optional"></span></label></th>
									<td class="responsi-marker-border-control responsi-control">
										<?php \A3Rev\RShortcode\HookFunction::general_border_type('cborderright', $default_options['responsi_sc_tab_cborderright']['width'], $default_options['responsi_sc_tab_cborderright']['style'], $default_options['responsi_sc_tab_cborderright']['color']);?>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row"><label for="responsi-value-ccornertl" class="">Corners Top/Left<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $ccornertopleft;?> id="responsi-value-ccornertl" name="responsi-value-ccornertl" data-novalue="square" hidden_class="ccornertl" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="rounded" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to Create Circular background</span>
									</td>
								</tr>
								<tr class="ccornertl">
									<th valign="top" scope="row"><label for="responsi-value-cornertopleft" class=""><span class="optional"></span></label></th>
									<td class="responsi-marker-select-control">
										<select id="responsi-value-ccornertopleft" name="responsi-value-ccornertopleft" class="select input-select">
											<?php
											for($i = 0; $i <= 100; $i++) {
												echo '<option '.selected( $i, $default_options['responsi_sc_tab_ccornertopleft']['rounded_value'], false ).' value="'.$i.'px">'.$i.'px</option>';
											}
											?>
										</select>
										<span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row"><label for="responsi-value-ccornertr" class="">Corners Top/Right<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $ccornertopright;?> id="responsi-value-ccornertr" name="responsi-value-ccornertr" data-novalue="square" hidden_class="ccornertr" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="rounded" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to Create Circular background</span>
									</td>
								</tr>
								<tr class="ccornertr">
									<th valign="top" scope="row"><label for="responsi-value-ccornertopright" class=""><span class="optional"></span></label></th>
									<td class="responsi-marker-select-control">
										<select id="responsi-value-ccornertopright" name="responsi-value-ccornertopright" class="select input-select">
											<?php
											for($i = 0; $i <= 100; $i++) {
												echo '<option '.selected( $i, $default_options['responsi_sc_tab_ccornertopright']['rounded_value'], false ).' value="'.$i.'px">'.$i.'px</option>';
											}
											?>
										</select>
										<span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row"><label for="responsi-value-ccornerbl" class="">Corners Bottom/Left<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $ccornerbottomleft;?> id="responsi-value-ccornerbl" name="responsi-value-ccornerbl" data-novalue="square" hidden_class="ccornerbl" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="rounded" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to Create Circular background</span>
									</td>
								</tr>
								<tr class="ccornerbl">
									<th valign="top" scope="row"><label for="responsi-value-ccornerbottomleft" class=""><span class="optional"></span></label></th>
									<td class="responsi-marker-select-control">
										<select id="responsi-value-ccornerbottomleft" name="responsi-value-ccornerbottomleft" class="select input-select">
											<?php
											for($i = 0; $i <= 100; $i++) {
												echo '<option '.selected( $i, $default_options['responsi_sc_tab_ccornerbottomleft']['rounded_value'], false ).' value="'.$i.'px">'.$i.'px</option>';
											}
											?>
										</select>
										<span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row"><label for="responsi-value-ccornerbr" class="">Corners Bottom/Right<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $ccornerbottomright;?> id="responsi-value-ccornerbr" name="responsi-value-ccornerbr" data-novalue="square" hidden_class="ccornerbr" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="rounded" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help">ON to Create Circular background</span>
									</td>
								</tr>
								<tr class="ccornerbr">
									<th valign="top" scope="row"><label for="responsi-value-ccornerbottomright" class=""><span class="optional"></span></label></th>
									<td class="responsi-marker-select-control">
										<select id="responsi-value-ccornerbottomright" name="responsi-value-ccornerbottomright" class="select input-select">
											<?php
											for($i = 0; $i <= 100; $i++) {
												echo '<option '.selected( $i, $default_options['responsi_sc_tab_ccornerbottomright']['rounded_value'], false ).' value="'.$i.'px">'.$i.'px</option>';
											}
											?>
										</select>
										<span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-cmargin" class="">Margin<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $cmargin;?> id="responsi-value-cmargin" data-novalue="false" hidden_class="cmargin" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-cmargin" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="cmargin">
									<th valign="top" scope="row">
										<label for="responsi-value-margin_top" class="">Margin Top<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-cmargin_top" name="responsi-value-cmargin_top" value="<?php echo $default_options['responsi_sc_tab_cmargin_top'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="cmargin">
									<th valign="top" scope="row">
										<label for="responsi-value-cmargin_bottom" class="">Margin Bottom<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-cmargin_bottom" name="responsi-value-cmargin_bottom" value="<?php echo $default_options['responsi_sc_tab_cmargin_bottom'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="cmargin">
									<th valign="top" scope="row">
										<label for="responsi-value-cmargin_left" class="">Margin Left<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-cmargin_left" name="responsi-value-cmargin_left" value="<?php echo $default_options['responsi_sc_tab_cmargin_left'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="cmargin">
									<th valign="top" scope="row">
										<label for="responsi-value-cmargin_right" class="">Margin Right<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-cmargin_right" name="responsi-value-cmargin_right" value="<?php echo $default_options['responsi_sc_tab_cmargin_right'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr>
								    <th valign="top" scope="row" scope="row" width="23%"><label for="responsi-value-cpadding" class="">Padding<span class="optional"></span></label></th>
									<td class="responsi-marker-checkbox-iphone-control section">
										<div class="checkbox-wrapper"><input<?php echo $cpadding;?>  id="responsi-value-cpadding" checked="checked" data-novalue="false" hidden_class="cpadding" class="responsi-input responsi-checkbox-iphone" type="checkbox" name="responsi-value-cpadding" value="true" checked_label="ON" unchecked_label="OFF" container_width="80" /></div><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="cpadding">
									<th valign="top" scope="row">
										<label for="responsi-value-cpadding_top" class="">Padding Top<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-cpadding_top" name="responsi-value-cpadding_top" value="<?php echo $default_options['responsi_sc_tab_cpadding_top'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="cpadding">
									<th valign="top" scope="row">
										<label for="responsi-value-cpadding_bottom" class="">Padding Bottom<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-cpadding_bottom" name="responsi-value-cpadding_bottom" value="<?php echo $default_options['responsi_sc_tab_cpadding_bottom'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="cpadding">
									<th valign="top" scope="row">
										<label for="responsi-value-cpadding_left" class="">Padding Left<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-cpadding_left" name="responsi-value-cpadding_left" value="<?php echo $default_options['responsi_sc_tab_cpadding_left'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
								<tr class="cpadding">
									<th valign="top" scope="row">
										<label for="responsi-value-cpadding_right" class="">Padding Right<span class="optional"></span></label>
									</th>
									<td>
										<input type="text" id="responsi-value-cpadding_right" name="responsi-value-cpadding_right" value="<?php echo $default_options['responsi_sc_tab_cpadding_right'];?>px" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="padding-right:0;"><h3>Wrap HTML Elements</h3></td>
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
		<h2 class="toggle item-title">Tab<span class="_no">[1]</span> <i class="click_remove shortcode-icon-times"></i><i class="click_toggle shortcode-icon-minus"></i></h2>
		<table class="responsi-options-table">
			<tr>
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-title" class="">Tab Title<span class="optional"></span></label>
				</th>
				<td>
					<input type="text" id="responsi-value-title" name="responsi-value-title" value="Tab Title" class="txt input-text regular-text code" /><span class="responsi-input-help"></span>
				</td>
			</tr>
			<tr>
			    <th valign="top" scope="row" width="23%"><label for="responsi-value-tabicon" class="">Icon<span class="optional"></span></label></th>
				<td class="responsi-marker-checkbox-iphone-control section">
					<div class="checkbox-wrapper"><input id="responsi-value-tabicon" name="responsi-value-tabicon" data-novalue="no" hidden_class="tab_icon" class="responsi-input responsi-checkbox-iphone" type="checkbox" value="yes" checked_label="ON" unchecked_label="OFF" container_width="80" /></div>
				</td>
			</tr>
			<tr class="tab_icon">
				<th valign="top" scope="row" width="23%"><label for="responsi-value-icon" class="">Select Icon<span class="optional"></span></label></th>
				<td colspan="2" class="responsi-marker-icon-control" style="padding-right:0;">
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
			<tr class="tab_icon">
				<th width="23%" valign="top" scope="row">
					<label for="responsi-value-icon_color" class="">Icon Colour<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-colourpicker-control">
					<input type="text" value="<?php echo $default_options['responsi_sc_tab_icon_color'];?>" data-default-color="<?php echo $default_options['responsi_sc_tab_icon_color'];?>" id="responsi-value-icon_color" name="responsi-value-icon_color" class="icolor-picker" />
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="responsi-value-content" class="">Tab Content<span class="optional"></span></label>
				</th>
				<td class="responsi-marker-textarea-control">
					<textarea id="responsi-value-content" placeholder="Your Content Goes Here" name="responsi-value-content" class="txt input-textarea input-text regular-text code">Your Content Goes Here</textarea>
				</td>
			</tr>
		</table>

	  </div>
	</div>
	<div class="add_new_toggle add_new_item_button"><a id="form-child-add" href="#">Add Tab</a></div>
	<script type="text/javascript">

	var html_item = jQuery('.sort_table').find('.sort_table_item').html();

	jQuery('.add_new_item_button a').click(function (e) {
    	jQuery('.sort_table').append('<div class="sort_table_item">'+html_item+'</div>');
    	var _items = jQuery('.sort_table').find('h2.toggle');
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
	tr.custom table,.custom table th,.custom table td{margin:0 !important;padding:0 !important;}
	#responsi-options h3.toggle_custom{margin: 0 !important;}
	#responsi-options h3.toggle_custom i{font-size: 18px;}
	</style>

</div>
<div class="clear"></div>
<?php
do_action('responsi_after_popup_shortcode');
?>
</div>
</body>
</html>