<?php
class Theme {
// The engine that will be the theme engine. This works halfly so don't trust it in 100% yet.

	public $theme; // which theme do you want to use? send this in the construct. default: default.
	public $sitepath; // the path to the site (for css).
	public $split = true; // shall we split header, footer and main in three different files? default: true.
	public $pagetitle = "Title"; // The title for the page. default: empty.
	public $pageheadertitle = ""; // the title in header. default: empty.
	public $pageheadercaption = ""; // the undertext in header. default: empty.
	public $meta = array(); // array with the meta tags like description, keywords and so on: default: empty.
	public $grid = 24; // count of grids we should use. default: 24.
	
	//variables containing the content for the different
	public $main;
	public $menu = array();
	public $footer;

	function __construct($theme = "default")
	{
		$this->theme = $theme;
		global $fathr;
		$this->sitepath = $fathr->config['sitepath'];
	}
	function printObject()
	{
		print_r($this);
	}
	
	function setMain($content)
	{
		$this->main = $content;
	}
	function setMenu($menu)
	{
		$this->menu = $menu;
	}
	function setFooter($footer)
	{
		$this->footer = $footer;
	}
	function setPageTitle($title)
	{
		$this->pagetitle = $title;
	}
	function setHeaderTitle($title)
	{
		$this->pageheadertitle = $title;
	}
	
	private function getHeader()
	{
		require_once('theme/'.$this->theme.'/header.php');
	}
	private function getMain()
	{
		require_once('theme/'.$this->theme.'/main.php');
	}
	private function getFooter()
	{
		require_once('theme/'.$this->theme.'/footer.php');
	}
	
	// Render the site
	function render()
	{
		$this->getHeader();
		$this->getMain();
		$this->getFooter();
	}
}
?>