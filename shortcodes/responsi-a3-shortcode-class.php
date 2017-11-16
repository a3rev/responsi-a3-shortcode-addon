<?php
class Responsi_A3_Shortcode_Class {

	private static $gfonts = array();
	private static $load = false;

	public function __construct () {
		global $ICONS, $ICONS_SOCIAL;
		$ICONS = array("adjust","adn","align-center","align-justify","align-left","align-right","ambulance","anchor","android","angellist","angle-double-down","angle-double-left","angle-double-right","angle-double-up","angle-down","angle-left","angle-right","angle-up","apple","archive","area-chart","arrow-circle-down","arrow-circle-left","arrow-circle-o-down","arrow-circle-o-left","arrow-circle-o-right","arrow-circle-o-up","arrow-circle-right","arrow-circle-up","arrow-down","arrow-left","arrow-right","arrow-up","arrows-alt","arrows-h","arrows-v","arrows","asterisk","at","automobile","backward","bank","ban","bar-chart-o","bar-chart","barcode","bars","bed","beer","behance-square","behance","bell-o","bell-slash-o","bell-slash","bell","bicycle","binoculars","birthday-cake","bitbucket-square","bitbucket","bitcoin","bold","bolt","bomb","bookmark-o","bookmark","book","briefcase","btc","bug","building-o","building","bullhorn","bullseye","bus","buysellads","cab","calculator","calendar-o","calendar","camera-retro","camera","caret-down","caret-left","caret-right","caret-square-o-down","caret-square-o-left","caret-square-o-right","caret-square-o-up","caret-up","cart-arrow-down","cart-plus","car","cc-amex","cc-discover","cc-mastercard","cc-paypal","cc-stripe","cc-visa","cc","certificate","chain-broken","chain","check-circle-o","check-circle","check-square-o","check-square","check","chevron-circle-down","chevron-circle-left","chevron-circle-right","chevron-circle-up","chevron-down","chevron-left","chevron-right","chevron-up","child","circle-o-notch","circle-o","circle-thin","circle","clipboard","clock-o","close","cloud-download","cloud-upload","cloud","cny","code-fork","codepen","code","coffee","cogs","cog","columns","comment-o","comments-o","comments","comment","compass","compress","connectdevelop","copyright","copy","credit-card","crop","crosshairs","css3","cubes","cube","cutlery","cut","dashboard","dashcube","database","dedent","delicious","desktop","deviantart","diamond","digg","dollar","dot-circle-o","download","dribbble","dropbox","drupal","edit","eject","ellipsis-h","ellipsis-v","empire","envelope-o","envelope-square","envelope","eraser","euro","eur","exchange","exclamation-circle","exclamation-triangle","exclamation","expand","external-link-square","external-link","eye-slash","eyedropper","eye","facebook-f","facebook-official","facebook-square","facebook","fast-backward","fast-forward","fax","female","fighter-jet","file-archive-o","file-audio-o","file-code-o","file-excel-o","file-image-o","file-movie-o","file-o","file-pdf-o","file-photo-o","file-picture-o","file-powerpoint-o","file-sound-o","file-text-o","file-text","file-video-o","file-word-o","file-zip-o","files-o","file","film","filter","fire-extinguisher","fire","flag-checkered","flag-o","flag","flash","flask","flickr","floppy-o","folder-open-o","folder-open","folder-o","folder","font","forumbee","forward","foursquare","frown-o","futbol-o","gamepad","gavel","gbp","gears","gear","genderless","ge","gift","git-square","github-alt","github-square","github","gittip","git","glass","globe","google-plus-square","google-plus","google-wallet","google","graduation-cap","gratipay","group","h-square","hacker-news","hand-o-down","hand-o-left","hand-o-right","hand-o-up","hdd-o","header","headphones","heart-o","heartbeat","heart","history","home","hospital-o","hotel","html5","ils","image","inbox","indent","info-circle","info","inr","instagram","institution","ioxhost","italic","joomla","jpy","jsfiddle","keyboard-o","key","krw","language","laptop","lastfm-square","lastfm","leaf","leanpub","legal","lemon-o","level-down","level-up","life-bouy","life-buoy","life-ring","life-saver","lightbulb-o","line-chart","linkedin-square","linkedin","link","linux","list-alt","list-ol","list-ul","list","location-arrow","lock","long-arrow-down","long-arrow-left","long-arrow-right","long-arrow-up","magic","magnet","mail-forward","mail-reply-all","mail-reply","male","map-marker","mars-double","mars-stroke-h","mars-stroke-v","mars-stroke","mars","maxcdn","meanpath","medium","medkit","meh-o","mercury","microphone-slash","microphone","minus-circle","minus-square-o","minus-square","minus","mobile-phone","mobile","money","moon-o","mortar-board","motorcycle","music","navicon","neuter","newspaper-o","openid","outdent","pagelines","paint-brush","paper-plane-o","paper-plane","paperclip","paragraph","paste","pause","paw","paypal","pencil-square-o","pencil-square","pencil","phone-square","phone","photo","picture-o","pie-chart","pied-piper-alt","pied-piper","pinterest-p","pinterest-square","pinterest","plane","play-circle-o","play-circle","play","plug","plus-circle","plus-square-o","plus-square","plus","power-off","print","puzzle-piece","qq","qrcode","question-circle","question","quote-left","quote-right","random","ra","rebel","recycle","reddit-square","reddit","refresh","remove","renren","reorder","repeat","reply-all","reply","retweet","rmb","road","rocket","rotate-left","rotate-right","rouble","rss-square","rss","ruble","rub","rupee","save","scissors","search-minus","search-plus","search","sellsy","send-o","send","server","share-alt-square","share-alt","share-square-o","share-square","share","shekel","sheqel","shield","ship","shirtsinbulk","shopping-cart","sign-in","sign-out","signal","simplybuilt","sitemap","skyatlas","skype","slack","sliders","slideshare","smile-o","soccer-ball-o","sort-alpha-asc","sort-alpha-desc","sort-amount-asc","sort-amount-desc","sort-asc","sort-desc","sort-down","sort-numeric-asc","sort-numeric-desc","sort-up","sort","soundcloud","space-shuttle","spinner","spoon","spotify","square-o","square","stack-exchange","stack-overflow","star-half-empty","star-half-full","star-half-o","star-half","star-o","star","steam-square","steam","step-backward","step-forward","stethoscope","stop","street-view","strikethrough","stumbleupon-circle","stumbleupon","subscript","subway","suitcase","sun-o","superscript","support","tablet","table","tachometer","tags","tag","tasks","taxi","tencent-weibo","terminal","text-height","text-width","th-large","th-list","thumb-tack","thumbs-down","thumbs-o-down","thumbs-o-up","thumbs-up","th","ticket","times-circle-o","times-circle","times","tint","toggle-down","toggle-left","toggle-off","toggle-on","toggle-right","toggle-up","train","transgender-alt","transgender","trash-o","trash","tree","trello","trophy","truck","try","tty","tumblr-square","tumblr","turkish-lira","twitch","twitter-square","twitter","umbrella","underline","undo","university","unlink","unlock-alt","unlock","unsorted","upload","usd","user-md","user-plus","user-secret","user-times","users","user","venus-double","venus-mars","venus","viacoin","video-camera","vimeo-square","vine","vk","volume-down","volume-off","volume-up","warning","wechat","weibo","weixin","whatsapp","wheelchair","wifi","windows","won","wordpress","wrench","xing-square","xing","yahoo","yelp","yen","youtube-play","youtube");
		sort($ICONS);
		$ICONS_SOCIAL = array("adn","android","angellist","apple","behance","behance-square","bitbucket","bitbucket-square","bitcoin","btc","buysellads","cc-amex","cc-discover","cc-mastercard","cc-paypal","cc-stripe","cc-visa","codepen","connectdevelop","css3","dashcube","delicious","deviantart","digg","dribbble","dropbox","drupal","empire","facebook","facebook-f","facebook-official","facebook-square","flickr","forumbee","foursquare","ge","git","git-square","github","github-alt","github-square","gittip","google","google-plus","google-plus-square","google-wallet","gratipay","hacker-news","html5","instagram","ioxhost","joomla","jsfiddle","lastfm","lastfm-square","leanpub","linkedin","linkedin-square","linux","maxcdn","meanpath","medium","openid","pagelines","paypal","pied-piper","pied-piper-alt","pinterest","pinterest-p","pinterest-square","qq","ra","rebel","reddit","reddit-square","renren","sellsy","share-alt","share-alt-square","shirtsinbulk","simplybuilt","skyatlas","skype","slack","slideshare","soundcloud","spotify","stack-exchange","stack-overflow","steam","steam-square","stumbleupon","stumbleupon-circle","tencent-weibo","trello","tumblr","tumblr-square","twitch","twitter","twitter-square","viacoin","vimeo-square","vine","vk","wechat","weibo","weixin","whatsapp","windows","wordpress","xing","xing-square","yahoo","yelp","youtube","youtube-play","youtube-square");
		sort($ICONS_SOCIAL);
		add_action( 'wp', array( $this, 'register_google_fonts' ) , 1);
		add_filter( 'widget_text', array( $this, 'widget_register_google_fonts'),1);
		add_action( 'wp_ajax_responsi_check_url_action', array( $this, 'ajax_action_check_url' ) );
		add_action( 'responsi_before_popup_shortcode', array( $this, 'add_responsi_before_popup_shortcode' ) );
		add_action( 'responsi_after_popup_shortcode', array( $this, 'add_responsi_after_popup_shortcode' ) );
		add_action( 'admin_head', array( $this, 'shortcode_extender_script' ) );
		add_action( 'wp_enqueue_editor', array( $this, 'responsi_shortcode_dialog_script' ) );
		
		add_action( 'admin_head', array( $this, 'init' ) );
		add_action( 'customize_controls_print_scripts', array( $this, 'init' ) );
		if( !is_admin() ){
			add_action( 'wp_head', array( $this, '_front_register_css_and_js' ) );
			add_filter( 'the_content', array($this,'cleanup_shortcode_fix'));
			add_action( 'wp_footer', array( $this, '_google_webfonts' ) );
			add_action( '_front_enqueue_css_and_js', array( $this, '_action_enqueue_css_and_js' ) );
			add_action( 'wp_footer', array( $this, '_wp_footer_enqueue_css_and_js' ) );
		}

		add_action( 'wp_ajax_shortcode_open_dialog', array( $this, 'shortcode_open_dialog' ) );
	}

