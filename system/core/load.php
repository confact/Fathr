<?php
class load
{
	
	function view($name)
	{
		if(file_exists($config['applicationpath'] . '/view/' . $name . '.php')) {
			include($config['applicationpath'] . '/view/' . $name . '.php');
		}
	}
	
	function model($name)
	{
		global $fathr;
		if(file_exists($fathr->config['applicationpath'] . '/model/' . $name . '.php')) {
			include($fathr->config['applicationpath'] . '/model/' . $name . '.php');
			$modelname = ucfirst($name);
			$fathr->$name = new $modelname();
		}
	}
		
	function helper($name)
	{
		global $fathr;
		if(file_exists('system/helper/' . $name . '.php')) {
			include('system/helper/' . $name . '.php');
			$modelname = ucfirst($name);
			$fathr->$name = new $modelname();
		}
	}
}
?>