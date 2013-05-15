<?php
// Errors on full!
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);


require_once('config/config.php');

class bootstrap
{
	private $directory;
	
	public function __construct($directory_name, $rootdir)
	{
		$this->directory = $rootdir . '/' . $directory_name;
	}
	
	public function autoload($class_name)
	{
		$filename = strtolower($class_name).'.php';
		$file = "../".$this->directory.'/'.$filename;
		
		if(file_exists($file) == false)
		{
			return false;
		}
		include($file);
	}
}
	//setup the core loaders
	$core_loader = new bootstrap("core", "system");
	$helpers_loader = new bootstrap("helpers", "system");
	
	//setup the application loaders
	$controllers_loader = new bootstrap("controllers", "application");
	$models_loader = new bootstrap("models", "application");
	$views_loader = new bootstrap("views", "application");
	
	//register all the loaders
	spl_autoload_register(array($core_loader, 'autoload'));
	spl_autoload_register(array($helpers_loader, 'autoload'));
	spl_autoload_register(array($controllers_loader, 'autoload'));
	spl_autoload_register(array($models_loader, 'autoload'));
	spl_autoload_register(array($views_loader, 'autoload'));
	
	global $fathr;
	$fathr = Father::instance();

?>