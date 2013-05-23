<?php
// This is the inbuilt administration where you can work with the CMS-side of this framework.
require_once('fathr_cms.php');
class Fathr_admin extends Fathr_cms {
	function __construct() {
		parent::__construct();
		$this->load->helper("session");
		$this->theme->setStylesheet("stylesheet");
		$this->theme->setPageTitle($this->settings["sitename"]." - Admin");
		$this->theme->setPageBrand($this->settings["sitename"]." - Admin");
		$this->theme->setPageBrandUrl($this->settings["url"]."fathr_admin");
		$login = $this->session->getUser("admin");
		if(isset($login))
		{
			$this->menu = array();
			$this->menu['Menu'] = "/".$this->config['sitepath']."fathr_admin/menuList";
			$this->menu['Page'] = "/".$this->config['sitepath']."fathr_admin/pageList";
			$this->menu['Logout'] = "/".$this->config['sitepath']."fathr_admin/doLogout";
			$this->theme->setMenu($this->menu);
		}
	}
	
	function index()
	{
		$login = $this->session->getUser("admin");
		if(isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/dashboard/");
		}
		else {
			$this->theme->setMainView("fathr_adminlogin");
			$this->menu = array();
			$this->menu['Back'] = "/".$this->config['sitepath'];
			if($this->session->getUser("error") == "user")
			{
				$this->theme->setError("username or password was wrong.");
				$this->session->deleteUser("error");
			}
			$this->theme->setMenu($this->menu);
			$this->theme->setHeaderTitle("Login <small>Login to the adminpage</small>");
			$this->theme->render();
		}
	}
	
