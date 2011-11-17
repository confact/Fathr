<?php
require_once('config/config.php');
if($config['developmentmode'])
{
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
}

require_once('system/core/boot.php');

$fathr = Father::instance();
$Father = new loader();
$Father->run();
?>