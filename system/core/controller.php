<?php
class Controller {
	//A simple core-controller your controller MUST extend to get the configs and the load features.
	public $load;
	
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