	public function init () {
		global $pagenow, $responsi_version;
		if ( in_array( $pagenow, array( 'customize.php' ) ) || ( in_array( $pagenow, array( 'admin.php') ) && isset( $_GET['page'] ) ) || ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && get_user_option( 'rich_editing' ) == 'true' && ( in_array( $pagenow, array('edit-tags.php','term.php', 'post.php', 'post-new.php', 'page-new.php', 'page.php' ) ) ) ) )  {
			$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
			$rtl = is_rtl() ? '.rtl' : '';
			$rtl = '';
		  	// Add the tinyMCE buttons and plugins.
			add_filter( 'mce_buttons', array( $this, 'filter_mce_buttons' ) );
			add_filter( 'mce_external_plugins', array( $this, 'filter_mce_external_plugins' ) );
			add_action( 'filter_mce_external_plugins_before', array( $this, 'filter_mce_external_plugins_before' ) );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'wp-color-picker' );
			// Register the custom CSS styles.
			wp_register_style( 'responsi-shortcode-fontawesome', esc_url( RESPONSI_A3_SC_SHORTCODES_URL . '/css/font-awesome'.$suffix.'.css' ) );
			wp_enqueue_style( 'responsi-shortcode-fontawesome' );
			wp_register_style( 'responsi-shortcode-fonticomoon', esc_url( RESPONSI_A3_SC_SHORTCODES_URL . '/css/font-icomoon'.$suffix.'.css' ) );
			wp_enqueue_style( 'responsi-shortcode-fonticomoon' );
			wp_register_style( 'responsi-shortcode-popup', esc_url( RESPONSI_A3_SC_SHORTCODES_URL . '/css/shortcode-popup'.$rtl.$suffix.'.css' ) );
			wp_enqueue_style( 'responsi-shortcode-popup' );
		}

	}

	public function shortcode_extender_script () {
		global $pagenow, $responsi_version;
		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		$rtl = is_rtl() ? '.rtl' : '';
		$rtl = '';
		
		if ( ! wp_script_is( 'jquery-ui-ioscheckbox', 'registered' ) ) {
			wp_register_script( 'jquery-ui-ioscheckbox', esc_url( get_template_directory_uri() . '/functions/js/iphone-style-checkboxes'.$rtl.$suffix.'.js' ), array( 'jquery' ), $responsi_version, false );
		}
		if ( ! wp_script_is( 'a3rev-style-checkboxes', 'enqueued' ) ) {
			wp_enqueue_script( 'jquery-ui-ioscheckbox' );
		}
	}

	public function responsi_shortcode_dialog_script () {
		global $pagenow, $responsi_version;
		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		$rtl = is_rtl() ? '.rtl' : '';
		$rtl = '';
		wp_register_script( 'responsi-shortcode-dialog', esc_url( RESPONSI_A3_SC_SHORTCODES_URL . '/js/dialog-js.php'), array( 'jquery' ), $responsi_version, false );
		wp_enqueue_script( 'responsi-shortcode-dialog' );

	}

	public static function _front_register_css_and_js () {
		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		$rtl = is_rtl() ? '.rtl' : '';
		$rtl = '';
		wp_register_style( 'responsi-shortcode-fontawesome', esc_url( RESPONSI_A3_SC_SHORTCODES_URL . '/css/font-awesome'.$suffix.'.css' ),array(), '', 'screen' );
		wp_register_style( 'responsi-shortcode-fonticomoon', esc_url( RESPONSI_A3_SC_SHORTCODES_URL . '/css/font-icomoon'.$suffix.'.css' ),array(), '', 'screen' );
		wp_register_style( 'responsi-shortcode-css', esc_url( RESPONSI_A3_SC_SHORTCODES_URL . '/css/shortcode'.$suffix.'.css' ),array(), '', 'screen');
		wp_register_script( 'responsi-shortcode-js', esc_url( RESPONSI_A3_SC_SHORTCODES_URL . '/js/shortcode'.$suffix.'.js' ), array( 'jquery' ), '1.0.0', true );
	}
	public static function _enqueue_css_and_js () {
		global $load;
		if( !is_admin() ){
			wp_enqueue_style( 'responsi-shortcode-fontawesome' );
			wp_enqueue_style( 'responsi-shortcode-fonticomoon' );
			wp_enqueue_style( 'responsi-shortcode-css' );
			wp_enqueue_script( 'responsi-shortcode-js' );
		}
	}

	public static function add_responsi_before_popup_shortcode() {
		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		$rtl = is_rtl() ? '.rtl' : '';
		$rtl = '';
	}

	public function shortcode_open_dialog() {
		ob_start();
		include_once( RESPONSI_A3_SC_PATH.'/shortcodes/js/'.$_POST['open_dialog']);
		$content = ob_get_contents();
		ob_clean();
		echo $content;
		die();
	}

	public static function add_responsi_after_popup_shortcode() {
		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		$rtl = is_rtl() ? '.rtl' : '';
		$rtl = '';
		echo "
		<script type=\"text/javascript\">
		jQuery(function($) { 'use strict';
			responsiDialogHelper.loadShortcodeDetails();
			responsiDialogHelper.onOffCheckbox();
			responsiDialogHelper.customLogicIconImage();
			responsiDialogHelper.customLogicMultiCheck();
		});
		</script>";
	}


	public static function _action_enqueue_css_and_js () {
		global $load;
		if( !is_admin() ){
			Responsi_A3_Shortcode_Class::_enqueue_css_and_js();
		}
	}

	public static function _wp_footer_enqueue_css_and_js() {
		global $load;
		if( !is_admin() ){
			if($load){
				Responsi_A3_Shortcode_Class::_enqueue_css_and_js();
			}
		}
	}

	public static function _google_webfonts() {
		global $google_fonts, $gfonts;

		$fonts = '';
		$output = '';
		if( is_array($gfonts))
		$responsi_options_webfonts = array_unique($gfonts);

		// Go through the options
		if ( !empty($responsi_options_webfonts) ) {
			foreach ( $responsi_options_webfonts as $option ) {
				// Check if the google font name exists in the current "face" option
				if ( is_array( $google_fonts ) && array_key_exists( $option, $google_fonts ) && !strstr( $fonts, $option ) ) {
					$fonts .= $option.$google_fonts[$option]['variant']."|";
				}
			} // End Foreach Loop

			// Output google font css in header
			if ( trim( $fonts ) != '' ) {
				$fonts = str_replace( " ","+",$fonts);
				$output = '<link id="shortcode-google-fonts" href="http'. ( is_ssl() ? 's' : '' ) .'://fonts.googleapis.com/css?family=' . $fonts .'" rel="stylesheet" type="text/css">'."\n";
				$output = str_replace( '|"','"',$output);
				echo $output;
			}
		}
	} // End responsi_google_webfonts()

	function widget_register_google_fonts($text) {
	 	global $gfonts,$load;
	 	$rText = $text;
	 	$fonts = array();
	    $list_shortcode = apply_filters( "responsi_list_shortcode", array('a3_flipboxes','flip_box','a3_fullwidth','five_sixth','four_fifth','one_fifth','one_fourth','one_half','one_sixth','one_third','three_fifth','three_fourth','two_fifth','two_third' ));
	    $list_font_attr = apply_filters( "responsi_list_shortcode_font_attr", array());
	    $pattern = get_shortcode_regex();
	    $attrs = array();
	    $attrs = $this->get_attrs( $list_shortcode, $attrs, $text, $pattern );
	    if( is_array($attrs) && count($attrs) > 0 ){
	    	$load = true;
	    	foreach ( $attrs as $key => $attr ) {
				if( is_array($attr) && count($attr) > 0 ){
					foreach ( $attr as $k => $v ) {
						if( in_array($k, $list_font_attr)){
							$fonts[] = $v;
						}
					}
				}
		    }
	    }
	    if( is_array($gfonts) && is_array($fonts)){
	    	$gfonts = array_merge($gfonts, $fonts);
	    }
		return $rText;
	}

	public function register_google_fonts() {
		global $wp_query, $gfonts, $load;
		$fonts = array();
	    $list_shortcode = apply_filters( "responsi_list_shortcode", array('a3_flipboxes','flip_box','a3_fullwidth','five_sixth','four_fifth','one_fifth','one_fourth','one_half','one_sixth','one_third','three_fifth','three_fourth','two_fifth','two_third' ));
	    $list_font_attr = apply_filters( "responsi_list_shortcode_font_attr", array());
	    $posts = $wp_query->posts;
	    $pattern = get_shortcode_regex();

	    $attrs = array();
	    foreach ( $posts as $post ) {
	    	if( isset($post->post_content) )
				$attrs = $this->get_attrs( $list_shortcode, $attrs, $post->post_content, $pattern );
	    }
	    if( is_array($attrs) && count($attrs) > 0 ){

	    	$load = true;

	    	foreach ( $attrs as $key => $attr ) {
				if( is_array($attr) && count($attr) > 0 ){
					foreach ( $attr as $k => $v ) {
						if( in_array($k, $list_font_attr)){
							$fonts[] = $v;
						}
					}
				}
		    }
	    }
	    if( is_array($fonts)){
	    	$gfonts = $fonts;
	    }
	    return $fonts;
	}

	public function get_attrs( $list_shortcode, $attrs = array(), $content = '', $pattern = '' ) {
		if (  preg_match_all( '/'. $pattern .'/s', $content, $matches ) ) {
			foreach ( $matches[3] as $key => $attr_text ) {
				if ( in_array( $matches[2][$key], $list_shortcode ) ) {
					$attrs[] = shortcode_parse_atts( $attr_text );
				}
			}

			if ( isset( $matches[5] ) ) {
				foreach ( $matches[5] as $key => $shortcode_content ) {
					if ( '' != trim( $shortcode_content ) ) {
						$child_attrs = $this->get_attrs( $list_shortcode, array(), $shortcode_content, $pattern );
						$attrs = array_merge( $attrs, $child_attrs );
					}
				}
			}
		}

		return $attrs;
	}

	public function has_shortcode($shortcode = '') {
	    $post_to_check = get_post(get_the_ID());
	    // false because we have to search through the post content first
	    $found = false;
	    // if no short code was provided, return false
	    if (!$shortcode) {
	        return $found;
	    }
	    // check the post content for the short code
	    if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {
	        // we have found the short code
	        $found = true;
	    }
	    // return our final results
	    return $found;
	}

	public function cleanup_shortcode_fix( $content ) {
        $array = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']',
            ']<br>' => ']'
        );
        $content = strtr($content, $array);
        return $content;
    }

	public function filter_mce_external_plugins_before(){
		add_filter( 'mce_external_plugins', array( $this, 'filter_mce_external_plugins' ) );
	}

	public static function filter_mce_external_plugins( $plugins ) {
		global $wp_version;
		$cur_wp_version = preg_replace('/-.*$/', '', $wp_version);
		$plugins['A3revShortcodesFontface'] = wp_nonce_url( esc_url( RESPONSI_A3_SC_SHORTCODES_URL . '/js/editor-plugins.js' ), 'responsi-shortcode-fontface-generator' );
        return $plugins;

	}

	public static function filter_mce_buttons( $buttons ) {
		global $wp_version;
		$cur_wp_version = preg_replace('/-.*$/', '', $wp_version);
		array_push( $buttons, '|', 'A3revShortcodesFontface' );

		return $buttons;

	} // End filter_mce_buttons()

	public static function ajax_action_check_url() {
		$hadError = true;

		$url = isset( $_REQUEST['url'] ) ? $_REQUEST['url'] : '';

		if ( strlen( $url ) > 0  && function_exists( 'get_headers' ) ) {
			$url = esc_url( $url );
			$file_headers = @get_headers( $url );
			$exists       = $file_headers && $file_headers[0] != 'HTTP/1.1 404 Not Found';
			$hadError     = false;
		}

		echo '{ "exists": '. ($exists ? '1' : '0') . ($hadError ? ', "error" : 1 ' : '') . ' }';

		die();
	} // End ajax_action_check_url()

	public static function attributes( $slug, $attributes = array() ) {

		$out = '';
		$attr = apply_filters( "responsi_shortcode_attr_{$slug}", $attributes );

		if ( empty( $attr ) ) {
			$attr['class'] = $slug;
		}

		foreach ( $attr as $name => $value ) {
			$out .= ( !empty( $value ) || strlen( $value ) > 0 || is_bool( $value ) ) ? sprintf( ' %s="%s"', esc_html( $name ), esc_attr( $value ) ) : '';
		}
		return trim( $out );

	} // end attr()

	public static function set_shortcode_defaults( $defaults, $args ) {

		if( ! $args ) {
			$$args = array();
		}

		$args = shortcode_atts( $defaults, $args );

		foreach( $args as $key => $value ) {
			if( $value == '' ||
				$value == '|'
			) {
				$args[$key] = $defaults[$key];
			}
		}

		return $args;

	}
	public static function get_attachment_id_from_url( $attachment_url = '' ) {
		global $wpdb;
		$attachment_id = false;

		if ( $attachment_url == '' ) {
			return;
		}

		$upload_dir_paths = wp_upload_dir();

		// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
		if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

			// If this is the URL of an auto-generated thumbnail, get the URL of the original image
			$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

			// Remove the upload path base directory from the attachment URL
			$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

			// Run a custom database query to get the attachment ID from the modified attachment URL
			$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
		}
		return $attachment_id;
	}

	public static function is_transparent_color( $rgba ) {
		$test = preg_match_all( '/rgba\((.*)\)/', $rgba, $matches );
		if( $test && is_array( $matches ) && $matches[1][0] ) {
			$explode = explode( ',', $matches[1][0] );
			if( is_array( $explode ) && $explode[3] ) {
				$transperancy_level = (float) $explode[3];
				if( $transperancy_level && $transperancy_level >= 0 || $transperancy_level < 1) {
					return true;
				} else {
					return false;
				}
			}
		}

		return false;
	}

	public static function general_shadow_type( $id, $h = 0, $v = '0', $blur = 0, $spread = '0', $inset = 'inset', $color = '#000000' , $default_color = '#000000' , $echo = true ){
		$html = '';

		$h = str_replace('px', '', $h);
		$v = str_replace('px', '', $v);
		$blur = str_replace('px', '', $blur);
		$spread = str_replace('px', '', $spread);
		$inset = strtolower($inset);

		if(  $color == '' ){
			$color = 'transparent';
		}

		$html .= '<select id="responsi-value-'.$id.'h" name="responsi-value-'.$id.'h" class="select input-select input-select-h">';
		for($i = -20; $i <= 20; $i++) {
			$html .= '<option '.selected( $i, $h, false ).' value="'.$i.'px">'.$i.'px</option>';
		}
		$html .= '</select>';

		$html .= '<select id="responsi-value-'.$id.'v" name="responsi-value-'.$id.'v" class="select input-select input-select-v">';
		for($i = -20; $i <= 20; $i++) {
			$html .= '<option '.selected( $i, $v, false ).' value="'.$i.'px">'.$i.'px</option>';
		}
		$html .= '</select>';

		$html .= '<select id="responsi-value-'.$id.'blur" name="responsi-value-'.$id.'blur" class="select input-select input-select-blur">';
		for($i = -20; $i <= 20; $i++) {
			$html .= '<option '.selected( $i, $blur, false ).' value="'.$i.'px">'.$i.'px</option>';
		}
		$html .= '</select>';

		$html .= '<select id="responsi-value-'.$id.'spread" name="responsi-value-'.$id.'spread" class="select input-select input-select-spread">';
		for($i = -20; $i <= 20; $i++) {
			$html .= '<option '.selected( $i, $spread, false ).' value="'.$i.'px">'.$i.'px</option>';
		}
		$html .= '</select>';

		$html .= '<div style="clear:both;height:1px;"></div>';

		$insets = array( 'inset' => 'Inset', 'outset' => 'Outset');

		$html .= '<select id="responsi-value-'.$id.'inset" name="responsi-value-'.$id.'inset" class="select input-select input-select-inset">';
		foreach ( $insets as $key => $value ) {
			$html .= '<option '.selected( $key, $inset, false ).' value="'.$key.'">'.$value.'</option>';
		}
		$html .= '</select>';

		$html .= '<div class="responsi-marker-colourpicker-control">';
		$html .= '<input type="text" id="responsi-value-'.$id.'color" name="responsi-value-'.$id.'color" class="icolor-picker" value="'.$color.'" data-default-color="'.$default_color.'" style="display:none" />';
		$html .= '</div>';

		if( $echo ){
			echo $html;
		}else{
			return $html;
		}

	}

	public static function general_border_type( $id, $size = 0, $style = 'solid', $color = '#ffffff' , $default_color = '#ffffff' , $echo = true ){
		$html = '';

		if(  $color == '' ){
			$color = 'transparent';
		}

		$html .= '<select id="responsi-value-'.$id.'size" name="responsi-value-'.$id.'size" class="select input-select input-select-size">';
		for($i = 0; $i <= 20; $i++) {
			$html .= '<option '.selected( $i, $size, false ).' value="'.$i.'px">'.$i.'px</option>';
		}
		$html .= '</select>';

		$bstyle = array( 'solid' => 'Solid', 'dashed' => 'Dashed', 'dotted' => 'Dotted', 'double' => 'Double', 'groove' => 'Groove', 'ridge' => 'Ridge', 'inset' => 'Inset', 'outset' => 'Outset');

		$html .= '<select id="responsi-value-'.$id.'style" name="responsi-value-'.$id.'style" class="select input-select input-select-style">';
		foreach ( $bstyle as $key => $value ) {
			$html .= '<option '.selected( $key, $style, false ).' value="'.$key.'">'.$value.'</option>';
		}
		$html .= '</select>';

		$html .= '<div class="responsi-marker-colourpicker-control">';
		$html .= '<input type="text" id="responsi-value-'.$id.'color" name="responsi-value-'.$id.'color" class="icolor-picker" value="'.$color.'" data-default-color="'.$default_color.'" style="display:none" />';
		$html .= '</div>';

		if( $echo ){
			echo $html;
		}else{
			return $html;
		}

	}

	public static function general_font_type( $id, $font = 'Arial, sans-serif', $size = 0, $line_height = '1.2', $style = 'normal', $color = '#555555' , $default_color = '#555555' , $echo = true ){
		global $google_fonts;

		$font01 = '';
		$font02 = '';
		$font03 = '';
		$font04 = '';
		$font05 = '';
		$font06 = '';
		$font07 = '';
		$font08 = '';
		$font09 = '';
		$font10 = '';
		$font11 = '';
		$font12 = '';
		$font13 = '';
		$font14 = '';
		$font15 = '';
		$font16 = '';
		$font17 = '';

		if ( strpos( $font, 'Arial, sans-serif' ) !== false ) { $font01 = 'selected="selected"'; }
		if ( strpos( $font, 'Verdana, Geneva' ) !== false ) { $font02 = 'selected="selected"'; }
		if ( strpos( $font, 'Trebuchet' ) !== false ) { $font03 = 'selected="selected"'; }
		if ( strpos( $font, 'Georgia' ) !== false ) { $font04 = 'selected="selected"'; }
		if ( strpos( $font, 'Times New Roman' ) !== false ) { $font05 = 'selected="selected"'; }
		if ( strpos( $font, 'Tahoma, Geneva' ) !== false ) { $font06 = 'selected="selected"'; }
		if ( strpos( $font, 'Palatino' ) !== false ) { $font07 = 'selected="selected"'; }
		if ( strpos( $font, 'Helvetica' ) !== false ) { $font08 = 'selected="selected"'; }
		if ( strpos( $font, 'Calibri' ) !== false ) { $font09 = 'selected="selected"'; }
		if ( strpos( $font, 'Myriad' ) !== false ) { $font10 = 'selected="selected"'; }
		if ( strpos( $font, 'Lucida' ) !== false ) { $font11 = 'selected="selected"'; }
		if ( strpos( $font, 'Arial Black' ) !== false ) { $font12 = 'selected="selected"'; }
		if ( strpos( $font, 'Gill' ) !== false ) { $font13 = 'selected="selected"'; }
		if ( strpos( $font, 'Geneva, Tahoma' ) !== false ) { $font14 = 'selected="selected"'; }
		if ( strpos( $font, 'Impact' ) !== false ) { $font15 = 'selected="selected"'; }
		if ( strpos( $font, 'Courier' ) !== false ) { $font16 = 'selected="selected"'; }
		if ( strpos( $font, 'Century Gothic' ) !== false ) { $font17 = 'selected="selected"'; }

		$html = '';

		if(  $color == '' ){
			$color = 'transparent';
		}

		$html .= '<select id="responsi-value-'.$id.'_size" name="responsi-value-'.$id.'_size" class="select input-select input-select-size">';
		for($i = 9; $i <= 70; $i++) {
			$html .= '<option '.selected( $i, $size, false ).' value="'.$i.'px">'.$i.'px</option>';
		}
		$html .= '</select>';

		$line_heights = array();
		for ( $i = 0.6; $i <= 3.1; $i+=0.1 ){
			$line_heights[] = $i;
		}

		$html .= '<select id="responsi-value-'.$id.'_line_height" name="responsi-value-'.$id.'_line_height" class="select input-select input-select-line_height">';
		foreach ($line_heights as $lh ) {
			$html .= '<option '.selected( $lh, $line_height, false ).' value="'.$lh.'">'.$lh.'</option>';
		}
		$html .= '</select>';

		$html .= '<select id="responsi-value-'.$id.'_face" name="responsi-value-'.$id.'_face" class="select input-select input-select-font">';
		$html .= '<option value="Arial, sans-serif" '. $font01 .'>Arial</option>';
		$html .= '<option value="Verdana, Geneva, sans-serif" '. $font02 .'>Verdana</option>';
		$html .= '<option value="&quot;Trebuchet MS&quot;, Tahoma, sans-serif"'. $font03 .'>Trebuchet</option>';
		$html .= '<option value="Georgia, serif" '. $font04 .'>Georgia</option>';
		$html .= '<option value="&quot;Times New Roman&quot;, serif"'. $font05 .'>Times New Roman</option>';
		$html .= '<option value="Tahoma, Geneva, Verdana, sans-serif"'. $font06 .'>Tahoma</option>';
		$html .= '<option value="Palatino, &quot;Palatino Linotype&quot;, serif"'. $font07 .'>Palatino</option>';
		$html .= '<option value="&quot;Helvetica Neue&quot;, Helvetica, sans-serif" '. $font08 .'>Helvetica*</option>';
		$html .= '<option value="Calibri, Candara, Segoe, Optima, sans-serif"'. $font09 .'>Calibri*</option>';
		$html .= '<option value="&quot;Myriad Pro&quot;, Myriad, sans-serif"'. $font10 .'>Myriad Pro*</option>';
		$html .= '<option value="&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, &quot;Lucida Sans&quot;, sans-serif"'. $font11 .'>Lucida</option>';
		$html .= '<option value="&quot;Arial Black&quot;, sans-serif" '. $font12 .'>Arial Black</option>';
		$html .= '<option value="&quot;Gill Sans&quot;, &quot;Gill Sans MT&quot;, Calibri, sans-serif" '. $font13 .'>Gill Sans*</option>';
		$html .= '<option value="Geneva, Tahoma, Verdana, sans-serif" '. $font14 .'>Geneva*</option>';
		$html .= '<option value="Impact, Charcoal, sans-serif" '. $font15 .'>Impact</option>';
		$html .= '<option value="Courier, &quot;Courier New&quot;, monospace" '. $font16 .'>Courier</option>';
		$html .= '<option value="&quot;Century Gothic&quot;, sans-serif" '. $font17 .'>Century Gothic</option>';

		foreach ( $google_fonts as $key => $gfont ) :
			$name = $gfont['name'];
			$html .= '<option value="'.esc_attr( $name ).'" '. selected( $name, $font, false ) .'>'.esc_html( $name ).'</option>';
		endforeach;

		$html .= '</select>';

		$fstyle = array( '300' => 'Thin', '300 italic' => 'Thin/Italic', 'normal' => 'Normal', 'italic' => 'Italic', 'bold' => 'Bold', 'bold italic' => 'Bold/Italic');

		$html .= '<select id="responsi-value-'.$id.'_style" name="responsi-value-'.$id.'_style" class="select input-select input-select-style">';
		foreach ( $fstyle as $key => $value ) {
			$html .= '<option '.selected( $key, $style, false ).' value="'.$key.'">'.$value.'</option>';
		}
		$html .= '</select>';

		$html .= '<div class="responsi-marker-colourpicker-control">';
		$html .= '<input type="text" id="responsi-value-'.$id.'_color" name="responsi-value-'.$id.'_color" class="icolor-picker" value="'.$color.'" data-default-color="'.$default_color.'" style="display:none" />';
		$html .= '</div>';

		if( $echo ){
			echo $html;
		}else{
			return $html;
		}

	}

	public static function _generate_font_css($size = 12, $face = 'Arial, sans-serif', $style = '', $color = '#000000', $line_height = '1.2', $imp = false) {
		$fonts = array('size' => str_replace("px", "", $size),'line_height' => $line_height,'face' => $face,'style' => $style,'color' => $color);
		return responsi_generate_fonts($fonts,$imp);
	}

	public static function _generate_border_radius_css( $topleft = 0, $topright = 0, $bottomleft = 0, $bottomright = 0 ){
		$radius = '';
		$radius .= '
		border-top-left-radius: ' . str_replace("px", "",$topleft) . 'px !important;
		-webkit-border-top-left-radius: ' . str_replace("px", "",$topleft) . 'px !important;
		border-top-right-radius: ' . str_replace("px", "",$topright) . 'px !important;
		-webkit-border-top-right-radius: ' . str_replace("px", "",$topright) . 'px !important;
		border-bottom-left-radius: ' . str_replace("px", "",$bottomleft) . 'px !important;
		-webkit-border-bottom-left-radius: ' . str_replace("px", "",$bottomleft) . 'px !important;
		border-bottom-right-radius: ' . str_replace("px", "",$bottomright) . 'px !important;
		-webkit-border-bottom-right-radius: ' . str_replace("px", "",$bottomright) . 'px !important;
		';
		return $radius;
	}

	public static function hex2rgba($color, $opacity = false) {

		$default = 'rgb(0,0,0)';
		//Return default if no color provided
		if(empty($color))
	          return $default;

		//Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity != false){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
        //Return rgb(a) color string
        return $output;
	}
	// Get the regular expression to parse a single shortcode
	public static function get_shortcode_regex( $tagname ) {
		return
			  '/\\['                              // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "($tagname)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			.     '(?:'
			.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
			.     ')*?'
			. ')'
			. '(?:'
			.     '(\\/)'                        // 4: Self closing tag ...
			.     '\\]'                          // ... and closing bracket
			. '|'
			.     '\\]'                          // Closing bracket
			.     '(?:'
			.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			.             '[^\\[]*+'             // Not an opening bracket
			.             '(?:'
			.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			.                 '[^\\[]*+'         // Not an opening bracket
			.             ')*+'
			.         ')'
			.         '\\[\\/\\2\\]'             // Closing shortcode tag
			.     ')?'
			. ')'
			. '(\\]?)/';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}
}

$GLOBALS['responsi_a3_shortcode_class'] = new Responsi_A3_Shortcode_Class();
?>