<?php
// Errors on full!
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);


global $mysqldatabase;
$mysqldatabase = getenv('mysqldatabase')  ?: 'phpci_test';
global $mysqlusername;
$mysqlusername=getenv('mysqlusername')  ?: 'phpci_test';
global $mysqlpassword;
$mysqlpassword=getenv('mysqlpassword')  ?: 'tester12!';
global $mysqladdress;
$mysqladdress = getenv('mysqladdress') ? : 'localhost';
$mysqlcheck = getenv('DB') ? : "mysqli";

if($mysqlcheck == "mysql") {
	$mysqlcheck = false;
}
else {
	$mysqlcheck = true;
}

require_once('config/config.php');


global $db_config;

$db_config['db_host'] = $mysqladdress;
$db_config['db_dbname'] = $mysqldatabase;
$db_config['db_user'] = $mysqlusername;
$db_config['db_password'] = $mysqlpassword;
$db_config['mysqli'] = $mysqlcheck;

class bootstrapeer {

    private $directory;

    public function __construct($directory_name, $rootdir) {
        $this->directory = $rootdir . '/' . $directory_name;
    }

    public function autoload($class_name) {
        $filename = strtolower($class_name) . '.php';
        $file = "../" . $this->directory . '/' . $filename;
		if(file_exists($file) == false)
		{
			return false;
		}
		include_once($file);
	}
}
	//setup the core loaders
	$core_loader = new bootstrapeer("core", "system");
	$helpers_loader = new bootstrapeer("helpers", "system");
	
	//setup the application loaders
	$controllers_loader = new bootstrapeer("controllers", "application");
	$models_loader = new bootstrapeer("models", "application");
	$views_loader = new bootstrapeer("views", "application");
	
	//register all the loaders
	spl_autoload_register(array($core_loader, 'autoload'));
	spl_autoload_register(array($helpers_loader, 'autoload'));
	spl_autoload_register(array($controllers_loader, 'autoload'));
	spl_autoload_register(array($models_loader, 'autoload'));
	spl_autoload_register(array($views_loader, 'autoload'));
	
	global $fathr;
	$fathr = Father::instance();

?>