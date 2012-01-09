<?php
class Fathr_cms extends Controller {

	public $settings = array();
	public $menu = array();

	function __construct() {
		parent::__construct();
		$this->load->helper("db");
		
		$menuquery = $this->db->get("{$this->config['table_tag']}menu");
		if (isset($menuquery)) {
			while($row = mysql_fetch_array($menuquery))
			{
				$this->menu[$row[1]] = $row[2];
			}
		}
		$settingsquery = $this->db->get("{$this->config['table_tag']}settings");
		if (isset($settingsquery)) {
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