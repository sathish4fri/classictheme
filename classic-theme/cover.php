<?php
require_once(dirname(dirname(dirname(__FILE__))). '/engine/start.php');
header('Content-Type: image/jpeg');
$user = get_input('user');
$filehandler = new ElggFile();
$filehandler->owner_guid =  $user;
$filehandler->setFilename('classictheme_cover.jpg');
if ($filehandler->exists()){
	echo $filehandler->grabFile();
}
