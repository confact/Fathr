<?php
class load
{

	function __construct(&$controller) {
		$this->contr = &$controller;
	}
	
	function view($name)
	{
		global $fathr;
		if(file_exists($fathr->config['applicationpath'] . '/views/' . $name . '.php')) {
			include($fathr->config['applicationpath'] . '/views/' . $name . '.php');
		}
	}
	
	function model($name)
	{
		global $fathr;
		if(file_exists($fathr->config['applicationpath'] . '/models/' . $name . '.php')) {
			include($fathr->config['applicationpath'] . '/models/' . $name . '.php');
			$modelname = ucfirst($name);
			$this->contr->$name = new $modelname();
		}
	}
		
	function helper($name)
	{
		global $fathr;
		if(file_exists('system/helpers/' . $name . '.php')) {
			include('system/helpers/' . $name . '.php');
			$modelname = ucfirst($name);
			$this->contr->$name = new $modelname();
		}
	}
}
?>