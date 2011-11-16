<?php
class Controller {
	public $load = "";
	
	function __construct()
	{
		global $fathr;
		$fathr->load = new load();
	}
}
?>