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
			$query = $this->db->query("SELECT title, headline, text, dated, date from pages WHERE id='{$id}' LIMIT 1");
			$this->pagequery = mysql_fetch_array($query);
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