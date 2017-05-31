<?php
/**
 * Register Activation Hook
 */
function responsi_a3_shortcode_addon_install(){
	
}

/**
* Load Localisation files.
*
* Note: the first-loaded translation file overrides any following ones if the same translation is present.
*
* Locales found in:
*         - WP_LANG_DIR/responsi-a3-shortcode-addon/responsi-custom-sidebars-addon-LOCALE.mo
*          - /wp-content/plugins/responsi-a3-shortcode-addon/languages/responsi-a3-shortcode-addon-LOCALE.mo (which if not found falls back to)
*          - WP_LANG_DIR/plugins/responsi-a3-shortcode-addon-LOCALE.mo
*/
function responsi_shortcode_addon_load_plugin_textdomain() {
    $locale = apply_filters( 'plugin_locale', get_locale(), 'responsi-a3-shortcode-addon' );
    load_textdomain( 'responsi-a3-shortcode-addon', WP_LANG_DIR . '/responsi-a3-shortcode-addon/responsi-a3-shortcode-addon-' . $locale . '.mo' );
    load_plugin_textdomain( 'responsi-a3-shortcode-addon', false, RESPONSI_A3_SC_FOLDER . '/languages/' );
}

/**
 * Load languages file
 */
function load_plugin_textdomain_responsi_a3_shortcode_addon() {
	if ( get_option('responsi_a3_shortcode_addon_installed') ) {
		delete_option('responsi_a3_shortcode_addon_installed');
		responsi_a3_shortcode_addon_install();
		global $responsi_a3_shortcode_addon;
		$responsi_a3_shortcode_addon->responsi_build_css_theme_actived();
		//wp_redirect( ( ( is_ssl() || force_ssl_admin() ) ? str_replace( 'http:', 'https:', admin_url( 'customize.php' ) ) : str_replace( 'https:', 'http:', admin_url( 'customize.php' ) ) ) );
		//exit;
	}
	responsi_shortcode_addon_load_plugin_textdomain();
}
// Add language
add_action('init', 'load_plugin_textdomain_responsi_a3_shortcode_addon');

function responsi_a3_shortcode_addon_settings_link($links) { 
	$customize_url =  ( ( is_ssl() || force_ssl_admin() ) ? str_replace( 'http:', 'https:', admin_url( 'customize.php' ) ) : str_replace( 'https:', 'http:', admin_url( 'customize.php' ) ) ) ;
  	$customize_url .= '?autofocus[panel]=responsi_shortcode_panel';
  	$settings_link = '<a href="'.$customize_url.'">'.__( 'Settings', 'responsi-a3-shortcode-addon' ).'</a>'; 
  	array_unshift($links, $settings_link); 
  	return $links; 
}
 
add_filter("plugin_action_links_".RESPONSI_A3_SC_NAME, 'responsi_a3_shortcode_addon_settings_link' );

?>
