<?php
class Model {
	
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
	}
}
?>