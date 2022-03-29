<?php
/*
Plugin Name: Responsi Shortcodes
Description: Responsi Shortcodes extends the existing Responsi Framework shortcodes and is an essential tool for creating stunning content without writing code. Includes 360+ fontface Icon shortcodes and Flip Box shortcode. More coming soon.
Version: 3.0.9
Author: a3rev Software
Author URI: https://a3rev.com/
Update URI: a3-responsi-a3-shortcode-addon
Requires at least: 4.4
Tested up to: 5.9
Text Domain: responsi-a3-shortcode-addon
Domain Path: /languages
License: This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007

	Responsi a3 Shortcode. Plugin for the Responsi Framework.
	Copyright © 2011 a3THEMES

	a3THEMES
	admin@a3rev.com
	PO Box 1170
	Gympie 4570
	QLD Australia
*/

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'RESPONSI_A3_SC_PATH', dirname(__FILE__));
define( 'RESPONSI_A3_SC_FOLDER', dirname(plugin_basename(__FILE__)) );
define( 'RESPONSI_A3_SC_NAME', plugin_basename(__FILE__) );
define( 'RESPONSI_A3_SC_URL', untrailingslashit( plugins_url( '/', __FILE__ ) ) );
define( 'RESPONSI_A3_SC_SHORTCODES_URL', RESPONSI_A3_SC_URL . '/shortcodes' );
define( 'RESPONSI_A3_SC_SHORTCODES_JS_URL', RESPONSI_A3_SC_SHORTCODES_URL . '/js' );
define( 'RESPONSI_A3_SC_SHORTCODES_CSS_URL', RESPONSI_A3_SC_SHORTCODES_URL . '/css' );
define( 'RESPONSI_A3_SC_IMAGES_URL',  RESPONSI_A3_SC_URL . '/assets/images' );
define( 'RESPONSI_A3_SC_JS_URL',  RESPONSI_A3_SC_URL . '/assets/js' );
define( 'RESPONSI_A3_SC_CSS_URL',  RESPONSI_A3_SC_URL . '/assets/css' );

define( 'RESPONSI_A3_SC_KEY', 'responsi_a3_shortcode_addon' );
define( 'RESPONSI_A3_SC_VERSION', '3.0.9' );

function responsi_a3_shortcode_addon_activate_validate(){
    if ( 'responsi' !== get_template() ) {
        echo sprintf( wp_kses_post( 'This is a plugin for Responsi Framework, you need to install <a href="%s" target="_blank" rel="noopener">Responsi Framework</a> theme from WordPress first before can activate this.', 'responsi-a3-shortcode-addon' ), 'https://wordpress.org/themes/responsi-framework/' );
        die();
    }
    update_option('a3rev_responsi_a3_shortcode_addon_version', RESPONSI_A3_SC_VERSION );
    update_option('responsi_a3_shortcode_addon_installed', true);
}

register_activation_hook(__FILE__,'responsi_a3_shortcode_addon_activate_validate');

if( !defined( 'RESPONSI_A3_SC_TRAVIS' ) ){

	if ( !file_exists( get_theme_root().'/responsi/functions.php' ) ) return;
	if ( !isset( $_POST['wp_customize'] ) && get_option('template') != 'responsi' ) return;
	if ( isset( $_POST['wp_customize'] ) && wp_unslash($_POST['wp_customize']) == 'on' && isset( $_POST['theme'] ) && stristr( wp_unslash($_POST['theme']), 'responsi' ) === FALSE ) return;
	if ( version_compare(get_option('responsi_framework_version'), '6.9.5', '<') ) return;

}

if ( version_compare( PHP_VERSION, '5.6.0', '>=' ) ) {
	require __DIR__ . '/vendor/autoload.php';
	global $responsi_a3_shortcode_addon_admin,
	$responsi_a3_shortcode_addon,
	$responsi_a3_shortcode_frontend,
	$shortcode_buttons,
	$shortcode_columns,
	$shortcode_icons,
	$shortcode_lists,
	$shortcode_infobox,
	$shortcode_toggles,
	$shortcode_Tabs,
	$shortcode_SocialLinks,
	$shortcode_Flipboxes,
	$shortcode_Fullwidth;
	
	$responsi_a3_shortcode_addon_admin 	= new \A3Rev\RShortcode\Admin();
	$responsi_a3_shortcode_addon 		= new \A3Rev\RShortcode\Main();
										  new \A3Rev\RShortcode\Customizer();
	$responsi_a3_shortcode_hookfunction = new \A3Rev\RShortcode\HookFunction();

	$shortcode_typography 				= new \A3Rev\RShortcode\Typography();
	$shortcode_icons 					= new \A3Rev\RShortcode\Icons();
	$shortcode_lists 					= new \A3Rev\RShortcode\Lists();
	$shortcode_buttons 					= new \A3Rev\RShortcode\Buttons();
	$shortcode_columns  				= new \A3Rev\RShortcode\Columns();
	$shortcode_dividers  				= new \A3Rev\RShortcode\Dividers();
	$shortcode_infobox  				= new \A3Rev\RShortcode\Infobox();
	$shortcode_toggles  				= new \A3Rev\RShortcode\Toggles();
	$shortcode_Tabs  					= new \A3Rev\RShortcode\Tabs();
	$shortcode_SocialLinks  			= new \A3Rev\RShortcode\SocialLinks();
	$shortcode_Flipboxes  				= new \A3Rev\RShortcode\Flipboxes();
	$shortcode_Fullwidth  				= new \A3Rev\RShortcode\Fullwidth();

} else {
	return;
}

function responsi_addon_shortcode_upgrade_version () {
	if( version_compare(get_option('a3rev_responsi_a3_shortcode_addon_version'), '3.0.9') === -1 ){
        global $responsi_a3_shortcode_addon;
        $responsi_a3_shortcode_addon->build_css_after_addon_updated();
	}
	
	update_option('a3rev_responsi_a3_shortcode_addon_version', RESPONSI_A3_SC_VERSION );
}

add_action( 'after_setup_theme', 'responsi_addon_shortcode_upgrade_version' );

include ( 'upgrade/plugin_upgrade.php' );
include ( 'admin/responsi-a3-shortcode-addon-init.php' );

?>
