<?php
require_once('fathr_cms.php');
class Fathr_frontcontroller extends Fathr_cms {

	function __construct() {
		parent::__construct();
		$this->theme->setStylesheet("stylesheet");
		$this->theme->setPageTitle($this->settings["sitename"]);
		$this->theme->setHeaderTitle($this->settings["sitename"]);
		$this->theme->setPageBrand($this->settings["sitename"]);
		$this->theme->setPageBrandUrl("/".$this->config['sitepath']);
	}
	
	function index() {
		if(empty($this->settings)) {
			header("Location: /".$this->config['sitepath']."/fathr_setup");
			//print_r($query);
		}
		else {
			$this->pagequery = $this->db->query("SELECT title, headline, text, date from pages WHERE indexed=true");
			$this->theme->setMainView("fathr_indexPages");
			$this->theme->setMenu($this->menu);
			$this->theme->render();
		}
	}
}
?>