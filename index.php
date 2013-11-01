<?php
// This is the start field for Fathr.
// DON'T CHANGE HERE IF YOU DON'T KNOW WHAT YOU DO!
require_once('config/config.php');
require_once('config/db.php');
if($config['developmentmode'])
{
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
}

require_once('system/boot.php');

$fathr = Father::instance();
$fathr->run();
?>