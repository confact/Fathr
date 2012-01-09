<?php
class load
{
// The class that helps the user to load helpers, models and views very easy, by calling this functions bellow.
	function __construct(&$controller) {
		$this->contr = &$controller;
	}
	
	//just simple include the view.
	function view($name)
	{
		global $fathr;
		if(file_exists($fathr->config['applicationpath'] . '/views/' . $name . '.php')) {
			include($fathr->config['applicationpath'] . '/views/' . $name . '.php');
		}
	}
	
	//check if the model should load db, then save it to the controller.
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
		
	//check if the helper is the db or not, then save it to the controller.
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
	
	//load the theme class with the right theme chosen.
	function theme($theme = null)
	{
		global $fathr;
		if(!isset($fathr->theme)) {
			if($theme != null) {
				$father->theme = new Theme($theme);
			}
			else {
				$father->theme = new Theme();
			}
		}
		$this->contr->theme = &$father->theme;
	}
}
?>