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
		if(file_exists($config['applicationpath'] . '/model/' . $name . '.php')) {
			include($config['applicationpath'] . '/model/' . $name . '.php');
			$this->$name = new $name();
		}
	}
		
	function helper($name)
	{
		if(file_exists('system/helper/' . $name . '.php')) {
			include('system/helper/' . $name . '.php');
		}
	}
}
?>