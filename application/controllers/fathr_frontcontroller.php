<?php
require_once('fathr_cms.php');
class Fathr_frontcontroller extends Fathr_cms {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		if(empty($this->settings)) {
			header("Location: /".$this->config['sitepath']."/fathr_setup");
			//print_r($query);
		}
		else {
			$this->theme->setStylesheet("stylesheet");
			$this->theme->setPageTitle($this->settings["sitename"]);
			$this->theme->setHeaderTitle($this->settings["sitename"]);
			$myVar = print_r($this->settings, true);
			$myVar .= print_r($this->menu, true);
			$this->theme->setMain($myVar);
			$this->theme->setMenu($this->menu);
			$this->theme->render();
		}
	}
}
?>