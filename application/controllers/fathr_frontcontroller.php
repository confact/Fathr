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
		$this->theme->setMenu($this->menu);
	}
	
	function index() {
		if(empty($this->settings)) {
			header("Location: /".$this->config['sitepath']."/fathr_setup");
			//print_r($query);
		}
		else {
			if($this->settings['blogyindex'])
			{
				$this->pagequery = $this->db->query("SELECT title, headline, text, date from pages WHERE indexed=true");
				$this->theme->setMainView("fathr_indexPages");
			}
			else {
				$this->pagequery = $this->db->query("SELECT title, headline, text, date from pages WHERE indexed=true LIMIT 1");
				$this->page = mysql_fetch_array($this->pagequery);
				$this->theme->setMainView("fathr_indexPages");
				if($this->page['date'] != "")
				{
					$this->theme->setHeaderTitle($this->page['headline']. " <small>".date('l j F Y', $this->page['date'])."</small>");
				}
				else {
					$this->theme->setHeaderTitle($this->page['headline']);
				}
			}
			$this->theme->render();
		}
	}
}
?>