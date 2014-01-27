<?php
require_once(elgg_get_plugins_path().'classic-theme/ohyestheme.class.php');

elgg_register_event_handler('init', 'system', 'classic_theme_init');

function classic_theme_init() {
	
  $action_path = elgg_get_plugins_path() . 'classic-theme';
  elgg_register_action('addcover', "$action_path/addcover.php");
  elgg_register_action('deletecover', "$action_path/deletecover.php");

  
  elgg_register_js('jquery.fancybox', 'vendors/jquery/fancybox/jquery.fancybox-1.3.4.pack.js', 'head');
  elgg_register_css('jquery.fancybox', 'vendors/jquery/fancybox/jquery.fancybox-1.3.4.css', 'head');

  elgg_load_js('jquery.fancybox');
  elgg_load_css('jquery.fancybox');
  
   
 

}
