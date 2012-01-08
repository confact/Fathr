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
		$this->theme->setPageBrandUrl("/".$this->config['sitepath']."fathr_admin");
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
		$username = mysql_escape_string($_POST['username']);
		$password = sha1(md5(mysql_escape_string($_POST['password']))); 
		$query = $this->db->query("SELECT id from {$this->config['table_tag']}admins WHERE username='{$username}' and password='{$password}' LIMIT 1");
		$found = false;
		$row = mysql_fetch_array($query);
		if($row['id'] != "")
		{
			$found = true;
		}
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
		$this->menulist = $this->db->get("{$this->config['table_tag']}menu");
		$this->menulistmodal = $this->db->get("{$this->config['table_tag']}menu");
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
			$this->pagelist = $this->db->get("{$this->config['table_tag']}pages");
			$this->pagesquery = $this->db->query("SELECT id,title from {$this->config['table_tag']}pages");
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
			$this->pagequery = $this->db->query("SELECT id,title, headline, text, dated, date, indexed, sidebar, sidebarside from {$this->config['table_tag']}pages WHERE {$this->config['table_tag']}pages.id='{$id}'");
			$this->pagesquery = $this->db->query("SELECT id,title from {$this->config['table_tag']}pages WHERE {$this->config['table_tag']}pages.id!='{$id}'");
			$this->page = mysql_fetch_array($this->pagequery);
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
			$title = $_POST['title'];
			$headline = $_POST['headline'];
			$text = $_POST['text'];
			$sidebarid = $_POST['sidebarid'];
			$sidebarside = $_POST['sidebarside'];
			$indexed=0;
			$date = strtotime("now");
			if($_POST['indexed'] == "true") { $indexed = 1;}
			$dated = 0;
			if($_POST['dated'] == "true")
			{
				$dated = 1;
				$this->db->query("INSERT INTO {$this->config['table_tag']}pages (title, headline, text, indexed, dated, date, sidebar, sidebarside) VALUES ('{$title}', '{$headline}', '{$text}', '{$indexed}', '{$dated}', '{$date}','{$sidebarid}', '{$sidebarside}');");
			}
			else {
				$this->db->query("INSERT INTO {$this->config['table_tag']}pages (title, headline, text, indexed, date, sidebar, sidebarside) VALUES ('{$title}', '{$headline}', '{$text}', '{$indexed}','{$date}','{$sidebarid}', '{$sidebarside}');");
			}
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
			$title = $_POST['title'];
			$headline = $_POST['headline'];
			$text = $_POST['text'];
			$sidebarid = $_POST['sidebarid'];
			$sidebarside = $_POST['sidebarside'];
			$indexed=0;
			if(isset($_POST['indexed']) AND $_POST['indexed'] == "true") { $indexed = 1;}
			$dated = 0;
			if(isset($_POST['dated']) AND $_POST['dated'] == "true")
			{
				$dated = 1;
			}
			$this->db->query("UPDATE {$this->config['table_tag']}pages SET {$this->config['table_tag']}pages.title='{$title}', {$this->config['table_tag']}pages.headline='{$headline}', {$this->config['table_tag']}pages.text='{$text}', {$this->config['table_tag']}pages.indexed='{$indexed}', {$this->config['table_tag']}pages.dated='{$dated}', {$this->config['table_tag']}pages.sidebar='{$sidebarid}', {$this->config['table_tag']}pages.sidebarside='{$sidebarside}' WHERE {$this->config['table_tag']}pages.id='{$id}'");
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
			$this->db->query("DELETE FROM {$this->config['table_tag']}pages WHERE id={$id};");
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
			$this->db->query("INSERT INTO {$this->config['table_tag']}menu (names, url) VALUES ('{$name}', '{$url}');");
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
			$this->db->query("UPDATE {$this->config['table_tag']}menu SET {$this->config['table_tag']}menu.names='{$name}', {$this->config['table_tag']}menu.url='{$url}' WHERE {$this->config['table_tag']}menu.id='{$id}'");
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
			$this->db->query("DELETE FROM {$this->config['table_tag']}menu WHERE id={$id};");
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
			print_r($_POST);
			echo "<br />";
			if(isset($_POST['blogy']) AND $_POST['blogy'] == "true") {
				$blogy = 1;
			}
			$this->db->query("UPDATE {$this->config['table_tag']}settings SET {$this->config['table_tag']}settings.value='{$sitename}' WHERE {$this->config['table_tag']}settings.key='sitename'");
			$this->db->query("UPDATE {$this->config['table_tag']}settings SET {$this->config['table_tag']}settings.value='{$url}' WHERE {$this->config['table_tag']}settings.key='url'");
			$this->db->query("UPDATE {$this->config['table_tag']}settings SET {$this->config['table_tag']}settings.value='{$theme}' WHERE {$this->config['table_tag']}settings.key='theme'");
			$this->db->query("UPDATE {$this->config['table_tag']}settings SET {$this->config['table_tag']}settings.value='{$blogy}' WHERE {$this->config['table_tag']}settings.key='blogyindex'");
			header("Location: /".$this->config['sitepath']."fathr_admin/dashboard");
		}
	}
}
?>