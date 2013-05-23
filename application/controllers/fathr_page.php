<?php
require_once('fathr_cms.php');
class Fathr_page extends Fathr_cms {
	function __construct() {
		parent::__construct();
		$this->load->model("fathr_page_model", true);
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
			$query = $this->fathr_page_model->getPage($id);
			$this->pagequery = $query->getArray()[0];
			$sidebarquery = $this->fathr_page_model->getSidebarsForPage($id);
			$sidebarquery = $sidebarquery->getArray();
			$this->sidebar = $sidebarquery[0];
			
			if(isset($sidebarquery[1])) {
				$this->sidebar2 = $sidebarquery[1];
			}
			else {
				$this->sidebar2 = null;
			}
			
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
			$this->theme->setColorboxOn();
		}
		else {
			$this->theme->setError("No page found - check the url.");
		}
		$this->theme->render();
	}
	
}
?>