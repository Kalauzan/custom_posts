
<?php
/*
*-------------------------------------------------------------------------------------------------------------
Plugin Name: Custom Posts
Plugin URI: http://www.theinfotechs.com
Description: Just for demo perposes.
Version: 0:0:1
Author: Md. Abu Kalam Azad
Author URI: http://www.theinfotechs.com
Text Domain: custom_posts
Domain Path: /languages/
License: GPLv2 or later
License URI: http://www.theinfotechs.com/wordpress
Copyright 2017 Md. Abul Kalam Azad webdevazad@gmail.com
This program is free software; you can redistribute it and/or modify it under the terms of the GNU
General Public License, version 2, as published by the free software foundation.

This program is distributed in the hope that it will be usefull, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PERTICULAR PURPOSE. see the GNU General public license for more details.
	
You should have recieved a copy of the GNU General Public License along with this program; if not, write to the free software Foundation, Inc., 51 Lohagara, Chittagong, Bangladesh.
*-------------------------------------------------------------------------------------------------------------*/
/**
*-----------------------------------------------------------------------------------
* = IF THIS FILE IS CALLED DIRECTLY, ABORT...
*-----------------------------------------------------------------------------------
*/
if ( ! defined( 'ABSPATH' ) ) {
    die('You are in the wrong path buddy');
}
// OR USE THIS
if ( ! defined( 'WPINC' ) ) {
    die;
}
if ( !function_exists( 'add_action' ) ) {
    //echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    //exit();
}
/**
*-----------------------------------------------------------------------------------
* = THE WAY TO CREATE PLUGIN SETTINGS LINKS...
*-----------------------------------------------------------------------------------
*/
function plugin_settings_links($links,$file){
    $this_plugin = dirname(plugin_basename(__FILE__));
    if(dirname($file) == $this_plugin){
            $settings_link = "<a href='options-general.php'>Settings</a>";
            $links[] = $settings_link;
    }
    return ($links);
}
add_filter('plugin_action_links','plugin_settings_links',10,2);
/**
*-----------------------------------------------------------------------------------
* = THE WAY TO CREATE PLUGIN LICENSE LINKS...
*-----------------------------------------------------------------------------------
*/
function plugin_license_links($links,$file){
	$this_plugin = dirname(plugin_basename(__FILE__));
	if(dirname($file) == $this_plugin){
		return array_merge(
			$links,
			array(
				'License' => '<a href="http://www.theinfotechs.com">License</a>'
				)
			);
	}
	return $links;
}
add_filter('plugin_row_meta','plugin_license_links', 10,2);
/**
*----------------------------------------------------------------------------------------
* = GOOGLE ANALYTICS...
*-----------------------------------------------------------------------------------------
*/
define( my_plugin_path, plugin_dir_path(__FILE__).'/inc/plugin_add_google_analytics.php' );
if (file_exists(my_plugin_path) && is_admin()){
	require_once(my_plugin_path);
}

/**
*---------------------------------------------------------------------------------------
* = THE WAY TO ADD CUSTOM POSTS
*---------------------------------------------------------------------------------------
*/
define( plugin_custom_posts, plugin_dir_path(__FILE__).'/inc/plugin_custom_posts.php' );
if (file_exists(plugin_custom_posts)){
	require_once(plugin_custom_posts);
}


/**
*---------------------------------------------------------------------------------------
* = THE WAY TO ADD SHORTCODES
*---------------------------------------------------------------------------------------
*/
define( plugin_custom_shortcodes, plugin_dir_path(__FILE__).'/inc/plugin_custom_shortcodes.php' );
if (file_exists(plugin_custom_shortcodes)){
	require_once(plugin_custom_shortcodes);
}

/**
*---------------------------------------------------------------------------------------
* = THE WAY TO ADD TINYMCE BUTTON
*---------------------------------------------------------------------------------------
*/
define( plugin_tinymce_button, plugin_dir_path(__FILE__).'/inc/plugin_tinymce_button.php' );
if (file_exists(plugin_tinymce_button)){
	require_once(plugin_tinymce_button);
}



/*

function azad(){
	return 'azad';
}
add_filter('custom_posts','azad');

*/
