<?php
class load
{
	
	function view($name)
	{
		if(file_exists($config['applicationpath'] . '/views/' . $name . '.php')) {
			include($config['applicationpath'] . '/views/' . $name . '.php');
		}
	}
	
	function model($name)
	{
		global $fathr;
		if(file_exists($fathr->config['applicationpath'] . '/models/' . $name . '.php')) {
			include($fathr->config['applicationpath'] . '/models/' . $name . '.php');
			$modelname = ucfirst($name);
			$fathr->$name = new $modelname();
		}
	}
		
	function helper($name)
	{
		global $fathr;
		if(file_exists('system/helpers/' . $name . '.php')) {
			include('system/helpers/' . $name . '.php');
			$modelname = ucfirst($name);
			$fathr->$name = new $modelname();
		}
	}
}
?>