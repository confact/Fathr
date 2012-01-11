<?php
class Fathr_cms extends Controller {

	public $settings = array();
	public $menu = array();

	function __construct() {
		parent::__construct();
		$this->load->helper("db");
		$this->load->model("fathr_menu", true);
		$this->load->model("fathr_settings", true);
		$menuquery = $this->fathr_menu->getMenu();
		if ($menuquery) {
			while($row = mysql_fetch_array($menuquery))
			{
				$this->menu[$row[1]] = $row[2];
			}
		}
		$settingsquery = $this->fathr_settings->getSettings();
		if ($settingsquery) {
			while($row = mysql_fetch_array($settingsquery))
			{
				$this->settings[$row[1]] = $row[2];
			}
		}
		if(isset($this->settings["theme"]))
		{
			$this->load->theme($this->settings["theme"]);
		}
		else {
			$this->load->theme();
		}
	}

}
?>