	function doLogin()
	{
		$this->load->model("fathr_admins", true);
		$username = mysql_real_escape_string($_POST['username']);
		$password = sha1(md5(mysql_real_escape_string($_POST['password']))); 
		$found = $this->fathr_admins->login($username, $password);
		if($found) {
			$this->session->setUser("admin", "hellyeah!");
			header("Location: /".$this->config['sitepath']."fathr_admin/dashboard/");
		}
		else {
			$this->session->setUser("error", "user");
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
	}
	
	function doLogout()
	{
		$this->session->deleteUser("admin");
		header("Location: /".$this->config['sitepath']."fathr_admin/");
	}
	
	function dashboard()
	{
		$login = $this->session->getUser("admin");
		if(!isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
		else {
			$this->theme->setMainView("fathr_admininlogged");
			$this->theme->setHeaderTitle("Inlogged <small>Here can you set the normal settings.</small>");
			$this->theme->render();
		}
	}
	
	function menuList()
	{
		$login = $this->session->getUser("admin");
		if(!isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
		else {
		$this->menulist = $this->fathr_menu->getMenu();
		$this->menulistmodal = $this->fathr_menu->getMenu();
		$this->theme->setMainView("fathr_adminmenuList");
		
		$sidebar = '    <h2>Add menu item</h2>
    	<form action="/'.$this->config['sitepath'].'fathr_admin/doMenuAdd" method="post">
			<div class="clearfix">
              <div class="input-prepend">
                <span class="add-on">name</span>
                <input class="medium" id="name" name="name" size="16" type="text" />
              </div>
            </div>
            <div class="clearfix">
            <div class="input-prepend">
                <span class="add-on">url</span>
                <input class="medium" id="url" name="url" size="16" type="text" />
            </div>
            </div>
            <input class="btn success" type="submit" name="add" value="Add" />
            </form>';
		$this->theme->setSidebar($sidebar, "right");
		$this->theme->setHeaderTitle("Menu <small>Here can you update, add and delete menu items.</small>");
		$this->theme->render();
		}
	}
	
	function pageList()
	{
		$login = $this->session->getUser("admin");
		if(!isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
		else {
			$this->pagelist = $this->db->get("{$this->config['table_tag']}pages");
			$this->theme->setMainView("fathr_adminPageList");
			$this->theme->setHeaderTitle("Page <small>Here can you update, add and delete pages.</small>");
			$this->theme->render();
		}
	}
	
	function pageAdd()
	{
		$login = $this->session->getUser("admin");
		if(!isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
		else {
			$this->load->model("fathr_page_model", true);
			$this->pagelist = $this->fathr_page_model->getAllpages();
			$this->pagesquery = $this->fathr_page_model->getAllpagesSmall();
			$this->theme->setMainView("fathr_adminPageAdd");
			$this->theme->setHeaderTitle("Add a Page <small>Here do you add a page.</small>");
			$this->theme->render();
		}
	}
	function pageEdit($id)
	{
		$login = $this->session->getUser("admin");
		if(!isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
		else {
			$this->load->model("fathr_page_model", true);
			$this->pagequery = $this->fathr_page_model->getPage($id);
			$this->pagesquery = $this->fathr_page_model->getSidebarsForPageSmall($id);
			$this->page = $this->pagequery->getArray();
			$this->page = $this->page[0];
			$this->theme->setMainView("fathr_adminPageEdit");
			$this->theme->setHeaderTitle("Edit a Page <small>Here will you edit a page</small>");
			$this->theme->render();
		}
	}
	function doPageAdd()
	{
		$login = $this->session->getUser("admin");
		if(!isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
		else {
			$this->load->model("fathr_page_model", true);
			$title = $_POST['title'];
			$headline = $_POST['headline'];
			$text = $_POST['text'];
			$sidebarid = $_POST['sidebarid'];
			$sidebarside = $_POST['sidebarside'];
			$indexed=0;
			$date = strtotime("now");
			if(isset($_POST['indexed']) AND $_POST['indexed'] == "true") { $indexed = 1;}
			$dated = 0;
			if(isset($_POST['dated']) AND $_POST['dated'] == "true") { $dated = 1;}
			$this->fathr_page_model->addPage($title, $headline, $text, $sidebarid, $sidebarside, $indexed, $date, $dated);
			header("Location: /".$this->config['sitepath']."fathr_admin/pageList");
		}
	}
	function doPageUpdate($id)
	{
		$login = $this->session->getUser("admin");
		if(!isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
		else {
			$this->load->model("fathr_page_model", true);
			$title = $_POST['title'];
			$headline = $_POST['headline'];
			$text = $_POST['text'];
			$sidebarid = $_POST['sidebarid'];
			$sidebarside = $_POST['sidebarside'];
			$indexed=0;
			if(isset($_POST['indexed']) AND $_POST['indexed'] == "true") { $indexed = 1;}
			$dated = 0;
			if(isset($_POST['dated']) AND $_POST['dated'] == "true") { $dated = 1;}
			$this->fathr_page_model->updatePage($id, $title, $headline, $text, $sidebarid, $sidebarside, $indexed, $dated);
			header("Location: /".$this->config['sitepath']."fathr_admin/pageList");
		}
	}
	function doPageDelete($id)
	{
		$login = $this->session->getUser("admin");
		if(!isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
		else {
			$this->load->model("fathr_page_model", true);
			$this->fathr_page_model->deletePage($id);
			header("Location: /".$this->config['sitepath']."fathr_admin/pageList");
		}
	}	

	function doMenuAdd()
	{
		$login = $this->session->getUser("admin");
		if(!isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
		else {
			$name = $_POST['name'];
			$url = $_POST['url'];
			$this->fathr_menu->addMenu($name, $url);
			header("Location: /".$this->config['sitepath']."fathr_admin/menuList");
		}
	}
	function doMenuUpdate($id)
	{
		$login = $this->session->getUser("admin");
		if(!isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
		else {
			$name = $_POST['name'];
			$url = $_POST['url'];
			$this->fathr_menu->updateMenu($id, $name, $url);
			//header("Location: /".$this->config['sitepath']."/fathr_admin/menuList");
		}
	}
	function doMenuDelete($id)
	{
		$login = $this->session->getUser("admin");
		if(!isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
		else {
			$this->fathr_menu->deleteMenu($id);
			header("Location: /".$this->config['sitepath']."fathr_admin/menuList");
		}
	}
	function setSettings()
	{
		$login = $this->session->getUser("admin");
		if(!isset($login)) {
			header("Location: /".$this->config['sitepath']."fathr_admin/");
		}
		else {
			$sitename = $_POST['sitename'];
			$url = $_POST['url'];
			$theme = $_POST['theme'];
			$blogy = 0;
			if(isset($_POST['blogy']) AND $_POST['blogy'] == "true") {
				$blogy = 1;
			}
			$this->fathr_settings->setSettings($sitename, $url, $theme, $blogy);
			header("Location: /".$this->config['sitepath']."fathr_admin/dashboard");
		}
	}
}
?>