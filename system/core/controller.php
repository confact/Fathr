<?php
class Controller {
	//A simple core-controller your controller MUST extend to get the configs and the load features.
	public $load;
	
	//install the right stuff for every controller. making it easy to use and load new helpers and views.
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