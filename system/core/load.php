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
	
	function model($name, $db = false)
	{
		global $fathr;
		if(file_exists($fathr->config['applicationpath'] . '/models/' . $name . '.php')) {
			include($fathr->config['applicationpath'] . '/models/' . $name . '.php');
			$modelname = ucfirst($name);
			if(!isset($this->contr->$name)) {
				$this->contr->$name = new $modelname($db);
			}
		}
	}
		
	function helper($name)
	{
		global $fathr;
		if(file_exists('system/helpers/' . $name . '.php')) {
			include('system/helpers/' . $name . '.php');
			if($name == "db")
			{
				$modelname = ucfirst($name);
				$fathr->db = new $modelname();
				$this->contr->$name = &$fathr->db;
			}
			else {
				$modelname = ucfirst($name);
				if(!isset($this->contr->$name)) {
					$this->contr->$name = new $modelname();
				}
			}
		}
	}
}
?>