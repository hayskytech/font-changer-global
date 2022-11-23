<?php
/* Plugin Name: Font changer Global
Plugin URI: https://haysky.com/
Description: Universal font changer for themes without font option. This plugin will force admin side in LTR and allows to add Noto Nastaliq Urdu font in admin editor.
Version: 1.0.1
Author: Haysky
Author URI: https://haysky.com/
License: GPLv2 or later
Text Domain: sufyan
*/

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin",function($links){
    $settings_link = '<a href="'.admin_url().'options-general.php?page=font_changer_dsj" >Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
});

add_action('admin_menu' , function(){
    add_submenu_page('options-general.php', 'Font Changer','Font Changer','manage_options', 'font_changer_dsj', 'font_changer_settings_dsj');
});

function font_changer_settings_dsj(){
	include 'settings.php';
}

if (get_option('font_changer_editor')) {
	add_editor_style( plugin_dir_url(__FILE__).'editor-style.css' );
	add_action('admin_footer', 'urdu_font_to_admin');
	function urdu_font_to_admin() {
	?>
	<style>
		@import url('https://fonts.googleapis.com/earlyaccess/notonastaliqurdu.css');
		input#title{
			font-family: 'Noto Nastaliq Urdu', serif !important;
			direction: rtl;
			height: 3em !important;
		}
	</style>
	<?php
	}
}
add_action('wp_footer','font_changer_css');
function font_changer_css(){
	$f_name = get_option( 'font_changer_font' );
	$fname = str_replace(' ', '+', $f_name);
	$font = 'family='.$fname.'&';
	$exclude = get_option('font_changer_exclude');
	if ($exclude) {
		$exclude = ':not('.$exclude.')';
	}
	?>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?<?php echo $font; ?>&display=swap');
		*<?php echo $exclude; ?>{
			font-family: <?php echo $f_name; ?> !important;
		}
	</style>
	<?php
}

function my_set_admin_locale( $locale ) {
    // check if you are in the Admin area
    if( is_admin() ) {
        // set LTR locale
        $locale = 'en_US';
    }
    return( $locale );
}
add_filter( 'locale', 'my_set_admin_locale' );