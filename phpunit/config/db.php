<?php
// This is the config for the database helper
global $mysqldatabase;
global $mysqlusername;
global $mysqlpassword;
global $mysqladdress;
$db_config['db_host'] = $mysqladdress;
$db_config['db_dbname'] = $mysqldatabase;
$db_config['db_user'] = $mysqlusername;
$db_config['db_password'] = $mysqlpassword;

?>