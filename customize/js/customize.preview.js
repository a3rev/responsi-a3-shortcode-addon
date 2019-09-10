/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function($) {
	var border_fields = [
		'responsi_blockquote_boxed_border_top',
		'responsi_blockquote_boxed_border_bottom',
		'responsi_blockquote_boxed_border_lr',
	];

	var border_radius_fields = [
		'responsi_blockquote_boxed_border_radius',
	];

	var shadow_fields = [
		'responsi_blockquote_boxed_box_shadow',
	];

	var margin_padding_fields = [];

	var single_fields = [
		'responsi_blockquote_boxed',
		'responsi_blockquote_icon_color',
		'responsi_style_border',
		'responsi_blockquote_icon',
	];

	var bg_fields = [
		'responsi_blockquote_boxed_bg',
	];

	function _a3_shortcode_preview() {

		var css = '';

		var border_general = 'transparent';
		if (wp.customize.value('responsi_style_border')() != '') {
			border_general = wp.customize.value('responsi_style_border')();
		}

		if (border_general != 'transparent') {
			css += 'hr,.entry .wp-caption,.responsi-sc-hr{ border-bottom:1px solid ' + border_general + ' !important;box-sizing: border-box;max-width:100% !important;}';
		} else {
			css += 'hr,.entry .wp-caption,.responsi-sc-hr{ border-bottom:0px solid ' + border_general + ' !important;box-sizing: border-box;max-width:100% !important;}';
		}

		var _blockquote_icon = wp.customize.value('responsi_blockquote_icon')();
		var _blockquote_icon_color = 'transparent';
		if (wp.customize.value('responsi_blockquote_icon_color')() != '') {
			_blockquote_icon_color = wp.customize.value('responsi_blockquote_icon_color')();
		}
		var _blockquote_boxed = wp.customize.value('responsi_blockquote_boxed')();

		if (_blockquote_icon == 'true') {
			css += '.entry blockquote:before, #main * blockquote:before, .term-description:before, .entry blockquote:before, #main blockquote:before,.responsi-sc-quote:before{color:' + _blockquote_icon_color + ' !important;}';
		} else {
			css += '.entry blockquote:before, #main * blockquote:before, .term-description:before, .entry blockquote:before, #main blockquote:before,.responsi-sc-quote:before{color:#CCCCCC !important;}';
		}

		var _blockquote_boxed_css = '';
		if (_blockquote_boxed == 'true') {
			_blockquote_boxed_css += _cFn.renderBG('responsi_blockquote_boxed_bg', true);
			_blockquote_boxed_css += _cFn.renderBorder('responsi_blockquote_boxed_border_top', 'top');
			_blockquote_boxed_css += _cFn.renderBorder('responsi_blockquote_boxed_border_bottom', 'bottom');
			_blockquote_boxed_css += _cFn.renderBorder('responsi_blockquote_boxed_border_lr', 'left');
			_blockquote_boxed_css += _cFn.renderBorder('responsi_blockquote_boxed_border_lr', 'right');
			_blockquote_boxed_css += _cFn.renderRadius('responsi_blockquote_boxed_border_radius');
			_blockquote_boxed_css += _cFn.renderShadow('responsi_blockquote_boxed_box_shadow', true);
		} else {
			_blockquote_boxed_css += 'background-color:transparent !important;';
			_blockquote_boxed_css += 'border:none !important;';
			_blockquote_boxed_css += 'border-radius:0 !important;-webkit-border-radius:0 !important;';
			_blockquote_boxed_css += 'box-shadow:none !important;-webkit-box-shadow:none !important;';
		}
		css += '.responsi-sc-quote.boxed,.entry blockquote.boxed, #main blockquote.boxed, .type-post blockquote, .type-page blockquote, .entry blockquote,.page-description blockquote{' + _blockquote_boxed_css + '}';

		//Apply CSS
		if ($('#custom_a3_shortcode_style').length > 0) {
			$('#custom_a3_shortcode_style').html(css);
		} else {
			$('head').append('<style id="custom_a3_shortcode_style">' + css + '</style>');
		}
	}

	$.each(border_fields, function(inx, val) {
		$.each(ctrlBorder, function(i, v) {
			wp.customize(val + '[' + v + ']', function(value) {
				value.bind(function(to) {
					_a3_shortcode_preview();
				});
			});
		});
	});

	$.each(border_radius_fields, function(inx, val) {
		$.each(ctrlRadius, function(i, v) {
			wp.customize(val + '[' + v + ']', function(value) {
				value.bind(function(to) {
					_a3_shortcode_preview();
				});
			});
		});
	});

	$.each(shadow_fields, function(inx, val) {
		$.each(ctrlShadow, function(i, v) {
			wp.customize(val + '[' + v + ']', function(value) {
				value.bind(function(to) {
					_a3_shortcode_preview();
				});
			});
		});
	});

	$.each(bg_fields, function(inx, val) {
		$.each(ctrlBG, function(i, v) {
			wp.customize(val + '[' + v + ']', function(value) {
				value.bind(function(to) {
					_a3_shortcode_preview();
				});
			});
		});
	});

	$.each(margin_padding_fields, function(inx, val) {
		$.each(ctrlMarPad, function(i, v) {
			wp.customize(val + v, function(value) {
				value.bind(function(to) {
					_a3_shortcode_preview();
				});
			});
		});
	});

	$.each(single_fields, function(inx, val) {
		wp.customize(val, function(value) {
			value.bind(function(to) {
				_a3_shortcode_preview();
			});
		});
	});

})(jQuery);