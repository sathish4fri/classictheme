<?php
/**
 * Ohyes Theme
 * @website Link: https://github.com/lianglee/OhYesTheme
 * @Package Ohyes
 * @subpackage Theme
 * @author Liang Lee
 * @copyright All right reserved Liang Lee 2014.
 * @ide The Code is Generated by Liang Lee php IDE.
 */ 

	gatekeeper();
	action_gatekeeper();
	
	$upload = new ClassicTheme;
	if($upload->upload_cover(elgg_get_logged_in_user_entity())){
		system_message(elgg_echo('ohyes:theme:cover:done'));													
        forward(REFERER);
	 }
	 else {
		register_error(elgg_echo('ohyes:theme:cover:no'));													
        forward(REFERER);
	 }


