<?php
require_once('load.php');
class Controller {
	public $load = "";
	
	function __construct()
	{
		$this->load = new load($config);
	}
}
?>