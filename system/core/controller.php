<?php
class Controller {
	public $load = "";
	
	function __construct()
	{
		global $fathr;
		$this->load = new load(&$this);
		$this->config = &$fathr->config;
		if(isset($fathr->theme))
		{
			$this->theme = &$fathr->theme;
		}
	}
}
?>