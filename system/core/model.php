<?php
class Model {
// the core-model which your models MUST extend. Adding support for database automatically and load of course.
	public $load;
	
	function __construct($db = false)
	{
		global $fathr;
		if($db)
		{
			if(!isset($fathr->db)) {
				if(!class_exists("db"))
				{
					require_once('system/helpers/db.php');
				}
				$this->fathr = new db();
			}
			$this->db = &$fathr->db;
		}
		$this->config = &$fathr->config;
		$this->load = new load($this);
	}
}
?>