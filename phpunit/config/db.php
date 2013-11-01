<?php
// This is the config for the database helper
global $mysqldatabase;
global $mysqlusername;
global $mysqlpassword;
global $mysqladdress;
global $DB;
if(!isset($DB))
{
	$DB = "mysql";
}
global $db_config;
$db_config['db_host'] = $mysqladdress;
$db_config['db_dbname'] = $mysqldatabase;
$db_config['db_user'] = $mysqlusername;
$db_config['db_password'] = $mysqlpassword;
if($DB == "mysql") {
	$db_config['mysqli'] = false;
}
else {
	$db_config['mysqli'] = true;	
}

?>