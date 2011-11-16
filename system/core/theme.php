<?php
class Theme {
	public $theme;
	public $pagetitle;
	public $meta;
	public $grid;
	
	//variables containing the content for the different

	function __construct($theme = "default")
	{
		$this->theme = $theme;
	}
	
	function getHeader()
	{
		
	}
	function getMain()
	{
	
	}
	function setMainContent($content)
	{
	
	}
	function getFooter()
	{
		
	}
}
?>