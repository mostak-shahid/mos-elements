<?php
/*
Plugin Name: Mos Elements
Description: Base of future plugin
Version: 1.0.0
Author: Md. Mostak Shahid
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define MOS_ELEMENTS_FILE.
if ( ! defined( 'MOS_ELEMENTS_FILE' ) ) {
	define( 'MOS_ELEMENTS_FILE', __FILE__ );
}
// Define MOS_ELEMENTS_SETTINGS.
if ( ! defined( 'MOS_ELEMENTS_SETTINGS' ) ) {
    //define( 'MOS_ELEMENTS_SETTINGS', admin_url('/edit.php?post_type=post_type&page=plugin_settings') );
	define( 'MOS_ELEMENTS_SETTINGS', admin_url('/options-general.php?page=mos_elements_settings') );
}
$mos_elements_option = get_option( 'mos_elements_option' );
$plugin = plugin_basename(MOS_ELEMENTS_FILE); 
require_once ( plugin_dir_path( MOS_ELEMENTS_FILE ) . 'mos-elements-functions.php' );
require_once ( plugin_dir_path( MOS_ELEMENTS_FILE ) . 'mos-elements-settings.php' );
require_once ( plugin_dir_path( MOS_ELEMENTS_FILE ) . 'elementor/mos-elements-elementor-widgets.php' );

require_once('plugins/update/plugin-update-checker.php');
$pluginInit = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/mostak-shahid/update/master/mos-elements.json',
	MOS_ELEMENTS_FILE,
	'mos-elements'
);


register_activation_hook(MOS_ELEMENTS_FILE, 'mos_elements_activate');
add_action('admin_init', 'mos_elements_redirect');
 
function mos_elements_activate() {
    $mos_elements_option = array();
    // $mos_elements_option['mos_login_type'] = 'basic';
    // update_option( 'mos_elements_option', $mos_elements_option, false );
    add_option('mos_elements_do_activation_redirect', true);
}
 
function mos_elements_redirect() {
    if (get_option('mos_elements_do_activation_redirect', false)) {
        delete_option('mos_elements_do_activation_redirect');
        if(!isset($_GET['activate-multi'])){
            wp_safe_redirect(MOS_ELEMENTS_SETTINGS);
        }
    }
}

// Add settings link on plugin page
function mos_elements_settings_link($links) { 
    $settings_link = '<a href="'.MOS_ELEMENTS_SETTINGS.'">Settings</a>'; 
    array_unshift($links, $settings_link); 
    return $links; 
} 
add_filter("plugin_action_links_$plugin", 'mos_elements_settings_link' );
