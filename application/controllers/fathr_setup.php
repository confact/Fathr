<?php
class Fathr_setup extends Controller {
	function __construct() {
		parent::__construct();
		$this->load->theme();
		$this->load->helper("db");
		
		$query = $this->db->query("SELECT * menu");
		if($query != null) {
			
		}
	}
	public function index() {
		$query = $this->db->get("settings");
		if($query != null) {
			header("Location: /".$this->config['sitepath']);
		}
		$this->theme->setPageTitle("Fathr CMS Setup");
		$this->theme->setHeaderTitle("Fathr CMS Setup");
		$this->theme->setStylesheet("stylesheet");
		$this->theme->setMain("This will setup your database with required data for the Fathr CMS.<p>Is the db config set? Then just click on the button below:</p><p><a href='/".$this->config['sitepath']."/fathr_setup/db_setup' class='button'>Install FathrCMS</a></p>");
		$this->theme->render();
	}
	public function db_setup() {
		$query = $this->db->query();
	}
}
?>