<?php
class Fathr_setup extends Controller {
	function __construct() {
		parent::__construct();
		$this->load->theme();
		$this->load->helper("db");
	}
	public function index() {
		$query = $this->db->get("{$this->config['table_tag']}settings");
		if($query != null) {
			header("Location: /".$this->config['sitepath']);
		}
		$this->theme->setPageTitle("Fathr CMS Setup");
		$this->theme->setHeaderTitle("Fathr CMS Setup");
		$this->theme->setStylesheet("stylesheet");
		$this->theme->setMainView('fathr_setupform');
		$this->theme->render();
	}
	public function db_setup() {
		//adding the models
		$this->load->model("fathr_page_model", true);
		$this->load->model("fathr_admins", true);
		$this->load->model("fathr_menu", true);
		$this->load->model("fathr_settings", true);
	
		//fixing variables for the setup from the form.
		$sitename = mysql_escape_string($_POST['sitename']);
		$url = mysql_escape_string($_POST['url']);
		$theme = mysql_escape_string($_POST['theme']);
		$blogy = 0;
		if(isset($_POST['blogy']) AND $_POST['blogy'] == "true") {
			$blogy = 1;
		}
	
		$username = mysql_escape_string($_POST['username']);
		$password = sha1(md5(mysql_escape_string($_POST['password'])));
	
	
		//fixing the admin table first, creating table admins and then insert the admin in it.
		$this->fathr_admins->install($username, $password) or die(mysql_error());

		//next is settings table, ofc.
		$this->fathr_settings->install($sitename, $url, $theme, $blogy);
		
		//Now is it menu table - this is just normal data that the user can change later.
		$this->fathr_menu->install($url) or die(mysql_error());

		//last is the pages table. here is it also a normal data to say hi to the user.
		$this->fathr_page_model->install() or die(mysql_error());

		//after the setup will we send the user to the actual site
		header("Location: /".$this->config['sitepath']);
	}
}
?>