<?php
class Controller {
	public $load = "";
	
	function __construct()
	{
		$this->load = new load(&$this);
	}
}
?>