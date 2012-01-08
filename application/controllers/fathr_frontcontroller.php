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
				$this->pagequery = $this->db->query("SELECT title, headline, text, dated, date from {$this->config['table_tag']}pages WHERE indexed=true and sidebar='0'");
				$this->theme->setMainView("fathr_indexPages");
				$sidebarquery = $this->db->query("SELECT title, headline, text, dated, date, sidebarside from {$this->config['table_tag']}pages WHERE sidebar='index' LIMIT 1");
				$this->sidebar = mysql_fetch_array($sidebarquery);
				$this->theme->setSidebar($this->sidebar['text'], $this->sidebar['sidebarside']);
			}
			else {
				$this->pagequery = $this->db->query("SELECT title, headline, text, dated, date from {$this->config['table_tag']}pages WHERE indexed=true AND sidebar='0' LIMIT 1");
				$this->page = mysql_fetch_array($this->pagequery);
				$this->theme->setMainView("fathr_indexPages");
				$sidebarquery = $this->db->query("SELECT title, headline, text, dated, date, sidebarside from {$this->config['table_tag']}pages WHERE sidebar='index' LIMIT 1");
				$this->sidebar = mysql_fetch_array($sidebarquery);
				$this->theme->setSidebar($this->sidebar['text'], $this->sidebar['sidebarside']);
				if($this->page['dated'])
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