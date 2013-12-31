<?php
//elgg_register_event_handler('init', 'system', 'classic_theme_init');

function classic_theme_init() {
  elgg_unregister_menu_item('topbar', 'elgg_logo');
  // Replace the default index page
    //register_plugin_hook('index','system','new_index');
	
}

 //function new_index() {
   // if (!include_once(dirname(dirname(__FILE__)) . "/classic-theme/index.php"))
   //     return false;
 //
  //  return true;
//}


?>
