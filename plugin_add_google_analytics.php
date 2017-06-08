<?php
/**
*---------------------------------------------------
* = ADD GOOGLE ANALYTICS IN DASHBOARD..
*---------------------------------------------------
*/
function my_add_google_link(){
	global $wp_admin_bar;
	$args = array(
		'id' => 'google_analytics',
		'title' => 'Google Analytics',
		'href' => 'http://www.theinfotechs.com',
	);
	$wp_admin_bar->add_menu($args);
}
add_action('wp_before_admin_bar_render','my_add_google_link');
?>
