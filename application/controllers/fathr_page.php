<?php
require_once('fathr_cms.php');
class Fathr_page extends Fathr_cms {
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
		$this->theme->setMain("works");
		$this->theme->render();
	}
	
	function page($id = 0) {
		if($id != 0)
		{
			$query = $this->db->query("SELECT title, headline, text, dated, date from {$this->config['table_tag']}pages WHERE id='{$id}' LIMIT 1");
			$this->pagequery = mysql_fetch_array($query);
			$sidebarquery = $this->db->query("SELECT title, headline, text, dated, date, sidebarside from {$this->config['table_tag']}pages WHERE sidebar='{$id}' LIMIT 2");
			$this->sidebar = mysql_fetch_array($sidebarquery);
			$this->sidebar2 = mysql_fetch_array($sidebarquery);
			$this->theme->setSidebar($this->sidebar['text'], $this->sidebar['sidebarside']);
			if(isset($this->sidebar2))
			{
				$this->theme->setSidebar($this->sidebar2['text'], $this->sidebar2['sidebarside']);
			}
			$this->theme->setPageTitle($this->settings["sitename"]." - ".$this->pagequery['title']);
			$headline = $this->pagequery['headline'];
			if($this->pagequery['dated'])
			{
				$headline .= " <small>".date('l j F Y', $this->pagequery['date'])."</small>";
			}
			$this->theme->setHeaderTitle($headline);
			$this->theme->setMainView("fathr_pageView");
		}
		else {
			$this->theme->setError("No page found - check the url.");
		}
		$this->theme->render();
	}
	
}
?>