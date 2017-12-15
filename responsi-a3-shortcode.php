<?php
/*
Plugin Name: Responsi Shortcodes
Description: Responsi Shortcodes extends the existing Responsi Framework shortcodes and is an essential tool for creating stunning content without writing code. Includes 360+ fontface Icon shortcodes and Flip Box shortcode. More coming soon.
Version: 2.8.7
Author: a3THEMES
Author URI: http://a3rev.com/
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

if(!defined("RESPONSI_A3_SC_MANAGER_URL"))
	define("RESPONSI_A3_SC_MANAGER_URL", "http://a3api.com/responsi_premium");

update_option('a3rev_responsi_a3_shortcode_addon_plugin', 'responsi_a3_shortcode_addon');

function responsi_a3_shortcode_addon_activate_validate(){
    if ( 'responsi' !== get_template() ) {
        echo sprintf( __( 'This is a plugin for Responsi Framework, you need to install <a href="%s" target="_blank">Responsi Framework</a> theme from WordPress first before can activate this.', 'responsi-a3-shortcode-addon' ), 'https://wordpress.org/themes/responsi-framework/' );
        die();
    }
    update_option('a3rev_responsi_a3_shortcode_addon_version', '2.8.7');
    update_option('responsi_a3_shortcode_addon_installed', true);
}

register_activation_hook(__FILE__,'responsi_a3_shortcode_addon_activate_validate');

if ( !file_exists( get_theme_root().'/responsi/functions.php' ) ) return;
if ( !isset( $_POST['wp_customize'] ) && get_option('template') != 'responsi' ) return;
if ( isset( $_POST['wp_customize'] ) && $_POST['wp_customize'] == 'on' && isset( $_POST['theme'] ) && stristr( $_POST['theme'], 'responsi' ) === FALSE ) return;

function responsi_addon_shortcode_upgrade_version () {
	if( version_compare(get_option('a3rev_responsi_a3_shortcode_addon_version'), '2.8.7') === -1 ){
        global $responsi_a3_shortcode_addon;
        //$theme = get_option( 'stylesheet' );
        //$version = str_replace('.', '_', '2.8.7');
        //update_option( 'theme_mods_'.$theme.'_a3_shortcode_'.$version, $responsi_a3_shortcode_addon->global_responsi_options_a3_shortcode() );
        $responsi_a3_shortcode_addon->build_css_after_addon_updated();
	}
	update_option('a3rev_responsi_a3_shortcode_addon_version', '2.8.7');
}

add_action( 'after_setup_theme', 'responsi_addon_shortcode_upgrade_version' );

include ( 'upgrade/plugin_upgrade.php' );
include ( 'admin/responsi-a3-shortcode-addon-admin.php' );
include ( 'admin/responsi-a3-shortcode-addon-init.php' );
include ( 'classes/responsi-a3-shortcode-addon-class.php' );

add_filter('responsi_includes_customizer','responsi_shortcodes_includes_customizer');
function responsi_shortcodes_includes_customizer( $includes_customizer ){
	$includes_customizer[] = RESPONSI_A3_SC_PATH.'/customize/customize.php';
	return $includes_customizer;
}

include ( 'shortcodes/shortcode-icons-class.php' );
include ( 'shortcodes/shortcode-list-generator-class.php' );
include ( 'shortcodes/shortcode-typography-class.php' );
include ( 'shortcodes/shortcode-button-class.php' );
include ( 'shortcodes/shortcode-divider-class.php' );
include ( 'shortcodes/shortcode-infobox-class.php' );
include ( 'shortcodes/shortcode-toggles-class.php' );
include ( 'shortcodes/shortcode-tabs-class.php' );
include ( 'shortcodes/shortcode-social-links-class.php' );
include ( 'shortcodes/shortcode-flipboxes-class.php' );
include ( 'shortcodes/shortcode-fullwidth-class.php' );
include ( 'shortcodes/responsi-a3-shortcode-class.php' );

include ( 'shortcodes/column/class-five-sixth.php' );
include ( 'shortcodes/column/class-four-fifth.php' );
include ( 'shortcodes/column/class-one-fifth.php' );
include ( 'shortcodes/column/class-one-fourth.php' );
include ( 'shortcodes/column/class-one-half.php' );
include ( 'shortcodes/column/class-one-sixth.php' );
include ( 'shortcodes/column/class-one-third.php' );
include ( 'shortcodes/column/class-three-fifth.php' );
include ( 'shortcodes/column/class-three-fourth.php' );
include ( 'shortcodes/column/class-two-fifth.php' );
include ( 'shortcodes/column/class-two-third.php' );
include ( 'shortcodes/shortcode-columns-class.php' );

?>