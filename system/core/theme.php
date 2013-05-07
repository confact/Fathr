<?php
class Theme {
// The engine that will be the theme engine. This works halfly so don't trust it 100% yet.

	public $theme; // which theme do you want to use? send this in the construct. default: default.
	public $sitepath; // the path to the site (for css).
	public $split = true; // shall we split header, footer and main in three different files? default: true.
	//if you don't want to have it splitted, change to falls and add everything to main.php in theme-directory.
	public $pagetitle = "Title"; // The title for the page. default: empty.
	public $pageheadertitle = ""; // the title in header. default: empty.
	public $pageheadercaption = ""; // the undertext in header. default: empty.
	public $meta = array(); // array with the meta tags like description, keywords and so on: default: empty.
	public $grid = 24; // count of grids we should use. default: 24.
	public $sidebar = array(); // sidebar saves here, [$settings(left/right] = $content;
	public $stylesheet = ""; // want to use custom stylesheet? set this to the name of the stylesheet. (it should be in the theme's directory.)
	
	public $error = "";
	
	public $colorbox = false;
	
	public $pagebrand = "";
	public $pagebrandurl = "";
	
	public $editor = ""; //CKeditor holder. Can be used by themes and views.
	
	//variables containing the content for the different
	public $main;
	public $mainView;
	public $menu = array();
	public $footer;

	function __construct($theme = "default")
	{
		include('theme/core/ckeditor/ckeditor.php');
		$this->theme = $theme;
		global $fathr;
		$this->sitepath = $fathr->config['sitepath'];
		$siteurl = "http://".$_SERVER["SERVER_NAME"]."/".$fathr->config['sitepath']."/theme/core/ckeditor/";
		$this->editor = new CKEditor($siteurl);
	}
	function setError($error)
	{
		$this->error = $error;
	}
	function setMain($content)
	{
		$this->main = $content;
	}
	
	//set the color box to true, making the theme to add color box and set the class(.colorbox) so you just need to make the <a> in right class.
	function setColorboxOn()
	{
		$this->colorbox = true;
	}
	
	//want to add the content of the view into the theme? use this then.
	function setMainView($viewname)
	{
		global $fathr;
		
		$path = '/../../'.$fathr->config['applicationpath'] . '/views/' . $viewname . '.php';
		if(file_exists(dirname(__FILE__) . $path)) {
			$this->mainView = dirname(__FILE__).$path;
		}
		else {
			$this->setMain(dirname(__FILE__) . $path . "<br />"."the view ".$viewname." couldn't be found");
		}
	}
	function setMenu($menu)
	{
		$this->menu = $menu;
	}
	function setMeta($meta)
	{
		$this->meta = $meta;
	}
	function AddMeta($name, $content)
	{
		$this->meta[$name] = $content;
	}
	function setStylesheet($styleurl)
	{
		$this->stylesheet = $styleurl;
	}
	function setFooter($footer)
	{
		$this->footer = $footer;
	}
	function setSidebar($sidebar, $settings)
	{
		$this->sidebar[$settings] = $sidebar;
	}
	function setPageTitle($title)
	{
		$this->pagetitle = $title;
	}
	function setPageBrand($pagebrand)
	{
		$this->pagebrand = $pagebrand;
	}
	function setPageBrandUrl($url = "")
	{
		$this->pagebrandurl = $url;
	}
	function setHeaderTitle($title)
	{
		$this->pageheadertitle = $title;
	}
	function getMainContent()
	{
		global $fathr;
		if(isset($this->mainView))
		{
			include($this->mainView);
		}
		else
		{
			echo $this->main;
		}
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
		if($this->split) {
			$this->getHeader();
			$this->getMain();
			$this->getFooter();
		}
		else {
			$this->getMain();
		}
	}
}
?>