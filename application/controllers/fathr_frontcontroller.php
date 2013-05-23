<?php
require_once('fathr_cms.php');
class Fathr_frontcontroller extends Fathr_cms {

	function __construct() {
		parent::__construct();
		$this->theme->setStylesheet("stylesheet");
		if(isset($this->settings["sitename"]))
		{
			$this->theme->setPageTitle($this->settings["sitename"]);
			$this->theme->setHeaderTitle($this->settings["sitename"]);
			$this->theme->setPageBrand($this->settings["sitename"]);
			$this->theme->setPageBrandUrl("/".$this->config['sitepath']);
		}
		$this->theme->setMenu($this->menu);
		$this->theme->setColorboxOn();
	}
	
	function index() {
		if(empty($this->settings)) {
			header("Location: /".$this->config['sitepath']."fathr_setup");
			//print_r($query);
		}
		else {
			$this->load->model("fathr_page_model", true);
			if($this->settings['blogyindex'])
			{
				$this->pagequery = $this->fathr_page_model->getAllPagesIndexed();
				$this->theme->setMainView("fathr_indexPages");
				$sidebarquery = $this->fathr_page_model->getSidebarIndex();
				$this->sidebar = mysql_fetch_array($sidebarquery);
				$this->theme->setSidebar($this->sidebar['text'], $this->sidebar['sidebarside']);
			}
			else {
				$this->pagequery = $this->fathr_page_model->getPageIndex();
				$this->page = mysql_fetch_array($this->pagequery);
				$this->theme->setMainView("fathr_indexPages");
				$sidebarquery = $this->fathr_page_model->getSidebarIndex();
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